<div class="tittle">
    <h1>Gestionar Categorías</h1>
</div>

<a href="<?=base_url?>categoria/crear">
    <div class="button button_small">
        <div class="icons_category">
            <img src="<?=base_url?>assets/img/boton-agregar.png" alt="Crear categoria">
        </div>
        Crear categoría
    </div>
</a>

<table>
    <!--Encabezados de tabla-->
        <tr>
            <th>ID</th>
            <th>NOMBRE</th>
        </tr>
    <?php while($categoria = $categorias->fetch_object()): ?>
        
        <!--Una fila por cada iteracion al bucle-->
        <tr>
            <td><?=$categoria->id;?></td>
            <td><?=$categoria->nombre;?></td>
        </tr>
        
    <?php endwhile; ?>
</table>