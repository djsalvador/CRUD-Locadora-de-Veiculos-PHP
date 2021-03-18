<?php
    include '../conect/conexao.php';
        $con = conexao();

        $codigo = $_POST["cod"];    
        $nome=$_POST["nome"];
        $tel=$_POST["telefone"];  
        
        $query ="UPDATE cliente SET nome='$nome', telefone='$tel' WHERE codigo=$codigo";
        //echo $query;
            pg_query($con, $query);
            pg_close($con);
            header("Location: cliente.php");
            pg_close($con);
?>