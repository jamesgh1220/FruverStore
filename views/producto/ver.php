<?php if (isset($producto)): ?>
    <div class="tittle">
        <h1><?=$producto->nombre?></h1>
    </div>
        <div id="detail_product">
            <div class="image">
                <?php if( $producto->imagen != null ): ?>
                    <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>">
                <?php else: ?>
                    <img src="<?=base_url?>assets/img/camiseta.png">
                <?php endif; ?>
            </div>              
            <div class="data">
                <p class="description"><?=$producto->descripcion?></p>
                <?php $price = number_format($producto->precio, 0, '.', ','); ?>
                    <p><?=$price?> $</p>
                    <a href="<?=base_url?>carrito/add&id=<?=$producto->id?>" >
                        <div class="button">
                            Comprar
                        </div>
                    </a>
            </div>
            
        </div>

<?php else : ?>
    <h1>El producto no existe.</h1>
<?php endif ; ?>