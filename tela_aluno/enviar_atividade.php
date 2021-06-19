<?php
session_start();

$link = mysqli_connect("bd-saas.mysql.uhserver.com:3306", "eduardo_bruno", "brunosafado*2021", "bd_saas");

$login = $_SESSION['login'];

$consulta = "update tb_atividade set situacao_atividade = 'Em análise'  where situacao_atividade = 'Salvo' and id_aluno = '$login'";

echo $consulta;

$result = mysqli_query($link, $consulta);




header('location: minhas-atividades.php?aviso='. $result);

?>
