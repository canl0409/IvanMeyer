CREATE TABLE `categorias` (
  `categoriaId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(32) NOT NULL DEFAULT '0',
  `icone` varchar(128) NOT NULL DEFAULT '0',
  `imagem` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`categoriaId`),
  KEY `categoriaId` (`categoriaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8