CREATE TABLE `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `name` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `surname` varchar(45) COLLATE utf8_slovenian_ci NOT NULL,
  `gender` int(11) DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `city` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `country` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `phone` varchar(45) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_slovenian_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci