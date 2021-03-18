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
    <title>Trabalho 3 - LOCADORA DE VEÍCULOS</title>
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
        <table width="60%" border="1" align="center">
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
                    $query="SELECT aluguel.*, cliente.nome as nomecliente, veiculo.modelo as modeloveiculo FROM aluguel JOIN cliente on (aluguel.cliente = cliente.codigo) JOIN veiculo on (aluguel.veiculo = veiculo.codigo) where cliente.nome like '%$pesquisar%' or veiculo.modelo like '%$pesquisar%'";
                    
                    $result=pg_query($con,$query);
                        if($result){
                            while ($row=pg_fetch_assoc($result)){
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
                        }
                    pg_close($con);
                ?>
        </table>
            <hr>
                <?php
                    include '../rodape.php';
                ?>
    </div>
</body>
</html>