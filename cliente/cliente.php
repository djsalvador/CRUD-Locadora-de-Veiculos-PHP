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
        <p><b>MÓDULO CLIENTE</b></p>
        <a href='../cliente/inserirCliente1.php'><img src='../img/btn_inserir.png'></a>
        <a href='../cliente/buscaCliente1.php'><img src='../img/btn_busca.png'></a>
    <br><br>
        <table>
            <tr>
                <th>CÓDIGO</th>
                <th>NOME</th>
                <th>TELEFONE</th>
                <th><img src='../img/excluir.png'></th>
                <th><img src='../img/editar.png'></th>
            </tr>
        <?php
            $sql="SELECT * FROM cliente ORDER BY codigo";
            $stm = $con->prepare($sql);

            $result=$stm->execute();
                if($result){
                    while ($row=$stm->fetch(PDO::FETCH_ASSOC)){
                        $codigo=$row['codigo'];
                        $nome=$row['nome'];
                        $tel=$row['telefone'];
                            echo "
                                <tr>
                                    <td> $codigo </td>
                                    <td> $nome </td>
                                    <td> $tel </td>
                                    <td><a href='../cliente/excluirCliente.php?cod=$codigo'><img src='../img/btn_excluir.png'></a></td>
                                    <td><a href='../cliente/editarCliente1.php?cod=$codigo'><img src='../img/btn_editar.png'></a></td>
                                </tr>
                                ";  
                    }
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