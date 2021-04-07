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
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        require_once('../dao/locacao.php');
        $cod = intval($_GET['cod']);
        $locDAO=new locacaoDAO();
        $locacao=$locDAO->localizar($cod);
    ?>

    <div class="container" style="text-align: center;"><br>
        <?php
            include '../includes/cabecalho.php';
            include '../includes/menu.php';
        ?>

        <hr>
        <p><b>MÓDULO EDITAR LOCAÇÃO</b></p>
                <table class="tabela_editar">
                    <tr class="tr_editar">
                        <td>CÓD.CLIENTE: <?php echo $locacao->getCliente();?> </td>
                        <td>NOME CLIENTE: <?php echo $locacao->getNomeCliente();?> </td>
                    </tr>
                    <tr class="tr_editar">
                        <td>CÓD.VEÍCULO: <?php echo $locacao->getVeiculo();?> </td>
                        <td>MODELO VEÍCULO: <?php echo $locacao->getModeloVeiculo();?> </td>
                    </tr>
                </table>
                <hr>
            
        <p><b>ALTERAR: </b></p>

            <form method="POST" action="editarLoc2.php">
                SITUAÇÃO: 	
                    <input type="radio" name="situacao" value="A" <?php echo ($locacao->getSituacao()=='A') ? 'checked':null; ?>>ABERTO 
                    <input type="radio" name="situacao" value="E" <?php echo ($locacao->getSituacao()=='E') ? 'checked':null; ?>>ENCERRADO <br>               
                DATA INÍCIO: <input type="date" name="datainicio" value="<?php echo $locacao->getDataInicio(); ?>"><br>
                DATA TÉRMINO: <input type="date" name="datafim" value="<?php echo $locacao->getDataFim(); ?>"><br>
                VALOR TOTAL: <input type="money_format" name="preco" value="<?php echo $locacao->getPreco(); ?>"><br>
                    <input type="hidden" name="cod" value="<?php echo $locacao->getCod(); ?>"><br>
                    <hr>
                    <input type="submit" name="submit" value="SALVAR">
            </form>

        <hr>
        <?php
            include '../includes/rodape.php';
        ?>
    </div>
</body>
</html>