<?php
    var_dump($_GET);

    if(isset($_GET['situacao'])){
        $id_prof = $_GET['id_prof'];

        $situacao = $_GET['situacao'];
    
        $conexao = pg_connect("host=localhost port = 5432 dbname=bd_atividades_complementares user=postgres password=1247") or
        die ("Não foi possível conectar ao servidor PostGreSQL");

        if($_GET['situacao']=='iniciar'){
            $str_consulta = "select sp_iniciar_semestre('$id_prof')";
            $result = pg_query($conexao, $str_consulta);
            $sucesso = pg_fetch_assoc($result);
            $st_sucesso = $sucesso['sp_iniciar_semestre'];
            echo $st_sucesso;
            header('location: index.php?aviso='. $st_sucesso);
        }
        if($_GET['situacao'] ==  'encerrar'){
            $str_consulta = "select sp_encerrar_semestre('$id_prof')";
            $result = pg_query($conexao, $str_consulta);
            $sucesso = pg_fetch_assoc($result);
            $st_sucesso = $sucesso['sp_encerrar_semestre'];
            echo $st_sucesso;
            header('location: index.php?aviso='. $st_sucesso);

        }
    }


?>