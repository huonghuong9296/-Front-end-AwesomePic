-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 12:56 PM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `awesomepic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `password`, `created_date`, `updated_date`, `is_deleted`) VALUES
(1, 'admin1', 'admin1@gmail.com', '_}€ÍeÉjf3] ¹Ð’', '2020-12-28 16:36:44', '2020-12-28 16:57:41', 0),
(2, 'admin2', 'admin2@gmail.com', '£%kII4È·Á½òPˆ3àù', '2020-12-28 17:04:43', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED DEFAULT NULL,
  `total_price` decimal(10,0) DEFAULT 0,
  `total_quantity` int(5) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `total_price`, `total_quantity`) VALUES
(1, 5, '16', 8),
(2, 5, '40', 20),
(3, 5, '0', 0),
(4, 5, '2', 1),
(5, 5, '14', 4);

-- --------------------------------------------------------

--
-- Table structure for table `cart_detail`
--

CREATE TABLE `cart_detail` (
  `cart_id` int(6) UNSIGNED NOT NULL,
  `product_id` int(6) UNSIGNED NOT NULL,
  `quantity` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart_detail`
--

INSERT INTO `cart_detail` (`cart_id`, `product_id`, `quantity`) VALUES
(1, 1, 8),
(2, 1, 20),
(4, 1, 1),
(5, 1, 2),
(5, 3, 1),
(5, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(6) UNSIGNED NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `NAME`, `description`, `is_deleted`, `created_date`, `updated_date`, `deleted_date`) VALUES
(1, 'Animals', 'Passionate photographers have captured the most gorgeous animals in the world in their natural habitats and shared them with AwesomePic. Now you can use these photos however you wish.', 0, '2020-12-15 23:28:11', NULL, NULL),
(2, 'Building', '24.319.367 building stock photos, vectors, and illustrations are available royalty-free. Create custom image collections with your AwesomePic account. Get 10 free images now.', 0, '2020-12-15 23:30:39', '2020-12-16 00:12:43', '2020-12-16 00:24:06'),
(3, 'Portraits', 'Find only the highest quality portrait photos and portrait images here. We handpicked the portrait pictures ourselves to ensure that the best quality images are shared.', 0, '2020-12-16 00:24:27', '2020-12-16 00:24:56', NULL),
(4, 'Job', 'Find job stock im and vectors in the ages in HD and millions of other royalty-free stock photos, illustrations AwesomePic collection.', 0, '2020-12-16 22:53:44', NULL, NULL),
(5, 'Nature', 'The best images of nature landscapes, people at the beach, starry night skies, hiking in the forest, and other outdoor scenes. These free photos are CC0 licensed, so you can use them in both your personal or commercial projects without attribution.', 0, '2020-12-16 22:53:44', NULL, NULL),
(6, 'Business', 'Browse our free collection of high-resolution business backgrounds & pictures. You\'ll find stock images of entrepreneurs, small businesses & offices.', 0, '2020-12-16 22:53:44', NULL, NULL),
(7, 'Family', 'Need a free stock photo of family? Check out our gallery of beautiful and authentic family photos, all free to download and use.', 0, '2020-12-16 22:53:44', NULL, NULL),
(8, 'Holiday', 'Holiday stock photos are great for event planning or seasonal promotions. Our holiday images include important international events, religious celebrations, and cultural ceremonies. Make your special day and celebration really count with these pictures of holidays.', 0, '2020-12-16 22:53:44', NULL, NULL),
(9, 'Science', 'We have the world\'s largest collection of science stock images, including biology, astronomy, physics and chemistry. Our science stock photos cover just about everything. Take a look at royalty free science pictures for any design project.', 0, '2020-12-16 22:53:44', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE `company_info` (
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`name`, `logo`, `phone`, `email`, `address`, `city`, `country`, `description`, `created_date`, `updated_date`) VALUES
('AwesomePic', 'https://i.ibb.co/1bRjL3T/logo.png', '0123456789', 'awesompic@gmail.com', '57 Le Thi Hong Gam', 'Ho Chi Minh', 'Viet nam', 'Find the perfect royalty-free image for your next project from the world s best photo library of creative stock photos, vector art illustrations, and stock photography.', '2020-12-23 17:02:47', '2020-12-23 17:05:56');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(6) UNSIGNED NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `avatar` blob DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `company_name`, `firstname`, `lastname`, `job_title`, `facebook`, `instagram`, `twitter`, `phone`, `description`, `avatar`, `created_date`, `updated_date`, `deleted_date`, `is_deleted`) VALUES
(3, NULL, 'Quoc', 'Nguyen', 'Student', '', '', '', '123456789', '', NULL, '2020-12-17 03:13:11', NULL, NULL, 0),
(4, NULL, 'Phuongxxxx', 'Kim', 'teacher', '', '', '', '9999999990', '', NULL, '2020-12-17 03:22:05', NULL, '2020-12-17 03:36:47', 1),
(5, NULL, 'Phuonga', 'Kimb', 'Studentc', 'ax', 'by', 'cz', '9999999991', 'dd', NULL, '2020-12-17 03:23:16', '2020-12-17 03:33:40', NULL, 0),
(6, NULL, 'quoc', 'dang', 'Manager', '', '', '', '123456111', '', '', '2020-12-24 21:00:41', NULL, NULL, 0),
(7, NULL, 'qcc', 'ccccc', 'Manager', '', '', '', '34443434', '', '', '2020-12-24 21:04:49', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_search`
--

CREATE TABLE `history_search` (
  `id` int(6) UNSIGNED NOT NULL,
  `search_content` text DEFAULT NULL,
  `user_id` int(6) UNSIGNED DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED DEFAULT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `total_quantity` int(5) NOT NULL,
  `is_paid` tinyint(1) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `currency`, `total_quantity`, `is_paid`, `is_deleted`, `created_date`, `updated_date`, `deleted_date`) VALUES
(1, 6, '10000.00', '$', 213, 1, 1, '2020-12-18 02:41:30', NULL, '2020-12-18 03:18:45'),
(2, 6, '239.01', '$9', 144449, 0, 1, '2020-12-18 02:43:12', '2020-12-18 03:50:31', '2020-12-23 17:23:50'),
(3, 6, '2333.02', '$', 2313, 1, 1, '2020-12-18 03:26:18', '2020-12-18 03:50:19', '2020-12-23 17:23:53'),
(4, 4, '2313.23', '$', 232131, 0, 1, '2020-12-18 03:50:52', '2020-12-18 03:51:20', '2020-12-18 03:51:35'),
(5, 5, '139338.36', '$', 1323, 1, 0, '2020-02-23 09:26:42', '2020-12-23 17:44:45', NULL),
(6, 5, '232320.00', '', 100, 1, 0, '2020-03-23 09:26:49', '2020-12-23 17:44:59', NULL),
(7, 6, '140432.00', '$', 400, 1, 0, '2020-05-23 17:24:11', '2020-12-23 17:45:15', NULL),
(8, 15, '5555.00', '$', 100, 1, 0, '2020-01-23 17:42:17', '2020-12-23 17:45:54', NULL),
(9, 17, '44200.00', '$', 1000, 1, 0, '2020-06-23 17:41:12', '2020-12-23 17:49:46', NULL),
(10, 14, '123123.00', '$', 1230, 1, 0, '2020-12-23 17:38:59', '2020-12-23 17:49:13', NULL),
(11, 16, '46660.00', '$', 200, 1, 0, '2020-09-23 17:39:13', '2020-12-23 17:47:45', NULL),
(12, 15, '66800.00', '$', 2000, 1, 0, '2020-10-23 17:40:16', '2020-12-23 17:48:03', NULL),
(13, 11, '61438.40', '$', 344, 1, 0, '2020-11-23 17:40:27', '2020-12-23 17:48:34', NULL),
(14, 4, '0.00', '$', 0, 1, 0, '2020-04-23 17:43:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(6) UNSIGNED NOT NULL,
  `product_id` int(6) UNSIGNED NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `quantity` int(5) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_id`, `product_id`, `total_price`, `quantity`, `price`) VALUES
(5, 1, '139338.36', 1323, '105.32'),
(6, 2, '232320.00', 100, '2323.20'),
(7, 1, '3434.00', 100, '34.34'),
(7, 3, '136998.00', 300, '456.66'),
(8, 1, '5555.00', 100, '55.55'),
(9, 9, '44200.00', 1000, '44.20'),
(10, 2, '123123.00', 1230, '100.10'),
(11, 7, '46660.00', 200, '233.30'),
(12, 1, '66800.00', 2000, '33.40'),
(13, 2, '61438.40', 344, '178.60');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(6) UNSIGNED NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `src` text NOT NULL,
  `width` varchar(20) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `price` decimal(15,2) NOT NULL DEFAULT 0.00,
  `currency` varchar(10) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `NAME`, `src`, `width`, `height`, `price`, `currency`, `description`, `is_deleted`, `created_date`, `updated_date`, `deleted_date`) VALUES
(1, 'Animal-01', 'img/products/gallery/animal-05.jpg', NULL, NULL, '2.00', '$', '', 1, '2020-12-16 01:51:59', NULL, '2020-12-27 14:12:34'),
(2, 'Building-02', 'img/products/gallery/building-05.jpg', NULL, NULL, '2.00', '$', '', 1, '2020-12-16 01:55:19', '2020-12-16 08:34:27', '2020-12-27 14:12:31'),
(3, 'Portraits-03', 'img/products/gallery/portrait-06.jpg', NULL, NULL, '5.00', '$', '', 1, '2020-12-16 08:13:00', NULL, '2020-12-27 14:12:27'),
(4, 'Job-04', 'img/products/gallery/job.jpg', NULL, NULL, '5.00', '$', '', 1, '2020-12-16 08:20:15', NULL, '2020-12-27 14:12:23'),
(5, 'Nature-05', 'img/products/gallery/nature-07.jpg', NULL, NULL, '5.00', '$', '', 1, '2020-12-16 08:24:15', NULL, '2020-12-27 14:12:19'),
(6, 'Family-06', 'img/products/gallery/family.jpg', NULL, NULL, '7.03', '$', '', 1, '2020-12-16 08:28:43', '2020-12-16 08:34:18', '2020-12-27 14:12:16'),
(7, 'Business-07', 'img/products/gallery/business-01.jpg', NULL, NULL, '10.00', '$', '', 1, '2020-12-16 09:00:17', NULL, '2020-12-27 14:12:12'),
(8, 'Holiday-08', 'img/products/gallery/holiday.jpeg', NULL, NULL, '10.00', '$', '', 1, '2020-12-16 09:02:22', NULL, '2020-12-27 14:12:08'),
(9, 'Science-09', 'img/products/gallery/science-01.jpg', NULL, NULL, '2.00', '$', '', 1, '2020-12-16 09:09:31', '2020-12-16 23:04:27', '2020-12-27 14:12:04'),
(12, 'person04', 'https://i.ibb.co/S0bH8hc/person-4.jpg', NULL, NULL, '11.22', '$', '', 0, '2020-12-23 15:56:05', '2020-12-23 17:21:16', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products_categories`
--

CREATE TABLE `products_categories` (
  `product_id` int(6) UNSIGNED NOT NULL,
  `category_id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_categories`
--

INSERT INTO `products_categories` (`product_id`, `category_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(12, 8);

-- --------------------------------------------------------

--
-- Table structure for table `products_tags`
--

CREATE TABLE `products_tags` (
  `product_id` int(6) UNSIGNED NOT NULL,
  `tag_id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_tags`
--

INSERT INTO `products_tags` (`product_id`, `tag_id`) VALUES
(1, 3),
(1, 6),
(1, 7),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(6) UNSIGNED NOT NULL,
  `product_id` int(6) UNSIGNED DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(6) UNSIGNED DEFAULT NULL,
  `review_star` int(1) DEFAULT 0,
  `likes` int(2) DEFAULT 0,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_reviews`
--

INSERT INTO `product_reviews` (`id`, `product_id`, `content`, `user_id`, `review_star`, `likes`, `created_date`, `updated_date`) VALUES
(1, 2, 'Greateeeee', 8, 5, NULL, '2020-12-23 11:25:37', '0000-00-00 00:00:00'),
(7, 1, 'Grateeeeeee', 10, NULL, NULL, '2020-12-23 13:06:02', '0000-00-00 00:00:00'),
(8, 1, 'Grateeeeeee', 10, NULL, NULL, '2020-12-23 13:07:24', '0000-00-00 00:00:00'),
(9, 1, 'Grateeeeeee', 10, NULL, NULL, '2020-12-23 13:12:13', '0000-00-00 00:00:00'),
(10, 1, 'nnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn', 10, NULL, NULL, '2020-12-23 13:34:40', '0000-00-00 00:00:00'),
(11, 1, 'awawawawawawawawwwwwwwwwwwwwwwww', 10, NULL, NULL, '2020-12-23 13:34:52', '0000-00-00 00:00:00'),
(28, 1, 'hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 10, 4, NULL, '2020-12-23 14:31:08', '0000-00-00 00:00:00'),
(29, 1, 'Baddddddddddddddddddddddd', 10, 3, NULL, '2020-12-23 14:37:08', '0000-00-00 00:00:00'),
(31, 1, 'yebbbbb', 5, 5, NULL, '2020-12-23 15:08:53', '0000-00-00 00:00:00'),
(33, 12, 'Huong comment ne', 18, 5, NULL, '2020-12-28 22:40:30', '0000-00-00 00:00:00'),
(32, 3, 'hello I love this photo', 5, 1, NULL, '2020-12-23 15:22:09', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`) VALUES
(5, 'dien'),
(6, 'dien nang'),
(7, 'dien nhe'),
(3, 'happy'),
(4, 'khung');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `country` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `phone`, `address`, `city`, `country`, `is_deleted`, `created_date`, `updated_date`, `deleted_date`) VALUES
(1, 'dangquoc', 'nguyendangquoc@gmail.com', 'ÝH-Ä™öížW·ÅÌXy€', 'Quoc', 'Nguyen Dang', '123456789', 'DX', 'QN', 'Vietnam', 1, '2020-02-15 22:35:55', '2020-12-23 17:33:18', '2020-12-15 22:36:25'),
(2, 'dangquoce', 'nguyendangquoc2@gmail.come', 'i5œ\n+•í„ •3‡?n‚', 'Quoce', 'Nguyene', '1234567890', 'NP, DXe', 'QNe', 'VNe', 1, '2020-03-15 22:37:18', '2020-12-23 17:33:53', '2020-12-15 23:12:27'),
(3, 'hoangnguyene', 'hoangnguyen@gmail.come', 'ëKÓ³ÔºF³©´Þ\r>aõ', 'Hoange', 'Nguyene', '9876543211', 'XXe', 'YYe', 'ZZe', 1, '2020-02-15 23:11:57', '2020-12-23 17:34:26', '2020-12-16 22:03:26'),
(4, 'nguyennguyen', 'nguyendangquoc3@gmail.com', 'À°Ö	§’ê;ä¢Dò¢', 'Quoc', 'Nguyen', '123456789', 'NP, DX', 'QN', 'Vietnam', 0, '2020-01-16 13:56:58', '2020-12-23 17:35:26', NULL),
(5, 'user1', 'user1@gmail.com', 'thaothao', 'thao ne', 'thao', '0346061199', '							ncv', 'A', 'America', 1, '2020-12-17 03:57:41', '2020-12-23 15:25:49', NULL),
(6, 'Andn324', 'nguyendaquoc4@gmail.com', '’9Í’Kñúõ¦0°9f', 'Quoc', 'Dang', '1234888789', 'Thu Duc', 'Ho Chi Minh', 'Vietnam', 0, '2020-03-17 10:18:40', '2020-12-23 17:35:48', NULL),
(8, 'user', 'user@gmail.com', '12345', 'John', 'Doe', NULL, NULL, NULL, NULL, NULL, '2020-12-23 11:12:32', '0000-00-00 00:00:00', NULL),
(9, 'foolishfish', 'huonghuong9296@gmail.com', '12345', 'Ad', 'Min', NULL, NULL, NULL, NULL, NULL, '2020-12-23 11:12:43', '0000-00-00 00:00:00', NULL),
(10, 'foolishfish', 'admin@gmail.com', '1111', 'Huong', 'Dam', '0396715204', 'khu dân cư Thạnh Phúaaaaaaaaaaa', NULL, NULL, NULL, '2020-12-23 11:13:01', '2020-12-23 11:21:38', NULL),
(11, 'quocdang', 'awesompic@gmail.com', '_}€ÍeÉjf3] ¹Ð’', 'AwesomePic', 'awe', '123456700', '57 Le Thi Hong Gam', 'Ho Chi Minh', 'Vietnam', 0, '2020-04-23 17:26:49', '2020-12-23 17:35:53', NULL),
(12, 'hoanghuy', 'hoanghuy@gmail.com', '¿;HÚ‹\'¢xÁ²SñhŠC', 'Hoang', 'Huy', '111111323', '', '', '', 0, '2020-06-23 17:27:48', '2020-12-23 17:36:02', NULL),
(13, 'dangcuong', 'dangcuong@gmail.com', 'ÝKÄ¶oJ\ZS³FP E¹0', 'Cuong', 'Dang', '333333333', '', '', '', 0, '2020-08-23 17:29:58', '2020-12-23 17:36:08', NULL),
(14, 'myhanh', 'myhanh@gmail.com', '_}€ÍeÉjf3] ¹Ð’', 'Hanh', 'My', '4444444444', '', '', '', 0, '2020-10-23 17:30:34', '2020-12-23 17:36:12', NULL),
(15, 'dungtran', 'dungtran@gmail.com', '~^Î\nÙ6&#9i\'e', 'Dung', 'Tran', '5555555555', '', '', '', 0, '2020-12-23 17:31:15', NULL, NULL),
(16, 'nguyen123', 'nguyennguyen@gmail.com', '³ûÞ#ÕE3m|£åD‡\"‡', 'Nguyen', 'Nguyen', '078888888', '', '', '', 0, '2020-12-23 17:32:05', NULL, NULL),
(17, 'locle123', 'locle123@hcmut.vn', 'ø´•kµùQaée¯Ì', 'Loc', 'Le', '333222222', '', '', '', 0, '2020-12-23 17:32:46', NULL, NULL),
(18, 'huong', 'huongyeolie@gmail.com', 'ÅkKh(¤Àˆç.ŒL»', 'Huong', 'Dam Ngoc', '0396715204', 'khu dân cư Thạnh Phú', NULL, NULL, 0, '2020-12-28 20:39:15', '2020-12-28 22:37:36', NULL);


-- --------------------------------------------------------

--
-- Table structure for table `viewed_products`
--

CREATE TABLE `viewed_products` (
  `id` int(6) UNSIGNED NOT NULL,
  `product_id` int(6) UNSIGNED DEFAULT NULL,
  `user_id` int(6) UNSIGNED DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `viewed_products`
--

INSERT INTO `viewed_products` (`id`, `product_id`, `user_id`, `created_date`) VALUES
(1, 1, 10, '2020-12-23 05:22:00'),
(2, 2, 5, '2020-12-23 16:45:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`cart_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NAME` (`NAME`);

--
-- Indexes for table `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_name` (`company_name`);

--
-- Indexes for table `history_search`
--
ALTER TABLE `history_search`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `products_tags`
--
ALTER TABLE `products_tags`
  ADD PRIMARY KEY (`product_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `viewed_products`
--
ALTER TABLE `viewed_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `viewed_products`
--
ALTER TABLE `viewed_products`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `Carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `Cart_detail_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `Cart_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `Employees_ibfk_1` FOREIGN KEY (`company_name`) REFERENCES `company_info` (`name`);

--
-- Constraints for table `history_search`
--
ALTER TABLE `history_search`
  ADD CONSTRAINT `history_search_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `Order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `Order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products_categories`
--
ALTER TABLE `products_categories`
  ADD CONSTRAINT `Products_categories_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `Products_categories_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `products_tags`
--
ALTER TABLE `products_tags`
  ADD CONSTRAINT `Products_tags_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `Products_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Constraints for table `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `Product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `Product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `viewed_products`
--
ALTER TABLE `viewed_products`
  ADD CONSTRAINT `viewed_products_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `viewed_products_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
