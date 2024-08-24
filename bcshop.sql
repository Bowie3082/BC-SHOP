-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2024 at 04:20 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bcshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_admin`
--

CREATE TABLE `tb_admin` (
  `aid` int(11) NOT NULL,
  `aname` varchar(100) DEFAULT NULL,
  `aemail` varchar(100) DEFAULT NULL,
  `apassword` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_admin`
--

INSERT INTO `tb_admin` (`aid`, `aname`, `aemail`, `apassword`) VALUES
(1, 'sill', 'sill062@gmail.com', 'sill1234'),
(2, 'brianna', 'brianna00@gmail.com', 'brianna00'),
(3, 'earth', 'papadchaya.04@gmail.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `tb_member`
--

CREATE TABLE `tb_member` (
  `mid` int(10) NOT NULL,
  `mname` varchar(255) DEFAULT NULL,
  `mgender` char(2) DEFAULT NULL,
  `maddress` text,
  `mprovince` varchar(255) DEFAULT NULL,
  `mphone` varchar(50) DEFAULT NULL,
  `memail` varchar(255) DEFAULT NULL,
  `mpass` varchar(255) DEFAULT NULL,
  `mpicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tb_member`
--

INSERT INTO `tb_member` (`mid`, `mname`, `mgender`, `maddress`, `mprovince`, `mphone`, `memail`, `mpass`, `mpicture`) VALUES
(11, 'PP', 'F', 'UD', 'หนองคาย', '0614589631', 'pp117@gmail.com', 'pp117', '21912.png'),
(12, 'gg', 'F', 'ทุ่งฝน/หนองหาน', 'อุดรธานี', '0923233686', 'gg@gmail.com', 'gg44444', 'gg.png'),
(13, 'Bowie ', 'F', '1148/25 UD', 'อุดรธานี', '0930568980', 'ratsamee299@gmail.com', 'BB1234', '21911.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(11) NOT NULL,
  `mid` int(10) NOT NULL,
  `order_date` datetime NOT NULL,
  `order_fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order_address` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `order_province` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_phone` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `order_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `mid`, `order_date`, `order_fullname`, `order_address`, `order_province`, `order_phone`, `order_email`, `order_status`) VALUES
(27, 0, '2024-02-15 11:07:29', 'Ratsamee', 'Udon 1111122223', 'Udon', '0640988920', 'sill1234@gmail.com', '1'),
(38, 11, '2024-03-08 10:52:03', 'Eart', '148/89 ', 'Udon', '0912365487', '64040427138@udru.ac.th', '1'),
(39, 11, '2024-03-10 15:00:42', 'PP', '117/64 UD', 'Udon', '0822222256', 'Part0177@gmail.com', '0'),
(40, 11, '2024-03-10 15:52:05', 'PP', '117/64 US		', 'Udon', '0640988920', '117PP@udru.ac.th', '0'),
(36, 11, '2024-03-08 10:48:28', 'PP', '148 โนนสูง\r\n', 'Udon', '0640988520', '64040427112@udru.ac.th', '2'),
(41, 13, '2024-03-10 16:17:29', 'Bowie ', '114/45 UD	', 'UD', '0640988920', 'BB12548@gmail.com', '0'),
(42, 11, '2024-06-14 10:39:40', 'PP', ' 				', '', '', 'pp117@gmail.com', '0'),
(43, 11, '2024-06-14 10:40:17', 'PP', ' 				', '', '', 'pp117@gmail.comF', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `detail_id` int(11) NOT NULL,
  `detail_qty` tinyint(4) NOT NULL,
  `detail_price` decimal(10,2) NOT NULL,
  `pid` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tb_order_detail`
--

INSERT INTO `tb_order_detail` (`detail_id`, `detail_qty`, `detail_price`, `pid`, `order_id`) VALUES
(22, 5, '2600.00', 7, 27),
(23, 6, '2900.00', 8, 27),
(24, 8, '290.00', 10, 27),
(25, 1, '2900.00', 8, 29),
(26, 1, '290.00', 1, 30),
(27, 1, '290.00', 1, 31),
(28, 1, '290.00', 1, 32),
(29, 1, '290.00', 1, 33),
(30, 1, '290.00', 1, 34),
(31, 1, '1229.00', 3, 35),
(32, 1, '390.00', 13, 36),
(33, 1, '1229.00', 3, 37),
(34, 1, '250.00', 9, 37),
(35, 1, '599.00', 11, 38),
(36, 1, '390.00', 13, 38),
(37, 1, '390.00', 13, 39),
(38, 1, '599.00', 11, 40),
(39, 1, '390.00', 13, 40),
(40, 1, '1229.00', 3, 41),
(41, 1, '390.00', 13, 42),
(42, 1, '699.00', 12, 43);

-- --------------------------------------------------------

--
-- Table structure for table `tb_product`
--

CREATE TABLE `tb_product` (
  `pid` int(10) NOT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `ptype` char(2) DEFAULT NULL,
  `pdetail` text,
  `pqty` int(10) DEFAULT NULL,
  `pprice` decimal(10,2) DEFAULT NULL,
  `ppicture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tb_product`
--

INSERT INTO `tb_product` (`pid`, `pname`, `ptype`, `pdetail`, `pqty`, `pprice`, `ppicture`) VALUES
(2, 'คามีเดรส สีชมพู ', '2', 'ชุดเดรส สีชมพู Chloe Design 7047 Size S-M', 20, '1259.00', 'เดรส4.jpg'),
(3, 'เดรส สีพื้น เปิดไหล่ สายสปาเก็ตตี้', '2', 'ชุดเดรส สีขาว Chloe Design 7047 Size S-M', 20, '1229.00', 'เดรส1.jpg'),
(4, 'เดรส สีฟ้าธรรมชาติ', '2', 'ชุดเดรส สีฟ้า Chloe Design 7047 Size S-M', 15, '1559.00', 'เดรส3.jpg'),
(5, 'เดรสสีพื้น', '2', 'ชุดเดรสสีดำ Chloe Design 7047 Size S-M', 20, '1669.00', 'เดรส2.jpg'),
(6, 'เสื้อยืด U คอกลม แขนสั้น', '', 'เสื้อยืดสีขาว', 25, '599.00', 'เสื้อยืดขาว.png'),
(7, 'เสื้อเชิ้ตสีดำ', '1', 'เสื้อเชิ้ตสีดำแขนยาว ใส่สบาย', 15, '699.00', '1.jpg'),
(8, 'เสื้อยืดแฟชั่นเกาหลี', '1', 'เสื้อยืดแฟชั่นเกาหลีสไตล์น่ารัก', 20, '299.00', '2.jpg'),
(9, 'เสื้อครอป', '1', 'เสื้อครอปผู้หญิงสีม่วง', 15, '250.00', '3.jpg'),
(10, 'กางเกงยีนส์(ผู้หญิง)', '3', 'เบสิโค กางเกงยีนส์กระเป๋าข้าง สำหรับผู้หญิง ', 15, '599.00', '4.jpg'),
(11, 'กางเกงขายาวเอวยาง(ผู้ชาย)', '3', 'เบสิโค กางเกงขายาวเอวยาง ', 20, '599.00', '5.jpg'),
(12, 'กางเกงขาสั้น', '3', 'กางเกงขาสั้นคาโก้', 15, '699.00', '6.jpg'),
(13, 'กางเกงขายาวไนล่อน', '', 'กางเกงขายาวย่นข้าง ผ้าไนล่อน สไตล์สาว y2k ', 20, '390.00', '7.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_admin`
--
ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`aid`);

--
-- Indexes for table `tb_member`
--
ALTER TABLE `tb_member`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD PRIMARY KEY (`detail_id`);

--
-- Indexes for table `tb_product`
--
ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_admin`
--
ALTER TABLE `tb_admin`
  MODIFY `aid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_member`
--
ALTER TABLE `tb_member`
  MODIFY `mid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tb_product`
--
ALTER TABLE `tb_product`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
