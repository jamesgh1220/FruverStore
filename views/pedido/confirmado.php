<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete' ): 
            Utils::statsCarrito();
            $stats['count'] = 0;
            $stats['total'] = 0;
?>
    <h1>Tu pedido ha sido confirmado.</h1>
    <p>Tu pedido ha sido recibido y guardado con éxito, una vez 
        realices la transferencia bancaria a la cuenta 123456789 con el costo
        del pedido, será procesado y enviado.
    </p>
    <br>

    <?php if( isset($pedido) ): ?>
        <?php $price = number_format($pedido->costo, 0, '.', ','); ?>
        <h3>Datos del pedido:</h3><br>
            Número del pedido: <?=$pedido->id?><br>
            Total a pagar: <?=$price?> $<br>
            Productos: <br><br>
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
            <?php while($producto = $productos->fetch_object()): ?>
                <tr>
                    <td>
                        <?php if( $producto->imagen != null ): ?>
                            <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="img_carrito">
                        <?php else: ?>
                            <img src="<?=base_url?>assets/img/camiseta.png" class="img_carrito">                
                        <?php endif; ?>
                    </td>

                    <td>
                        <a href="<?=base_url?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
                    </td>

                    <td>
                        <?php $price = number_format($producto->precio, 0, '.', ','); ?>
                        <?=$price.' $'?>
                    </td>

                    <td>
                        <?=$producto->unidades?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>    
        
    <?php endif; ?>
    
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete' ): ?>
    <h1>Tu pedido NO ha podido procesarse.</h1>
<?php endif; ?>

<?php Utils::deleteSession('carrito'); ?>