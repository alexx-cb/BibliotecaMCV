<h2>Listado de Libros</h2>

<!-- Mostrar los libros -->
<table border="1">
    <thead>
    <tr>
        <th>ISBN</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Editorial</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($libros)): ?>
        <?php foreach ($libros as $libro): ?>
            <tr>
                <td><?php echo $libro['ISBN']; ?></td>
                <td><?php echo $libro['titulo']; ?></td>
                <td><?php echo $libro['autor']; ?></td>
                <td><?php echo $libro['editorial']; ?></td>
                <td><?php echo $libro['estado']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No hay libros disponibles.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<p><a href="?controller=Usuario&action=dashboard">Volver al Dashboard</a></p>
