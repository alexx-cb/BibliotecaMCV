<?php

namespace Models;

use Exception;

class Libro {
    public int $ISBN;
    public string $titulo;
    public string $autor;
    public string $editorial;
    public string $fechaPublicacion;
    public string $estado;

    public function __construct($ISBN, $titulo, $autor, $editorial, $fechaPublicacion, $estado) {
        $this->ISBN = $ISBN;
        $this->titulo = $titulo;
        $this->autor = $autor;
        $this->editorial = $editorial;
        $this->fechaPublicacion = $fechaPublicacion;
        $this->estado = $estado;
    }

    public function getISBN(): int
    {
        return $this->ISBN;
    }

    public function setISBN(int $ISBN): void
    {
        // Validar que el ISBN tenga 13 dígitos
        if (strlen((string) $ISBN) !== 13) {
            throw new Exception("El ISBN debe tener 13 dígitos.");
        }
        $this->ISBN = $ISBN;
    }

    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    public function getAutor(): string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): void
    {
        $this->autor = $autor;
    }

    public function getEditorial(): string
    {
        return $this->editorial;
    }

    public function setEditorial(string $editorial): void
    {
        $this->editorial = $editorial;
    }

    public function getFechaPublicacion(): string
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion(string $fechaPublicacion): void
    {
        $this->fechaPublicacion = $fechaPublicacion;
    }

    public function getEstado(): string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): void
    {
        $this->estado = $estado;
    }


}