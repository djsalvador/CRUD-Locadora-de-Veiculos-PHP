<?php
    include '../conect/conexao.php';
        $con = conexao();

        $codigo = $_POST["cod"];    
        $modelo=$_POST["modelo"];
        $placa=$_POST["placa"];   
        
        $query ="UPDATE veiculo SET modelo='$modelo', placa='$placa' WHERE codigo=$codigo";
            //echo $query;
            pg_query($con, $query);
            pg_close($con);
            header("Location: automovel.php");
            pg_close($con);
?>