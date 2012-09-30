CREATE TABLE `locations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `uuid` char(36) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `is_mappable` tinyint(1) NOT NULL DEFAULT '0',
  `address` varchar(250) DEFAULT NULL,
  `container_count` int(11) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `containers` ADD COLUMN `location_id` int(11) null AFTER `user_id`;
