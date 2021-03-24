<?php
    include '../conect/conexao.php';
        $con = conexao();
    
        $nome=$_POST["nome"];
        $tel=$_POST["telefone"];
        $codigo = $_POST["cod"];

        $sql ="UPDATE cliente SET nome=?, telefone=? WHERE codigo=?";
        $stm = $con->prepare($sql);

        $stm->bindValue(1,$nome);
        $stm->bindValue(2,$tel);
        $stm->bindValue(3,$codigo);

        $res = $stm->execute();
        $stm->closeCursor();
        $stm=NULL;
        $con=NULL; 
    header("Location: cliente.php");
?>