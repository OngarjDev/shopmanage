-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2022 at 10:04 AM
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
  `money_history` int(200) NOT NULL DEFAULT '0',
  `pin_history` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `history`
--

INSERT INTO `history` (`id_history`, `id_staff`, `id_item`, `name_item`, `values_item`, `price_item`, `income_history`, `datetime_history`, `transfer_history`, `image_history`, `money_history`, `pin_history`) VALUES
(1, '7', '2,3,1,6,7,5', 'น้ำอัดลม,น้ำอัดลมไม่มีน้ำตาล,กาแฟ,น้ำปลาตรามะขาม,ยาสีฟันตราประดู่,น้ำจิ้มซีฟู้ด', '2,1,1,1,1,1', '14,18,30,42,20,40', 0, '2022-04-24 00:12:32', 'bank', '../image/bank/1528614115สลิปโอนเงิน.jpg', 178, 2129793837),
(2, '8', '2,4,8', 'น้ำอัดลม,น้ำยาล้างจานสูตรมะกรูดตราเรือบิน,น้ำซีอิ้วขาวตรารวงข้าว', '1,1,1', '14,30,30', 0, '2022-04-24 23:17:28', 'bank', '../image/bank/1254090877สลิปโอนเงิน.jpg', 74, 1837933747),
(3, '7', '1,7,10', 'กาแฟ,ยาสีฟันตราประดู่,น้ำยาล้างจานตราเรือบิน', '1,1,1', '30,20,34', 90, '2022-04-24 23:40:20', 'cash', '0', 84, 2103398891),
(4, '8', '2,3,4', 'น้ำอัดลม,น้ำอัดลมไม่มีน้ำตาล,น้ำยาล้างจานสูตรมะกรูดตราเรือบิน', '1,1,1', '14,18,30', 0, '2022-04-24 23:49:31', 'bank', '0', 62, 2036992385),
(5, '7', '1,3', 'กาแฟ,น้ำอัดลมไม่มีน้ำตาล', '1,1', '30,18', 0, '2022-04-25 14:42:49', 'bank', '0', 48, 193438781);

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
(1, 'กาแฟ', '088421794218', '../image/item/1986830581coffee.png', '', '97', '30', 'เครื่องดื่ม', '-'),
(2, 'น้ำอัดลม', '105879478164', '../image/item/1495404627น้ำอัดลม.png', '', '26', '14', 'เครื่องดื่ม', '-'),
(3, 'น้ำอัดลมไม่มีน้ำตาล', '123487945213', '../image/item/662781956น้ำอัดลมไม่มีน้ำตาล.png', '', '297', '18', 'เครื่องดื่ม', '-'),
(4, 'น้ำยาล้างจานสูตรมะกรูดตราเรือบิน', '819476124913', '../image/item/373732343น้ำยาล้างจานสูตรมะกรูดตราเรือบิน.png', '', '108', '30', '-', 'เรือบิน'),
(5, 'น้ำจิ้มซีฟู้ด', '849736439431', '../image/item/203137910น้ำจิ้มซีฟู้ด.png', '', '59', '40', 'เครื่องปรุงอาหาร', '-'),
(6, 'น้ำปลาตรามะขาม', '894316748154', '../image/item/626552307น้ำปลาตรามะขาม.png', '', '59', '42', 'เครื่องปรุงอาหาร', 'มะขาม'),
(7, 'ยาสีฟันตราประดู่', '879256148765', '../image/item/922805028ยาสีฟันตราประดู่.png', '', '38', '20', 'ยาสีฟัน', 'ประดู่'),
(8, 'น้ำซีอิ้วขาวตรารวงข้าว', '975461345194', '../image/item/959763415น้ำซีอิ้วขาวตรารวงข้าว.png', '', '79', '30', 'เครื่องปรุงอาหาร', 'รวงข้าว'),
(9, 'น้ำยาล้างจานตรากระต่ายบิน', '764154341679', '../image/item/1053811927น้ำยาล้างจานตรากระต่ายบิน.png', '', '300', '68', '-', 'กระต่ายบิน'),
(10, 'น้ำยาล้างจานตราเรือบิน', '679124316754', '../image/item/144738287น้ำยาล้างจานตราเรือบิน.png', '', '79', '34', '-', 'เรือบิน');

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
(3, 'อย่าลืมแถม นมรสมินต์ให้ลูกค้า', 'เมื่อซื้อลูกชิ้นครบ 200 บาท ถึงวันที่ 25-04-2565', 1, '2022-04-25 21:47:49');

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
(1, '7', 'admin', 'logout', '2022-04-21 00:05:41//2022-04-21 12:05:47', '2022-04-21 00:05:41'),
(2, '7', 'admin', 'logout', '2022-04-22 12:08:36//2022-04-22 01:02:44', '2022-04-22 12:08:36'),
(3, '7', 'admin', 'logout', '2022-04-22 21:11:07//2022-04-24 02:01:48', '2022-04-22 21:11:07'),
(4, '7', 'admin', 'logout', '2022-04-23 21:01:53//2022-04-24 02:31:45', '2022-04-23 21:01:53'),
(5, '7', 'admin', 'logout', '2022-04-24 02:01:49//2022-04-24 11:14:54', '2022-04-24 02:01:49'),
(6, '7', 'admin', 'logout', '2022-04-24 13:23:01//2022-04-24 11:48:05', '2022-04-24 13:23:01'),
(7, '7', 'admin', 'logout', '2022-04-24 22:33:52//2022-04-24 11:53:25', '2022-04-24 22:33:52'),
(8, '8', 'staff', 'logout', '2022-04-24 23:15:04//2022-04-24 11:19:16', '2022-04-24 23:15:04'),
(9, '7', 'admin', 'logout', '2022-04-24 23:19:23//2022-04-25 01:00:33', '2022-04-24 23:19:23'),
(10, '8', 'staff', 'logout', '2022-04-24 23:48:32//2022-04-24 11:49:58', '2022-04-24 23:48:32'),
(11, '7', 'admin', 'logout', '2022-04-24 23:50:00//2022-04-25 12:37:56', '2022-04-24 23:50:00'),
(12, '7', 'admin', 'logout', '2022-04-24 23:53:28//2022-04-25 02:03:45', '2022-04-24 23:53:28'),
(13, '7', 'admin', 'logout', '2022-04-25 01:23:55//2022-04-25 04:16:40', '2022-04-25 01:23:55'),
(14, '7', 'admin', 'logout', '2022-04-25 11:02:50//2022-04-25 06:17:53', '2022-04-25 11:02:50'),
(15, '7', 'admin', 'logout', '2022-04-25 13:08:20//2022-04-25 09:23:34', '2022-04-25 13:08:20'),
(16, '7', 'admin', 'logout', '2022-04-25 14:42:42//2022-04-25 10:57:48', '2022-04-25 14:42:42'),
(23, '7', 'admin', 'logout', '2022-05-01 17:04:01//2022-05-01 05:04:11', '2022-05-01 17:04:01'),
(24, '7', 'admin', 'logout', '2022-05-01 17:04:12//2022-05-01 05:04:14', '2022-05-01 17:04:12');

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
(7, 'admin', 'admin', '39561', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 1, '2022-04-07 23:38:47', '0', 0, '2022-05-01 17:04:12'),
(8, 'staff', 'staff', '6117', '9040a19ce8acee009516b4ea917066e06a5deb15f5879c5645bf3e9b7c8877e512be42bccdc08b2370194d9427adcf1855fce60036fa73f689a281d898fb1a48', 0, '2022-04-23 21:57:27', '0', 0, '2022-04-24 23:49:52');

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
  MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `history`
--
ALTER TABLE `history`
  MODIFY `id_history` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id_News` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
