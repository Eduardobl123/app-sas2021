--1
insert into tb_categoria_atividade
    (tipo_participacao_nv1, numero_nivel_participacao, is_porcentagem_ch, horas_por_atividade, porcentagem_por_atividade, limite_tipo_atividade)
values('Monitoria Extensão e/ou Ensino', 1, true, 0, 15 , 68),
    ('Iniciação Científica', 1, false, 68, 0 , 68),
    ('Estágio não obrigatório', 1, true, 0, 100 , 68),
    ('Participação em Órgão Colegiado', 1, false, 1, 0 , 34),
    ('Disciplina cursada como enriquecimento curricular', 1, true, 0, 50 , 68),
    ('Participação em Comissão de Estágio do Curso', 1, false, 1, 0 , 34),
    ('Programa de Educação Tutorial (PET)', 1, false, 34, 0 , 68),
    ('Projeto de Intervenção Comunitária', 1, true, 0, 75 , 17),
    ('Presença em Defesa de Projeto Final', 1, false, 1, 0 , 10),
    ('Visitas Técnicas', 1, false, 3, 0 , 12),
    ('Serviços à Justiça Eleitoral', 1, true, 0, 200 , 34);

--2
insert into tb_categoria_atividade
    (tipo_participacao_nv1, tipo_participacao_nv2, numero_nivel_participacao, is_porcentagem_ch, horas_por_atividade, porcentagem_por_atividade, limite_tipo_atividade)
values('Evento científico ou em áreas afins', 'Participação', 2, false, 1, 0, 15),
    ('Projeto de Extensão', 'Coordenador', 2, true, 0, 100, 68),
    ('Projeto de Extensão', 'Colaborador', 2, true, 0, 25 , 34),
    ('Projeto de Extensão', 'Instrutor', 2, true, 0, 100 , 68),
    ('Projeto de Extensão', 'Participante', 2, true, 0, 10 , 34),
    ('Projeto de Ensino', 'Coordenador', 2, true, 0, 100 , 68),
    ('Projeto de Ensino', 'Colaborador', 2, true, 0, 25 , 34),
    ('Projeto de Ensino', 'Instrutor', 2, true, 0, 100 , 68),
    ('Projeto de Ensino', 'Participante', 2, true, 0, 10 , 34),
    ('Projeto de Pesquisa', 'Coordenador', 2, true, 0, 100 , -1),
    ('Projeto de Pesquisa', 'Participante', 2, true, 0, 50 , 68),
    ('Publicação de Trabalho Científico', 'Trabalho completo', 2, false, 34, 0 , -1),
    ('Publicação de Trabalho Científico', 'Resumo expandido', 2, false, 20, 0 , 60),
    ('Publicação de Trabalho Científico', 'Resumo simples', 2, false, 8, 0 , 24),
    ('Curso pertinente à área', 'Curso Técnico em Áreas Afins (cursos/minicursos em eventos, projetos de extensão/ensino, etc.)', 2, true, 0, 25 , 34),
    ('Curso pertinente à área', 'Curso de Língua Estrangeira e/ou Informática', 2, false, 2, 0 , 8),
    ('Curso pertinente à área', 'Curso de Verão - Realizado em Instituição de Ensino Superior.', 2, true, 0, 100 , 68),
    ('Palestra', 'Ouvinte', 2, false, 1, 0 , 10),
    ('Palestra', 'Palestrante', 2, false, 2, 0 , 10);


--3
insert into tb_categoria_atividade
    (tipo_participacao_nv1, tipo_participacao_nv2, tipo_participacao_nv3, numero_nivel_participacao, is_porcentagem_ch, horas_por_atividade, porcentagem_por_atividade, limite_tipo_atividade)
values('Evento científico ou em áreas afins', 'Organização', 'Coordenador', 3, false, 24, 0 , 48),
    ('Evento científico ou em áreas afins', 'Organização', 'Colaborador', 3, false, 10, 0 , 30),
    ('Evento científico ou em áreas afins', 'Apresentação', 'Oral', 3, false, 12, 0 , -1),
    ('Evento científico ou em áreas afins', 'Apresentação', 'Painel', 3, false, 6, 0 , 30);

--insert  professor
insert into tb_professor
values('bruno.aranda', '123', 'bruno@gmail.com', 'arrumar', 'professor', '456', 'Bruno', 'Moraes Aranda', false);
insert into tb_professor
values('ivone.matsuno', '123456', 'ivone.matsuno@gmail.com', 'arrumar', 'professor', '022', 'Ivone', 'Matsuno', false);

--insert aluno
insert into tb_aluno
values('eduardo.b.lopes', '123', 'eduardo@gmail.com', 'arrumar', 'aluno', '071', 'Eduardo', 'Borges Lopes', 'Em análise', 0, 0);
insert into tb_aluno
values('emerson.murilho', '123', 'emerson.murilho@gmail.com', '9999-9999', 'aluno', '201807430368', 'Emerson', 'Nurilho', 'AP', 0, 0);

--exemplo insert tabela tb_atividade
insert into tb_atividade(nome_atividade, descricao_atividade, tipo_participacao_nv1, tipo_participacao_nv2, tipo_participacao_nv3, data_inicio, data_fim, ch_total_atividade, id_aluno)
    values('nome', 'descricao', 'Disciplina cursada como enriquecimento curricular', 'Não há', 'Não há', '01-02-2020','01-02-2020' , 64, 'eduardo.b.lopes');

