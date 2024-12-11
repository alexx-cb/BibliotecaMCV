<h2>Listado de Préstamos</h2>

<!-- Enlace para agregar un nuevo préstamo -->
<p><a href="?controller=Prestamo&action=agregar">Agregar nuevo préstamo</a></p>

<!-- Enlace para ver los préstamos pendientes ("Prestados") y finalizar -->
<p><a href="?controller=Prestamo&action=listarPrestamosPrestados">Finalizar préstamo</a></p>

<!-- Mostrar todos los préstamos -->
<table border="1">
    <thead>
    <tr>
        <th>ID Prestamo</th>
        <th>Socio (Número)</th>
        <th>Socio</th>
        <th>Libro</th>
        <th>Autor</th>
        <th>ID Libro (Stock)</th>
        <th>Inicio</th>
        <th>Devolución</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($prestamos as $prestamo): ?>
        <tr>
            <td><?php echo $prestamo['idPrestamo']; ?></td>
            <td><?php echo $prestamo['numeroSocio']; ?></td>
            <td><?php echo $prestamo['nombreSocio']; ?></td>
            <td><?php echo $prestamo['libroTitulo']; ?></td>
            <td><?php echo $prestamo['libroAutor']; ?></td>
            <td><?php echo $prestamo['libroId']; ?></td>
            <td><?php echo $prestamo['inicio']; ?></td>
            <td><?php echo $prestamo['devolucion']; ?></td>
            <td><?php echo $prestamo['estado']; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<p><a href="?controller=Usuario&action=dashboard">Volver al dashboard</a></p>
