<?php
require_once "../validador_acesso_professor.php";
  
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SI - Horas Complementares</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilo-padrao-professor.css">
		<link rel="stylesheet" type="text/css" href="../css/estilo-botoes.css"> 
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
			
			<h1>Bem Vindo,
					<?php print($_SESSION['pnome_professor'] . " " . $_SESSION['unome_professor'])?>
			!</h1>

			<div id='botoes'>

					<input name="iniciar" id="iniciar" type="submit" value="Iniciar Semestre" onclick="location.href=<?php print("'situacao_semestre.php?situacao=iniciar&id_prof=".$_SESSION['login']."'");?>;">
					<input name="encerrar" id="encerrar" type="submit" value="Encerrar Semestre" onclick="location.href=<?php print("'situacao_semestre.php?situacao=encerrar&id_prof=".$_SESSION['login']."'");?>;">

			</div>

		</div>
<?php
					if(isset($_GET['aviso']) && $_GET['aviso'] != 'sucesso'){ ?>

						<script>

							window.onload = initPage();

							async function initPage(){
								alert('<?print($_GET['aviso'])?>');
							}

						</script>
						
					<?}
		?>
	</body>
</html>