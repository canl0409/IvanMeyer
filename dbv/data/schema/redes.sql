CREATE TABLE `redes` (
  `redeId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(32) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `icon` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`redeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8