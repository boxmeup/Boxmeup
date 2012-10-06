#feedback sql generated on: 2011-05-14 09:35:58 : 1305380158

DROP TABLE IF EXISTS `feedback`;


CREATE TABLE `feedback` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`user_id` int(11) DEFAULT 0 NOT NULL,
	`user_agent` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`location_uri` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`feedback_type` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT 'bug' COMMENT 'Type of feedback: bug or feature',
	`message` text CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`ip_address` varchar(40) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
	`created` datetime DEFAULT NULL,
	`modified` datetime DEFAULT NULL,	PRIMARY KEY  (`id`),
	KEY `User` (`user_id`),
	KEY `time` (`created`))	DEFAULT CHARSET=latin1,
	COLLATE=latin1_swedish_ci,
	ENGINE=InnoDB;

