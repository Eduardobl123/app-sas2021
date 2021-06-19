--Autor: Bruno M. Aranda
--Autor: Eduardo B. Lopes

CREATE OR REPLACE FUNCTION sp_add_atividade(nome VARCHAR, descricao text, tipo1 VARCHAR, tipo2 VARCHAR, tipo3 VARCHAR, dataInicio date, dataFim date, ch_total int, id_aluno_da_atv VARCHAR)
RETURNS varchar AS $$
Declare 
	qtd_atividade_em_analise int;
BEGIN

    select into qtd_atividade_em_analise count(*) from tb_atividade where situacao_atividade = 'Em análise' and id_aluno = id_aluno_da_atv;
	if qtd_atividade_em_analise = 0  then
            insert into tb_atividade(nome_atividade, descricao_atividade, tipo_participacao_nv1, tipo_participacao_nv2, tipo_participacao_nv3, data_inicio, data_fim, ch_total_atividade, id_aluno)
            values(nome, descricao, tipo1, tipo2, tipo3, dataInicio,dataFim , ch_total, id_aluno_da_atv);
            RETURN 'cadastro realizado com sucesso!';
            
    else
        return 'Não é possivel adicionar mais atividades, pois há atividades enviadas ainda em análise.';
    end if;
    EXCEPTION WHEN OTHERS THEN
        return 'Cadastro da atividade não realizada, verifique os campos preenchidos!';
END;
$$ LANGUAGE 'plpgsql'; 


CREATE OR REPLACE FUNCTION sp_enviar_atividade(login VARCHAR)
RETURNS varchar AS $$
Declare
    qtd_atividade_salva int;
    qtd_atividade_em_analise int;
BEGIN
    qtd_atividade_salva := 0;

    select into qtd_atividade_em_analise count(*) from tb_atividade where situacao_atividade = 'Em análise' and id_aluno = login;

    select into qtd_atividade_salva count(*) from tb_atividade where situacao_atividade = 'Salvo' and id_aluno = login;

    if qtd_atividade_salva >= 3 and qtd_atividade_em_analise = 0  then
        update tb_atividade set situacao_atividade = 'Em análise', data_de_envio = now()  where situacao_atividade = 'Salvo' and id_aluno = login;
        RETURN 'Enviado com sucesso, aguarde o resultado em feedback. Boa sorte ^-^';
    end if;

    if qtd_atividade_salva < 3 and qtd_atividade_em_analise = 0 then
        RETURN 'Não enviado :/, é necessario no minimo 3 atividade para envio';
    end if;

    if qtd_atividade_em_analise > 0 then
        RETURN 'Sua atividades estão em análise :/, não é possivel enviar as atividades';
    end if;
	-- Lembrar de alterar por elsif
END;
$$ LANGUAGE 'plpgsql';



CREATE OR REPLACE FUNCTION sp_refazer_atividade(login VARCHAR)
RETURNS varchar AS $$
Declare
    qtd_atividade_em_analise int;
BEGIN
    qtd_atividade_em_analise := 0;

    select into qtd_atividade_em_analise count(*) from tb_atividade where situacao_atividade = 'Em análise' and id_aluno = login;

    if qtd_atividade_em_analise = 0 then
        update tb_atividade set situacao_atividade = 'Salvo'  where id_aluno = login;
        RETURN 'sucesso! sua atividade estarão em minhas atividades Boa sorte ^-^';
    end if;

    if qtd_atividade_em_analise > 0 then
        RETURN 'Sua atividades estão em análise :/, não é possivel refazer as atividades';
    end if;
	
END;
$$ LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION sp_add_avaliacao(id_atv int, descricao_feeback text, situacao_atividade_avaliada varchar)
RETURNS varchar AS $$

BEGIN
    if situacao_atividade_avaliada = 'Aprovado' or situacao_atividade_avaliada = 'Reprovado' then
            update tb_atividade set feedback_professora = descricao_feeback, situacao_atividade = situacao_atividade_avaliada
            where id_atividade = id_atv;
            return 'sucesso';
    else
        return 'Deve-se Aprovar ou Reprovar a atividade para se enviar a avaliação!';
    end if;
	
END;
$$ LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION sp_iniciar_semestre(id_prof varchar)
RETURNS varchar AS $$
declare
    count int;
BEGIN
    count := (select count(*) from tb_professor where is_atual = true);

    if count = 0 then
        update tb_professor set is_atual = true where login = id_prof;
        return 'Semestre iniciado!';

    else
        return 'O Semestre não pode ser iniciado, Pois já existe um semestre em andamento!';
    end if;
	
END;
$$ LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION sp_encerrar_semestre(id_prof varchar)
RETURNS varchar AS $$
declare
    aux boolean;
BEGIN
    aux := (select is_atual from tb_professor where login = id_prof);

    if aux then
        update tb_professor set is_atual = false where login = id_prof;
        return 'Semestre encerrado!';

    else
        return 'O Semestre não pode ser encerrado, Pois o senhor não é o professor responsavel pelo semestre!';
    end if;
	
END;
$$ LANGUAGE 'plpgsql';
