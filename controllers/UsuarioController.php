<?php

require_once 'models/usuario.php';

class usuarioController{

    public function registro(){
        require_once 'views\usuario\registro.php';
    }

    public function save(){
        if ( isset($_POST) ) {
            $nombre = isset( $_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset( $_POST['apellidos']) ? $_POST['apellidos'] : false;
            $email = isset( $_POST['email']) ? $_POST['email'] : false;
            $password = isset( $_POST['password']) ? $_POST['password'] : false;

            if ( isset($_SESSION['errores']) && !empty($_SESSION['errores']) ) {
                $errores = $_SESSION['errores'];
            }else {
                $errores = array();
            }

            if ( !(empty($nombre)) && !is_numeric($nombre) && !preg_match("/[0-9]/". $nombre) ) {
                $nombre_validado = true;
            } else {
                $nombre_validado = false;
                $errores['nombre']= 'El nombre es incorrecto';
            }

            if (!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/". $apellidos)) {
                $apellidos_validado = true;
            } else {
                $apellidos_validado = false;
                $errores['apellidos']= 'Los apellidos son incorrectos';
            }

            if (!empty($email) && filter_var($email. FILTER_VALIDATE_EMAIL)) {
                $email_validado = true;
            } else {
                $email_validado = false;
                $errores['email']= 'El email es incorrecto';
            }

            if (!empty($password) && strlen($password) >= 6){
                $password_validado = true;
            } else {
                $password_validado = false;
                $errores['password']= 'La contraseña es incorrecta';
            }

            if ( count($errores) == 0 ){
            
            $usuario = new Usuario();
            $usuario->setNombre($nombre);
            $usuario->setApellidos($apellidos);
            $usuario->setEmail($email);
            $usuario->setPassword($password);
            $save = $usuario->save();

                if ( $save ) {
                    $_SESSION['register'] = "complete";
                }else {
                    $_SESSION['register'] = "failed";
                }
            }else {
                $_SESSION['errores'] = $errores;
                $_SESSION['register'] = "failed";
            }

        }else{
            $_SESSION['register'] = "failed";
        }
        header("Location:".base_url.'usuario/registro');
    }

    public function login(){
        if ( isset($_POST) ) {
            //identificar al usuario & consulta base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $identity = $usuario->login();
            //crear sesion
            if ( $identity && is_object($identity) && $identity->estado === 'Activo') {
                $_SESSION['identity'] = $identity;

                if ( $identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            }else {
                $_SESSION['error_login'] = 'Identificación fallida';
            }
        }
        header('Location:'.base_url);
    }

    public function gestion(){
        Utils::isAdmin();

        $usuario = new Usuario();
        $usuarios = $usuario->getAll();

        require_once 'views/usuario/gestion.php';
    }

    public function eliminar(){
        Utils::isAdmin();

        if ( isset($_GET['id']) ) {
            $id = $_GET['id'];
            $usuario = new Usuario();
            $usuario->setId($id);
            $delete = $usuario->delete();

            if ( $delete ) {
                $_SESSION['delete'] = 'complete';
            }else {
                $_SESSION['delete'] = 'failed';
            }
        }else {
            $_SESSION['delete'] = 'failed';
        }
        header('Location:'.base_url.'usuario/gestion');
    }

    public function logout(){
        if ( isset($_SESSION['identity']) ) {
            unset($_SESSION['identity']);
        }
        
        if ( isset($_SESSION['admin']) ) {
            unset($_SESSION['admin']);
        }

        header('Location:'.base_url);
    }
    
}