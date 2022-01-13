<?php

class Usuario{

    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    //Conexion base de datos
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

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }

    public function getEmail(){
        return $this->email;
    }

    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }

    public function getPassword(){
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }

    public function setPassword($password){
        $this->password = $password;
    }

    public function getRol(){
        return $this->rol;
    }

    public function setRol($rol){
        $this->rol = $rol;
    }

    public function getEstado(){
        return $this->estado;
    }

    public function setEstado($estado){
        $this->estado = $estado;
    }

    public function getImagen(){
        return $this->imagen;
    }

    public function setImagen($imagen){
        $this->imagen = $imagen;
    }

    public function save(){
        $sql = "INSERT INTO usuarios VALUES(null, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', 'Activo', null);";
        $save = $this->db->query($sql);
        $result = false;

        if ( $save ) {
            $result = true;
        }
        return $result;
    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;
        //comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $login = $this->db->query($sql);

        if ( $login && $login->num_rows == 1 ) {
            $usuario = $login->fetch_object();
            //verificar contraseña
            $verify = password_verify($password, $usuario->password);
            
            if ( $verify ) {
                $result = $usuario;
            }
        }
        return $result;
    }

    public function getAll(){
        
        $sql = "SELECT * FROM usuarios";
        $usuarios = $this->db->query($sql);
        return $usuarios;

    }

    public function delete() {

        $sql = "UPDATE usuarios SET estado = 'Inactivo' WHERE id = {$this->id}";
        $delete = $this->db->query($sql);
        $result = false;

        if ( $delete ) {
            $result = true;
        }
        return $result;

    }

}
