<?php
	$id_atv = $_GET['id_atv'];
	$descricao = $_POST['descricao'];
	$situacao = $_POST['situacao'];


	$link = mysqli_connect("bd-saas.mysql.uhserver.com:3306", "eduardo_bruno", "brunosafado*2021", "bd_saas");
    $str_insert = "update tb_atividade set feedback_professora = $descricao, situacao_atividade = $situacao
    where id_atividade = $id_atv;')";
    $result = mysqli_query($conexao, $str_insert);
    $sucesso = mysqli_fetch_assoc($result);
    $st_sucesso = "Sucesso";
    header('location: analise-de-atividades.php?aviso='. $st_sucesso);
?>
