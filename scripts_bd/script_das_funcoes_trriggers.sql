--Autor: Bruno M. Aranda
--Autor: Eduardo B. Lopes


CREATE OR REPLACE FUNCTION fn_atribui_tipo_atividade()
RETURNS TRIGGER AS $$
  BEGIN
  update  tb_atividade set id_categoria_atividade =  (select ctg.id_categoria_atividade
	from tb_categoria_atividade as ctg 
	where ctg.tipo_participacao_nv1 = new.tipo_participacao_nv1 and
		ctg.tipo_participacao_nv2 = new.tipo_participacao_nv2 and
		ctg.tipo_participacao_nv3 = new.tipo_participacao_nv3)
	where id_atividade = new.id_atividade;
	
    RETURN new;
  END;
$$ LANGUAGE 'plpgsql';
CREATE TRIGGER trigger_arquivar_usuario 
	after insert
    ON tb_atividade FOR EACH ROW
    EXECUTE PROCEDURE fn_atribui_tipo_atividade();
	
	
