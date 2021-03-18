<?php
    include '../conect/conexao.php';
        $con = conexao();

        $codigo = $_POST["cod"];
        $datainicio=$_POST["datainicio"];
        $datafim=$_POST["datafim"];
        $preco=$_POST["preco"];             
        $situacao=$_POST["situacao"];
        $cliente=$_POST["cliente"];
        $veiculo=$_POST["veiculo"];

        $query="UPDATE aluguel SET datainicio='$datainicio', datafim='$datafim', preco='$preco', situacao='$situacao', cliente='$cliente', veiculo='$veiculo' WHERE codigo=$codigo";
        //echo $query;
            pg_query($con, $query);
            pg_close($con);
            header("Location: locacao.php");
            pg_close($con);
?>