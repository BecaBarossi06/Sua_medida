CREATE DATABASE hostdeprojetos_suamedida;

use hostdeprojetos_suamedida;

create table usuarios (
 id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

select * from usuarios;


SHOW COLUMNS FROM usuarios;



 CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    tipo VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    imagem VARCHAR(255) DEFAULT NULL,
    descricao TEXT DEFAULT NULL
);

select * from produtos;


select * from usuarios;

alter table usuarios add perfil varchar(50) default(0);
update usuarios set perfil = 'admin' where email = 'abc@ifsp.edu.br';