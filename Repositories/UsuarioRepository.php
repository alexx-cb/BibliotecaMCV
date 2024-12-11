<?php
namespace Repositories;

use Lib\BaseDatos;
use Models\Usuario;

class UsuarioRepository {
    private BaseDatos $db;

    public function __construct() {
        $this->db = new BaseDatos();
    }

    public function existeDNI(string $DNI): bool {
        $sql = "SELECT COUNT(*) as total FROM Usuarios WHERE DNI = :DNI";
        $params = [':DNI' => $DNI];
        $resultado = $this->db->ejecutarConsulta($sql, $params);

        return $resultado[0]['total'] > 0;
    }

    // Método para registrar un usuario
    public function registrarUsuario(array $data): bool {
        $sql = "INSERT INTO Usuarios (DNI, nombre, apellidos, direccion, email, telefono, contraseña, rol) 
                VALUES (:DNI, :nombre, :apellidos, :direccion, :email, :telefono, :contraseña, :rol)";
        $params = [
            ':DNI' => $data['DNI'],
            ':nombre' => $data['nombre'],
            ':apellidos' => $data['apellidos'],
            ':direccion' => $data['direccion'],
            ':email' => $data['email'],
            ':telefono' => $data['telefono'],
            ':contraseña' => password_hash($data['contraseña'], PASSWORD_BCRYPT),
            ':rol' => $data['rol'] ?? 'lector'
        ];

        return $this->db->ejecutarConsulta($sql, $params);
    }

    // Método para buscar un usuario por email
    public function buscarUsuarioPorCredenciales($email, $password) {
        $sql = "SELECT numeroSocio AS id, nombre, rol, contraseña 
            FROM Usuarios 
            WHERE email = :email";
        $params = [
            ':email' => $email
        ];

        $resultado = $this->db->ejecutarConsulta($sql, $params);

        // Si se encuentra el usuario, se verifica la contraseña
        if ($resultado) {
            if (password_verify($password, $resultado[0]['contraseña'])) {
                // Se devuelve el usuario sin la contraseña
                unset($resultado[0]['contraseña']);
                return $resultado[0];
            }
        }

        // Si no se encuentra el usuario o la contraseña es incorrecta, retorna null
        return null;
    }

    public function getTodosLosUsuarios() {
        $sql = "SELECT numeroSocio, nombre, apellidos FROM Usuarios";
        return $this->db->ejecutarConsulta($sql);
    }
}
