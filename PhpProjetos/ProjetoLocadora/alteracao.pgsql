Select * from carros;
select * from agencias;
select * from pertence;
select * from alocacao;
select * from envia;
select * from clientes;

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