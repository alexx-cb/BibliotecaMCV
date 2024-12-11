<?php

namespace Lib;

use PDO;
use PDOException;

class BaseDatos {
    private PDO $conexion;
    private string $servidor;
    private string $usuario;
    private string $pass;
    private string $base_datos;
    private string $tipo_de_base;


    public function __construct() {
        $this->tipo_de_base = "mysql";
        $this->servidor = $_ENV["SERVERNAME"];
        $this->usuario = $_ENV["USER"];
        $this->pass = $_ENV["PASSWORD"];
        $this->base_datos = $_ENV["DATABASE"];
        $this->conexion = $this->conectar();
    }

    private function conectar(): PDO {
        try {
            $opciones = [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ];
            return new PDO(
                "{$this->tipo_de_base}:host={$this->servidor};dbname={$this->base_datos}",
                $this->usuario,
                $this->pass,
                $opciones
            );
        } catch (PDOException $e) {
            die("Error al conectar con la base de datos: " . $e->getMessage());
        }
    }

    public function getConexion(): PDO {
        return $this->conexion;
    }

    public function ejecutarConsulta(string $sql, array $params = []): array {
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Aseguramos que siempre devolvemos un array
        } catch (PDOException $e) {
            echo "Error en la consulta: " . $e->getMessage();
            return []; // En caso de error, devolvemos un array vacío
        }
    }
}