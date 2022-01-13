<?php if( isset($gestion) ): ?>
    <div class="tittle">
        <h1>Gestionar pedidos</h1>
    </div>
<?php else: ?>
    <div class="tittle">
        <h1>Mis pedidos</h1>
    </div>
<?php endif; ?>

<table>
        <tr>
            <th>N° Pedido</th>
            <th>Costo</th>
            <th>Fecha</th>
            <th>Estado</th>
        </tr>
        <?php    
            while( $pedido = $pedidos->fetch_object() ):
        ?>
            <tr>
                <td>
                <a href="<?=base_url?>pedido/detalle&id=<?=$pedido->id?>"><?=$pedido->id?></a>
                </td>

                <td>
                    <?php $price = number_format($pedido->costo, 0, '.', ','); ?>
                    <?=$price.' $'?>
                </td>

                <td>
                    <?=$pedido->fecha?>
                </td>

                <td>
                    <?=Utils::showStatus($pedido->estado)?>
                </td>
            </tr>
            
            <?php endwhile; ?>
        
    </table>