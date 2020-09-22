CREATE TABLE `alunos` (
  `alunoId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT '0',
  `sobrenome` varchar(50) DEFAULT '0',
  `cpf` varchar(16) DEFAULT '0',
  `email` varchar(64) DEFAULT '0',
  `senha` varchar(32) DEFAULT '0',
  `endereco` varchar(128) DEFAULT '0',
  `cidade` varchar(50) DEFAULT '0',
  `uf` varchar(4) DEFAULT '0',
  `celular` varchar(50) DEFAULT '0',
  `bairro` varchar(50) DEFAULT '0',
  `cep` varchar(16) DEFAULT '0',
  `email_confirmed` tinyint(2) DEFAULT '0',
  `data_cadastro` date DEFAULT NULL,
  `vencimento` date DEFAULT NULL,
  PRIMARY KEY (`alunoId`),
  KEY `alunoId` (`alunoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8