CREATE TABLE `cursos` (
  `cursoId` int(11) NOT NULL AUTO_INCREMENT,
  `instrutorId` int(11) DEFAULT '0',
  `categoriaId` int(11) DEFAULT '0',
  `nome` varchar(64) DEFAULT '0',
  `titulo` varchar(128) DEFAULT '0',
  `nivel` varchar(16) DEFAULT '0',
  `certificado` varchar(4) DEFAULT '0',
  `duracao` varchar(16) DEFAULT '0',
  `descricao` text,
  `imagem` varchar(128) DEFAULT NULL,
  `banner` varchar(128) DEFAULT NULL,
  `video` varchar(128) DEFAULT NULL,
  `valor` decimal(10,2) DEFAULT '0.00',
  `plano_free` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`cursoId`),
  KEY `cursoId` (`cursoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8