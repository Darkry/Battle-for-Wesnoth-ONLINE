-- Adminer 3.2.0 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = 'SYSTEM';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ground`;
CREATE TABLE `ground` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `datName` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `ground` (`id`, `name`, `datName`) VALUES
(1,	'Louka',	'grass1'),
(2,	'Louka',	'grass2'),
(3,	'Louka',	'grass3');

DROP TABLE IF EXISTS `map`;
CREATE TABLE `map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


DROP TABLE IF EXISTS `mapgrounds`;
CREATE TABLE `mapgrounds` (
  `map_id` int(11) NOT NULL,
  `ground_id` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


-- 2011-07-21 15:23:18
