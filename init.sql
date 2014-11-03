CREATE TABLE IF NOT EXISTS `story` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `body` longtext,
  `image` text,
  `thumbnail` text,
  `url` text,
  `date` int(8) DEFAULT NULL,
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_id_UNIQUE` (`order_id`),
  KEY `date` (`date`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;
