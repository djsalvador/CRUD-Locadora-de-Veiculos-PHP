<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    require_once('../dao/cliente.php');

    $cod=intval($_GET['cod']);
    $clienteDAO=new clienteDAO();
    $cli=$clienteDAO->localizar($cod);
    $clienteDAO->deletar($cli); 
    
    header("Location: cliente.php");
?>
