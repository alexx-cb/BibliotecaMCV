<h2>Resultados de la Búsqueda</h2>

<table border="1">
    <thead>
    <tr>
        <th>ISBN</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Editorial</th>
        <th>Fecha de Publicación</th>
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
                <td><?php echo $libro['fechaPublicacion']; ?></td>
                <td><?php echo $libro['estado']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">No se encontraron resultados.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<p><a href="?controller=Usuario&action=dashboard">Volver al Dashboard</a></p>

