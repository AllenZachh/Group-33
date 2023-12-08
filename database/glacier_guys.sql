-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2023 at 03:10 AM
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
  `userid` int(11) NOT NULL,
  `datePlaced` date NOT NULL
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
(25, 2, 50, 'Blue', 'XL', './images/Coat2Blue.png');

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
  `defaultImageFilePath` text NOT NULL,
  `hoverImageFilePath` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`productTypeid`, `name`, `keywords`, `price`, `description`, `defaultImageFilePath`, `hoverImageFilePath`) VALUES
(1, 'Coat 1', 'Winter, Coat, Puffer', '50', 'Winter Puffer Coat', './images/Coat1.png', './images/Coat1-hover.png'),
(2, 'Coat 2', 'Coat', '70', 'coat...', '', './images/Coat2-hover.png');

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
  `phoneNum` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `username`, `password`, `email`, `accountType`, `phoneNum`) VALUES
(1, 'Jacob Woodhouse', '$2y$10$4gmdX8rLuqkzGjms/Yy6IeftdaNR0nbeSUr5akO4zTn9evgRiM8ei', 'Jacobwoodhouse333@gmail.com', 'user', 0);

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
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `productTypeid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
