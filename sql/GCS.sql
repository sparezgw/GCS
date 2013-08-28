-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 08 月 28 日 16:12
-- 服务器版本: 5.5.28
-- PHP 版本: 5.3.15

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `GCS`
--

-- --------------------------------------------------------

--
-- 表的结构 `Cards`
--

DROP TABLE IF EXISTS `Cards`;
CREATE TABLE IF NOT EXISTS `Cards` (
  `pID` mediumint(6) unsigned zerofill NOT NULL,
  `uID` smallint(4) unsigned zerofill NOT NULL,
  `family` varchar(100) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL,
  `next_time` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `memo` tinytext,
  PRIMARY KEY (`pID`),
  UNIQUE KEY `pID` (`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Notes`
--

DROP TABLE IF EXISTS `Notes`;
CREATE TABLE IF NOT EXISTS `Notes` (
  `nID` int(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `pID` mediumint(6) unsigned zerofill NOT NULL,
  `uID` smallint(4) unsigned zerofill NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mode` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0',
  `content` tinytext,
  PRIMARY KEY (`nID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `People`
--

DROP TABLE IF EXISTS `People`;
CREATE TABLE IF NOT EXISTS `People` (
  `pID` mediumint(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uID` smallint(4) unsigned zerofill NOT NULL,
  `parentID` mediumint(6) unsigned zerofill NOT NULL DEFAULT '000000',
  `name` varchar(20) NOT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `income` varchar(20) DEFAULT NULL,
  `company` varchar(50) DEFAULT NULL,
  `position` varchar(30) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `workphone` varchar(25) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `from` tinyint(1) unsigned DEFAULT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pID`),
  UNIQUE KEY `pID` (`pID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Teams`
--

DROP TABLE IF EXISTS `Teams`;
CREATE TABLE IF NOT EXISTS `Teams` (
  `tID` tinyint(3) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `members` varchar(500) NOT NULL DEFAULT '[]',
  PRIMARY KEY (`tID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Users`
--

DROP TABLE IF EXISTS `Users`;
CREATE TABLE IF NOT EXISTS `Users` (
  `uID` smallint(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uname` varchar(80) NOT NULL,
  `passwd` varchar(15) NOT NULL,
  `pID` mediumint(6) unsigned zerofill NOT NULL,
  `tID` tinyint(3) unsigned zerofill NOT NULL DEFAULT '000',
  PRIMARY KEY (`uID`),
  UNIQUE KEY `uID` (`uID`),
  UNIQUE KEY `uID_2` (`uID`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `pID` (`pID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
