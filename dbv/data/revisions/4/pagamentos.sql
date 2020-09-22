ALTER TABLE `pagamentos`
	ADD COLUMN `cuponId` INT(11) NULL DEFAULT '0.00' AFTER `valor`;
ALTER TABLE `pagamentos`
	ADD COLUMN `desconto` DECIMAL(10,2) NULL DEFAULT '0.00' AFTER `valor`;