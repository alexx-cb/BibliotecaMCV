<h2>Registro de Usuario</h2>

<!-- Mostrar error general si existe -->
<?php if (isset($errorGeneral)): ?>
    <p style="color: red;"><?php echo $errorGeneral; ?></p>
<?php endif; ?>

<p>¿Tienes Cuenta? <a href="?controller=Usuario&action=login">login</a></p>
<form  action="?controller=Usuario&action=registrar" method="POST">
    <!-- Campo DNI -->
    <label for="DNI">DNI:</label>
    <input type="text" id="DNI" name="DNI" value="<?php echo $data['DNI'] ?? ''; ?>">
    <?php if (isset($errores['DNI'])): ?>
        <p style="color: red;"><?php echo $errores['DNI']; ?></p>
    <?php endif; ?>
    <br>

    <!-- Campo Nombre -->
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?php echo $data['nombre'] ?? ''; ?>">
    <?php if (isset($errores['nombre'])): ?>
        <p style="color: red;"><?php echo $errores['nombre']; ?></p>
    <?php endif; ?>
    <br>

    <!-- Campo Apellidos -->
    <label for="apellidos">Apellidos:</label>
    <input type="text" id="apellidos" name="apellidos" value="<?php echo $data['apellidos'] ?? ''; ?>">
    <?php if (isset($errores['apellidos'])): ?>
        <p style="color: red;"><?php echo $errores['apellidos']; ?></p>
    <?php endif; ?>
    <br>

    <!-- Campo Dirección -->
    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" value="<?php echo $data['direccion'] ?? ''; ?>">
    <?php if (isset($errores['direccion'])): ?>
        <p style="color: red;"><?php echo $errores['direccion']; ?></p>
    <?php endif; ?>
    <br>

    <!-- Campo Email -->
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $data['email'] ?? ''; ?>">
    <?php if (isset($errores['email'])): ?>
        <p style="color: red;"><?php echo $errores['email']; ?></p>
    <?php endif; ?>
    <br>

    <!-- Campo Teléfono -->
    <label for="telefono">Teléfono:</label>
    <input type="text" id="telefono" name="telefono" value="<?php echo $data['telefono'] ?? ''; ?>">
    <?php if (isset($errores['telefono'])): ?>
        <p style="color: red;"><?php echo $errores['telefono']; ?></p>
    <?php endif; ?>
    <br>

    <!-- Campo Contraseña -->
    <label for="contraseña">Contraseña:</label>
    <input type="password" id="contraseña" name="contraseña">
    <?php if (isset($errores['contraseña'])): ?>
        <p style="color: red;"><?php echo $errores['contraseña']; ?></p>
    <?php endif; ?>
    <br>

    <!-- Botón de envío -->
    <button type="submit">Registrar</button>
</form>

