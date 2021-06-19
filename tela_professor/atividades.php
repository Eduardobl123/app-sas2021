<? 
require_once "../validador_acesso_professor.php";
  
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SI - Horas Complementares</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilo-padrao-professor.css">
		<link rel="stylesheet" type="text/css" href="../css/atividades.css">
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

			<h1>Detalhes da Atividade de Fulano</h1>

			<table>
			
				<tr>
					<th>Nº</th>
					<th>Tipo de Atividade</th>
					<th>Período</th>
					<th>CH Total</th>
					<th>CH Aproveitada</th>
					<th>Certificado/ Declaração</th>
					<th>Mais Detalhes</th>
				</tr>
				<?php
					$login = $_SESSION['login'];
							$conexao = pg_connect("host=localhost port = 5432 dbname=bd_atividades_complementares user=postgres password=1247") or
							die ("Não foi possível conectar ao servidor PostGreSQL");

							$result = pg_query($conexao, 'select id_atividade,  tipo_participacao_nv1,nome_atividade, periodo_atividade,ch_total_atividade, ch_aproveitada  from tb_atividade inner join tb_aluno
									on login = id_aluno
								where login = '."'".$login."' and situacao_atividade = ". "'Salvo'");
							$dado_atividades = pg_fetch_all($result);
							
							$cont = 0;
							if(isset($dado_atividades[0])){
								foreach($dado_atividades as  $vetor){
									if($cont == 0){
										?><tr class= 'alternado'>
						
										<td class="centralizado"> <?php print($vetor['id_atividade']);?> </td>
										<td><?php print($vetor['tipo_participacao_nv1']);?></td>
										<td><?php print($vetor['nome_atividade']);?></td>
										<td class="centralizado"><?php print($vetor['periodo_atividade']);?></td>
										<td class="alinhado-direta"><?php print($vetor['ch_total_atividade']);?></td>
										<td class="alinhado-direta"><?php print($vetor['ch_aproveitada']);?></td>
										<td class="centralizado"><a href=<?php print('"excluir_atividade.php?id_atv='.$vetor['id_atividade'].'"');?>><img src="../imagens/lixeira.png"></a></td>
					
										</tr>
										<?
										$cont = 1;
									}else{
										?><tr>
						
										<td class="centralizado"> <?php print($vetor['id_atividade']);?> </td>
										<td><?php print($vetor['tipo_participacao_nv1']);?></td>
										<td><?php print($vetor['nome_atividade']);?></td>
										<td class="centralizado"><?php print($vetor['periodo_atividade']);?></td>
										<td class="alinhado-direta"><?php print($vetor['ch_total_atividade']);?></td>
										<td class="alinhado-direta"><?php print($vetor['ch_aproveitada']);?></td>
										<td class="centralizado"><a href=<?php print('"excluir_atividade.php?id_atv='.$vetor['id_atividade'].'"');?>><img src="../imagens/lixeira.png"></a></td>
					
										</tr>
										<?
										$cont = 0;
									}
							}


									

							}	
						
					?>
				<tr class= 'alternado'>
					
					<td class="centralizado">1</td>
					<td class="centralizado">IC</td>
					<td class="centralizado">5</td>
					<td class="centralizado">##</td>
					<td class="centralizado">##</td>
					<td class="centralizado"><a href="">NOMEPDF</a></td>
					<td class="centralizado"><a href=""><img src="../imagens/mais-detalhes.png"></a></td>

				</tr>

				<tr>
					
					<td class="centralizado">1</td>
					<td class="centralizado">IC</td>
					<td class="centralizado">5</td>
					<td class="centralizado">##</td>
					<td class="centralizado">##</td>
					<td class="centralizado"><a href="">NOMEPDF</a></td>
					<td class="centralizado"><a href=""><img src="../imagens/mais-detalhes.png"></a></td>
				</tr>

				<tr class= 'alternado'>
					
					<td class="centralizado">1</td>
					<td class="centralizado">IC</td>
					<td class="centralizado">5</td>
					<td class="centralizado">##</td>
					<td class="centralizado">##</td>
					<td class="centralizado"><a href="">NOMEPDF</a></td>
					<td class="centralizado"><a href=""><img src="../imagens/mais-detalhes.png"></a></td>
				</tr>

				<tr>
					
					<td class="centralizado">1</td>
					<td class="centralizado">IC</td>
					<td class="centralizado">5</td>
					<td class="centralizado">##</td>
					<td class="centralizado">##</td>
					<td class="centralizado"><a href="">NOMEPDF</a></td>
					<td class="centralizado"><a href=""><img src="../imagens/mais-detalhes.png"></a></td>
			</table>

			<!-- <div id="botoes">
				
				<input name="adicionar-atividade" id="adicionar-atividade" type="submit" value="Adicionar Atividade">
				<input name="enviar" id="enviar" type="submit" value="Enviar">

			</div> -->

		</div>

			

	</body>
</html>