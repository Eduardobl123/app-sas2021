<? 
require_once "../validador_acesso_aluno.php";
  
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SI - Horas Complementares</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilo-padrao.css">
		<link rel="stylesheet" type="text/css" href="../css/adicionar-atividade.css">
		<script>

			function ativaDois(value){
				var input = document.getElementById("tipo2");
				var ipnut3 = document.getElementById("tipo3");

				if(value != ""){
					input.disabled = false;
					var length = input.options.length;
                    for (i = length-1; i >= 0; i--) {
                        input.options[i] = null;
                    }

                    let ajax = new XMLHttpRequest();
                    const str_consulta = "api_capturar_tipo2_or_tipo3.php?tipo1="+value;
                    
                    ajax.open('GET', str_consulta);

                    ajax.onreadystatechange = () => {
                        if (ajax.readyState === 4 && ajax.status == 200) {
                            let dataJson = ajax.responseText;
                            let array = JSON.parse(dataJson);
                            
							if(array[0]!="Não há"){
								let opt = document.createElement('option');
								opt.value = "";
								opt.innerHTML = "--Selecionar--";

								input.appendChild(opt);
							}
                            for (var i = 0; i < array.length; i++) {
							
                            let opt = document.createElement('option');
                            opt.value = array[i];
                            opt.innerHTML = array[i];
                            input.appendChild(opt);
                            }

							if(array[0]=="Não há"){
		
								var length = ipnut3.options.length;
								for (i = length-1; i >= 0; i--) {
									ipnut3.options[i] = null;
								}
								ipnut3.disabled = true;
								let opt = document.createElement('option');
                            	opt.value = array[0];
                            	opt.innerHTML = array[0];
                            	ipnut3.appendChild(opt);

							}
                            
                        } 
                        if (ajax.readyState === 4 && ajax.status == 404) {
                            //erro de não conseguir
                            //fazer um tratamento aqui
                            alert("moio");
                        }
                    }
                    ajax.send();
						
					
				}else if(value == ""){
					input.disabled = true;
					input.value ="";
					ipnut3.disabled = true;
					ipnut3.value ="";
				}
			};

			function ativaTres(value){
				var input1 = document.getElementById("tipo1");
				var input = document.getElementById("tipo3");

				if(value != ""){
					
					input.disabled = false;

					var length = input.options.length;
                    for (i = length-1; i >= 0; i--) {
                        input.options[i] = null;
                    }

					var tipo1 = input1.value;
                    let ajax = new XMLHttpRequest();
                    const str_consulta = "api_capturar_tipo2_or_tipo3.php?tipo1="+tipo1+"&tipo2="+value;

                    ajax.open('GET', str_consulta);

                    ajax.onreadystatechange = () => {
                        if (ajax.readyState === 4 && ajax.status == 200) {
                            let dataJson = ajax.responseText;
                            let array = JSON.parse(dataJson);
                            
							if(array[0]!="Não há"){
								let opt = document.createElement('option');
								opt.value = "";
								opt.innerHTML = "--Selecionar--";

								input.appendChild(opt);
							}
                            for (var i = 0; i < array.length; i++) {
							
                            let opt = document.createElement('option');
                            opt.value = array[i];
                            opt.innerHTML = array[i];
                            input.appendChild(opt);
                            }

                            
                        } 
                        if (ajax.readyState === 4 && ajax.status == 404) {
                            //erro de não conseguir
                            //fazer um tratamento aqui
                            alert("moio");
                        }
                    }
                    ajax.send();


				}else if(value == ""){
					input.disabled = true;
					input.value ="";
				}
			};

		</script>
	</head>
	<body>
		<div id="cabeçalho">
			<img src="../imagens/logo.png">
			
		</div>

		<div id="menu-lateral">
			
			<ul>
				<li id="inicio"><a href="index.php">Inicio</a></li>
				<li id="minhasatividades"><a href="minhas-atividades.php">Minhas Atividades</a></li>
				<li id=historicoefeedback><a href="historico-e-feedback.php">Histórico e feedback</a></li>
				<li id=mais-informações><a href="https://cptl.ufms.br/si/sistemas-atividades-complementares/">Mais Informações</a></li>
				<li id=sair><a href="../logoff.php">Sair</a></li>
			</ul>
		</div>

		
		<div id="corpo">
			

			<h2>Adicionando Atividade</h2>

		<form action="add_atividade.php" method = "post" enctype="multipart/form-data">
			
			<fieldset>
				<legend>Detalhes da Atividade</legend>


				
					<label for="nome">Nome da atividade:</label>
					<input type="text" name="nome" id="nome" placeholder="Digite o nome da atividade.">
				
					<label for="tipo1">Tipo de Atividade Nível 1</label>
					<select name="tipo1" id="tipo1"  onchange ="ativaDois(this.value)">
					<option value=""></option>
					<?php
							$link = mysqli_connect("127.0.0.1:3306", "root", "12345678", "bd_saas");

							$result = mysqli_query($link, 'select DISTINCT tipo_participacao_nv1 from tb_categoria_atividade');
							$dado_tipo1 = mysqli_fetch_all($result);
							foreach($dado_tipo1 as  $vetor)
								foreach($vetor as  $valor){
									?><option value=<?php print("'" . $valor . "'")?>
									
									><?php print($valor)?></option><?
								}
						?>
					 <!-- <option value="1">Evento científico ou em áreas afins</option>
					 <option value="2">Monitoria Extensão e/ou Ensino</option> -->
					</select>
					
					<label for="tipo2">Tipo de Atividade Nível 2</label>
					<select name="tipo2" id="tipo2" onchange ="ativaTres(this.value)" disabled >
					<option value="1">--Selecionar--</option>
					</select>

					<label for="tipo3">Tipo de Atividade Nível 3</label>
					<select name="tipo3"  id="tipo3" disabled>
					<option value=""></option>
					
					</select>
					
					<label for="dataInicioAtividade">Data de inicio da Atividade</label>
					<input type="date" name="dataInicioAtividade"> 

					<label for="dataFimAtividade">Data de fim da Atividade </label> 
					<input type="date"  name="dataFimAtividade"> 
					<label for="nome">CH Total:</label>
					<input name="ch_total" type="number" max="1000"  placeholder="Digite a carga horária total da atividade."> 

					<label for="descricao">Descrição da Atividade</label>
					<textarea name="descricao" id="mensagem" placeholder="Descreva a atividade executada aqui."></textarea>

					<label for="comprovante">Certificado ou Declaração</label>
					<input type="file" name="arquivo" />

					<div class="botoes">

					<input name="adicionar" id="adicionar" type="submit" value="Adicionar Atividade">
					</div>


				
		</form>

		</div>

			

	</body>
</html>