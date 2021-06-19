<? 
require_once "../validador_acesso_professor.php";
  
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SI - Horas Complementares</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilo-padrao-professor.css">
		<link rel="stylesheet" type="text/css" href="../css/feedback.css">
			
	</head>
	<body>
		<div id="cabeçalho">
			<img src="../imagens/logo.png">
			
		</div>

		<div id="menu-lateral">
			
			<ul>
			<li id="inicio"><a href="index.php">Inicio</a></li>
				<li id="analise-de-atividades"><a href="analise-de-atividades.php">Análise de Atividades</a></li>
				<li id=situacao-dos-alunos><a href="situacao-dos-alunos.php">Situação dos Alunos</a></li>
				<li id=mais-informações><a href="https://cptl.ufms.br/si/sistemas-atividades-complementares/">Mais Informações</a></li>
				<li id=sair><a href="../logoff.php">Sair</a></li>
			</ul>
		</div>

		
		<div id="corpo">
			

			<h2>Adicionando Atividade</h2>

		<form action = <?php print('"add_avaliacao.php?id_atv='.$_GET['id_atv'].'"');?> method = "post">
		
		<?php
			if(isset($_GET['id_atv'])&& isset($_GET['id_alu'])){
				$link = mysqli_connect("bd-saas.mysql.uhserver.com:3306", "eduardo_bruno", "brunosafado*2021", "bd_saas");

				$result = mysqli_query($link, "select * from tb_atividade where id_atividade = '".$_GET['id_atv']."'");
				$dado_atividades = mysqli_fetch_all($result);
			
				$result = mysqli_query($link, "select  unome_aluno, unome_aluno, rga, telefone, email
					 from tb_aluno where login = '".$_GET['id_alu']."'");
				$dado_alunos = mysqli_fetch_all($result);
				

			}

							
						
		?>
			
			<fieldset>
				<legend>Detalhes de Aluno</legend>
				
					<h2>Nome do Aluno: </h2> <p><?php print($dado_alunos[0][0].' '.$dado_alunos[0][1]);?></p>

					<h4>RGA do Aluno: </h4> <p><?php print($dado_alunos[0][2]);?></p>

					<h4>Telefone do Aluno: </h4><p><?php print($dado_alunos[0][3]);?></p>
					
					<h4>Email do Aluno: </h4><p><?php print($dado_alunos[0][4]);?></p>

			</fieldset>

			<fieldset>
				<legend>Detalhes da Atividade</legend>
				
					
					<h2>Nome da Atividade: </h2><p><?php print($dado_atividades[0][1]);?></p>

					<h4>Tipo de Atividade Nível 1: </h4><p><?php print($dado_atividades[0][3]);?></p>

					<h4>Tipo de Atividade Nível 2: </h4><p><?php print($dado_atividades[0][4]);?></p>
					
					<h4>Tipo de Atividade Nível 3: </h4><p><?php print($dado_atividades[0][5]);?></p>

					<h4>Data de Inicio: </h4><p><?php print($dado_atividades[0][6]);?></p>

					<h4>Data de Fim: </h4><p><?php print($dado_atividades[0][7]);?></p>

					<h4>CH total: </h4><p><?php print($dado_atividades[0][9]);?></p>

					<h4>CH Aproveitada: </h4><p><?php print($dado_atividades[0][8]);?></p>

					<h4>Descrição do aluno:</h4>
					<p><?php print($dado_atividades[0][2]);?></p>

					<a href=<?php print('"'.$dado_atividades[0][10].'"');?>>Anexo</a>

					<label for="descricao">Adicionar FeedBack</label>
					<textarea name="descricao" id="mensagem" placeholder="Digite o feedback ao aluno."></textarea>

					<label for="situacao" >Avaliar</label>
					<select name="situacao" id="situacao">
						<option value="" selected></option>
						<option value="Aprovado">Aprovar</option>
						<option value="Reprovado">Reprovar</option>
						
					</select>



					<div class="botoes">

					<input id="avaliar" type="submit" value="Enviar Avaliação">
					</div>

			</fieldset>
				
		</form>

		</div>

			

	</body>
</html>
