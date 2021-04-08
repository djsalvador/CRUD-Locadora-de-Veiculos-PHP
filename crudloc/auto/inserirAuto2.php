<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    require_once('../dao/auto.php');
    
    $modelo=$_POST['modelo'];
    $placa=$_POST['placa'];
    
    $autoDAO=new autoDAO();
    $veic=new auto($modelo,$placa);
    $autoDAO->inserir($veic);

    header("Location: automovel.php");
?>