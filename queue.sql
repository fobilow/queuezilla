CREATE TABLE `queue` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`url` VARCHAR(250) NULL DEFAULT NULL,
	`processed` INT(11) NULL DEFAULT NULL,
	`locked_by` VARCHAR(50) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	INDEX `locked_by` (`locked_by`),
	INDEX `processed` (`processed`)
)
COLLATE='utf8_unicode_ci'
ENGINE=InnoDB
;
