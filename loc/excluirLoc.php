<?php
    include '../conect/conexao.php';
        $con = conexao();

    try {
        $codigo = $_GET["cod"]; 

        $sql="DELETE FROM aluguel WHERE codigo=?";
        $stm = $con->prepare($sql);    
        
        $stm->bindValue(1,$codigo);
        
            $res = $stm->execute();
            $stm->closeCursor();
            $stm=NULL;
            $con=NULL; 
        header("Location: locacao.php");
        }
        catch(PDOException $erro){
            echo "FALHA EM DELETAR A LOCAÇÃO: <br>" . $erro->getMessage();
            echo "<br><br>NÃO FOI POSSÍVEL REMOVER A LOCAÇÃO. VERIFIQUE SE HÁ PENDÊNCIAS.";
        }
?>