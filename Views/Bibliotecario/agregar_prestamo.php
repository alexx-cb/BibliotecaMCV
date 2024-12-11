<h2>Agregar Nuevo Préstamo</h2>

<form action="?controller=Prestamo&action=agregar" method="POST">
    <label for="socio">Seleccionar Socio:</label>
    <select name="socio" id="socio" required>
        <?php foreach ($usuarios as $usuario): ?>
            <option value="<?php echo $usuario['numeroSocio']; ?>"><?php echo $usuario['nombre']; ?> (<?php echo $usuario['numeroSocio']; ?>)</option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="idLibro">Seleccionar Libro:</label>
    <select name="idLibro" id="idLibro" required>
        <?php foreach ($librosEnStock as $libro): ?>
            <option value="<?php echo $libro['idLibro']; ?>">
                <?php echo $libro['titulo']; ?> - <?php echo $libro['autor']; ?> (ISBN: <?php echo $libro['ISBN']; ?>)
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Crear Préstamo</button>
</form>

<p><a href="?controller=Prestamo&action=listar">Volver a la lista de préstamos</a></p>

