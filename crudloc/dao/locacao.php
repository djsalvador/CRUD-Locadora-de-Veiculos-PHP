<?php

require_once('../conect/conexao.php');

//Classe Locacao
class locacao {
    private $cod;
    private $datainicio;
    private $datafim;
    private $preco;
    private $situacao;
    private $cliente;
    private $nomecliente;
    private $veiculo;
    private $modeloveiculo;
    
    //construct da locação
    public function __construct($datainicio, $datafim, $preco, $situacao, $cliente, $nomecliente, $veiculo, $modeloveiculo){
        $this->datainicio = $datainicio;
        $this->datafim = $datafim;
	    $this->preco = $preco;
        $this->situacao = $situacao;
	    $this->cliente = $cliente;
        $this->nomecliente = $nomecliente;
	    $this->veiculo = $veiculo;
        $this->modeloveiculo = $modeloveiculo;
    }
    // Getters e Setters da locação
    public function getCod(){
        return $this->cod;
    }
    public function getDataInicio(){
        return $this->datainicio;
    }  
    public function getDataFim(){
        return $this->datafim;
    }
    public function getPreco(){
        return $this->preco;
    }
    public function getSituacao(){
        return $this->situacao;
    }  
    public function getCliente(){
        return $this->cliente;
    } 
    public function getNomeCliente(){
        return $this->nomecliente;
    } 
    public function getVeiculo(){
        return $this->veiculo;
    }
    public function getModeloVeiculo(){
        return $this->modeloveiculo;
    }

    public function setDataInicio($datainicio){
        $this->datainicio = $datainicio;
    }
    public function setDataFim($datafim){
        $this->datafim = $datafim;
    }
    public function setPreco($preco){
        $this->preco = $preco;
    }
    public function setSituacao($situacao){
        $this->situacao = $situacao;
    }
    public function setCliente($cliente){
        $this->cliente = $cliente;
    }
    public function setNomeCliente($nomecliente){
        $this->nomecliente = $nomecliente;
    }
    public function setVeiculo($veiculo){
        $this->veiculo = $veiculo;
    }
    public function setModeloVeiculo($modeloveiculo){
        $this->modeloveiculo = $modeloveiculo;
    }
    public function setCod($cod){
        $this->cod = $cod;
    }    
}

// DAO da Locação
class locacaoDAO extends DAO {

    // inserir locação
    public function inserir($loc){
        $con=$this->conexao();
        $sql = "INSERT INTO aluguel (datainicio, datafim, preco, situacao, cliente, veiculo) VALUES (?, ?, ?, ?, ?, ?)";
        $stm = $con->prepare($sql);
	    $stm->bindValue(1,$loc->getDataInicio());
        $stm->bindValue(2,$loc->getDataFim());
        $stm->bindValue(3,$loc->getPreco());
        $stm->bindValue(4,$loc->getSituacao());
        $stm->bindValue(5,$loc->getCliente());
        $stm->bindValue(6,$loc->getVeiculo());
        $res = $stm->execute();
        $stm->closeCursor();
        $stm = NULL;
        $con = NULL;
        return $res;
    }

    // deletar locação
    public function deletar($locacao){
        $con = $this->conexao();
        $sql = "DELETE FROM aluguel WHERE codigo=?";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$locacao->getCod());
        $res = $stm->execute();
        $stm->closeCursor();
        $stm = NULL;
        $con = NULL;
        return $res;
    }

    // editar locacao
    public function editar($loc){
        $con=$this->conexao();
        $sql="UPDATE aluguel SET datainicio=?, datafim=?, preco=?, situacao=? WHERE codigo=?";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$loc->getDataInicio());
        $stm->bindValue(2,$loc->getDataFim());
        $stm->bindValue(3,$loc->getPreco());
        $stm->bindValue(4,$loc->getSituacao());
        $stm->bindValue(5,$loc->getCod());
            $result = $stm->execute();        
        $stm->closeCursor();
        $stm = NULL;
        $con = NULL;
    }

    // listar locações
    public function listaLocacao(){
        $con = $this->conexao();
        $sql = "SELECT aluguel.*, cliente.nome AS nomecliente, veiculo.modelo AS modeloveiculo FROM aluguel JOIN cliente ON (aluguel.cliente = cliente.codigo) JOIN veiculo ON (aluguel.veiculo = veiculo.codigo) ORDER BY codigo DESC";
        $stm = $con->prepare($sql);
        $tabela=$stm->execute();
        $locacao = array();

        if($tabela){	
            while($linha = $stm->fetch(PDO::FETCH_ASSOC)){
                $loc = new Locacao($linha['datainicio'],$linha['datafim'],$linha['preco'],$linha['situacao'],$linha['cliente'],$linha['nomecliente'],$linha['veiculo'], $linha['modeloveiculo']);
                $loc->setCod(intval($linha['codigo']));
                array_push($locacao,$loc);
            }
        }
        $stm->closeCursor();
        $stm=NULL;
        $con = NULL;
        return $locacao;
    }

    // localizar locacao
    public function localizar($cod){
        $con = $this->conexao();
        $sql = "SELECT aluguel.*, cliente.nome AS nomecliente, veiculo.modelo AS modeloveiculo FROM aluguel INNER JOIN cliente ON cliente.codigo=aluguel.cliente INNER JOIN veiculo ON veiculo.codigo=aluguel.veiculo WHERE aluguel.codigo=?";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,$cod);
        $tabela=$stm->execute();
        
        if($tabela){	
            $linha=$stm->fetch(PDO::FETCH_ASSOC);
            $loc=new Locacao($linha['datainicio'],$linha['datafim'],$linha['preco'],$linha['situacao'],$linha['cliente'],$linha['nomecliente'],$linha['veiculo'],$linha['modeloveiculo']);
            $loc->setCod(intval($linha['codigo']));
        }
        $stm->closeCursor();
        $stm=NULL;
        $con = NULL;
        return $loc;
    } 

    // busca locacao
    public function busca($pesquisar){
        $con = $this->conexao();
        $sql = "SELECT aluguel.*, cliente.nome AS nomecliente, veiculo.modelo AS modeloveiculo FROM aluguel INNER JOIN cliente ON cliente.codigo=aluguel.cliente INNER JOIN veiculo ON veiculo.codigo=aluguel.veiculo WHERE cliente.nome LIKE ?;";
        $stm = $con->prepare($sql);
        $stm->bindValue(1,"%" . $pesquisar . "%");
        $tabela=$stm->execute();
        $locacao = array();
        
        if($tabela){	
            while($linha = $stm->fetch(PDO::FETCH_ASSOC)){
                $loc = new Locacao($linha['datainicio'],$linha['datafim'],$linha['preco'],$linha['situacao'],$linha['cliente'],$linha['nomecliente'],$linha['veiculo'],$linha['modeloveiculo']);
                $loc->setCod(intval($linha['codigo']));
                array_push($locacao,$loc);
            }
        }
        $stm->closeCursor();
        $stm=NULL;
        $con = NULL;
        return $locacao;
    } 
}

?>