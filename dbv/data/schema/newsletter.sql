CREATE TABLE `newsletter` (
  `newsletterId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) DEFAULT NULL,
  `email` varchar(64) DEFAULT NULL,
  `telefone` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`newsletterId`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8