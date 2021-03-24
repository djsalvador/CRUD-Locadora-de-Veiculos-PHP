<?php
    include '../conect/conexao.php';
        $con = conexao();

        $modelo=$_POST["modelo"]; 
        $placa=$_POST["placa"];

        $sql= "INSERT INTO veiculo (modelo,placa) VALUES (?,?)";
        $stm = $con->prepare($sql);

        $stm->bindValue(1, $modelo);
        $stm->bindValue(2, $placa);

        $res = $stm->execute();
        
        $stm->closeCursor();
        $stm=NULL;
        $con=NULL;
    header("Location: automovel.php");
?>