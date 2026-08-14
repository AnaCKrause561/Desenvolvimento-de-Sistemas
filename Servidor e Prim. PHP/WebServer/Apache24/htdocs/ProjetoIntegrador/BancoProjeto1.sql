-- áreas de atuação
CREATE TABLE usuario_areas (
	area_id SERIAL PRIMARY KEY,
    area VARCHAR(20) NOT NULL -- avicultura, agronomia, incubatorio, abatedouro
);

-- nível de acesso
CREATE TABLE niveis (
	nivel_id SERIAL PRIMARY KEY,
    descricao VARCHAR(20) NOT NULL -- administrador, auditor, supervisor, gerente
);

--USUÁRIO
CREATE TABLE usuarios(
	id SERIAL PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(100) UNIQUE NOT NULL,
	login VARCHAR(100) UNIQUE NOT NULL,
	senha VARCHAR(100) NOT NULL,
	cargo VARCHAR(200),
	url VARCHAR(150),
	area_acesso INT NOT NULL REFERENCES usuario_areas(area_id),
	ativo BOOL NOT NULL DEFAULT TRUE,
	nivel_idfk INT NOT NULL REFERENCES niveis(nivel_id),
	criado_em TIMESTAMP NOT NULL DEFAULT NOW()
);

--EMPRESA
CREATE TABLE empresas (
    id SERIAL PRIMARY KEY, 
    nome VARCHAR(150) NOT NULL,
    area VARCHAR(20) NOT NULL,  -- avicultura, agronomia, incubatorio, abatedouro
    endereco VARCHAR(255), 
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id), 
    criado_em TIMESTAMP NOT NULL DEFAULT NOW() 
);

--PRODUTORES
CREATE TABLE produtores (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cpf VARCHAR(14),
    telefone VARCHAR(20),
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id),
	empresa_id INTEGER  REFERENCES empresas(id),
    criado_em TIMESTAMP NOT NULL DEFAULT NOW()
);

--GRANJA
CREATE TABLE granjas (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    area VARCHAR(20) NOT NULL,  -- avicultura, agronomia, incubatorio, abatedouro
    endereco VARCHAR(255),
    produtor_id INTEGER REFERENCES produtores(id),  
    usuario_id INTEGER NOT NULL REFERENCES usuarios(id),
	empresas_id INTEGER NOT NULL REFERENCES empresas(id),
    criado_em TIMESTAMP NOT NULL DEFAULT NOW()
);

SELECT * FROM usuarios;
CREATE TABLE usuario_areas;
DROP TABLE  granjas cascade;
UPDATE  usuarios set senha = 'e10adc3949ba59abbe56e057f20f883e' where id = 1;

INSERT INTO niveis (descricao) VALUES ('adminstrador'),('auditor'), ('supervisor'), ('gerente');

INSERT INTO usuario_areas (area) VALUES ('avicultura'),('agronomia'), ('incubatorio'), ('abatedouro');

INSERT INTO usuarios (nome, login, email, senha, cargo, area_acesso, nivel_idfk, ativo) VALUES (
    'Ana Cristina',
    'admin',
    'admin@gmail.com',
    'e10adc3949ba59abbe56e057f20f883e', --123456
    'Administrador do Sistema',
	1,
	1,
    TRUE
);
