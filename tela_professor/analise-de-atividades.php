<? 
require_once "../validador_acesso_professor.php";
  
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SI - Horas Complementares</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilo-padrao-professor.css">
		<link rel="stylesheet" type="text/css" href="../css/estilos-analise-de-atividades.css">
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
			<table>
			
				<tr>
					<th>Nome do Aluno</th>
					<th>RGA do Aluno</th>
					<th>Data de Recebimento</th>
					<th>Situação</th>
					<th>Atividades</th>
				</tr>

				<?php
							$link = mysqli_connect("bd-saas.mysql.uhserver.com:3306", "eduardo_bruno", "brunosafado*2021", "bd_saas");
							$login = $_SESSION['login'];
							$result = mysqli_query($link, "select pnome_aluno, unome_aluno, rga, data_de_envio, situacao_atividade, id_atividade, id_aluno
							from tb_aluno inner join tb_atividade on id_aluno = login and id_professor='$login'
							where situacao_atividade = 'Em análise' or situacao_atividade = 'Reprovado' or situacao_atividade = 'Aprovado';");
							$dado_atividades = mysqli_fetch_all($result);

							$cont = 0;
							if(isset($dado_atividades[0])){
								foreach($dado_atividades as  $vetor){
									if($cont == 0){
										?><tr class= 'alternado'>
						
											<td class="centralizado"><?php print($vetor[0]." ". ($vetor[1]));?></td>
											<td class="centralizado"><?php print($vetor[2]);?></td>
											<td class="centralizado"><?php print($vetor[3]);?></td>
											<td class="centralizado"><?php print($vetor[4]);?></td>
											<td class="centralizado"><a href=<?php print('"avaliar_atividade.php?id_atv='.$vetor[5].'&id_alu='.$vetor[6].'"');?>>Avaliar atividade</a></td>
										</tr>
										<?
										$cont = 1;
									}else{
										?><tr>
						
											<td class="centralizado"><?php print($vetor[0]." ". ($vetor[1]));?></td>
											<td class="centralizado"><?php print($vetor[2]);?></td>
											<td class="centralizado"><?php print($vetor[3]);?></td>
											<td class="centralizado"><?php print($vetor[4]);?></td>
											<td class="centralizado"><a href=<?php print('"avaliar_atividade.php?id_atv='.$vetor[5].'&id_alu='.$vetor[6].'"');?>>Avaliar atividade</a></td>
										</tr>
										<?
										$cont = 0;
									}
							}


									

							}	
						
					?>
			
			</table>

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

		</div>

			

	</body>
</html>
