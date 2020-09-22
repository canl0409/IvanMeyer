CREATE TABLE `aulas_vistas` (
  `avId` int(11) NOT NULL AUTO_INCREMENT,
  `cursoId` int(11) NOT NULL DEFAULT '0',
  `alunoId` int(11) NOT NULL DEFAULT '0',
  `aulaId` int(11) NOT NULL DEFAULT '0',
  `data` date DEFAULT NULL,
  PRIMARY KEY (`avId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8