<?php if( isset($_SESSION['identity']) ): ?>
    <div class="tittle">
        <h1>Realizar pedido</h1>
    </div>

    <a href="<?=base_url?>carrito/index">
            <div class="button button_pedido car_pedido">
                <img src="<?=base_url?>assets/img/carrito.png" alt="">
            </div>
    </a>
    
<br><br>

    <h1>Dirección para el envío:</h1>

    <div class="form_container">
        <form action="<?=base_url?>pedido/add" method="POST">
            <label for="departamento">Departamento:</label>
            <input type="text" name="departamento" required>

            <label for="municipio">Municipio:</label>
            <input type="text" name="municipio" required>

            <label for="direccion">Direccion:</label>
            <input type="text" name="direccion" required>

            <input type="submit" value="Confirmar pedido">
            
        </form>
    </div>

<?php else: ?>
    <h1>Necesitas estar identificado</h1>
    <p>Necesitar estar logueado en la Web para poder realizar tu pedido.</p>
<?php endif; ?>

