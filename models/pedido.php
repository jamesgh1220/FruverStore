<?php

class Pedido{
    private $id;
    private $usuario_id;
    private $departamento;
    private $municipio;
    private $direccion;
    private $costo;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getUsuario_Id(){
        return $this->usuario_id;
    }

    public function setUsuario_Id($usuario_id){
        $this->usuario_id = $usuario_id;
    }

    public function getDepartamento(){
        return $this->departamento;
    }

    public function setDepartamento($departamento){
        $this->departamento = $this->db->real_escape_string($departamento);
    }

    public function getMunicipio(){
        return $this->municipio;
    }

    public function setMunicipio($municipio){
        $this->municipio = $this->db->real_escape_string($municipio);
    }

    public function getdireccion(){
        return $this->direccion;

    }

    public function setdireccion($direccion){
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    public function getCosto(){
        return $this->costo;
    }

    public function setCosto($costo){
        $this->costo = $costo;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getFecha(){
        return $this->fecha;
    }

    public function setFecha($fecha){
        $this->fecha = $fecha;
    }

    public function getHora(){
        return $this->hora;
    }

    public function setHora($hora){
        $this->hora = $hora;
    }

    public function getOne(){
        $sql = "SELECT * FROM pedidos WHERE id = {$this->getId()};";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getAll(){
        $sql = "SELECT * FROM pedidos ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getOneByUser(){
        $sql = "SELECT p.id, p.costo FROM pedidos p "
        //."INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
        ."WHERE p.usuario_id = {$this->getUsuario_Id()} ORDER BY id DESC LIMIT 1;";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
        ."WHERE p.usuario_id = {$this->getUsuario_Id()} ORDER BY id DESC;";
        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function getProductosByPedido($id){
        /*$sql = "SELECT * FROM productos WHERE id IN "
                ."(SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id})";*/
        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
                ."INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
                ."WHERE lp.pedido_id = {$id}";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function save(){
        $sql = "INSERT INTO pedidos VALUES(null, {$this->getUsuario_Id()}, '{$this->getDepartamento()}', '{$this->getMunicipio()}', '{$this->getDireccion()}', {$this->getCosto()}, 'confirm', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);
        $result = false;

        if ( $save ) {
            $result = true;
        }
        return $result;
    }

    public function save_linea(){
        //Esto saca la PK o campo id de el ultimo insert que se hizo en pedido
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        //var_dump($query);
        //die();
        $pedido_id = $query->fetch_object()->pedido;
        $compra = $_SESSION['carrito'];

        if ( is_array($compra) || is_object($compra) ){
            foreach( $compra as $elemento ){
                $producto = $elemento['producto'];
                $insert = "INSERT INTO lineas_pedidos VALUES(null, {$pedido_id}, {$producto->id}, {$elemento['unidades']});";
                $save = $this->db->query($insert);
            }
            $result = false;
            if ( $save ) {
                $result = true;
            }
            return $result;
        }

    }

    public function edit(){
        $sql = "UPDATE pedidos SET estado = '{$this->getEstado()}'";
        $sql .= " WHERE id = {$this->getId()};";

        $save = $this->db->query($sql);
        $result = false;

        if ( $save ) {
            $result = true;
        }
        return $result;
    }
}

?>