-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2021 at 09:08 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `boi`
--

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `auther_id` int(11) NOT NULL,
  `author` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`auther_id`, `author`) VALUES
(1, 'রাগিব হাসান');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text DEFAULT NULL,
  `owner_id` text NOT NULL,
  `price` int(11) NOT NULL,
  `author` text NOT NULL,
  `category` text NOT NULL,
  `present_condition` text NOT NULL,
  `location` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `name`, `image`, `owner_id`, `price`, `author`, `category`, `present_condition`, `location`, `status`, `created_date`, `updated_date`) VALUES
(7, 'আমেরিকায় উচ্চশিক্ষা', 'images/books/default.jpg', '17', 0, 'রাগিব হাসান', 'শিক্ষা ও গবেষণা', '5/6 Months', 'Dhaka', 1, '2021-04-15 16:20:55', '2021-04-15 16:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Children', 'images\\category\\Children.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(2, 'Classic', 'images\\category\\classic.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(3, 'Horror', 'images\\category\\Horror.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(4, 'Humor', 'images\\category\\Humor.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(5, 'Liberation War', 'images\\category\\Liberation-war.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(6, 'Poem', 'images\\category\\Poem.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(7, 'Psychological', 'images\\category\\Psychological.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(8, 'Romance', 'images\\category\\Romance.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(9, 'Science Fiction', 'images\\category\\Science-fiction.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(10, 'Thriller-Mystery', 'images\\category\\Thriller-and-mystery.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `message`, `date`) VALUES
(1, 'Nipun Paul', 'nipun4338@gmail.com', '+8801778546619', 'boi', '2021-04-18 21:34:07'),
(2, 'Nipun Paul', 'nipun4338@gmail.com', '+8801778546619', 'ok', '2021-04-18 21:56:56'),
(3, '', '', '', '', '2021-04-18 22:04:03'),
(4, '', '', '', '', '2021-04-18 22:04:51'),
(5, 'Nipun Paul', 'nipun4338@gmail.com', '+8801778546619', 'hi', '2021-04-18 22:08:09'),
(6, 'Nipun Paul', 'nipun4338@gmail.com', '+8801778546619', 'ok', '2021-04-18 22:09:27'),
(7, 'Nipun Paul', 'nipun4338@gmail.com', '+8801778546619', 'ok', '2021-04-18 22:13:52');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_type` text DEFAULT NULL,
  `datesent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message`, `sender_id`, `receiver_id`, `message_type`, `datesent`) VALUES
(1, 'Ok', 16, 16, 'dfg', '2021-04-17 00:42:24'),
(8, 'ki', 16, 16, NULL, '2021-04-17 12:54:13'),
(9, 'ko', 16, 16, NULL, '2021-04-17 12:59:07'),
(10, 'komu na', 16, 16, NULL, '2021-04-17 13:01:22'),
(11, 'kire vai', 16, 17, NULL, '2021-04-17 14:36:09'),
(12, 'kire vai', 16, 17, NULL, '2021-04-17 14:36:19'),
(13, 'kire vai', 16, 17, NULL, '2021-04-17 14:37:33'),
(14, 'hi', 16, 16, NULL, '2021-04-17 15:04:48'),
(15, 'ok', 17, 16, NULL, '2021-04-17 15:06:32');

-- --------------------------------------------------------

--
-- Table structure for table `message_recipient`
--

CREATE TABLE `message_recipient` (
  `message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(255) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `password` text NOT NULL,
  `hash` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email`, `phone`, `address`, `password`, `hash`, `image`, `status`, `created_date`, `updated_date`) VALUES
(16, 'Nipun Paul', 'nipun4338@gmail.com', '+8801778546619', 'Chaity 3, Upazilla Quarter, Joynagar', 'b9e88579af34e13717f84345039b8b4d', 'f57a2f557b098c43f11ab969efe1504b', 'images/users/default-image.jpg', 1, '2021-04-16 16:23:55', '2021-04-16 16:23:55'),
(17, 'Test', 'nipun4337@gmail.com', '+88017785446619', 'Dhaka', 'b9e88579af34e13717f84345039b8b4d', '99c5e07b4d5de9d18c350cdf64c5aa3d', 'images/users/default-image.jpg', 1, '2021-04-17 13:06:38', '2021-04-17 13:06:38');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `book_id`, `user_id`, `status`, `created_date`, `updated_date`) VALUES
(10, 0, 16, 1, '2021-04-16 23:05:48', '2021-04-16 23:05:48'),
(20, 17, 16, 1, '2021-04-18 20:25:48', '2021-04-18 20:25:48'),
(21, 16, 16, 1, '2021-04-18 20:26:01', '2021-04-18 20:26:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`auther_id`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `auther_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
