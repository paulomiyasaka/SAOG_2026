<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SAOG</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">  
  <link rel="stylesheet" href="css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  
  <script src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/jquery.mask.js"></script>
  <script src="js/bootstrap.min.js"></script>  
  <script src="js/script.js"></script>
 
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
<?php
$navegador = $_SERVER['HTTP_USER_AGENT'];
//echo $navegador;
$ie = strpos( $navegador, 'MSIE' );
if($ie || false){
echo "<script>window.location.href='navegador.php'</script>";
}

?>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-4">
      <img class="mb-4" width="280" height="105" src="logo_correios.png" alt="Correios">
      <hr>
      <h2 class="h2 mb-3 font-weight-normal">SAOG-DELOG</h2>      
      <h3 class="h3 mb-3 font-weight-normal">Sistema de Apoio Operacional e Gestão</h3>
      <br>
      <hr>
      <label for="matricula_login" class="sr-only">Matrícula</label>
      <input type="text" id="matricula_login" name="matricula_login" class="form-control text-center" placeholder="Informe a sua Matrícula" required autofocus>
      <hr>
      <input type="hidden" value="e10adc3949ba59abbe56e057f20f883e"/>
      <div id="myModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Matrícula Inválida</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h4 class="text-center">A matrícula informada não foi encontrada.</h4>
            <hr>
            <h5 class="text-dark"><b>Problema com acesso?</b></h5>
            <h5 class="text-dark"><b>Envie um e-mail para a GEOPE</b></h5>
            <h5 class="text-dark">Informe sua Matrícula, Nome Completo e Unidade de Lotação</h5>         
            <a href="mailto:geope-bsb2@correios.com.br" class="mt-5 mb-3 text-dark">BSB - SE - GEOPE - Caixa Postal</a> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>

      <!--
      <label for="senha" class="sr-only">Senha</label>
      <input type="password" id="senha" class="form-control" placeholder="Senha" required>
      <button id="btn_entrar" onclick="logar();" class="btn btn-lg btn-primary btn-block" type="submit">ENTRAR</button>
      
      <a href="#" onclick="javascript: logar();" class="btn btn-lg btn-primary btn-block">ENTRAR</a>
      -->
      <button id="btn_entrar" onclick="logar();" class="btn btn-lg btn-primary btn-block" type="submit">ENTRAR</button>
      <hr>
      <!--
      <a href="mailto:geope-bsb2@correios.com.br" class="mt-5 mb-3 text-dark">BSB - SE - GEOPE - Caixa Postal</a>
      -->
    </div>    
  </div>
<br>
<br>
<br>
<!--
  <div class="row">
    <div class="col">
      <p class="h5 text-dark">Desenvolvido por:<br>
        <b>Paulo Rodrigues Miyasaka - SE/BSB/GEOPE</b>
      </p>
    </div>
  </div>
</div>
-->
  </body>
</html>
