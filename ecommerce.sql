-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 30, 2024 at 05:15 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

DROP TABLE IF EXISTS `banners`;
CREATE TABLE IF NOT EXISTS `banners` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `subject` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `imgage` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `url` varchar(155) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `button_txt` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int NOT NULL DEFAULT '1',
  `dstatus` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `title`, `subject`, `description`, `imgage`, `url`, `button_txt`, `status`, `dstatus`, `created_at`, `updated_at`) VALUES
(63, 'Saliderimg 1', ' youtuber ', 'Hallo dear i am ankit saini  from sambhar lake ', 'img1698910581_31552.jpg', 'http://localhost/ecommerce/', 'Red', 1, 0, '2023-11-02 07:34:43', '2023-11-02 07:38:19'),
(64, 'saliderimg 2', 'Blog', 'Hallo dera this is a banner img , this is use in salder img', 'img1698910848_91350.jpg', 'http://localhost/ecommerce/admin/banners/add.php', 'Green', 1, 0, '2023-11-02 07:39:42', '2023-11-02 07:40:48'),
(65, 'Saliderimg 3', ' youtuber ', 'Hallo dear this is a amezing salider img ', 'banners_1698911076_56253.png', 'http://ankitvlogr.liveblog365.com/2022/12/01/hello-world/', 'Pink', 1, 0, '2023-11-02 07:44:36', '2023-11-02 07:44:36'),
(66, 'Saliderimage 4', ' youtuber ', 'Hallo dear i am ankit saini this is a salider image', 'banners_1698911816_44634.png', 'http://localhost/ecommerce/admin/banners/add.php', 'Green', 1, 0, '2023-11-02 07:56:56', '2023-11-02 07:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int DEFAULT '1',
  `dstatus` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `dstatus`, `created_at`, `updated_at`) VALUES
(23, 'Nicky', 'banners_1698916133_8017.png', 1, 0, '2023-11-02 09:08:53', '2023-11-02 09:08:53'),
(24, 'Puma ', 'banners_1698916151_30809.png', 1, 0, '2023-11-02 09:09:11', '2023-11-02 09:09:11'),
(25, 'Addidash', 'banners_1698916171_68764.png', 1, 0, '2023-11-02 09:09:31', '2023-11-02 09:09:31'),
(26, 'Zara', 'banners_1698916247_60495.png', 1, 0, '2023-11-02 09:10:47', '2023-11-02 09:10:47'),
(27, 'Apple', 'banners_1698916463_91688.jpeg', 1, 0, '2023-11-02 09:14:23', '2023-11-02 09:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

DROP TABLE IF EXISTS `card`;
CREATE TABLE IF NOT EXISTS `card` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_id` int NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `color_id` int NOT NULL,
  `size_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=428 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`id`, `product_id`, `user_id`, `qty`, `color_id`, `size_id`) VALUES
(427, 106, 147, 1, 4, 4),
(367, 104, 149, 1, 0, 0),
(426, 106, 147, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `dstatus` int NOT NULL DEFAULT '0',
  `display_menu` int DEFAULT '0',
  `display_home` int DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `status`, `dstatus`, `display_menu`, `display_home`, `created_at`, `updated_at`) VALUES
(32, 'zara', 'shekhar1698165004_61478.jpg', 1, 1, NULL, NULL, '2023-10-24 18:30:04', '2023-10-24 18:30:04'),
(40, 'baike', 'shekhar1698165014_80756.webp', 1, 1, NULL, NULL, '2023-10-24 18:30:14', '2023-10-24 18:30:14'),
(41, 'gamse ', 'sub_category1698165703_32725.webp', 1, 1, NULL, NULL, '2023-10-24 18:41:43', '2023-10-24 18:41:43'),
(42, 'toy', 'sub_category1698165831_10650.jpeg', 1, 1, NULL, NULL, '2023-10-24 18:43:51', '2023-10-24 18:43:51'),
(43, 'tayarr', 'sub_category1698165945_20753.png', 1, 1, NULL, NULL, '2023-10-25 06:12:07', '2023-10-25 06:12:07'),
(44, 'zara', 'sub_category1698293334_19903.jpg', 1, 1, NULL, NULL, '2023-10-26 06:08:54', '2023-10-26 06:08:54'),
(45, 'toy', 'sub_category1698293613_24949.webp', 1, 1, NULL, NULL, '2023-10-26 06:13:33', '2023-10-26 06:13:33'),
(46, 'h', 'sub_category1698386733_141.webp', 1, 1, 0, 0, '2023-10-27 08:05:33', '2023-10-27 08:05:33'),
(47, 'h', 'sub_category1698386792_82341.webp', 1, 1, 0, 0, '2023-10-27 08:06:32', '2023-10-27 08:06:32'),
(48, 'h', 'sub_category1698387208_45905.webp', 1, 1, 0, 0, '2023-10-27 08:13:28', '2023-10-27 08:13:28'),
(49, 'shekhar', 'sub_category1698387648_52945.jpeg', 1, 1, 0, 0, '2023-10-27 08:20:48', '2023-10-27 08:20:48'),
(50, 'shekaher', 'shekhar1698387855_92293.png', 2, 1, 0, 0, '2023-10-27 08:24:15', '2023-10-27 08:24:15'),
(51, 'saini', 'sub_category1698387943_82476.jpeg', 1, 1, 0, 0, '2023-10-27 08:25:43', '2023-10-27 08:25:43'),
(52, 'ee', 'sub_category1698390624_59368.webp', 1, 1, 0, 0, '2023-10-27 09:10:24', '2023-10-27 09:10:24'),
(53, 'agstwgteg', 'sub_category1698390919_93465.webp', 2, 1, 2, 2, '2023-10-27 09:15:19', '2023-10-27 09:15:19'),
(54, 'agstwgteg', 'sub_category1698390972_65371.webp', 2, 1, 2, 2, '2023-10-27 09:16:12', '2023-10-27 09:16:12'),
(55, 'asdfg', 'sub_category1698390999_96285.jpg', 1, 1, 1, 1, '2023-10-27 09:16:39', '2023-10-27 09:16:39'),
(56, 'vijeshe kum', 'sub_category1698391136_71047.webp', 1, 1, 1, 1, '2023-10-27 09:18:56', '2023-10-27 09:18:56'),
(57, 'shekhar', '', 1, 1, NULL, NULL, '2023-10-29 08:37:44', NULL),
(58, 'shekhar', '', 1, 1, NULL, NULL, '2023-10-29 08:37:53', NULL),
(59, 'hello', 'sub_category1698594119_40885.jpg', 1, 1, 1, 1, '2023-10-29 16:41:59', '2023-10-29 16:41:59'),
(60, 'shekhar', '', 1, 1, 1, NULL, '2023-10-29 08:46:45', NULL),
(61, 'saini', '', 1, 1, 1, 1, '2023-10-29 08:47:47', NULL),
(62, 'toys', 'sub_category1698596746_61421.webp', 1, 1, 1, 1, '2023-10-29 17:25:46', '2023-10-29 17:25:46'),
(63, 'shoes', 'sub_category1698597019_96458.jpeg', 1, 1, 1, 1, '2023-10-29 17:30:19', '2023-10-29 17:30:19'),
(64, 'mobile', 'sub_category1698597047_59687.webp', 1, 1, 1, 1, '2023-10-29 17:30:47', '2023-10-29 17:30:47'),
(65, 'cloth', 'sub_category1698638460_20093.webp', 1, 1, 1, 1, '2023-10-30 05:01:00', '2023-10-30 05:01:00'),
(66, 'zara ', 'sub_category1698646811_13204.jpg', 1, 1, 1, 1, '2023-10-30 07:20:11', '2023-10-30 07:20:11'),
(67, 'MEN ', 'sub_category1698646877_49763.webp', 1, 1, 1, 1, '2023-10-30 07:21:17', '2023-10-30 07:21:17'),
(68, 'zara jackect', 'sub_category1698647529_94419.jpeg', 1, 1, 1, 1, '2023-10-30 07:32:09', '2023-10-30 07:32:09'),
(69, 'addidas shose', 'sub_category1698647596_60078.png', 1, 1, 1, 1, '2023-10-30 07:33:16', '2023-10-30 07:33:16'),
(70, 'zara', 'sub_category1698647741_1335.jpeg', 1, 1, 2, 2, '2023-10-30 07:35:41', '2023-10-30 07:35:41'),
(71, 'shekhar ', 'shekhar1698647861_44239.jpeg', 1, 1, 0, 0, '2023-10-30 07:37:41', '2023-10-30 07:37:41'),
(72, 'phone', 'sub_category1698767821_84749.jpeg', 1, 1, 1, 1, '2023-10-31 16:57:01', '2023-10-31 16:57:01'),
(73, 'Electionce', 'sub_category1698768113_99638.webp', 1, 1, 1, 1, '2023-10-31 17:01:53', '2023-10-31 17:01:53'),
(74, 'books ', 'shekhar1698811438_32735.jpg', 1, 1, 1, 1, '2023-11-01 05:04:31', '2023-11-01 05:04:31'),
(75, 'toys', 'sub_category1698768269_2316.jpg', 1, 1, 1, 1, '2023-10-31 17:04:29', '2023-10-31 17:04:29'),
(76, 'Ankit saini', 'banners_1698853471_54412.png', 1, 1, 1, 1, '2023-11-01 16:44:31', '2023-11-01 16:44:31'),
(77, 'ww', 'banners_1698853728_69565.png', 1, 1, 1, 1, '2023-11-01 16:48:48', '2023-11-01 16:48:48'),
(78, ' Electronics', 'banners_1698912076_49208.jpeg', 1, 0, 1, 1, '2023-11-02 08:01:16', '2023-11-02 08:01:16'),
(79, 'Cloths', 'img1698912213_78442.avif', 1, 0, 1, 1, '2023-11-02 08:02:46', '2023-11-02 08:50:33'),
(80, 'House', 'img1698915200_63394.webp', 1, 0, 1, 1, '2023-11-02 08:06:20', '2023-12-12 09:23:47'),
(81, 'Phones', 'banners_1698912522_6512.webp', 1, 0, 1, 1, '2023-11-02 08:08:42', '2023-11-02 08:08:42'),
(82, 'Toys', 'banners_1698912689_98768.webp', 1, 0, 1, 1, '2023-11-02 08:11:29', '2023-11-02 08:11:29'),
(83, 'Book', 'banners_1698913040_14206.jpeg', 1, 0, 1, 1, '2023-11-02 08:17:20', '2023-11-02 08:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `id` int NOT NULL AUTO_INCREMENT,
  `city_name` text NOT NULL,
  `country_id` int NOT NULL,
  `state_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `city_name`, `country_id`, `state_id`, `created_at`, `updated_at`) VALUES
(14, 'Olympia', 24, 17, '2023-12-23 13:43:23', '2023-12-23 13:43:23'),
(13, 'Jaipur', 23, 15, '2023-12-23 13:34:47', '2023-12-23 13:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

DROP TABLE IF EXISTS `color`;
CREATE TABLE IF NOT EXISTS `color` (
  `color_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `hex_value` varchar(200) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `dstatus` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`color_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `name`, `hex_value`, `status`, `dstatus`) VALUES
(1, 'Black', '#000000\n', 1, 0),
(2, 'Red', '#FF0000', 1, 0),
(3, 'Pink', ' #ff3399\n', 1, 0),
(4, ' Green ', '#00FF00', 1, 0),
(5, 'Orange', '#FFA500\n', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `configration`
--

DROP TABLE IF EXISTS `configration`;
CREATE TABLE IF NOT EXISTS `configration` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `size_id` int NOT NULL,
  `color_id` int NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `configration`
--

INSERT INTO `configration` (`id`, `product_id`, `size_id`, `color_id`, `qty`) VALUES
(39, 77, 2, 5, 0),
(40, 78, 3, 5, 0),
(41, 79, 4, 5, 0),
(42, 80, 6, 5, 0),
(43, 81, 5, 5, 0),
(44, 82, 7, 5, 0),
(45, 83, 2, 5, 0),
(46, 84, 2, 5, 0),
(47, 85, 2, 5, 0),
(48, 86, 2, 5, 0),
(49, 87, 2, 11, 8),
(50, 88, 2, 12, 0),
(51, 89, 3, 1, 100),
(52, 89, 2, 10, 200),
(53, 0, 4, 10, 1),
(54, 89, 4, 5, 30),
(55, 89, 4, 11, 400),
(56, 90, 2, 0, 110),
(58, 32, 3, 2, 22),
(59, 32, 4, 12, 13),
(61, 90, 0, 0, 1),
(62, 94, 1, 0, 0),
(63, 95, 0, 0, 0),
(64, 96, 1, 3, 1222),
(65, 98, 0, 0, 0),
(66, 99, 2, 1, 88),
(67, 99, 1, 3, 1444),
(68, 101, 1, 4, 454),
(69, 96, 5, 4, 1222),
(70, 96, 2, 1, 2221),
(71, 96, 4, 1, 666),
(72, 102, 1, 1, 322),
(73, 103, 1, 2, 122),
(74, 103, 2, 3, 122),
(75, 103, 2, 1, 122),
(76, 103, 1, 2, 122),
(77, 103, 4, 1, 32),
(78, 102, 2, 2, 1221),
(79, 102, 3, 1, 122),
(80, 103, 4, 1, 9),
(81, 103, 1, 3, 12),
(82, 103, 1, 3, 12),
(83, 103, 1, 3, 12),
(84, 103, 2, 2, 33),
(85, 106, 1, 1, 20),
(88, 108, 5, 1, 54),
(89, 109, 3, 2, 54),
(96, 106, 2, 2, 10),
(97, 106, 3, 3, 15),
(98, 106, 4, 4, 19);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int NOT NULL AUTO_INCREMENT,
  `country_name` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `country_name`, `created_at`, `updated_at`) VALUES
(24, 'USA', '2023-12-23 13:17:26', '2023-12-23 13:17:26'),
(23, 'INDIA', '2023-12-23 13:17:09', '2023-12-23 13:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `coupan_code` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL DEFAULT '0' COMMENT '0=all user\r\n',
  `type` int NOT NULL DEFAULT '1' COMMENT '1=percentage\r\n2=fixed amount',
  `amount` double NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `dstatus` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `coupan_code`, `user_id`, `type`, `amount`, `start_date`, `end_date`, `status`, `dstatus`, `created_at`, `updated_at`) VALUES
(40, '1234', 147, 1, 40, '2024-01-02', '2024-01-31', 1, 0, '2024-01-02 14:17:48', '2024-01-02 14:17:48'),
(41, '4321', 155, 2, 5000, '2024-01-02', '2024-01-31', 1, 0, '2024-01-02 14:18:33', '2024-01-02 14:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `galleryimg`
--

DROP TABLE IF EXISTS `galleryimg`;
CREATE TABLE IF NOT EXISTS `galleryimg` (
  `gallery_id` int NOT NULL AUTO_INCREMENT,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `color_id` int NOT NULL DEFAULT '0',
  `product_id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`gallery_id`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `galleryimg`
--

INSERT INTO `galleryimg` (`gallery_id`, `created_at`, `color_id`, `product_id`, `name`) VALUES
(231, '2023-12-24 07:33:55', 1, 106, 'banners_1703403235_84138.jpeg'),
(233, '2023-12-25 05:13:35', 2, 106, 'banners_1703481215_59152.jpeg'),
(235, '2023-12-25 05:13:35', 4, 106, 'banners_1703481215_93185.jpeg'),
(236, '2023-12-25 05:15:51', 3, 106, 'banners_1703481351_94810.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `onlinepay`
--

DROP TABLE IF EXISTS `onlinepay`;
CREATE TABLE IF NOT EXISTS `onlinepay` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `payment_id` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `payment_status` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `amount` int NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `onlinepay`
--

INSERT INTO `onlinepay` (`id`, `order_id`, `payment_id`, `payment_status`, `amount`, `date`) VALUES
(20, 273, 'ch_3OWDeFGlQkVmVwGJ0gVpTl2y', 'succeeded', 877, '2024-01-08'),
(21, 275, 'ch_3OWIxIGlQkVmVwGJ1spnVe3J', 'succeeded', 800, '2024-01-08'),
(22, 276, 'ch_3OWJjrGlQkVmVwGJ0Evdro3t', 'succeeded', 1334, '2024-01-08');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_no` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `f_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `l_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `address` varchar(255) NOT NULL,
  `country` int NOT NULL DEFAULT '0',
  `state` int NOT NULL DEFAULT '0',
  `city` int NOT NULL DEFAULT '0',
  `phon_no` varchar(13) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `pincode` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  `sub_total` double(20,2) NOT NULL,
  `coupon_amt` double(20,2) NOT NULL,
  `shipping_amt` double(20,2) NOT NULL,
  `grand_total` double(20,2) NOT NULL,
  `payment_type` int NOT NULL DEFAULT '1' COMMENT '1=>COD,2=>Online',
  `order_status` int NOT NULL DEFAULT '0' COMMENT '0=>Panding,1=>Confirmed,2=>Delived,3=>Cancelled',
  `shipping_status` int NOT NULL DEFAULT '0' COMMENT '0=>Panding, 1=>Shipped',
  `shipping_date` date DEFAULT NULL,
  `delivery_date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=277 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `f_name`, `l_name`, `address`, `country`, `state`, `city`, `phon_no`, `pincode`, `user_id`, `sub_total`, `coupon_amt`, `shipping_amt`, `grand_total`, `payment_type`, `order_status`, `shipping_status`, `shipping_date`, `delivery_date`, `created_at`, `updated_at`) VALUES
(276, 'ORD276', 'Ankit', 'Saini', 'Sambhar Lake', 23, 15, 13, '2147483647', '303604', 147, 1390.00, 556.00, 500.00, 1334.00, 2, 1, 0, '2024-01-08', '0000-00-00', '2024-01-08 00:00:00', '2024-01-08 00:00:00'),
(273, 'ORD273', 'Ankit', 'Saini', 'Sambhar Lake', 23, 15, 13, '2147483647', '303604', 147, 677.00, 0.00, 200.00, 877.00, 2, 1, 0, '2024-01-08', '0000-00-00', '2024-01-08 00:00:00', '2024-01-08 00:00:00'),
(274, 'ORD274', 'Ankit', 'Saini', 'Sambhar Lake', 23, 15, 13, '2147483647', '303604', 147, 399.00, 0.00, 100.00, 499.00, 1, 1, 0, '2024-01-08', '0000-00-00', '2024-01-08 00:00:00', '2024-01-08 00:00:00'),
(275, 'ORD275', 'Ankit', 'Saini', 'Sambhar Lake', 23, 15, 13, '2147483647', '303604', 147, 834.00, 333.60, 300.00, 800.40, 2, 1, 0, '2024-01-08', '0000-00-00', '2024-01-08 00:00:00', '2024-01-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_coupons`
--

DROP TABLE IF EXISTS `order_coupons`;
CREATE TABLE IF NOT EXISTS `order_coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `coupon_no` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=182 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_coupons`
--

INSERT INTO `order_coupons` (`id`, `order_id`, `coupon_no`, `created_at`) VALUES
(177, 253, '1234', '2024-01-05 00:00:00'),
(179, 259, '1234', '2024-01-08 00:00:00'),
(180, 275, '1234', '2024-01-08 00:00:00'),
(181, 276, '1234', '2024-01-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
CREATE TABLE IF NOT EXISTS `order_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` double(20,2) NOT NULL,
  `qty` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1016 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `order_id`, `product_id`, `name`, `price`, `qty`) VALUES
(981, 253, 106, 'Mens sorts', 278.00, 1),
(982, 254, 106, 'Mens sorts', 278.00, 1),
(983, 255, 106, 'Mens sorts', 278.00, 1),
(984, 255, 108, 'Blanket', 56799.00, 3),
(985, 255, 106, 'Mens sorts', 278.00, 4),
(986, 256, 106, 'Mens sorts', 278.00, 1),
(987, 256, 108, 'Blanket', 56799.00, 3),
(988, 256, 106, 'Mens sorts', 278.00, 4),
(989, 257, 106, 'Mens sorts', 278.00, 1),
(990, 257, 108, 'Blanket', 56799.00, 3),
(991, 257, 106, 'Mens sorts', 278.00, 4),
(992, 258, 106, 'Mens sorts', 278.00, 1),
(993, 258, 106, 'Mens sorts', 278.00, 2),
(994, 259, 106, 'Mens sorts', 278.00, 1),
(995, 259, 106, 'Mens sorts', 278.00, 2),
(996, 259, 106, 'Mens sorts', 278.00, 3),
(997, 268, 106, 'Mens sorts', 278.00, 1),
(998, 268, 112, 'Head Phne', 399.00, 2),
(999, 269, 106, 'Mens sorts', 278.00, 1),
(1000, 269, 112, 'Head Phne', 399.00, 2),
(1001, 270, 106, 'Mens sorts', 278.00, 1),
(1002, 270, 112, 'Head Phne', 399.00, 2),
(1003, 271, 106, 'Mens sorts', 278.00, 1),
(1004, 271, 112, 'Head Phne', 399.00, 2),
(1005, 272, 106, 'Mens sorts', 278.00, 1),
(1006, 272, 112, 'Head Phne', 399.00, 2),
(1007, 273, 106, 'Mens sorts', 278.00, 1),
(1008, 273, 112, 'Head Phne', 399.00, 2),
(1009, 274, 112, 'Head Phne', 399.00, 1),
(1010, 275, 106, 'Mens sorts', 278.00, 2),
(1011, 275, 106, 'Mens sorts', 278.00, 3),
(1012, 276, 106, 'Mens sorts', 278.00, 1),
(1013, 276, 106, 'Mens sorts', 278.00, 2),
(1014, 276, 106, 'Mens sorts', 278.00, 4),
(1015, 276, 106, 'Mens sorts', 278.00, 5);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `banner` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `dstatus` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `description`, `banner`, `status`, `dstatus`, `created_at`, `updated_at`) VALUES
(1, 'n', '', '', 13, 1, '2023-10-25 06:40:05', '2023-10-25 06:40:05'),
(2, 'saini', '', '', 13, 1, '2023-10-25 06:43:42', '2023-10-25 06:43:42'),
(16, 'i phone 15 pro max', 'Hallo dear costmers This is i phone 15 pro max this is very costay pese this phone price is Rs 1,5000 this phone Ram Rom  is  128 ,512 this is vere  amezing  and intresting.', 'img_1699987152_92601.webp', 1, 0, '2023-11-14 18:39:12', '2023-11-14 18:39:12');

-- --------------------------------------------------------

--
-- Table structure for table `prdoucts`
--

DROP TABLE IF EXISTS `prdoucts`;
CREATE TABLE IF NOT EXISTS `prdoucts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int NOT NULL,
  `subcategory_id` int NOT NULL,
  `brand_id` int NOT NULL DEFAULT '0',
  `price` double(20,2) NOT NULL,
  `mrp_price` double(20,2) NOT NULL,
  `qty` int NOT NULL,
  `main_image` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_featured` int NOT NULL DEFAULT '0',
  `is_latest` int NOT NULL DEFAULT '0',
  `product_type` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `dstatus` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prdoucts`
--

INSERT INTO `prdoucts` (`id`, `code`, `name`, `description`, `category_id`, `subcategory_id`, `brand_id`, `price`, `mrp_price`, `qty`, `main_image`, `is_featured`, `is_latest`, `product_type`, `status`, `dstatus`, `created_at`, `updated_at`) VALUES
(104, '1234321', 'i phone 15 Pro mx', '<p>Hallo  dear this is a i phone 15 pro max in phone ram rom is 125 , 512  </p>', 81, 61, 27, 123000.00, 158000.00, 180, 'Products_1702229797_17760.jpeg', 1, 1, 1, 1, 0, '2023-11-21 02:55:13', '2023-12-10 17:36:37'),
(105, '3433334', 'Childs Toys', '<p>This is a best childs toys it is very simple products&nbsp; and your child is very happy&nbsp;</p>', 82, 64, 24, 365.00, 456.00, 456, 'banners_1700535569_28662.webp', 1, 1, 0, 1, 0, '2023-11-21 02:59:29', '2023-11-21 02:59:29'),
(106, '456897654', 'Mens sorts', 'this is very comftable mens sort . ', 79, 56, 25, 278.00, 376.00, 45, 'Products_1700538125_21283.jpeg', 1, 1, 2, 1, 0, '2023-11-21 03:02:49', '2023-12-24 07:32:13'),
(107, '98765', 'Rach dad poor dad', '<p>This is a vere intresting book rach dade and poor dade .</p>', 83, 52, 26, 788.00, 1167.00, 65, 'banners_1700535913_68520.webp', 1, 1, 0, 1, 0, '2023-11-21 03:05:13', '2023-11-21 03:05:13'),
(108, '9876', 'Blanket', '<p>This is vere comftable blacket</p>', 79, 57, 23, 56799.00, 65699.00, 54, 'banners_1700536121_47305.webp', 1, 1, 2, 1, 1, '2023-11-21 03:08:41', '2023-11-21 03:08:41'),
(109, '7654', 'kuraty', '<p>This is girls kurty&nbsp;</p>', 79, 57, 27, 543.00, 654.00, 544, 'banners_1700536293_50792.jpeg', 1, 1, 2, 1, 1, '2023-11-21 03:11:33', '2023-11-21 03:11:33'),
(110, '635654', 'Samsung', '<p>This is samsung altra yg-45</p>', 81, 62, 24, 268999.00, 350000.00, 543, 'banners_1700536415_72967.webp', 1, 1, 0, 1, 0, '2023-11-21 03:13:35', '2023-11-21 03:13:35'),
(111, '6543', 'Powar Bank', '<p>This is power bank </p>', 78, 54, 24, 4999.00, 5799.00, 3654, 'Products_1700570832_84472.webp', 1, 1, 0, 1, 1, '2023-11-21 03:15:02', '2023-11-21 12:47:12'),
(112, '76543', 'Head Phne', 'This is head phone', 78, 54, 24, 399.00, 499.00, 345, 'banners_1700643120_87987.jpeg', 1, 1, 0, 1, 0, '2023-11-22 08:52:00', '2023-11-22 08:52:00'),
(113, '354322345', 'Electronics sircit', '<p>This is&nbsp;Electronics sircit</p>', 78, 54, 25, 599.00, 799.00, 6545, 'banners_1700643274_73699.jpeg', 1, 1, 0, 1, 0, '2023-11-22 08:54:34', '2023-11-22 08:54:34'),
(114, '654', 'Sony  LCD', '<p>This is L C D </p>', 78, 54, 27, 7999.00, 78999.00, 5434, 'banners_1700643439_72258.jpeg', 1, 1, 0, 1, 0, '2023-11-22 08:57:19', '2023-12-22 14:04:51');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `site_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `site_contact` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `site_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `site_fav_icon` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `site_logo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `header_code` text COLLATE utf8mb4_general_ci,
  `footer_code` text COLLATE utf8mb4_general_ci,
  `facebook_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `insta_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `twitter_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `youtub_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `linkdin_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `site_email`, `site_contact`, `site_address`, `site_fav_icon`, `site_logo`, `header_code`, `footer_code`, `facebook_url`, `insta_url`, `twitter_url`, `youtub_url`, `linkdin_url`, `updated_at`) VALUES
(1, 'EszyShop.com', 'ankit_saini09@gmail.com', 'ankit_saini09@gmail.com', 'Sambhar Lake', 'icon_1704719826_315.png', 'logo_1704719768_27447.png', '856474434', '4321232', 'http://localhost/phpmyadmin/index.php?route=/table/change&db=ecommerce&table=setting', 'http://localhost/phpmyadmin/index.php?route=/table/change&db=ecommerce&table=setting', 'http://localhost/phpmyadmin/index.php?route=/table/change&db=ecommerce&table=setting', 'http://localhost/ecommerce/admin/settings/edit.php', 'http://localhost/phpmyadmin/index.php?route=/table/change&db=ecommerce&table=setting', '2024-01-08 13:17:06');

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

DROP TABLE IF EXISTS `size`;
CREATE TABLE IF NOT EXISTS `size` (
  `size_id` int NOT NULL AUTO_INCREMENT,
  `size_name` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `size_value` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `dstatus` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`size_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `size_name`, `size_value`, `status`, `dstatus`) VALUES
(1, ' S', 9, 1, 0),
(2, 'M', 8, 1, 0),
(3, 'L', 7, 1, 0),
(4, 'XL', 6, 1, 0),
(5, 'XXL', 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `id` int NOT NULL AUTO_INCREMENT,
  `state_name` text NOT NULL,
  `country_id` int NOT NULL,
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state_name`, `country_id`, `created_at`, `updated_at`) VALUES
(17, 'Washington ', 24, 2023, 2023),
(15, 'Rajasthan', 23, 2023, 2023);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE IF NOT EXISTS `sub_category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `dstatus` int NOT NULL DEFAULT '0',
  `category_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `categorty_id` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`id`, `name`, `image`, `status`, `dstatus`, `category_id`, `created_at`, `updated_at`) VALUES
(33, 'shart', 'subcategory_1698165166_70688.jpg', 2, 1, 32, '2023-10-24 18:32:46', '2023-10-24 18:32:46'),
(34, 'MEN', 'subcategory_1698165181_89665.webp', 1, 1, 40, '2023-10-24 18:33:01', '2023-10-24 18:33:01'),
(35, 'Riding', 'subcategory_1698165753_72932.webp', 1, 1, 41, '2023-10-24 18:42:33', '2023-10-24 18:42:33'),
(36, 'tedibiyar', 'subcategory_1698165880_20605.jpeg', 1, 1, 42, '2023-10-24 18:44:40', '2023-10-24 18:44:40'),
(37, 'jacketts', 'subcategory_1698166026_62921.jpg', 1, 1, 43, '2023-10-24 18:48:11', '2023-10-24 18:48:11'),
(38, 'jinns', 'subcategory_1698293359_62647.jpg', 1, 1, 44, '2023-10-26 06:09:19', '2023-10-26 06:09:19'),
(39, 'robot', 'subcategory_1698293647_80063.webp', 1, 1, 42, '2023-10-26 06:14:07', '2023-10-26 06:14:07'),
(40, 'ti shart', 'subcategory_1698638562_16173.jpg', 1, 1, 65, '2023-10-30 05:02:42', '2023-10-30 05:02:42'),
(41, 'i phone ', 'subcategory_1698638671_86476.jpeg', 1, 1, 64, '2023-10-30 05:04:31', '2023-10-30 05:04:31'),
(42, ' Nike', 'subcategory_1698638792_96075.jpeg', 1, 1, 63, '2023-10-30 05:06:32', '2023-10-30 05:06:32'),
(43, 'Set for Girls', 'subcategory_1698638918_96641.jpg', 1, 1, 62, '2023-10-30 05:08:38', '2023-10-30 05:08:38'),
(44, 'iphon', 'subcategory_1698767877_35191.jpeg', 1, 1, 72, '2023-10-31 16:57:57', '2023-10-31 16:57:57'),
(45, 't.v', 'subcategory_1698768188_84457.webp', 1, 1, 73, '2023-10-31 17:03:08', '2023-10-31 17:03:08'),
(46, 'maths', 'subcategory_1698811399_92560.jpg', 1, 1, 74, '2023-11-01 05:03:19', '2023-11-01 05:03:19'),
(48, 'guns', 'subcategory_1698768389_71649.jpeg', 1, 1, 75, '2023-10-31 17:06:29', '2023-10-31 17:06:29'),
(49, 'battery', 'subcategory_1698811958_52741.jpeg', 1, 1, 73, '2023-11-01 05:12:38', '2023-11-01 05:12:38'),
(50, 'physics', 'subcategory_1698812301_40292.jpg', 1, 1, 74, '2023-11-01 05:18:21', '2023-11-01 05:18:21'),
(51, 'Ankit saini', 'subcategory1698853749_5919.png', 1, 1, 77, '2023-11-01 16:49:09', '2023-11-01 16:49:21'),
(52, 'Rach Dad Poor Dad', 'subcategory1698914469_65109.webp', 1, 0, 83, '2023-11-02 08:41:09', '2023-11-02 08:41:09'),
(53, 'The Hidan Hindus', 'subcategory1698914504_14305.webp', 1, 0, 83, '2023-11-02 08:41:44', '2023-11-02 08:41:44'),
(54, 'Pawar Bank', 'img1700638172_74200.webp', 1, 0, 78, '2023-11-02 08:44:23', '2023-11-22 07:29:32'),
(55, 'LCD TV', 'img1698918177_27818.jpeg', 1, 0, 78, '2023-11-02 08:48:08', '2023-11-02 09:42:57'),
(56, 'Short', 'subcategory1698914950_73504.webp', 1, 0, 79, '2023-11-02 08:49:10', '2023-11-02 08:49:10'),
(57, 'Kurty', 'subcategory1698915251_47673.jpeg', 1, 0, 79, '2023-11-02 08:54:11', '2023-11-02 08:54:11'),
(58, 'Blanket', 'subcategory1698915452_63385.webp', 1, 0, 80, '2023-11-02 08:57:32', '2023-11-02 08:57:32'),
(59, 'Rach dad poor dad', 'subcategory1698915499_69787.webp', 1, 1, 83, '2023-11-02 08:58:19', '2023-11-02 08:58:19'),
(60, 'Bade', 'subcategory1698915576_50896.webp', 1, 0, 80, '2023-11-02 08:59:36', '2023-11-02 08:59:36'),
(61, 'i phone', 'subcategory1698915641_35336.webp', 1, 0, 81, '2023-11-02 09:00:41', '2023-11-02 09:00:41'),
(62, 'Samsung', 'subcategory1698915713_53292.webp', 1, 0, 81, '2023-11-02 09:01:53', '2023-11-02 09:01:53'),
(63, 'BVM Grups', 'subcategory1698915810_36237.webp', 1, 0, 82, '2023-11-02 09:03:30', '2023-11-02 09:03:30'),
(64, 'Monster Truck', 'subcategory1698915936_72964.webp', 1, 0, 82, '2023-11-02 09:05:36', '2023-11-02 09:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `user_type` enum('frontend','backend','vendor') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'frontend',
  `mobile_no` varchar(13) COLLATE utf8mb4_general_ci NOT NULL,
  `profile_pic` varchar(100) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'default.png',
  `status` int NOT NULL DEFAULT '1' COMMENT '1=>Active, 2=>inative',
  `dstatus` int NOT NULL DEFAULT '0' COMMENT '0=>not Deleted,1=>Deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `mobile_no`, `profile_pic`, `status`, `dstatus`, `created_at`, `updated_at`) VALUES
(141, 'Ankit Saini', 'user@gmail.com', '123456', 'backend', '9269727062', 'image1702403051_91958.jpg', 1, 0, '2023-12-01 04:58:11', '2023-12-01 04:58:11'),
(147, 'Ankit Pawar', 'ankit@gmail.com', '123456', 'frontend', '9461675429', 'image1702015711_77409.jpg', 1, 0, '2023-12-01 11:28:20', '2023-12-01 11:28:20'),
(155, 'ANkit PAwar', 'ankitsaini@gmail.com', '123456', 'frontend', '09461675429', 'default.png', 1, 0, '2023-12-21 05:34:12', '2023-12-21 05:34:12');

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

DROP TABLE IF EXISTS `user_address`;
CREATE TABLE IF NOT EXISTS `user_address` (
  `ld` int NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `country_id` int NOT NULL,
  `address` text NOT NULL,
  `state_id` int NOT NULL,
  `city_id` int NOT NULL,
  `pincode` int NOT NULL,
  `phone` int NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `dstatus` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`ld`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`ld`, `fname`, `lname`, `country_id`, `address`, `state_id`, `city_id`, `pincode`, `phone`, `email`, `user_id`, `status`, `dstatus`, `created_at`, `updated_at`) VALUES
(22, 'Ankit', 'Saini', 23, 'Sambhar Lake', 15, 13, 303604, 2147483647, 'ankitsaini09@email.com', 147, 1, 0, '2023-12-29 00:00:00', '2023-12-29 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
CREATE TABLE IF NOT EXISTS `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `size_id` int NOT NULL,
  `color_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `size_id`, `color_id`) VALUES
(3, 147, 106, 2, 2),
(5, 147, 105, 0, 0),
(7, 147, 112, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD CONSTRAINT `sub_category_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
