<h2>Listado de Libros</h2>

<p><a href="?controller=Libro&action=agregar">Agregar Nuevo Libro</a>

<table border="1">
    <thead>
    <tr>
        <th>ISBN</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Editorial</th>
        <th>Fecha de Publicación</th>
        <th>Estado</th>
        <th>Acciones</th> <!-- Nueva columna para los botones -->
    </tr>
    </thead>
    <tbody>
    <?php foreach ($libros as $libro): ?>
        <tr>
            <td><?php echo $libro['ISBN']; ?></td>
            <td><?php echo $libro['titulo']; ?></td>
            <td><?php echo $libro['autor']; ?></td>
            <td><?php echo $libro['editorial']; ?></td>
            <td><?php echo $libro['fechaPublicacion']; ?></td>
            <td><?php echo isset($libro['libro_estado']) ? $libro['libro_estado'] : 'N/A'; ?></td>
            <td>
                <!-- Botón para editar -->
                <a href="?controller=Libro&action=editar&ISBN=<?php echo $libro['ISBN']; ?>">Editar</a> |
                <!-- Botón para eliminar -->
                <a href="?controller=Libro&action=eliminar&ISBN=<?php echo $libro['ISBN']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este libro?');">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p><a href="?controller=Usuario&action=dashboard">Volver a home</a></p>