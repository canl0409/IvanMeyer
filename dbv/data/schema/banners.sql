CREATE TABLE `banners` (
  `bannerId` int(11) NOT NULL AUTO_INCREMENT,
  `imagem` text,
  `video` text,
  PRIMARY KEY (`bannerId`),
  KEY `bannerId` (`bannerId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8