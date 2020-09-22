CREATE TABLE `assinaturas` (
  `assinaturaId` int(11) NOT NULL AUTO_INCREMENT,
  `planoId` int(11) DEFAULT '0',
  `alunoId` int(11) DEFAULT '0',
  `vencimento` datetime DEFAULT NULL,
  `renovacoes` mediumint(5) DEFAULT '0',
  PRIMARY KEY (`assinaturaId`),
  KEY `assinaturaId` (`assinaturaId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8