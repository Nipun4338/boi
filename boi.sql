-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2021 at 10:12 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

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
Drop table adminpanel;
drop table author;
drop table books;
drop table category;
drop table comments;
drop table contact;
drop table images;
drop table messages;
drop table slider1;
drop table slider2;
drop table user;
drop table wishlist;
drop table zcomments_7;
drop table zcomments_20;

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
(20, 'a', 'images/books/book_pic_19227010221(5).jpg', '16', 1000, 'রাগিব হাসান', 'শিক্ষা ও গবেষণা', 'Working', 'Dhaka', 1, '2021-04-21 13:11:45', '2021-04-21 22:22:57'),
(22, 'New', 'images/books/book_pic_1528239171favicon.jpg', '35', 100, 'রাগিব হাসান', 'শিক্ষা ও গবেষণা', 'Working', 'Dhaka', 1, '2021-05-04 11:32:09', '2021-05-04 11:32:09');

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
(1, NULL, 21, '22', '23', NULL, NULL),
(2, NULL, 12, '22', '32', NULL, NULL),
(3, NULL, 30, '30', '30', NULL, NULL),
(4, NULL, 30, '30', '30', NULL, NULL),
(5, NULL, 30, '30', '30', NULL, NULL),
(6, NULL, 30, '30', '30', NULL, NULL),
(7, NULL, 30, '30', '30', NULL, NULL),
(8, NULL, 30, '30', '30', NULL, NULL),
(9, NULL, 30, '30', '30', NULL, NULL),
(10, NULL, 30, '30', '30', NULL, NULL),
(11, NULL, 30, '30', '30', NULL, NULL),
(12, NULL, 30, '30', '30', NULL, NULL);

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
(24, 20, 'images/books/book_pic_19227010221(5).jpg', 1, '2021-04-21 13:11:45', '2021-04-21 13:11:45'),
(26, 22, 'images/books/book_pic_1528239171favicon.jpg', 1, '2021-05-04 11:32:09', '2021-05-04 11:32:09');

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
(21, 'Test 2', 'oprantor78@gmail.com', '01778546619', 'Chaity 3, Upazilla Quarter, Joynagar', 'b9e88579af34e13717f84345039b8b4d', 'f4f6dce2f3a0f9dada0c2b5b66452017', 'images/users/user_pic_01778546619956512780.png', 2, '2021-04-20 16:32:24', '2021-04-20 16:32:24'),
(35, 'Nipun Paul', 'nipun4338@gmail.com', '01778546619', 'Chaity 3, Upazilla Quarter, Joynagar', 'b9e88579af34e13717f84345039b8b4d', '4ea06fbc83cdd0a06020c35d50e1e89a', 'images/users/default-image.jpg', 1, '2021-05-04 11:30:47', '2021-05-04 11:30:47');

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

-- --------------------------------------------------------

--
-- Table structure for table `zcomments_22`
--

CREATE TABLE `zcomments_22` (
  `comment_id` int(6) UNSIGNED NOT NULL,
  `parent_comment_id` int(6) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `sender_name` text DEFAULT NULL,
  `status` int(6) DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zcomments_22`
--

INSERT INTO `zcomments_22` (`comment_id`, `parent_comment_id`, `comment`, `sender_name`, `status`, `date`) VALUES
(1, 0, 'ki', 'Nipun Paul', NULL, '2021-05-04 05:42:54');

-- --------------------------------------------------------

--
-- Table structure for table `zmessage_19`
--

CREATE TABLE `zmessage_19` (
  `message_id` int(6) UNSIGNED NOT NULL,
  `sendto` int(6) NOT NULL,
  `message` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zmessage_19`
--

INSERT INTO `zmessage_19` (`message_id`, `sendto`, `message`, `type`, `date`) VALUES
(1, 35, 'dd', 'send', '2021-05-04 05:44:37'),
(2, 35, 'ff', 'send', '2021-05-04 05:48:04'),
(3, 35, 'gg', 'send', '2021-05-04 05:53:16'),
(4, 35, 'fff', 'receive', '2021-05-04 06:02:00'),
(5, 35, 'ffffffffffffffffffffffffffffffffffffff', 'send', '2021-05-04 06:05:50'),
(6, 35, 'ffffffffffffffff', 'send', '2021-05-04 06:05:54'),
(7, 35, 'dd', 'receive', '2021-05-04 06:30:40'),
(8, 35, 'cc', 'receive', '2021-05-04 06:31:05'),
(9, 35, 'frbbubbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 'receive', '2021-05-04 07:43:44'),
(10, 35, 'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 'send', '2021-05-04 07:48:44'),
(11, 35, 'বিল অ্যান্ড মেলিন্ডা গেটস ফাউন্ডেশন\r\n১৯৮৭ সালে মাইক্রোসফটে প্রোডাক্ট ম্যানেজার হিসেবে যোগ দিয়েছিলেন মেলিন্ডা। সে সময় থেকে দুজনের মধ্যে বন্ধুত্বের সম্পর্ক গড়ে ওঠে। একসময় তা প্রেম পর্যন্ত গড়ায়। ১৯৯৪ সালে বিয়ে করেন গেটস ও মেলিন্ডা। বিয়ের ছয় বছর পর তাঁরা যৌথভাবে গড়ে তোলেন দাতব্য প্রতিষ্ঠান ‘বিল অ্যান্ড মেলিন্ডা গেটস ফাউন্ডেশন’। বিশ্বের বিভিন্ন স্থানে নানামুখী কাজ করছে এই ফাউন্ডেশন। বিশ্বজুড়ে সংক্রামক রোগব্যাধির বিরুদ্ধে লড়াই ও শিশুদের টিকাদানে উৎসাহিত করতে শুরু থেকে এখন পর্যন্ত এ ফাউন্ডেশন প্রায় ৫৪ বিলিয়ন ডলার খরচ করেছে। ক্ষুধা-দারিদ্র্যমুক্ত, সচেতন, শিক্ষিত ও স্বাস্থ্যবান একটি বিশ্ব গড়ে তোলা এ সংস্থার প্রধান উদ্দেশ্য। বিল অ্যান্ড মেলিন্ডা গেটস ফাউন্ডেশন প্রতিবছর প্রায় পাঁচ বিলিয়ন ডলার ব্যয় করে স্বাস্থ্য খাতের উন্নয়নে। \r\n\r\n২০০৮ সালে পোলিও প্রতিরোধের জন্য বিশ্ব স্বাস্থ্য সংস্থাকে ৬৮ কোটি ২৩ লাখ ডলার অনুদান দেন বিল গেটস। এর আগে এত অনুদান পায়নি বিশ্ব স্বাস্থ্য সংস্থা। বর্তমানে মহামারি করোনাভাইরাস মোকাবিলায় বিশ্ব স্বাস্থ্য সংস্থাকে ১৫ কোটি ডলারের আর্থিক সহায়তার ঘোষণা দিয়েছে বিল অ্যান্ড মেলিন্ডা গেটস ফাউন্ডেশন। প্রয়োজনে তা ২৫ কোটি ডলারের উন্নীত করার আশ্বাস দিয়েছেন বিল গেটস।\r\n\r\nএই ফাউন্ডেশনের অন্যতম দাতা আরেক ধনকুবের ওয়ারেন বাফেট। গত বছর তাঁর প্রতিষ্ঠান বার্কশায়ার হ্যাথওয়ের ২০০ কোটি ডলারের স্টক অনুদান দিয়েছেন তিনি। ১৯৯৪ থেকে ২০১৮ সাল পর্যন্ত এই ফাউন্ডেশনে ৩ হাজার ৬০০ কোটি ডলার দিয়েছেন গেটস ও মেলিন্ডা দম্পতি। ২০১৯ সালের শেষ পর্যন্ত আর্থিক প্রতিবেদন অনুযায়ী এই ফাউন্ডেশনের আকার ৪ হাজার ৩৩০ কোটি ডলার। এই আকার ৫ হাজার কোটি ডলারে নিয়ে যাওয়ার লক্ষ্য বিল গেটস ও মেলিন্ডা গেটসের। \r\n\r\nসূত্র: ভক্স ডট কম, রয়টার্স', 'receive', '2021-05-04 07:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `zmessage_35`
--

CREATE TABLE `zmessage_35` (
  `message_id` int(6) UNSIGNED NOT NULL,
  `sendto` int(6) NOT NULL,
  `message` text DEFAULT NULL,
  `type` text DEFAULT NULL,
  `date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `zmessage_35`
--

INSERT INTO `zmessage_35` (`message_id`, `sendto`, `message`, `type`, `date`) VALUES
(1, 19, 'dd', 'receive', '2021-05-04 05:44:37'),
(2, 19, 'ff', 'receive', '2021-05-04 05:48:04'),
(3, 19, 'gg', 'receive', '2021-05-04 05:53:16'),
(4, 19, 'fff', 'send', '2021-05-04 06:02:00'),
(5, 19, 'ffffffffffffffffffffffffffffffffffffff', 'receive', '2021-05-04 06:05:50'),
(6, 19, 'ffffffffffffffff', 'receive', '2021-05-04 06:05:54'),
(7, 19, 'dd', 'send', '2021-05-04 06:30:40'),
(8, 19, 'cc', 'send', '2021-05-04 06:31:05'),
(9, 19, 'frbbubbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb', 'send', '2021-05-04 07:43:44'),
(10, 19, 'ffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff', 'receive', '2021-05-04 07:48:44'),
(11, 19, 'বিল অ্যান্ড মেলিন্ডা গেটস ফাউন্ডেশন\r\n১৯৮৭ সালে মাইক্রোসফটে প্রোডাক্ট ম্যানেজার হিসেবে যোগ দিয়েছিলেন মেলিন্ডা। সে সময় থেকে দুজনের মধ্যে বন্ধুত্বের সম্পর্ক গড়ে ওঠে। একসময় তা প্রেম পর্যন্ত গড়ায়। ১৯৯৪ সালে বিয়ে করেন গেটস ও মেলিন্ডা। বিয়ের ছয় বছর পর তাঁরা যৌথভাবে গড়ে তোলেন দাতব্য প্রতিষ্ঠান ‘বিল অ্যান্ড মেলিন্ডা গেটস ফাউন্ডেশন’। বিশ্বের বিভিন্ন স্থানে নানামুখী কাজ করছে এই ফাউন্ডেশন। বিশ্বজুড়ে সংক্রামক রোগব্যাধির বিরুদ্ধে লড়াই ও শিশুদের টিকাদানে উৎসাহিত করতে শুরু থেকে এখন পর্যন্ত এ ফাউন্ডেশন প্রায় ৫৪ বিলিয়ন ডলার খরচ করেছে। ক্ষুধা-দারিদ্র্যমুক্ত, সচেতন, শিক্ষিত ও স্বাস্থ্যবান একটি বিশ্ব গড়ে তোলা এ সংস্থার প্রধান উদ্দেশ্য। বিল অ্যান্ড মেলিন্ডা গেটস ফাউন্ডেশন প্রতিবছর প্রায় পাঁচ বিলিয়ন ডলার ব্যয় করে স্বাস্থ্য খাতের উন্নয়নে। \r\n\r\n২০০৮ সালে পোলিও প্রতিরোধের জন্য বিশ্ব স্বাস্থ্য সংস্থাকে ৬৮ কোটি ২৩ লাখ ডলার অনুদান দেন বিল গেটস। এর আগে এত অনুদান পায়নি বিশ্ব স্বাস্থ্য সংস্থা। বর্তমানে মহামারি করোনাভাইরাস মোকাবিলায় বিশ্ব স্বাস্থ্য সংস্থাকে ১৫ কোটি ডলারের আর্থিক সহায়তার ঘোষণা দিয়েছে বিল অ্যান্ড মেলিন্ডা গেটস ফাউন্ডেশন। প্রয়োজনে তা ২৫ কোটি ডলারের উন্নীত করার আশ্বাস দিয়েছেন বিল গেটস।\r\n\r\nএই ফাউন্ডেশনের অন্যতম দাতা আরেক ধনকুবের ওয়ারেন বাফেট। গত বছর তাঁর প্রতিষ্ঠান বার্কশায়ার হ্যাথওয়ের ২০০ কোটি ডলারের স্টক অনুদান দিয়েছেন তিনি। ১৯৯৪ থেকে ২০১৮ সাল পর্যন্ত এই ফাউন্ডেশনে ৩ হাজার ৬০০ কোটি ডলার দিয়েছেন গেটস ও মেলিন্ডা দম্পতি। ২০১৯ সালের শেষ পর্যন্ত আর্থিক প্রতিবেদন অনুযায়ী এই ফাউন্ডেশনের আকার ৪ হাজার ৩৩০ কোটি ডলার। এই আকার ৫ হাজার কোটি ডলারে নিয়ে যাওয়ার লক্ষ্য বিল গেটস ও মেলিন্ডা গেটসের। \r\n\r\nসূত্র: ভক্স ডট কম, রয়টার্স', 'send', '2021-05-04 07:49:40');

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
-- Indexes for table `zcomments_22`
--
ALTER TABLE `zcomments_22`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `zmessage_19`
--
ALTER TABLE `zmessage_19`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `zmessage_35`
--
ALTER TABLE `zmessage_35`
  ADD PRIMARY KEY (`message_id`);

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
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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

--
-- AUTO_INCREMENT for table `zcomments_22`
--
ALTER TABLE `zcomments_22`
  MODIFY `comment_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zmessage_19`
--
ALTER TABLE `zmessage_19`
  MODIFY `message_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `zmessage_35`
--
ALTER TABLE `zmessage_35`
  MODIFY `message_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
