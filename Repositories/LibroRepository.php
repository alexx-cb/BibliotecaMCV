<?php

namespace Repositories;

use Lib\BaseDatos;

class LibroRepository {
    private BaseDatos $db;

    public function __construct() {
        $this->db = new BaseDatos();
    }

    // Obtener todos los libros con su información de stock
    public function getLibrosConStock() {
        $sql = "
        SELECT 
            Libros.ISBN, 
            Libros.titulo, 
            Libros.autor, 
            Libros.editorial, 
            Libros.fechaPublicacion, 
            Libros.estado AS libro_estado,
            Stock.estado AS stock_estado,
            Stock.cantidad
        FROM 
            Libros
        LEFT JOIN 
            Stock ON Libros.ISBN = Stock.ISBN
    ";
        return $this->db->ejecutarConsulta($sql); // Devuelve los libros con su información de stock
    }


    // Agregar un nuevo libro a la tabla Libros
    public function agregarLibro($data): bool {
        $sql = "INSERT INTO Libros (ISBN, titulo, autor, editorial, fechaPublicacion, estado) 
            VALUES (?, ?, ?, ?, ?, ?)";

        $params = [
            $data['ISBN'],
            $data['titulo'],
            $data['autor'],
            $data['editorial'],
            $data['fechaPublicacion'],
            $data['estado']
        ];

        // Ejecutar la consulta de inserción
        $resultado = $this->db->ejecutarConsulta($sql, $params);

        // Verificar si se afectaron filas, retornando true si fue exitoso
        return $resultado > 0; // Si hay una fila afectada, la inserción fue exitosa
    }

    public function eliminarLibro($ISBN): bool {
        // Primero, eliminar el stock asociado al libro
        $sql = "DELETE FROM Stock WHERE ISBN = ?";
        $this->db->ejecutarConsulta($sql, [$ISBN]);

        // Luego, eliminar el libro de la tabla Libros
        $sql = "DELETE FROM Libros WHERE ISBN = ?";
        $resultado = $this->db->ejecutarConsulta($sql, [$ISBN]);

        // Retornar verdadero si se eliminó correctamente
        return $resultado > 0; // Si la eliminación fue exitosa
    }

    // Agregar stock para un libro en la tabla Stock
    public function agregarStock($ISBN, $cantidad, $estado) {
        $sql = "INSERT INTO Stock (ISBN, cantidad, estado) VALUES (?, ?, ?)";

        $params = [
            $ISBN,      // Clave foránea del libro
            $cantidad,  // Cantidad del libro
            $estado     // Estado inicial del libro (Disponible)
        ];

        return $this->db->ejecutarConsulta($sql, $params); // Ejecuta la consulta para agregar el stock
    }

    // Obtener un libro por su ISBN
    public function getLibroPorISBN($ISBN) {
        $sql = "SELECT * FROM Libros WHERE ISBN = ?";
        return $this->db->ejecutarConsulta($sql, [$ISBN])[0] ?? null;
    }

    public function buscarPorTitulo($titulo): array {
        $sql = "SELECT * FROM Libros WHERE titulo LIKE :titulo";
        $params = [':titulo' => '%' . $titulo . '%'];
        return $this->db->ejecutarConsulta($sql, $params);
    }

    public function buscarPorAutor($autor): array {
        $sql = "SELECT * FROM Libros WHERE autor LIKE :autor";
        $params = [':autor' => '%' . $autor . '%'];
        return $this->db->ejecutarConsulta($sql, $params);
    }

    // Obtener el stock de un libro por su ISBN
    public function getStockPorISBN($ISBN) {
        $sql = "SELECT * FROM Stock WHERE ISBN = ?";
        return $this->db->ejecutarConsulta($sql, [$ISBN])[0] ?? null;
    }

    // Actualizar los datos de un libro
    public function actualizarLibro($data): bool {
        $sql = "UPDATE Libros 
            SET titulo = ?, autor = ?, editorial = ?, fechaPublicacion = ?, estado = ?
            WHERE ISBN = ?";

        $params = [
            $data['titulo'],
            $data['autor'],
            $data['editorial'],
            $data['fechaPublicacion'],
            $data['estado'],
            $data['ISBN']
        ];

        // Ejecutar la consulta de actualización
        $resultado = $this->db->ejecutarConsulta($sql, $params);

        // Devolver true si la actualización fue exitosa (si se afectaron filas)
        return $resultado > 0;
    }

    // Actualizar el stock de un libro (aumentar o modificar la cantidad)
    public function actualizarStock($ISBN, $cantidad, $estado) {
        $sql = "UPDATE Stock 
            SET cantidad = ?, estado = ? 
            WHERE ISBN = ?"; // Se usa ISBN para identificar el libro en Stock

        $params = [
            $cantidad, // Nueva cantidad
            $estado,   // Nuevo estado
            $ISBN      // ISBN del libro
        ];

        return $this->db->ejecutarConsulta($sql, $params); // Ejecuta la consulta
    }

    public function getLibrosEnStock() {
        $sql = "SELECT Stock.idLibro, Libros.ISBN, Libros.titulo, Libros.autor, Stock.cantidad
            FROM Stock
            INNER JOIN Libros ON Stock.ISBN = Libros.ISBN
            WHERE Stock.cantidad > 0";  // Filtra solo los libros que tienen stock disponible
        return $this->db->ejecutarConsulta($sql);
    }

    public function getLibrosDisponibles() {
        $sql = "SELECT * FROM Libros WHERE estado = 'Disponible'"; // Solo libros con estado 'Disponible'
        return $this->db->ejecutarConsulta($sql);
    }


}
