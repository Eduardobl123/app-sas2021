--Autor: Bruno M. Aranda
--Autor: Eduardo B. Lopes




create table tb_aluno
(

	rga varchar(15) unique not null,
	pnome_aluno varchar(255) not null,
	unome_aluno varchar(255) not null,
	situacao_aluno varchar(30) not null,
	ch_reconhecida int default(0),
	qtd_atividade int default(0),

	CONSTRAINT pk_login_aluno PRIMARY KEY (login),
	CONSTRAINT regra_situacao_aluno check(situacao_aluno = 'AP' or situacao_aluno = 'RP' or situacao_aluno = 'Em análise'),
	CONSTRAINT regra_tipo_aluno CHECK(tipo_usuario = 'aluno')

)
inherits
(tb_usuario);

-- SQLINES LICENSE FOR EVALUATION USE ONLY
create table tb_aluno
(
	login varchar(255) not null,
	passworld varchar(255) not null,
	email longtext not null,
	telefone varchar(11) not null,
	tipo_usuario VARCHAR(15) not null,

	rga varchar(15) unique not null,
	pnome_aluno varchar(255) not null,
	unome_aluno varchar(255) not null,
	situacao_aluno varchar(30) not null,
	ch_reconhecida int default(0),
	qtd_atividade int default(0),
	

	CONSTRAINT pk_login_aluno PRIMARY KEY (login),
	CONSTRAINT regra_situacao_aluno check(situacao_aluno = 'Aprovado' or situacao_aluno = 'Reprovado' or situacao_aluno = 'Em análise'),
	CONSTRAINT regra_tipo_aluno CHECK(tipo_usuario = 'aluno')

) DEFAULT CHARSET = UTF8;

create table tb_professor
(

	cpf_professor varchar(15) unique not null,
	pnome_professor varchar(255) not null,
	unome_professor varchar(255) not null,
	is_atual boolean default(false),

	CONSTRAINT pk_login_professor PRIMARY KEY (login),
	CONSTRAINT regra_tipo_professor CHECK(tipo_usuario = 'professor')
)
inherits
(tb_usuario);


create table tb_categoria_atividade
(

	id_categoria_atividade serial,
	tipo_participacao_nv1 varchar(255) not null,
	tipo_participacao_nv2 varchar(255) default('Não há'),
	tipo_participacao_nv3 varchar(255) default('Não há'),
	numero_nivel_participacao int not null,
	is_porcentagem_ch boolean not null,
	horas_por_atividade int default(0),
	porcentagem_por_atividade int default(0),
	limite_tipo_atividade int default(0),

	CONSTRAINT pk_id_categoria_atividade PRIMARY KEY (id_categoria_atividade),
	CONSTRAINT regra_hora_or_porcentagem check (horas_por_atividade != 0 or porcentagem_por_atividade !=0)

);

create table tb_atividade
(

	id_atividade serial,
	nome_atividade varchar(255) not null,
	descricao_atividade text not null,
	tipo_participacao_nv1 varchar(255) not null,
	tipo_participacao_nv2 varchar(255) default('Não há'),
	tipo_participacao_nv3 varchar(255) default('Não há'),
	data_inicio date not null,
	data_fim date not null,
	ch_total_atividade int not null,
	ch_aproveitada int default(0),
	feedback_professora text,
	situacao_atividade varchar(30) default('Salvo'),
	data_de_envio date,
	id_aluno varchar(255) not null,
	id_professor varchar(255),
	id_categoria_atividade integer,


	CONSTRAINT pk_id_atividade PRIMARY KEY (id_atividade),
	CONSTRAINT fk_id_categoria_atividade foreign key(id_categoria_atividade) references tb_categoria_atividade(id_categoria_atividade),
	CONSTRAINT fk_id_professor foreign key(id_professor) references tb_professor(login),
	CONSTRAINT fk_id_aluno foreign key(id_aluno) references tb_aluno(login),
	CONSTRAINT regra_situacao_atividade check(situacao_atividade = 'Aprovado' or situacao_atividade = 'Reprovado' or situacao_atividade = 'Em análise' or situacao_atividade = 'Salvo')

);


create table tb_documento
(

	id_doc serial,
	nome_documento varchar(255) default('sem nome'),
	path_documento path not null,
	id_atividade serial not null,

	CONSTRAINT pk_id_doc PRIMARY KEY (id_doc),
	CONSTRAINT fk_id_atividade foreign key(id_atividade) references tb_atividade(id_atividade)
);


--  SQLINES DEMO *** anda
--  SQLINES DEMO *** Lopes



-- SQLINES LICENSE FOR EVALUATION USE ONLY
create table tb_aluno
(
	login varchar(255) not null,
	passworld varchar(255) not null,
	email longtext not null,
	telefone varchar(11) not null,
	tipo_usuario VARCHAR(15) not null,

	rga varchar(15) unique not null,
	pnome_aluno varchar(255) not null,
	unome_aluno varchar(255) not null,
	situacao_aluno varchar(30) not null,
	ch_reconhecida int default(0),
	qtd_atividade int default(0),
	

	CONSTRAINT pk_login_aluno PRIMARY KEY (login),
	CONSTRAINT regra_situacao_aluno check(situacao_aluno = 'Aprovado' or situacao_aluno = 'Reprovado' or situacao_aluno = 'Em análise'),
	CONSTRAINT regra_tipo_aluno CHECK(tipo_usuario = 'aluno')

) DEFAULT CHARSET = UTF8;



-- SQLINES LICENSE FOR EVALUATION USE ONLY
create table tb_professor
(
	login varchar(255) not null,
	passworld varchar(255) not null,
	email longtext not null,
	telefone varchar(11) not null,
	tipo_usuario VARCHAR(15) not null,

	cpf_professor varchar(15) unique not null,
	pnome_professor varchar(255) not null,
	unome_professor varchar(255) not null,
	is_atual boolean default(false),

	

	CONSTRAINT pk_login_professor PRIMARY KEY (login),
	CONSTRAINT regra_tipo_professor CHECK(tipo_usuario = 'professor')
) DEFAULT CHARSET = UTF8;



-- SQLINES LICENSE FOR EVALUATION USE ONLY
create table tb_categoria_atividade
(

	id_categoria_atividade serial,
	tipo_participacao_nv1 varchar(255) not null,
	tipo_participacao_nv2 varchar(255) default('Não há'),
	tipo_participacao_nv3 varchar(255) default('Não há'),
	numero_nivel_participacao int not null,
	is_porcentagem_ch boolean not null,
	horas_por_atividade int default(0),
	porcentagem_por_atividade int default(0),
	limite_tipo_atividade int default(0),

	CONSTRAINT pk_id_categoria_atividade PRIMARY KEY (id_categoria_atividade),
	CONSTRAINT regra_hora_or_porcentagem check (horas_por_atividade != 0 or porcentagem_por_atividade !=0)

) DEFAULT CHARSET = UTF8;

-- SQLINES LICENSE FOR EVALUATION USE ONLY
create table tb_atividade
(

	id_atividade serial,
	nome_atividade varchar(255) not null,
	descricao_atividade longtext not null,
	tipo_participacao_nv1 varchar(255) not null,
	tipo_participacao_nv2 varchar(255) default('Não há'),
	tipo_participacao_nv3 varchar(255) default('Não há'),
	periodo_atividade int not null,
	ch_total_atividade int not null,
	ch_aproveitada int default(0),
	feedback_professora longtext,
	situacao_atividade varchar(30) default('Salvo'),
	id_aluno varchar(255) not null,
	id_professor varchar(255),
	id_categoria_atividade BIGINT UNSIGNED NOT NULL,


	CONSTRAINT pk_id_atividade PRIMARY KEY (id_atividade),
	CONSTRAINT fk_id_categoria_atividade foreign key(id_categoria_atividade) references tb_categoria_atividade(id_categoria_atividade),
	CONSTRAINT fk_id_professor foreign key(id_professor) references tb_professor(login),
	CONSTRAINT fk_id_aluno foreign key(id_aluno) references tb_aluno(login),
	CONSTRAINT regra_situacao_atividade check(situacao_atividade = 'Aprovado' or situacao_atividade = 'Reprovado' or situacao_atividade = 'Em análise' or situacao_atividade = 'Salvo')

) DEFAULT CHARSET = UTF8;


-- SQLINES LICENSE FOR EVALUATION USE ONLY
create table tb_documento
(

	id_doc serial,
	nome_documento varchar(255) default('sem nome'),
	path_documento longtext not null,
	id_atividade serial not null,

	CONSTRAINT pk_id_doc PRIMARY KEY (id_doc),
	CONSTRAINT fk_id_atividade foreign key(id_atividade) references tb_atividade(id_atividade)
) DEFAULT CHARSET = UTF8;


Error Code: 1064. You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'NOT NULL AUTO_INCREMENT,  tipo_participacao_nv1 varchar(255) not null,  tipo_par' at line 4
