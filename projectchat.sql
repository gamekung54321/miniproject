-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 04:37 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_profile` varchar(255) NOT NULL,
  `user_gender` text NOT NULL,
  `log_in` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_username`, `user_pass`, `user_name`, `user_profile`, `user_gender`, `log_in`) VALUES
(3, 'Test', '202cb962ac59075b964b07152d234b70', 'TomYam', 'images/image-human-brain_99433-298.jpg.26', 'Female', 'Offline'),
(4, 'Test1', '827ccb0eea8a706c4c34a16891f84e7b', 'game', 'images/male.png', 'Male', 'Offline'),
(5, 'Test2', '827ccb0eea8a706c4c34a16891f84e7b', 'Noom', 'images/102263855_10157070985155264_8809345236796335676_o.jpg.61', 'Female', 'Offline'),
(6, 'Test4', '827ccb0eea8a706c4c34a16891f84e7b', 'chicken', 'images/Lophura_diardi_-Florida,_USA_-captive-8a_(1).jpg.26', 'Male', 'Offline'),
(7, 'Test5', '827ccb0eea8a706c4c34a16891f84e7b', 'Pig', 'images/female.png', 'Female', ''),
(8, 'Test10', '827ccb0eea8a706c4c34a16891f84e7b', 'duckà¸­à¸´à¸­à¸´', 'images/disneyland_paris_little_duck-759x500.jpg.23', 'Male', 'Online');

-- --------------------------------------------------------

--
-- Table structure for table `users_chat`
--

CREATE TABLE `users_chat` (
  `msg_id` int(11) NOT NULL,
  `sender_username` varchar(255) NOT NULL,
  `receiver_username` varchar(255) NOT NULL,
  `msg_content` varchar(255) NOT NULL,
  `msg_status` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_chat`
--

INSERT INTO `users_chat` (`msg_id`, `sender_username`, `receiver_username`, `msg_content`, `msg_status`, `msg_date`) VALUES
(90, 'TomYam', 'Noom', 'à¸”à¸µà¸ˆà¸£à¹‰à¸²', 'read', '2021-03-09 16:30:51'),
(91, 'TomYam', 'Noom', 'ðŸ˜€', 'read', '2021-03-09 16:30:51'),
(95, 'TomYam', 'chicken', 'à¸­à¸´à¸­à¸´', 'unread', '2021-03-09 16:24:27'),
(96, 'Noom', 'TomYam', 'ðŸ˜€', 'read', '2021-03-10 01:28:53'),
(97, 'Noom', 'TomYam', 'ðŸ‘¿', 'read', '2021-03-10 01:28:53'),
(98, 'Noom', 'TomYam', 'à¸­à¸´à¸­à¸´', 'read', '2021-03-10 01:28:53'),
(99, 'Noom', 'game', 'à¸”à¸µà¸ˆà¸£à¹‰à¸²', 'unread', '2021-03-09 16:31:44'),
(100, 'Noom', 'game', 'ðŸ‘¿', 'unread', '2021-03-09 16:31:54'),
(101, 'Noom', 'game', 'ðŸ˜€', 'unread', '2021-03-09 16:31:55'),
(103, 'Noom', 'TomYam', 'â¤', 'read', '2021-03-10 01:28:53'),
(104, 'TomYam', 'Noom', 'à¸ªà¸šà¸²à¸¢à¸”à¸µà¸«à¸£à¸·à¸­à¹€à¸›à¸¥à¹ˆà¸²', 'read', '2021-03-10 01:30:04'),
(106, 'Noom', 'TomYam', 'à¸ªà¸šà¸²à¸¢à¸”à¸µ', 'read', '2021-03-10 02:11:58'),
(107, 'duckà¸­à¸´à¸­à¸´', 'Noom', 'à¸”à¸µà¸ˆà¸£à¹‰à¸²', 'read', '2021-03-10 02:52:13'),
(108, 'duckà¸­à¸´à¸­à¸´', 'Noom', 'à¸—à¸³à¸­à¸°à¹„à¸£à¸­à¸°', 'read', '2021-03-10 02:52:13'),
(109, 'duckà¸­à¸´à¸­à¸´', 'Noom', 'à¸—à¸³à¸­à¸°à¹„à¸£à¸”à¸µ', 'read', '2021-03-10 02:52:13'),
(110, 'duckà¸­à¸´à¸­à¸´', 'Noom', 'à¸à¸´à¸™à¸”à¸µà¸­à¸¢à¸¹à¹ˆà¸”à¸µ', 'read', '2021-03-10 02:52:13'),
(111, 'duckà¸­à¸´à¸­à¸´', 'Noom', 'ðŸ˜€', 'read', '2021-03-10 02:52:13'),
(113, 'duckà¸­à¸´à¸­à¸´', 'Noom', 'â¤', 'read', '2021-03-10 02:52:13'),
(114, 'Noom', 'duckà¸­à¸´à¸­à¸´', 'à¹€à¸«à¹‡à¸™à¹à¸¥à¹‰à¸§', 'read', '2021-03-10 02:53:07');

-- --------------------------------------------------------

--
-- Table structure for table `users_friend`
--

CREATE TABLE `users_friend` (
  `friend_id` int(11) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `friend_username` varchar(255) NOT NULL,
  `color_chat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_friend`
--

INSERT INTO `users_friend` (`friend_id`, `user_username`, `friend_username`, `color_chat`) VALUES
(52, 'Test1', 'Test', ''),
(53, 'Test1', 'Test2', ''),
(60, 'Test', 'Test2', 'bg-primary'),
(63, 'Test', 'Test4', 'bg-warning'),
(64, 'Test2', 'Test1', 'bg-danger'),
(65, 'Test2', 'Test4', ''),
(67, 'Test10', 'Test2', 'bg-warning'),
(68, 'Test2', 'Test10', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users_chat`
--
ALTER TABLE `users_chat`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users_friend`
--
ALTER TABLE `users_friend`
  ADD PRIMARY KEY (`friend_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users_chat`
--
ALTER TABLE `users_chat`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `users_friend`
--
ALTER TABLE `users_friend`
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
