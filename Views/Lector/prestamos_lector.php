<h2>Mis Préstamos Activos</h2>

<table border="1">
    <thead>
    <tr>
        <th>Libro</th>
        <th>Fecha de Inicio</th>
        <th>Fecha de Devolución</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($prestamosActivos)): ?>
        <?php foreach ($prestamosActivos as $prestamo): ?>
            <tr>
                <td><?php echo $prestamo['libro_titulo']; ?></td>
                <td><?php echo $prestamo['inicio']; ?></td>
                <td><?php echo $prestamo['devolucion']; ?></td>
                <td><?php echo $prestamo['estado']; ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan=\"4\">No tienes préstamos activos.</td>
        </tr>
    <?php endif; ?>
    </tbody>
</table>

<p><a href="?controller=Usuario&action=dashboard">Volver al dashboard</a></p>
