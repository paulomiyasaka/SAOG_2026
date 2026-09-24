  <?php
include_once '../controle/auto_load.class.php';
new auto_load();
$funcoes = new funcoes();
$funcoes->charset();
//session_start();
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>SAOG</title>
 <!-- Required meta tags -->
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <!-- Bootstrap CSS -->
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
		
		<?php
			$plantao = new plantao();
			//$funcoes = new funcoes();
			//$plantao->botaoCadastrarPlantao();
			$datas = $plantao->datasDistintas();
			//var_dump($datas);
			for ($i=0; $i < count($datas); $i++) { 
				
			
		?>

	
		
    


		<?php 
		
		

		$lista = $plantao->listaInscritos($datas[$i]->turno_inicio);
		//var_dump($lista);
		$contador = 1;
		$total = 0;


		if(count($lista) > 0){



		?>


<table class="table">
  <thead>	
    <tr class="text-center text-white bg-dark">
      <th scope="col" class="text-center"></th>
      <th scope="col" class="text-center">Unidade</th>
      <th scope="col" class="text-center">SE</th>
      <th scope="col" class="text-center">Vagas Solicitadas</th>
      <th scope="col" class="text-center">Inscritos</th>
      <th scope="col" class="text-center">Data do Apoio</th>
    </tr>
  </thead>
  <tbody>


		<?php


		foreach ($lista as $key => $value) {
			
			echo "<tr>
		      <th scope=\"row\">".$contador++."</th>
		      <td>".$value->nome."</td>
          <td>".$value->se."</td>
		      <td class=\"text-center\">".$value->vagas."</td>
		      <td class=\"text-center\">".$value->inscritos."</td>
		      <td class=\"text-center\">".$funcoes->diaSemana(date('w', strtotime($value->data))).", ".date('d/m/Y', strtotime($value->data))."</td>
		    </tr>";

		    $total += $value->inscritos;
		}

		echo "<tr>

		      <th scope=\"row\" colspan=\"2\" class=\"text-right bg-dark text-white\">Total de inscrições:</th>
		      <td class=\"text-left bg-dark text-white\">".$total."</td>
		      <td colspan=\"3\" class=\"text-center bg-dark text-white\"></td>
		    </tr>";

		?>



		

</tbody>
</table>



<?php 
			}

			echo "<br><br>";
			echo "<br><br>";

		}
		?>





<br><br>


<br><br>


	</div>

	
</body>
</html>