-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2024 at 10:35 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glacier_guys`
--

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderid` int(11) NOT NULL,
  `userid` int(11) DEFAULT NULL,
  `datePlaced` date NOT NULL,
  `totalPrice` int(11) NOT NULL,
  `fullName` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `phoneNumber` varchar(16) NOT NULL,
  `country` varchar(8) NOT NULL,
  `city` varchar(32) NOT NULL,
  `address` varchar(64) NOT NULL,
  `postcode` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderitems`
--

CREATE TABLE `orderitems` (
  `orderItemsid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productid` int(11) NOT NULL,
  `productTypeid` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `colour` text NOT NULL,
  `size` text NOT NULL,
  `imageFilePath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productid`, `productTypeid`, `stock`, `colour`, `size`, `imageFilePath`) VALUES
(1, 1, 50, 'Green', 'XS', './images/Coat1.png'),
(2, 1, 50, 'Green', 'S', './images/Coat1.png'),
(3, 1, 50, 'Green', 'M', './images/Coat1.png'),
(4, 1, 50, 'Green', 'L', './images/Coat1.png'),
(5, 1, 50, 'Green', 'XL', './images/Coat1.png'),
(6, 1, 50, 'Red', 'XS', './images/Coat1Red.png'),
(7, 1, 50, 'Red', 'S', './images/Coat1Red.png'),
(8, 1, 50, 'Red', 'M', './images/Coat1Red.png'),
(9, 1, 50, 'Red', 'L', './images/Coat1Red.png'),
(10, 1, 50, 'Red', 'XL', './images/Coat1Red.png'),
(11, 1, 50, 'Blue', 'XS', './images/Coat1Blue.png'),
(12, 1, 50, 'Blue', 'S', './images/Coat1Blue.png'),
(13, 1, 50, 'Blue', 'M', './images/Coat1Blue.png'),
(14, 1, 50, 'Blue', 'L', './images/Coat1Blue.png'),
(15, 1, 50, 'Blue', 'XL', './images/Coat1Blue.png'),
(16, 2, 50, 'Orange', 'XS', './images/Coat2.png'),
(17, 2, 50, 'Orange', 'S', './images/Coat2.png'),
(18, 2, 50, 'Orange', 'M', './images/Coat2.png'),
(19, 2, 50, 'Orange', 'L', './images/Coat2.png'),
(20, 2, 50, 'Orange', 'XL', './images/Coat2.png'),
(21, 2, 50, 'Blue', 'XS', './images/Coat2Blue.png'),
(22, 2, 50, 'Blue', 'S', './images/Coat2Blue.png'),
(23, 2, 50, 'Blue', 'M', './images/Coat2Blue.png'),
(24, 2, 50, 'Blue', 'L', './images/Coat2Blue.png'),
(25, 2, 50, 'Blue', 'XL', './images/Coat2Blue.png'),
(26, 3, 50, 'Mustard', 'XS', './images/Coat3.png'),
(27, 3, 50, 'Mustard', 'S', './images/Coat3.png'),
(28, 3, 50, 'Mustard', 'M', './images/Coat3.png'),
(29, 3, 50, 'Mustard', 'L', './images/Coat3.png'),
(30, 3, 50, 'Mustard', 'XL', './images/Coat3.png'),
(31, 3, 50, 'Green', 'XS', './images/Coat3Green.png'),
(32, 3, 50, 'Green', 'S', './images/Coat3Green.png'),
(33, 3, 50, 'Green', 'M', './images/Coat3Green.png'),
(34, 3, 50, 'Green', 'L', './images/Coat3Green.png'),
(35, 3, 50, 'Green', 'XL', './images/Coat3Green.png'),
(36, 3, 50, 'Silver', 'XS', './images/Coat3Silver.png'),
(37, 3, 50, 'Silver', 'S', './images/Coat3Silver.png'),
(38, 3, 50, 'Silver', 'M', './images/Coat3Silver.png'),
(39, 3, 50, 'Silver', 'L', './images/Coat3Silver.png'),
(40, 3, 50, 'Silver', 'XL', './images/Coat3Silver.png'),
(41, 4, 50, 'Black', 'XS', './images/Coat4.png'),
(42, 4, 50, 'Black', 'S', './images/Coat4.png'),
(43, 4, 50, 'Black', 'M', './images/Coat4.png'),
(44, 4, 50, 'Black', 'L', './images/Coat4.png'),
(45, 4, 50, 'Black', 'XL', './images/Coat4.png'),
(46, 5, 50, 'Brown', 'XS', './images/Coat5.png'),
(47, 5, 50, 'Brown', 'S', './images/Coat5.png'),
(48, 5, 50, 'Brown', 'M', './images/Coat5.png'),
(49, 5, 50, 'Brown', 'L', './images/Coat5.png'),
(50, 5, 50, 'Brown', 'XL', './images/Coat5.png'),
(51, 5, 50, 'Black', 'XS', './images/Coat5Black.png'),
(52, 5, 50, 'Black', 'S', './images/Coat5Black.png'),
(53, 5, 50, 'Black', 'M', './images/Coat5Black.png'),
(54, 5, 50, 'Black', 'L', './images/Coat5Black.png'),
(55, 5, 50, 'Black', 'XL', './images/Coat5Black.png'),
(56, 5, 50, 'Blue', 'XS', './images/Coat5Blue.png'),
(57, 5, 50, 'Blue', 'S', './images/Coat5Blue.png'),
(58, 5, 50, 'Blue', 'M', './images/Coat5Blue.png'),
(59, 5, 50, 'Blue', 'L', './images/Coat5Blue.png'),
(60, 5, 50, 'Blue', 'XL', './images/Coat5Blue.png'),
(61, 5, 50, 'Green', 'XS', './images/Coat5Green.png'),
(62, 5, 50, 'Green', 'S', './images/Coat5Green.png'),
(63, 5, 50, 'Green', 'M', './images/Coat5Green.png'),
(64, 5, 50, 'Green', 'L', './images/Coat5Green.png'),
(65, 5, 50, 'Green', 'XL', './images/Coat5Green.png'),
(66, 5, 50, 'Yellow', 'XS', './images/Coat5Yellow.png'),
(67, 5, 50, 'Yellow', 'S', './images/Coat5Yellow.png'),
(68, 5, 50, 'Yellow', 'M', './images/Coat5Yellow.png'),
(69, 5, 50, 'Yellow', 'L', './images/Coat5Yellow.png'),
(70, 5, 50, 'Yellow', 'XL', './images/Coat5Yellow.png'),
(71, 6, 50, 'Beige', 'XS', './images/Hat1.png'),
(72, 6, 50, 'Beige', 'S', './images/Hat1.png'),
(73, 6, 50, 'Beige', 'M', './images/Hat1.png'),
(74, 6, 50, 'Beige', 'L', './images/Hat1.png'),
(75, 6, 50, 'Beige', 'XL', './images/Hat1.png'),
(76, 6, 50, 'Black', 'XS', './images/Hat1Black.png'),
(77, 6, 50, 'Black', 'S', './images/Hat1Black.png'),
(78, 6, 50, 'Black', 'M', './images/Hat1Black.png'),
(79, 6, 50, 'Black', 'L', './images/Hat1Black.png'),
(80, 6, 50, 'Black', 'XL', './images/Hat1Black.png'),
(81, 6, 50, 'White', 'XS', './images/Hat1White.png'),
(82, 6, 50, 'White', 'S', './images/Hat1White.png'),
(83, 6, 50, 'White', 'M', './images/Hat1White.png'),
(84, 6, 50, 'White', 'L', './images/Hat1White.png'),
(85, 6, 50, 'White', 'XL', './images/Hat1White.png'),
(86, 7, 50, 'Navy Blue', 'XS', './images/Hat3.png'),
(87, 7, 50, 'Navy Blue', 'S', './images/Hat3.png'),
(88, 7, 50, 'Navy Blue', 'M', './images/Hat3.png'),
(89, 7, 50, 'Navy Blue', 'L', './images/Hat3.png'),
(90, 7, 50, 'Navy Blue', 'XL', './images/Hat3.png'),
(91, 7, 50, 'Green', 'XS', './images/Hat3Green.png'),
(92, 7, 50, 'Green', 'S', './images/Hat3Green.png'),
(93, 7, 50, 'Green', 'M', './images/Hat3Green.png'),
(94, 7, 50, 'Green', 'L', './images/Hat3Green.png'),
(95, 7, 50, 'Green', 'XL', './images/Hat3Green.png'),
(96, 7, 50, 'Orange', 'XS', './images/Hat3Orange.png'),
(97, 7, 50, 'Orange', 'S', './images/Hat3Orange.png'),
(98, 7, 50, 'Orange', 'M', './images/Hat3Orange.png'),
(99, 7, 50, 'Orange', 'L', './images/Hat3Orange.png'),
(100, 7, 50, 'Orange', 'XL', './images/Hat3Orange.png'),
(101, 11, 78, 'Orange', 'XS', './images/Sturdy Winter Boot.png'),
(102, 11, 43, 'Orange', 'S', './images/Sturdy Winter Boot.png'),
(103, 11, 12, 'Orange', 'M', './images/Sturdy Winter Boot.png'),
(104, 11, 32, 'Orange', 'L', './images/Sturdy Winter Boot.png'),
(105, 11, 65, 'Orange', 'XL', './images/Sturdy Winter Boot.png');

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `productTypeid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `keywords` text NOT NULL,
  `price` varchar(8) NOT NULL,
  `description` text NOT NULL,
  `hoverImageFilePath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`productTypeid`, `name`, `keywords`, `price`, `description`, `hoverImageFilePath`) VALUES
(1, 'Coat 1', 'Winter, Coat, Puffer', '50', 'Winter Puffer Coat', './images/Coat1-hover.png'),
(2, 'Coat 2', 'Coat', '70', 'coat...', './images/Coat2-hover.png'),
(3, 'Coat 3', 'Coat, Winter', '80', 'Winter Coat perfect for walks in the snow!', './images/Coat3-hover.png'),
(4, 'Coat 4', 'Coat', '80', '', './images/Coat4-hover.png'),
(5, 'Coat 5', 'Coat', '50', '', './images/Coat5-hover.png'),
(6, 'Beanie', 'Hat', '20', '', './images/Hat1-hover.png'),
(7, 'Logo Beanie', 'Hat', '25', '', './images/Hat3-hover.png'),
(8, 'Trapper Hat', 'Hat', '25', '', './images/Hat4-hover.png'),
(9, 'Bobble Hat', 'Hat', '30', '', './images/Hat5-hover.png'),
(10, 'Boot', 'Boot', '30', '', './images/Boot1-hover.png'),
(11, 'Sturdy Winter Boot', 'Boots Sturdy Hiking Snow', '70', 'Sturdy winter boots ideal for long walks in the snow!', './images/Sturdy Winter Boot.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `accountType` varchar(8) NOT NULL,
  `basket` text NOT NULL,
  `phoneNum` int(11) NOT NULL,
  `address1` varchar(64) NOT NULL,
  `address2` varchar(64) NOT NULL,
  `country` varchar(8) NOT NULL,
  `postcode` text NOT NULL,
  `city` varchar(32) NOT NULL,
  `fullName` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `accountType`, `basket`, `phoneNum`, `address1`, `address2`, `country`, `postcode`, `city`, `fullName`) VALUES
(1, 'Jacob Woodhouse', '$2y$10$4gmdX8rLuqkzGjms/Yy6IeftdaNR0nbeSUr5akO4zTn9evgRiM8ei', 'Jacobwoodhouse333@gmail.com', 'user', '[26]', 0, 'Aston St', '', 'UK', 'B4 7ET', 'Birmingham', ''),
(2, 'Jacob', '$2y$10$nMaxWk.2dGHEASYracqYA.R0msR5Jw8.YstmawNWa/0yUodMpF/Ua', '220219442@aston.ac.uk', 'admin', '', 0, '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderid`),
  ADD KEY `order_user` (`userid`);

--
-- Indexes for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`orderItemsid`),
  ADD KEY `orderid` (`orderid`),
  ADD KEY `productid` (`productid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `productTypeid` (`productTypeid`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`productTypeid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `orderItemsid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `productTypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_user` FOREIGN KEY (`userid`) REFERENCES `user` (`userid`);

--
-- Constraints for table `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems-order` FOREIGN KEY (`orderid`) REFERENCES `order` (`orderid`),
  ADD CONSTRAINT `orderitems-product` FOREIGN KEY (`productid`) REFERENCES `product` (`productid`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_producttype` FOREIGN KEY (`productTypeid`) REFERENCES `producttype` (`productTypeid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
