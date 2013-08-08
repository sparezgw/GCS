-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 08 月 07 日 23:51
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

CREATE TABLE IF NOT EXISTS `Cards` (
  `pID` smallint(6) unsigned zerofill NOT NULL,
  `uID` tinyint(4) unsigned zerofill NOT NULL,
  `family` varchar(100) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime DEFAULT NULL,
  `next_time` datetime DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `memo` tinytext,
  PRIMARY KEY (`pID`),
  UNIQUE KEY `pID` (`pID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Notes`
--

CREATE TABLE IF NOT EXISTS `Notes` (
  `nID` smallint(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `pID` smallint(6) unsigned zerofill NOT NULL,
  `uID` tinyint(4) unsigned zerofill NOT NULL,
  `time` datetime NOT NULL,
  `mode` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0',
  `content` tinytext,
  PRIMARY KEY (`nID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `People`
--

CREATE TABLE IF NOT EXISTS `People` (
  `pID` smallint(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uID` tinyint(4) unsigned zerofill NOT NULL,
  `parentID` smallint(6) unsigned zerofill NOT NULL DEFAULT '000000',
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
  PRIMARY KEY (`pID`),
  UNIQUE KEY `pID` (`pID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `uID` tinyint(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL,
  `passwd` varchar(15) NOT NULL,
  `pID` mediumint(6) unsigned zerofill NOT NULL,
  PRIMARY KEY (`uID`),
  UNIQUE KEY `uID` (`uID`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `pID` (`pID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
