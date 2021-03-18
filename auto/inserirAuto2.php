<?php
    include '../conect/conexao.php';
        $con = conexao();

        $modelo=$_POST["modelo"]; 
        $placa=$_POST["placa"];

        $query= "INSERT INTO veiculo (modelo,placa) values ('$modelo','$placa')";
            pg_query($con, $query);
            pg_close($con);
            header("Location: automovel.php");
            pg_close($con);
?>