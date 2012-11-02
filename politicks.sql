-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 02, 2012 at 02:43 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `politicks`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `icon` varchar(75) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`) VALUES
(1, 'Environment', 'images/icons/52-pine-tree.png'),
(2, 'Healthcare', 'images/icons/10-medical.png'),
(3, 'Transportation', 'images/icons/113-navigation.png'),
(4, 'Education', 'images/icons/140-gradhat.png');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `funderstoissues`
--

CREATE TABLE IF NOT EXISTS `funderstoissues` (
  `funder` int(11) NOT NULL,
  `issues` int(11) NOT NULL,
  PRIMARY KEY (`funder`,`issues`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `funderstopoliticians`
--

CREATE TABLE IF NOT EXISTS `funderstopoliticians` (
  `funder` int(11) NOT NULL,
  `politician` int(11) NOT NULL,
  PRIMARY KEY (`funder`,`politician`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `description` text,
  `funding` double NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `name`, `description`, `funding`, `likes`, `category_id`, `user_id`, `image`) VALUES
(1, 'Stop polluting pond', 'The pond is getting dirty.  People are littering all over the place and dumptrucks are leaving their messes right next to the pond.  Trash, Inc. is not following city regulations and somkething needs to be done about it.', 0, 0, 1, 1, ''),
(2, 'City needs to lower emissions', 'Cars emitting too many harmful chemicals', 0, 0, 1, 1, ''),
(3, 'Hire more teachers', 'Our highschool needs more teachers', 0, 0, 4, 1, ''),
(4, 'Work hard, Play harder...', 'We need children to work hard and play harder!', 0, 0, 4, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `likerstoissues`
--

CREATE TABLE IF NOT EXISTS `likerstoissues` (
  `likers` int(11) NOT NULL,
  `issues` int(11) NOT NULL,
  PRIMARY KEY (`likers`,`issues`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `likerstopoliticians`
--

CREATE TABLE IF NOT EXISTS `likerstopoliticians` (
  `likers` int(11) NOT NULL,
  `politician` int(11) NOT NULL,
  PRIMARY KEY (`likers`,`politician`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `politicians`
--

CREATE TABLE IF NOT EXISTS `politicians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `followers` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `politicians`
--

INSERT INTO `politicians` (`id`, `name`, `followers`, `description`) VALUES
(1, 'President Barack Obama', 12356, 'I am the President of the United States. '),
(2, 'Mayor Justin Chen', 1414, 'Just chilling around...');

-- --------------------------------------------------------

--
-- Table structure for table `politicianstoissues`
--

CREATE TABLE IF NOT EXISTS `politicianstoissues` (
  `politician` int(11) NOT NULL,
  `issues` int(11) NOT NULL,
  PRIMARY KEY (`politician`,`issues`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password_hash` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password_hash`) VALUES
(1, 'Justin Chen', 'test', 'test@test.com', '$2a$15$06ZmA..97dsDPKNSucflDeWNoRAXhQfrlw9wKrDg.83gO3hV6ffea');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
