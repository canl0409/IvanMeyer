CREATE TABLE `opinioes` (
  `opiniaoId` int(11) NOT NULL AUTO_INCREMENT,
  `cursoId` int(11) DEFAULT NULL,
  `alunoId` int(11) DEFAULT NULL,
  `titulo` text,
  `opiniao` text,
  `nota` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`opiniaoId`),
  KEY `opiniaoId` (`opiniaoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8