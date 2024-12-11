<?php

namespace Services;

use Exception;
use Repositories\LibroRepository;

class LibroService {
    private LibroRepository $libroRepository;

    public function __construct() {
        $this->libroRepository = new LibroRepository();
    }

    // Obtener los libros con stock
    public function getLibrosConStock() {
        return $this->libroRepository->getLibrosConStock();
    }

    public function getLibrosDisponibles() {
        return $this->libroRepository->getLibrosDisponibles();  // Llama al repositorio para obtener solo los libros disponibles
    }

    public function getLibrosEnStock(): array {
        // Llamar al repositorio para obtener los libros que tienen stock disponible
        return $this->libroRepository->getLibrosEnStock(); // Llama al repositorio para obtener los libros en stock
    }

    // Obtener un libro por su ISBN
    public function getLibroPorISBN($ISBN) {
        return $this->libroRepository->getLibroPorISBN($ISBN);
    }

    // Obtener el stock de un libro por su ISBN
    public function getStockPorISBN($ISBN) {
        return $this->libroRepository->getStockPorISBN($ISBN);
    }

    // Agregar un libro
    public function agregarLibro($data): bool {
        // Verificar si el libro ya existe en la base de datos
        $libroExistente = $this->libroRepository->getLibroPorISBN($data['ISBN']);

        if ($libroExistente) {
            throw new Exception("El libro con el ISBN " . $data['ISBN'] . " ya existe.");
        }

        return $this->libroRepository->agregarLibro($data); // Llama al repositorio para agregar el libro
    }

    public function agregarStockInicial($ISBN, $cantidad) {
        return $this->libroRepository->agregarStock($ISBN, $cantidad, 'Disponible'); // Crea el stock con 5 unidades
    }

    // Actualizar los datos de un libro
    public function actualizarLibro($data): bool {
        // Llamar al repositorio para actualizar el libro
        return $this->libroRepository->actualizarLibro($data); // Devuelve true o false
    }

    public function eliminarLibro($ISBN): bool {
        return $this->libroRepository->eliminarLibro($ISBN);
    }

    // Actualizar el stock de un libro (agregar o modificar)
    public function actualizarStock($ISBN, $cantidad, $estado) {
        return $this->libroRepository->actualizarStock($ISBN, $cantidad, $estado); // Pasamos los tres parámetros
    }

    public function buscarPorTitulo($titulo): array {
        return $this->libroRepository->buscarPorTitulo($titulo);
    }

    public function buscarPorAutor($autor): array {
        return $this->libroRepository->buscarPorAutor($autor);
    }
}
