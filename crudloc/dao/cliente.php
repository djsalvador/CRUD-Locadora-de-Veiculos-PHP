<?php

require_once('../conect/conexao.php');

//Classe Cliente
class cliente {
    private $cod;
    private $nome;
    private $telefone;
    
    //construct do cliente
    public function __construct($nome, $telefone){
        $this->nome = $nome;
        $this->telefone = $telefone;
    }
    // Getters e Setters do cliente
    public function getCod(){
        return $this->cod;
    }
    public function getNome(){
        return $this->nome;
    }  
    public function getTelefone(){
        return $this->telefone;
    }      
    public function setNome($nome){
        $this->nome = $nome;
    }
    public function setTelefone($telefone){
        $this->telefone = $telefone;
    }
    public function setCod($cod){
        $this->cod = $cod;
    }    
}

// DAO do cliente
class clienteDAO extends DAO {

    // inserir cliente
    public function inserir($cliente){
        $con=$this->conexao();
        $sql = "INSERT INTO cliente (nome, telefone) VALUES (?, ?)";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$cliente->getNome());
        $stm->bindValue(2,$cliente->getTelefone());
        $res = $stm->execute();
        $stm->closeCursor();
        $stm = NULL;
        $con = NULL;
        return $res;
    }

    // deletar cliente
    public function deletar($cliente){
        $con = $this->conexao();
        $sql = "DELETE FROM cliente WHERE codigo=?";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$cliente->getCod());
        $res = $stm->execute();
        $stm->closeCursor();
        $stm = NULL;
        $con = NULL;
        return $res;
    }

    // editar cliente
    public function editar($cliente){
        $con=$this->conexao();
        $sql="UPDATE cliente SET nome=?, telefone=? WHERE codigo=? ";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$cliente->getNome());
        $stm->bindValue(2,$cliente->getTelefone());
        $stm->bindValue(3,$cliente->getCod());
            $result = $stm->execute();        
        $stm->closeCursor();
        $stm = NULL;
        $con = NULL;
    }

    // listar clientes
    public function listaClientes(){
        $con = $this->conexao();
        $sql = "SELECT * FROM cliente ORDER BY codigo";
        $stm = $con->prepare($sql);
        $tabela=$stm->execute();
        $clientes = array();

        if($tabela){	
            while($linha = $stm->fetch(PDO::FETCH_ASSOC)){
                $cli = new Cliente($linha['nome'],$linha['telefone']);
                $cli->setCod(intval($linha['codigo']));
                array_push($clientes,$cli);
            }
        }
        $stm->closeCursor();
        $stm=NULL;
        $con = NULL;
        return $clientes;
    }

    // localizar clientes
    public function localizar($cod){
        $con = $this->conexao();
        $sql = "SELECT * FROM cliente WHERE codigo=?";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$cod);
        $tabela=$stm->execute();

        if($tabela){
            $linha = $stm->fetch(PDO::FETCH_ASSOC);
            $cli = new Cliente($linha['nome'],$linha['telefone']);
            $cli->setCod(intval($linha['codigo']));
        }
        $stm->closeCursor();
        $stm=NULL;
        $con = NULL;
        return $cli;
    } 

    // busca clientes
    public function busca($pesquisar){
        $con = $this->conexao();
        $sql = "SELECT * FROM cliente WHERE nome LIKE ? ORDER BY codigo";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,"%" . $pesquisar . "%");
        $tabela=$stm->execute();
        $clientes = array();
        
        if($tabela){	
            while($linha = $stm->fetch(PDO::FETCH_ASSOC)){
                $cli = new Cliente($linha['nome'],$linha['telefone']);
                $cli->setCod(intval($linha['codigo']));
                array_push($clientes,$cli);
            }
        }
        $stm->closeCursor();
        $stm=NULL;
        $con = NULL;
        return $clientes;
    } 
}

?>