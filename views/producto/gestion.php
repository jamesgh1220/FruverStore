<div class="tittle">
    <h1>Gestión de productos</h1>
</div>
<a href="<?= base_url ?>producto/crear">
    <div class="button button_small">
        <div class="icons_category">
            <img src="<?= base_url ?>assets/img/boton-agregar.png" alt="Crear categoria">
        </div>
        Crear producto
    </div>
</a>


<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete') : ?>
    <strong class="alert_green">El producto se ha creado correctamente.</strong>
<?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete') : ?>
    <strong class="alert_red">Error creando el producto .</strong>
<?php endif;
Utils::deleteSession('producto');
?>

<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <strong class="alert_green">El producto se ha borrado correctamente.</strong>
<?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete') : ?>
    <strong class="alert_red">Error borrando el producto.</strong>
<?php endif;
Utils::deleteSession('delete');
?>

<table>
    <!--Encabezados de tabla-->
    <tr>
        <th>ID</th>
        <th>NOMBRE</th>
        <th>DESCRIPCIÓN</th>
        <th>PRECIO</th>
        <th>ESTADO</th>
        <th>STOCK</th>
        <th>ACCIONES</th>
    </tr>
    <?php while ($producto = $productos->fetch_object()) : ?>
        <!--Una fila por cada iteracion al bucle-->
        <tr>
            <td><?= $producto->id; ?></td>
            <td><?= $producto->nombre; ?></td>
            <td><?= $producto->descripcion; ?></td>
            <?php $price = number_format($producto->precio, 0, '.', ','); ?>
            <td><?= $price ?>$</td>
            <td><?= $producto->estado ?></td>
            <td><?= $producto->stock; ?></td>
            <td>

                <a href="<?= base_url ?>producto/editar&id=<?= $producto->id ?>">
                    <div class="button_edit_product">
                        <img src="<?= base_url ?>assets/img/boton-editar.png" alt="Editar producto">
                    </div>
                </a>

                <a href="<?= base_url ?>producto/eliminar&id=<?= $producto->id ?>">
                    <div class="button_dlt_product">
                        <img src="<?= base_url ?>assets/img/vaciar-carrito.png" alt="Eliminar producto">
                    </div>
                </a>

            </td>
        </tr>

    <?php endwhile; ?>
</table>