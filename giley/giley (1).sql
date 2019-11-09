-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 09, 2019 at 07:53 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `giley`
--

-- --------------------------------------------------------

--
-- Table structure for table `example`
--

CREATE TABLE `example` (
  `test` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `example`
--

INSERT INTO `example` (`test`) VALUES
('Æli'),
('Æli'),
('Æli'),
('Æli'),
('Æli'),
('Æli'),
('əəəəəə'),
('Æli'),
('Æli'),
('Æli'),
('Æli'),
('Æli'),
('Æli'),
('Æli'),
('Æli'),
('É™É™É™É™É™É™'),
('É™É™É™É™É™É™'),
('É™É™É™É™É™É™'),
('É™É™É™É™É™É™'),
('É™É™É™É™É™É™');

-- --------------------------------------------------------

--
-- Table structure for table `hashtag`
--

CREATE TABLE `hashtag` (
  `id` int(11) NOT NULL,
  `hash` text CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

--
-- Dumping data for table `hashtag`
--

INSERT INTO `hashtag` (`id`, `hash`) VALUES
(1, '#rocknroll'),
(7, '#universitet'),
(8, '#mekteb'),
(9, '#sadas'),
(11, '#university'),
(12, '#new'),
(13, '#thing');

-- --------------------------------------------------------

--
-- Table structure for table `object`
--

CREATE TABLE `object` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vote_num` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `object`
--

INSERT INTO `object` (`id`, `user_id`, `title`, `upload_image`, `location`, `rate`, `post_date`, `description`, `vote_num`) VALUES
(44, 32, 'Baku Engineering University', '38.bmu resm.jpg', 'https://goo.gl/maps/C2KA6EtTTSrYR3S8A', 2, '2019-11-02 17:50:29', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit', NULL),
(45, 32, 'mikrokontroller', '18.uniforma01.png', 'vvv', -1, '2019-11-03 14:55:05', 'mmm', NULL),
(46, 32, 'Lawyer Service Company', '96.events.png', 'https://goo.gl/maps/C2KA6ExcxtTTSrYR3S8A', 0, '2019-11-06 20:55:09', 'XÄ±rdalan É™trafÄ±nda yerlÉ™ÅŸmiÅŸ yeni d&ouml;vlÉ™t universiteti.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `object_hashtag`
--

CREATE TABLE `object_hashtag` (
  `id` int(11) NOT NULL,
  `object_id` text NOT NULL,
  `hashtag_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `object_hashtag`
--

INSERT INTO `object_hashtag` (`id`, `object_id`, `hashtag_id`) VALUES
(20, '44', '11'),
(21, '45', '7'),
(22, '45', '8'),
(23, '46', '12'),
(24, '46', '13');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `object_id` int(11) NOT NULL,
  `last_voted` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`id`, `user_id`, `object_id`, `last_voted`) VALUES
(196, 33, 44, 'up'),
(197, 33, 45, 'down'),
(198, 33, 46, 'up'),
(212, 32, 46, 'down'),
(215, 32, 44, 'up');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `f_name` text CHARACTER SET latin1 NOT NULL,
  `l_name` text CHARACTER SET latin1 NOT NULL,
  `user_name` text CHARACTER SET latin1 NOT NULL,
  `user_pass` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_email` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_gender` text CHARACTER SET latin1 NOT NULL,
  `user_image` varchar(255) CHARACTER SET latin1 NOT NULL,
  `user_reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` text CHARACTER SET latin1 NOT NULL,
  `posts` text CHARACTER SET latin1 NOT NULL,
  `recovery_accaunt` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `user_v` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `voted` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `f_name`, `l_name`, `user_name`, `user_pass`, `user_email`, `user_gender`, `user_image`, `user_reg_date`, `status`, `posts`, `recovery_accaunt`, `user_v`, `voted`) VALUES
(32, 'SamirS', 'Babayev', 'samir_babayev_148974', '111111', 'contactredch@gmail.com', 'K', '60.Webp.net-resizeimage.jpg', '2019-11-02 17:49:18', 'verified', 'yes', 'ilham', NULL, 0),
(33, 'Rockn', 'Roller', 'rockn_roller_19200', '123456', 'roro@mail.ru', 'K', 'p.png', '2019-11-06 12:10:18', 'verified', 'no', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hashtag`
--
ALTER TABLE `hashtag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `object`
--
ALTER TABLE `object`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `object_hashtag`
--
ALTER TABLE `object_hashtag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hashtag`
--
ALTER TABLE `hashtag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `object`
--
ALTER TABLE `object`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `object_hashtag`
--
ALTER TABLE `object_hashtag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=216;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
