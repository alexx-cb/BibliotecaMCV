<?php

namespace Lib;
class Pages {

    public function render(string $pageName, array $params = null): void {
        // Extraer parámetros si los hay
        if ($params != null) {
            foreach ($params as $name => $value) {
                $$name = $value;
            }
        }

        // Verificar la existencia de los archivos
        $header = __DIR__ . "/../Views/layout/header.php";
        $footer = __DIR__ . "/../Views/layout/footer.php";
        $view = __DIR__ . "/../Views/$pageName.php";

        if (!file_exists($view)) {
            die("La vista '$pageName.php' no existe en la carpeta Views.");
        }

        // Incluir los archivos
        if (file_exists($header)) require_once $header;
        require_once $view;
        if (file_exists($footer)) require_once $footer;
    }
}
