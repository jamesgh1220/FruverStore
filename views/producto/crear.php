<?php if ( isset($edit) && isset($producto) && is_object($producto) ) : ?>
    <div class="tittle">
        <h1>Editar producto <?=$producto->nombre;?></h1>
    </div>
    <?php $url_action = base_url.'producto/save&id='.$producto->id; ?>
<?php else: ?>
    <div class="tittle">
        <h1>Crear nuevos productos</h1>
    </div>
    <?php $url_action = base_url.'producto/save';
    ?>
<?php endif; ?>

<div class="form_container">

    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" value="<?= isset( $producto ) && is_object($producto) ? $producto->nombre :'' ?>">

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion"><?= isset( $producto ) && is_object($producto) ? $producto->descripcion :'' ?></textarea>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" value="<?= isset( $producto ) && is_object($producto) ? $producto->precio :'' ?>">

        <?php if ( isset($edit) && isset($producto) && is_object($producto) ) : ?>
            <label for="precio">Estado:</label>
                <select name="estado">
                    <option value="Activo" <?= $producto->estado == 'Activo' ? 'selected' : '' ?>>Activo</option>
                    <option value="Inactivo" <?= $producto->estado == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
                </select>
        <?php else: ?>
            <label for="precio">Estado:</label>
                <select name="estado">
                    <option value="Activo">Activo</option>
                    <option value="Inactivo">Inactivo</option>
                </select>
        <?php endif; ?>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="<?= isset( $producto ) && is_object($producto) ? $producto->stock :'' ?>">

        <label for="nombre">Categoría:</label>
            <?php $categorias = Utils::showCategorias(); ?>
            <select name="categoria">
                <?php while($categoria = $categorias->fetch_object()): ?>
                    <option value="<?=$categoria->id?>" <?= isset( $producto ) && is_object($producto) && $categoria->id == $producto->categoria_id ? 'selected' : '' ?>>
                        <?=$categoria->nombre?>
                    </option>
                <?php endwhile; ?>
            </select>

        <label for="imagen">Imagen:</label>
            <?php if(isset( $producto ) && is_object($producto) &&!empty($producto->imagen) ) : ?>
                <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" class="thumb" >
            <?php endif; ?>
        <input type="file" name="imagen" >

        <input type="submit" value="Guardar">
    </form>
</div>