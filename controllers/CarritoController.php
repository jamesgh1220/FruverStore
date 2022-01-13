<?php

require_once 'models/producto.php';

class carritoController{
    public function index(){
        if ( isset($_SESSION['carrito']) && !empty($_SESSION['carrito']) ) {
            $carrito = $_SESSION['carrito'];
        }else {
            $carrito = array();
        }
        require_once 'views/carrito/index.php';
    }

    public function add(){
        if ( isset($_GET['id']) ) {
            //El producto que quiero añadir a mi carrito
            $producto_id = $_GET['id'];
        }else {
            header('Location:'.base_url);
        }

        /*  Si ya existe la sesión, la recorre y si ya existía 
        $elemento['id_producto'] == $producto_id  suma 1 unidad  */
        if ( isset($_SESSION['carrito']) ) {
            $counter = 0;
            //Recorra la sesion carrito y en cada iteracion sacame el indice del array y el elemento
            foreach( $_SESSION['carrito'] as $indice => $elemento ){
                if ( $elemento['id_producto'] == $producto_id ) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $counter++;
                }
            }
        }
        /*  Si no existe la sesión, crea un nuevo producto  */
        if ( !isset($counter) || $counter == 0 ) {
            //Añadir cosas al carrito cuando todavía no existe
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();

            //Añadir al carrito
            if ( is_object($producto) ) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id,
                    "precio" => $producto->precio,
                    "unidades" => 1,
                    "producto" => $producto
                );
            }
        }
        header('Location:'.base_url.'carrito/index');
    }

    public function delete(){
        if ( isset($_GET['index']) ) {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);

            if ( ($_SESSION['carrito']) == null ) {
                Utils::statsCarrito();
                $stats['count'] = 0;
                $stats['total'] = 0;
            }
        }
        header('Location:'.base_url.'carrito/index');
    }

    public function up(){
        if ( isset($_GET['index']) ) {
            $index = $_GET['index'];
            $producto_id = $_SESSION['carrito'][$index]['id_producto'];
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();

            if ( $producto->stock > $_SESSION['carrito'][$index]['unidades'] ) {
                $_SESSION['carrito'][$index]['unidades']++;
            }else {
                $_SESSION['fail_up'] = 'fail';
                header('Location:'.base_url.'carrito/index');
            }
        }
        header('Location:'.base_url.'carrito/index');
    }

    public function down(){
        if ( isset($_GET['index']) ) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;

            if ( $_SESSION['carrito'][$index]['unidades'] == 0 ) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        header('Location:'.base_url.'carrito/index');
    }

    public function delete_all(){
        unset($_SESSION['carrito']);
        header('Location:'.base_url.'carrito/index');
    }

}

?>