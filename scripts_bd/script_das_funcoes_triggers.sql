--Autor: Bruno M. Aranda
--Autor: Eduardo B. Lopes


CREATE OR REPLACE FUNCTION fn_atribui_tipo_atividade()
RETURNS TRIGGER AS $$
  BEGIN
  new.id_categoria_atividade :=  (select ctg.id_categoria_atividade
	from tb_categoria_atividade as ctg 
	where ctg.tipo_participacao_nv1 = new.tipo_participacao_nv1 and
		ctg.tipo_participacao_nv2 = new.tipo_participacao_nv2 and
		ctg.tipo_participacao_nv3 = new.tipo_participacao_nv3);
	
	
    RETURN new;
  END;
$$ LANGUAGE 'plpgsql';

CREATE TRIGGER trigger_atribui_tipo_atividade
	before insert
    ON tb_atividade FOR EACH ROW
    EXECUTE PROCEDURE fn_atribui_tipo_atividade();
	
	
CREATE OR REPLACE FUNCTION fn_calcular_hora_aproveitada()
RETURNS TRIGGER AS $$
  Declare
	is_porcentagem boolean;
	aux int;
	soma int;
	diferenca int;
	limite int;
  BEGIN
  	soma :=0;
  	soma := (select sum(ch_aproveitada) from tb_atividade as atv inner join tb_categoria_atividade as ca 
  	on atv.id_categoria_atividade = ca.id_categoria_atividade
  	where atv.id_aluno = new.id_aluno and atv.id_categoria_atividade = new.id_categoria_atividade);
  	limite = (select limite_tipo_atividade from tb_categoria_atividade as ca where ca.id_categoria_atividade = new.id_categoria_atividade);--limite da atividade
  
  	select into is_porcentagem tb.is_porcentagem_ch 
	  from tb_categoria_atividade as tb 
	  where tb.id_categoria_atividade = new.id_categoria_atividade;
	 raise notice 'soma = %', soma;
	 raise notice 'limite = %', limite;
	diferenca := limite - soma;
	raise notice 'diferenca = %', diferenca;
	if is_porcentagem then

		raise notice 'passei is_porcentagem = true';
		aux := (select porcentagem_por_atividade 
					from tb_categoria_atividade 
					where id_categoria_atividade = new.id_categoria_atividade );
		aux := aux * new.ch_total_atividade;
		aux := aux / 100;
		
		raise notice 'aux = %', aux;
		if aux > diferenca and limite != -1 then
			if diferenca < 0 then
				aux := 0;
			else
				aux := diferenca;
			end if;
		end if;
		update tb_atividade as atv set ch_aproveitada = aux
			where atv.id_atividade = new.id_atividade;
	else
		aux = (select horas_por_atividade 
					from tb_categoria_atividade 
					where id_categoria_atividade = new.id_categoria_atividade );

		if aux > diferenca and limite != -1 then
			if diferenca < 0 then
				aux := 0;
			else
				aux := diferenca;
			end if;
		end if;
		update tb_atividade as atv set ch_aproveitada = aux
			where atv.id_atividade = new.id_atividade;
	end if;  

    RETURN new;
  END;
$$ LANGUAGE 'plpgsql';

CREATE TRIGGER trigger_calcular_horas
	after insert
    ON tb_atividade FOR EACH ROW
    EXECUTE PROCEDURE fn_calcular_hora_aproveitada();
	


--Regra de negocio
CREATE OR REPLACE FUNCTION fn_calcular_aprovacao()
RETURNS TRIGGER AS $$
Declare
	qtd_horas_aprovadas int;
	qtd_atividade_aprovadas int;
  BEGIN

	qtd_horas_aprovadas := 0;
	update tb_aluno set qtd_atividade = (select count(*) from tb_atividade where id_aluno = new.id_aluno and situacao_atividade != 'Em análise')
		where login = new.id_aluno;

	if qtd_horas_aprovadas = NULL then
		qtd_horas_aprovadas := 0;
	end if;
	qtd_horas_aprovadas := (select sum(ch_aproveitada) from tb_atividade where id_aluno = new.id_aluno and situacao_atividade = 'Aprovado');
	update tb_aluno set ch_reconhecida = qtd_horas_aprovadas
		where login = new.id_aluno;

	qtd_atividade_aprovadas = (select qtd_atividade from tb_atividade where id_aluno = new.id_aluno and situacao_atividade = 'Aprovado');

	if qtd_horas_aprovadas >= 102 and qtd_atividade_aprovadas >= 3 then
		update tb_aluno set situacao_aluno = 'AP'
			where login = new.id_aluno;
	else
		update tb_aluno set situacao_aluno = 'RP'
			where login = new.id_aluno;
	end if;
	

	
    RETURN new;
  END;
$$ LANGUAGE 'plpgsql';

CREATE TRIGGER trigger_calcular_aprovacao
	after update
    ON tb_atividade FOR EACH ROW
    EXECUTE PROCEDURE fn_calcular_aprovacao();