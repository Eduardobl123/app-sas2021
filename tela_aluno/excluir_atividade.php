<?php
$conexao = pg_connect("host=localhost port = 5432 dbname=bd_atividades_complementares user=postgres password=1247") or
die ("Não foi possível conectar ao servidor PostGreSQL");

$result = pg_query($conexao, "delete from tb_atividade where id_atividade = ".$_GET['id_atv']);

header('Location: minhas-atividades.php');

?>