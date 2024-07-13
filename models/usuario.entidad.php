<?php

    class Usuario{
        private $idusuario;
        private $nombre;
        private $apellido;
        private $usuario;
        private $clave;
        private $activo;

        public function __get($campo){
            return $this->$campo;
        }

        public function __set($campo, $valor){
            $this->$campo = $valor;
        }
    }

?>