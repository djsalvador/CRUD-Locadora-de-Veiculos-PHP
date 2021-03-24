<?php
    include '../conect/conexao.php';
        $con = conexao();

    try {
        $codigo = $_GET["cod"]; 

        $sql="DELETE FROM cliente WHERE codigo=?";
        $stm = $con->prepare($sql);

        $stm->bindValue(1,$codigo);

        $res = $stm->execute();
        $stm->closeCursor();
        $stm=NULL;
        $con=NULL; 
    header("Location: cliente.php");
    } 
        catch(PDOException $erro){
            echo "FALHA EM DELETAR O CLIENTE: <br>" . $erro->getMessage();
            echo "<br><br>NÃO FOI POSSÍVEL REMOVER O USUÁRIO. VERIFIQUE SE HÁ PENDÊNCIAS.";
        }
?>
