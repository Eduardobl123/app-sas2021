<? 
require_once "../validador_acesso_aluno.php";
  
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SI - Horas Complementares</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilo-padrao.css">
		<link rel="stylesheet" type="text/css" href="../css/feedback.css">
			
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

		<form >
		
		<?php
			if(isset($_GET['id_atv'])){
				$conexao2 = pg_connect("host=localhost port = 5432 dbname=bd_atividades_complementares user=postgres password=1247") or
							die ("Não foi possível conectar ao servidor PostGreSQL");

				$result = pg_query($conexao2, "select * from tb_atividade where id_atividade = '".$_GET['id_atv']."'");
				$dado_atividades = pg_fetch_all($result);


			}

							
						
		?>
			
			<fieldset>
				<legend>Detalhes da Atividade</legend>
				
					
					<h2>Nome da Atividade: </h2><p><?php print($dado_atividades[0]['nome_atividade']);?></p>

					<h4>Tipo de Atividade Nível 1: </h4><p><?php print($dado_atividades[0]['tipo_participacao_nv1']);?></p>

					<h4>Tipo de Atividade Nível 2: </h4><p><?php print($dado_atividades[0]['tipo_participacao_nv2']);?></p>
					
					<h4>Tipo de Atividade Nível 3: </h4><p><?php print($dado_atividades[0]['tipo_participacao_nv3']);?></p>

					<h4>Data de Inicio: </h4><p><?php print($dado_atividades[0]['data_inicio']);?></p>

					<h4>Data de Fim: </h4><p><?php print($dado_atividades[0]['data_fim']);?></p>

					<h4>CH total: </h4><p><?php print($dado_atividades[0]['ch_total_atividade']);?></p>

					<h4>CH Aproveitada: </h4><p><?php print($dado_atividades[0]['ch_aproveitada']);?></p>

					<h4>Descrição do aluno:</h4>
					<p><?php print($dado_atividades[0]['descricao_atividade']);?></p>

					<h4>Documento enviado pelo aluno:</h4>
					<a href=<?php print('"'.$dado_atividades[0]['path_documento'].'"');?>>Anexo</a>

					<label for="feedback">FeedBack do Professor</label>
					<textarea name="feedback" id="feedback" placeholder=<?php print('"'.$dado_atividades[0]['feedback_professora'].'"');?> disabled></textarea>

					

			</fieldset>
				
		</form>

		</div>

			

	</body>
</html>