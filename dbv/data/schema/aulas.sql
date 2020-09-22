CREATE TABLE `aulas` (
  `aulaId` int(11) NOT NULL AUTO_INCREMENT,
  `cursoId` int(11) NOT NULL DEFAULT '0',
  `moduloId` int(11) DEFAULT NULL,
  `titulo` varchar(128) NOT NULL DEFAULT '0',
  `video` text,
  `texto` text,
  `audio` text,
  `files` text,
  `duracao` varchar(32) DEFAULT NULL,
  `orden` int(11) DEFAULT '0',
  `free` tinyint(2) DEFAULT '0',
  PRIMARY KEY (`aulaId`),
  KEY `aulaId` (`aulaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8