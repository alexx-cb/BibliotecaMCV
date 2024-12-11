<?php

namespace Controllers;

use Services\UsuarioService;
use Models\Usuario;
use Lib\Pages;

class UsuarioController {
    private UsuarioService $usuarioService;
    private Pages $pages;

    public function __construct() {
        $this->usuarioService = new UsuarioService();
        $this->pages = new Pages();
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;

            // Crear el modelo de usuario
            $usuario = new Usuario($data);

            // Validar los datos del usuario
            $errores = $usuario->validarDatos();

            if (!empty($errores)) {
                $this->pages->render('Usuario/registro', ['errores' => $errores, 'data' => $data]);
                return;
            }

            // Llamar al servicio para registrar
            $resultado = $this->usuarioService->registrarUsuario($data);

            if ($resultado['exito']) {
                header("Location: ?controller=Usuario&action=login");
                exit();
            } else {
                $this->pages->render('Usuario/registro', [
                    'errorGeneral' => $resultado['error'],
                    'data' => $data
                ]);
            }
        }

        $this->pages->render('Usuario/registro');
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Intentar iniciar sesión con las credenciales proporcionadas
            $usuario = $this->usuarioService->iniciarSesion($email, $password);

            // Si el usuario es encontrado, se inicia la sesión
            if ($usuario) {
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'rol' => $usuario['rol']
                ];

                // Redirigir al dashboard
                header("Location: ?controller=Usuario&action=dashboard");
                exit();
            } else {
                // Si no se encuentran las credenciales, se muestra un error
                $this->pages->render('Usuario/login', [
                    'error' => 'El correo electrónico o la contraseña son incorrectos.'
                ]);
                return;
            }
        }

        // Mostrar la vista de login
        $this->pages->render('Usuario/login');
    }

    public function dashboard() {

        if (!isset($_SESSION['usuario'])) {
            header("Location: ?controller=Usuario&action=login");
            exit();
        }

        if ($_SESSION['usuario']['rol'] === 'bibliotecario') {
            $this->pages->render('Comun/dashboard');
        } else {
            $this->pages->render('Comun/dashboard');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: ?controller=Usuario&action=login");
        exit();
    }
}
