-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 23, 2017 at 07:54 PM
-- Server version: 5.7.17-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iti_mZone`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `cdesc` varchar(250) NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '1',
  `image` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `cdesc`, `parent`, `image`) VALUES
(1, 'category', 'parent category', 1, ''),
(2, 'mobi', 'mobile', 1, ''),
(3, 'sport', 'sport ', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(250) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` datetime NOT NULL,
  `percentage` int(3) NOT NULL,
  `isUsed` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `user_id`, `code`, `start_date`, `end_date`, `percentage`, `isUsed`) VALUES
(1, 1, 'bgimb4tg7sxmgstmgdwcs8w4sgos75ju', '2017-03-31 00:00:00', '2017-03-11 00:00:00', 22, b'0'),
(5, 1, 'c9mt07b2dfx6y9ulwrogwcg840tm9dor', '2017-03-31 00:00:00', '2017-03-25 00:00:00', 50, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `userid` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `price` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE `offer` (
  `id` int(11) NOT NULL,
  `pro_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_date` datetime NOT NULL,
  `percentage` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`id`, `pro_id`, `start_date`, `end_date`, `percentage`) VALUES
(1, 1, '2017-03-10 00:00:00', '2017-03-11 00:00:00', 11),
(2, 1, '2017-03-10 00:00:00', '2017-03-11 00:00:00', 50),
(3, 1, '2017-03-03 00:00:00', '2017-03-18 00:00:00', 11),
(4, 1, '2017-03-31 00:00:00', '2017-03-31 00:00:00', 55);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_ar` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `rate` int(11) NOT NULL DEFAULT '0',
  `image` varchar(250) NOT NULL,
  `pdesc` text,
  `pdesc_ar` text,
  `cat_id` int(11) NOT NULL,
  `shop_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `name_ar`, `price`, `rate`, `image`, `pdesc`, `pdesc_ar`, `cat_id`, `shop_user_id`) VALUES
(1, 'p1', 'م1', 50, 3, 'img1.png', 'p1 is p1', 'م1 هو م1', 1, 1),
(2, 'p2', 'م2', 70, 2, 'img', 'desc2', 'وصف1', 1, 1),
(3, 'cd', 'سى دى ', 2, 0, '', 'cd ', 'سى دى ', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `pro_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`pro_id`, `user_id`, `rate`) VALUES
(1, 1, 1),
(1, 2, 5),
(1, 3, 3),
(1, 4, 4),
(1, 6, 3),
(2, 4, 1),
(2, 6, 1),
(2, 7, 4),
(2, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `user_id`, `product_id`, `comment`, `date`) VALUES
(1, 1, 1, 'my comment', '2017-03-31 03:24:21'),
(2, 1, 1, 'dfdfdfdfdfdfdfdf', '2017-03-17 09:41:02'),
(5, 1, 0, 'second', '2017-03-17 09:52:57'),
(6, 1, 0, 'second', '2017-03-17 09:53:18'),
(7, 1, 1, 'helooooooooooooooooo', '2017-03-18 16:48:18'),
(8, 1, 1, 'frercwr w er er wrwer er', '2017-03-18 21:21:34');

-- --------------------------------------------------------

--
-- Table structure for table `shoppingcart`
--

CREATE TABLE `shoppingcart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shoppingcart`
--

INSERT INTO `shoppingcart` (`id`, `product_id`, `user_id`, `quantity`, `price`, `time`) VALUES
(1, 1, 2, 2, '3', '2017-03-22 21:35:25'),
(2, 2, 1, 2, '2', '2017-03-22 21:35:49'),
(3, 1, 1, 2, '2', '2017-03-22 21:36:33');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name_ar` varchar(100) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '3',
  `isBlocked` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `name_ar`, `username`, `email`, `password`, `type`, `isBlocked`) VALUES
(1, 'admin', 'أدمن', 'admin', 'admin@mZone.com', '123456', 1, 1),
(2, 'eslam', 'إسلام', 'eslam', 'khoga.eslam@gmail.com', 'eslam12345', 3, 0),
(3, 'esraa', 'اسراء', 'sara', 'esraa@yahoo.com', '12345678', 2, 0),
(4, 'aya', 'ايه', 'yoyo', 'aya@yaho.com', '12345678', 3, 0),
(5, 'bassant', 'بسنت', 'bose', 'bose@yahoo.com', '12345678', 3, 0),
(6, 'merna', 'ميرنا', 'mero', 'merna@yahoo.com', '123', 3, 0),
(7, 'a', 'ا', 'a', 'a@yahoo.com', 'a', 3, 0),
(8, 'b', 'ب', 'b', 'b@yahoo.com', 'b', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `userid` int(11) NOT NULL,
  `productid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`userid`,`pro_id`,`date`);

--
-- Indexes for table `offer`
--
ALTER TABLE `offer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`pro_id`,`user_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`userid`,`productid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `offer`
--
ALTER TABLE `offer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `shoppingcart`
--
ALTER TABLE `shoppingcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
