CREATE TABLE `cursos_matriculas` (
  `cmId` int(11) NOT NULL AUTO_INCREMENT,
  `cursoId` int(11) DEFAULT NULL,
  `alunoId` int(11) DEFAULT NULL,
  `data` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expira` date DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`cmId`),
  KEY `cmId` (`cmId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8