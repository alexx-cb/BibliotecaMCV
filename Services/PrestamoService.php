<?php

namespace Services;

use Repositories\PrestamoRepository;


class PrestamoService {
    private PrestamoRepository $prestamoRepository;

    public function __construct() {
        $this->prestamoRepository = new PrestamoRepository();
    }

    // Obtener solo los préstamos activos del usuario
    public function getPrestamosActivosPorUsuario($usuarioId):array {
        return $this->prestamoRepository->getPrestamosActivosPorUsuario($usuarioId);
    }

    // Obtener todos los préstamos (para el bibliotecario)
    public function getTodosLosPrestamos() {
        return $this->prestamoRepository->getTodosLosPrestamos();
    }

    public function getPrestamoById($idPrestamo) {
        return $this->prestamoRepository->getPrestamoById($idPrestamo);
    }

    public function registrarPrestamo($socio, $idLibro) {
        // Establecemos la fecha de inicio del préstamo (la fecha actual)
        $fechaInicio = date('Y-m-d'); // Fecha actual
        $fechaDevolucion = date('Y-m-d', strtotime($fechaInicio . ' + 20 days')); // Fecha de devolución (20 días después)

        // Llamamos al repositorio para registrar el préstamo
        return $this->prestamoRepository->registrar($socio, $idLibro, $fechaInicio, $fechaDevolucion);
    }

    public function getPrestamosActivosPorSocio($numeroSocio): array {
        return $this->prestamoRepository->obtenerPrestamosPorSocio($numeroSocio);
    }

    public function getPrestamosPrestados() {
        return $this->prestamoRepository->getPrestamosPrestados(); // Llama al repositorio
    }

    // Finalizar un préstamo (cambiar el estado a "Devuelto")
    public function finalizarPrestamo($idPrestamo) {
        return $this->prestamoRepository->finalizarPrestamo($idPrestamo); // Llama al repositorio para actualizar el estado
    }

    // Registrar la devolución en la tabla Devoluciones
    public function registrarDevolucion($socio, $idLibro, $fechaDevolucion, $estado) {
        return $this->prestamoRepository->registrarDevolucion($socio, $idLibro, $fechaDevolucion, $estado);
    }
}