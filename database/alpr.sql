-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2014 at 08:35 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alpr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`user_id`, `username`, `password`) VALUES
(1, 'admin', '5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8');

-- --------------------------------------------------------

--
-- Table structure for table `format`
--

CREATE TABLE IF NOT EXISTS `format` (
  `format_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `state` varchar(50) NOT NULL,
  `prefix` varchar(20) NOT NULL,
  PRIMARY KEY (`format_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `format`
--

INSERT INTO `format` (`format_id`, `state_id`, `state`, `prefix`) VALUES
(7, 1, '', 'lol'),
(8, 8, '', 'LOP'),
(9, 4, '', 'LAS'),
(10, 1, '', 'TAP'),
(11, 1, 'Abuja', 'WAL'),
(12, 1, 'Abuja', 'TIL'),
(13, 3, 'Lagos', 'TIP'),
(14, 1, 'Abuja', 'POT');

-- --------------------------------------------------------

--
-- Table structure for table `number`
--

CREATE TABLE IF NOT EXISTS `number` (
  `number_id` int(11) NOT NULL AUTO_INCREMENT,
  `format_id` int(11) NOT NULL,
  `number` varchar(50) NOT NULL,
  PRIMARY KEY (`number_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `number`
--

INSERT INTO `number` (`number_id`, `format_id`, `number`) VALUES
(1, 4, 'lol-348-PX'),
(2, 7, 'lol-4567'),
(3, 9, 'LAS-456-OP'),
(4, 7, 'lol-904-TX'),
(5, 7, 'lol-3455-RTX');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE IF NOT EXISTS `owner` (
  `owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `number_id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `dob` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(250) NOT NULL,
  `company` varchar(150) NOT NULL,
  `c_address` varchar(250) NOT NULL,
  `created` varchar(50) NOT NULL,
  `expire` varchar(50) NOT NULL,
  `c_phone` varchar(50) NOT NULL,
  `img` varchar(50) NOT NULL,
  PRIMARY KEY (`owner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `number_id`, `title`, `firstname`, `middlename`, `lastname`, `sex`, `dob`, `email`, `phone`, `address`, `company`, `c_address`, `created`, `expire`, `c_phone`, `img`) VALUES
(1, 1, 'Mr.', 'odun', 'Ayo', 'Onabanjo', 'Male.', '0000-00-00', 'moderate@gmail.com', '07066443453', 'fdjsfkk ', 'rgkfkdk', 'dfgflfld', '2014-02-05', '0000-00-00', '3695956', ''),
(2, 2, 'Mr.', 'tuyir', 'fgqffq', 'fg', 'Male.', '2014-10-02', 'fh@gmil.com', '34547678', '23df', 'egf', 'ewf', '0000-00-00', '0000-00-00', '567', '021.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(200) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state`) VALUES
(1, 'Abuja'),
(2, 'Anambra'),
(3, 'Lagos'),
(4, 'Ondo'),
(5, 'Rivers'),
(6, 'Kongi'),
(7, 'Osun'),
(8, 'Ibadan'),
(9, 'Adamawa'),
(10, 'Abia'),
(11, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbltest`
--

CREATE TABLE IF NOT EXISTS `tbltest` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `age` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbltest`
--

INSERT INTO `tbltest` (`id`, `name`, `age`) VALUES
(1, 'Touch Poan', 29),
(2, 'Phon Vattana', 23),
(3, 'Touch Sokhavatey', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
