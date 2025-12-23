-- Use the default Aiven database
USE defaultdb;

-- Disable the primary key requirement for the session
SET SESSION sql_require_primary_key = 0;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Table: adminpanel
--
DROP TABLE IF EXISTS `adminpanel`;
CREATE TABLE `adminpanel` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `adminpanel` (`admin_id`, `username`, `email`, `password`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Nipun Paul', 'nipun4338@gmail.com', '5892d74dbe25149c28b565df23ad9f1b', 1, '2021-04-19 22:11:58', '2021-04-19 22:11:58');

--
-- Table: author
--
DROP TABLE IF EXISTS `author`;
CREATE TABLE `author` (
  `auther_id` int(11) NOT NULL AUTO_INCREMENT,
  `author` text NOT NULL,
  PRIMARY KEY (`auther_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `author` (`auther_id`, `author`) VALUES
(1, 'রাগিব হাসান');

--
-- Table: books
--
DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `books` (`book_id`, `name`, `image`, `owner_id`, `price`, `author`, `category`, `present_condition`, `location`, `status`, `created_date`, `updated_date`) VALUES
(7, 'আমেরিকায় উচ্চশিক্ষা', 'images/books/default.jpg', '17', 0, 'রাগিব হাসান', 'শিক্ষা ও গবেষণা', '5/6 Months', 'Dhaka', 1, '2021-04-15 16:20:55', '2021-04-15 16:20:55'),
(20, 'a', 'images/books/book_pic_19227010221(5).jpg', '16', 1000, 'রাগিব হাসান', 'শিক্ষা ও গবেষণা', 'Working', 'Dhaka', 1, '2021-04-21 13:11:45', '2021-04-21 22:22:57'),
(22, 'New', 'images/books/book_pic_1528239171favicon.jpg', '35', 100, 'রাগিব হাসান', 'শিক্ষা ও গবেষণা', 'Working', 'Dhaka', 1, '2021-05-04 11:32:09', '2021-05-04 11:32:09');

--
-- Table: category
--
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `category` (`id`, `name`, `image`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Children', 'images/category/Children.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(2, 'Classic', 'images/category/classic.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(3, 'Horror', 'images/category/Horror.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(4, 'Humor', 'images/category/Humor.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(5, 'Liberation War', 'images/category/Liberation-war.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(6, 'Poem', 'images/category/Poem.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(7, 'Psychological', 'images/category/Psychological.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(8, 'Romance', 'images/category/Romance.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(9, 'Science Fiction', 'images/category/Science-fiction.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32'),
(10, 'Thriller-Mystery', 'images/category/Thriller-and-mystery.png', 1, '2021-04-15 18:35:32', '2021-04-15 18:35:32');

--
-- Table: comments
--
DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) DEFAULT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `sender_name` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table: contact
--
DROP TABLE IF EXISTS `contact`;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `message` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `message`, `date`) VALUES
(1, 'Nipun Paul', 'nipun4338@gmail.com', '01778546619', 'Ok', '2025-12-23 09:58:40');

--
-- Table: images
--
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `image_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`image_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `images` (`image_id`, `book_id`, `image`, `status`, `created_date`, `updated_date`) VALUES
(24, 20, 'images/books/book_pic_19227010221(5).jpg', 1, '2021-04-21 13:11:45', '2021-04-21 13:11:45'),
(26, 22, 'images/books/book_pic_1528239171favicon.jpg', 1, '2021-05-04 11:32:09', '2021-05-04 11:32:09');

--
-- Table: mail
--
DROP TABLE IF EXISTS `mail`;
CREATE TABLE `mail` (
  `mail_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text NOT NULL,
  `body` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`mail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `mail` (`mail_id`, `subject`, `body`, `date`) VALUES
(1, 'Working?', 'yep', '2021-05-06 07:06:08'),
(2, 'Test', 'Test', '2025-12-23 04:09:29');

--
-- Table: messages
--
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_type` text DEFAULT NULL,
  `datesent` datetime NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table: slider1
--
DROP TABLE IF EXISTS `slider1`;
CREATE TABLE `slider1` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

--
-- Table: slider2
--
DROP TABLE IF EXISTS `slider2`;
CREATE TABLE `slider2` (
  `slider_id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `slider2` (`slider_id`, `image`, `status`, `created_date`, `updated_date`) VALUES
(1, 'images/slider2/slider_pic_79bd83cc14f7dbdcafa7a2631bc8fe29.jpg', 1, '2021-04-21 20:00:32', '2021-04-21 20:00:32');

--
-- Table: user
--
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `address` text NOT NULL,
  `password` text NOT NULL,
  `hash` varchar(100) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  `active_status` varchar(255) DEFAULT NULL,
  `active_status_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`user_id`, `name`, `email`, `phone`, `address`, `password`, `hash`, `image`, `status`, `created_date`, `updated_date`, `active_status`, `active_status_date`) VALUES
(19, 'Test', 'nipun4337@gmail.com', '01778546619', 'Chaity 3, Upazilla Quarter, Joynagar', 'b9e88579af34e13717f84345039b8b4d', '482c811da5d5b4bc6d497ffa98491e38', 'images/users/user_pic_nipun4337@gmail.com.png', 1, '2021-04-20 14:06:19', '2021-04-20 14:06:19', 'Online', '2025-12-23 03:50:16'),
(21, 'Test 2', 'oprantor78@gmail.com', '01778546619', 'Chaity 3, Upazilla Quarter, Joynagar', 'b9e88579af34e13717f84345039b8b4d', 'f4f6dce2f3a0f9dada0c2b5b66452017', 'images/users/user_pic_01778546619956512780.png', 2, '2021-04-20 16:32:24', '2021-04-20 16:32:24', NULL, '2021-05-06 07:03:18'),
(35, 'Nipun Paul', 'nipun4338@gmail.com', '01778546619', 'Chaity 3, Upazilla Quarter, Joynagar', '482c811da5d5b4bc6d497ffa98491e38', '482c811da5d5b4bc6d497ffa98491e38', 'images/users/default-image.jpg', 1, '2021-05-04 11:30:47', '2021-05-04 11:30:47', 'Online', '2025-12-23 03:57:45');

--
-- Table: wishlist
--
DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL,
  PRIMARY KEY (`wishlist_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `wishlist` (`wishlist_id`, `book_id`, `user_id`, `status`, `created_date`, `updated_date`) VALUES
(1, 22, 35, 1, '2025-12-23 09:57:28', '2025-12-23 09:57:28');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
