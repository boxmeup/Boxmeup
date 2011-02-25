#App sql generated on: 2011-02-24 22:51:33 : 1298605893

DROP TABLE IF EXISTS `configurations`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE `configurations` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`value` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `name` (`name`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=InnoDB;

CREATE TABLE `users` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`email` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`password` varchar(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`uuid` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
	`is_active` tinyint(1) DEFAULT 1 NOT NULL,
	`is_admin` tinyint(1) DEFAULT 0 NOT NULL,
	`created` datetime NOT NULL,
	`modified` datetime NOT NULL,	PRIMARY KEY  (`id`),
	UNIQUE KEY `email` (`email`),
	KEY `uuid` (`uuid`),
	KEY `is_active` (`is_active`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=InnoDB;

