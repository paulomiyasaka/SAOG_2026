$(document).ready(function(){
	
	$('[data-toggle="tooltip"]').tooltip();

	verTime();

	$('#btn_info').on('click', function() {
		$('#info').modal('show');
	});

	$('#myModal').modal('hide');
	$("#modalCadastroOK").modal('hide');
	$("#modalCadastroError").modal('hide');


	$("#matricula_login").mask('0.000.000-0');
	$("#matricula_gerente").mask('0.000.000-0');
	$("#tel_gerente").mask('(00) 00000-0000');
	$("#tel_centro1").mask('(00) 0000-0000');
	$("#tel_centro2").mask('(00) 0000-0000');
	$("#data_inicio").mask('00/00/0000');
	$("#data_final").mask('00/00/0000');

	$("[horario1]").mask('00:00');
	$("[horario2]").mask('00:00');
	$("[horario3]").mask('00:00');
	$("[horario4]").mask('00:00');

	$("#telefone_tratamento").mask('(00) 0000-0000');
	$("#celular_tratamento").mask('(00) 00000-0000');
	$("#telefone_motorista").mask('(00) 0000-0000');
	$("#celular_motorista").mask('(00) 00000-0000');
	

	if (typeof(Storage) !== 'undefined') {
	    // Store

	    $("#nome_usuario").prepend(localStorage.getItem('nome'));

	    					    
	} else {
	    alert('Utilize um destes navegadores: Google Chrome ou Mozilla Firefox');
	}
	

	preencherCampos();
	//loading();

	//alert("chegou");

	
});//ready()


	function loading(){


		$("#modalLoading").modal('show');

	}


	function loadingFinish(){


		$("#modalLoading").modal('close');

	}


	function aguarde(){

		$(document).ajaxStart(function(){
		  loading();
		});


		$(document).ajaxStop(function(){
		  loadingFinish();
		});



	}










function cadastrarUnidade(){
	//loading();

		var nome = $("#nome_unidade").val();
		var se = $("#se").val();
		var trabalho = $("#tipo_trabalho").val();
		var endereco = $("#endereco").val();
		var url = $("#url").val();
		var gerente = $("#gerente").val();
		var matricula = $("#matricula_gerente").val();
		var tel_gerente = $("#tel_gerente").val();
		var tel_centro1 = $("#tel_centro1").val();
		var tel_centro2 = $("#tel_centro2").val();
		var acao = "cadastrar";


		
		$.ajax({url: "unidades.php", 
				data: {	
						nome:nome, 
						se:se,
						tipo_trabalho:trabalho, 
						endereco:endereco, 
						url:url, 
						gerente:gerente,
						matricula_gerente:matricula,
						tel_gerente:tel_gerente,
						tel_centro1:tel_centro1,
						tel_centro2:tel_centro2,
						acao:acao
					},

				datatype: 'JSON',
				type: 'POST',

			success: function(result,status){
				var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';
				$("#modalUnidade").modal('hide');
				//alert("retorno = "+retorno + " success = " + status);					
				var r = retorno.split(':');			    		
				var resultado = r[1];
				var tamanho = resultado.length;

				resultado = resultado.replace(resultado.substring(0,1),"");
				
				tamanho = resultado.length;
				resultado = resultado.replace(resultado.substring(tamanho-6,tamanho),"");
				//alert("resultado = "+resultado);
				//loadingFinish();  	 
				if(resultado == 'true' && status == 'success'){   	 		
	    			
	    			/*
	    			$("#modalCadastroOK").modal('show').on('hidden.bs.modal', function (e) {
					  	window.location.href='../admin/listar_plantao.php';
					});
					*/
					$("#modalCadastroOK").modal('show');
					window.location.reload();
					

	    		}else{
	    			
	    			$('#modalCadastroError').modal('show');
	    		}

		},

        }); //ajax


	} //cadastrar unidade


	function cadastrarPlantao(){
		//loading();

		var id_unidade = $("#id_unidade").val();
		var data_inicio = $("#data_inicio").val();
		var hora_inicio = $("#hora_inicio").val();
		var data_final = $("#data_final").val();
		var hora_final = $("#hora_final").val();
		var vagas = $("#vagas").val();
		//var motorista = $("#motorista").val();
		var motorista = $( "input[type=radio][name=motorista]:checked" ).val();
		var acao = "cadastrar";
		
		//alert(data_final);
		
		$.ajax({url: "plantao.php", 
				data: {	
						id_unidade:id_unidade, 
						data_inicio:data_inicio, 
						hora_inicio:hora_inicio, 
						data_final:data_final,
						hora_final:hora_final,
						vagas:vagas,
						motorista:motorista,
						acao:acao
					},

				datatype: 'JSON',
				type: 'POST',

			success: function(result,status){
				var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';
				$("#modalPlantao").modal('hide');
				//alert("retorno = "+retorno + " success = " + status);					
				var r = retorno.split(':');			    		
				var resultado = r[1];
				var tamanho = resultado.length;

				resultado = resultado.replace(resultado.substring(0,1),"");
				
				tamanho = resultado.length;
				resultado = resultado.replace(resultado.substring(tamanho-6,tamanho),"");
				//alert("resultado = "+resultado);
				//loadingFinish();  	 
				if(resultado == 'true' && status == 'success'){   	 		
	    			/*
	    			$("#modalCadastroOK").modal('show').on('hidden.bs.modal', function (e) {
					  	window.location.reload();
					});
					*/

					$("#modalCadastroOK").modal('show');
					window.location.reload();
				

	    		}else{
	    			
	    			$('#modalCadastroError').modal('show');
	    			
	    		}

		},

        }); //ajax


	} //cadastrar plantão





function logar(){
	loading();

	var matricula = $("#matricula_login").val();
	console.log(matricula);
	if(matricula.length == 11){
	//var host = document.location.host;

		$.ajax({url: "sistema/login.php", 
				data: {matricula_login:matricula},
				datatype: 'JSON',
				type: 'POST',



			success: function(result,status){
				//var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';
				
				var retorno = "["+result+"]";				
				
				var retorno_array = retorno.split(',');
				
				//alert("retorno = "+retorno + " success = " + status);
				loadingFinish();  	 
						if (typeof(Storage) !== 'undefined') {
							
							if(result != false && status == 'success'){   	 		
				    			//loadingFinish();		
								console.log(retorno_array);    		
				    			setStorage(retorno_array);			    						    						    		
				    			

				    		}else{
				    			
				    			$('#myModal').modal('show');
				    			
				    		}

						}else {
							
		    				alert('Utilize um destes navegadores: Google Chrome ou Mozilla Firefox.');
						}
        			},

        });

	}else{
		return false;
	}

	

}


function logaradm(){
	loading();

	var matricula = localStorage.getItem('matricula');
	var senha = $("#matricula_senha").val();
	
	if(senha != "" && senha != null){
	//var host = document.location.host;

		$.ajax({url: "login.php", 
				data: {matricula_senha:senha,
					matricula_login:matricula},
				datatype: 'JSON',
				type: 'POST',



			success: function(result,status){
				//var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';

				var retorno = "["+result+"]";				
				
				var retorno_array = retorno.split(',');
				loadingFinish();  	 
						if (typeof(Storage) !== 'undefined') {
							
							if(result != false && status == 'success'){ 
								//loadingFinish();  	 		
								//alert("retorno = "+retorno + " status = " + status);	    					    		
				    			setStorageAdm();			    						    						    		
				    			

				    		}else{
				    			 				    			
				    			$('#myModal').modal('show');

				    		}

						}else {
							//loadingFinish();  	 
		    				alert('Utilize um destes navegadores: Google Chrome ou Mozilla Firefox.');
						}
        			},

        });

	}else{
		return false;
	}

	

}

function setStorageAdm(){
	
	var matricula = localStorage.getItem('matricula');
	var se = localStorage.getItem('se');	
	var time = new Date();
	time = time.getTime();
	localStorage.setItem("time", time);
	window.location.href = "plantao.php?acao=listar&matricula="+matricula+"&se="+se;

}




function setStorage(retorno_array){
	var r = retorno_array[0].split(':');			    		
	var matricula = r[1];
	var tamanho = matricula.length;

	//matricula = matricula.replace(matricula.substring(0,1),"");
	//matricula = matricula.replace(matricula.substring(tamanho-2,tamanho-1),"");
	localStorage.setItem("matricula", matricula); 

	r = retorno_array[1].split(':');			    		
	var nome = r[1];
	tamanho = nome.length;
	nome = nome.replace(nome.substring(0,1),"");
	nome = nome.replace(nome.substring(tamanho-2,tamanho-1),"");
	localStorage.setItem("nome", nome);

	r = retorno_array[2].split(':');			    		
	var lotacao = r[1];
	tamanho = lotacao.length;
	lotacao = lotacao.replace(lotacao.substring(0,1),"");
	lotacao = lotacao.replace(lotacao.substring(tamanho-2,tamanho-1),"");
	localStorage.setItem("lotacao", lotacao);

	r = retorno_array[3].split(':');			    		
	var funcao = r[1];
	tamanho = funcao.length;
	funcao = funcao.replace(funcao.substring(0,1),"");
	funcao = funcao.replace(funcao.substring(tamanho-2,tamanho-1),"");
	localStorage.setItem("funcao", funcao);

	r = retorno_array[4].split(':');			    		
	var telefone = r[1];
	telefone = telefone.replace('"',"");
		telefone = telefone.replace('}',"");
		telefone = telefone.replace('"',"");
		telefone = telefone.replace(']',"");

	//alert("telefone -> " + telefone);
	if(telefone == "null"){
		telefone = "";
	}else{
		//tamanho = telefone.length;
	//telefone = telefone.replace(telefone.substring(0,1),"");
	//telefone = telefone.replace(telefone.substring(tamanho-2,tamanho-1),"");

	}

	//alert("telefone: "+telefone);
	localStorage.setItem("telefone", telefone);


	r = retorno_array[5].split(':');			    		
	var celular = r[1];		
		celular = celular.replace('"',"");
		celular = celular.replace('}',"");
		celular = celular.replace('"',"");
		celular = celular.replace(']',"");
	

	if(celular == "null"){
		
		celular = "";
	}else{
		tamanho = celular.length;
		celular = celular.replace(celular.substring(tamanho-2,tamanho-1),"");
		
	}

	localStorage.setItem("celular", celular);

	r = retorno_array[6].split(':');			    		
	var se = r[1];		
		se = se.replace('"',"");
		se = se.replace('}',"");
		se = se.replace('"',"");
		se = se.replace(']',"");
	
	//alert("cel: "+celular);
	localStorage.setItem("se", se);


	var time = new Date();
	time = time.getTime();
	localStorage.setItem("time", time);
	window.location.href = "sistema/plantao.php?acao=listar&matricula="+matricula+"&se="+se;

}


function logout(){	
	localStorage.clear();   	
	window.location.href="logout.php";		
}

function verTime(){
	if(localStorage.getItem("time") != null){

		var timeIn = localStorage.getItem("time");
		var timeNow = new Date();
		timeNow = timeNow.getTime();

		if(timeNow - timeIn > 600000){
			logout();
		}else{
			localStorage.setItem("time", timeNow);
		}

	}
}

function limparForm(){
		$("#data_inicio").val("");
		$("#data_final").val("");
		$("#hora_inicio").val("");
		$("#hora_final").val("");
		$("#vagas").val("");
		$("#exampleRadios2").removeAttr("checked");
		$("#exampleRadios1").attr("checked","");
		$("#opt_opcao").remove();
		$("#hora_ini_opt").remove();
		$("#hora_final_opt").remove();
		$("#btn_editar_plantao").attr("disabled","");
		$("#btn_editar_plantao").attr("hidden","");
		$("#btn_cadastrar_plantao").removeAttr("hidden");
		$("#alterarPlantao").attr("hidden", "");
		$("#cadastrarPlantao").removeAttr("hidden");

}

function presencaPlantao(id_plantao, id_cadastrado){
		
		$("#btn_confirmar_presenca").attr("id-plantao", id_plantao);
		$("#btn_confirmar_presenca").attr("cadastro", id_cadastrado);
		$("#btn_confirmar_falta").attr("id-plantao", id_plantao);
		$("#btn_confirmar_falta").attr("cadastro", id_cadastrado);

	}

function registrarPresenca(){
	loading();  	 
		
		var id_plantao = $("#btn_confirmar_presenca").attr("id-plantao");
		var id_cadastrado = $("#btn_confirmar_presenca").attr("cadastro");
		
		
		$("#modalConfirmar").modal('hide');
		
		$.ajax({url: "plantao.php", 
				data: {
						acao:'registrar_presenca',
						id_plantao:id_plantao,
						id_cadastrado:id_cadastrado
					},
				datatype: 'JSON',
				type: 'POST',

				success: function(result,status){
				var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';

				var r = retorno.split(':');			    		
				var resultado = r[1];
				var tamanho = resultado.length;

				resultado = resultado.replace(resultado.substring(0,1),"");
				
				tamanho = resultado.length;
				resultado = resultado.replace(resultado.substring(tamanho-6,tamanho),"");
				loadingFinish();  	 
				if(resultado == 'true' && status == 'success'){   	 		
	    		 	 
					$("#modalCadastroOK").modal('show');						
					window.location.reload();
	    		}else{
	    			  	 
	    			$("#modalCadastroError").modal('show');
	    		}



        			},

        });

        


	}




	function registrarFalta(){
		loading();  	 
		
		var id_plantao = $("#btn_confirmar_falta").attr("id-plantao");
		var id_cadastrado = $("#btn_confirmar_falta").attr("cadastro");
		
		
		$("#modalExcluir").modal('hide');
		
		$.ajax({url: "plantao.php", 
				data: {
						acao:'registrar_falta',
						id_plantao:id_plantao,
						id_cadastrado:id_cadastrado
					},
				datatype: 'JSON',
				type: 'POST',

				success: function(result,status){
				var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';

				var r = retorno.split(':');			    		
				var resultado = r[1];
				var tamanho = resultado.length;

				resultado = resultado.replace(resultado.substring(0,1),"");
				
				tamanho = resultado.length;
				resultado = resultado.replace(resultado.substring(tamanho-6,tamanho),"");
				loadingFinish();  	 
				if(resultado == 'true' && status == 'success'){   	 		
	    		
	    			
					$("#modalCadastroOK").modal('show');
					
					window.location.reload();
	    		}else{
	    				 
	    			$("#modalCadastroError").modal('show');
	    		}



        			},

        });

        


	}






	function idPlantao(id_plantao){
		
		$("#inscrever_plantao").attr("id-plantao", id_plantao);
		$("#cancelar_inscrever_plantao").attr("id-plantao", id_plantao);
		$("#btn_cadastrar_plantao").removeAttr("hidden");
		$("#btn_editar_plantao").attr("hidden");
		$("#cadastrarPlantao").removeAttr("hidden");
		$("#alterarPlantao").attr("hidden", "");

		


		$.ajax({url: "plantao.php", 
				data: {
						acao:'verificar',
						id_plantao:id_plantao
					},
				datatype: 'JSON',
				type: 'POST',

				success: function(result,status){
				var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';

				var r = retorno.split(':');			    		
				var resultado = r[1];
				var tamanho = resultado.length;

				resultado = resultado.replace(resultado.substring(0,1),"");
				
				tamanho = resultado.length;
				resultado = resultado.replace(resultado.substring(tamanho-6,tamanho),"");
				
				if(resultado == 'true' && status == 'success'){   	 		
	    		
	    			$("#radio-motorista").show();

	    		}else{
	    			$("#radio-motorista").hide();
	    		}



        			},

        });




	}

	function editPlantao(id_plantao){
		//loading();  	 
		limparForm();
		$("#btn_editar_plantao").attr("id_plantao", id_plantao);
		$("#modalPlantao").show();
		//$("#btn_editar_plantao").removeAttr("hidden");
		$("#btn_editar_plantao").removeAttr("hidden");
		$("#btn_cadastrar_plantao").attr("hidden", "");
		//$("#btn_cadastrar_plantao").removeAttr("hidden");
		$("#alterarPlantao").removeAttr("hidden");
		$("#cadastrarPlantao").attr("hidden", "");

		//$("#id_unidade").attr();


		
		$.ajax({url: "plantao.php", 
				data: {
						acao:"dados",
						id_plantao:id_plantao
					},
				datatype: 'JSON',
				type: 'POST',

				success: function(result,status){
				var retorno = result; 
				

				var r = retorno.split(',');			    		

				var unid = r[1].split(':');
				unid[1] = unid[1].replace('"',"");
				unid[1] = unid[1].replace('"',"");
				

				 $.post("plantao.php",
				    {	
				    	acao: "unidade",
				        id_unidade: unid[1]
				        
				    },

				    function(data, status){
				        //alert("Data: " + data + "\nStatus: " + status);
				        var unidade = data.split(',');
				        unidade[1] = unidade[1].split(':');
				        unidade[2] = unidade[2].split(':'); //trabalho

				        var tipo_trabalho = unidade[2][1];
				        var nome_unidade = unidade[1][1];

				        tipo_trabalho = tipo_trabalho.replace('"',"");
				        tipo_trabalho = tipo_trabalho.replace('"',"");
				        tipo_trabalho = tipo_trabalho.replace('\\u00e7',"ç");
				        tipo_trabalho = tipo_trabalho.replace('\\u00e3',"ã");
				        nome_unidade = nome_unidade.replace('"',"");
				        nome_unidade = nome_unidade.replace('"',"");

				        var opcao = nome_unidade;
				        //unidade[0] = unidade[0].replace('"',"");
				        //alert(opcao);
				        $("#id_unidade").prepend("<option id='opt_opcao' value='"+unid[1]+"' selected>"+opcao+"</option>");
				    });


				var data = r[2].split(' ');
				data = data[0].split(':');
				data[1] = data[1].replace('"',"");
				data[1] = data[1].replace('-',"/");
				data[1] = data[1].replace('-',"/");
				var novaData = data[1].split('/');
				novaData = novaData[2]+"/"+novaData[1]+"/"+novaData[0];

				$("#data_inicio").val(novaData);
				
				var hora = r[2].split(' ');
				hora = hora[1].split(':');
				var novaHora = hora[0]+":"+hora[1];
				

				$("#hora_inicio").prepend("<option id='hora_ini_opt' value='"+hora[0]+"' selected>"+novaHora+"</option>");

				var data = r[3].split(' ');
				data = data[0].split(':');
				data[1] = data[1].replace('"',"");
				data[1] = data[1].replace('-',"/");
				data[1] = data[1].replace('-',"/");
				var novaData = data[1].split('/');
				novaData = novaData[2]+"/"+novaData[1]+"/"+novaData[0];
				$("#data_final").val(novaData);

				var hora = r[3].split(' ');
				hora = hora[1].split(':');
				var novaHora = hora[0]+":"+hora[1];
				$("#hora_final").prepend("<option id='hora_final_opt' value='"+hora[0]+"' selected>"+novaHora+"</option>");
				//alert(novaHora);

				//$("#data_final").val(r[3]);
				var vagas = r[4].split(':');
				vagas[1] = vagas[1].replace('"',"");
				vagas[1] = vagas[1].replace('"',"");
				$("#vagas").val(vagas[1]);

				var motorista = r[5].split(':');
				motorista[1] = motorista[1].replace('"',"");
				motorista[1] = motorista[1].replace('"',"");
				//$("#motorista").val(motorista[1]);

				//alert(motorista[1]);
				if(motorista[1] == '1'){
					$("#motoristaNao").removeAttr("checked");
					$("#motoristaSim").attr("checked","");
				}else{
					$("#motoristaSim").removeAttr("checked");
					$("#motoristaNao").attr("checked","");
				}


				
        			},

        });

		loadingFinish();  	 

	}



	function habilitarAlterar(){

		$("#btn_editar_plantao").removeAttr("disabled");


	}



function editarPlantao(){
	//loading();  	 

	$("#modalPlantao").modal('hide');
		var id_plantao = $("#btn_editar_plantao").attr("id_plantao");
		var id_unidade = $("#id_unidade").val();
		var data_inicio = $("#data_inicio").val();
		var hora_inicio = $("#hora_inicio").val();
		var data_final = $("#data_final").val();
		var hora_final = $("#hora_final").val();
		var vagas = $("#vagas").val();
		//var motorista = $("#motorista").val();
		var motorista = $( "input[type=radio][name=motorista]:checked" ).val();
		var acao = "alterar";
		
		//alert(id_unidade);
		
		$.ajax({url: "plantao.php", 
				data: {	
						id_plantao:id_plantao,
						id_unidade:id_unidade, 
						data_inicio:data_inicio, 
						hora_inicio:hora_inicio, 
						data_final:data_final,
						hora_final:hora_final,
						vagas:vagas,
						motorista:motorista,
						acao:acao
					},

				datatype: 'JSON',
				type: 'POST',

			success: function(result,status){
				//alert(typeof(result)+ " " +result);
				loadingFinish();  	 
				//window.location.reload();
				//var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';

				//var r = retorno.split(':');			    		
				//var resultado = r[1];
				//var tamanho = resultado.length;
				//resultado = resultado.replace(resultado.substring(0,1),"");
				
				//tamanho = resultado.length;
				resultado = result;
				loadingFinish();  	 
				if(resultado == 'true'){   	 		
	    		
	    			
					$("#modalCadastroOK").modal('show');
					alert(typeof(result)+ " " +result);
					//window.location.reload();
	    		}else{
	    				 
	    			$("#modalCadastroError").modal('show');
	    		}

				/*	    		
				var resultado = result;
				
				if(resultado == "true" && status == "success"){   	 		
	    			
	    			$("#modalCadastroOK").modal('show').on('hidden.bs.modal', function (e) {
					  	window.location.reload();
					});

	    		}else{

	    			$("#modalCadastroError").modal('show').on('hidden.bs.modal', function (e) {
	    				
					  	window.location.reload();
					});
	    		}

	    		*/

		},

        }); //ajax


	} //editar plantão







	function delPlantao(id_plantao){
		
		$("#deletar_plantao").attr("id-plantao", id_plantao);
		$("#modalDelete").show();
	}

	function ativarPlantao(id_plantao){
		
		$("#reativar_plantao").attr("id-plantao", id_plantao);
		$("#modalReativar").show();
	}


	function deletarPlantao(){
		$("#modalDelete").hide();
		var id_plantao = $("#deletar_plantao").attr("id-plantao");
		var acao = "deletar";

		$.ajax({url: "plantao.php", 
				data: {
						acao:acao,
						id_plantao:id_plantao,
						
					},
				datatype: 'JSON',
				type: 'POST',

				success: function(result,status){
				
							
					if(result != "false" && status == 'success'){ 
					
					 		
		    		$("#modalCadastroOK").modal('show').on('hidden.bs.modal', function (e) {
					  	window.location.reload();	
					})
		    					    			

		    		}else{
		    			
		    			$('#modalCadastroError').modal('show');
		    		}

        		},

        });

	}


function reativarPlantao(){

		$("#modalReativar").hide();
		var id_plantao = $("#reativar_plantao").attr("id-plantao");
		var acao = "reativar";

		$.ajax({url: "plantao.php", 
				data: {
						acao:acao,
						id_plantao:id_plantao,
						
					},
				datatype: 'JSON',
				type: 'POST',

				success: function(result,status){
				
							
					if(result != "false" && status == 'success'){ 
					
					 		
		    		$("#modalCadastroOK").modal('show').on('hidden.bs.modal', function (e) {
					  	window.location.reload();	
					})
		    					    			

		    		}else{
		    			
		    			$('#modalCadastroError').modal('show');
		    		}

        		},

        });

	}





	function verificarCampos(){
		verTime();
		//var motorista = $( "input[type=radio][name=motor]:checked" ).val();
		//var funcao = null;
		var telefone_storage = null;
		var celular_storage = null;
		//var telefone = null;
		//var celular = null;
			
		//alert("tel: " + telefone);

				//motorista = 0;
				//tipo_modal = $("#modalInscreverTratamento");
				//funcao = $("#funcao_tratamento").val();
				telefone = $("#telefone_tratamento").val();
				celular = $("#celular_tratamento").val();
				
				//if(funcao != null && funcao != "" && telefone != null && telefone != "" && celular != null && celular != ""){
				if(telefone != null && telefone != "" && celular != null && celular != ""){
					$("#btn_inscrever_plantao2").removeAttr("disabled");
				}else{
					$("#btn_inscrever_plantao2").attr("disabled", "true");
				}
				
				
		
				//tipo_modal = $("#modalInscreverMotorista");
				//funcao = $("#funcao_motorista").val();
				telefone = $("#telefone_motorista").val();
				celular = $("#celular_motorista").val();
				
				//if(funcao != null && funcao != "" && telefone != null && telefone != "" && celular != null && celular != ""){
				if(telefone != null && telefone != "" && celular != null && celular != ""){
					$("#btn_inscrever_plantao").removeAttr("disabled");
				}else{
					$("#btn_inscrever_plantao").attr("disabled", "true");
				}
				
						
	}

function preencherCampos(){
		
		//var motorista = $( "input[type=radio][name=motor]:checked" ).val();
		//var funcao = null;
		var telefone = localStorage.getItem("telefone");
		var celular = localStorage.getItem("celular");
		//var telefone = null;
		//var celular = null;
			
		//alert("tel: " + telefone);

				//motorista = 0;
				//tipo_modal = $("#modalInscreverTratamento");
				//funcao = $("#funcao_tratamento").val();
				 
				
				//if(funcao != null && funcao != "" && telefone != null && telefone != "" && celular != null && celular != ""){
				if(telefone != null && telefone != "" && celular != null && celular != ""){
					
					$("#telefone_tratamento").val(telefone);
					$("#celular_tratamento").val(celular);
					$("#telefone_motorista").val(telefone);
					$("#celular_motorista").val(celular);
					$("#btn_inscrever_plantao").removeAttr("disabled");
					$("#btn_inscrever_plantao2").removeAttr("disabled");

				}else{
					$("#telefone_tratamento").val("");
					$("#celular_tratamento").val("");
					$("#telefone_motorista").val("");
					$("#celular_motorista").val("");
					$("#btn_inscrever_plantao").attr("disabled", "true");
					$("#btn_inscrever_plantao2").attr("disabled", "true");
				}
				
				
		
				
						
	}




	function inscreverPlantao(){	
		verTime();
		loading();  	 

			var id_plantao = $("#inscrever_plantao").attr("id-plantao");
			var acao = "inscrever";			
			var motorista = $( "input[type=radio][name=motor]:checked" ).val();
			//alert(motorista);
			var tipo_modal = "";
			//var funcao = null;
			var telefone = null;
			var celular = null;
			
			

			if(motorista == null || motorista == "" || motorista == 0 || motorista == 1){
			//if(motorista == null || motorista == "" || motorista == 1){
				
				tipo_modal = $("#modalInscreverMotorista");
				//funcao = $("#funcao_motorista").val();
				telefone = $("#telefone_motorista").val();
				celular = $("#celular_motorista").val();

			}else{
				tipo_modal = $("#modalInscreverTratamento");
				//funcao = $("#funcao_tratamento").val();
				telefone = $("#telefone_tratamento").val();
				celular = $("#celular_tratamento").val();
				
			}
			

			

			$.ajax({url: "../sistema/plantao.php", 
				data: {
						acao:acao,
						id_plantao:id_plantao,
						motorista:motorista,
						//funcao: funcao,
						telefone: telefone,
						celular: celular
					},
				datatype: 'JSON',
				type: 'POST',

				success: function(result,status){
				//var retorno = '['+ result + ']'; 
				
				var retorno_array = result.split(' ');
				retorno_array = retorno_array[1].split(',');
				retorno_array = retorno_array[0].replace('"','');
				retorno_array = retorno_array.replace('"','');
				retorno_array = retorno_array.replace(' ','');
				retorno_array = retorno_array.replace('\n','');

				//alert("retorno novo = "+retorno_array.length + " success = " + status);
							
							if(retorno_array != false && status == 'success'){ 
							//alert("_"+retorno_array+"_");
							  	 
								tipo_modal.modal('hide'); 	 		
								var telefone_storage = localStorage.setItem("telefone", telefone);
								var celular_storage = localStorage.setItem("celular", celular);
					    		$('#modalCadastroOK').modal('show');
					    		window.location.reload();	
					    			

				    		}else{
				    				 
				    			tipo_modal.modal('hide'); 
				    			$('#modalCadastroError').modal('show');
				    			loadingFinish();  
				    		}

        			},

        });

		
	}





function cancelarInscreverPlantao(){	
	verTime();
			loading();  	 
			var id_plantao = $("#cancelar_inscrever_plantao").attr("id-plantao");
			var acao = "cancelar";
			//var motorista = $("#motorista").val();
			//if(motorista == null || motorista == ""){
				//motorista = 0;
			//}

			$.ajax({url: "../sistema/plantao.php", 
				data: {
						acao:acao,
						id_plantao: id_plantao
					},
				datatype: 'JSON',
				type: 'POST',

				success: function(result,status){
				//var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';

				var retorno_array = result.split(' ');
				retorno_array = retorno_array[1].split(',');
				retorno_array = retorno_array[0].replace('"','');
				retorno_array = retorno_array.replace('"','');
				retorno_array = retorno_array.replace(' ','');
				retorno_array = retorno_array.replace('\n','');
				
				//alert("retorno = "+retorno_array + " success = " + status)
							
				if(retorno_array == 'true' && status == 'success'){ 
				//loadingFinish();  	 
				$("#modalCancelInscrever").modal('hide'); 
				$('#modalCadastroOK').modal('show');
	    		window.location.reload();	
	    			

	    		}else{
	    			//loadingFinish();  	 
	    			$("#modalCancelInscrever").modal('hide'); 
	    			$('#modalCadastroError').modal('show');
	    			loadingFinish();
	    		}

		},

        });



		
	}




	function verInscritos(id_plantao){
		verTime();
		loading(); 
		$.ajax({url: "plantao.php", 
				data: {
						acao:"listar_inscritos",
						id_plantao:id_plantao
					},
				datatype: 'JSON',
				type: 'POST',

				success: function(result,status){
				//var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';

				//var retorno = "["+result+"]";				
				
				var retorno_array = result.split('},{');

				//alert(retorno_array.length);
				
				//alert("retorno = "+retorno + " success = " + status)
							loadingFinish(); 
							if(retorno_array != "false" && status == 'success'){ 

								$('#modalInscritos').modal('show').on('shown.bs.modal', function (e) {
								 	//listarInscritos(retorno_array);
								 	$("table > tbody").empty();
								 	//var tamanho = (retorno_array.length)/3;		
									var tamanho = retorno_array.length/3;
								 	var linha = 0;		
								 	var i = 0;
								 	//alert(retorno_array);
								 	if(tamanho > 0){

								 		while(linha < tamanho){
								 			
								 			while(i < tamanho*3){
								 				//retorno_array[i] = retorno_array.split(',');
								 				//alert(retorno_array);
								 				//retorno_array[i+1] = retorno_array.split(':');
								 				//retorno_array[i+2] = retorno_array.split(':');
								 				//alert(retorno_array);
								 				$("<tr><th scope=\"row\" class=\"h5 text-center\">"+retorno_array[i]+"</th><td class=\"h5 text-center\">"+retorno_array[i+1]+"</td><td class=\"h5 text-center\">"+retorno_array[i+2]+"</td></tr>").appendTo("tbody");
								 				i  += 3;
								 			}
								 			
								 			linha++;
								 			
								 		}
								 	}

								 		
								 									 		
								 	
								 	
								});

								
				    			
								

				    		}else{
				    			


				    			$('#modalCadastroError').modal('show');
				    		
				    		}

        			},

        });

	}




function criarSenha(){

	var senha1 = $("#senha1").val();
	var senha2 = $("#senha2").val();
	var matricula = $("#matricula").val();
	var acao = "senha";


	if(senha1 == senha2 && senha1 != ""){


	$.ajax({url: "plantao.php", 
				data: {
						acao:acao,
						senha: senha1,
						matricula: matricula
					},
				datatype: 'JSON',
				type: 'POST',

				success: function(result,status){
				//var retorno = '['+ result + ']'; 
				//var j = '{"dados":' + result + '}';

				var retorno = "["+result+"]";				
				
				var retorno_array = result.split(' ');
				retorno_array = retorno_array[1].split(',');
				retorno_array = retorno_array[0].replace('"','');
				retorno_array = retorno_array.replace('"','');
				retorno_array = retorno_array.replace(' ','');

				
				
				//alert("retorno = "+retorno_array+ " success = " + status);					
							if(retorno_array == 1 && status == 'success'){ 
							
							
							$('#modalCadastroOK').modal('show');
				    		
							//alert("retorno sucesso = "+retorno_array+ " success = " + status);		
				    		//window.location.reload();	
				    		window.location.href = "listar_plantao.php";	

				    		}else{
							//alert("retorno erro = "+retorno_array+ " success = " + status);		
				    			//$("#modalCancelInscrever").modal('hide'); 
				    			$('#modalCadastroError').modal('show');
				    			
				    		}

        			},

        });
}else{
	$('#modalCadastroError').modal('show');
}


}



function buscarPlantaoSE()
{

	se = document.getElementById('selecionarSE').value;
	//alert(se);
	window.location.href = "listar_plantao.php?se="+se;


}










