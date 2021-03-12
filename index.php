<?php

session_start();


if (!isset($_SESSION['CLIENT_AUTHENTICATION_OK'])) {
    header('Location:./php/views/login.php');
    exit;
}


$pagina = isset($_GET['param']) ? strtolower($_GET['param']) : 'inicio';

if (isset($_GET['param'])) {

        require_once './php/views/header.php';
        require_once './php/views/menu.php';
       
}else{
    require_once './php/views/header.php';
    require_once './php/views/menu.php';
    //require_once('./php/class/connexion.php');
}
$ruta = './php/views/' . $pagina . '.php';
if (file_exists($ruta)) {
    $ruta;
} else {
    
    $ruta = './php/views/404.php';
    
}
require_once $ruta;
