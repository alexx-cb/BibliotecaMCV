<h2>Iniciar Sesión</h2>
<p>¿No tienes cuenta? <a href="?controller=Usuario&action=registrar">Regístrate aquí</a></p>
<form action="?controller=Usuario&action=login" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br>
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required><br>
    <button type="submit" value="login">Iniciar Sesión</button>
</form>

<?php if (isset($error)): ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>


