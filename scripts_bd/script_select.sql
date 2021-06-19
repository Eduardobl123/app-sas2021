select id_atividade,  tipo_participacao_nv1,nome_atividade, periodo_atividade,ch_total_atividade, ch_aproveitada  
from tb_atividade inner join tb_aluno
	on login = id_aluno
	where login = '."'".$login."' and situacao_atividade = ". "'Salvo'"

$consulta_aluno = "select * from tb_aluno as aluno where aluno.login = '$login' and aluno.passworld = '$senha'";

$consulta_professor = "select * from tb_professor as prof where prof.login = '$login' and prof.passworld = '$senha'";

$str_insert = "select sp_add_atividade('$nome', '$descricao','$tipo1', '$tipo2', '$tipo3', $periodo, $ch_total, '$login')";

$result = pg_query($conexao, "select pnome_aluno, unome_aluno, rga, data_de_envio, situacao_atividade, id_atividade 
							from tb_aluno inner join tb_atividade on id_aluno = login
							where situacao_atividade = 'Em análise' or situacao_atividade = 'Reprovado' or situacao_atividade = 'Aprovado';");



--ALTER DATABASE nomedabase SET datestyle TO SQL, DMY;