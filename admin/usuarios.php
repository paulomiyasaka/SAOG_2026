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
	
	
	if($acao == "colaboradores"){
		$plantao = new plantao();
		
		if(isset($_REQUEST['matricula'])){
			$plantao->setMatricula($_REQUEST['matricula']);
		}		
		if(isset($_REQUEST['nome'])){
			$plantao->setNome($_REQUEST['nome']);
		}
		if(isset($_REQUEST['lotacao'])){
			$plantao->setLotacao($_REQUEST['lotacao']);
		}
		if(isset($_REQUEST['funcao'])){
			$plantao->setFuncao($_REQUEST['funcao']);
		}
		
		$cadastrar = $plantao->cadastrarColaboradores();
		
		var_dump(json_encode($cadastrar));


		}else{

			return false;

		}
	
//se não houver parametro acao apresenta erro	
}else{

	return false;

}




?>