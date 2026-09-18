<?php
include_once '../controle/auto_load.class.php';
new auto_load();
header("Content-Type: text/html; charset=UTF-8",true);

$acao = "";
//verifica passagem de acão
if(isset($_REQUEST['acao'])){

	$acao = $_REQUEST['acao'];
	$id_unidade = "";
	$data_inicio = "";
	$hora_inicio = "";
	$data_final = "";
	$hora_final = "";
	$vagas = "";
	
	
	
	if($acao == "cadastrar"){
		$plantao = new plantao();
		
		if(isset($_REQUEST['id_unidade'])){
			$plantao->setIdUnidade($_REQUEST['id_unidade']);
		}		
		if(isset($_REQUEST['data_inicio'])){
			$plantao->setDataInicio($_REQUEST['data_inicio']);
		}
		if(isset($_REQUEST['hora_inicio'])){
			$plantao->setHoraInicio($_REQUEST['hora_inicio']);
		}
		if(isset($_REQUEST['data_final'])){
			$plantao->setDataFinal($_REQUEST['data_final']);
		}
		if(isset($_REQUEST['hora_final'])){
			$plantao->setHoraFinal($_REQUEST['hora_final']);
		}
		if(isset($_REQUEST['vagas'])){
			$plantao->setVagas($_REQUEST['vagas']);
		}
		if(isset($_REQUEST['motorista'])){
			$plantao->setMotorista($_REQUEST['motorista']);
		}else{
			$plantao->setMotorista("0");
		}
		$m = $plantao->getMotorista();
		$cadastrar = $plantao->cadastrarPlantao();
		
		var_dump(json_encode($cadastrar));


		//LISTAR PLANTÕES
	}else if($acao == "listar"){

	

		$matricula = NULL;
		$se = NULL;

		if(isset($_REQUEST['matricula'])){
			$matricula = $_REQUEST['matricula'];
		}
		if(isset($_REQUEST['se'])){
			$se = $_REQUEST['se'];
		}	

		session_start();
		$_SESSION['matricula'] = $matricula;
		
		echo "<script>window.location.href=\"../view/listar_plantao.php?se=".$se."\";</script>;";
	




	}else if($acao == "inscrever"){

		$id_plantao = $_REQUEST["id_plantao"];
		$motorista = "";
		if($_REQUEST["motorista"]){
			$motorista = $_REQUEST["motorista"];
		}else{
			$motorista = 0;
		}

		$funcoes = new funcoes();

		//$funcao = $_REQUEST["funcao"];
		$telefone = $funcoes->somenteNumero($_REQUEST["telefone"]);
		$celular = $funcoes->somenteNumero($_REQUEST["celular"]);
		
		session_start();
		if(isset($_SESSION["matricula"])){
			$matricula = $funcoes->somenteNumero($_SESSION['matricula']);			

			$plantao = new plantao();
			$id_colaborador = $plantao->verificarMatricula($matricula);

			if($id_colaborador != false){
				
				$atualizar_dados = $plantao->atualizarDadosFuncionario($matricula, $telefone, $celular);

				$resultado = $plantao->cadastrarInscricao($id_colaborador, $id_plantao, $motorista);
				
					var_dump(json_encode($resultado));

					/*
				
				//if($atualizar_dados){
				if(true){
					$resultado = $plantao->cadastrarInscricao($id_colaborador, $id_plantao, $motorista);
				
					var_dump(json_encode($resultado));
					
				}else{
									
					var_dump(json_encode($atualizar_dados));
					
					
					
				}
				
				*/
				

			}
			
			

		}


		
	}else if($acao == "cancelar"){

		$id_plantao = $_REQUEST["id_plantao"];
		session_start();

		if(isset($_SESSION["matricula"])){
			$matricula = $_SESSION['matricula'];

			$plantao = new plantao();
			$resultado = $plantao->cancelarInscricao($id_plantao, $matricula);

			if($resultado){
				
				var_dump(json_encode($resultado));
			
			}else{
				$retorno = "{'resultado':'false'}";	
				var_dump(json_encode($retorno));
			}


	}
		




	}else if($acao == "verificar"){

		$id_plantao = $_REQUEST["id_plantao"];
		$plantao = new plantao();
		$motorista = $plantao->motorista($id_plantao);

		$retorno = "";
		if($motorista){	
			$retorno = "{'resultado':'true'}";						
		}else{
			$retorno = "{'resultado':'false'}";			
		}

		var_dump(json_encode($retorno));



	}else if($acao == "listar_inscritos"){

		$id_plantao = $_REQUEST["id_plantao"];
		$plantao = new plantao();
		$lista = $plantao->verInscritos($id_plantao);


		$retorno = "";
		if($lista){	
			$retorno = $lista;						
		}else{
			$retorno = "{'resultado':'false'}";			
		}

		var_dump(json_encode($retorno));

	}else if($acao == "presenca"){

		$presenca = false;

		$id_plantao = $_REQUEST["id_plantao"];
		$id_cadastrado = $_REQUEST["id_cadastrado"];
		$camposMarcados1 = $_REQUEST["camposMarcados1"];
		$camposMarcados2 = $_REQUEST["camposMarcados2"];

		if(isset($_REQUEST["camposMarcados3"])){
			$camposMarcados3 = $_REQUEST["camposMarcados3"];
		}else{
			$camposMarcados3 = NULL;
		}

		if(isset($_REQUEST["camposMarcados3"])){
			$camposMarcados4 = $_REQUEST["camposMarcados4"];
		}else{
			$camposMarcados4 = NULL;
		}
		

		$plantao = new plantao();
		$registrar_horarios = $plantao->registrarHorarios($id_plantao, $id_cadastrado, $camposMarcados1, $camposMarcados2, $camposMarcados3, $camposMarcados4);
		//$presenca = $plantao->presenca($id_plantao, $id_colaboradores); //REORGANIZAR O ARRAY COM OS COLABORADORES QUE ESTAVAM PRESENTES NO PLANTÃO


		$retorno = "";
		if($registrar_horarios){	
			$retorno = "{'resultado':'true'}";					
		}else{
			$retorno = "{'resultado':'false'}";			
		}

		//var_dump(json_encode($retorno));
		var_dump(json_encode($registrar_horarios));


	}else if($acao == "registrar_presenca"){

		$registrar_presenca = false;

		$id_plantao = null;
		$id_cadastrado = null;

		if(isset($_REQUEST["id_plantao"])){
			$id_plantao = $_REQUEST["id_plantao"];
		}

		if(isset($_REQUEST["id_cadastrado"])){
			$id_cadastrado = $_REQUEST["id_cadastrado"];
		}
		
		if($id_plantao != null || $id_plantao != "" || $id_cadastrado != null || $id_cadastrado != ""){
			$plantao = new plantao();
			$registrar_presenca = $plantao->registrarPresenca($id_plantao, $id_cadastrado);
		}

		
		//$presenca = $plantao->presenca($id_plantao, $id_colaboradores); //REORGANIZAR O ARRAY COM OS COLABORADORES QUE ESTAVAM PRESENTES NO PLANTÃO
		//$registrar_presenca = true;

		$retorno = "";
		if($registrar_presenca){	
			$retorno = "{'resultado':'true'}";					
		}else{
			$retorno = "{'resultado':'false'}";			
		}

		//var_dump(json_encode($retorno));
		var_dump(json_encode($retorno));


	}else if($acao == "registrar_falta"){

		$registrar_falta = false;

		$id_plantao = null;
		$id_cadastrado = null;

		if(isset($_REQUEST["id_plantao"])){
			$id_plantao = $_REQUEST["id_plantao"];
		}

		if(isset($_REQUEST["id_cadastrado"])){
			$id_cadastrado = $_REQUEST["id_cadastrado"];
		}
		
		if($id_plantao != null || $id_plantao != "" || $id_cadastrado != null || $id_cadastrado != ""){
			$plantao = new plantao();
			$registrar_falta = $plantao->registrarFalta($id_plantao, $id_cadastrado);
		}

		
		//$presenca = $plantao->presenca($id_plantao, $id_colaboradores); //REORGANIZAR O ARRAY COM OS COLABORADORES QUE ESTAVAM PRESENTES NO PLANTÃO
		//$registrar_presenca = true;

		$retorno = "";
		if($registrar_falta){	
			$retorno = "{'resultado':'true'}";					
		}else{
			$retorno = "{'resultado':'false'}";			
		}

		//var_dump(json_encode($retorno));
		var_dump(json_encode($retorno));


	}else if($acao == "deletar"){

		$id_plantao = $_REQUEST["id_plantao"];

		$plantao = new plantao();
		$deletar = $plantao->deletarPlantao($id_plantao);


		$retorno = "";
		if($deletar){	
			$retorno = "{'resultado':'true'}";					
		}else{
			$retorno = "{'resultado':'false'}";			
		}

		var_dump(json_encode($retorno));



	}else if($acao == "reativar"){

		$id_plantao = $_REQUEST["id_plantao"];

		$plantao = new plantao();
		$reativar = $plantao->reativarPlantao($id_plantao);


		$retorno = "";
		if($reativar){	
			$retorno = "{'resultado':'true'}";					
		}else{
			$retorno = "{'resultado':'false'}";			
		}

		var_dump(json_encode($retorno));



	}else if($acao == "dados"){

		$id_plantao = $_REQUEST["id_plantao"];

		$plantao = new plantao();
		$dados = $plantao->dadosPlantao($id_plantao);


		$retorno = "";
		if($dados){	
			//$retorno = "{'resultado':'true'}";					
			$retorno = $dados;
		}else{
			$retorno = "{'resultado':'false'}";			
		}

		var_dump(json_encode($retorno));



	}else if($acao == "unidade"){

		$id_unidade = $_REQUEST["id_unidade"];

		$plantao = new plantao();
		$dados = $plantao->dadosUnidade($id_unidade);


		$retorno = "";
		if($dados){	
			//$retorno = "{'resultado':'true'}";					
			$retorno = $dados;

		}else{
			$retorno = "{'resultado':'false'}";			
		}


  		
		var_dump(json_encode($retorno));


	}else if($acao == "alterar"){

		$plantao = new plantao();
		
		if(isset($_REQUEST['id_plantao'])){
			$plantao->setIdPlantao($_REQUEST['id_plantao']);
		}		
		if(isset($_REQUEST['id_unidade'])){
			$plantao->setIdUnidade($_REQUEST['id_unidade']);
		}		
		if(isset($_REQUEST['data_inicio'])){
			$plantao->setDataInicio($_REQUEST['data_inicio']);
		}
		if(isset($_REQUEST['hora_inicio'])){
			$plantao->setHoraInicio($_REQUEST['hora_inicio']);
		}
		if(isset($_REQUEST['data_final'])){
			$plantao->setDataFinal($_REQUEST['data_final']);
		}
		if(isset($_REQUEST['hora_final'])){
			$plantao->setHoraFinal($_REQUEST['hora_final']);
		}
		if(isset($_REQUEST['vagas'])){
			$plantao->setVagas($_REQUEST['vagas']);
		}
		if(isset($_REQUEST['motorista'])){
			$plantao->setMotorista($_REQUEST['motorista']);
		}else{
			$plantao->setMotorista("0");
		}
		
		$alterar = $plantao->alterarPlantao();
		/*
		$retorno = "";
		if($alterar){	
			$retorno = "{'resultado':'true'}";						
		}else{
			$retorno = "{'resultado':'false'}";			
		}

		*/
		//var_dump(json_encode($alterar));
		echo 	json_encode($alterar);


	}
	
	

//se não houver parametro acao apresenta erro	
}else{

	return false;

}




?>