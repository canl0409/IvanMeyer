CREATE TABLE `quem_somos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `seguidores` int(11) DEFAULT NULL,
  `professores` int(11) DEFAULT NULL,
  `estudantes` int(11) DEFAULT NULL,
  `cursos` int(11) DEFAULT NULL,
  `frase` text,
  `texto_1` text,
  `texto_2` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8