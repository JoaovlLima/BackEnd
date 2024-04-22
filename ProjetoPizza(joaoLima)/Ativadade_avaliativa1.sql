select * from clientes;
select * from pedido;
select * from pedido_produto;
select * from produtos;
select * from funcionarios;
select * from produto_ingrediente;
select * from ingredientes;
select * from entrega;

CREATE TABLE produto_ingrediente (
    id_produto_ingrediente SERIAL PRIMARY KEY,
    id_produto int,
    id_ingrediente int,
    quantidade int,
    FOREIGN KEY (id_produto) REFERENCES produtos(codigo),
    FOREIGN KEY (id_ingrediente) REFERENCES ingredientes(id_ingrediente)
);

CREATE TABLE entrega (
    id_entrega SERIAL PRIMARY KEY,
    numero_pedido int,
    local_entrega varchar(255),
    detalhes_entrega text,
    data_entrega date,
    FOREIGN KEY (numero_pedido) REFERENCES pedido(numero)
);

CREATE TABLE promocoes (
    id SERIAL PRIMARY KEY,
    codigo_produto INT,
    descricao varchar(255),
    desconto DECIMAL(5, 2),
    FOREIGN KEY (codigo_produto) REFERENCES produtos(codigo)
);

CREATE TABLE horario_funcionamento (
    id SERIAL PRIMARY KEY,
    dia_semana varchar(255),
    horario_abertura time,
    horario_fechamento time
);

INSERT INTO horario_funcionamento (dia_semana, horario_abertura, horario_fechamento)
VALUES 
    ('Segunda-feira', '10:00', '22:00'),
    ('Terça-feira', '10:00', '22:00'),
    ('Quarta-feira', '10:00', '22:00'),
    ('Quinta-feira', '10:00', '22:00'),
    ('Sexta-feira', '10:00', '23:00'),
    ('Sábado', '11:00', '23:00'),
    ('Domingo', '11:00', '22:00');


INSERT INTO promocoes (codigo_produto, descricao, desconto) 
VALUES (1, 'Desconto de 10%', 27.00), (2, 'Desconto de 20%', 5.60);

insert into ingredientes (nome, quantidade_estoque, unidade_medida)
Values ('calabreso', '20', 'kg'), ('Queijo', '15', 'kg')

insert into produto_ingrediente (id_produto, id_ingrediente, quantidade)
values (1,1, 100), (1,2,250);

insert into funcionarios (cargo, nome, salario)
values ('Supervisor', 'Diego', '6000')

insert into pedido_produto(codigo, numero, quantidade)
values(1, 2, 1), (2,2,6);

INSERT INTO entrega (numero_pedido, local_entrega, detalhes_entrega, data_entrega)
VALUES (1, 'Rua XYZ, 123', 'Portaria 2', CURRENT_DATE);


-- Atividade 1
Select pedido.numero, pedido.situacao, pedido.total, clientes.nome
from clientes INNER join pedido on clientes.rg = pedido.rg;

-- Atividade 2 
Select pedido.numero, pedido.situacao, pedido.total, produtos.nome
from pedido inner join pedido_produto on pedido.numero = pedido_produto.numero
inner join produtos on pedido_produto.codigo = produtos.codigo;

-- Atividade 3
select funcionarios.id_funcionario, funcionarios.nome, funcionarios.cargo from funcionarios;

-- Atividade 4
select pedido.numero, pedido.situacao, funcionarios.nome as Responsavel
from pedido inner join funcionarios on funcionarios.id_funcionario = 1;

-- Atividade 5
select clientes.rg, clientes.nome, pedido.numero, pedido.total
from pedido inner join clientes on pedido.rg = clientes.rg;

-- Atividade 6
select produtos.nome, ingredientes.nome
from produtos inner join produto_ingrediente on produto_ingrediente.id_produto = produtos.codigo
inner join ingredientes ON ingredientes.id_ingrediente = produto_ingrediente.id_ingrediente;

-- Atividade 7
select entrega.numero_pedido, entrega.detalhes_entrega 
from entrega;

-- Atividade 8
SELECT f1.nome AS funcionario, f2.nome AS supervisor
FROM funcionarios f1
LEFT JOIN funcionarios f2 ON f1.cargo = 'Atendente' AND f2.cargo = 'Supervisor';

-- Atividade 9
SELECT  p.nome AS item_pedido,'M' AS tamanho_pizza
FROM pedido_produto pp
JOIN produtos p ON p.codigo = pp.codigo;

-- Atividade 10 
SELECT p.nome AS produto, p.descricao AS descricao_produto, p.preco AS preco_normal,
COALESCE(pr.descricao, 'Sem promoção') AS promocao, COALESCE(pr.desconto, 0) AS Preco_desconto
FROM produtos p
LEFT JOIn promocoes pr ON p.codigo = pr.codigo_produto;

                                          -- SEGUNDA PARTE
--  Atividade 1										  
SELECT clientes.rg, clientes.nome from clientes
INNER join pedido on clientes.rg = pedido.rg;

--  Atividade 2
select pedido.numero, pedido.data from pedido
where pedido.data between '20240305' and '20240405' 

-- Atividade 3 
SELECT 
    pp.quantidade, 
    pr.nome AS produto, 
    pr.descricao AS descricao_produto, 
    pr.preco AS preco_unitario
FROM 
    pedido_produto pp
INNER JOIN 
    pedido p ON pp.numero = p.numero
INNER JOIN 
    produtos pr ON pp.codigo = pr.codigo
WHERE 
    p.numero = 1;
	
-- Atividade 4
SELECT c.nome AS cliente, SUM(p.total) AS total_gasto
FROM clientes c
INNER JOIN pedido p ON c.rg = p.rg
where c.rg = 12345
group by c.nome

-- Atividade 5
SELECT 
    p.numero AS numero_pedido,
    COUNT(*) AS total_pedidos,
FROM 
    pedido p
GROUP BY 
    p.numero
ORDER BY 
    COUNT(*) DESC
LIMIT 1;

-- Atividade 6 
SELECT codigo, nome,preco, 
CASE 
     WHEN estoque > 0 THEN 'Disponível'
        ELSE 'Indisponível' 
    END AS disponibilidade
FROM 
    produtos;
	
--Atividade 7
Select * from funcionarios;

-- Atividade 8 
select * from horario_funcionamento;

-- Atividade 9
select pedido.numero, pedido.data
from pedido
where pedido.situacao = 'Pendente';

-- Atividade 10
SELECT AVG(entrega.data_entrega, pedido.data) AS tempo_medio_espera
FROM pedido
INNER JOIN entrega ON pedido.numero = entrega.numero_pedido;











