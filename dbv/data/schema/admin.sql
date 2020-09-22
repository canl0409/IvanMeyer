CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(64) COLLATE utf8_swedish_ci NOT NULL,
  `email` varchar(64) COLLATE utf8_swedish_ci NOT NULL,
  `senha` varchar(64) COLLATE utf8_swedish_ci NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci