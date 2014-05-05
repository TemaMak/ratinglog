CREATE TABLE IF NOT EXISTS `social_32_rating_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `add_date` datetime NOT NULL,
  `rating_delta_value` double NOT NULL,
  `comment` varchar(1023) NOT NULL,
  `action_id` enum('comment','topic','blog','user','image','event') NOT NULL,
  `skill_delta_value` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=INNODB  DEFAULT CHARSET=utf8;