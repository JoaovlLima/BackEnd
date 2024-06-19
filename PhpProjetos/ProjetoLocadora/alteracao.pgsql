Select * from carros;
select * from agencias;
select * from pertence;
select * from alocacao;
select * from envia;
select * from clientes;
Select * from funcionario;
select * from adm;


UPDATE Carros
SET img = modelo || '.jpg'
WHERE img IS NULL;

UPDATE Carros
SET img = 
CASE modelo
    WHEN 'Fiat Uno' THEN 'FiatUno.jpg'
    WHEN 'Toyota Corolla' THEN 'ToyotaCorolla.jpg'
    WHEN 'Chevrolet Onix' THEN 'ChevroletOnix.jpg'
    WHEN 'Ford Ka' THEN 'FordKa.jpg'
    WHEN 'Honda Civic' THEN 'HondaCivic.jpg'
    -- Adicione mais modelos e imagens conforme necessário
    ELSE 'default.jpg' -- Caso o modelo não esteja na lista, usar uma imagem padrão
END
WHERE img IS NULL;

CREATE TABLE adm (
    id SERIAL PRIMARY KEY,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    nome VARCHAR(100),
    email VARCHAR(100)
);

INSERT INTO adm (cpf, senha, nome, email) 
VALUES ('1234', '1234', 'Admin', 'admin@admin.com');

UPDATE carros 
SET disponibilidade = 'indisponível' 
WHERE disponibilidade = 'Não Disponível';

update carros
set disponibilidade = 'indisponivel'
where disponibilidade = 'indisponível';

insert into pertence 
values (1,'WER3490');

