-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 23, 2024 at 03:02 PM
-- Server version: 5.7.24
-- PHP Version: 8.1.0

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
(6, 10, 1, 8),
(7, 7, 1, 8),
(13, 2, 1, 7),
(14, 9, 14, 7);

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

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id_category`, `name_category`, `content_category`, `type_category`) VALUES
(1, 'เครื่องดื่ม', '', 'group'),
(2, 'มะขาม', '', 'brand'),
(3, 'ประดู่', '', 'brand'),
(4, 'เรือบิน', '', 'brand'),
(5, 'รวงข้าว', '', 'brand'),
(6, 'กระต่ายบิน', '', 'brand'),
(7, 'ยาสีฟัน', '', 'group'),
(8, 'เครื่องปรุงอาหาร', '', 'group');

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
  `fullname_staff` varchar(110) DEFAULT NULL,
  `nametax_history` varchar(110) DEFAULT NULL,
  `address_history` varchar(110) DEFAULT NULL,
  `tax_setting` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `id_staff`, `id_item`, `name_item`, `values_item`, `price_item`, `income_history`, `datetime_history`, `transfer_history`, `image_history`, `fullname_staff`, `nametax_history`, `address_history`, `tax_setting`) VALUES
(1, '7', '2,3,1,6,7,5', 'น้ำอัดลม,น้ำอัดลมไม่มีน้ำตาล,กาแฟ,น้ำปลาตรามะขาม,ยาสีฟันตราประดู่,น้ำจิ้มซีฟู้ด', '2,1,1,1,1,1', '14,18,30,42,20,40', 0, '2022-04-24 00:12:32', 'bank', '../image/bank/1528614115สลิปโอนเงิน.jpg', NULL, NULL, NULL, 0),
(2, '8', '2,4,8', 'น้ำอัดลม,น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำซีอิ้วขาวตรารวงข้าว', '1,1,1', '14,30,30', 0, '2022-04-24 23:17:28', 'bank', '../image/bank/1254090877สลิปโอนเงิน.jpg', NULL, NULL, NULL, 0),
(3, '7', '1,7,10', 'กาแฟ,ยาสีฟันตราประดู่,น้ำยาล้างจานตราเรือบิน', '1,1,1', '30,20,34', 90, '2022-04-24 23:40:20', 'cash', '0', NULL, NULL, NULL, 0),
(4, '8', '2,3,4', 'น้ำอัดลม,น้ำอัดลมไม่มีน้ำตาล,น้ำยาล้างจานสูตรมะกรูดตราเรือบิน', '1,1,1', '14,18,30', 0, '2022-04-24 23:49:31', 'bank', '0', NULL, NULL, NULL, 0),
(5, '7', '1,3', 'กาแฟ,น้ำอัดลมไม่มีน้ำตาล', '1,1', '30,18', 0, '2022-04-25 14:42:49', 'bank', '0', NULL, NULL, NULL, 0),
(6, '$id_staff', '$item', '$name', '$values', '$price', 303, '2022-07-14 13:08:15', 'cash', '0', '$fullname', NULL, NULL, 0),
(7, '7', '2', 'น้ำอัดลม', '1', '14', 20, '2022-07-14 13:09:01', 'cash', '0', 'admin admin', NULL, NULL, 0),
(8, '7', '', '', '', '', 20, '2022-07-14 13:09:57', 'cash', '0', 'admin admin', NULL, NULL, 0),
(9, '7', '4,3,2', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล,น้ำอัดลม', '1,1,1', '30,18,14', 70, '2022-07-14 13:10:14', 'cash', '0', 'admin admin', 'test1', 'test2325', 0),
(10, '7', '4', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน', '1', '30', 0, '2022-07-14 16:55:00', 'bank', '0', 'admin admin', NULL, NULL, 0),
(11, '7', '4,3', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล', '1,1', '30,18', 48, '2022-07-14 19:38:28', 'cash', '0', 'admin admin', NULL, NULL, 0),
(12, '7', '4,3', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล', '1,1', '30,18', 48, '2022-07-14 23:08:25', 'cash', '0', 'admin admin', NULL, NULL, 0),
(13, '7', '4,3', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล', '1,5', '30,18', 0, '2022-07-14 23:37:47', 'bank', '0', 'admin admin', NULL, NULL, 0),
(14, '7', '4,3', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล', '1,1', '30,18', 0, '2022-07-14 23:38:53', 'bank', '../image/bank/1610836325IMG_3679.JPG', 'admin admin', NULL, NULL, 0),
(15, '7', '4', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน', '1', '30', 30, '2022-07-15 22:38:25', 'cash', '0', 'admin admin', NULL, NULL, 0),
(16, '7', '4,3', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล', '1,1', '30,18', 51, '2022-07-15 22:39:29', 'cash', '0', 'admin admin', 'ทวี', 'หล่อมาก', 1),
(17, '7', '4,3,2,1,5,8,7,6,10,9', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล,น้ำอัดลม,กาแฟ,น้ำจิ้มซีฟู้ด,น้ำซีอิ้วขาวตรารวงข้าว,ยาสีฟันตราประดู่,น้ำปลาตรามะขาม,น้ำยาล้างจานตราเรือบิน,น้ำยาล้างจานตรากระต่ายบิน', '1,1,1,1,1,1,1,1,1,1', '30,18,14,30,40,30,20,42,34,68', 0, '2022-07-16 12:45:39', 'bank', '../image/bank/17042576841254090877สลิปโอนเงิน.jpg', 'admin admin', NULL, NULL, 1),
(18, '7', '4', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน', '1', '30', 0, '2022-07-16 15:34:38', 'bank', '../image/bank/16119748381254090877สลิปโอนเงิน.jpg', 'admin admin', NULL, NULL, 1),
(19, '7', '4', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน', '1', '30', 0, '2022-07-16 16:08:50', 'bank', '../image/bank/16384932481254090877สลิปโอนเงิน.jpg', 'admin admin', NULL, NULL, 1),
(20, '7', '3,4,2,1,6', 'น้ำอัดลมไม่มีน้ำตาล,น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลม,กาแฟ,น้ำปลาตรามะขาม', '1,1,1,1,1', '18,30,14,30,42', 300, '2022-07-29 15:01:21', 'cash', '0', 'admin admin', NULL, NULL, 1),
(21, '8', '4,3,2', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล,น้ำอัดลม', '1,1,1', '30,18,14', 70, '2022-07-31 00:14:36', 'cash', '0', 'staff staff', NULL, NULL, 1),
(22, '7', '4,3,2,1,7,10', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล,น้ำอัดลม,กาแฟ,ยาสีฟันตราประดู่,น้ำยาล้างจานตราเรือบิน', '1,1,1,1,1,1', '30,18,14,30,20,34', 0, '2022-10-13 21:16:57', 'bank', '../image/bank/1150082391IMG_3678.CR3', 'admin admin', NULL, NULL, 1),
(23, '7', '4,3,2,7', 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล,น้ำอัดลม,ยาสีฟันตราประดู่', '11,1,1,1', '30,18,14,20', 500, '2022-10-28 01:01:38', 'cash', '0', 'admin admin', NULL, NULL, 1),
(24, '7', '2,1', 'น้ำอัดลม,กาแฟ', '1,1', '14,30', 0, '2023-01-05 20:32:09', 'bank', '0', 'admin admin', NULL, NULL, 1),
(25, '7', '7,8,4,3', 'ยาสีฟันตราประดู่,น้ำซีอิ้วขาวตรารวงข้าว,น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำอัดลมไม่มีน้ำตาล', '1,76,78,5', '20,30,30,18', 500000, '2023-06-20 10:02:06', 'cash', '0', 'admin admin', NULL, NULL, 1),
(26, '7', '3,2,7,6', 'น้ำอัดลมไม่มีน้ำตาล,น้ำอัดลม,ยาสีฟันตราประดู่,น้ำปลาตรามะขาม', '1,5,10,1', '18,14,20,42', 2111, '2023-09-26 17:23:34', 'cash', '0', 'admin admin', NULL, NULL, 1),
(27, '7', '5,3,2', 'น้ำจิ้มซีฟู้ด,น้ำอัดลมไม่มีน้ำตาล,น้ำอัดลม', '1,1,1', '40,18,14', 0, '2023-09-27 01:25:20', 'bank', '../image/bank/687369665IMG_9144.JPG', 'admin admin', NULL, NULL, 1);

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
(2, 'น้ำอัดลม', '105879478164', '../image/item/1495404627น้ำอัดลม.png', '', '8', '14', 'เครื่องดื่ม', '-'),
(3, 'น้ำอัดลมไม่มีน้ำตาล', '123487945213', '../image/item/662781956น้ำอัดลมไม่มีน้ำตาล.png', '', '269', '18', 'เครื่องดื่ม', '-'),
(4, 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน', '819476124913', '../image/item/373732343น้ำยาล้างจานสูตรมะกรูดตราเรือบิน.png', '', '0', '30', '-', 'เรือบิน'),
(5, 'น้ำจิ้มซีฟู้ด', '849736439431', '../image/item/203137910น้ำจิ้มซีฟู้ด.png', '', '56', '40', 'เครื่องปรุงอาหาร', '-'),
(6, 'น้ำปลาตรามะขาม', '894316748154', '../image/item/626552307น้ำปลาตรามะขาม.png', '', '55', '42', 'เครื่องปรุงอาหาร', 'มะขาม'),
(7, 'ยาสีฟันตราประดู่', '879256148765', '../image/item/922805028ยาสีฟันตราประดู่.png', '', '23', '20', 'ยาสีฟัน', 'ประดู่'),
(8, 'น้ำซีอิ้วขาวตรารวงข้าว', '975461345194', '../image/item/959763415น้ำซีอิ้วขาวตรารวงข้าว.png', '', '0', '30', 'เครื่องปรุงอาหาร', 'รวงข้าว'),
(9, 'น้ำยาล้างจานตรากระต่ายบิน', '764154341679', '../image/item/1053811927น้ำยาล้างจานตรากระต่ายบิน.png', '', '298', '68', '-', 'กระต่ายบิน'),
(10, 'น้ำยาล้างจานตราเรือบิน', '679124316754', '../image/item/144738287น้ำยาล้างจานตราเรือบิน.png', '', '76', '34', '-', 'เรือบิน');

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

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id_note` int(11) NOT NULL,
  `id_staff` varchar(30) NOT NULL,
  `name_staff` varchar(60) NOT NULL,
  `type_note` varchar(60) NOT NULL,
  `content_note` varchar(220) NOT NULL,
  `datetime_note` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id_note`, `id_staff`, `name_staff`, `type_note`, `content_note`, `datetime_note`) VALUES
(75, '7', 'admin', 'logout', '2023-09-25 01:03:03//2023-09-25 01:54:40', '2023-09-25 01:03:03'),
(76, '7', 'admin', 'logout', '2023-09-26 17:14:18//2023-09-26 05:15:38', '2023-09-26 17:14:18'),
(77, '7', 'admin', 'logout', '2023-09-26 17:18:05//2023-09-26 05:18:52', '2023-09-26 17:18:05'),
(78, '7', 'admin', 'logout', '2023-09-26 17:18:54//2023-09-26 05:20:09', '2023-09-26 17:18:54'),
(79, '7', 'admin', 'logout', '2023-09-26 17:20:12//2023-09-26 05:20:59', '2023-09-26 17:20:12'),
(80, '7', 'admin', 'logout', '2023-09-26 17:21:22//2023-09-26 05:21:41', '2023-09-26 17:21:22'),
(81, '7', 'admin', 'logout', '2023-09-26 17:22:01//2023-09-26 05:22:18', '2023-09-26 17:22:01'),
(82, '7', 'admin', 'logout', '2023-09-26 17:22:44//2023-09-26 05:22:55', '2023-09-26 17:22:44'),
(83, '9', 'Ongarj', 'login', '2023-09-26 17:23:01', '2023-09-26 17:23:01'),
(84, '7', 'admin', 'logout', '2023-09-26 17:23:08//2023-10-08 02:17:14', '2023-09-26 17:23:08'),
(85, '8', 'staff', 'login', '2023-09-26 17:25:42', '2023-09-26 17:25:42'),
(86, '7', 'admin', 'logout', '2023-09-27 01:22:03//2023-11-19 12:11:07', '2023-09-27 01:22:03'),
(87, '7', 'admin', 'logout', '2023-09-27 17:35:01//2023-11-19 09:41:10', '2023-09-27 17:35:01'),
(88, '7', 'admin', 'login', '2023-10-08 02:16:43', '2023-10-08 02:16:43'),
(89, '7', 'admin', 'login', '2023-10-08 02:17:19', '2023-10-08 02:17:19'),
(90, '8', 'staff', 'login', '2023-10-08 02:22:51', '2023-10-08 02:22:51'),
(91, '7', 'admin', 'login', '2023-11-19 10:37:08', '2023-11-19 10:37:08'),
(92, '7', 'admin', 'login', '2023-11-19 20:50:50', '2023-11-19 20:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id_setting` int(11) NOT NULL,
  `name_setting` varchar(80) NOT NULL,
  `action_setting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id_setting`, `name_setting`, `action_setting`) VALUES
(1, 'เปิดการใช้ระบบจัดเก็บภาษี 7 % (หากติ๊กระบบจะเก็บภาษี)', 1);

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
(7, 'admin', 'admin', '39561', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 1, '2022-04-07 23:38:47', '0', 0, '2023-11-19 20:51:10'),
(8, 'staff', 'staff', '6117', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 0, '2022-04-23 21:57:27', '0', 1, '2023-10-08 02:23:16'),
(9, 'Ongarj', 'Thongchai', '97390', '40fd9b2329728bfdb759cc5dff322858d973f504812132453c22def253f6ad3db1ce5477fe8d0e5365012aa4bd48d73935e53a4f3a44eed50122dcfa93db21e3', 0, '2023-09-26 17:20:34', '0', 1, '2023-09-26 17:24:05');

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
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id_setting`);

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
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id_News` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id_setting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
