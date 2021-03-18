<?php
    include '../conect/conexao.php';
        $con = conexao();
        
        $datainicio=$_POST['datainicio'];
        $datafim=$_POST['datafim'];
        $preco=$_POST['preco'];             
        $situacao=$_POST["situacao"];
        $cliente=$_POST['cliente'];
        $veiculo=$_POST['veiculo'];
            
        $query="INSERT INTO aluguel (datainicio, datafim, preco, situacao, cliente, veiculo) values ('$datainicio', '$datafim', '$preco', '$situacao', '$cliente', '$veiculo')";
        //echo $query;
            pg_query($con, $query);
            pg_close($con);
            header("Location: locacao.php");
            pg_close($con);
?>