<?php
    include '../conect/conexao.php';
        $con = conexao();

    try {
        $codigo = $_GET["cod"]; 

        $sql="DELETE FROM veiculo WHERE codigo=?";
        $stm = $con->prepare($sql);
        
        $stm->bindValue(1,$codigo);
        
        $res = $stm->execute();
        $stm->closeCursor();
        $stm=NULL;
        $con=NULL; 
    header("Location: automovel.php");
    } 
        catch(PDOException $erro){
            echo "FALHA EM DELETAR O VEÍCULO: <br>" . $erro->getMessage();
            echo "<br><br>NÃO FOI POSSÍVEL REMOVER O VEÍCULO. VERIFIQUE SE HÁ PENDÊNCIAS.";
        }
?>