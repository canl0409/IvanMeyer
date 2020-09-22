CREATE TABLE `cupons` (
  `cuponId` int(11) NOT NULL AUTO_INCREMENT,
  `alunoId` int(11) DEFAULT NULL,
  `codigo` varchar(32) NOT NULL,
  `desconto` varchar(32) NOT NULL,
  `data` datetime NOT NULL,
  `validade` date NOT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`cuponId`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8