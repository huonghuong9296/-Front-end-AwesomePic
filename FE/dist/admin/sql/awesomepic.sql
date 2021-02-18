-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 08, 2020 lúc 07:55 PM
-- Phiên bản máy phục vụ: 10.4.16-MariaDB
-- Phiên bản PHP: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `awesomepic`
--

DELIMITER $$
--
-- Các hàm
--
CREATE DEFINER=`root`@`localhost` FUNCTION `get_category_name` (`category_id_in` INT(6)) RETURNS VARCHAR(50) CHARSET utf8mb4 READS SQL DATA
    DETERMINISTIC
BEGIN
DECLARE category_name_out VARCHAR(50) DEFAULT "";
 SELECT category_name
 INTO category_name_out
 FROM product_categories
 WHERE category_id = category_id_in
 AND is_deleted = "0";
 RETURN category_name_out;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admins`
--

CREATE TABLE `admins` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED DEFAULT NULL,
  `total_price` decimal(10,0) DEFAULT 0,
  `total_quantity` int(5) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_detail`
--

CREATE TABLE `cart_detail` (
  `cart_id` int(6) UNSIGNED NOT NULL,
  `product_id` int(6) UNSIGNED NOT NULL,
  `quantity` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(6) UNSIGNED NOT NULL,
  `NAME` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `company_info`
--

CREATE TABLE `company_info` (
  `name` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `employees`
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
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(6) UNSIGNED NOT NULL,
  `user_id` int(6) UNSIGNED DEFAULT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `total_quantity` int(5) NOT NULL,
  `is_paid` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_price`, `currency`, `total_quantity`, `is_paid`, `created_date`) VALUES
(1, 45, '200', '$', 40, 0, '2020-12-08 23:16:33'),
(2, 46, '4000', '$', 2, 0, '2020-12-08 23:16:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `order_id` int(6) UNSIGNED NOT NULL,
  `product_id` int(6) UNSIGNED NOT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `quantity` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `category_id` int(6) NOT NULL,
  `src` text NOT NULL,
  `width` varchar(20) DEFAULT NULL,
  `height` varchar(20) DEFAULT NULL,
  `price` decimal(10,0) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `src`, `width`, `height`, `price`, `currency`, `description`, `is_deleted`, `created_date`, `updated_date`, `deleted_date`) VALUES
(1, 'animal-05', 1, 'https://i.ibb.co/PjGQ9gs/animal-05.jpg', NULL, NULL, '2', '$', 'animal cute', 0, '2020-12-08 00:15:41', NULL, NULL),
(2, 'building-05', 2, 'https://i.ibb.co/Dw5T67k/building-05.jpg', NULL, NULL, '3', '$', 'building', 0, '2020-12-08 00:15:41', '2020-12-08 16:43:06', NULL),
(3, 'business-01up', 6, 'https://i.ibb.co/TRvrwd7/business-01.jpg', NULL, NULL, '200', '$up', 'businessup', 0, '2020-12-08 00:15:41', '2020-12-08 16:23:45', NULL),
(5, 'holiday', 0, 'https://i.ibb.co/WkjTZB4/holiday.jpg', NULL, NULL, '2', '$', 'holiday', 0, '2020-12-08 00:15:41', NULL, NULL),
(6, 'job', 0, 'https://i.ibb.co/dcBdT5D/job.jpg', NULL, NULL, '3', '$', 'job', 0, '2020-12-08 00:15:41', '2020-12-08 16:39:17', NULL),
(7, 'nature-07', 5, 'https://i.ibb.co/bvctgDM/nature-07.jpg', NULL, NULL, '2', '$', 'nature 07', 0, '2020-12-08 00:15:41', NULL, NULL),
(10, 'blog post', 1, 'https://i.ibb.co/19Q1mtk/blog-post-1.png', NULL, NULL, '4000', 'VND', 'blog post is...', 0, '2020-12-08 14:18:34', NULL, NULL),
(11, 'A', 4, 'https://i.ibb.co/TRvrwd7/business-01.jpg', NULL, NULL, '200', '$up', 'businessup', 0, '2020-12-08 00:15:41', '2020-12-08 16:23:45', NULL),
(12, 'animal-05', 4, 'https://i.ibb.co/PjGQ9gs/animal-05.jpg', NULL, NULL, '2', '$', 'animal cute', 0, '2020-12-08 00:15:41', NULL, NULL),
(13, 'building-05', 3, 'https://i.ibb.co/Dw5T67k/building-05.jpg', NULL, NULL, '3', '$', 'building', 0, '2020-12-08 00:15:41', '2020-12-08 16:43:06', NULL),
(14, 'B', 4, 'https://i.ibb.co/TRvrwd7/business-01.jpg', NULL, NULL, '200', '$up', 'businessup', 0, '2020-12-08 00:15:41', '2020-12-08 16:23:45', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products_tags`
--

CREATE TABLE `products_tags` (
  `product_id` int(6) UNSIGNED NOT NULL,
  `tag_id` int(6) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_categories`
--

CREATE TABLE `product_categories` (
  `category_id` int(6) UNSIGNED NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product_categories`
--

INSERT INTO `product_categories` (`category_id`, `category_name`, `is_deleted`) VALUES
(0, 'No category', 0),
(1, 'Animals', 0),
(2, 'Building', 0),
(3, 'People1', 0),
(4, 'Love', 0),
(5, 'Nature', 0),
(6, 'Business', 0),
(7, 'Family', 0),
(9, 'xxyyhh', 0),
(10, 'Life', 0),
(11, 'Happy no', 1),
(12, 'Friends', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_reviews`
--

CREATE TABLE `product_reviews` (
  `id` int(6) UNSIGNED NOT NULL,
  `product_id` int(6) UNSIGNED DEFAULT NULL,
  `content` text DEFAULT NULL,
  `user_id` int(6) UNSIGNED DEFAULT NULL,
  `review_star` int(1) DEFAULT NULL,
  `likes` int(2) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tags`
--

CREATE TABLE `tags` (
  `id` int(6) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_date` datetime DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `firstname`, `lastname`, `phone`, `address`, `city`, `country`, `is_deleted`, `created_date`, `updated_date`, `deleted_date`) VALUES
(45, 'nguyendangquoc', 'nguyendangquoc@gmail.com', 'hello1', 'QuocHi', 'Nguyen', '0123456789', 'Thu Duc', 'Ho Chi Minh', 'VN', 0, '2020-12-06 21:15:00', '2020-12-07 15:23:05', NULL),
(46, 'lequochuy', 'lqh@gmail.com', 'hello1', 'Huy', 'Le Quoc', '2213231313', 'Quan 1', 'HCM', 'Viet Nam', 0, '2020-12-06 21:16:30', NULL, NULL),
(47, 'kimphuong', 'kimphuong@gmail.com', 'hello2', 'Phuong', 'Tran Kim', '9999999990', 'DX', 'QN', 'Vietnam', 0, '2020-12-06 21:18:20', '2020-12-06 21:19:28', NULL),
(48, 'ducnguyen', 'ducnguyen@hcmut.edu.vn', 'hello', 'Duc', 'Nguyen', '34243424234', 'Quan 10', 'HCM', 'USA', 0, '2020-12-06 21:27:02', NULL, NULL),
(49, 'mainguyen', 'nguyenthimai@ggg.com', '1234', 'Mai', 'Nguyen Thi', '0796839302', 'XXX', 'HCM', 'Vietnam', 0, '2020-12-06 21:28:24', NULL, NULL),
(50, 'mryadam123', 'adam@gmail.cc', 'hello1', 'Adam', 'Mr', '9834748', 'NY', 'N', 'M', 1, '2020-12-06 21:34:27', '2020-12-06 22:00:24', NULL),
(51, 'ngohoang11', 'ngohoang@gmail.com', 'hello', 'Hoang', 'Ngo', '1231231', 'Duy Xuyen', 'Quang Nam', 'VietNam', 0, '2020-12-06 22:01:43', NULL, NULL),
(52, 'nguyennguyen', 'nguyennguyen@gmail.com', 'hello', 'Nguyen', 'Nguyen Thi Thuy', '213213123', 'Cho Lach', 'Ben Tre', 'VN', 0, '2020-12-06 22:03:54', NULL, NULL),
(53, 'nguyenhanh', '123xddddf@gaml.cs', 'alo123', 'Hanh', 'Nguyen', '324324', 'ss?', 'dsds', 'dsada', 0, '2020-12-06 22:05:14', NULL, NULL),
(54, 'nguyenhang', 'nguyennguyenhang@gmail.com', 'hello', 'Hang', 'Nguyen Thi Thuy', '213213123', 'Cho Lach', 'Ben Tre', 'Vietnam', 0, '2020-12-06 22:05:52', NULL, NULL),
(55, 'nguyennguyenss', 'lqhs@gmail.com', 'nguyen123', 'Quang', 'Le Quoc', '02213231313', 'Quan 1', 'HCM', 'Vietnam', 0, '2020-12-06 22:06:14', NULL, NULL),
(56, 'fffffffffff', 'ngohoangss@gmail.com', 'nguyen123', 'Hoang', 'Ngo', '1231231', 'Duy Xuyen', 'Quang Nam', 'Vietnam', 1, '2020-12-06 22:06:39', '2020-12-07 15:22:45', NULL),
(57, 'leledd', 'levanle@gmail.com', 'ssssd', 'Le', 'Van Thi', '123321321', 'Cho Lach', 'Ben Tre', 'Vietnam', 0, '2020-12-06 22:13:36', NULL, NULL),
(58, 'nguyennnhoang', 'ngohoang2ss@gmail.com', 'nguyen123', 'Hoang', 'Ngo', '1231231', 'Duy Xuyen', 'Quang Nam', 'Vietnam', 0, '2020-12-06 22:14:05', NULL, NULL),
(59, 'hoamaidn23', 'nguyenthihoa@gamil.com', 'nguyen123', 'Hoa', 'Nguyen Thi', '0796839302', 'Ho Chi Minh', 'HCM', 'Vietnam', 0, '2020-12-06 22:15:10', '2020-12-06 22:15:43', NULL),
(60, 'vohoanganhvu', 'anhvu@gmail.com', '123456', 'Vu', 'Vo Hoang Anh', '3243243432', 'Quan 1', 'HCM', 'Vietnam', 0, '2020-12-06 22:32:16', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD PRIMARY KEY (`cart_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `NAME` (`NAME`);

--
-- Chỉ mục cho bảng `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`name`);

--
-- Chỉ mục cho bảng `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `company_name` (`company_name`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `products_tags`
--
ALTER TABLE `products_tags`
  ADD PRIMARY KEY (`product_id`,`tag_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Chỉ mục cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`category_id`) USING BTREE;

--
-- Chỉ mục cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `category_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `Carts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `cart_detail`
--
ALTER TABLE `cart_detail`
  ADD CONSTRAINT `Cart_detail_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `carts` (`id`),
  ADD CONSTRAINT `Cart_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `Employees_ibfk_1` FOREIGN KEY (`company_name`) REFERENCES `company_info` (`name`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `Order_detail_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `Order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `products_tags`
--
ALTER TABLE `products_tags`
  ADD CONSTRAINT `Products_tags_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `Products_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`);

--
-- Các ràng buộc cho bảng `product_reviews`
--
ALTER TABLE `product_reviews`
  ADD CONSTRAINT `Product_reviews_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `Product_reviews_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
