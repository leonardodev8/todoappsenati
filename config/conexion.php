<?php

    class Conexion{

        //Atributos
        private $servidor = "localhost";
        private $basedatos = "todolist";
        private $codificacion = "utf8";
        private $usuario = "root";
        private $clave = "";

        public function Conectar(){
            // PDO en MySQL:
            // "mysql:host=localhost;dbname=alquiler_peliculas;charset=utf8...
            $cn = new PDO("mysql:host=" . $this->servidor . ";dbname=" . $this->basedatos 
            . ";charset=" . $this->codificacion, $this->usuario, $this->clave);

            return $cn;
        }

    }

?>