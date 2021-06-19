<?php
$conexao = mysqli_connect("bd-saas.mysql.uhserver.com:3306", "eduardo_bruno", "brunosafado*2021", "bd_saas") or
die ("Não foi possível conectar ao servidor PostGreSQL");

$result = mysqli_query($conexao, "delete from tb_atividade where id_atividade = ".$_GET['id_atv']);

header('Location: minhas-atividades.php');

?>
