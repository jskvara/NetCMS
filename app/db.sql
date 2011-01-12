
CREATE TABLE `news` (
	`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) COLLATE utf8_czech_ci NOT NULL DEFAULT '',
	`text` TEXT COLLATE utf8_czech_ci NOT NULL DEFAULT '',
	`created` datetime NOT NULL,
	`visible` tinyint(1) NOT NULL DEFAULT '1',
	PRIMARY KEY (`id`)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE utf8_czech_ci;

CREATE TABLE `page` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL DEFAULT '',
	`url` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL DEFAULT '',
	`title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL DEFAULT '',
	`content` TEXT CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL DEFAULT '',
	`visible` TINYINT(1) NOT NULL DEFAULT  '1',
	`position` INT UNSIGNED NOT NULL,
	`template` VARCHAR(30) NOT NULL DEFAULT '',
	`parentUrl` VARCHAR(255) NOT NULL DEFAULT  '',
	PRIMARY KEY (`id`),
	UNIQUE (`name`, `url`),
	KEY (`url`)
) ENGINE = INNODB DEFAULT CHARSET=utf8 COLLATE utf8_czech_ci;

INSERT INTO `page` (`id`, `name`, `url`, `title`, `content`, `visible`, `position`, `template`) 
VALUES (1, '', '', 'Home page', '<h1>Home page</h1><p>Text text text</p>', 1, 1, 'default');
