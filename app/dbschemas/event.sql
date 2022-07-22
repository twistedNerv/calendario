CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `section` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `start` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `duration` int(11) NOT NULL DEFAULT 1,
  `location` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `title` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  `price` decimal(10,0) DEFAULT 0,
  `comment` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  `pickup_location` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci