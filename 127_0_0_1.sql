-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2022 at 06:11 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `21187515`
--
CREATE DATABASE IF NOT EXISTS `21187515` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `21187515`;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_ID` int(10) NOT NULL,
  `post_ID` int(10) NOT NULL,
  `user_ID` int(5) NOT NULL,
  `date_commented` date NOT NULL,
  `comment_main` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_ID`, `post_ID`, `user_ID`, `date_commented`, `comment_main`) VALUES
(1, 12, 3, '2022-12-07', 'I agree! This is such a cool game. :)'),
(9, 13, 3, '2022-12-07', 'i agree'),
(11, 12, 14, '2022-12-07', 'Sounds kind of boring to me. Sorry :('),
(12, 10, 3, '2022-12-07', 'Challenge my opinion. If you dare.'),
(17, 7, 14, '2022-12-08', 'I spend FOREVER on candy crush. Its so addictive!'),
(18, 9, 14, '2022-12-08', 'YEESSSSSSSSSS!!!'),
(19, 11, 14, '2022-12-08', 'Its a bit too scary for me. I dont like zombies >_<');

-- --------------------------------------------------------

--
-- Table structure for table `game_genres`
--

CREATE TABLE `game_genres` (
  `genre_ID` int(2) NOT NULL,
  `genre_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `game_genres`
--

INSERT INTO `game_genres` (`genre_ID`, `genre_name`) VALUES
(1, 'Action'),
(2, 'Role-Playing Game'),
(3, 'Shooter'),
(4, 'Horror'),
(5, 'Platformer'),
(6, 'Rhythm'),
(7, 'Puzzle'),
(8, 'Fighting'),
(9, 'Visual Novel'),
(10, 'Massively Multiplayer Online');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_ID` int(10) NOT NULL,
  `user_ID` int(5) NOT NULL,
  `genre_ID` int(2) NOT NULL,
  `date_posted` date NOT NULL,
  `post_main` text NOT NULL,
  `post_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_ID`, `user_ID`, `genre_ID`, `date_posted`, `post_main`, `post_title`) VALUES
(7, 13, 6, '2022-12-03', 'candy crush on the mobile phone is pretty cool.', 'i like candy crush'),
(8, 3, 3, '2022-12-03', 'Call of duty is a really fun shooter game. its fun to play with friends and communicate while trying to work as a team.', 'Call of Duty - MW2'),
(9, 3, 2, '2022-12-03', 'Pokemon is a fun Role-playing game for all ages.\r\nsuper fun and decent story.', 'Pokemon'),
(10, 3, 5, '2022-12-03', 'tetris is a fun puzzle game to play when bored and in need of a quick blast to pass the time', 'Tetris'),
(11, 3, 4, '2022-12-06', 'Left 4 Dead is pretty cool :). You can play co-op with friends and kill zombies together.', 'Left 4 Dead'),
(12, 9, 7, '2022-12-07', 'Mini Motorways is a fun and casual strategy game.\r\nYou have to construct roads around a town to manage the flow of traffic so that everyone in the town can get to where they need to be in the most efficient way.\r\n', 'Mini Motorways casual and fun!'),
(13, 14, 2, '2022-12-07', 'It is such good game :).', 'Pokemon Scarlet ');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email_address` varchar(50) NOT NULL,
  `user_ID` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `genre_ID` int(2) NOT NULL,
  `user_type_ID` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email_address`, `user_ID`, `username`, `password`, `genre_ID`, `user_type_ID`) VALUES
('dave.dave@dave.com', 3, 'DaveTheRave', '1610838743cc90e3e4fdda748282d9b8', 3, 2),
('test@test.com', 8, 'DAVE', '900150983cd24fb0d6963f7d28e17f72', 0, 2),
('MiniMotorways@FirstWinter.com', 9, 'MattEddie345', 'ae2b1fca515949e5d54fb22b8ed95575', 1, 2),
('yvonne@email.com', 13, 'yvonne', '5f4dcc3b5aa765d61d8327deb882cf99', 7, 2),
('steph.steph@steph.com', 14, 'StephieSwirls', 'e8fab42752f318b2b2beb039a57dedcd', 7, 2),
('admin.admin@email.com', 15, 'Administrator', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_ID` int(1) NOT NULL,
  `user_type_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_ID`, `user_type_name`) VALUES
(1, 'Admin'),
(2, 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_ID`);

--
-- Indexes for table `game_genres`
--
ALTER TABLE `game_genres`
  ADD PRIMARY KEY (`genre_ID`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `game_genres`
--
ALTER TABLE `game_genres`
  MODIFY `genre_ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
