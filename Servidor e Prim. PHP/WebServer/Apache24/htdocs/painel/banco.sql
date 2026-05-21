CREATE TABLE usuarios
(
	id_usuarios serial primary key,
	email varchar (150) unique,
	senha varchar (100),
	ativo boolean
);

INSERT INTO usuarios (email,senha,ativo) VALUES ('ana@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'TRUE');

SELECT * FROM usuarios;