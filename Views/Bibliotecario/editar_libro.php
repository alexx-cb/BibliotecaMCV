<h2>Editar Libro</h2>

<!-- Formulario para editar los datos del libro -->
<form action="?controller=Libro&action=actualizarLibro" method="POST">
    <input type="hidden" name="ISBN" value="<?php echo $libro['ISBN']; ?>">

    <label for="titulo">Título:</label>
    <input type="text" id="titulo" name="titulo" value="<?php echo $libro['titulo']; ?>" required><br><br>

    <label for="autor">Autor:</label>
    <input type="text" id="autor" name="autor" value="<?php echo $libro['autor']; ?>" required><br><br>

    <label for="editorial">Editorial:</label>
    <input type="text" id="editorial" name="editorial" value="<?php echo $libro['editorial']; ?>" required><br><br>

    <label for="fechaPublicacion">Fecha de Publicación:</label>
    <input type="date" id="fechaPublicacion" name="fechaPublicacion" value="<?php echo $libro['fechaPublicacion']; ?>" required><br><br>

    <label for="estado">Estado:</label>
    <select id="estado" name="estado" required>
        <option value="Disponible" <?php echo $libro['estado'] === 'Disponible' ? 'selected' : ''; ?>>Disponible</option>
        <option value="No Disponible" <?php echo $libro['estado'] === 'No Disponible' ? 'selected' : ''; ?>>No Disponible</option>
    </select><br><br>

    <button type="submit">Guardar Cambios</button>
</form>

<p><a href="?controller=Libro&action=listar">Volver a la lista de libros</a></p>
