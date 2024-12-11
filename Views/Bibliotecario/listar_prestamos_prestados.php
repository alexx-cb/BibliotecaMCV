<h2>Listado de Préstamos Pendientes</h2>

<table border="1">
    <thead>
    <tr>
        <th>ID Prestamo</th>
        <th>ID Socio</th>
        <th>Nombre Socio</th>
        <th>Libro</th>
        <th>Autor</th>
        <th>Inicio</th>
        <th>Devolución</th>
        <th>Estado</th>
        <th>Acción</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($prestamosPrestados as $prestamo): ?>
        <tr>
            <td><?php echo $prestamo['idPrestamo']; ?></td>
            <td><?php echo $prestamo['socio']; ?></td>
            <td><?php echo $prestamo['nombreSocio']; ?></td>
            <td><?php echo $prestamo['libroTitulo']; ?></td>
            <td><?php echo $prestamo['libroAutor']; ?></td>
            <td><?php echo $prestamo['inicio']; ?></td>
            <td><?php echo $prestamo['devolucion']; ?></td>
            <td><?php echo $prestamo['estado']; ?></td>
            <td>
                <form action="?controller=Prestamo&action=finalizarPrestamo&idPrestamo=<?php echo $prestamo['idPrestamo']; ?>" method="POST">
                    <button type="submit">Finalizar</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p><a href="?controller=Usuario&action=dashboard">Volver al dashboard</a></p>

