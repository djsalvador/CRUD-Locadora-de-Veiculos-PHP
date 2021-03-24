<?php
    include '../conect/conexao.php';
        $con = conexao();
        
        $datainicio=$_POST['datainicio'];
        $datafim=$_POST['datafim'];
        $preco=$_POST['preco'];             
        $situacao=$_POST["situacao"];
        $cliente=$_POST['cliente'];
        $veiculo=$_POST['veiculo'];
            
        $sql="INSERT INTO aluguel (datainicio, datafim, preco, situacao, cliente, veiculo) VALUES (?, ?, ?, ?, ?, ?)";
        $stm = $con->prepare($sql);

        $stm->bindValue(1,$datainicio);
        $stm->bindValue(2,$datafim);
        $stm->bindValue(3,$preco);
        $stm->bindValue(4,$situacao);
        $stm->bindValue(5,$cliente);
        $stm->bindValue(6,$veiculo);

        $res = $stm->execute();
        
        $stm->closeCursor();
        $stm=NULL;
        $con=NULL;
    header("Location: locacao.php");
?>