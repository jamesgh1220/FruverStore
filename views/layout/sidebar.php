<!--BARRA LATERAL-->
<aside id="lateral">

    <div id="login" class="block_aside">
        <h3>Mi carrito</h3>
        <ul>
            <?php $stats = Utils::statsCarrito(); ?>

            <li>
                Productos (<?= $stats['count'] ?>)
            </li>
            <div class="icons">
                <img src="<?= base_url ?>/assets/img/moda.png" alt="Ver Productos">
            </div>

            <?php $price = number_format($stats['total'], 0, '.', ','); ?>

            <li>
                Total: <?= $price ?> $
            </li>
            <div class="icons">
                <img src="<?= base_url ?>/assets/img/boton-de-dinero.png" alt="Ver Productos">
            </div>

            <a href="<?= base_url ?>carrito/index">
                <div class="button button_lateral">
                    <li>
                        Ver el carrito
                    </li>
                    <div class="icons">
                        <img src="<?= base_url ?>/assets/img/carrito.png" alt="Ver Productos">
                    </div>
                </div>
            </a>

            <a href="<?= base_url ?>carrito/delete_all">
                <div class="button button_lateral">
                    <li>
                        Vaciar carrito
                    </li>
                    <div class="icons">
                        <img src="<?= base_url ?>/assets/img/eliminar.png" alt="Ver Productos">
                    </div>
                </div>
            </a>

        </ul>
    </div>

    <div id="login" class="block_aside">


        <?php if (isset($_SESSION['error_login']) && !isset($_SESSION['identity'])) : ?>
            <strong class="alert_red">Registro fallido, introduce bien los datos.</strong>
        <?php endif; ?>
        <?php Utils::deleteSession('error_login'); ?>

        <?php if (!isset($_SESSION['identity'])) : ?>
            <h3>Entrar a la Web</h3>

            <div class="form_login">
                <form action="<?= base_url ?>usuario/login" method="POST">

                    <label for="email">Email:</label>
                    <input type="email" name="email">

                    <label for="password">Contraseña:</label>
                    <input type="password" name="password">

                    <input type="submit" value="Enviar">

                </form>
            </div>

        <?php else : ?>
            <h3><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellidos ?></h3>
        <?php endif; ?>

        <ul>

            <?php if (isset($_SESSION['admin'])) : ?>

                <a href="<?= base_url ?>usuario/gestion">
                    <div class="button button_lateral_login">
                        <li>
                            Gestionar usuarios
                        </li>
                        <div class="icons">
                            <img src="<?= base_url ?>/assets/img/ajuste.png" alt="Ver Productos">
                        </div>
                    </div>
                </a>

                <a href="<?= base_url ?>categoria/index">
                    <div class="button button_lateral_login">
                        <li>
                            Gestionar categorias
                        </li>
                        <div class="icons">
                            <img src="<?= base_url ?>/assets/img/ajuste.png" alt="Ver Productos">
                        </div>
                    </div>
                </a>

                <a href="<?= base_url ?>producto/gestion">
                    <div class="button button_lateral_login">
                        <li>
                            Gestionar productos
                        </li>
                        <div class="icons">
                            <img src="<?= base_url ?>/assets/img/ajuste.png" alt="Ver Productos">
                        </div>
                    </div>
                </a>

                <a href="<?= base_url ?>pedido/gestion">
                    <div class="button button_lateral_login">
                        <li>
                            Gestionar pedidos
                        </li>
                        <div class="icons">
                            <img src="<?= base_url ?>/assets/img/ajuste.png" alt="Ver Productos">
                        </div>
                    </div>
                </a>

            <?php endif; ?>

            <?php if (isset($_SESSION['identity'])) : ?>

                <a href="<?= base_url ?>pedido/mis_pedidos">
                    <div class="button button_lateral_login">
                        <li>
                            Mis pedidos
                        </li>
                        <div class="icons">
                            <img src="<?= base_url ?>/assets/img/lista-numerada.png" alt="Ver Productos">
                        </div>
                    </div>
                </a>

                <a href="<?= base_url ?>usuario/logout">
                    <div class="button button_lateral_login">
                        <li>
                            Cerrar sesión
                        </li>
                        <div class="icons">
                            <img src="<?= base_url ?>/assets/img/salida.png" alt="Ver Productos">
                        </div>
                    </div>
                </a>

            <?php else : ?>

                <a href="<?= base_url ?>usuario/registro">
                    <div class="button button_lateral">
                        <li>
                            Regístrate aquí
                        </li>
                        <div class="icons">
                            <img src="<?= base_url ?>/assets/img/registrarse.png" alt="Ver Productos">
                        </div>
                    </div>
                </a>
            <?php endif; ?>

        </ul>

    </div>
</aside>

<!--CONTENIDO PPAL CENTRAL-->
<div id="central">