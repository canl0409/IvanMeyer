CREATE TABLE `niveis` (
  `nivelId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`nivelId`),
  KEY `nivelId` (`nivelId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8