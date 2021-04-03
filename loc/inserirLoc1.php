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
    <div class="container" style="text-align: center;"><br>
        <?php
            include '../includes/cabecalho.php';
            include '../includes/menu.php';
            include '../conect/conexao.php';
                $con = conexao();
        ?>
    <hr>
        <p><b>MÓDULO INSERIR NOVA LOCAÇÃO</b></p>

        <form method="POST" action="inserirLoc2.php">
            DATA INÍCIO: <input type=date name="datainicio" placeholder="Data de Início"><br>
            DATA FIM: <input type=date name="datafim" placeholder="Data Fim"><br>
            PREÇO: <input type=money_format name="preco" placeholder="Valor da Locação"><br>
            SITUAÇÃO: 	<input type="radio" name="situacao" value="A"> ABERTO 
						<input type="radio" name="situacao" value="E"> ENCERRADO
					<br> 
            CLIENTE: 
                <select name="cliente">
                    <?php     
                        $sql='SELECT codigo, nome FROM cliente';
                        $stm = $con->prepare($sql);

                        $result=$stm->execute();
                            if($result){
                                while ($row=$stm->fetch(PDO::FETCH_ASSOC)){
                                    $codigo = $row['codigo'];
                                    $nome = $row['nome'];
                                echo "<option value='$codigo'>$nome</option>";
                                }
                            }
                    ?>
                </select><br>
            VEÍCULO: 
                <select name="veiculo">
                    <?php     
                        $sql='SELECT codigo, modelo FROM veiculo';
                        $stm = $con->prepare($sql);

                        $result=$stm->execute();
                            if($result){
                                while ($row=$stm->fetch(PDO::FETCH_ASSOC)){
                                    $codigo = $row['codigo'];
                                    $modelo = $row['modelo'];
                                echo "<option value='$codigo'>$modelo</option>";
                                }
                            }
                            $stm->closeCursor();
                            $stm=NULL;
                            $con=NULL;
                    ?>
                </select><br>
            <hr />
            <input type="submit" name="submit" value="INSERIR">
        </form>

    <hr>
        <?php
            include '../includes/rodape.php';
            pg_close($con);
        ?>
    </div>
</body>
</html>