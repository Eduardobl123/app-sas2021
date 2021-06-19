--Autor: Bruno M. Aranda
--Autor: Eduardo B. Lopes

CREATE OR REPLACE FUNCTION fn_get_professor_atual()
RETURNS VARCHAR AS $$
Declare 
	id_professor varchar
(255);
BEGIN

	select
	into id_professor
	login from tb_professor as p where p.is_atual = true;

RETURN id_professor;
END;
$$ LANGUAGE 'plpgsql';


CREATE OR REPLACE FUNCTION fn_tipo_usuario(chave varchar(255))
RETURNS VARCHAR AS $$
	Declare 
	tipo_usuario varchar;
  	BEGIN
	
	select into tipo_usuario
	u.tipo_usuario from tb_usuario as u where login = chave;
	
    RETURN tipo_usuario;
  END;
$$ LANGUAGE 'plpgsql';

CREATE OR REPLACE FUNCTION fn_validar_login(login varchar(255), senha varchar(255))
RETURNS record AS $$
	Declare 
	tipo_usuario varchar;
	continua boolean; regUser tb_usuario%ROWTYPE;
	cursor_User CURSOR FOR SELECT * FROM tb_usuario;
	tupla record;
BEGIN
	OPEN cursor_User;
	continua := TRUE;
	WHILE (continua) LOOP
		FETCH cursor_User INTO regUser;
		IF FOUND THEN
			IF login = regUser.login and senha = regUser.passworld THEN
				
				if regUser.tipo_usuario = 'professor' then
					select * into tupla from tb_professor as pr 
						where pr.login = regUser.login;
					return tupla;
				END IF;
				if regUser.tipo_usuario = 'aluno' then
					select * into tupla from tb_aluno as al
						where al.login = regUser.login;
					return tupla;
				END IF;
				
			END IF;
				
		ELSE
			continua:=false;
		END IF;
		
	END LOOP;
	CLOSE cursor_User;
	return NULL;
  END;
$$ LANGUAGE 'plpgsql';