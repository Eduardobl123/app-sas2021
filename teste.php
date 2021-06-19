<?php

    $login = 'eduardo.b.lopes';
    $conexao = pg_connect("host=localhost port = 5432 dbname=bd_atividades_complementares user=postgres password=1247") or
    die ("Não foi possível conectar ao servidor PostGreSQL");
    echo "Conexão efetuada com sucesso!!";

    $result = pg_query($conexao, 'select id_atividade,   tipo_participacao_nv1,nome_atividade, periodo_atividade,ch_total_atividade, ch_aproveitada  from tb_atividade inner join tb_aluno
            on login = id_aluno
        where login = '."'".$login."'");
    $dado_atividades = pg_fetch_all($result);
    
    echo '<pre>';
    var_dump($dado_atividades);

    foreach($dado_atividades as  $vetor){
        echo '<br>';
        print($vetor['id_atividade']);


    }

?>