ALTER TABLE `instrutores`
	ADD COLUMN `tipo` VARCHAR(16) NOT NULL DEFAULT '0' AFTER `instrutorId`;