<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    require_once('../dao/locacao.php');

    $cod=intval($_GET['cod']);
    $locacaoDAO=new locacaoDAO();
    $locacao=$locacaoDAO->localizar($cod);
    $locacaoDAO->deletar($locacao); 
    
    header("Location: locacao.php");    
?>