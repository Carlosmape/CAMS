<?php
function CreateDatabase($connection){
	$result = mysqli_query($connection, "CREATE DATABASE IF NOT EXISTS `".$_POST['Databasename']."`;");
	$result = $connection->select_db($_POST['Databasename']);
	return $result;
}

function CreateTablesStructures($connection){
	try{
		$creationResult = true;
		$creationResult &= CreateTables($connection);
		echo "Tables created.";
	} catch (Exception $e){
		echo'"Error CAMS: Could not create necesary tables"' + $e->getMessage();
		$creationResult = false;
	}
	return $creationResult;
}

function CreateTables($connection){
	try {
		return mysqli_query($connection,"

-- Adminer 4.8.1 MySQL 5.5.5-10.3.29-MariaDB-0+deb10u1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `ARTICLES`;
CREATE TABLE `ARTICLES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(96) DEFAULT NULL,
  `IMAGEHEADER` text DEFAULT NULL,
  `CATEGORY` int(11) DEFAULT NULL,
  `CONTENT` text DEFAULT NULL,
  `PINNED` bit(1) DEFAULT NULL,
  `AUTOR` int(11) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TITLE` (`TITLE`),
  KEY `AUTOR` (`AUTOR`),
  CONSTRAINT `ARTICLES_ibfk_2` FOREIGN KEY (`AUTOR`) REFERENCES `USERS` (`ID`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ARTICLES` (`ID`, `TITLE`, `IMAGEHEADER`, `CATEGORY`, `CONTENT`, `PINNED`, `AUTOR`, `DATE`) VALUES
(1,	'Lorem ipsum dolor',	'http://www.highreshdwallpapers.com/wp-content/uploads/2012/10/Lorem-Ipsum-Wallpaper.jpg',	1,	'<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. y tal</p>',	NULL,	NULL,	'2021-09-19');

DROP TABLE IF EXISTS `CATEGORIES`;
CREATE TABLE `CATEGORIES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `PARENTID` int(11) DEFAULT NULL,
  `TITLE` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TITLE` (`TITLE`),
  KEY `PARENTID` (`PARENTID`),
  CONSTRAINT `CATEGORIES_ibfk_1` FOREIGN KEY (`PARENTID`) REFERENCES `CATEGORIES` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `CATEGORIES` (`ID`, `PARENTID`, `TITLE`) VALUES
(1,	NULL,	'A cat'),
(2,	1,	'A child category'),
(10,	NULL,	'Another parent category');

DROP TABLE IF EXISTS `LOG`;
CREATE TABLE `LOG` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `LEVEL` int(11) NOT NULL,
  `MESSAGE` text NOT NULL,
  `FILE` varchar(255) DEFAULT NULL,
  `LINE` int(11) DEFAULT NULL,
  `PROCCESS` varchar(255) NOT NULL,
  `SESSION_VALUE` text DEFAULT NULL,
  `DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `LOG` (`ID`, `LEVEL`, `MESSAGE`, `FILE`, `LINE`, `PROCCESS`, `SESSION_VALUE`, `DATE`) VALUES
(6,	3,	'',	'/var/www/html/cams/modules/record.php',	13,	'',	'a:1:{s:10:\"connection\";O:10:\"Connection\":4:{s:4:\"time\";i:1632388205;s:4:\"user\";s:5:\"admin\";s:4:\"type\";s:1:\"0\";s:6:\"userid\";s:1:\"1\";}}',	'2021-09-23 10:10:05'),
(7,	3,	'',	'/var/www/html/cams/modules/record.php',	13,	'',	'a:1:{s:10:\"connection\";O:10:\"Connection\":4:{s:4:\"time\";i:1632388558;s:4:\"user\";s:5:\"admin\";s:4:\"type\";s:1:\"0\";s:6:\"userid\";s:1:\"1\";}}',	'2021-09-23 10:15:58'),
(8,	3,	'',	'/var/www/html/cams/index.php',	8,	'#0 {main}',	'a:1:{s:10:\"connection\";O:10:\"Connection\":4:{s:4:\"time\";i:1632470015;s:4:\"user\";s:5:\"admin\";s:4:\"type\";s:1:\"0\";s:6:\"userid\";s:1:\"1\";}}',	'2021-09-24 09:01:15'),
(9,	3,	'',	'/var/www/html/cams/index.php',	8,	'#0 {main}',	'a:1:{s:10:\"connection\";O:10:\"Connection\":4:{s:4:\"time\";i:1632470015;s:4:\"user\";s:5:\"admin\";s:4:\"type\";s:1:\"0\";s:6:\"userid\";s:1:\"1\";}}',	'2021-09-24 09:01:33');

DROP TABLE IF EXISTS `PAGES`;
CREATE TABLE `PAGES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `TITLE` varchar(96) DEFAULT NULL,
  `IMAGEHEADER` text DEFAULT NULL,
  `TYPE` int(11) DEFAULT NULL,
  `CATEGORY` int(11) DEFAULT NULL,
  `CONTENT` text DEFAULT NULL,
  `PINNED` bit(1) DEFAULT NULL,
  `AUTOR` int(11) DEFAULT NULL,
  `DATE` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `TITLE` (`TITLE`),
  KEY `AUTOR` (`AUTOR`),
  CONSTRAINT `PAGES_ibfk_1` FOREIGN KEY (`AUTOR`) REFERENCES `USERS` (`ID`) ON DELETE SET NULL,
  CONSTRAINT `CONSTRAINT_1` CHECK (`TYPE` between 0 and 2)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `PAGES` (`ID`, `TITLE`, `IMAGEHEADER`, `TYPE`, `CATEGORY`, `CONTENT`, `PINNED`, `AUTOR`, `DATE`) VALUES
(1,	'asdasd',	'',	0,	NULL,	'<p>asdasdasdlsfdmksldmflasmdflsfdm-alsdvmlvfmldflkvmsldcms</p>',	NULL,	1,	'2021-09-22'),
(2,	'A page y tal',	'',	0,	1,	'<p>A content</p>',	NULL,	1,	'2021-09-22');

DROP TABLE IF EXISTS `RECORD`;
CREATE TABLE `RECORD` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ACTION` varchar(45) DEFAULT NULL,
  `AUTOR` int(11) NOT NULL,
  `RECIBER` int(11) NOT NULL,
  `RECIBERCONTEXT` varchar(45) NOT NULL,
  `DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `AUTOR` (`AUTOR`),
  CONSTRAINT `RECORD_ibfk_1` FOREIGN KEY (`AUTOR`) REFERENCES `USERS` (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `RECORD` (`ID`, `ACTION`, `AUTOR`, `RECIBER`, `RECIBERCONTEXT`, `DATE`) VALUES
(1,	'SAVE',	1,	0,	'SETTINGS',	'2021-09-20 07:56:59'),
(2,	'EDIT',	1,	2,	'ARTICLES',	'2021-09-22 16:32:28'),
(3,	'EDIT',	1,	1,	'ARTICLES',	'2021-09-24 15:10:35'),
(4,	'EDIT',	1,	1,	'ARTICLES',	'2021-09-24 15:10:40'),
(5,	'EDIT',	1,	7,	'ARTICLES',	'2021-09-24 15:11:09');

DROP TABLE IF EXISTS `ROLES`;
CREATE TABLE `ROLES` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(96) NOT NULL,
  `DESCRIPTION` varchar(96) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ROLES` (`ID`, `NAME`, `DESCRIPTION`) VALUES
(0,	'Admin',	'Website administrator'),
(1,	'Contributor',	'Website contributor (allowed to upload content)'),
(24,	'sample',	'Nothing to do'),
(25,	'sample',	'Nothing to do');

DROP TABLE IF EXISTS `ROLES_PERMISSIONS`;
CREATE TABLE `ROLES_PERMISSIONS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ROLE` int(11) NOT NULL,
  `ID_PERMISSION` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_PERMISSION` (`ID_PERMISSION`),
  KEY `ID_ROLE` (`ID_ROLE`),
  CONSTRAINT `ROLES_PERMISSIONS_ibfk_2` FOREIGN KEY (`ID_PERMISSION`) REFERENCES `SECTIONS` (`ID`),
  CONSTRAINT `ROLES_PERMISSIONS_ibfk_6` FOREIGN KEY (`ID_ROLE`) REFERENCES `ROLES` (`ID`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `ROLES_PERMISSIONS` (`ID`, `ID_ROLE`, `ID_PERMISSION`) VALUES
(1,	0,	0),
(5,	1,	1),
(10,	24,	1);

DROP TABLE IF EXISTS `SECTIONS`;
CREATE TABLE `SECTIONS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ENTITY` varchar(96) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `SECTIONS` (`ID`, `ENTITY`) VALUES
(0,	'ALL'),
(1,	'ARTICLES'),
(2,	'CATEGORIES'),
(3,	'USERS');

DROP TABLE IF EXISTS `USERS`;
CREATE TABLE `USERS` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER` varchar(32) NOT NULL,
  `MAIL` varchar(32) NOT NULL,
  `PASSWORD` varchar(64) NOT NULL,
  `TYPE` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER` (`USER`,`MAIL`),
  KEY `TYPE` (`TYPE`),
  CONSTRAINT `USERS_ibfk_2` FOREIGN KEY (`TYPE`) REFERENCES `ROLES` (`ID`) ON DELETE SET NULL,
  CONSTRAINT `CONSTRAINT_1` CHECK (`TYPE` between 0 and 1)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `USERS` (`ID`, `USER`, `MAIL`, `PASSWORD`, `TYPE`) VALUES
(1,	'Admin',	'admin@mail.com',	'e3afed0047b08059d0fada10f400c1e5',	0),
(26,	'sample',	'sample@sample.com',	'5e8ff9bf55ba3508199d22e984129be6',	1);

-- 2021-09-24 16:27:08"); 
	} catch (Exception $e){
		throw $e;
	}
}

?>
