<?php
include_once '../controle/auto_load.class.php';
new auto_load();
$funcoes = new funcoes();
$funcoes->charset();

	$arquivo = null;
	$temp = null;
	$nome = null;
	$tipo = null;
	$tipo_upload = null; // deve ser para encomenda, mensagem, logística ou internacional.

	if(isset($_FILES['xml'])){
		$arquivo = $_FILES['xml'];
		$temp = $arquivo['tmp_name'];
		$nome = $arquivo['name'];
		$tipo = $arquivo['type'];
	}

	if($tipo !== "text/xml"){
		//return "A base de dados deve ser estar em XML.";
		echo "<script>alert(\"A base de dados deve ser estar em XML.\");</script>";
		echo "<script>window.history.back();</script>";
		return false;
	}else{
		//echo "ARQUIVO XML: ".$nome."<br><br>";
		
		$xml = simplexml_load_file($arquivo['tmp_name']);

		$matricula = null;
		$nome = null;
		$se = null;
		$lotacao = null;
		$sigla_lotacao = null;
		$mcu = null;
		$cargo = null;
		$especialidade = null;
		$funcao = null;
		$localizacao = null;
		$afastado = null;
		$genero = null;

		$quant_row = count($xml->Worksheet->Table->Row);

		for ($i=0; $i < $quant_row; $i++) { 
			
			foreach ($xml->Worksheet->Table->Row[$i]->attributes('ss', 'AutoFitHeight') as $key => $value) {
					
					//if($key === "Index"){

						$quant_cell = count($xml->Worksheet->Table->Row[$i]->Cell);

						for ($j=0; $j < $quant_cell; $j++) { 

							$colunas = $xml->Worksheet->Table->Row[$i]->Cell[$j]->Data;							
							$quant_data = count($colunas);		

							foreach ($colunas as $key => $value) {		

													

								if($matricula == null && $value == "matricula"){
										$matricula = $j;
										$linha = $i;

										//echo "matricula  --- contador J: ".$j;

								}


								if($nome == null && $value == "nome"){
										$nome = $j;


								}

								if($se == null && $value == "se"){
										$se = $j;

								}

								if($lotacao == null && $value == "lotacao"){
									$lotacao = $j;
								}

								if($sigla_lotacao == null && $value == "sigla_lotacao"){
									$sigla_lotacao = $j;
								}

								if($mcu == null && $value == "mcu"){
										$mcu = $j;

								}

								if($cargo == null && $value == "cargo"){
										$cargo = $j;

								}

								if($especialidade == null && $value == "especialidade"){
										$especialidade = $j;

								}

								if($funcao == null && $value == "funcao"){
										$funcao = $j;

								}

								if($localizacao == null && $value == "localizacao"){
										$localizacao = $j;

								}		

								if($afastado == null && $value == "afastado"){
										$afastado = $j;

								}	

								if($genero == null && $value == "genero"){
										$genero = $j;

								}					



							}// for each colunas


							//}// quant data
						

						}// for cells

						

					//}// if
				

				}// foreach
		
	}//for linhas

	$xmlError = array();

for ($i = 1; $i < $quant_row; $i++) { 
/*
		$indice_matricula = 0;
		$indice_nome = 1;
		$indice_lotacao = 2;
		$indice_funcao = 3;

	if($matricula != $indice_matricula || $indice_nome != $nome || $indice_lotacao != $lotacao || $indice_funcao != $funcao){

		$erro = "As colunas devem estar na ordem: matricula, nome, lotacao, funcao.";
		//$erro = $index_nacional;
		echo "<script>alert(\"$erro\");</script>";
		echo "<script>window.history.back();</script>";
		return false;
	}
*/
	$quant_cell = count($xml->Worksheet->Table->Row[$i]->Cell);
	
	$dadosXML = new xml();
	$index = null;	

	for ($j=0; $j < $quant_cell; $j++) {

		$colunas = $xml->Worksheet->Table->Row[$i]->Cell[$j]->Data;	
		
		//echo $colunas;
		//echo "<br>";

			switch ($j) {

				case $matricula:
					$colunas = $funcoes->somenteNumero($colunas);
					$dadosXML->setMatricula($colunas);
					break;


				case $nome:
					$colunas = strtoupper($colunas);
					$dadosXML->setNome($colunas);
					break;

				case $se:
					$colunas = strtoupper($colunas);
					$dadosXML->setSE($colunas);
					break;


				case $lotacao:
					$colunas = strtoupper($colunas);
					$dadosXML->setLotacao($colunas);
					break;

				case $sigla_lotacao:
					$colunas = strtoupper($colunas);
					$dadosXML->setSiglaLotacao($colunas);
					break;

				case $mcu:
					$colunas = $funcoes->somenteNumero($colunas);
					$dadosXML->setMCU($colunas);
					break;

				case $cargo:
					$colunas = strtoupper($colunas);
					$dadosXML->setCargo($colunas);
					break;

				case $especialidade:
					$colunas = strtoupper($colunas);
					$dadosXML->setEspecialidade($colunas);
					break;

				case $funcao:
					$colunas = strtoupper($colunas);
					$dadosXML->setFuncao($colunas);
					break;


				case $localizacao:
					$colunas = strtoupper($colunas);
					$dadosXML->setlocalizacao($colunas);
					break;

				case $afastado:
					$colunas = strtoupper($colunas);
					$dadosXML->setAfastado($colunas);
					break;

				case $genero:
					$colunas = strtoupper($colunas);
					$dadosXML->setGenero($colunas);
					break;


				default:
					# code...
					break;
			}



			$colunas = null;

		
	

	}


$errorGravar = $dadosXML->gravarDados();
		
		if($errorGravar){
			array_push($xmlError, $errorGravar);
		}

		$dadosXML = null;
		$errorGravar = null;
	

	
}//for

	$quant_erro = count($xmlError);
	$upload = ($quant_row - 1) - $quant_erro;
	echo "<script>alert(\"Total atualizado: $upload\");</script>";
	echo "<script>window.history.back();</script>";

	/*

	//retornará FALSE, caso não ocorra error,
	//retorna o array, se houver error.
	if($quant_erro){
		$upload = ($quant_row - 1) - $quant_erro;
		echo "<script>alert(\"Total atualizado: $upload\");</script>";
		var_dump($xmlError);
		return false;
	}else{
		//return false;
		echo "<script>alert(\"Funcionários cadastrados ou alterados com sucesso!\");</script>";
		echo "<script>window.history.back();</script>";
	}


	*/

}

?>