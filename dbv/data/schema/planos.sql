CREATE TABLE `planos` (
  `planoId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  `titulo` varchar(50) NOT NULL DEFAULT '0',
  `dias` varchar(50) NOT NULL DEFAULT '0',
  `label_dias` varchar(128) NOT NULL DEFAULT '0',
  `valor` decimal(10,2) NOT NULL DEFAULT '0.00',
  `caracteristicas` text,
  `caracteristica2` text,
  `caracteristica3` text,
  PRIMARY KEY (`planoId`),
  KEY `planoId` (`planoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8