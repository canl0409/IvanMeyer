ALTER TABLE `cursos`
	ADD COLUMN `thumb` VARCHAR(128) NULL DEFAULT NULL AFTER `descricao`;
ALTER TABLE `cursos`
	ADD COLUMN `destaque_home` TINYINT(2) NULL DEFAULT '0' AFTER `plano_free`;