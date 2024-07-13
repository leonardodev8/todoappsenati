<?php

    class Todo{
        private $idtodo;
        private $descripcion;
        private $fechacrea;
        private $estado;
        private $idusuario;
        private $usuario;

        public function __get($campo){
            return $this->$campo;
        }

        public function __set($campo, $valor){
            $this->$campo = $valor;
        }
    }

?>