INSERT into pre_cad_adm 
VALUEs ('123', 'testAdm');
SELECT * from pre_cad_adm;

INSERT into materias 
VALUES (1,'testdescricao','testduracao','testMateria');
select * from materias;

SELECT * from lancamento;
SELECT * from aluno;

DELETE FROM Lancamento
WHERE id_lancamento IN (52, 102, 103, 104);

ALTER TABLE Lancamento
DROP COLUMN rg,
DROP COLUMN id,
DROP COLUMN nome_aluno_rg,
DROP COLUMN a,
DROP COLUMN aluno;