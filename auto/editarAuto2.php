<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    require_once('../dao/auto.php');
    
    $cod = intval($_POST['cod']);
    $modelo= $_POST['modelo'];
    $placa= $_POST['placa'];
   
    $auto = new auto($modelo,$placa);
    $auto->setCod($cod);
    $autoDAO = new autoDAO();
    $autoDAO->editar($auto);

    header("Location: automovel.php");
?>