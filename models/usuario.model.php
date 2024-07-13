<?php
    require('../config/conexion.php');

    class UsuarioModel{
        private $pdo;

        public function __construct(){
            try{
                // 1. Instancia de la clase Conexion
                $objConexion = new Conexion();

                // 2. La conexion se guarda en el objeto PDO
                $this->pdo = $objConexion->Conectar();

                // 3. Se configura la conexion
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function login($usuario, $clave){
            try{
                // Consulta ejecutada
                $sql = "call login_usuario(?,?);";

                // Prepara la consulta
                $resultado = $this->pdo->prepare($sql);

                // Ahora lo ejecutamos
                $resultado->execute(array($usuario, $clave));

                // Almacenamos los datos de la consulta en la variable registro
                $registro = $resultado->fetch(PDO::FETCH_OBJ);

                return $registro;

            } catch(Exception $e){
                die($e->getMessage());
            }
        }
    }

    // // Probamos el UsuarioModel
    // require 'usuario.entidad.php';
    // $objUsuario = new UsuarioModel();

    // var_dump($objUsuario->login('leonardo','1234'));
?>