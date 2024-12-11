<h2>Bienvenido, <?php echo $_SESSION['usuario']['nombre']; ?>!</h2>
<ul>
    <li><a href="?controller=Libro&action=buscarPorTitulo">Buscar Libros por Título</a></li>
    <li><a href="?controller=Libro&action=buscarPorAutor">Buscar Libros por Autor</a></li>
</ul>


<?php if ($_SESSION['usuario']['rol'] === 'bibliotecario'): ?>
    <ul>
        <li><a href="?controller=Prestamo&action=listar">Ver todos los préstamos</a></li>
        <li><a href="?controller=Libro&action=listar">Ver listado de libros</a></li>

    </ul>
<?php else: ?>
    <ul>
        <li><a href="?controller=Prestamo&action=listarPrestamosLector">Ver mis préstamos activos</a></li>
        <li><a href="?controller=Libro&action=listar">Ver listado de libros</a></li>

    </ul>
<?php endif; ?>
<ul>
    <li><a href="?controller=Usuario&action=logout">Cerrar Sesion</a></li>

</ul>
