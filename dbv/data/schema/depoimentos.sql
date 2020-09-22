CREATE TABLE `depoimentos` (
  `depoimentoId` int(11) NOT NULL AUTO_INCREMENT,
  `alunoId` int(11) DEFAULT NULL,
  `cursoId` int(11) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `depoimento` text,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`depoimentoId`),
  KEY `depoimentoId` (`depoimentoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8