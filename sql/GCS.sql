-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 07 月 31 日 00:01
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
  `cID` smallint(6) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `pID` smallint(6) unsigned zerofill NOT NULL,
  `uID` tinyint(4) unsigned zerofill NOT NULL,
  `family` varchar(100) DEFAULT NULL,
  `create_time` datetime NOT NULL,
  `updated_time` datetime DEFAULT NULL,
  `next_time` datetime DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  `memo` tinytext,
  PRIMARY KEY (`cID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `Notes`
--

CREATE TABLE IF NOT EXISTS `Notes` (
  `nID` smallint(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `cID` smallint(6) unsigned zerofill NOT NULL,
  `uID` tinyint(4) unsigned zerofill NOT NULL,
  `time` datetime NOT NULL,
  `mode` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0',
  `content` tinytext,
  PRIMARY KEY (`nID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `People`
--

INSERT INTO `People` (`pID`, `uID`, `parentID`, `name`, `gender`, `birthday`, `income`, `company`, `position`, `address`, `mobile`, `workphone`, `email`, `from`) VALUES
(000001, 0001, 000000, '赵国维', 1, NULL, '', '', '', '', '', '', 'sparezgw@qq.com', NULL),
(000002, 0001, 000001, '程谟思', 0, '1985-03-08', NULL, '城市快报', NULL, NULL, '18622212345', NULL, 'chengmosi@foxmail.com', NULL),
(000003, 0001, 000000, '张三', 1, '1988-08-08', '25万', '中宏保险天津分公司', '高级营业经理', '天津市和平区河北路君隆广场B2座10层', '13802254321', '022-68579990-8681', 'zhaoguowei@foxmail.com', 3),
(000004, 0001, 000000, '李四', 0, '1992-09-12', 'high', '', '', '', '18900022222', '', 'abc@abc.com', 0),
(000005, 0001, 000000, '王五', 0, '2000-10-10', '', '', '', '', '', '', '', 1),
(000006, 0001, 000000, '王自健', 1, NULL, '50万', '东方卫视', '主持人', '上海市浦东新区', '13902066666', '', 'wangzijian@126.com', 3),

-- --------------------------------------------------------

--
-- 表的结构 `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `uID` tinyint(4) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `uname` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  `pID` mediumint(6) unsigned zerofill NOT NULL,
  PRIMARY KEY (`uID`),
  UNIQUE KEY `uID` (`uID`),
  UNIQUE KEY `uID_2` (`uID`),
  UNIQUE KEY `uname` (`uname`),
  UNIQUE KEY `pID` (`pID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `Users`
--

INSERT INTO `Users` (`uID`, `uname`, `passwd`, `pID`) VALUES
(0001, 'abc', 'abc', 000001),

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
