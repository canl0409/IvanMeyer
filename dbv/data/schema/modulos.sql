CREATE TABLE `modulos` (
  `moduloId` int(11) NOT NULL AUTO_INCREMENT,
  `cursoId` int(11) DEFAULT NULL,
  `nome` varchar(32) NOT NULL DEFAULT '0',
  `orden` int(11) DEFAULT '0',
  PRIMARY KEY (`moduloId`),
  KEY `moduloId` (`moduloId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8