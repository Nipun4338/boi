-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2021 at 10:44 AM
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
-- Table structure for table `adminpanel`
--

CREATE TABLE `adminpanel` (
  `admin_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminpanel`
--

INSERT INTO `adminpanel` (`admin_id`, `username`, `email`, `password`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Nipun Paul', 'nipun4338@gmail.com', '5892d74dbe25149c28b565df23ad9f1b', 1, '2021-04-19 22:11:58', '2021-04-19 22:11:58');

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
(7, 'আমেরিকায় উচ্চশিক্ষা', 'images/books/default.jpg', '17', 0, 'রাগিব হাসান', 'শিক্ষা ও গবেষণা', '5/6 Months', 'Dhaka', 1, '2021-04-15 16:20:55', '2021-04-15 16:20:55'),
(20, 'a', 'images/books/book_pic_19227010221(5).jpg', '16', 1000, 'রাগিব হাসান', 'শিক্ষা ও গবেষণা', 'Working', 'Dhaka', 1, '2021-04-21 13:11:45', '2021-04-21 22:22:57');

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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `sender_name` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `book_id`, `parent_comment_id`, `comment`, `sender_name`, `status`, `date`) VALUES
(1, NULL, 21, '22', '23', NULL, NULL);

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
(7, 'Nipun Paul', 'nipun4338@gmail.com', '+8801778546619', 'ok', '2021-04-18 22:13:52'),
(8, 'Nipun Paul', 'nipun4338@gmail.com', '+8801778546619', 'ok', '2021-04-21 22:31:36'),
(9, 'Nipun Paul', 'nipun4338@gmail.com', '+8801778546619', 'kire', '2021-04-21 22:31:48'),
(10, 'Nipun Paul', 'nipun4338@gmail.com', '+8801778546619', 'vai', '2021-04-21 22:32:25');

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

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `book_id`, `image`, `status`, `created_date`, `updated_date`) VALUES
(24, 20, 'images/books/book_pic_19227010221(5).jpg', 1, '2021-04-21 13:11:45', '2021-04-21 13:11:45');

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
-- Table structure for table `slider1`
--

CREATE TABLE `slider1` (
  `slider_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider1`
--

INSERT INTO `slider1` (`slider_id`, `image`, `status`, `created_date`, `updated_date`) VALUES
(1, 'images/slider1/slider_pic_1(1).jpeg', 1, '2021-04-20 19:40:23', '2021-04-20 19:42:27'),
(2, 'images/slider1/slider_pic_1(7).jpg', 1, '2021-04-20 20:16:16', '2021-04-20 20:16:16'),
(3, 'images/slider1/slider_pic_1(5).jpg', 1, '2021-04-20 21:13:59', '2021-04-20 21:13:59'),
(4, 'images/slider1/slider_pic_1(6).jpg', 1, '2021-04-20 21:14:06', '2021-04-20 21:14:06'),
(5, 'images/slider1/slider_pic_1(2).jpg', 1, '2021-04-20 21:14:22', '2021-04-20 21:14:22'),
(6, 'images/slider1/slider_pic_1(4).jpg', 1, '2021-04-20 21:14:30', '2021-04-20 21:14:30'),
(7, 'images/slider1/slider_pic_1(8).jpg', 1, '2021-04-20 21:14:38', '2021-04-20 21:14:38'),
(9, 'images/slider1/slider_pic_1(1).png', 1, '2021-04-20 21:14:54', '2021-04-20 21:14:54'),
(10, 'images/slider1/slider_pic_1(1).jpg', 1, '2021-04-20 21:15:03', '2021-04-20 21:15:03'),
(11, 'images/slider1/slider_pic_1(11).jpg', 1, '2021-04-20 21:15:10', '2021-04-20 21:15:10'),
(12, 'images/slider1/slider_pic_1(9).jpg', 1, '2021-04-20 21:15:18', '2021-04-20 21:15:18'),
(13, 'images/slider1/slider_pic_1(3).jpg', 1, '2021-04-20 21:15:26', '2021-04-20 21:15:26');

-- --------------------------------------------------------

--
-- Table structure for table `slider2`
--

CREATE TABLE `slider2` (
  `slider_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `slider2`
--

INSERT INTO `slider2` (`slider_id`, `image`, `status`, `created_date`, `updated_date`) VALUES
(1, 'images/slider2/slider_pic_79bd83cc14f7dbdcafa7a2631bc8fe29.jpg', 1, '2021-04-21 20:00:32', '2021-04-21 20:00:32');

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
(19, 'Test', 'nipun4337@gmail.com', '01778546619', 'Chaity 3, Upazilla Quarter, Joynagar', 'b9e88579af34e13717f84345039b8b4d', '8757150decbd89b0f5442ca3db4d0e0e', 'images/users/user_pic_nipun4337@gmail.com.png', 1, '2021-04-20 14:06:19', '2021-04-20 14:06:19'),
(21, 'Test 2', 'oprantor78@gmail.com', '01778546619', 'Chaity 3, Upazilla Quarter, Joynagar', 'b9e88579af34e13717f84345039b8b4d', 'f4f6dce2f3a0f9dada0c2b5b66452017', 'images/users/user_pic_01778546619956512780.png', 2, '2021-04-20 16:32:24', '2021-04-20 16:32:24');

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

-- --------------------------------------------------------

--
-- Table structure for table `zcomments_7`
--

CREATE TABLE `zcomments_7` (
  `comment_id` int(6) UNSIGNED NOT NULL,
  `parent_comment_id` int(6) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `sender_name` text DEFAULT NULL,
  `status` int(6) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zcomments_7`
--

INSERT INTO `zcomments_7` (`comment_id`, `parent_comment_id`, `comment`, `sender_name`, `status`, `date`) VALUES
(1, 0, 'working', 'nipun4338@gmail.com', NULL, '2021-05-03 05:47:31'),
(2, 0, 'yes', 'nipun4338@gmail.com', NULL, '2021-05-03 05:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `zcomments_20`
--

CREATE TABLE `zcomments_20` (
  `comment_id` int(6) UNSIGNED NOT NULL,
  `parent_comment_id` int(6) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `sender_name` text DEFAULT NULL,
  `status` int(6) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zcomments_20`
--

INSERT INTO `zcomments_20` (`comment_id`, `parent_comment_id`, `comment`, `sender_name`, `status`, `date`) VALUES
(1, 0, 'ff', 'nipun4338@gmail.com', NULL, '2021-05-03 05:45:14'),
(2, 1, 'ss', 'nipun4338@gmail.com', NULL, '2021-05-03 05:45:55'),
(3, 0, 'cc', 'nipun4338@gmail.com', NULL, '2021-05-03 05:46:01'),
(4, 2, 'kor', 'nipun4338@gmail.com', NULL, '2021-05-03 05:46:16'),
(5, 1, 'nare', 'nipun4338@gmail.com', NULL, '2021-05-03 05:46:55'),
(6, 3, 'ok', 'nipun4338@gmail.com', NULL, '2021-05-03 05:47:10'),
(7, 0, 'hi', '', NULL, '2021-05-03 05:59:37'),
(8, 0, 'ok', 'Nipun Paul', NULL, '2021-05-03 06:01:38'),
(9, 0, 'Me 2', 'Test', NULL, '2021-05-03 06:01:59'),
(10, 8, 'hi', 'Test', NULL, '2021-05-03 06:02:36'),
(11, 0, 'vv', 'Test', NULL, '2021-05-03 06:06:01'),
(12, 4, 'ok', 'Test', NULL, '2021-05-03 06:17:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminpanel`
--
ALTER TABLE `adminpanel`
  ADD PRIMARY KEY (`admin_id`);

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

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
-- Indexes for table `slider1`
--
ALTER TABLE `slider1`
  ADD PRIMARY KEY (`slider_id`);

--
-- Indexes for table `slider2`
--
ALTER TABLE `slider2`
  ADD PRIMARY KEY (`slider_id`);

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
-- Indexes for table `zcomments_7`
--
ALTER TABLE `zcomments_7`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `zcomments_20`
--
ALTER TABLE `zcomments_20`
  ADD PRIMARY KEY (`comment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminpanel`
--
ALTER TABLE `adminpanel`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `auther_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `slider1`
--
ALTER TABLE `slider1`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `slider2`
--
ALTER TABLE `slider2`
  MODIFY `slider_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `zcomments_7`
--
ALTER TABLE `zcomments_7`
  MODIFY `comment_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zcomments_20`
--
ALTER TABLE `zcomments_20`
  MODIFY `comment_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
