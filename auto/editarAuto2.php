<?php
    include '../conect/conexao.php';
        $con = conexao();

        $modelo=$_POST["modelo"];
        $placa=$_POST["placa"];
        $codigo = $_POST["cod"];
        
        $sql ="UPDATE veiculo SET modelo=?, placa=? WHERE codigo=?";
        $stm = $con->prepare($sql);

        $stm->bindValue(1,$modelo);
        $stm->bindValue(2,$placa);
        $stm->bindValue(3,$codigo);

        $res = $stm->execute();

        $stm->closeCursor();
        $stm=NULL;
        $con=NULL; 
    header("Location: automovel.php");
?>