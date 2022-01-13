<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tienda de Ropa</title>
        <link rel="stylesheet" href="assets/css/styles.css">
    </head>
    <body>

        <div id="container">

            <!--CABECERA-->
            <header id="header">
                <div id="logo">
                    <img src="assets/img/Logo1.png" alt="Logo Tienda">
                    <a href="index.php">
                        Tienda de Ropa
                    </a>
                </div>

            </header>

            <!--MENU-->
            <nav id="menu">
                <ul>
                    <li>
                        <a href="">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Categoria 1
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Categoria 2
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Categoria 3
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Categoria 4
                        </a>
                    </li>
                    <li>
                        <a href="">
                            Categoria 5
                        </a>
                    </li>
                </ul>
            </nav>

            <div id="content">

                <!--BARRA LATERAL-->
                <aside id="lateral">
                    
                    <div id="login" class="block_aside">
                        <h3>Entrar a la Web</h3>
                        <form action="#" method="POST">
                            <label for="email">Email:</label>
                            <input type="email" name="email">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password">
                            <input type="submit" value="Enviar">
                        </form>

                        <ul>
                            <li>
                                <a href="#">Mis pedidos</a>
                            </li>
                            <li>
                                <a href="#">Gestionar pedidos</a>
                            </li>
                            <li>
                                <a href="#">Gestionar categorias</a>
                            </li>
                        </ul>
                        
                    </div>
                </aside>
                
                <!--CONTENIDO PPAL CENTRAL-->
                <div id="central">
                    <h1>Productos Destacados:</h1>
                    <div class="product">

                        <img src="assets/img/Logo3.png">
                        <h2>Camiseta Azul</h2>
                        <p>30.000 Pesos</p>
                        <a href="" class="button">Comprar</a>

                    </div>

                    <div class="product">

                        <img src="assets/img/Logo3.png">
                        <h2>Camiseta Verde</h2>
                        <p>40.000 Pesos</p>
                        <a href="" class="button">Comprar</a>

                    </div>

                    <div class="product">

                        <img src="assets/img/Logo3.png">
                        <h2>Camiseta Amarilla</h2>
                        <p>20.000 Pesos</p>
                        <a href="" class="button">Comprar</a>

                    </div>

                    <div class="product">

                        <img src="assets/img/Logo3.png">
                        <h2>Camiseta Roja</h2>
                        <p>5.000 Pesos</p>
                        <a href="" class="button">Comprar</a>

                    </div>

                </div>

            </div>
            
            <!--PIE DE PAGINA-->
            <footer id="footer">
                <p>Desarrollado por John James Gallego Hernández &copy; <?=date('Y')?></p>
            </footer>

        </div>

    </body>
</html>