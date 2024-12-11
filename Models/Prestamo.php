<?php

namespace Models;

class Prestamo {
    public int $idPrestamo;
    public int $socio;
    public int $idLibro;
    public string $inicio;
    public string $devolucion;
    public string $estado;

    public function __construct($idPrestamo, $socio, $idLibro, $inicio, $devolucion, $estado) {
        $this->idPrestamo = $idPrestamo;
        $this->socio = $socio;
        $this->idLibro = $idLibro;
        $this->inicio = $inicio;
        $this->devolucion = $devolucion;
        $this->estado = $estado;
    }

    public function getIdPrestamo(): int
    {
        return $this->idPrestamo;
    }

    public function setIdPrestamo(int $idPrestamo): void
    {
        $this->idPrestamo = $idPrestamo;
    }

    public function getSocio(): int
    {
        return $this->socio;
    }

    public function setSocio(int $socio): void
    {
        $this->socio = $socio;
    }

    public function getIdLibro(): int
    {
        return $this->idLibro;
    }

    public function setIdLibro(int $idLibro): void
    {
        $this->idLibro = $idLibro;
    }

    public function getInicio(): string
    {
        return $this->inicio;
    }

    public function setInicio(string $inicio): void
    {
        $this->inicio = $inicio;
    }

    public function getDevolucion(): string
    {
        return $this->devolucion;
    }

    public function setDevolucion(string $devolucion): void
    {
        $this->devolucion = $devolucion;
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