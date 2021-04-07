<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    require_once('../dao/cliente.php');
    
    $nome=$_POST['nome'];
    $telefone=$_POST['telefone'];
    
    $clienteDAO=new clienteDAO();
    $cli=new cliente($nome,$telefone);
    $clienteDAO->inserir($cli);
    
    header("Location: cliente.php");
?>