<div class="tittle">
    <h1>Gestión de usuarios</h1>
</div>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <strong class="alert_green">El usuario se ha bloqueado.</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete') : ?>
    <strong class="alert_red">Error bloqueando el usuario.</strong>
<?php endif;
Utils::deleteSession('delete');
?>

<table>
    <!--Encabezados de tabla-->
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>APELLIDOS</th>
        <th>EMAIL</th>
        <th>ESTADO</th>
    </tr>
    <?php while ($usuario = $usuarios->fetch_object()) : ?>
        <!--Una fila por cada iteracion al bucle-->
        <tr>
            <td><?= $usuario->id; ?></td>
            <td><?= $usuario->nombre; ?></td>
            <td><?= $usuario->apellidos; ?></td>
            <td><?= $usuario->email; ?></td>
            <td><?= $usuario->estado; ?></td>
            <td>

                <a href="<?= base_url ?>usuario/eliminar&id=<?= $usuario->id ?>">
                    <div class="button_dlt_product">
                        <img src="<?= base_url ?>assets/img/vaciar-carrito.png" alt="Eliminar usuario">
                    </div>
                </a>

            </td>
        </tr>

    <?php endwhile; ?>
</table>