  <?php
include_once '../controle/auto_load.class.php';
new auto_load();
$funcoes = new funcoes();
$funcoes->charset();
session_start();
?>

<!doctype html>
<html lang="pt-br">
  <head>  

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SAOG</title>
 <!-- Required meta tags -->
   <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  

 


 

  
  </head>

  <body>

  
      
<?php
$plantao = new plantao();
include "barra_cima.php";
$se = "CS";
if(isset($_GET['se']) AND $_GET['se'] != ""){
  
  $se = $_GET['se'];
  $se = str_replace('SE/','',$se);

}

?>
  

	<div class="container">
		
		<?php
			//$plantao = new plantao();
			//$plantao->botaoCadastrarPlantao();
		?>

	<div class="row justify-content-md-center">
					<div class="col-sm-12 col-md-8 col-lg-6  align-self-center">
					<div class="pricing-header pt-md-5 pb-md-4 mx-auto text-center">
				         
			<h4 class="lead text-center"><p class="text-danger h3 text-center"><span class="h1">Atenção: </span></p> O colaborador deverá se inscrever com o<br>aval do seu gestor imediato.</h4>  
			<button type="button" id="btn_info" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#info">
				Informações e Procedimentos Operacionais
			</button>
			<?php 
			$pagina = $plantao->contatoDuvida($se);			
			include_once "contatos/".$pagina;
			
			?>	
				    
		
					</div>
					</div>
					</div>

					<!-- Button trigger modal -->


			<!--
					<div class="row justify-content-md-center">
			<div class="col-8  align-self-center">
			<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
			
			  <h4 class="lead text-center">Este sistema permite a inscrição de colaboradores que estejam <b>dispostos a contribuir</b> no apoio à Distribuição Externa. Ao final da página você v</h4>			
			
			  <h4 class="lead text-center"><p class="text-danger h3 text-center">Atenção: </p> O colaborador deverá se inscrever com o<br>aval do seu gestor imediato.</h4>  
			  <h4 class="lead text-justify"><p class="text-center"><u>Contatos:</u> <br></p>
			  <p class="text-center">Vanusa 	2141-8112 / Gislaine	2141-8207 </p>
			  <p class="text-center">Leir   	2141-8002 / Wanda  	2141-8004 </p>	
			   </h4> 
			</div>
			</div>						
			</div>
			
			<div class="row justify-content-md-center">
				<div class="col-10 align-self-center">
					<div class="pricing-header pt-md-5 pb-md-4 mx-auto text-center">
						<div class="alert alert-warning" role="alert">
													
							<p class="lead text-center">Recomenda-se a leitura dos documentos abaixo:</p>
							

							<br>
							<a class="btn btn-warning text-dark" href="../docs/MANDIS_MODULO_06_CAPITULO_001_Anexo_04.pdf" target="_blank" role="button"><b>MANDIS - MÓDULO 06 - CAPÍTULO 01 - Anexo 04</b></a>
							<br><br>
							<a class="btn btn-warning text-dark" href="../docs/TLT_ENTREGA_OBJETO_POSTAL_CAPTURA_IMAGEM.pdf" target="_blank" role="button"><b>TLT - Entrega de Objeto Postal - Captura de Imagem</b></a>
							<br><br>
							<a class="btn btn-warning text-dark" href="../docs/TLT_SRO_MOVEL_PRESTACAO_CONTAS.pdf" target="_blank" role="button"><b>TLT - SRO Móvel - Prestação de Contas</b></a>
						  

						</div>
				    </div>
				</div>
			</div>
			
			<div class="row justify-content-md-center">
			<div class="col-10  align-self-center">
			<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
			  <p class="lead text-justify">A UniCorreios disponibilizou, na modalidade EAD, as capacitações para empregados da área administrativa que irão trabalhar nas unidades operacionais no período de contigência:</p>
			  <p class="lead text-center"><a href="http://univirtual.correios.com.br/course/view.php?id=1129" target="_blank">Plano de Continuidade do Negócio – PCN – Tratamento</a></p>
			  <p class="lead text-center"><a href="http://univirtual.correios.com.br/course/view.php?id=1130" target="_blank">Plano de Continuidade do Negócio – PCN – Distribuição</a></p>
			  <p class="lead text-center"><a href="http://univirtual.correios.com.br/course/view.php?id=944" target="_blank">Plano de Continuidade do Negócio – PCN – Transporte</a></p>
			  <br>
			  <p class="lead text-center">Os cursos também podem ser acessados na página:<br><a href="http://univirtual.correios.com.br" target="_blank">http://univirtual.correios.com.br</a>, aba “Negócios”</p>
			    
			</div>
			</div>						
			</div>
			-->
			<div class="row justify-content-md-center">
			<div class="col-10 align-self-center">
			<div class="form-group pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
				<h1 class="display-4">Verifique os plantões disponíveis para inscrição selecionando uma SE:</h1>
				<select class="custom-select" style="height: 35px" id="selecionarSE" onchange="buscarPlantaoSE()" aria-label="Default select example">
					<option disabled selected>Selecione</option>
					<option value="ACR">SE/ACR</option>
					<option value="AL">SE/AL</option>
					<option value="AM">SE/AM</option>
					<option value="AP">SE/AP</option>
					<option value="BA">SE/BA</option>
					<option value="BSB">SE/BSB</option>
					<option value="CE">SE/CE</option>
					<option value="ES">SE/ES</option>
					<option value="GO">SE/GO</option>
					<option value="MA">SE/MA</option>
					<option value="MG">SE/MG</option>
					<option value="MS">SE/MS</option>
					<option value="MT">SE/MT</option>
					<option value="PA">SE/PA</option>
					<option value="PB">SE/PB</option>
					<option value="PE">SE/PE</option>
					<option value="PI">SE/PI</option>
					<option value="PR">SE/PR</option>
					<option value="RJ">SE/RJ</option>
					<option value="RN">SE/RN</option>
					<option value="RO">SE/RO</option>
					<option value="RR">SE/RR</option>
					<option value="RS">SE/RS</option>
					<option value="SC">SE/SC</option>
					<option value="SE">SE/SE</option>
					<option value="SPI">SE/SPI</option>
					<option value="SPM">SE/SPM</option>
					<option value="TO">SE/TO</option>
				</select> 
		    </div>
			</div>
			</div>

			


		

		<?php 
		$plantao->setSE($se);
		$plantao->listarPlantao();
		

		?>


<!-- Modal -->
<div class="modal fade" id="info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title h3" id="exampleModalLabel">Informações e Procedimentos</h1>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-md-center">
				<div class="col-10 align-self-center">
					<div class="pricing-header pt-md-5 pb-md-4 mx-auto text-center">
						<div class="alert alert-warning" role="alert">
													
							<p class="lead text-center">Recomenda-se a leitura dos documentos abaixo:</p>
							<br>
							<!--
							<a class="btn btn-warning text-dark" href="../docs/MANDIS_MODULO_06_CAPITULO_001_Anexo_04.pdf" target="_blank" role="button"><b>MANDIS - MÓDULO 06 - CAPÍTULO 01 - Anexo 04</b></a>
							<br><br>
							-->
							<a class="btn btn-warning text-dark" href="../docs/TLT_ENTREGA_OBJETO_POSTAL_CAPTURA_IMAGEM.pdf" target="_blank" role="button"><b>TLT - Entrega de Objeto Postal - Captura de Imagem</b></a>
							<br><br>
							<a class="btn btn-warning text-dark" href="../docs/TLT_SRO_MOVEL_PRESTACAO_CONTAS.pdf" target="_blank" role="button"><b>TLT - SRO Móvel - Prestação de Contas</b></a>
  							<br><br>
							<?php 
								$pagina = $plantao->contatoDuvida($se);			
								include "contatos/".$pagina;
								
							?>

						</div>
				    </div>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>




	<!-- MODAL PARA CONFIRMAR INSCRIÇÃO -->


		<!-- Modal -->
		<div class="modal fade" id="modalInscreverMotorista" tabindex="-1" role="dialog" aria-labelledby="modalInscreverTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 class="modal-title" id="modalInscreverLongTitle">Confirmar inscrição</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
			  <!--
		        <h3>Deseja confirmar cadastro no plantão?</h3> 
				<hr>
				
		    	        	
		        	
					
					 <div class="form-group">
						<label for="funcao_motorista">Informe seu cargo ou função:</label>
						<input type="text" class="form-control" id="funcao_motorista" placeholder="Cargo ou Função" onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>
					-->
					  <div class="form-group">
						<label for="telefone_motorista">Telefone da Seção/Unidade:</label>
						<input type="text" class="form-control" id="telefone_motorista" placeholder="(00) 0000-0000" onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>					  
					  <div class="form-group">
						<label for="celular_motorista">Celular:</label>
						<input type="text" class="form-control" id="celular_motorista" placeholder="(00) 00000-0000"  onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>
  
  
			  		<label class="custom-control-label"><h4>Você possui CNH e tem interesse em dirigir veículos dos Correios?</h4></label>
			  		<br>
			  		<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" id="inlineCheckbox1" name="motor" value="0">
					  <label class="form-check-label" for="inlineCheckbox1"> NÃO </label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" id="inlineCheckbox2" name="motor" value="1" checked>
					  <label class="form-check-label" for="inlineCheckbox2"> SIM </label>
					</div>
			  		
				</div>	

		        
		      <div class="modal-footer">		      	
		      	<button id="btn_inscrever_plantao" type="button" class="btn btn-success inscrever_plantao" onclick="inscreverPlantao();" disabled="true">Confirmar</button>
		        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>		        
		      </div>
		    </div>
		  </div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="modalInscreverTratamento" tabindex="-1" role="dialog" aria-labelledby="modalInscreverTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 class="modal-title" id="modalInscreverLongTitle">Confirmar inscrição - Tratamento</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
			  <!--
		        <h3>Deseja confirmar cadastro no plantão?</h3>
				
					
					 <div class="form-group">
						<label for="funcao_tratamento">Informe seu cargo ou função:</label>
						<input type="text" class="form-control" id="funcao_tratamento" placeholder="Cargo ou Função"  onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>
					-->
					  <div class="form-group">
						<label for="telefone_tratamento">Telefone da Seção:</label>
						<input type="text" class="form-control" id="telefone_tratamento" placeholder="0000-0000"  onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>					  
					  <div class="form-group">
						<label for="celular_tratamento">Celular: (61)</label>
						<input type="text" class="form-control" id="celular_tratamento" placeholder="00000-0000"  onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>
					  
					  
				</div>
	        
		      <div class="modal-footer">		      	
		      	<button id="btn_inscrever_plantao2" type="button" class="btn btn-success inscrever_plantao" onclick="inscreverPlantao();" disabled="true">Confirmar</button>
		        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>		        
		      </div>
		    </div>
		  </div>
		</div>

<div id="modalLoading" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
<div id="cadastroOK" class="alert text-center" role="alert">
  <h4>Aguarde</h4>
  <img src="../img/load.gif">
</div>
</div>
</div>
</div>


<!-- Modal -->
		<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modalDeleteTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 class="modal-title" id="modalDeleteLongTitle">Confirmar Cancelamento</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <h3>Deseja confirmar o cancelamento deste plantão?</h3>
	  				
				</div>
	        
		      <div class="modal-footer">		      	
		      	<button id="deletar_plantao" type="button" class="btn btn-success" onclick="deletarPlantao();">Confirmar</button>
		        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>		        
		      </div>
		    </div>
		  </div>
		</div>





		<div class="modal fade" id="modalCancelInscrever" tabindex="-1" role="dialog" aria-labelledby="modalCancelInscreverTitle" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 class="modal-title" id="modalCancelInscreverLongTitle">Confirmar cancelamento</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <h3>Deseja confirmar o cancelamento da inscrição neste plantão?</h3>
		      </div>
		      <div class="modal-footer">		      	
		      	<button id="cancelar_inscrever_plantao" type="button" class="btn btn-success" onclick="cancelarInscreverPlantao();">Confirmar</button>
		        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>		        
		      </div>
		    </div>
		  </div>
		</div>

	
<!-- ALERTA CADASTRO OK -->
<div id="modalCadastroOK" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
<div id="cadastroOK" class="alert alert-success" role="alert">
  <h2 class="alert-heading text-center">Sucesso!</h2>
  <h4>Registro efetuado com sucesso.</h4>
</div>
</div>
</div>
</div>

<!-- ALERTA CADASTRO ERROR -->
<div id="modalCadastroError" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
<div id="cadastroError" class="alert alert-danger" role="alert">
  <h2 class="alert-heading text-center">Erro!</h2>
  <h4>Algo deu errado ao tentar efetuar o cadastro.<br>Verifique os seus dados e tente novamente!</h4>
</div>
</div>
</div>
</div>



	<!-- MODAL CADASTRAR PLANTAO -->

		<div class="modal fade" id="modalPlantao" tabindex="-1" role="dialog" aria-labelledby="cadastrarPlantao" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h2 class="modal-title text-center" id="cadastrarPlantao">Cadastrar Plantão</h2>
		        <h2 class="modal-title text-center" id="alterarPlantao" hidden>Alterar Plantão</h2>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>


    <div class="modal-body">		
		<div class="container-fluid">
	
		<div class="row">
			<div class="col">
			<form>
				<div class="input-group mb-3">
				  <div class="input-group-prepend">
					<label class="input-group-text" for="tipo_trabalho">Unidade e Tipo de Trabalho</label>
				  </div>
				  <select class="custom-select" id="id_unidade" name="id_unidade" onchange="habilitarAlterar();" style="height: 35px; width: 100%" required>
				<option value="0" selected>Escolha a Unidade</option>
				
			<?php
				$plantao = new plantao();
				$plantao->listarUnidadesPlantao();				
			?> 
			  </select>
			</div>
			</div>
		</div>
		
		  <div class="row">
		  <div class="col">
		  <div class="form-group">
			<label for="data_inicio">Data Inicial:</label>
			<input type="text" name="data_inicio" onchange="habilitarAlterar();" class="form-control" id="data_inicio" placeholder="Data Inicial - dd/mm/yyyy" required>
		  </div>
		  </div>
		  
		  
		  <div class="col">
		  <div class="form-group">
			<label for="hora_inicio">Hora de Início:</label>
			<select class="form-control" style="height: 35px;" id="hora_inicio" name="hora_inicio" onchange="habilitarAlterar();" required>
				<!-- <option value='NULL' selected>Selecione um horário</option> -->
			  <?php $plantao->gerarHorario(); ?>			  
			</select>
		  </div>
		  </div>
		  </div>
		  
		  <div class="row">
		  <div class="col">
		  <div class="form-group">
			<label for="data_final">Data Final:</label>
			<input type="text" name="data_final" onchange="habilitarAlterar();" class="form-control" id="data_final" placeholder="Data Final - dd/mm/yyyy" required>
		  </div>
		  </div>
		  
		  <div class="col">
		  <div class="form-group">
			<label for="hora_final">Hora do Término:</label>
			<select class="form-control" style="height: 35px;" id="hora_final" name="hora_final" onchange="habilitarAlterar();" required>
				<!-- <option value='NULL' selected>Selecione um horário</option> -->
			  <?php $plantao->gerarHorario(); ?>	
			</select>
		  </div>
		  </div>
		  </div>
		  
		  <div class="row">
		  <div class="col">
		  <div class="form-group">
			<label for="vagas">Quantidade de Vagas Total</label>
			<input type="text" name="vagas" class="form-control" onchange="habilitarAlterar();" id="vagas" placeholder="Quantidade de Vagas" required>
		  </div> 
		</div>
		  <div class="col">
		  	<div class="form-group">
		  		<label class="custom-control-label">Precisará de motoristas?</label>
		  		<br>
		  		<div class="form-check form-check-inline">
				  <input class="form-check-input" onchange="habilitarAlterar();" type="radio" name="motorista" id="motoristaNao" value="0" >
				  <label class="form-check-label" for="motoristaNao">
				    NÃO
				  </label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" onchange="habilitarAlterar();" type="radio" name="motorista" id="motoristaSim" value="1" checked>
				  <label class="form-check-label" for="motoristaSim">
				    SIM
				  </label>
				</div>	 		

		  	</div>		  	
			 </div>
			  </div>

		</form>
		
	</div>
		</div>
		      <div class="modal-footer">
		      	<button id="btn_cadastrar_plantao" type="submit" class="btn btn-success" onclick="cadastrarPlantao();">Cadastrar</button>
		        <button id="btn_editar_plantao" type="submit" class="btn btn-success" onclick="editarPlantao();" disabled hidden>Alterar</button>
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
		      </div>
		    </div>
		  </div>
		</div>
	
	</div>
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
  <script src="../js/script.js"></script>

  <script>
	  
    $(document).ready(function(){

      if (typeof(Storage) !== 'undefined') {
        if(localStorage.getItem("matricula") == null){        
          //alert(localStorage.getItem("nome"));
          window.location.href = "../index.php";
        }
      }else {
        alert('Utilize um destes navegadores: Google Chrome ou Mozilla Firefox.');
      }

    });  
  
  </script>
	
</body>
</html>