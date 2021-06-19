<? 
require_once "../validador_acesso_aluno.php";
  
?>
<!DOCTYPE html>
<html>
	<head>
		<title>SI - Horas Complementares</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="../css/estilo-padrao.css">
		<link rel="stylesheet" type="text/css" href="../css/estilos-historico-feedback.css">
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
					<th>Código de atividade</th>
					<th>Data de envio</th>
					<th>Atividade Enviada</th>
					<th>Situação</th>
					<th>Feedback</th>
				</tr>
				<?php
					$login = $_SESSION['login'];
						$link = mysqli_connect("127.0.0.1:3306", "root", "12345678", "bd_saas");
						$result = mysqli_query($link, 'select id_atividade,  nome_atividade, situacao_atividade, data_de_envio  from tb_atividade inner join tb_aluno
									on login = id_aluno
								where login = '."'".$login."' and (situacao_atividade = 'Em análise' or situacao_atividade = 'Reprovado' or situacao_atividade = 'Aprovado')" );
							$dado_atividades = mysqli_fetch_all($result);
							
							$cont = 0;
							if(isset($dado_atividades[0])){
								// var_dump($dado_atividades);
								foreach($dado_atividades as  $vetor){
									if($cont == 0){
										?><tr class= 'alternado'>

										<td class="centralizado"> <?php print($vetor[0]);?></td>
										<td class="centralizado"> 01/01/2021</td>
										<td class="alinhado-direta"><?php print($vetor[1]);?></td>
										<td class="centralizado"><?php print($vetor[2]);?></td>
										<td class="centralizado"><a href=<?php print('"visualizar_feedback.php?id_atv='.$vetor[1].'"');?>><img height="40px" src="../imagens/historico-e-feedback.png"></a></td>
										
										</tr>
										<?
										$cont = 1;
									}else{
										?><tr>
						
										<td class="centralizado"> <?php print($vetor[0]);?></td>
										<td class="centralizado"> 01/01/2021</td>
										<td class="alinhado-direta"><?php print($vetor[1]);?></td>
										<td class="centralizado"><?php print($vetor[2]);?></td>
										<td class="centralizado"><a href=<?php print('"visualizar_feedback.php?id_atv='.$vetor[0].'"');?>><img height="40px" src="../imagens/historico-e-feedback.png"></a></td>
										
										</tr>
										<?
										$cont = 0;
									}
							}


									

							}	
						
					?>
			</table>

			<div id="botoes">
				
				<input name="Revizar" id="Revizar" type="submit" value="Refazer Envio" onclick="location.href='refazer_atividade.php';">
			</div>

		</div>

		<?php
					if(isset($_GET['aviso'])){ ?>

						<script>
							async function initPage(){
								alert('<?print($_GET['aviso'])?>');
							}
							window.onload = initPage();
						
						</script>
						
					<?}
		?>

	</body>
</html>