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
        ?>
    <hr>
        <p><b>MÓDULO DE PESQUISA DE LOCAÇÃO</b></p>
        <a href='locacao.php'><img src='../img/btn_voltar.png'></a>
    <br><br>

    <table class="tabela">
        <tr>
        <th>CÓDIGO</th>
            <th>DATA INÍCIO</th>
            <th>DATA FIM</th>
            <th>PREÇO</th>
            <th>SITUAÇÃO</th>
            <th>CÓD.CLIENTE</th>
            <th>CLIENTE</th>
            <th>CÓD.VEÍCULO</th>
            <th>VEÍCULO</th>
            <th><img src='../img/excluir.png'></th>
            <th><img src='../img/editar.png'></th>
        </tr>

    <?php
        $pesquisar = $_POST['pesquisar'];

        $sql="SELECT aluguel.*, cliente.nome AS nomecliente, veiculo.modelo AS modeloveiculo FROM aluguel INNER JOIN cliente ON cliente.codigo=aluguel.cliente INNER JOIN veiculo ON veiculo.codigo=aluguel.veiculo WHERE cliente.nome LIKE ?;";

        $stm = $con->prepare($sql);

        $stm->bindValue(1,"%" . $pesquisar . "%");

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
                        echo "
                            <tr>
                                <td> $codigo </td>
                                <td> $datainicio </td>
                                <td> $datafim </td>
                                <td> $preco </td>                                    
                                <td> $situacao </td>
                                <td> $cliente </td>
                                <td> $nomecliente </td>
                                <td> $veiculo </td>
                                <td> $modeloveiculo </td>
                                <td><a href='excluirLoc.php?cod=$codigo'><img src='../img/btn_excluir.png'></a></td>
                                <td><a href='editarLoc1.php?cod=$codigo'><img src='../img/btn_editar.png'></a></td>
                            </tr>
                            ";  
                }
            } else {
                echo "Nenhuma locação foi encontrada com a palavra '.$pesquisar.' ";
            }
            $stm->closeCursor();
            $stm=NULL;
            $con=NULL;
    ?>
    </table>
            
    <hr>
        <?php
            include '../rodape.php';
            pg_close($con);
        ?>
    </div>
</body>
</html>