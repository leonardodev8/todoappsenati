<?php
    // crea una sesión o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST
    session_start();

    require_once '../models/usuario.entidad.php';
    require_once '../models/usuario.model.php';

    $objUsuario = new Usuario(); // Atributos
    $objUsuarioModel = new UsuarioModel(); // Métodos

    // Si existe una operacion (tarea) 
    if(isset($_GET['operacion'])){

        if($_GET['operacion'] == 'login'){
            
            $login = $objUsuarioModel->login($_GET['usuario'],$_GET['clave']);

            if(!$login){
                //falla en el acceso
                // echo json_encode($login);

                $_SESSION['estado']       = false;
                $_SESSION['idusuario']    = "";
                $_SESSION['usuario']      = "";
            }
            else{
                //Acceso Correcto
                $_SESSION['estado']       = true;
                $_SESSION['idusuario']    = $login->idusuario;
                $_SESSION['usuario']      = $login->usuario;

                echo json_encode($login);
            }
            
        }

    }

?>