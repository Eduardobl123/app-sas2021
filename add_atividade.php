<?php
    session_start();

    $nome = $_POST['nome'];
    $tipo1 = $_POST['tipo1'];
    $tipo2 = $_POST['tipo2'];
    $tipo3 = "Não há";

    if(isset($_POST['tipo3'])){
        $tipo3 = $_POST['tipo3'];
    }
    $data_inicio = $_POST['dataInicioAtividade'];
    $data_fim = $_POST['dataFimAtividade'];
    $ch_total = $_POST['ch_total'];
    $descricao = $_POST['descricao'];
    $login = $_SESSION['login'];

    $conexao = pg_connect("host=localhost port = 5432 dbname=bd_atividades_complementares user=postgres password=1247") or
    die ("Não foi possível conectar ao servidor PostGreSQL");
    $str_insert = "select sp_add_atividade('$nome', '$descricao','$tipo1', '$tipo2', '$tipo3', '$data_inicio', '$data_fim', $ch_total, '$login')";
    $result = pg_query($conexao, $str_insert);
    $sucesso = pg_fetch_assoc($result);
    $st_sucesso = $sucesso['sp_add_atividade'];
    header('location: ./tela_aluno/minhas-atividades.php?aviso='. $st_sucesso);

?>