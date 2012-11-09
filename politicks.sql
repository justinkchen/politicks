-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2012 at 06:16 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon`) VALUES
(1, 'Environment', 'images/icons/52-pine-tree.png'),
(2, 'Healthcare', 'images/icons/10-medical.png'),
(3, 'Transportation', 'images/icons/113-navigation.png'),
(4, 'Education', 'images/icons/140-gradhat.png'),
(6, 'Community', 'images/icons/53-house.png'),
(50, 'Other', 'images/icons/152-rolodex.png');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `message`, `user_id`, `issue_id`) VALUES
(1, 'Cool issue!', 1, 2),
(2, 'Yea I don''t really think so...', 6, 2);

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
  `latitude` float NOT NULL DEFAULT '0',
  `longitude` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `name`, `description`, `funding`, `likes`, `category_id`, `user_id`, `image`, `latitude`, `longitude`) VALUES
(1, 'Stop polluting pond', 'The pond is getting dirty.  People are littering all over the place and dumptrucks are leaving their messes right next to the pond.  Trash, Inc. is not following city regulations and something needs to be done about it. NOW!', 372.51, 2, 1, 1, '', 0, 0),
(2, 'City needs to lower emissions', 'Cars emitting too many harmful chemicals', 0, 0, 1, 1, '', 0, 0),
(3, 'Hire more teachers', 'Our highschool needs more teachers', 0, 0, 4, 1, '', 0, 0),
(4, 'Work hard, Play harder...', 'We need children to work hard and play harder!', 0, 0, 4, 1, '', 0, 0),
(5, 'More hospitals around Berkeley', 'People keep getting attacked and we need more hospitals in the area.', 0, 0, 2, 1, '', 0, 0),
(6, 'Need more roads', 'Can''t get anywhere', 0, 0, 3, 1, '', 0, 0),
(12, 'A Cool issue', 'Some interesting stuff', 0, 0, 6, 1, '', 37.4257, -122.194);

-- --------------------------------------------------------

--
-- Table structure for table `politicians`
--

CREATE TABLE IF NOT EXISTS `politicians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `followers` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `politicians`
--

INSERT INTO `politicians` (`id`, `name`, `followers`, `description`, `image`, `email`) VALUES
(1, 'President Barack Obama', 12356, 'I am the President of the United States. ', '', 'barack@whitehouse.gov'),
(2, 'Mayor Justin Chen', 1414, 'Just chilling around...', '', 'justinkchen@stanford.edu');

-- --------------------------------------------------------

--
-- Table structure for table `proposedsolutions`
--

CREATE TABLE IF NOT EXISTS `proposedsolutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solution` text NOT NULL,
  `politician_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `proposedsolutions`
--

INSERT INTO `proposedsolutions` (`id`, `solution`, `politician_id`, `issue_id`, `category_id`) VALUES
(1, 'Get rid of all trash!', 1, 1, 1);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`,`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password_hash`) VALUES
(1, 'Justin Chen', 'test', 'test@test.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyVZvgZfBQQUa'),
(6, 'Justin Chen', 'justinkchen', 'justinkchen@stanford.edu', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyVZvgZfBQQUa');

-- --------------------------------------------------------

--
-- Table structure for table `userstoissues`
--

CREATE TABLE IF NOT EXISTS `userstoissues` (
  `user_id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`issue_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userstoissues`
--

INSERT INTO `userstoissues` (`user_id`, `issue_id`) VALUES
(1, 1),
(1, 3),
(6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userstopoliticians`
--

CREATE TABLE IF NOT EXISTS `userstopoliticians` (
  `user_id` int(11) NOT NULL,
  `politician_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`politician_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userstopoliticians`
--

INSERT INTO `userstopoliticians` (`user_id`, `politician_id`) VALUES
(1, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
