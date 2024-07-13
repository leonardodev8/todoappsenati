<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/inicio.css">
</head>
<body class="gradient-custom vh-100">

    <header>
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-10">
                    <h2 class="mb-5 text-light">Bienvenido <?php echo $_SESSION['usuario']; ?></h2>    
                </div>
                <div class="col-md-2">
                    <button id="btnlogout" class='btn btn-danger'>Cerrar sesión</button>
                </div>
            </div>
        </div>
    </header>

    <section class="container">
      <div class="py-5">
        <div class="row d-flex justify-content-center align-items-center">
          <div class="col card rounded-3">
            
              <div class="card-body p-4">

                <h4 class="text-center my-3 pb-3">To Do SENATI</h4>

                <div class="d-flex">
                    <input type="text" id="txtTarea" class="form-control me-4" placeholder="Nueva tarea">
                    <button id="btnagregar" class="add btn btn-info text-light fw-bold">Agregar</button>
                </div>

                <br />

                <table class="table mb-4">
                  <thead>
                    <tr>
                      <th>Tarea</th>
                      <th>Fecha Hora</th>
                      <th>Usuario</th>
                      <th>Estado</th>
                      <th colspan="2" class="text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="table-todos">
                  </tbody>
                </table>

              </div>
            
           </div>
        </div>
      </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>

        $(document).ready(function(){
          console.log("la página ha terminado de cargarse!!");
          listarTodos();
        });

        $("#btnlogout").click(function(){
          window.location.href = "../controllers/sesion.controller.php";
        });

        $("#btnagregar").click(function(){
          let descripcion = $("#txtTarea").val();
          crudTodos("registrar", descripcion);
          $("#txtTarea").val("");
        });

        $("#table-todos").on('click', '.finalizar', function(){
          let idtodo = $(this).attr("data-idtodo");
          crudTodos("finalizar", idtodo);
        });

        $("#table-todos").on('click', '.eliminar', function(){
          let idtodo = $(this).attr("data-idtodo");
          crudTodos("eliminar", idtodo);
        });

        function listarTodos(){

          $.ajax({
              method: "GET",
              url: "../controllers/todo.controller.php?operacion=listartodos",
          })
          .done(function( rpt ) {
              // console.log(rpt);
              $("#table-todos").html(rpt);
          })
          .fail(function() {
              console.log("error, vuelva a intentarlo");
          });
            
        }

        function crudTodos( operacion, parametro ){

          let crud_url = "";

          if(operacion == 'registrar')
            crud_url = "../controllers/todo.controller.php?operacion=registrartodos&descripcion=" + parametro;
          else if(operacion == 'finalizar')
            crud_url = "../controllers/todo.controller.php?operacion=finalizartodos&idtodo=" + parametro;
          else if(operacion == 'eliminar')
            crud_url = "../controllers/todo.controller.php?operacion=eliminartodos&idtodo=" + parametro;

          $.ajax({
              method: "GET",
              url: crud_url
          })
          .done(function (rpt){
              console.log("Tarea " + operacion);
              listarTodos();
          })
          .fail(function(){
              console.log("error, vuelva a intentarlo");
          });

        }
    </script>
</body>
</html>