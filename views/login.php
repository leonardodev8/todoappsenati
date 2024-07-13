<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="bg-image vh-100">
      <div class="d-flex align-items-center h-100">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">
              <form class="bg-white rounded p-5">
                <!-- Usuario input -->
                <div class="mb-4">
                  <label class="form-label" for="txtusuario">Usuario</label>
                  <input type="email" id="txtusuario" class="form-control" />
                </div>

                <!-- Clave input -->
                <div class="mb-4">
                  <label class="form-label" for="txtclave">Clave</label>
                  <input type="password" id="txtclave" class="form-control" />
                </div>

                <!-- Login button -->
                <button type="button" id="btnLogin" class="btn btn-primary btn-block">Iniciar Sesión</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      $("#btnLogin").click(function(){
          loginUsuario();
      });

      function loginUsuario(){
        let usuario = $("#txtusuario").val();
        let clave = $("#txtclave").val();

        $.ajax({
          method: "GET",
          url: "../controllers/usuario.controller.php?operacion=login&usuario="+usuario+"&clave="+clave,
        })
        .done(function( rpt ) {
          // console.log(rpt);
          if(rpt){
              console.log("Bienvenido!!");
              window.location.href = "inicio.php";
          }
        })
        .fail(function() {
          console.log("error, vuelva a intentarlo");
        });
      }
    </script>
</body>
</html>