<?php
include_once 'auto_load.class.php';
new auto_load();
	class xml extends conecta{

		protected $matricula, $nome, $se, $lotacao, $sigla_lotacao, $mcu, $cargo, $especialidade, $funcao, $localizacao, $afastado, $genero, $telefone, $celular;


		public function setMatricula($valor){
			$this->matricula = $valor;
		}

		public function getMatricula(){
			return $this->matricula;
		}

		public function setNome($valor){
			$this->nome = $valor;
		}

		public function getNome(){
			return $this->nome;
		}

		public function setSE($valor){
			$this->se = $valor;
		}

		public function getSE(){
			return $this->se;
		}

		public function setLotacao($valor){
			$this->lotacao = $valor;
		}

		public function getLotacao(){
			return $this->lotacao;
		}

		public function setSiglaLotacao($valor){
			$this->sigla_lotacao = $valor;
		}

		public function getSiglaLotacao(){
			return $this->sigla_lotacao;
		}

		public function setMCU($valor){
			$this->mcu = $valor;
		}

		public function getMCU(){
			return $this->mcu;
		}

		public function setCargo($valor){
			$this->cargo = $valor;
		}

		public function getCargo(){
			return $this->cargo;
		}

		public function setEspecialidade($valor){
			$this->especialidade = $valor;
		}

		public function getEspecialidade(){
			return $this->especialidade;
		}

		public function setFuncao($valor){
			$this->funcao = $valor;
		}

		public function getFuncao(){
			return $this->funcao;
		}

		public function setLocalizacao($valor){
			$this->localizacao = $valor;
		}

		public function getLocalizacao(){
			return $this->localizacao;
		}

		public function setAfastado($valor){
			$this->afastado = $valor;
		}

		public function getAfastado(){
			return $this->afastado;
		}

		public function setGenero($valor){
			$this->genero = $valor;
		}

		public function getGenero(){
			return $this->genero;
		}



		public function gravarDados(){

			$matricula = $this->getMatricula();
			$nome = $this->getNome();
			$se = $this->getSE();
			$lotacao = $this->getLotacao();
			$sigla_lotacao = $this->getSiglaLotacao();
			$mcu = $this->getMCU();
			$cargo = $this->getCargo();
			$especialidade = $this->getEspecialidade();
			$funcao = $this->getFuncao();
			$localizacao = $this->getLocalizacao();
			$afastado = $this->getAfastado();
			$genero = $this->getGenero();



			$sql = "SELECT matricula FROM colaboradores WHERE matricula = :matricula LIMIT 1";

			$dados = array(":matricula" => $matricula);
			//echo $sql;
			//echo "<br>";


			$query = conecta::executarSQL($sql, $dados);
			$resultado = $query->fetch(PDO::FETCH_OBJ);
			$quant = $query->rowCount();
			$count_row = false;	



			if($quant > 0){

				$sql = "UPDATE colaboradores SET nome = :nome, se = :se, lotacao = :lotacao, sigla_lotacao = :sigla_lotacao, mcu = :mcu, cargo = :cargo, especialidade = :especialidade, funcao = :funcao, localizacao = :localizacao, afastado = :afastado, genero = :genero WHERE matricula = :matricula";

				$dados = array(":nome" => $nome, ":se" => $se, ":lotacao" => $lotacao, ":sigla_lotacao" => $sigla_lotacao, ":mcu" => $mcu, ":cargo" => $cargo, ":especialidade" => $especialidade, ":funcao" => $funcao, ":localizacao" => $localizacao, ":afastado" => $afastado, ":genero" => $genero, ":matricula" => $matricula);

				
				
			}else{
				$sql = "INSERT INTO colaboradores (matricula, nome, se, lotacao, sigla_lotacao, mcu, cargo, especialidade, funcao, localizacao, afastado, genero) VALUES (:matricula, :nome, :se, :lotacao, :sigla_lotacao, :mcu, :cargo, :especialidade, :funcao, :localizacao, :afastado, :genero)";

				$dados = array(":matricula" => $matricula, ":nome" => $nome, ":se" => $se, ":lotacao" => $lotacao, ":sigla_lotacao" => $sigla_lotacao, ":mcu" => $mcu, ":cargo" => $cargo, ":especialidade" => $especialidade, ":funcao" => $funcao, ":localizacao" => $localizacao, ":afastado" => $afastado, ":genero" => $genero);
				
			}
			

			
			$query = conecta::executarSQL($sql, $dados);
				$resultado = $query->fetch(PDO::FETCH_OBJ);
				$count_row = $query->rowCount();

				//var_dump($dados);


			//$query = conecta::executarSQL($sql, $dados);
			//$count_row = conecta::lastidSQL();
			//$count_row = true;
			$xmlError = array();	
			//echo "count = ".$count_row."<br>";

			if(!$count_row){
				
				$dadosXML["matricula"] = $matricula;
				$dadosXML["nome"] = $nome;
				array_push($xmlError, $dadosXML);
				$dadosXML = null;
			}
			
			$error = count($xmlError);


			//retorna FALSE, se não gerar ERROR.
			// retorna ARRAY, com o error.
			if($error){
				//var_dump($xmlError);
				return $xmlError;
			}else{
				return false;
			}
			


		}//gravar dados












	}//class


?>