<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    require_once('../dao/cliente.php');
    
    $cod = intval($_POST['cod']);
    $nome= $_POST['nome'];
    $telefone= $_POST['telefone'];
   
    $cli = new cliente($nome,$telefone);
    $cli->setCod($cod);
    $cliDAO = new clienteDAO();
    $cliDAO->editar($cli);

    header("Location: cliente.php");
?>