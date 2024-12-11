<?php

namespace Controllers;

use Exception;
use Lib\Pages;
use Services\LibroService;

class LibroController {
    private LibroService $libroService;
    private Pages $pages;

    public function __construct() {
        $this->libroService = new LibroService();
        $this->pages = new Pages();
    }

    // Método para listar los libros disponibles
    public function listar() {

        // Verificar si la sesión está iniciada
        if (!isset($_SESSION['usuario'])) {
            echo "Sesión no iniciada. Redirigiendo al login...";
            header("Location: ?controller=Usuario&action=login");
            exit();
        }

        // Obtener el rol del usuario desde la sesión
        $rol = $_SESSION['usuario']['rol'];

        if ($rol === 'bibliotecario') {
            // Si el usuario es bibliotecario, mostrar todos los libros con stock
            $libros = $this->libroService->getLibrosConStock();
            $this->pages->render('Bibliotecario/listar_libros', ['libros' => $libros]);
        } elseif ($rol === 'lector') {
            // Si el usuario es lector, mostrar solo los libros disponibles
            $libros = $this->libroService->getLibrosDisponibles();
            $this->pages->render('Lector/libros_lector', ['libros' => $libros]);
        } else {
            // Si el rol no es válido, redirigir al dashboard
            echo "Usuario no autorizado. Redirigiendo al dashboard...";
            header("Location: ?controller=Usuario&action=dashboard");
            exit();
        }
    }

    public function buscarPorTitulo() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'] ?? '';
            $libros = $this->libroService->buscarPorTitulo($titulo);
            $this->pages->render('Comun/buscar_libros', ['libros' => $libros]);
        } else {
            $this->pages->render('Comun/buscar_por_titulo');
        }
    }

    public function buscarPorAutor() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $autor = $_POST['autor'] ?? '';
            $libros = $this->libroService->buscarPorAutor($autor);
            $this->pages->render('Comun/buscar_libros', ['libros' => $libros]);
        } else {
            $this->pages->render('Comun/buscar_por_autor');
        }
    }


    // Método para agregar un nuevo libro
    public function agregar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Recibir los datos del formulario
                $data = $_POST;

                // Llamar al servicio para agregar el libro
                $exito = $this->libroService->agregarLibro($data);

                // Si la inserción es exitosa, agregar el stock inicial con cantidad 5
                if ($exito) {
                    $ISBN = $data['ISBN'];  // ISBN del libro recién agregado
                    $this->libroService->agregarStockInicial($ISBN, 5);  // Inicializamos el stock con 5
                    header("Location: ?controller=Libro&action=listar");
                    exit();
                } else {
                    echo "Error al agregar el libro.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();  // Mostrar el mensaje de error si el ISBN ya existe
            }
        }

        // Mostrar el formulario para agregar un nuevo libro
        $this->pages->render('Bibliotecario/agregar_libro');
    }


    // Método para editar los datos de un libro
    public function editar() {
        $ISBN = $_GET['ISBN'] ?? null;

        if (!$ISBN) {
            header("Location: ?controller=Libro&action=listar");
            exit();
        }

        $libro = $this->libroService->getLibroPorISBN($ISBN);
        $this->pages->render('Bibliotecario/editar_libro', ['libro' => $libro]);
    }

    public function eliminar() {
        $ISBN = $_GET['ISBN'] ?? null;

        if (!$ISBN) {
            echo "No se ha especificado un ISBN válido.";
            exit();
        }

        $exito = $this->libroService->eliminarLibro($ISBN);

        if ($exito) {
            header("Location: ?controller=Libro&action=listar");
            exit();
        } else {
            echo "Error al eliminar el libro.";
        }
    }

    // Método para actualizar los datos del libro
    public function actualizarLibro() {
        $data = $_POST;

        // Llamar al servicio para actualizar el libro
        $exito = $this->libroService->actualizarLibro($data);

        if ($exito) {
            header("Location: ?controller=Libro&action=listar"); // Redirigir si la actualización fue exitosa
            exit();
        } else {
            echo "Error al actualizar el libro."; // Mostrar error si la actualización falló
        }
    }

    // Método para actualizar los datos del stock
    public function actualizarStock() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Obtener los datos del formulario
            $ISBN = $_POST['ISBN'] ?? null;
            $cantidad = $_POST['cantidad'] ?? null;
            $estado = $_POST['estadoStock'] ?? null;

            // Verificar que los datos estén presentes
            if ($ISBN && $cantidad !== null && $estado) {
                // Llamar al servicio para actualizar el stock
                $exito = $this->libroService->actualizarStock($ISBN, $cantidad, $estado);

                if ($exito) {
                    // Redirigir a la lista de libros si todo fue exitoso
                    header("Location: ?controller=Libro&action=listar");
                    exit();
                } else {
                    echo "Error al actualizar el stock.";
                }
            }
        }
    }
}
