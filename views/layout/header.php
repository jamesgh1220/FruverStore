<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fruver Store</title>
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Cabin&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="<?=base_url?>assets\css\styles.css">
    </head>
    <body>

        <div id="container">

            <!--CABECERA-->
            <header id="header">
                <div id="logo">
                    <a href="<?=base_url?>">
                        <img src="<?=base_url?>uploads/images/FRUVER_STORE.svg" alt="Logo Tienda">
                    </a>
                </div>

            </header>

            <!--MENU-->
            <?php $categorias = Utils::showCategorias(); ?>

            <nav id="menu">
                <ul>
                    <li>
                        <a href="<?=base_url?>">
                            Inicio
                        </a>
                    </li>
                    <?php while($categoria = $categorias->fetch_object()): ?>
                        <li>
                            <a href="<?=base_url?>categoria/ver&id=<?=$categoria->id?>">
                                <?=$categoria->nombre?>
                            </a>
                    </li>
                    <?php endwhile; ?>
                </ul>
            </nav>

            <div id="content">