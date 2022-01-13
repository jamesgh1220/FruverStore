<div class="tittle">
    <h1>Registrarse</h1>
</div>

<?php if ( isset($_SESSION['register']) && $_SESSION['register'] == 'complete' ): ?>
    <strong class="alert_green">Registro completado correctamente.</strong>
<?php elseif( isset($_SESSION['register']) && $_SESSION['register'] == 'failed' ): ?>
    <strong class="alert_red">Registro fallido, introduce bien los datos.</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>

<div class="form_container">
    <form action="<?=base_url?>usuario/save" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" required>
        <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'], 'nombre') :''; ?>

        <label for="apellidos">Apellidos:</label>
        <input type="text" name="apellidos" required>
        <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'], 'apellidos') :''; ?>

        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'], 'email') :''; ?>

        <label for="password">Password:</label>
        <input type="password" name="password" required>
        <?php echo isset($_SESSION['errores']) ? Utils::mostrarError($_SESSION['errores'], 'password') :''; ?>


        <input type="submit" value="Registrarse">
    </form>
</div>

<?php Utils::borrarErrores(); ?>