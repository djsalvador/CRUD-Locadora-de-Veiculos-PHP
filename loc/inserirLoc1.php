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
    <div class="container" style="text-align: center;"><br>
        <?php
            include '../cabecalho.php';
            include '../menu.php';
            include '../conect/conexao.php';
                $con = conexao();
        ?>

        <br><br>
        <p><b>MÓDULO INSERIR NOVA LOCAÇÃO</b></p>

        <form method="POST" action="inserirLoc2.php">
            DATA INÍCIO: <input type=text name="datainicio" placeholder="Data de Início"><br>
            DATA FIM: <input type=text name="datafim" placeholder="Data Fim"><br>
            PREÇO: <input type=money_format name="preco" placeholder="Valor da Locação"><br>
            SITUAÇÃO: <input type=text name="situacao" placeholder="A ou E"><br>
            CLIENTE: 
                <select name="cliente">
                    <?php     
                        $query='SELECT codigo, nome FROM cliente';
                        $result=pg_query($con,$query);
                            if($result){
                                while ($row=pg_fetch_assoc($result)) {
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
                        $query='SELECT codigo, modelo FROM veiculo';
                        $result=pg_query($con,$query);
                            if($result){
                                while ($row=pg_fetch_assoc($result)) {
                                    $codigo = $row['codigo'];
                                    $modelo = $row['modelo'];
                                echo "<option value='$codigo'>$modelo</option>";
                                }
                            }
                        pg_close($con);
                    ?>
                </select><br>
            <hr />
            <input type="submit" name="submit" value="INSERIR">
        </form>

    <hr>
        <?php
            include '../rodape.php';
        ?>
    </div>
</body>
</html>