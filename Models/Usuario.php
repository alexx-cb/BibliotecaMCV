<?php

namespace Models;

class Usuario {
    public string $DNI;
    public string $nombre;
    public string $apellidos;
    public string $direccion;
    public string $email;
    public string $telefono;
    public string $contraseña;
    public string $rol;

    public function __construct($data) {
        $this->DNI = $data['DNI'];
        $this->nombre = $data['nombre'];
        $this->apellidos = $data['apellidos'];
        $this->direccion = $data['direccion'];
        $this->email = $data['email'];
        $this->telefono = $data['telefono'];
        $this->contraseña = $data['contraseña'];
        $this->rol = $data['rol'] ?? 'lector';
    }


    public function validarDatos(): array {
        $errores = [];

        // Validar DNI (formato: 8 números + 1 letra)
        if (!preg_match('/^\d{8}[A-Za-z]$/', $this->DNI)) {
            $errores['DNI'] = 'El DNI debe tener 8 números seguidos de una letra.';
        }

        // Validar nombre (no vacío y no numérico)
        if (empty($this->nombre) || is_numeric($this->nombre)) {
            $errores['nombre'] = 'El nombre no puede estar vacío ni contener números.';
        }

        // Validar apellidos (no vacío y no numérico)
        if (empty($this->apellidos) || is_numeric($this->apellidos)) {
            $errores['apellidos'] = 'Los apellidos no pueden estar vacíos ni contener números.';
        }

        // Validar dirección (no vacía)
        if (empty($this->direccion)) {
            $errores['direccion'] = 'La dirección no puede estar vacía.';
        }

        // Validar email (formato válido)
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errores['email'] = 'El email no tiene un formato válido.';
        }

        // Validar teléfono (solo números, 9 dígitos)
        if (!preg_match('/^\d{9}$/', $this->telefono)) {
            $errores['telefono'] = 'El teléfono debe contener exactamente 9 dígitos.';
        }

        // Validar contraseña (mínimo 8 caracteres)
        if (strlen($this->contraseña) < 8) {
            $errores['contraseña'] = 'La contraseña debe tener al menos 8 caracteres.';
        }

        return $errores;
    }
    public function getDNI(): string
    {
        return $this->DNI;
    }

    public function setDNI(string $DNI): void
    {
        $this->DNI = $DNI;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function getDireccion(): string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): void
    {
        $this->direccion = $direccion;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): void
    {
        $this->telefono = $telefono;
    }

    public function getContraseña(): string
    {
        return $this->contraseña;
    }

    public function setContraseña(string $contraseña): void
    {
        $this->contraseña = $contraseña;
    }

    public function getRol(): string
    {
        return $this->rol;
    }

    public function setRol(string $rol): void
    {
        $this->rol = $rol;
    }


}
