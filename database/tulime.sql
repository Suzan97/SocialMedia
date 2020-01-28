-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2019 at 04:39 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tulime`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment` varchar(160) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `posted_at` datetime NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `posted_at`, `post_id`) VALUES
(1, 'Post comment', 3, '2019-05-31 23:22:35', 15),
(2, 'Thats good', 3, '2019-05-31 23:23:08', 9),
(3, 'kazi njuri', 3, '2019-06-01 16:19:38', 1),
(4, 'yes', 3, '2019-06-01 16:21:03', 1),
(5, 'yes', 3, '2019-06-01 16:21:19', 1),
(6, 'good', 3, '2019-06-01 16:25:14', 1),
(7, 'good', 3, '2019-06-01 16:33:51', 1),
(8, 'nope', 3, '2019-06-01 16:35:17', 14),
(9, 'nopw', 3, '2019-06-01 16:35:33', 14),
(10, 'nopw', 3, '2019-06-01 16:41:21', 14),
(11, 'nopw', 3, '2019-06-01 16:41:55', 14),
(12, 'yes', 3, '2019-06-01 16:45:38', 9),
(13, 'Say yes', 3, '2019-06-05 09:14:40', 15),
(14, 'Say my name', 3, '2019-06-05 21:55:30', 17),
(15, 'eferevvev', 7, '2019-06-06 09:27:23', 78),
(16, 'That''s good', 8, '2019-06-06 09:43:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `follower_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`) VALUES
(8, 1, 2),
(12, 2, 3),
(13, 1, 3),
(14, 1, 7),
(15, 3, 7),
(16, 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tokens` char(64) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tokens` (`tokens`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `tokens`, `user_id`) VALUES
(1, '82f10651e328988e24f50ffe8deeaeff040d2bf5', 2),
(2, '1d7f5b0362afc97deaa271aee7c050adccf6a0d2', 1),
(3, 'e692534accf5d540ca63cbba898c6bc3b6451ded', 1),
(4, '8a19278761363039e9f41c9b0413dda28f480514', 2),
(5, '78a145b00c1828337360c5587bb83fb84b50ac3b', 2),
(6, '967c728264b1a9f9905cdcaec632ce64cc0acb9a', 2),
(7, '216e10cf09a7a4da49a6991f707a49419029abfe', 2),
(8, '052f1df4fdf280ba47b03a4f272e15fff6862175', 2),
(9, 'a948cdf6bba7cd7e9ade71ea647291a2a61965b0', 2),
(10, 'a0c14795a756ece69a911df05bc5edda10f468bf', 2),
(13, '9e4c6854fb6fd0182c3936d5b09101986ba57626', 2),
(19, 'f239039caed470c929da0710ff2d4d94d391c550', 8);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` int(11) unsigned NOT NULL,
  `receiver` int(10) unsigned NOT NULL,
  `sender` int(11) unsigned NOT NULL,
  `extra` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `receiver`, `sender`, `extra`) VALUES
(1, 1, 3, 3, NULL),
(2, 1, 1, 3, NULL),
(3, 1, 3, 3, NULL),
(5, 1, 3, 3, ' {"postbody": "@simon says dance"} ');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `body` varchar(180) NOT NULL,
  `posted_at` datetime NOT NULL,
  `user_id` int(11) unsigned DEFAULT NULL,
  `likes` int(11) unsigned DEFAULT NULL,
  `postimg` varchar(255) DEFAULT NULL,
  `topics` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `posted_at`, `user_id`, `likes`, `postimg`, `topics`) VALUES
(1, 'Hello World', '2019-05-28 19:09:14', 2, 2, NULL, NULL),
(9, 'Farmer learn a lot through', '2019-05-28 19:39:13', 2, 2, NULL, NULL),
(14, 'say', '2019-05-28 21:19:06', 2, 1, NULL, NULL),
(15, 'say', '2019-05-28 21:19:27', 2, 1, NULL, NULL),
(17, 'eye', '2019-05-28 21:31:45', 2, 1, NULL, NULL),
(20, 'Did you know sugar beet is a better alternative to sugar cane', '2019-05-29 14:53:04', 2, 2, NULL, NULL),
(21, 'HEy', '2019-05-31 13:59:06', 3, 0, NULL, NULL),
(59, 'Hello World', '2019-06-05 10:00:10', 3, 0, NULL, NULL),
(78, 'say', '2019-06-05 15:54:12', 3, 2, '', ''),
(81, '#MaizeScandal in Kenya', '2019-06-05 16:00:44', 3, 1, '', 'MaizeScandal,'),
(82, '@test trial and error', '2019-06-05 18:06:22', 3, 0, '', ''),
(83, '@Simon Try and try', '2019-06-05 18:54:08', 3, 0, '', ''),
(84, '@test this is how we plant', '2019-06-05 18:59:05', 3, 0, '', ''),
(85, '@simon eye', '2019-06-05 19:27:00', 3, 0, '', ''),
(86, '@simon its working', '2019-06-05 21:12:17', 3, 0, '', ''),
(87, '@simon says dance', '2019-06-05 21:29:30', 3, 0, '', ''),
(89, 'This is trial and error', '2019-06-06 09:21:07', 7, 0, '', ''),
(91, 'Try harder', '2019-06-06 09:42:46', 8, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `posts_like`
--

CREATE TABLE IF NOT EXISTS `posts_like` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=141 ;

--
-- Dumping data for table `posts_like`
--

INSERT INTO `posts_like` (`id`, `post_id`, `user_id`) VALUES
(18, 9, 2),
(65, 1, 2),
(66, 1, 2),
(67, 1, 2),
(68, 20, 2),
(69, 17, 2),
(105, 14, 3),
(106, 9, 3),
(107, 20, 3),
(110, 1, 3),
(111, 30, 3),
(117, 76, 3),
(118, 25, 3),
(126, 78, 3),
(128, 75, 3),
(129, 80, 3),
(132, 67, 3),
(133, 23, 3),
(135, 88, 7),
(136, 81, 7),
(137, 78, 7),
(139, 90, 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `profileimg` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `profileimg`) VALUES
(1, 'test', '$2y$10$bAlAnbJ5PVzIo08Ewu3EZOa.LFcEwnQjVXXzPgocmRz/hv4O3fEr6', 'test@test.com', NULL),
(2, 'sign', '$2y$10$aa82K8sCN8hevhqsCrAEEuEv/Ef.j4H25zQYWa2GKXpbeRqhuNfB2', 'sign@sign.com', NULL),
(3, 'simon', '$2y$10$R1UAFPr2nt5k296yP235ju4fzEfTtD3xpJ6EgHAR3iT6jsSUfwIYe', 'simon@simon.com', 'https://i.imgur.com/ApLLoGN.png'),
(4, 'Work', '$2y$10$eeTKbMofzN0r75qoCUxFguvQ4IjPCfOnivD4/epa8F2RizbiaBmj6', 'work@work.com', ''),
(5, 'Class', '$2y$10$1Y66BeGDjocK2MtGoR1QK.3HO.uWdTucjAzLDVdwaAFDwpO8ngZZW', 'class@class.com', ''),
(6, 'Clay', '$2y$10$2NgaCpsEsu/P89mmgyvLbuRf7L7Bc.zadh1L6IK5NmWtly6mT6Rqi', 'clay@clay.com', ''),
(7, 'Enter', '$2y$10$MHsEjesIsMfUVM44ehLUjOjvxxLtToz6MnKsVuAh5ItupvMDOFNVi', 'enter@enter.com', ''),
(8, 'Trial', '$2y$10$EKVsQQdOG7Zjmkgd7UCjeeX/fpFBU/nLbVMAhKzl8Dud.hOXuNEJW', 'Trial@trial.com', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD CONSTRAINT `login_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `posts_like`
--
ALTER TABLE `posts_like`
  ADD CONSTRAINT `posts_like_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
