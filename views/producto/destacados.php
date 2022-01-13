<div class="buscador">

    <?php if (!isset($_POST['busqueda'])) : ?>
        <div class="login">
            <h3>Buscar productos.</h3>
        </div>
    <?php else : ?>
        <div class="login">
            <h3>Búsqueda: <?= $_POST['busqueda'] ?></h3>
        </div>
    <?php endif; ?>

    <form action="<?= base_url ?>producto/buscar" method="POST">
        <input type="text" name="busqueda"><br>
        <input type="submit" name="submit" value="Buscar">
    </form>
</div>

<div class="tittle">
    <h1>Algunos de nuestros productos:</h1>
</div>

<?php if (isset($_POST['busqueda']) && $productos->num_rows == 0) : ?>
    <h1>Sin resultados</h1>
<?php endif; ?>

<?php while ($producto = $productos->fetch_object()) : ?>

    <div class="product">
        <a href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>">
            <?php if ($producto->imagen != null) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>">
            <?php else : ?>
                <img src="<?= base_url ?>assets/img/camiseta.png">
            <?php endif; ?>
            <h2><?= $producto->nombre ?></h2>
        </a>
        <p><?= $producto->descripcion ?></p>
        <?php $price = number_format($producto->precio, 0, '.', ','); ?>
        <p><?= $price ?> $</p>
        <a href="<?= base_url ?>carrito/add&id=<?= $producto->id ?>">
            <div class="button button_category">
                Comprar
            </div>
        </a>
    </div>
<?php endwhile; ?>