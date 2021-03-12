<?php 
session_start();


unset($_SESSION['nombre_usuario']);
unset($_SESSION['id_usuario']);
unset($_SESSION['correo_usuario']);
unset($_SESSION['telefono_usuario']);
unset($_SESSION['CLIENT_AUTHENTICATION_OK']);

session_destroy();

header('Location: ../views/login.php');


 ?>