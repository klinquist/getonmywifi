-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: angry-la-11.angryhosting.com
-- Generation Time: May 13, 2015 at 05:39 PM
-- Server version: 5.6.23-72.1-log
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Table structure for table `getonmywifi`
--

CREATE TABLE IF NOT EXISTS `getonmywifi` (
`pk` int(6) NOT NULL,
  `hash` varchar(12) NOT NULL,
  `hashkey` varchar(12) NOT NULL,
  `email` varchar(128) NOT NULL,
  `ssid` varchar(128) NOT NULL,
  `hidden` varchar(5) NOT NULL,
  `key` varchar(128) NOT NULL,
  `lat` varchar(16) NOT NULL,
  `long` varchar(16) NOT NULL,
  `createdbyip` varchar(15) NOT NULL,
  `createdon` datetime NOT NULL,
  `lastaccessedon` datetime NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7430 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `getonmywifi`
--
ALTER TABLE `getonmywifi`
 ADD PRIMARY KEY (`pk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `getonmywifi`
--
ALTER TABLE `getonmywifi`
MODIFY `pk` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7430;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
