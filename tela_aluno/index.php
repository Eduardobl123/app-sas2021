<? 
require_once "../validador_acesso_aluno.php";
  
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SI - Horas Complementares</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilo-padrao.css">
		<link rel="stylesheet" type="text/css" href="../css/estilos-home.css">
	</head>
	
	<body>
		<h1>Parabéns, você hackeou com sucesso!</h1>
		<div id="cabeçalho">
			<img src="../imagens/logo.png">
			
		</div>
		<?php

			$link = mysqli_connect("bd-saas.mysql.uhserver.com:3306", "eduardo_bruno", "brunosafado*2021", "bd_saas");
			$login = $_SESSION['login'];
			
			$consulta = "select situacao_aluno,  ch_reconhecida, qtd_atividade from tb_aluno where login = '$login'";
			$result = mysqli_query($link, $consulta);
			$dado_aluno = mysqli_fetch_assoc($result);//é adiquiro o array com os dados do usuario caso exista
	

			//var_dump($dado_aluno);
		?>

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
			
			<div id="cargacumprida">
				<img src="../imagens/relogio.png">

				<h2>Carga Horária Cumprida</h2>
				<h4><?php print($dado_aluno['ch_reconhecida']);?>:00 Horas de 102:00 Horas</h4>
			</div>

			<div id="quantidadeatividades">
				<img src="../imagens/quantidade-atividades.png">
				<h2>Quantidade de atividades</h2>
				<h4><?php print($dado_aluno['qtd_atividade']);?> Atividades</h4>

			</div>

			<div id="situacaoenvio">
				<img src="../imagens/situacao-envio.png">
				<h2>Situação de envio</h2>
				<h4><?php print($dado_aluno['situacao_aluno']);?></h4>

			</div>

			
		</div>
		<?php
					if(isset($_GET['aviso'])){ ?>

						<script>
							alert('<?print($_GET['aviso'])?>');
						</script>
						
					<?}
		?>
	</body>
</html>
