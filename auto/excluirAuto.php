<?php
    include '../conect/conexao.php';
    $con = conexao();

    $codigo = $_GET["cod"]; 
        //echo $codigo;
    $comando="DELETE FROM veiculo where codigo=$codigo";
        //echo $comando;
        pg_query($con,$comando);
        pg_close($con);
        header("Location: automovel.php");
?>