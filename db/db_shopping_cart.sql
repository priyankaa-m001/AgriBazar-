-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2021 at 02:51 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_shopping_cart`
--
CREATE DATABASE IF NOT EXISTS `db_shopping_cart` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_shopping_cart`;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ORDER_NO` varchar(45) NOT NULL DEFAULT '',
  `ORDER_DATE` date NOT NULL DEFAULT '0000-00-00',
  `UID` int(10) unsigned NOT NULL DEFAULT '0',
  `TOTAL_AMT` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`OID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE IF NOT EXISTS `order_details` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `OID` int(10) unsigned NOT NULL DEFAULT '0',
  `PID` int(10) unsigned NOT NULL DEFAULT '0',
  `PNAME` varchar(45) NOT NULL DEFAULT '',
  `PRICE` double(10,2) NOT NULL DEFAULT '0.00',
  `QTY` int(10) unsigned NOT NULL DEFAULT '0',
  `TOTAL` double(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `PID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PRODUCT` varchar(45) NOT NULL DEFAULT '',
  `PRICE` double(10,2) NOT NULL DEFAULT '0.00',
  `IMAGE` varchar(45) NOT NULL DEFAULT '',
  `DESCRIPTION` text,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PID`, `PRODUCT`, `PRICE`, `IMAGE`, `DESCRIPTION`) VALUES
(2, 'Product 1', 100.00, '2.jpg', 'The boy walked down the street in a carefree way, playing without notice of what was about him. He didn''t hear the sound of the car as his ball careened into the road. He took a step toward it, and in doing so sealed his fate.'),
(3, 'Product 2', 75.00, '3.jpg', 'The boy walked down the street in a carefree way, playing without notice of what was about him. He didn''t hear the sound of the car as his ball careened into the road. He took a step toward it, and in doing so sealed his fate.'),
(4, 'Product 3', 45.00, '4.jpg', 'The boy walked down the street in a carefree way, playing without notice of what was about him. He didn''t hear the sound of the car as his ball careened into the road. He took a step toward it, and in doing so sealed his fate.'),
(5, 'Product 4', 85.00, '5.jpg', 'The boy walked down the street in a carefree way, playing without notice of what was about him. He didn''t hear the sound of the car as his ball careened into the road. He took a step toward it, and in doing so sealed his fate.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(150) NOT NULL DEFAULT '',
  `CONTACT` varchar(150) NOT NULL DEFAULT '',
  `ADDRESS` text,
  `CITY` varchar(45) NOT NULL DEFAULT '',
  `PINCODE` varchar(45) NOT NULL DEFAULT '',
  `EMAIL` varchar(45) NOT NULL DEFAULT '',
  PRIMARY KEY (`UID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
