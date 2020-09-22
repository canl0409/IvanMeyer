CREATE TABLE `instrutores` (
  `instrutorId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(64) NOT NULL DEFAULT '0',
  `senha` varchar(32) NOT NULL DEFAULT '0',
  `foto` varchar(256) NOT NULL DEFAULT '0',
  `descricao` text,
  PRIMARY KEY (`instrutorId`),
  KEY `instrutorId` (`instrutorId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8