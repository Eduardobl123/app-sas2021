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
					<th>Nome do Acadêmico</th>
					<th>RGA do Acadêmico</th>
					<th>Carga Horária Reconhecida</th>
					<th>Situação (AP/RP)</th>
				</tr>
				<?php
							$link = mysqli_connect("bd-saas.mysql.uhserver.com:3306", "eduardo_bruno", "brunosafado*2021", "bd_saas");

							$result = mysqli_query($link, "select pnome_aluno, unome_aluno, rga,ch_reconhecida, situacao_aluno from tb_aluno
							where  situacao_aluno = 'AP' or situacao_aluno = 'RP';");
							$dados_alunos = mysqli_fetch_all($result);
							
							$cont = 0;
							if(isset($dados_alunos[0])){
								foreach($dados_alunos as  $vetor){
									if($cont == 0){
										?><tr class= 'alternado'>
						
											<td class="centralizado"><?php print($vetor['pnome_aluno']." ". ($vetor['unome_aluno']));?></td>
											<td class="centralizado"><?php print($vetor['rga']);?></td>
											<td class="centralizado"><?php print($vetor['ch_reconhecida']);?> Hrs</td>
											<td class="centralizado"><?php print($vetor['situacao_aluno']);?></td>

										</tr>
										<?
										$cont = 1;
									}else{
										?><tr>
						
											<td class="centralizado"><?php print($vetor['pnome_aluno']." ". ($vetor['unome_aluno']));?></td>
											<td class="centralizado"><?php print($vetor['rga']);?></td>
											<td class="centralizado"><?php print($vetor['ch_reconhecida']);?> Hrs</td>
											<td class="centralizado"><?php print($vetor['situacao_aluno']);?></td>

										</tr>
										<?
										$cont = 0;
									}
							}


									

							}	
						
					?>
				

			</table>

			<div id="botoes">
				
				<input name="relatorio" id="relatorio" type="submit" value="Gerar Relatório">

			</div>

		</div>

			

	</body>
</html>
