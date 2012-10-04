#App sql generated on: 2011-05-14 09:33:09 : 1305379989

DROP TABLE IF EXISTS `container_items`;
DROP TABLE IF EXISTS `containers`;
DROP TABLE IF EXISTS `tags`;
DROP TABLE IF EXISTS `users`;


CREATE TABLE `container_items` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`container_id` int(11) DEFAULT 0 NOT NULL,
	`tag_id` int(11) DEFAULT 0,
	`uuid` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`body` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY `container` (`container_id`),
	KEY `category` (`tag_id`),
	KEY `fk_container_items_containers1` (`container_id`),
	KEY `uuid` (`uuid`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=InnoDB;

CREATE TABLE `containers` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`tag_id` int(11) DEFAULT 0,
	`user_id` int(11) DEFAULT 0 NOT NULL,
	`uuid` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`name` varchar(36) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`slug` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`container_item_count` int(10) DEFAULT 0,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY `category` (`tag_id`),
	KEY `user` (`user_id`),
	KEY `fk_containers_users` (`user_id`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=InnoDB;

CREATE TABLE `tags` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`slug` varchar(30) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY `slug` (`slug`))	DEFAULT CHARSET=latin1,
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


