<?php
    include '../conect/conexao.php';
        $con = conexao();

        $nome=$_POST["nome"];
        $tel=$_POST["telefone"]; 

        $sql= "INSERT INTO cliente (nome,telefone) VALUES (?,?)";
        $stm = $con->prepare($sql);

        $stm->bindValue(1,$nome);
        $stm->bindValue(2,$tel);
        
        $res = $stm->execute();
            
        $stm->closeCursor();
        $stm=NULL;
        $con=NULL;
    header("Location: cliente.php");
?>