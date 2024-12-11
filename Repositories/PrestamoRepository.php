<?php

namespace Repositories;
use Lib\BaseDatos;

class PrestamoRepository {
    private BaseDatos $db;

    public function __construct() {
        $this->db = new BaseDatos();
    }

    // Obtener los préstamos activos para un usuario (lector)
    public function obtenerPrestamosPorSocio($numeroSocio): array {
        $sql = "
        SELECT 
            p.idPrestamo AS id_prestamo,
            l.titulo AS titulo_libro,
            DATE_FORMAT(p.inicio, '%Y-%m-%d') AS fecha_inicio,
            DATE_FORMAT(p.devolucion, '%Y-%m-%d') AS fecha_devolucion,
            p.estado AS estado_prestamo
        FROM 
            Prestamos p
        INNER JOIN 
            Stock s ON s.idLibro = p.idLibro
        INNER JOIN 
            Libros l ON l.ISBN = s.ISBN
        WHERE 
            p.socio = :numeroSocio
            AND p.estado = 'Prestado'
        ORDER BY 
            p.inicio DESC;
    ";

        // Ejecutar la consulta y devolver los resultados
        return $this->db->ejecutarConsulta($sql, [':numeroSocio' => $numeroSocio]);
    }

    // Obtener todos los préstamos (para el bibliotecario)
    public function getTodosLosPrestamos() {
        $sql = "
            SELECT 
                Prestamos.idPrestamo, 
                Prestamos.socio, 
                Prestamos.idLibro,
                Prestamos.inicio, 
                Prestamos.devolucion, 
                Prestamos.estado,
                Usuarios.numeroSocio,      
                Usuarios.nombre AS nombreSocio, 
                Libros.titulo AS libroTitulo,
                Libros.autor AS libroAutor,
                Stock.idLibro AS libroId
            FROM 
                Prestamos
            LEFT JOIN 
                Usuarios ON Prestamos.socio = Usuarios.numeroSocio
            LEFT JOIN 
                Stock ON Prestamos.idLibro = Stock.idLibro
            LEFT JOIN 
                Libros ON Stock.ISBN = Libros.ISBN";

        return $this->db->ejecutarConsulta($sql); // Devuelve los préstamos con toda la información
    }

    public function registrar($socio, $idLibro, $fechaInicio, $fechaDevolucion) {
        // SQL para insertar un nuevo préstamo
        $sql = "INSERT INTO Prestamos (socio, idLibro, inicio, devolucion, estado) 
                VALUES (?, ?, ?, ?, ?)";

        // Parámetros para la consulta
        $params = [
            $socio,                  // Número de socio (usuario)
            $idLibro,                // ID del libro prestado
            $fechaInicio,            // Fecha de inicio
            $fechaDevolucion,        // Fecha de devolución
            'Prestado'              // Estado del préstamo
        ];

        // Ejecutar la consulta para insertar el préstamo
        return $this->db->ejecutarConsulta($sql, $params);
    }


    public function getPrestamosPrestados() {
        $sql = "
            SELECT 
                Prestamos.idPrestamo, 
                Prestamos.socio, 
                Prestamos.idLibro,
                Prestamos.inicio, 
                Prestamos.devolucion, 
                Prestamos.estado,
                Usuarios.nombre AS nombreSocio,
                Libros.titulo AS libroTitulo,
                Libros.autor AS libroAutor
            FROM 
                Prestamos
            LEFT JOIN 
                Usuarios ON Prestamos.socio = Usuarios.numeroSocio
            LEFT JOIN 
                Stock ON Prestamos.idLibro = Stock.idLibro
            LEFT JOIN 
                Libros ON Stock.ISBN = Libros.ISBN
            WHERE 
                Prestamos.estado = 'Prestado'"; // Solo prestamos con estado "Prestado"

        return $this->db->ejecutarConsulta($sql);
    }


    public function obtenerPrestamosActivosPorSocio($numeroSocio): array {
        $sql = "
        SELECT 
            p.idPrestamo,
            l.titulo AS libro_titulo,
            p.inicio,
            p.devolucion,
            p.estado
        FROM 
            Prestamos p
        INNER JOIN 
            Stock s ON p.idLibro = s.idLibro
        INNER JOIN 
            Libros l ON s.ISBN = l.ISBN
        WHERE 
            p.socio = ? AND p.estado = 'Prestado'
    ";

        return $this->db->ejecutarConsulta($sql, [$numeroSocio]);
    }
    public function getPrestamoById($idPrestamo) {
        $sql = "
            SELECT 
                Prestamos.idPrestamo, 
                Prestamos.socio, 
                Prestamos.idLibro,
                Prestamos.inicio, 
                Prestamos.devolucion, 
                Prestamos.estado,
                Usuarios.nombre AS nombreSocio,
                Libros.titulo AS libroTitulo,
                Libros.autor AS libroAutor
            FROM 
                Prestamos
            LEFT JOIN 
                Usuarios ON Prestamos.socio = Usuarios.numeroSocio
            LEFT JOIN 
                Stock ON Prestamos.idLibro = Stock.idLibro
            LEFT JOIN 
                Libros ON Stock.ISBN = Libros.ISBN
            WHERE 
                Prestamos.idPrestamo = :idPrestamo"; // Filtrar por idPrestamo

        $params = [':idPrestamo' => $idPrestamo];
        return $this->db->ejecutarConsulta($sql, $params);
    }


    // Finalizar un préstamo (cambiar el estado a "Devuelto")
    public function finalizarPrestamo($idPrestamo) {
        $sql = "UPDATE Prestamos SET estado = 'Devuelto' WHERE idPrestamo = :idPrestamo";
        $params = [':idPrestamo' => $idPrestamo];

        return $this->db->ejecutarConsulta($sql, $params);
    }

    // Registrar la devolución en la tabla Devoluciones
    public function registrarDevolucion($socio, $idLibro, $fechaDevolucion, $estado) {
        $sql = "INSERT INTO Devoluciones (socio, ISBN, fecha, estado) 
                SELECT ?, Stock.ISBN, ?, ? 
                FROM Stock 
                WHERE Stock.idLibro = ?";

        // Ejecutar la consulta
        $resultado = $this->db->ejecutarConsulta($sql, [
            $socio,
            $fechaDevolucion,
            $estado,
            $idLibro
        ]);

        return $resultado; // Retorna el resultado de la consulta (puede ser true o false)
    }
}