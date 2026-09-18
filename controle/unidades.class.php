<?php
include_once 'auto_load.class.php';
new auto_load();

class unidades extends conecta{

	protected $nome, $trabalho, $se, $endereco, $gerente, $matricula, $tel_gerente, $tel_centro1, $tel_centro2, $url;
	
	public function setNome($value){
		$this->nome = $value;
	}
	public function getNome(){
		return $this->nome;
	}

	public function setSE($value){
		$this->se = $value;
	}
	public function getSE(){
		return $this->se;
	}
	
	public function setTrabalho($value){
		$this->trabalho = $value;
	}
	public function getTrabalho(){
		return $this->trabalho;
	}
	
	public function setEndereco($value){
		$this->endereco = $value;
	}
	public function getEndereco(){
		return $this->endereco;
	}

	public function setURL($value){
		$this->url = $value;
	}
	public function getURL(){
		return $this->url;
	}
	
	public function setGerente($value){
		$this->gerente = $value;
	}
	public function getGerente(){
		return $this->gerente;
	}

	public function setMatricula($value){
		$this->matricula = $value;
	}
	public function getMatricula(){
		return $this->matricula;
	}
	
	public function setTelGerente($value){
		$this->tel_gerente = $value;
	}
	public function getTelGerente(){
		return $this->tel_gerente;
	}

	public function setTelCentro1($value){
		$this->tel_centro1 = $value;
	}
	public function getTelCentro1(){
		return $this->tel_centro1;
	}
	
	public function setTelCentro2($value){
		$this->tel_centro2 = $value;
	}
	public function getTelCentro2(){
		return $this->tel_centro2;
	}
	
	//consultar unidades cadastradas
	public function consultarUnidades(){
		
		$sql = "SELECT * FROM unidades WHERE status = :status ORDER BY nome";
		$dados = array(":status" => 1);
		$query = conecta::executarSQL($sql, $dados);
		$resultado = $query->fetchAll(PDO::FETCH_OBJ);
		$quant = $query->rowCount();
		
		if($quant > 0){	
			
			return $resultado;
		}else{
			return false;
		}

		
	
	}//consultar unidades
	
	
	
	//cadastrar unidades
	public function cadastrarUnidades(){
		$funcao = new funcoes();
		$nome = strtoupper($this->getNome());
		$se = strtoupper($this->getSE());
		$trabalho = strtolower($this->getTrabalho());
		$endereco = strtoupper($this->getEndereco());
		$gerente = strtoupper($this->getGerente());
		$url = $this->getURL();
		$matricula = $funcao->somenteNumero($this->getMatricula());
		$tel_gerente = $funcao->somenteNumero($this->getTelGerente());
		$tel_centro1 = $funcao->somenteNumero($this->getTelCentro1());
		$tel_centro2 = $funcao->somenteNumero($this->getTelCentro2());


		$sql = "INSERT INTO unidades (nome, se, trabalho, endereco, url, gerente, matricula, tel_gerente, tel_centro1, tel_centro2) VALUES (:nome, :se, :trabalho, :endereco, :url, :gerente, :matricula, :tel_gerente, :tel_centro1, :tel_centro2)";
		$dados = array(":nome" => $nome, ":se" => $se, ":trabalho" => $trabalho, ":endereco" => $endereco, ":url" => $url, ":gerente" => $gerente, ":matricula" => $matricula, ":tel_gerente" => $tel_gerente, ":tel_centro1" => $tel_centro1, ":tel_centro2" => $tel_centro2);

		$query = conecta::executarSQL($sql, $dados);
		$resultado = conecta::lastidSQL();

		//$resultado = true;
		$retorno = "";
		if($resultado){	
			$retorno = "{'resultado':'true'}";						
		}else{
			$retorno = "{'resultado':'false'}";			
		}

		return $retorno;
	
	}//cadastrar unidades
	
	
	
	
	
	
	

}//class


?>