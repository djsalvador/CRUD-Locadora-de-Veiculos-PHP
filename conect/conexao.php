<?php
    function conexao(){
        $servername = "localhost";
        $port = "";
        $username = "postgres";
        $password = "postgres";
        $dbname = "locadora";
        
        try {
            $con = new PDO("pgsql:host=$servername; dbname=$dbname; user=$username; password=$password");
        // setar PDO error mode para exception
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $con;
        }
        catch(PDOException $erro){
            echo "Falha na Conexao: " . $erro->getMessage();
        }
    }
?>