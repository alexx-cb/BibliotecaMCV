<?php

namespace Controllers;

class FrontController {
    public static function main():void {
        if (isset($_GET['controller'])) {
            $nombre_controlador = 'Controllers\\' . $_GET['controller'] . 'Controller';
        } else {
            $nombre_controlador = 'Controllers\\' . CONTROLLER_DEFAULT;  // Por defecto el controlador es el de Usuario
        }

        if (class_exists($nombre_controlador)) {
            $controlador = new $nombre_controlador();


            if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
                $action = $_GET['action'];

                if (isset($_GET['idPrestamo'])) {
                    $idPrestamo = $_GET['idPrestamo'];
                    $controlador->$action($idPrestamo);
                } else {
                    $controlador->$action();
                }

            } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
                $action_default = ACTION_DEFAULT;
                $controlador->$action_default();
            } else {
                die("No se ha encontrado la acción");
            }
        } else {
            die("No se ha encontrado el controlador");
        }
    }
}