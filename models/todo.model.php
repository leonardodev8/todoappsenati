<?php
    require('../config/conexion.php');

    class TodoModel{
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

        public function listarTodos(){
            try{
                // Consulta MySQL
                $sql = "call listar_todolist();";
                // Array donde almancenaremos los resultados
                $dtTodo = array();
                // Prepara la consulta
                $resultado = $this->pdo->prepare($sql);
                // Ahora lo ejecutamos
                // El metodo EXECUTE lleva sobrecarga si la consulta lo necesita
                $resultado->execute();

                // El objeto $resultado tiene todas los datos, los cuales lo vamos a almacenar en el array dtTodo
                foreach($resultado->fetchAll(PDO::FETCH_OBJ) as $fila){
                    // Instancia de la entidad Todo (Utilizaremos __SET)
                    $objTodo = new Todo();

                    $objTodo->__set("idtodo", $fila->idtodo);
                    $objTodo->__set("descripcion", $fila->descripcion);
                    $objTodo->__set("fechacrea", $fila->fechacrea);
                    $objTodo->__set("estado", $fila->estado);
                    $objTodo->__set("idusuario", $fila->idusuario);
                    $objTodo->__set("usuario", $fila->usuario);

                    // Guardar cada objeto en el array dtTodo
                    $dtTodo[] = $objTodo;
                }
                // Retornar el array con todos los datos 
                return $dtTodo;

            } catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function registrarTodos($descripcion, $idusuario){
            try{
                // Consulta MySQL
                $sql = "call registrar_todolist(?,?);";
                // Prepara la consulta
                $resultado = $this->pdo->prepare($sql);
                // Ahora lo ejecutamos y pasamos los parámetros correspondientes
                $resultado->execute(array($descripcion, $idusuario));

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function finalizarTodos($idtodo){
            try{

                $sql = "call finalizar_todolist(?);";

                $resultado = $this->pdo->prepare($sql);

                $resultado->execute(array($idtodo));

            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function eliminarTodos($idtodo){
            try{

                $sql = "call eliminar_todolist(?);";

                $resultado = $this->pdo->prepare($sql);

                $resultado->execute(array($idtodo));

            }catch(Exception $e){
                die($e->getMessage());
            }
        }
    }

    // // Probamos el TodoModel
    // require 'todo.entidad.php';
    // $objTodo = new TodoModel();

    // var_dump($objTodo->listarTodos();
?>