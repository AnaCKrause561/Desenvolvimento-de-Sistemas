CREATE TABLE usuario(
	id SERIAL PRIMARY KEY,
	nome VARCHAR(100),
	email VARCHAR(100) UNIQUE,
	senha VARCHAR(100),
	descricao VARCHAR(200),
	url VARCHAR(150),
	ativo BOOL
);

ALTER TABLE usuario ADD telefone VARCHAR(20);

SELECT * FROM usuario;


CREATE TABLE contatos(
	id SERIAL PRIMARY KEY,
	nome VARCHAR(100),
	email VARCHAR(100),
	telefone VARCHAR(100),
	descricao VARCHAR(200),
	url VARCHAR(150),
	usuario_idfk INT, 
	FOREIGN KEY (usuario_idfk) REFERENCES usuario(id)
);

SELECT * FROM contatos;


CREATE TABLE compromissos (
    id SERIAL PRIMARY KEY,
    titulo VARCHAR(100),
    descricao TEXT,
    data DATE,
    hora TIME,
    status VARCHAR(20),
    usuario_idfk INT
);

SELECT * FROM compromissos;