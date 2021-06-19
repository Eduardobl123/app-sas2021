<?php
session_start();

$link = mysqli_connect("127.0.0.1:3306", "root", "12345678", "bd_saas");

$login = $_SESSION['login'];

$consulta1 = "update tb_atividade set situacao_atividade = 'Salvo'  where id_aluno = '$login';";
$consulta2 = "update tb_aluno as al set situacao_aluno = 'Sem envio'  where al.login = '$login';";

        
$result = mysqli_query($link, $consulta1);
$result = mysqli_query($link, $consulta2);

$sucesso = mysqli_fetch_assoc($result);
$st_sucesso = "Sucesso";
header('location: historico-e-feedback.php?aviso='. $st_sucesso);

?>