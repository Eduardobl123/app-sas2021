<? 
require_once "../validador_acesso_aluno.php";
  
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SI - Horas Complementares</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilo-padrao.css">
		<link rel="stylesheet" type="text/css" href="../css/estilos-minhas-atividades.css">
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
			<table>
			
				<tr>
					<th>Codigo atividade</th>
					<th>Tipo de Atividade</th>
					<th>Atividade</th>
					<th>Período</th>
					<th>CH Total</th>
					<th>CH Aproveitada</th>
					<th>Excluir</th>
				</tr>

				
				<?php
					$login = $_SESSION['login'];
							

							$consulta = 'select id_atividade,  tipo_participacao_nv1,nome_atividade, data_inicio, data_fim,ch_total_atividade, ch_aproveitada  from tb_atividade inner join tb_aluno
							on login = id_aluno where login = '."'".$login."' and situacao_atividade = ". "'Salvo'";
							
							$link = mysqli_connect("bd-saas.mysql.uhserver.com:3306", "eduardo_bruno", "brunosafado*2021", "bd_saas");
					
							$result = mysqli_query($link, $consulta);
							$dado_atividades = mysqli_fetch_fields($result);//é adiquiro o array com os dados do usuario caso exista
							//var_dump($dado_atividades[1]);


							
							$cont = 0;
							
								while($vetor = $result->fetch_row()){

									if($cont == 0){
										?><tr class= 'alternado'>
						
										<td class="centralizado"> <?php print($vetor[0]);?> </td>
										<td><?php print($vetor[1]);?></td>
										<td><?php print($vetor[2]);?></td>
										<td class="centralizado"><?php print($vetor[3]." <br>até<br>".$vetor[4]);?></td>
										<td class="alinhado-direta"><?php print($vetor[5]);?></td>
										<td class="alinhado-direta"><?php print($vetor[6]);?></td>
										<td class="centralizado"><a href=<?php print('"excluir_atividade.php?id_atv='.$vetor[0].'"');?>><img src="../imagens/lixeira.png"></a></td>
					
										</tr>
										<?
										$cont = 1;
									}else{
										?><tr>
						
										<td class="centralizado"> <?php print($vetor[0]);?> </td>
										<td><?php print($vetor[1]);?></td>
										<td><?php print($vetor[2]);?></td>
										<td class="centralizado"><?php print($vetor[3]." <br>até<br>".$vetor[4]);?></td>
										<td class="alinhado-direta"><?php print($vetor[5]);?></td>
										<td class="alinhado-direta"><?php print($vetor[6]);?></td>
										<td class="centralizado"><a href=<?php print('"excluir_atividade.php?id_atv='.$vetor[0].'"');?>><img src="../imagens/lixeira.png"></a></td>
					
										</tr>
										<?
										$cont = 0;
									}
							


									

							}	
						
					?>

			</table>

			<div id="botoes">
				
				<input name="adicionar-atividade" id="adicionar-atividade" type="submit" value="Adicionar Atividade" onclick="location.href='adicionar-atividade.php';">
				<input name="enviar" id="enviar" type="submit" value="Enviar" onclick="location.href='enviar_atividade.php';">

			</div>

		</div>

			
		<?php
					if(isset($_GET['aviso'])){ ?>

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
