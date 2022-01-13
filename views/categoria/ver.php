<?php if (isset($categoria)): ?>
    <div class="tittle">
        <h1><?=$categoria->nombre?></h1>
    </div>
        <?php if ( $productos->num_rows == 0 ): ?>
            <p>No hay productos para mostrar.</p>
        <?php else : ?>
            <!--Ver productos de una categoria en específico-->
            <?php while( $producto = $productos->fetch_object() ): ?>
                <div class="product">

                    <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>">
                        <?php if( $producto->imagen != null ): ?>
                            <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>">
                        <?php else: ?>
                            <img src="<?=base_url?>assets/img/camiseta.png">
                        <?php endif; ?>
                        <h2><?=$producto->nombre?></h2>
                    </a>
                    
                    <?php $price = number_format($producto->precio, 0, '.', ','); ?>
                    <p><?=$price?> $</p>

                    <a href="<?=base_url?>carrito/add&id=<?=$producto->id?>">
                        <div class="button button_category">
                            Comprar
                        </div>
                    </a>
                    
                </div>
            <?php endwhile; ?>
        <?php endif ; ?>
<?php else : ?>
    <h1>La categoría no existe.</h1>
<?php endif ; ?>