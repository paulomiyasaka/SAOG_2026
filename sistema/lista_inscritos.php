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
    <title>SAOG</title>
 <!-- Required meta tags -->
    <link rel="shortcut icon" href="http://correios.com.br/++theme++correios.site.tema/images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
  
  </head>

  <body>

  
<?php
include "barra_cima.php";
?>
  

	<div class="container">
		
		<?php
			$plantao = new plantao();
			//$plantao->botaoCadastrarPlantao();
		?>

	
		<table class="table">
  <thead>
    <tr class="text-center text-white bg-dark">
      <th scope="col" class="text-center"></th>
      <th scope="col" class="text-center">Unidade</th>
      <th scope="col" class="text-center">Vagas Solicitadas</th>
      <th scope="col" class="text-center">Inscritos</th>
      <th scope="col" class="text-center">Data do Apoio</th>
    </tr>
  </thead>
  <tbody>
    


		<?php 
		$funcoes = new funcoes();
		$lista = $plantao->listaInscritos('2020-08-22 08:00:00');
		//var_dump($lista);
		$i = 1;
		$total = 0;
		foreach ($lista as $key => $value) {
			
			echo "<tr>
		      <th scope=\"row\">".$i++."</th>
		      <td>".$value->nome."</td>
		      <td class=\"text-center\">".$value->vagas."</td>
		      <td class=\"text-center\">".$value->inscritos."</td>
		      <td class=\"text-center\">".$funcoes->diaSemana(date('w', strtotime($value->data))).", ".date('d/m/Y', strtotime($value->data))."</td>
		    </tr>";

		    $total += $value->inscritos;
		}

		echo "<tr>

		      <th scope=\"row\" colspan=\"2\" class=\"text-right bg-dark text-white\">Total de inscrições:</th>
		      <td class=\"text-left bg-dark text-white\">".$total."</td>
		      <td colspan=\"2\" class=\"text-center bg-dark text-white\"></td>
		    </tr>";

		?>

</tbody>
</table>





	<table class="table">
  <thead>
    <tr class="text-center text-white bg-dark">
      <th scope="col" class="text-center"></th>
      <th scope="col" class="text-center">Unidade</th>
      <th scope="col" class="text-center">Vagas Solicitadas</th>
      <th scope="col" class="text-center">Inscritos</th>
      <th scope="col" class="text-center">Data do Apoio</th>
    </tr>
  </thead>
  <tbody>
    


		<?php 
		$funcoes = new funcoes();
		$lista = $plantao->listaInscritos('2020-08-23 08:00:00');
		//var_dump($lista);
		$i = 1;
		$total = 0;
		foreach ($lista as $key => $value) {
			
			echo "<tr>
		      <th scope=\"row\">".$i++."</th>
		      <td>".$value->nome."</td>
		      <td class=\"text-center\">".$value->vagas."</td>
		      <td class=\"text-center\">".$value->inscritos."</td>
		      <td class=\"text-center\">".$funcoes->diaSemana(date('w', strtotime($value->data))).", ".date('d/m/Y', strtotime($value->data))."</td>
		    </tr>";

		    $total += $value->inscritos;
		}

		echo "<tr>

		      <th scope=\"row\" colspan=\"2\" class=\"text-right bg-dark text-white\">Total de inscrições:</th>
		      <td class=\"text-left bg-dark text-white\">".$total."</td>
		      <td colspan=\"2\" class=\"text-center bg-dark text-white\"></td>
		    </tr>";

		?>

</tbody>
</table>






<br><br>


<!--

		<table class="table">
  <thead>
    <tr class="text-center text-white bg-dark">
      <th scope="col" class="text-center"></th>
      <th scope="col" class="text-center">Unidade</th>
      <th scope="col" class="text-center">Vagas Solicitadas</th>
      <th scope="col" class="text-center">Inscritos</th>
      <th scope="col" class="text-center">Data do Apoio</th>
    </tr>
  </thead>
  <tbody>
    


		<?php 
		/*
		$lista = $plantao->listaInscritos('2019-09-15 08:00:00');
		//var_dump($lista);
		$i = 1;
		$total = 0;
		foreach ($lista as $key => $value) {
			
			echo "<tr>
		      <th scope=\"row\">".$i++."</th>
		      <td>".$value->nome."</td>
		      <td class=\"text-center\">".$value->vagas."</td>
		      <td class=\"text-center\">".$value->inscritos."</td>
		      <td class=\"text-center\">".$funcoes->diaSemana(date('w', strtotime($value->data))).", ".date('d/m/Y', strtotime($value->data))."</td>
		    </tr>";
		    $total += $value->inscritos;
		}

		echo "<tr>

		      <th scope=\"row\" colspan=\"2\" class=\"text-right bg-dark text-white\">Total de inscrições:</th>
		      <td class=\"text-left bg-dark text-white\">".$total."</td>
		      <td colspan=\"2\" class=\"text-center bg-dark text-white\"></td>
		    </tr>";
		*/
		?>

</tbody>
</table>

-->
<br><br>

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
				-->
		    	        	
		        	
					
					 <div class="form-group">
						<label for="funcao_motorista">Informe sua função:</label>
						<input type="text" class="form-control" id="funcao_motorista" placeholder="FUNÇÃO" onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>
					  <div class="form-group">
						<label for="telefone_motorista">Telefone da Seção:</label>
						<input type="text" class="form-control" id="telefone_motorista" placeholder="TELEFONE DA SEÇÃO" onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>					  
					  <div class="form-group">
						<label for="celular_motorista">Celular:</label>
						<input type="text" class="form-control" id="celular_motorista" placeholder="CELULAR"  onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>
  
  
			  		<label class="custom-control-label"><h4>Você tem interesse em dirigir veículos dos Correios?</h4></label>
			  		<br>
			  		<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" id="inlineCheckbox1" name="motor" value="0" checked>
					  <label class="form-check-label" for="inlineCheckbox1"> NÃO </label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" id="inlineCheckbox1" name="motor" value="1">
					  <label class="form-check-label" for="inlineCheckbox1"> SIM </label>
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
		        <h3 class="modal-title" id="modalInscreverLongTitle">Confirmar inscrição</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
			  <!--
		        <h3>Deseja confirmar cadastro no plantão?</h3>
				-->
					
					 <div class="form-group">
						<label for="funcao_tratamento">Informe sua função:</label>
						<input type="text" class="form-control" id="funcao_tratamento" placeholder="FUNÇÃO"  onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>
					  <div class="form-group">
						<label for="telefone_tratamento">Telefone da Seção:</label>
						<input type="text" class="form-control" id="telefone_tratamento" placeholder="TELEFONE DA SEÇÃO"  onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>					  
					  <div class="form-group">
						<label for="celular_tratamento">Celular:</label>
						<input type="text" class="form-control" id="celular_tratamento" placeholder="CELULAR"  onkeypress="verificarCampos();" onchange="verificarCampos();">
					  </div>
					  
					  
				</div>
	        
		      <div class="modal-footer">		      	
		      	<button id="btn_inscrever_plantao2" type="button" class="btn btn-success inscrever_plantao" onclick="inscreverPlantao();" disabled="true">Confirmar</button>
		        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>		        
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

				<!-- Modal
		<div class="modal fade" id="modalInscritos" tabindex="-1" role="dialog" aria-labelledby="modalInscritosLongTitle" aria-hidden="true">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h3 class="modal-title" id="modalInscritosLongTitle">Inscritos no plantão:</h3>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>

		      <div class="modal-body">
		       
		      		<table class="table">
					  <thead>
					    <tr>
					      <th scope="col" class="text-center">#</th>
					      <th scope="col" class="text-center">Nome</th>
					      <th scope="col" class="text-center">Lotação</th>
					    </tr>
					  </thead>
					  <tbody>
					  	
					  </tbody>
					</table>

		      </div>

		      <div class="modal-footer">
		        <button id="btn_imprimir" type="button" class="btn btn-primary" onclick="imprimirInscritos();">Imprimir</button>
		        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>	
		      </div>
		    </div>
		  </div>
		</div>

		-->

		<!-- MODAL CADASTRAR UNIDADE -->

		<!-- Modal -->
		<div class="modal fade" id="modalUnidade" tabindex="-1" role="dialog" aria-labelledby="examplemodalUnidade" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h2 class="modal-title" id="examplemodalUnidade">Cadastrar Unidade</h2>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        	<div class="container-fluid">
		
		<form>
		  <div class="form-group">
			<label for="nome_unidade">Nome da Unidade</label>
			<input type="text" name="nome_unidade" class="form-control" id="nome_unidade" placeholder="Nome da Unidade">
		  </div>
		  
		  <div class="input-group mb-3">
		  <div class="input-group-prepend">
			<label class="input-group-text" for="tipo_trabalho">Tipo do Trabalho</label>
		  </div>
		  <select class="custom-select" id="tipo_trabalho" name="tipo_trabalho" style="height: 35px; width: 100%">
			<option value="0" selected>Escolha Tipo do Trabalho</option>
			<option value="Tratamento">Tratamento</option>
			<option value="Distribuição">Distribuição</option>
		  </select>
		</div>
		  
		  <div class="form-group">
			<label for="endereco">Endereço da Unidade</label>
			<input type="text" name="endereco" class="form-control" id="endereco" placeholder="Endereço da Unidade">
		  </div>
		  <div class="form-group">
			<label for="gerente">Gerente</label>
			<input type="text" name="gerente" class="form-control" id="gerente" placeholder="Gerente">
		  </div>
		  <div class="form-group">
			<label for="matricula_gerente">Matrícula do Gerente:</label>
			<input type="text" name="matricula_gerente" class="form-control" id="matricula_gerente" placeholder="Matrícula do Gerente">
		  </div>
		  <div class="form-group">
			<label for="tel_gerente">Telefone do Gerente: (61) </label>
			<input type="text" name="tel_gerente" class="form-control" id="tel_gerente" placeholder="Telefone do Gerente">
		  </div>
		  <div class="form-group">
			<label for="tel_gerente2">Telefone 2 do Gerente: (61) </label>
			<input type="text" name="tel_gerente2" class="form-control" id="tel_gerente2" placeholder="Telefone 2 do Gerente">
		  </div>
		  <div class="form-group">
			<label for="tel_centro">Telefone do Centro: (61) </label>
			<input type="text" name="tel_centro" class="form-control" id="tel_centro" placeholder="Telefone do Centro">
		  </div>
		  <input type="hidden" name="acao" value="cadastrar">
		</form>
		
	</div>
		      </div>
		      <d<div class="modal-footer">
		      	<button id="btn_cadastrar_unidade" type="submit" class="btn btn-success" onclick="cadastrarUnidade();">Cadastrar</button>		        
		        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
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
				  <input class="form-check-input" onchange="habilitarAlterar();" type="radio" name="motorista" id="motoristaNao" value="0" checked>
				  <label class="form-check-label" for="motoristaNao">
				    NÃO
				  </label>
				</div>
				<div class="form-check form-check-inline">
				  <input class="form-check-input" onchange="habilitarAlterar();" type="radio" name="motorista" id="motoristaSim" value="1">
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

	
</body>
</html>