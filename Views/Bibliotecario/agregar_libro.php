<h2>Agregar Nuevo Libro</h2>

<?php if (isset($error)): ?>
    <div style="color: red; font-weight: bold;">
        <?php echo $error; ?>
    </div>
<?php endif; ?>

<form action="?controller=Libro&action=agregar" method="POST">
    <label for="ISBN">ISBN:</label>
    <input type="text" id="ISBN" name="ISBN" required><br><br>

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" required><br><br>

    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor" required><br><br>

    <label for="editorial">Editorial:</label>
    <input type="text" id="editorial" name="editorial" required><br><br>

    <label for="fechaPublicacion">Fecha de Publicación:</label>
    <input type="date" id="fechaPublicacion" name="fechaPublicacion" required><br><br>

    <label for="estado">Estado:</label>
    <select name="estado" id="estado" required>
        <option value="Disponible">Disponible</option>
        <option value="No Disponible">No Disponible</option>
    </select><br><br>

    <button type="submit">Agregar Libro</button>
</form>

<p><a href="?controller=Libro&action=listar">Volver a la lista de libros</a></p>
