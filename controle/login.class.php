<?php

include_once 'auto_load.class.php';
new auto_load();

class login extends conecta{

	protected $matricula, $senha;

	public function setMatricula($valor){
		$this->matricula = $valor;
	}

	public function getMatricula(){
		return $this->matricula;
	}

	public function setSenha($valor){
		$this->senha = $valor;
	}

	public function getSenha(){
		return $this->senha;
	}


	public function logar(){

		$usuario = $this->getMatricula();

		$sql = "SELECT matricula, nome, lotacao, funcao, telefone, celular FROM colaboradores WHERE matricula = :matricula AND status = :status";
		$dados = array(":matricula" => $usuario, ":status" => 1);

		$query = conecta::executarSQL($sql, $dados);
		$resultado = $query->fetch(PDO::FETCH_OBJ);
		$quant = $query->rowCount();		
		if($quant == 1){					
			//return $resultado;			
			$sql = "INSERT INTO login (matricula) VALUES (:matricula)";
			$dados = array(":matricula" => $usuario);
			$query = conecta::executarSQL($sql, $dados);

			return $resultado;
		}else{
			return false;
		}



	}



	public function logarAdm(){

		$matricula = $this->getMatricula();
		$senha = $this->getSenha();

		$sql = "SELECT matricula FROM administrador WHERE matricula = :matricula AND senha = :senha AND status = :status";
		$dados = array(":matricula" => $matricula, ":senha" => $senha, ":status" => 1);

		$query = conecta::executarSQL($sql, $dados);
		$resultado = $query->fetch(PDO::FETCH_OBJ);
		$quant = $query->rowCount();		
		if($quant == 1){					
			//return $resultado;			
			$sql = "INSERT INTO loginadm (matricula) VALUES (:matricula)";
			$dados = array(":matricula" => $matricula);
			$query = conecta::executarSQL($sql, $dados);

			return $resultado;
		}else{

			$sql = "SELECT matricula FROM unidades WHERE matricula = :matricula AND senha = :senha AND status = :status";
			$dados = array(":matricula" => $matricula, ":senha" => $senha, ":status" => 1);

			$query = conecta::executarSQL($sql, $dados);
			$resultado = $query->fetch(PDO::FETCH_OBJ);
			$quant = $query->rowCount();		
			if($quant == 1){					
				//return $resultado;			
				$sql = "INSERT INTO loginadm (matricula) VALUES (:matricula)";
				$dados = array(":matricula" => $matricula);
				$query = conecta::executarSQL($sql, $dados);

				return $resultado;
			}else{
				return false;
			}


			//return false;
		}



	}



	public function existeSenha($matricula){

		$sql = "SELECT matricula FROM administrador WHERE senha IS NOT NULL AND matricula = :matricula LIMIT 1";
		$dados = array(":matricula" => $matricula);
		$query = conecta::executarSQL($sql, $dados);
		//$resultado = $query->fetch(PDO::FETCH_OBJ);
		$quant = $query->rowCount();
		if($query->rowCount() == 1){
			return true;
		}else{

			$sql = "SELECT matricula FROM unidades WHERE senha IS NOT NULL AND matricula = :matricula LIMIT 1";
			$dados = array(":matricula" => $matricula);
			$query = conecta::executarSQL($sql, $dados);
			//$resultado = $query->fetch(PDO::FETCH_OBJ);
			$quant = $query->rowCount();
			if($quant == 1){
				return true;
			}else{
				return false;
			}
			//return false;
		}

	}



	public function cadastrarSenha($matricula, $senha){

		/*

		$sql = "UPDATE administrador SET senha = :senha WHERE matricula = :matricula";

		$dados = array(":senha" => $senha, ":matricula" => $matricula);
		$query = conecta::executarSQL($sql, $dados);
		//$resultado = $query->fetchAll(PDO::FETCH_OBJ);
		$quant = $query->rowCount();

		if($quant == 1){
			return true;
		}else{
			return false;
		}
		
		return $cadastrou;
		/*
		if($cadastrou){
			return true;
		}else{
			return false;
		}
		*/


		$sql = "SELECT matricula FROM administrador WHERE matricula = :matricula LIMIT 1";
		$dados = array(":matricula" => $matricula);
		$query = conecta::executarSQL($sql, $dados);
		//$resultado = $query->fetch(PDO::FETCH_OBJ);
		$quant = $query->rowCount();
		if($quant == 1){

			$sql = "UPDATE administrador SET senha = :senha WHERE matricula = :matricula";

			$dados = array(":senha" => $senha, ":matricula" => $matricula);
			$query = conecta::executarSQL($sql, $dados);
			//$resultado = $query->fetchAll(PDO::FETCH_OBJ);
			$quant = $query->rowCount();

			if($quant == 1){
				return $quant;
			}else{
				return false;
			}
			
			
			//return true;
		}else{

			$sql = "SELECT id_unidade FROM unidades WHERE matricula = :matricula LIMIT 1";
			$dados = array(":matricula" => $matricula);
			$query = conecta::executarSQL($sql, $dados);
			$resultado = $query->fetch(PDO::FETCH_OBJ);
			$quant = $query->rowCount();
			if($quant == 1){

				$sql = "UPDATE unidades SET senha = :senha WHERE id_unidade = :id_unidade";

				$dados = array(":senha" => $senha, ":id_unidade" => $resultado->id_unidade);
				$query = conecta::executarSQL($sql, $dados);
				//$resultado = $query->fetchAll(PDO::FETCH_OBJ);
				$quant = $query->rowCount();

				if($quant == 1){
					return $quant;
				}else{
					return false;
				}
					
				
				//return true;
			}else{

						




			}






		}





	}



}



?>