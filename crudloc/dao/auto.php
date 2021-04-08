<?php

require_once('../conect/conexao.php');

//Classe Auto
class auto {
    private $cod;
    private $modelo;
    private $placa;

    //construct do auto
    public function __construct($modelo, $placa){
        $this->modelo = $modelo;
        $this->placa = $placa;
    }
    // Getters e Setters do automóvel
    public function getCod(){
        return $this->cod;
    }
    public function getModelo(){
        return $this->modelo;
    }  
    public function getPlaca(){
        return $this->placa;
    }      
    public function setModelo($modelo){
        $this->modelo = $modelo;
    }
    public function setPlaca($placa){
        $this->placa = $placa;
    }
    public function setCod($cod){
        $this->cod = $cod;
    }    
}

// DAO do auto
class autoDAO extends DAO {

    // inserir auto
    public function inserir($auto){
        $con=$this->conexao();
        $sql = "INSERT INTO veiculo (modelo, placa) VALUES (?, ?)";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$auto->getModelo());
        $stm->bindValue(2,$auto->getPlaca());
        $res = $stm->execute();
        $stm->closeCursor();
        $stm = NULL;
        $con = NULL;
        return $res;
    }

    // deletar auto
    public function deletar($auto){
        $con = $this->conexao();
        $sql = "DELETE FROM veiculo WHERE codigo=?";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$auto->getCod());
        $res = $stm->execute();
        $stm->closeCursor();
        $stm = NULL;
        $con = NULL;
        return $res;
    }

    // editar auto
    public function editar($auto){
        $con=$this->conexao();
        $sql="UPDATE veiculo SET modelo=?, placa=? WHERE codigo=? ";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$auto->getModelo());
        $stm->bindValue(2,$auto->getPlaca());
        $stm->bindValue(3,$auto->getCod());
            $result = $stm->execute();        
        $stm->closeCursor();
        $stm = NULL;
        $con = NULL;
    }

    // listar autos
    public function listaAutos(){
        $con = $this->conexao();
        $sql = "SELECT * FROM veiculo ORDER BY codigo";
        $stm = $con->prepare($sql);
        $tabela=$stm->execute();
        $autos = array();

        if($tabela){	
            while($linha = $stm->fetch(PDO::FETCH_ASSOC)){
                $veic = new Auto($linha['modelo'],$linha['placa']);
                $veic->setCod(intval($linha['codigo']));
                array_push($autos,$veic);
            }
        }
        $stm->closeCursor();
        $stm=NULL;
        $con = NULL;
        return $autos;
    }

    // localizar autos
    public function localizar($cod){
        $con = $this->conexao();
        $sql = "SELECT * FROM veiculo WHERE codigo=?";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$cod);
        $tabela = $stm->execute();
        
        if($tabela ){
            $linha = $stm->fetch(PDO::FETCH_ASSOC);
            $veic = new Auto($linha['modelo'],$linha['placa']);
            $veic->setCod(intval($linha['codigo']));
        }
        $stm->closeCursor();
        $stm=NULL;
        $con = NULL;
        return $veic;
    } 

    // busca auto
    public function busca($pesquisar){
        $con = $this->conexao();
        $sql = "SELECT * FROM veiculo WHERE modelo LIKE ? ORDER BY codigo";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,"%" . $pesquisar . "%");
        $tabela=$stm->execute();
        $autos = array();
        
        if($tabela){	
            while($linha = $stm->fetch(PDO::FETCH_ASSOC)){
                $veic = new Auto($linha['modelo'],$linha['placa']);
                $veic->setCod(intval($linha['codigo']));
                array_push($autos,$veic);
            }
        }
        $stm->closeCursor();
        $stm=NULL;
        $con = NULL;
        return $autos;
    } 
}

?>