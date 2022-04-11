-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 10, 2022 at 06:48 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_item` int(80) NOT NULL,
  `values_item` int(80) NOT NULL DEFAULT '1',
  `id_staff` int(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id_cart`, `id_item`, `values_item`, `id_staff`) VALUES
(11, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(80) NOT NULL,
  `content_category` varchar(100) NOT NULL,
  `type_category` varchar(80) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `history`
--

CREATE TABLE `history` (
  `id_history` int(11) NOT NULL,
  `id_staff` varchar(500) NOT NULL,
  `id_item` varchar(500) NOT NULL,
  `name_item` varchar(220) NOT NULL,
  `values_item` varchar(200) NOT NULL,
  `price_item` varchar(220) NOT NULL,
  `income_history` int(11) NOT NULL DEFAULT '0',
  `datetime_history` datetime NOT NULL,
  `transfer_history` varchar(200) NOT NULL,
  `image_history` varchar(600) NOT NULL DEFAULT '0',
  `money_history` int(200) NOT NULL DEFAULT '0',
  `pin_history` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `id_staff`, `id_item`, `name_item`, `values_item`, `price_item`, `income_history`, `datetime_history`, `transfer_history`, `image_history`, `money_history`, `pin_history`) VALUES
(6, '1', '1,3', 'แป็ปซี่,เบอร์เกอร์ หมู', '1,20', '15,50', 0, '2022-04-07 22:52:02', 'bank', '0', 1015, 28225638),
(7, '1', '3', 'เบอร์เกอร์ หมู', '5', '50', 0, '2022-04-07 23:06:44', 'bank', '0', 250, 1114402067),
(8, '1', '3', 'เบอร์เกอร์ หมู', '9', '50', 0, '2022-04-07 23:09:09', 'bank', '0', 450, 1988754554),
(9, '$id_staff', '$item', '$name', '$values', '$price', 0, '2022-04-07 23:09:59', 'bank', '0', 5456, 4564),
(10, '11', '1', 'แป็ปซี่', '1', '15', 0, '2022-01-08 00:14:20', 'bank', '0', 15, 2059384767),
(11, '$id_staff', '$item', '$name', '$values', '$price', 0, '2022-04-08 04:49:26', 'bank', '0', 564, 56456),
(12, '11', '4,3', 'เฟร์ดฟาย,เบอร์เกอร์ หมู', '1,50', '40,50', 0, '2022-04-08 04:50:01', 'bank', '0', 2540, 607050433),
(13, '11', '2,4,10', 'แป็ปซี่ ซีโร่,เฟร์ดฟาย,test10', '1,1,20', '18,40,50', 1100, '2022-04-08 04:51:57', 'cash', '0', 1058, 141656689),
(14, '7', '2,3', 'แป็ปซี่ ซีโร่,เบอร์เกอร์ หมู', '1,1', '18,50', 0, '2022-04-08 13:19:10', 'bank', '0', 68, 1266740688),
(15, '7', '2,3', 'แป็ปซี่ ซีโร่,เบอร์เกอร์ หมู', '1,15', '18,50', 800, '2022-04-09 13:35:15', 'cash', '0', 768, 1538713440),
(16, '12', '1,2', 'แป็ปซี่,แป็ปซี่ ซีโร่', '1,20', '15,18', 0, '2022-04-09 13:49:43', 'bank', '0', 375, 2058843093),
(17, '7', '2,4', 'แป็ปซี่ ซีโร่,เฟร์ดฟาย', '1,20', '18,40', 0, '2022-04-09 13:50:13', 'bank', '0', 818, 1849800964),
(18, '7', '1,2', 'แป็ปซี่,แป็ปซี่ ซีโร่', '1,3', '15,18', 70, '2022-04-10 16:49:39', 'cash', '0', 69, 1762805872);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id_item` int(11) NOT NULL,
  `name_item` varchar(500) NOT NULL,
  `barcode` varchar(100) NOT NULL,
  `image_item` varchar(800) NOT NULL DEFAULT '../image/system/unknown-file.png',
  `content_item` varchar(500) NOT NULL,
  `number_item` varchar(200) NOT NULL,
  `price_item` varchar(200) NOT NULL,
  `group_item` varchar(80) NOT NULL DEFAULT '-',
  `brand_item` varchar(80) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id_item`, `name_item`, `barcode`, `image_item`, `content_item`, `number_item`, `price_item`, `group_item`, `brand_item`) VALUES
(1, 'แป็ปซี่', '1', '../image/system/unknown-file.png', '', '994', '15', '-', '-'),
(2, 'แป็ปซี่ ซีโร่', '2', '../image/system/unknown-file.png', '', '954', '18', '-', '-'),
(3, 'เบอร์เกอร์ หมู', '3', '../image/system/unknown-file.png', '', '3181', '50', '-', '-'),
(4, 'เฟร์ดฟาย', '4', '../image/system/unknown-file.png', '', '4956', '40', '-', 'อาหาร'),
(10, 'test10', '111111111111', '../image/item/889578182profile2.jpg', '', '2955', '50', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id_News` int(11) NOT NULL,
  `title_News` varchar(30) NOT NULL,
  `content_News` varchar(200) NOT NULL,
  `major_News` int(11) NOT NULL DEFAULT '0',
  `datetime_News` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id_News`, `title_News`, `content_News`, `major_News`, `datetime_News`) VALUES
(1, 'test', '123456', 1, '2022-04-09 05:03:52'),
(2, 'sdads', 'sdadda', 1, '2022-04-09 05:34:50'),
(3, 'dfgsdfg', 'fgfgsf', 1, '2022-04-09 05:35:06'),
(4, '1223', '56456', 0, '2022-04-09 05:35:28');

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id_note` int(11) NOT NULL,
  `id_staff` varchar(30) NOT NULL,
  `type_note` varchar(60) NOT NULL,
  `content_note` varchar(220) NOT NULL,
  `datetime_note` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id_note`, `id_staff`, `type_note`, `content_note`, `datetime_note`) VALUES
(5, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 01:58:38'),
(6, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 01:58:49'),
(7, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 02:00:29'),
(8, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 02:05:51'),
(9, '12', 'logout', '2022-04-10 13:30:38//2022-04-10 01:45:28', '2022-04-10 02:13:00'),
(10, '12', 'logout', '2022-04-10 13:30:38//2022-04-10 01:45:28', '2022-04-10 02:14:52'),
(11, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 02:15:30'),
(12, '13', 'logout', '2022-04-10 13:46:40//2022-04-10 01:46:47', '2022-04-10 02:17:02'),
(13, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 02:32:08'),
(14, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 02:45:14'),
(15, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 02:45:20'),
(16, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 02:50:25'),
(17, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 04:45:35'),
(18, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 04:53:36'),
(19, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 05:42:28'),
(20, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 06:01:47'),
(21, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 06:19:19'),
(22, '$id_item', 'additem', '$data', '2022-04-10 06:20:14'),
(23, '3', 'additem', 'เบอร์เกอร์ หมู-302-2879', '2022-04-10 06:21:51'),
(24, '', 'logout', '//2022-04-10 02:38:39', '2022-04-10 06:22:52'),
(25, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 06:23:21'),
(26, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 07:03:21'),
(27, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 12:57:48'),
(28, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:02:36'),
(29, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:03:06'),
(30, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:03:07'),
(31, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:03:08'),
(32, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:03:09'),
(33, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:03:27'),
(34, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:03:35'),
(35, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:26:17'),
(36, '12', 'logout', '2022-04-10 13:30:38//2022-04-10 01:45:28', '2022-04-10 13:30:38'),
(37, '13', 'logout', '2022-04-10 13:46:40//2022-04-10 01:46:47', '2022-04-10 13:31:01'),
(38, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:31:41'),
(39, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:32:41'),
(40, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:33:06'),
(41, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:40:19'),
(42, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:44:28'),
(43, '12', 'logout', '2022-04-10 13:30:38//2022-04-10 01:45:28', '2022-04-10 13:45:04'),
(44, '13', 'logout', '2022-04-10 13:46:40//2022-04-10 01:46:47', '2022-04-10 13:45:35'),
(45, '13', 'logout', '2022-04-10 13:46:40//2022-04-10 01:46:47', '2022-04-10 13:46:40'),
(46, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 13:46:51'),
(47, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 14:33:22'),
(48, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 14:38:58'),
(49, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 14:39:21'),
(50, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 14:46:04'),
(51, '7', 'logout', '2022-04-10 15:06:02//2022-04-10 04:27:43', '2022-04-10 15:06:02'),
(52, '7', 'login', '2022-04-10 16:36:07', '2022-04-10 16:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id_staff` int(11) NOT NULL,
  `fname_staff` varchar(300) NOT NULL,
  `lname_staff` varchar(200) NOT NULL,
  `number_staff` varchar(300) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `admin` int(10) NOT NULL DEFAULT '0',
  `date_staff` datetime NOT NULL,
  `statusstaff` varchar(10) NOT NULL DEFAULT '0',
  `login_staff` int(11) NOT NULL DEFAULT '0',
  `datelogin_staff` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id_staff`, `fname_staff`, `lname_staff`, `number_staff`, `pass`, `admin`, `date_staff`, `statusstaff`, `login_staff`, `datelogin_staff`) VALUES
(7, 'admin', 'admin', '39561', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 1, '2022-04-07 23:38:47', '0', 1, '2022-04-10 18:45:59'),
(12, 'dgfgsdf', '16794', '23532', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 0, '2022-04-08 00:11:40', '0', 0, '2022-04-10 13:45:04'),
(13, 'fgdfg', '16794', '71141', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 0, '2022-04-08 00:13:15', '0', 0, '2022-04-10 13:46:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_category`);

--
-- Indexes for table `history`
--
ALTER TABLE `history`
  ADD PRIMARY KEY (`id_history`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id_News`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id_note`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id_News` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
