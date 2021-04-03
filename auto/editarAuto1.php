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
            include '../includes/cabecalho.php';
            include '../includes/menu.php';

            $codigo = $_GET["cod"];
            $sql="SELECT * FROM veiculo WHERE codigo=?";
            $stm = $con->prepare($sql);

            $stm->bindValue(1,$codigo);

            $result = $stm->execute();
                if($result){
                    while ($row=$stm->fetch(PDO::FETCH_ASSOC)){
                        $codigo=$row['codigo'];
                        $modelo=$row['modelo'];
                        $placa=$row['placa'];   
                    }
                }
            $stm->closeCursor();
            $stm=NULL;
            $con=NULL;
        ?>
        <hr>
            <p><b>MÓDULO EDITAR AUTOMÓVEL</b></p>
            <form method="POST" action="editarAuto2.php">
                Modelo: <input type=text name="modelo" size="50" value="<?php echo $modelo;?>"><br>
                Placa: <input type=text name="placa" size="7" value="<?php echo $placa;?>"><br>
                <input type="hidden" name="cod" value="<?php echo $codigo;?>"><br>
                <hr />
                <input type="submit" name="submit" value="SALVAR">
            </form>

        <hr>
        <?php
            include '../includes/rodape.php';
            pg_close($con);
        ?>
    </div>
</body>
</html>
