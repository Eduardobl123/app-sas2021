alter table tb_atividade
	alter column id_professor set default fn_get_professor_atual();