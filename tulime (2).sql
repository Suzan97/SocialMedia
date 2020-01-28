-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2019 at 12:31 PM
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
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `adminname`, `password`) VALUES
(1, 'admin', 'admin');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

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
(16, 'That''s good', 8, '2019-06-06 09:43:33', 1),
(17, 'through what', 9, '2019-06-18 18:08:08', 9),
(18, 'Me to', 6, '2019-06-18 18:10:28', 92),
(19, 'Thanks for the update', 12, '2019-07-20 17:25:02', 122),
(20, 'Wow that''s amazing', 11, '2019-07-24 10:48:07', 123);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `follower_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`) VALUES
(8, 1, 2),
(12, 2, 3),
(13, 1, 3),
(14, 1, 7),
(15, 3, 7),
(16, 2, 8),
(17, 2, 9),
(19, 3, 6),
(20, 9, 6),
(22, 3, 9),
(29, 8, 9),
(30, 2, 6),
(35, 3, 10),
(36, 11, 12),
(37, 12, 11),
(38, 11, 13),
(39, 11, 9),
(40, 12, 9),
(41, 10, 9);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

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
(19, 'f239039caed470c929da0710ff2d4d94d391c550', 8),
(23, '54d0306f93f1e1579420b27488820bcb528f4639', 6),
(24, '5761d03807dbd7a9dbb9b8ed1ea3e1d7e60487dd', 6),
(29, '74dfd45a9f57e4cbba0957718d218f5719a68278', 8),
(47, '9a36ed4ba36f43eced811df19529cad952428d43', 9),
(48, 'f9a2052329f4f5cdd1a05bea26e690ffea54b52f', 9),
(54, '2edab1e03fc0f27c81a9d0ea6f65befd15bfa03a', 11),
(55, '06b46303257f4e52e16132cb5e1dbc5e3914b466', 11);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `body` text NOT NULL,
  `sender` int(11) unsigned NOT NULL,
  `receiver` int(11) unsigned NOT NULL,
  `read` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `receiver` (`receiver`),
  KEY `sender` (`sender`),
  KEY `receiver_2` (`receiver`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `body`, `sender`, `receiver`, `read`) VALUES
(1, 'me', 2, 3, 0),
(3, 'Hello world', 9, 3, 1),
(4, 'Thanks for the message', 9, 3, 1),
(5, 'Thanks for the message', 9, 9, 1),
(6, 'Hello', 9, 9, 0),
(7, 'Hey', 12, 9, 0);

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
  PRIMARY KEY (`id`),
  KEY `receiver` (`receiver`),
  KEY `sender` (`sender`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `receiver`, `sender`, `extra`) VALUES
(1, 1, 3, 3, NULL),
(2, 1, 1, 3, NULL),
(3, 1, 3, 3, NULL),
(5, 1, 3, 3, ' {"postbody": "@simon says dance"} '),
(6, 1, 9, 9, ' {"postbody": "@Winnie welcome"} '),
(7, 1, 9, 9, ' {"postbody": "@Winnie hey hey"} '),
(8, 1, 12, 11, ' {"postbody": "@Kiptoo THere might be a pest outbreak"} '),
(9, 1, 12, 9, ' {"postbody": "@kiptoo welcome"} ');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=127 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `posted_at`, `user_id`, `likes`, `postimg`, `topics`) VALUES
(1, 'Hello World', '2019-05-28 19:09:14', 2, 0, NULL, NULL),
(9, 'Farmer learn a lot through', '2019-05-28 19:39:13', 2, 0, NULL, NULL),
(14, 'say', '2019-05-28 21:19:06', 2, 0, NULL, NULL),
(15, 'say', '2019-05-28 21:19:27', 2, 0, NULL, NULL),
(17, 'eye', '2019-05-28 21:31:45', 2, 0, NULL, NULL),
(20, 'Did you know sugar beet is a better alternative to sugar cane', '2019-05-29 14:53:04', 2, 0, NULL, NULL),
(21, 'HEy', '2019-05-31 13:59:06', 3, 0, NULL, NULL),
(59, 'Hello World', '2019-06-05 10:00:10', 3, 0, NULL, NULL),
(78, 'say', '2019-06-05 15:54:12', 3, 0, '', ''),
(82, '@test trial and error', '2019-06-05 18:06:22', 3, 1, '', ''),
(85, '@simon eye', '2019-06-05 19:27:00', 3, 2, '', ''),
(89, 'This is trial and error', '2019-06-06 09:21:07', 7, 0, '', ''),
(91, 'Try harder', '2019-06-06 09:42:46', 8, 0, '', ''),
(92, 'Am done', '2019-06-13 14:55:46', 9, 1, '', ''),
(94, 'Welcome home', '2019-06-20 00:27:54', 6, 0, '', ''),
(95, 'Trial and error\r\n', '2019-06-20 15:23:00', 6, 0, '', ''),
(96, 'Hello World12345', '2019-06-26 22:00:16', 9, 0, '', ''),
(103, 'Trial and error', '2019-06-26 22:16:13', 9, 1, '', ''),
(114, 'Hello', '2019-07-02 09:37:45', 8, 0, '', ''),
(115, 'Maize is the best', '2019-07-08 11:13:11', 10, 0, NULL, ''),
(116, '@Winnie hey hey', '2019-07-08 13:23:15', 9, 0, '', ''),
(119, 'Welcome to tulime', '2019-07-09 17:49:51', 9, 0, '', ''),
(120, 'Did you know sugar beet is the best alternative to sugar cane', '2019-07-09 18:26:32', 13, 0, '', ''),
(121, 'D', '2019-07-09 18:27:35', 13, 0, '', ''),
(122, '@Kiptoo THere might be a pest outbreak', '2019-07-09 18:31:30', 11, 2, '', ''),
(123, 'There is a free animal vet in Rongai ', '2019-07-09 18:45:21', 12, 0, '', ''),
(125, '@kiptoo welcome', '2019-07-18 16:38:24', 9, 0, '', ''),
(126, 'Hey are you good', '2019-07-22 17:00:53', 11, 0, '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=209 ;

--
-- Dumping data for table `posts_like`
--

INSERT INTO `posts_like` (`id`, `post_id`, `user_id`) VALUES
(1, 13, 12),
(165, 115, 8),
(167, 114, 8),
(168, 113, 9),
(187, 85, 9),
(195, 103, 10),
(196, 82, 10),
(197, 85, 10),
(200, 122, 13),
(208, 122, 9);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

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
(8, 'Trial', '$2y$10$EKVsQQdOG7Zjmkgd7UCjeeX/fpFBU/nLbVMAhKzl8Dud.hOXuNEJW', 'Trial@trial.com', ''),
(9, 'Winnie', '$2y$10$G67fLkEUT.2SFnzwbQ6Yf.OwcA4IG9pNByI6lmtGaUWgzhUPaFBGy', 'winnie@gmail.com', 'https://i.imgur.com/ApLLoGN.png'),
(10, '123', '$2y$10$1C5TC/Hi2Kz3RD/qplp7iO64fMKpIDGyre7U.cFtAYtBc2cAbZ7w6', 'victoria@victoria.com', ''),
(11, 'Kalume', '$2y$10$aK2GnwC//Nq37MTiN2kmV.vVdikU4f1n/xjnPKYqvhADKdBK/UzDy', 'kalume@kalume.com', ''),
(12, 'Kiptoo', '$2y$10$Tn2JdL12sZGPQRe50TzeC.Rtiavj6VNKdLhK9qjnwv6.qk/qOElbi', 'kiptoo@kip.com', 'https://i.imgur.com/4Ry9Thd.jpg'),
(13, 'Moses', '$2y$10$.nkqnsgclAp510P503xQU.iPPEj0IKwKeVj4SmmMArh28wYKi4Kuu', 'moses@moses.com', '');

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
-- Constraints for table `followers`
--
ALTER TABLE `followers`
  ADD CONSTRAINT `followers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD CONSTRAINT `login_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`receiver`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `notifications_ibfk_2` FOREIGN KEY (`sender`) REFERENCES `users` (`user_id`);

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
