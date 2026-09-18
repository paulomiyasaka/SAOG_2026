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
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">  
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="../css/font-awesome.min.css">
  
  <script src="../js/jquery.min.js"></script>
  <script type="text/javascript" src="../js/jquery.mask.js"></script>
  <script src="../js/bootstrap.min.js"></script>  
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
		<br><br>
		<div class="row text-center">
			<div class="col">
				<p class="h4">Você não possui uma senha cadastrada.</p>
				<p class="h5 text-danger">Crie uma senha diferente da sua senha de rede.</p>
			</div>
		</div>
<br><br>
		<div class="row justify-content-around">
			<div class="col-3">
	
<form>
  <div class="form-group">
    <label for="senha1">Senha:</label>
    <input type="password" class="form-control" id="senha1">
  </div>
   <div class="form-group">
    <label for="senha2">Repita a Senha:</label>
    <input type="password" class="form-control" id="senha2">
  </div>
  <input type="hidden" id="matricula" name="matricula" value="<?php echo $_SESSION['matricula']; ?>">
  <button id="btn_cad_senha" type="button" class="btn btn-primary" onclick="criarSenha();">Salvar</button>
</form>


</div>
</div>

	



	<!-- ALERTA CADASTRO OK -->
<div id="modalCadastroOK" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
<div id="cadastroOK" class="alert alert-success" role="alert">
  <h2 class="alert-heading text-center">Sucesso!</h2>
  <h5>Registro efetuado com sucesso.</h5>
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
  <h5>Algo deu errado ao tentar efetuar o cadastro.<br>Verifique os seus dados e tente novamente!</h5>
</div>
</div>
</div>
</div>





</div>
	
</body>
</html>