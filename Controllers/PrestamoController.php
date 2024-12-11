<?php

namespace Controllers;

use Lib\Pages;
use Services\PrestamoService;
use Services\LibroService;
use Services\UsuarioService;


class PrestamoController {
    private PrestamoService $prestamoService;
    private LibroService $libroService;
    private UsuarioService $usuarioService;
    private Pages $pages;

    public function __construct() {
        $this->prestamoService = new PrestamoService();
        $this->libroService = new LibroService();
        $this->usuarioService = new UsuarioService();
        $this->pages = new Pages();
    }

    // Método para listar los préstamos activos del lector
    public function listar() {

        // Verifica si el usuario está logueado
        if (!isset($_SESSION['usuario'])) {
            echo "Sesión no iniciada. Redirigiendo al login...";
            header("Location: ?controller=Usuario&action=login");
            exit();
        }

        // Verifica si el usuario tiene el rol correcto
        if ($_SESSION['usuario']['rol'] !== 'bibliotecario') {
            echo "Usuario no autorizado. Redirigiendo al dashboard...";
            header("Location: ?controller=Usuario&action=dashboard");
            exit();
        }

        // Obtener los préstamos desde el servicio
        $prestamos = $this->prestamoService->getTodosLosPrestamos(); // Obtener todos los préstamos

        // Renderizar la vista con los préstamos
        $this->pages->render('Bibliotecario/listar_prestamos', ['prestamos' => $prestamos]);
    }


    // Método para agregar un nuevo préstamo
    public function agregar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $socio = $_POST['socio']; // Número de socio
            $idLibro = $_POST['idLibro']; // ID del libro prestado

            // Llamar al servicio para registrar el préstamo
            $exitoPrestamo = $this->prestamoService->registrarPrestamo($socio, $idLibro);

            // Si el préstamo se registra correctamente, actualizar el stock
            if ($exitoPrestamo) {
                // Actualizar el stock del libro
                $this->libroService->actualizarStock($idLibro, 1, 'Prestado');
                header("Location: ?controller=Prestamo&action=listar");  // Redirigir a la lista de préstamos
                exit();
            }
        }

        // Renderizar la vista con los usuarios y libros en stock
        $usuarios = $this->usuarioService->getTodosLosUsuarios();
        $librosEnStock = $this->libroService->getLibrosEnStock();
        $this->pages->render('Bibliotecario/agregar_prestamo', [
            'usuarios' => $usuarios,
            'librosEnStock' => $librosEnStock
        ]);
    }

    public function listarPrestamosPrestados() {

        // Verificar que el usuario sea bibliotecario
        if ($_SESSION['usuario']['rol'] !== 'bibliotecario') {
            header("Location: ?controller=Usuario&action=dashboard");
            exit();
        }

        // Obtener los préstamos con estado "Prestado"
        $prestamosPrestados = $this->prestamoService->getPrestamosPrestados();

        // Pasar los datos a la vista
        $this->pages->render('Bibliotecario/listar_prestamos_prestados', ['prestamosPrestados' => $prestamosPrestados]);
    }

    // Método para listar los préstamos activos de un lector
    public function listarPrestamosLector() {

        // Verifica si el usuario está logueado
        if (!isset($_SESSION['usuario'])) {
            header("Location: ?controller=Usuario&action=login");
            exit();
        }

        // Verifica que el usuario sea un lector
        if ($_SESSION['usuario']['rol'] !== 'lector') {
            header("Location: ?controller=Usuario&action=dashboard");
            exit();
        }

        // Obtén el número de socio del usuario desde la sesión
        $numeroSocio = $_SESSION['usuario']['id'];

        // Obtén los préstamos activos del lector
        $prestamosActivos = $this->prestamoService->getPrestamosActivosPorSocio($numeroSocio);

        // Renderiza la vista con los datos
        $this->pages->render('Lector/prestamos_lector', ['prestamosActivos' => $prestamosActivos]);
    }

    // Método para finalizar un préstamo
    public function finalizarPrestamo($idPrestamo) {

        // Verificar que el usuario sea bibliotecario
        if ($_SESSION['usuario']['rol'] !== 'bibliotecario') {
            header("Location: ?controller=Usuario&action=dashboard");
            exit();
        }

        // Obtener el préstamo con el ID proporcionado
        $prestamo = $this->prestamoService->getPrestamoById($idPrestamo);

        if ($prestamo) {
            $socio = $prestamo['socio'];
            $idLibro = $prestamo['idLibro'];
            $fechaDevolucion = date('Y-m-d'); // Fecha actual

            // Actualizar el estado del préstamo a "Devuelto"
            $this->prestamoService->finalizarPrestamo($idPrestamo);

            // Registrar la devolución en la tabla Devoluciones
            $this->prestamoService->registrarDevolucion($socio, $idLibro, $fechaDevolucion, 'Devuelto');

            // Redirigir al listado de préstamos con estado "Prestado"
            header("Location: ?controller=Prestamo&action=listarPrestamosPendientes");
            exit();
        }
    }
}