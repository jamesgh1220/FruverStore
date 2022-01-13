<?php

require_once 'models/pedido.php';
require_once 'models/producto.php';

class pedidoController{
    public function hacer(){

        require_once 'views/pedido/hacer.php';
    }

    public function add(){
        if ( isset($_SESSION['identity']) ) {
            $usuario_id = $_SESSION['identity']->id;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : '';
            $municipio = isset($_POST['municipio']) ? $_POST['municipio'] : '';
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';

            $stats = Utils::statsCarrito();
            $costo = $stats['total'];

            if ( $departamento && $municipio && $direccion ) {
                //Guardar datos en bd
                $pedido = new Pedido();
                $pedido->setUsuario_Id($usuario_id);
                $pedido->setDepartamento($departamento);
                $pedido->setMunicipio($municipio);
                $pedido->setDireccion($direccion);
                $pedido->setCosto($costo);

                $save = $pedido->save();
                

                //Guardar linea de pedido
                $save_linea = $pedido->save_linea();
                

                if ( $save && $save_linea ) {
                    $_SESSION['pedido'] = 'complete';
                }else {
                    $_SESSION['pedido'] = 'failed';
                }

            }else {
                $_SESSION['pedido'] = 'failed';
            }

            header('Location:'.base_url.'pedido/confirmado');
            
        }else {
            header('Location:'.base_url);
        }
    }

    public function confirmado(){
        if ( isset($_SESSION['identity']) ) {
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_Id($identity->id);
            $pedido = $pedido->getOneByUser();
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($pedido->id);

             while ( $producto = $productos->fetch_object() ) {
                 $prod = new Producto();
                 $prod->setId($producto->id);
                 $prod = $prod->getOne();
                 $stock_aux = (int)$producto->stock;
                 $stock = $stock_aux - (int)$producto->unidades;
                 if ( $stock == 0 ) {
                    Utils::deleteStock($prod->id);
                    Utils::deleteProd($prod->id);
                }
             }
            $productos = $pedido_productos->getProductosByPedido($pedido->id);
        }
        require_once 'views/pedido/confirmado.php';
    }

    public function mis_pedidos(){
        Utils::isIdentity();
        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        //Sacar los pedidos del usuario
        $pedido->setUsuario_Id($usuario_id);
        $pedidos = $pedido->getAllByUser();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function detalle(){
        Utils::isIdentity();

        if ( isset( $_GET['id']) ) {
            $id = $_GET['id'];

            if ( isset($_SESSION['admin']) && !empty($_SESSION['admin']) ) {
                $admin = $_SESSION['admin'];
            }else {
                $admin = array();
            }

            //Sacar el pedido
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido = $pedido->getOne();

            //Sacar los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductosByPedido($id);


            require_once 'views/pedido/detalle.php';
        }else{
            header('Location:'.base_url.'pedido/mis_pedidos');
        }

    }

    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        require_once 'views/pedido/mis_pedidos.php';
    }

    public function estado(){
        Utils::isAdmin();

        if ( isset($_POST['pedido_id']) && isset($_POST['estado']) ) {
            //Recoger datos formulario
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            //Update del pedido
            $pedido = new Pedido();
            $pedido->setId($id);//Con el id con el que vamos a trabajar
            $pedido->setEstado($estado);
            $pedido->edit();

            header('Location:'.base_url.'pedido/detalle&id='.$id);
        }else{
            header('Location:'.base_url);
        }

    }

}

?>