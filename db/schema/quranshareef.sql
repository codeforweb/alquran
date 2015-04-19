-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 19, 2015 at 06:58 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `quranshareef`
--

-- --------------------------------------------------------

--
-- Table structure for table `lang`
--

CREATE TABLE IF NOT EXISTS `lang` (
  `ID` int(11) NOT NULL auto_increment,
  `DatabaseID` int(11) NOT NULL,
  `Language` varchar(32) NOT NULL,
  `Orientation` varchar(32) NOT NULL default 'LTR',
  `Name` varchar(100) character set utf8 collate utf8_unicode_ci default NULL,
  `Translator` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  KEY `ID` (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `quran`
--

CREATE TABLE IF NOT EXISTS `quran` (
  `ID` int(11) NOT NULL auto_increment,
  `DatabaseID` smallint(6) NOT NULL,
  `SuraID` int(11) NOT NULL,
  `VerseID` int(11) NOT NULL,
  `AyahText` text character set utf8 collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56125 ;

-- --------------------------------------------------------

--
-- Table structure for table `surahnames`
--

CREATE TABLE IF NOT EXISTS `surahnames` (
  `ID` int(11) NOT NULL auto_increment,
  `surano` int(11) NOT NULL,
  `Name` varchar(100) character set utf8 collate utf8_unicode_ci NOT NULL,
  `DatabaseID` int(11) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=459 ;
