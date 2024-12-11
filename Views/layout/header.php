<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <style>
        /* Estilos Generales para la Biblioteca Virtual */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        /* Estilos para los títulos */
        h1, h2, h3, h4, h5, h6 {
            color: #2a3d66; /* Color de texto principal */
            font-family: 'Georgia', serif;
            margin-bottom: 15px;
        }

        h1 {
            font-size: 2.5em;
            border-bottom: 2px solid #2a3d66;
            padding-bottom: 10px;
        }

        h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        h3 {
            font-size: 1.75em;
            margin-bottom: 8px;
        }

        /* Estilos para los Formularios */
        form {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px; /* Menor tamaño */
            margin: 0 auto;
        }

        label {
            font-size: 1em; /* Reducido */
            margin-bottom: 6px; /* Menor margen */
            display: block;
            color: #2a3d66;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        textarea {
            width: 100%;
            padding: 8px; /* Menos padding */
            margin-bottom: 12px; /* Menor margen */
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 0.9em; /* Tamaño de fuente más pequeño */
            color: #333;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        textarea:focus {
            border-color: #5e81e7;
            outline: none;
        }

        input[type="submit"] {
            background-color: #5e81e7;
            color: white;
            border: none;
            padding: 10px 15px; /* Menos padding */
            font-size: 1em; /* Menor tamaño de fuente */
            border-radius: 6px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4c70e1;
        }

        /* Estilos para el campo <select> */
        select {
            width: 100%;
            padding: 8px; /* Menos padding */
            margin-bottom: 12px; /* Menor margen */
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 0.9em; /* Tamaño de fuente más pequeño */
            color: #333;
            background-color: #fff; /* Fondo blanco para el <select> */
            cursor: pointer;
        }

        select:focus {
            border-color: #5e81e7; /* Color de borde al hacer foco */
            outline: none;
            box-shadow: 0 0 5px rgba(94, 129, 231, 0.5); /* Sombra suave en foco */
        }

        select:invalid {
            border-color: #e74c3c; /* Borde rojo si el valor es inválido */
            background-color: #fbe4e4; /* Fondo suave rojo para indicar error */
        }

        select:disabled {
            background-color: #f5f5f5; /* Fondo gris claro cuando está deshabilitado */
            cursor: not-allowed; /* Cursor de no permitido */
        }

        /* Estilos para las opciones <option> dentro del <select> */
        select option {
            padding: 8px;
            font-size: 0.9em; /* Tamaño de fuente más pequeño */
            color: #333;
            background-color: #fff; /* Fondo blanco para las opciones */
        }

        select option:hover {
            background-color: #f1f1f1; /* Fondo gris claro al pasar el ratón por encima */
        }

        select option:disabled {
            background-color: #e9e9e9; /* Fondo gris cuando la opción está deshabilitada */
            color: #b5b5b5; /* Color de texto gris para opciones deshabilitadas */
        }

        /* Estilos para las Tablas */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 8px; /* Menos padding */
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #5e81e7;
            color: white;
            font-size: 1em; /* Menor tamaño de fuente */
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Estilos para los Enlaces */
        a {
            color: #5e81e7;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Estilos para botones adicionales (si es necesario) */
        button {
            background-color: #5e81e7;
            color: white;
            border: none;
            padding: 8px 12px; /* Menor padding */
            font-size: 0.9em; /* Fuente más pequeña */
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4c70e1;
        }




    </style>
</head>
<body>
<h1>Biblioteca</h1>