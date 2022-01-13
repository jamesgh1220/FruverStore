<?php if (isset($carrito) && count($carrito) >= 1) : ?>
    <div class="tittle">
        <h1>Carrito de la compra:</h1>
    </div>

    <?php if (isset($_SESSION['fail_up']) && $_SESSION['fail_up'] == 'fail') : ?>
        <strong class="alert_red">No hay más stock de este producto.</strong><br><br>
    <?php endif; ?>

    <?php Utils::deleteSession('fail_up'); ?>

    <div class="table_productos">

        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Eliminar</th>
            </tr>
            <?php
            foreach ($carrito as $indice => $elemento) :
                $producto = $elemento['producto'];
            ?>
                <tr>
                    <td>
                        <a href="<?=base_url?>producto/ver&id=<?= $producto->id ?>">
                            <?php if ($producto->imagen != null) : ?>
                                <img src="<?=base_url?>uploads/images/<?= $producto->imagen ?>" class="img_carrito">
                            <?php else : ?>
                                <img src="<?=base_url?>assets/img/camiseta.png" class="img_carrito">
                            <?php endif; ?>
                        </a>
                    </td>

                    <td>
                        <a href="<?=base_url?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                    </td>

                    <td>
                        <?php $price = number_format($producto->precio, 0, '.', ','); ?>
                        <?= $price . ' $' ?>
                    </td>

                    <td>
                        <div class="unidades">
                            <?= $elemento['unidades'] ?>
                        </div>
                        <div class="upDown">
                            <div class="updown_unidades">
                                <div class="icons_carrito_up">
                                    <a href="<?=base_url?>carrito/up&index=<?= $indice ?>">
                                        <img src="<?=base_url?>assets/img/boton-agregar.png" alt="Sumar">
                                    </a>
                                </div>
                                <div class="icons_carrito_down">
                                    <a href="<?=base_url?>carrito/down&index=<?= $indice ?>">
                                        <img src="<?=base_url?>assets/img/down.png" alt="Restar">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>
                        <a href="<?=base_url?>carrito/delete&index=<?= $indice ?>">
                            <div class="button_dlt_product">
                                <img src="<?=base_url?>assets/img/vaciar-carrito.png" alt="Eliminar producto">
                            </div>
                        </a>
                    </td>
                </tr>

            <?php endforeach; ?>

        </table>

    </div>
    <br><br>

    <a href="<?=base_url?>carrito/delete_all">
        <div class="button_delete">
            <img src="<?=base_url?>assets/img/vaciar-carrito.png" alt="">
            Vaciar carrito
        </div>
    </a>

    <div class="total_carrito">
        <?php $stats = Utils::statsCarrito();
        $price = number_format($stats['total'], 0, '.', ',');
        ?>
        <h3>Precio Total: <?= $price ?> $</h3>

        <a href="<?=base_url?>pedido/hacer">
            <div class="button button_pedido">
                <img src="<?=base_url?>assets/img/boton-marcado.png" alt="">
                Hacer pedido
            </div>
        </a>

    </div>

<?php else : ?>
    <h1>El carrito de compras se encuentra vacío, añade algún producto.</h1>
<?php endif; ?>