CREATE TABLE `duvidas` (
  `duvidaId` int(11) NOT NULL AUTO_INCREMENT,
  `duvida` text,
  `resposta` text,
  PRIMARY KEY (`duvidaId`),
  KEY `duvidaId` (`duvidaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8