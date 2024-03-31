CREATE TABLE ingredientes (
id_ingrediente int PRIMARY KEY,
nome varchar(255),
quantidade_estoque int,
unidade_medida varchar(255)
);

CREATE TABLE produtos (
codigo int PRIMARY KEY,
nome varchar(255),
descricao varchar(255),
preco money,
estoque int
);

CREATE TABLE fornecedor (
nome varchar(255),
cnpj varchar(255),
id_fornecedor int PRIMARY KEY
);

CREATE TABLE funcionarios (
cargo varchar(255),
nome varchar(255),
salario money,
id_funcionario int PRIMARY KEY
);

CREATE TABLE clientes (
rg int PRIMARY KEY,
nome varchar(255),
endereco varchar(255),
telefone varchar(255)
);

CREATE TABLE pedido (
numero int PRIMARY KEY,
situacao varchar(255),
data date,
total money,
rg int,
FOREIGN KEY(rg) REFERENCES clientes (rg)
);

CREATE TABLE prod_forn (
id_fornecedor int,
codigo int,
FOREIGN KEY(id_fornecedor) REFERENCES fornecedor (id_fornecedor),
FOREIGN KEY(codigo) REFERENCES produtos (codigo)
);

CREATE TABLE pedido_forn (
situacao varchar(255),
data varchar(255),
descricao varchar(255),
id_fornecedor int,
id_funcionario int,
FOREIGN KEY(id_fornecedor) REFERENCES fornecedor (id_fornecedor),
FOREIGN KEY(id_funcionario) REFERENCES funcionarios (id_funcionario)
);

CREATE TABLE pedido_produto (
codigo int,
numero int,
quantidade int,
FOREIGN KEY(codigo) REFERENCES produtos (codigo),
FOREIGN KEY(numero) REFERENCES pedido (numero)
);






