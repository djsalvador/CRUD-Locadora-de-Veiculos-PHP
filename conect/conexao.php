<?php
    function conexao(){
        ini_set('display_errors',1);
        ini_set('display_startup_errors',1);
        error_reporting(E_ALL);
        
        //montar string, separar itens facilita futuras alterações
        $servername = "localhost";
        $dbname = "locadora";
        $username = "postgres";
        $password = "postgres";
        $port = "";
        $string="host=$servername dbname=$dbname user=$username password=$password";
        //echo $string;

        //criar conexão com BD
        $con = pg_connect($string);
        
        // testa se a conexao falhou
        if (!$con) {
            print(" ***** FALHA NA CONEXÃO ***** ");
            exit;
        }
        return $con;
    }
?>