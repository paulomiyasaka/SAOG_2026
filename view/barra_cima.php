 <?php
$matricula = $_SESSION['matricula'];
$administrador = $plantao->verificarAdministrador($matricula);
if(!$administrador){
  $administrador = $plantao->verificarGerente($matricula);
}

?>
           <nav class="navbar navbar-dark bg-dark">     
        <div class="container-fluid">
          <div class="row align-items-center">
            <div class="col">
        <p class="text-white text-center h3">SAOG - Sistema de Apoio Operacional e Gestão</p>
        </div>
        <div class="col-1">
          <h5 class="text-white text-center" id="nome_usuario"></h5>
          </div>
          
            <?php
            if($administrador){
              echo "<div class=\"col-2 text-right\">";
              echo "<a href=\"../admin/\" class=\"btn btn-outline-warning btn-sm border border-warning\">Administrador</a>";
              echo "</div>";

            }
            ?>
          
          <div class="col-1">
          <button class="btn btn-outline-warning btn-sm border border-warning" id="logout" onclick="logout();">Sair</button>
          </div>
        </div>
    </div>
  </nav>