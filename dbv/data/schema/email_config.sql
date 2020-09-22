CREATE TABLE `email_config` (
  `emailcId` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(32) DEFAULT NULL,
  `config` text,
  `assunto` text,
  `descricao` text,
  PRIMARY KEY (`emailcId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8