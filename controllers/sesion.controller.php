<?php 
// Renaudar la sesión
session_start();
// Destruir la sesión
session_destroy();
// Redirigirlo a Login luego de cerrar la sesión
header('Location:../views/login.php') ?>