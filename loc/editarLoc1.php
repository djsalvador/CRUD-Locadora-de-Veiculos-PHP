<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Author" content="1123-0187 D.Salvador">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>LOCADORA DE VEÍCULOS - PDO</title>
</head>
<body>
    <?php
        include '../conect/conexao.php';
            $con = conexao();
    ?>

    <div class="container" style="text-align: center;"><br>
        <?php
            include '../cabecalho.php';
            include '../menu.php';

            $codigo = $_GET["cod"];

            $sql="SELECT aluguel.*, cliente.nome AS nomecliente, veiculo.modelo AS modeloveiculo FROM aluguel INNER JOIN cliente on cliente.codigo=aluguel.cliente INNER JOIN veiculo ON veiculo.codigo=aluguel.veiculo WHERE aluguel.codigo=?;";
            $stm = $con->prepare($sql); 
            
            $stm->bindValue(1,$codigo);

            $result=$stm->execute();
                if($result){
                    while ($row=$stm->fetch(PDO::FETCH_ASSOC)){
                        $codigo=$row['codigo'];
                        $datainicio=$row['datainicio'];
                        $datafim=$row['datafim'];
                        $preco=$row['preco'];
                        $situacao=$row['situacao'];
                        $cliente=$row['cliente'];
                        $nomecliente=$row['nomecliente'];
                        $veiculo=$row['veiculo'];
                        $modeloveiculo=$row['modeloveiculo'];
                    }
                }
            $stm->closeCursor();
            $stm=NULL;
            $con=NULL; 
        ?>

        <hr>
            <p><b>MÓDULO EDITAR LOCAÇÃO</b></p>
            <form method="POST" action="editarLoc2.php">
                    CÓD.CLIENTE: <input type="text" name="cliente" size="4" value="<?php echo $cliente; ?>">
                    CLIENTE: <input type="text" name="nomecliente" value="<?php echo $nomecliente; ?>"><br>
                    CÓD.VEÍCULO: <input type="text" name="veiculo" size="4" value="<?php echo $veiculo; ?>">
                    VEÍCULO: <input type="text" name="modeloveiculo" value="<?php echo $modeloveiculo; ?>"><br><hr>
                <?php echo "<b>ALTERAR: </b>" ?><br>
                    DATA INÍCIO: <input type="date" name="datainicio" value="<?php echo $datainicio; ?>"><br>
                    DATA FIM: <input type="date" name="datafim" value="<?php echo $datafim; ?>"><br>
                    PREÇO: <input type="money_format" name="preco" value="<?php echo $preco; ?>"><br>
                    SITUAÇÃO: <input type="text" name="situacao" size="2" value="<?php echo $situacao;?>"><br>
                <input type="hidden" name="cod" value="<?php echo $codigo;?>"><br>
                    <hr>
                <input type="submit" name="submit" value="SALVAR">
            </form>

        <hr>
        <?php
            include '../rodape.php';
            pg_close($con);
        ?>
    </div>
</body>
</html>
