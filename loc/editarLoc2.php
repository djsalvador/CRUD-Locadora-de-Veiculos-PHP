<?php
    include '../conect/conexao.php';
        $con = conexao();

        $datainicio=$_POST["datainicio"];
        $datafim=$_POST['datafim'];
        $preco=$_POST["preco"];             
        $situacao=$_POST["situacao"];
        $codigo = $_POST["cod"];

        $sql="UPDATE aluguel SET datainicio=?, datafim=?, preco=?, situacao=? WHERE codigo=?";
        $stm = $con->prepare($sql);
        
        $stm->bindValue(1,$datainicio);
        $stm->bindValue(2,$datafim);
        $stm->bindValue(3,$preco);
        $stm->bindValue(4,$situacao);
        $stm->bindValue(5,$codigo);
        
        $res = $stm->execute();
        $stm->closeCursor();
        $stm=NULL;
        $con=NULL; 
    header("Location: locacao.php");
?>