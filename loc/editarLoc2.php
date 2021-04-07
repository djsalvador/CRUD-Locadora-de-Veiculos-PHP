<?php
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(E_ALL);
    require_once('../dao/locacao.php');
    
    $cod = intval($_POST['cod']);
    $datainicio= $_POST['datainicio'];
    $datafim= $_POST['datafim'];
    $preco= $_POST['preco'];
    $situacao= $_POST['situacao'];
    $cliente= $_POST['cliente'];
    $nomecliente= $_POST['nomecliente'];
    $veiculo= $_POST['veiculo'];
    $modeloveiculo= $_POST['modeloveiculo'];
   
    $loc = new locacao($datainicio,$datafim,$preco,$situacao,$cliente,$nomecliente,$veiculo,$modeloveiculo);
    $loc->setCod($cod);
    $locDAO = new locacaoDAO();
    $locDAO->editar($loc);

    header("Location: locacao.php");
?>