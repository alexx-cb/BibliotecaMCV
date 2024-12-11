<?php

namespace Services;

use Repositories\UsuarioRepository;
use Models\Usuario;

class UsuarioService
{
    private UsuarioRepository $usuarioRepository;

    public function __construct()
    {
        $this->usuarioRepository = new UsuarioRepository();
    }

    // Método para registrar un usuario
    public function registrarUsuario(array $data): array {
        // Verificar si el DNI ya existe
        if ($this->usuarioRepository->existeDNI($data['DNI'])) {
            return ['exito' => false, 'error' => 'El DNI ya está registrado.'];
        }

        // Intentar registrar al usuario
        $registrado = $this->usuarioRepository->registrarUsuario($data);

        if ($registrado) {
            return ['exito' => true];
        }

        return ['exito' => false, 'error' => 'No se pudo registrar el usuario.'];
    }

    // Método para iniciar sesión
    public function iniciarSesion($email, $password)
    {
        $usuario = $this->usuarioRepository->buscarUsuarioPorCredenciales($email, $password);

        if ($usuario) {
            return $usuario; // Si el usuario es encontrado, lo devuelve
        }

        // Logueo en caso de error (solo en desarrollo)
        error_log("Intento fallido de inicio de sesión con el email: $email");

        return null; // Si las credenciales son incorrectas, devuelve null
    }

    public function getTodosLosUsuarios()
    {
        return $this->usuarioRepository->getTodosLosUsuarios(); // Llama al repositorio para obtener todos los usuarios

    }
}