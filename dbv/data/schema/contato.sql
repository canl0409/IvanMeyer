CREATE TABLE `contato` (
  `contatoId` int(11) NOT NULL AUTO_INCREMENT,
  `telefone1` varchar(50) DEFAULT NULL,
  `telefone2` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `endereco` text,
  `texto_rodape` text,
  `copyright` text,
  `titulo` text,
  PRIMARY KEY (`contatoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8