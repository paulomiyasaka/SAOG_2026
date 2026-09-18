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
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
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
//$plantao = new plantao();
include "barra_cima.php";
?>
  

	<div class="container">




<div class="card">
    <div class="card-header bg-info" id="headingTwo">
      <h5 class="mb-0 text-center">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="text-decoration-line: none;">
          <p class="h3 text-white">Funcionários</p>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body bg-light">
            <div class="row">
              <div class="col text-center">
                <br><br>
                <h2 class="text-center">Importar planilha de efetivo em XML</h2>
                <br>
                
                <h3 class="text-center text-dark">Selecionar XML</h3>
                
                <br>
              </div>
            </div>

            <form enctype="multipart/form-data" method="POST" action="xml_funcionarios.php">
                <div class="row justify-content-end">
                <div class="col-6">

                    <div class="custom-file">
                  <input type="file" id="xml" name="xml" accept=".xml">
                  <label class="custom-file-label" for="xml"></label>
                </div>
                </div>
                <div class="col-4">
                  <input type="hidden" name="acao" value="colaboradores">
                  <button type="submit" onclick="loading()" class="btn btn-info mb-2">Enviar XML</button>
                </div>
                </div>
            </form>


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


<br><br>


<br><br>


	</div>

	
</body>
</html>