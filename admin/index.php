<!doctype html>
<html lang="en">
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
 
    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
<?php
$navegador = $_SERVER['HTTP_USER_AGENT'];

//echo $navegador;
$ie = strpos( $navegador, 'MSIE' );
$login = null;
if($ie || false){
echo "<script>window.location.href='navegador.php'</script>";

}else{
  session_start();
  include_once '../controle/auto_load.class.php';
  new auto_load();
  $login = new login();
  if(isset($_SESSION['matricula'])){

    if(!$login->existeSenha($_SESSION['matricula'])){
      echo "<script>window.location.href='cad_senha.php'</script>";
    }

  }else{
    echo "<script>window.location.href='../index.php'</script>";
  }
}


?>
  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-4">
      <img class="mb-4" width="280" height="105" src="../logo_correios.png" alt="Correios">
      <hr>
      <h2 class="h2 mb-3 font-weight-normal">SAOG</h2>
      <br>     
      <h3 class="h3 mb-3 font-weight-normal">Administração</h3>
      <h3 class="h3 mb-3 font-weight-normal">Informe a sua senha:</h3>
      
      <hr>
      <label for="matricula_login" class="sr-only">Senha</label>
      <input type="password" id="matricula_senha" name="matricula_senha" class="form-control text-center" placeholder="Senha" required autofocus>
      <hr>
      
      <div id="myModal" class="modal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">Senha Inválida</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <h5 class="text-dark"><b>Esqueceu como acessar?</b></h5>
            <h5 class="text-dark"><b>Peça a um administrador para "redefinir a sua senha".</b></h5>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>

   
      <button id="btn_entrar" onclick="logaradm();" class="btn btn-lg btn-primary btn-block" type="submit">ENTRAR</button>
      <hr>
      
    </div>
  </div>
  <br>
<br>
<br>
<!--
  <div class="row">
    <div class="col">
      <p class="h5 text-muted">Desenvolvido por:<br>
        <b>Paulo Rodrigues Miyasaka - SE/BSB/GEOPE</b>
      </p>
    </div>
  </div>
-->

</div>
  </body>
</html>
