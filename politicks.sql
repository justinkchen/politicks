-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2012 at 10:48 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `message`, `user_id`, `issue_id`) VALUES
(1, 'Cool issue!', 1, 2),
(2, 'Yea I don''t really think so...', 6, 2),
(3, 'Pollution is bad', 1, 1),
(5, 'Yay', 11, 1),
(7, 'Why not Stanford tho', 11, 5),
(9, 'SUP BROS', 15, 2),
(17, 'No.', 29, 2),
(19, 'hello\r\n', 41, 2),
(21, 'lol.', 53, 5),
(29, 'I like pollutions ', 81, 1);

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
  `image` varchar(300) NOT NULL,
  `latitude` float NOT NULL DEFAULT '0',
  `longitude` float NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `name`, `description`, `funding`, `likes`, `category_id`, `user_id`, `image`, `latitude`, `longitude`) VALUES
(1, 'Stop polluting pond', 'The pond is getting dirty.  People are littering all over the place and dumptrucks are leaving their messes right next to the pond.  Trash, Inc. is not following city regulations and something needs to be done about it. NOW!', 372.52, 3, 1, 1, 'http://farm5.staticflickr.com/4075/4895313043_aaf1a94603.jpg', 0, 0),
(2, 'City needs to lower emissions', 'Cars emitting too many harmful chemicals', 0.04, 1, 1, 1, 'http://images.nationalgeographic.com/wpf/media-live/photos/000/001/cache/green-house-factor_177_600x450.jpg', 0, 0),
(3, 'Hire more teachers', 'Our highschool needs more teachers', 0, 0, 4, 1, 'http://fromoureyes.com/sites/default/files/field/image/Coolest-math-teacher-ever-halloween-costume-hot-teacher_0.jpg', 0, 0),
(4, 'Work hard, Play harder...', 'We need children to work hard and play harder!', 0, 0, 4, 1, 'http://iamboigenius.com/wp-content/uploads/2012/05/Wiz-Khalifa-Work-Hard-Play-Hard.jpg', 0, 0),
(5, 'More hospitals around Berkeley', 'People keep getting attacked and we need more hospitals in the area.', 0, 0, 2, 1, 'http://us.123rf.com/400wm/400/400/goodluz/goodluz1209/goodluz120900738/15383749-portrait-of-beautiful-nurse-standing-in-hospital.jpg', 0, 0),
(6, 'Need more roads', 'Can''t get anywhere', 0.01, 1, 3, 2, 'http://lh5.ggpht.com/abramsv/R2cgzUKUZoI/AAAAAAAABFM/ZlDAC9JKgpk/s640/01_probka.jpg', 0, 0),
(12, 'Statue of Mayor Chen', 'Some interesting stuff', 0, 0, 6, 1, 'http://images.fineartamerica.com/images-medium-large/plaza-mayor-statue-of-king-philip-iii-horseman-in-madrid-spain-john-a-shiron.jpg', 37.4257, -122.194);

-- --------------------------------------------------------

--
-- Table structure for table `politicians`
--

CREATE TABLE IF NOT EXISTS `politicians` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` tinytext NOT NULL,
  `title` varchar(50) NOT NULL DEFAULT 'Politician',
  `followers` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `politicians`
--

INSERT INTO `politicians` (`id`, `name`, `title`, `followers`, `description`, `image`, `email`) VALUES
(1, 'Barack Obama', 'President', 12356, 'I am the President of the United States. ', 'http://www.spotlightonpoverty.org/images/Barack_Obama.jpg', 'barack@whitehouse.gov'),
(2, 'Justin Chen', 'Politician', 1414, 'Just chilling around...', 'https://a1.muscache.com/users/3906593/profile_pic/1353391094/square_225.jpg', 'justinkchen@stanford.edu'),
(3, 'Leon Lin', 'Politician', 1, 'Currently trying to figure out what I''m doing.', 'http://qph.cf.quoracdn.net/main-thumb-15839-200-UWNBHXKQNtxDXubYzb32Jjmdj6AyDNxC.jpeg', 'leon@leonlin.com'),
(4, 'Charlie Janac', 'Politician', 100, 'World-changer', 'http://qph.cf.quoracdn.net/main-thumb-3804231-200-j9IBShpyNcllPjVEx8j6VXPnRDUinv5g.jpeg', 'charlie@cjanac.com');

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
(1, 'Get rid of all trash! Start new recycling programs and prevent all trash routes from getting near the pond.', 1, 1, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password_hash`) VALUES
(1, 'Justin Chen', 'test', 'test@test.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyVZvgZfBQQUa'),
(6, 'Justin Chen', 'justinkchen', 'justinkchen@stanford.edu', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyVZvgZfBQQUa'),
(7, 'Katherine Chen', 'kchen', 'katherine.l.l.chen@gmail.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(9, 'Katherine Chen', 'katchen', 'kpoppanda@gmail.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(11, 'Sheldon Chang', 'sheldon', 'sheldonc@stanford.edu', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(13, 'Jason Wang', 'jasonarecwang', 'jasonwang225@gmail.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(15, 'joe joe', 'joe', 'joe', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(17, 'pooop pooooopy', 'poop', 'poop@poop.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(19, 'Arun P', 'akp', 'akprasad@stanford.edu', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(21, 'Rory MacQueen', 'rmacqueen', 'rorymacqueen@gmail.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(23, 'justine kao', 'jk', 'justinek@stanford.edu', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(25, 'Misha Nasro', 'mishanasro', 'mishanasro@gmail.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(27, 'Legend Echo', 'le', 'le@berkeley.edu', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(29, 'Shane hegde', 'shane', 'hegdeshane@yahoo.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(31, 'Kit Halvorsen', 'kit', 'kit.halvorsen@gmail.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(33, 'Adam Adler', 'damjadler', 'damjadler@gmail.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(35, 'pp pp', 'pp', 'pp@pp.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(37, 'David Hoyt', 'Hoyt.David', 'dhoyt@stanford.edu', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(39, 'Claire Torchiana', 'ct2012', 'cltorch@stanford.edu', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(41, 'Marc Rasi', 'marcgrr', 'marc.rasi@gmail.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(43, 'Long Chen', 'lochenger', 'lochenger@gmail.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(45, 'why do', 'ihavedoregister', 'before@using.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(47, 'boo boo', 'boo', 'boo@boo.com', '$2a$05$50XdpiUF2XduHiR5MjvwB.FtMcv2P.wNewQftZHLoyV...'),
(49, 'J C', 'jkchen', 'jkchen@stanford.edu', '$2a$05$CR.SELYQByeEVYbMJsF9sui/pd106roUCMQwZnGUW/ZaUKCb732kq'),
(51, 'kwin fan', 'kwinfan', 'quynh.k.phan@gmail.com', '$2a$05$e3SDdlChNjH4uYWSpThWpuhslDkMlNBIu8vDTT644lGXS4derAD1.'),
(53, 'butt face', 'dick', 'poop@shit.edu', '$2a$05$.fiZOtGUeSO2m2rQaigDVuOpzq1hh/kw4BQlARyYVypzmLP8geEVu'),
(55, 'Pedro  Uriostegue', 'RunninTurtle', 'puriostegue@yahoo.com', '$2a$05$BTJjRjSnWVifoYeycFp7xer/UcImZrOqqtfT0XG5F7FBrM8/cmRJS'),
(57, 'j f', 'blah', 'blah@gmail.com', '$2a$05$tH2G/X8d1S1E/mAIt5q2oO7gt2TcEgzg2VDR.QvuNTYKby8r6wox2'),
(59, 'Yann Zeller', 'yannzeller', 'yann_zeller@yahoo.com', '$2a$05$2NwpiMFyjq3kAkeMJtUHbeOfXyeNt0Ujm5HMvzzHwi6mFIgOeKkCi'),
(61, 'Swaraj Banerjee', 'swaraj', 'swarajban@gmail.com', '$2a$05$yF45NUzCja8RcoSXB3lsf.mS/kKVIhpR083ixdmczu2S2essR7S8y'),
(63, 'Claire Kouba', 'vonmekkel', 'ckouba@stanford.edu', '$2a$05$oLxMOcMLuijAe9u7q8ouPeI4svu3Ks7njZK.KpmBYAlUbSuoVqyF6'),
(65, 'David Robinson', 'DRobins13', 'drobins13@gmail.com', '$2a$05$6jswLcR57V2cRQ6KYD8.rehRNyCzms.zly5AZKzTG/ItANV7UuCTu'),
(67, 'mr. dragon', 'dragonfarts', 'sweetxrain22@gmail.com', '$2a$05$rc.m7E/aur8hoM7JS4oR9.hnDwxNHNCjfXiTjZBi7tqcjErnPIW7m'),
(69, 'Audrey  Chou', 'audrey', 'auchou@gmail.com', '$2a$05$RKqSd0kcya9hV.r59TEKleFC.evzMaMMYT9rbQlnYTxHR5rVSJHZW'),
(71, 'Rob Ryan', 'robryan', 'robertoryan@gmail.com', '$2a$05$NnM/Db0dKiwZ9lxJ96/f7.CSS.ht2M/XEiybKquvGKLN9w23b69LW'),
(73, 'Vikram Haer', 'vikramhaer', 'vikramhaer@gmail.com', '$2a$05$ZAOb5plISYtTydM4JJ4uJ.tl1Q3jmZXaxpT4r.uufpSOt47vFKKn.'),
(75, 'Chun Pan', 'chunpan', 'chunpan89@gmail.com', '$2a$05$PbyBkSOXljAiPry5wQBTquVc59IB4DZwjMdLkAbWc7vMEdInSgSqC'),
(77, 'Charissa T', 'leonsucks', 'charissa130@gmail.com', '$2a$05$6PxUwb/B4MVz5jdWZ8os0eG8SqSuoAybyV0eKR5d1h0zhxGgbc4Eu'),
(79, 'blah blah', 'blahblah', 'blah@blah.com', '$2a$05$Sz1B/gnA18Q794kzc2aEp.gZNbsyrUQcg/et7NXd00g9XM0J3a7ga'),
(81, 'Justin Sucks ', 'FornotgettinganS4', 'alienalan77@gmail.com', '$2a$05$U7KojlHc18NbaCFSS1Cly.U36gR7Q.rGH2hJi10vXMPtQuBBVom1m'),
(83, 'Janelle Tiulentino', 'jtiulentino', 'jltino@stanford.edu', '$2a$05$NM/vMIewbOCV.2Em/jjCNujjjCy4yTGK3L8qgx68xYdZjopeRnesm'),
(85, 'Isabelle Wijangco', 'iw4180', 'iwijangco@gmail.com', '$2a$05$Ao1A2QvrH3HshxaFJardNeGT2xr1zxrl0giuIxe0sed725e58OxQ6');

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
(0, 1),
(1, 0),
(1, 1),
(1, 2),
(1, 3),
(1, 6),
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
(1, 2),
(11, 1),
(11, 2),
(15, 2),
(21, 1),
(23, 1),
(27, 1),
(27, 2),
(41, 1),
(41, 2),
(65, 1),
(67, 1),
(67, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
