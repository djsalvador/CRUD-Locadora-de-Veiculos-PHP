<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    require_once('../dao/auto.php');

    $cod=intval($_GET['cod']);
    $autoDAO=new autoDAO();
    $veic=$autoDAO->localizar($cod);
    $autoDAO->deletar($veic);

    header("Location: automovel.php");
?>