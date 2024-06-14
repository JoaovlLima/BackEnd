CREATE TABLE funcionario (
  nome varchar(255) NOT NULL,
  Re varchar(255) NOT NULL PRIMARY KEY,
  sobrenome varchar(255) NOT NULL,
  salario money NOT NULL,
  data_contratacao date NOT NULL,
  cargo varchar(255) NOT NULL,
  numero_da_agencia int NOT NULL,
  cidade varchar(255) NOT NULL DEFAULT 'São Paulo'
);

CREATE TABLE agencias (
  numero_da_agencia int NOT NULL PRIMARY KEY,
  Endereco varchar(255) NOT NULL,
  contato varchar(255) NOT NULL,
  cidade varchar(255) NOT NULL,
  estado varchar(255) NOT NULL
);

CREATE TABLE Clientes (
  cnh varchar(255) NOT NULL PRIMARY KEY,
  nome varchar(255) NOT NULL,
  telefone varchar(255) NOT NULL,
  sobrenome varchar(255) NOT NULL,
  celular varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  endereco varchar(255) NOT NULL,
  id_pagamento int NOT NULL,
  cidade varchar(255) NOT NULL DEFAULT 'São Paulo'
);

CREATE TABLE Carros (
  ano int NOT NULL,
  placa varchar(255) NOT NULL PRIMARY KEY,
  modelo varchar(255) NOT NULL,
  tipo varchar(255) NOT NULL,
  disponibilidade varchar(255) NOT NULL,
  preco_dia money NOT NULL DEFAULT 100,
  img varchar(255)
);

CREATE TABLE Manutencao (
  id_manutencao int NOT NULL PRIMARY KEY,
  custo money NOT NULL,
  data_inicio date NOT NULL,
  descricao varchar(255) NOT NULL,
  tipo_manutencao varchar(255) NOT NULL,
  km decimal NOT NULL,
  data_fim date
);

CREATE TABLE Pagamento (
  data_pagamento date NOT NULL,
  valor money NOT NULL,
  id_pagamento int NOT NULL,
  forma_pagamento varchar(255) NOT NULL,
  status_pagamento varchar(255) NOT NULL,
  comprovante varchar(255) NOT NULL,
  id_comprovante int NOT NULL,
  PRIMARY KEY(id_pagamento, id_comprovante)
);

CREATE TABLE Feedback (
  id_feedback int NOT NULL PRIMARY KEY,
  data_feedback date NOT NULL,
  comentario varchar(255) NOT NULL,
  avaliacao varchar(255) NOT NULL
);

CREATE TABLE pertence (
  numero_da_agencia int NOT NULL,
  placa varchar(255) NOT NULL,
  FOREIGN KEY(numero_da_agencia) REFERENCES agencias(numero_da_agencia),
  FOREIGN KEY(placa) REFERENCES Carros(placa)
);

CREATE TABLE alocacao (
  data_alocacao date NOT NULL,
  data_entrega date NOT NULL,
  valor_total money NOT NULL,
  id_locacao int NOT NULL,
  cnh varchar(255) NOT NULL,
  placa varchar(255) NOT NULL,
  Re varchar(255) NOT NULL,
  PRIMARY KEY(id_locacao, cnh, placa, Re)
);

CREATE TABLE Entrega (
  Integridade varchar(255) NOT NULL,
  km_rodado numeric NOT NULL,
  dias_acrecentados date NOT NULL,
  cnh varchar(255) NOT NULL PRIMARY KEY,
  placa varchar(255) NOT NULL,
  FOREIGN KEY(placa) REFERENCES Carros(placa),
  FOREIGN KEY(cnh) REFERENCES Clientes(cnh)
);

CREATE TABLE Recebe (
  id_manutencao int NOT NULL,
  placa varchar(255) NOT NULL,
  FOREIGN KEY(id_manutencao) REFERENCES Manutencao(id_manutencao),
  FOREIGN KEY(placa) REFERENCES Carros(placa)
);

CREATE TABLE Envia (
  id_envia int NOT NULL PRIMARY KEY,
  observacao varchar(255) NOT NULL,
  cnh varchar(255) NOT NULL,
  id_feedback int NOT NULL,
  FOREIGN KEY(cnh) REFERENCES Clientes(cnh),
  FOREIGN KEY(id_feedback) REFERENCES Feedback(id_feedback)
);

ALTER TABLE funcionario
ADD FOREIGN KEY(numero_da_agencia) REFERENCES agencias(numero_da_agencia);

-- Índices
CREATE INDEX idx_re_funcionario ON funcionario(Re);
CREATE INDEX idx_numero_da_agencia_agencias ON agencias(numero_da_agencia);
CREATE INDEX idx_cnh_clientes ON Clientes(cnh);
CREATE INDEX idx_placa_carros ON Carros(placa);
CREATE INDEX idx_id_manutencao_manutencao ON Manutencao(id_manutencao);
CREATE INDEX idx_id_pagamento_pagamento ON Pagamento(id_pagamento);
CREATE INDEX idx_id_feedback_feedback ON Feedback(id_feedback);
CREATE INDEX idx_id_locacao_alocacao ON alocacao(id_locacao);
CREATE INDEX idx_cnh_entrega ON Entrega(cnh);
CREATE INDEX idx_id_manutencao_recebe ON Recebe(id_manutencao);
CREATE INDEX idx_id_envia_envia ON Envia(id_envia);

-- Dados de exemplo
INSERT INTO carros (ano, placa, modelo, tipo, disponibilidade, preco_dia, img) VALUES
(2021, 'ABC1235', 'Fiat Uno', 'Hatch', 'Disponível', 100, 'Uno.jpg'),
(2022, 'DEF5676', 'Toyota Corolla', 'Sedan', 'Não Disponível', 150, 'Corolla.jpg'),
(2020, 'GHI9017', 'Chevrolet Onix', 'Hatch', 'Disponível', 110, 'Onix.jpg'),
(2019, 'JKL3450', 'Ford Ka', 'Hatch', 'Disponível', 120, 'Ka.jpg'),
(2023, 'MNO7892', 'Honda Civic', 'Sedan', 'Não Disponível', 130, 'Civic.jpg');

INSERT INTO alocacao (data_alocacao, data_entrega, valor_total, id_locacao, cnh, placa, Re) VALUES
('2024-05-23','2024-06-01',1000,21,'012345','BCD3456','67890');
