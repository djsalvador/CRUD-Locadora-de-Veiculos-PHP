<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    require_once('../dao/locacao.php');

    $datainicio=$_POST['datainicio'];
    $datafim=$_POST['datafim'];
    $preco=$_POST['preco'];             
    $situacao=$_POST['situacao'];
    $cliente=$_POST['cliente'];
    $veiculo=$_POST['veiculo'];

    $locacaoDAO=new locacaoDAO();
    $loc = new locacao($datainicio,$datafim,$preco,$situacao,$cliente,$nomecliente,$veiculo,$modeloveiculo);
    $locacaoDAO->inserir($loc);

    header("Location: locacao.php");
?>