<?php
    include '../conect/conexao.php';
        $con = conexao();

        $nome=$_POST["nome"];
        $tel=$_POST["telefone"]; 

        $query= "INSERT INTO cliente (nome,telefone) values ('$nome','$tel')";
            pg_query($con, $query);
            pg_close($con);
            header("Location: cliente.php");
            pg_close($con);
?>