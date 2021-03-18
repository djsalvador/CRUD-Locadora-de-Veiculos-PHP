<?php
    include '../conect/conexao.php';
        $con = conexao();

    $codigo = $_GET["cod"]; 
        //echo $codigo;
    $comando="DELETE FROM aluguel where codigo=$codigo";
        //echo $comando;
        pg_query($con,$comando);

        pg_close($con);
        header("Location: locacao.php");
?>