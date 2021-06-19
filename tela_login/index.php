
<!DOCTYPE html>
<html>
	<head>
		<title>
		Estilizando Formulários part 2</title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="estilos.css">
	</head>
	<body>

		<div id="container">
			
			<img src="imagens/logo.png">

			<form action="../valida_login.php" method = "post">
				
				<div>
					
					<input class="email" type="text" name="email" id="email" placeholder="Digite seu e-mail">

				</div>

				<div>
					
					<input class="senha" type="password" name="senha" id="senha" placeholder="Digite sua senha">

				</div>

				<?php
					
					if(isset($_GET['login']) && $_GET['login'] == 'erro'){ ?>

					<div class="text-danger">
						<h3>Usuário ou senha inválido(s)</h3>
                	</div>
						
					<?}
				?>

				<?php 
				  if(isset($_GET['login']) && $_GET['login'] == 'erro2'){?>

					<div class="text-danger">
						<h3>Bloqueado acesso, faça login!</h3>
					</div>

				<? } 
				
				?>
				<div>
					
					<input class="submit" type="submit" value="Logar">

				</div>

			</form>

		</div>

		

	</body>
</html>

