<?php
    // crea una sesión o reanuda la actual basada en un identificador de sesión pasado mediante una petición GET o POST
    session_start();

    require_once '../models/todo.entidad.php';
    require_once '../models/todo.model.php';

    $objTodo = new Todo(); // Atributos
    $objTodoModel = new TodoModel(); // Métodos

    // Si existe una operacion (tarea) 
    if(isset($_GET['operacion'])){

        if($_GET['operacion'] == 'listartodos'){
            
            $tabla = $objTodoModel->listarTodos();

            foreach($tabla as $fila){
                echo '<tr class="' . ($fila->estado == 'F' ? 'todo-finalizado' : '') . '">';
                    echo '<td>'. $fila->descripcion .'</td>';
                    echo '<td>'. $fila->fechacrea .'</td>';
                    echo '<td>'. $fila->usuario .'</td>';
                    echo '<td>'. $fila->estado .'</td>';
                    echo '<td><button type="button" class="finalizar btn border-0 text-success '.($fila->estado == 'F' ? 'disabled' : '').'" data-idtodo="'. $fila->idtodo .'"><i class="bi bi-check-circle-fill"></i></button></td>';
                    echo '<td><button type="button" class="eliminar btn border-0 text-danger" data-idtodo="'. $fila->idtodo .'"><i class="bi bi-trash-fill"></i></button></td>';
                echo '</tr>';
            }

        }

        if($_GET['operacion'] == 'registrartodos'){

            $descripcion = $_GET['descripcion'];
            $idusuario = $_SESSION['idusuario'];

            $registro = $objTodoModel->registrarTodos($descripcion, $idusuario);

            echo json_encode($registro);

        }

        if($_GET['operacion'] == 'finalizartodos'){

            $idtodo = $_GET['idtodo'];

            $registro = $objTodoModel->finalizarTodos($idtodo);

            echo json_encode($registro);

        }

        if($_GET['operacion'] == 'eliminartodos'){

            $idtodo = $_GET['idtodo'];

            $registro = $objTodoModel->eliminarTodos($idtodo);

            echo json_encode($registro);

        }

    }

?>