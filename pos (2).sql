-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 12, 2022 at 03:50 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cus_filter` (IN `selected` VARCHAR(100))  select * from customer order by selected$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cus_filter_search` (IN `search` VARCHAR(100), IN `filter` VARCHAR(100))  select * from customer where Customer_Name like 'search%' order by filter$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cus_search` (IN `argu` VARCHAR(100))  select * from customer where Customer_Name like '$argu%'$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `cus_select` ()  select * from customer$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_customer` (IN `cus_id` INT)  delete from customer where Customer_id=cus_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `edit_cust` (IN `cus_name` VARCHAR(100), IN `cus_address` VARCHAR(100), IN `cus_phone` VARCHAR(100), IN `cus_id` INT, IN `cus_level` VARCHAR(100))  update Customer set Customer_Name = cus_name, Address = cus_address, Phone_Number = cus_phone, Customer_Id = cus_id, Level = cus_level where Customer_id = cus_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `in_customer` (IN `addr` VARCHAR(100), IN `cname` VARCHAR(100), IN `phonenum` VARCHAR(100), IN `inlevel` VARCHAR(100))  insert into Customer(Address, Customer_Name, Phone_Number, Level) values(addr, cname, phonenum, inlevel)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `in_food` (IN `food_name` VARCHAR(100), IN `unit_price` INT, IN `type_id` INT, IN `photo` VARCHAR(100))  insert into Food values(food_name, unit_price, NULL, type_id, photo)$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_food` ()  select * from Food$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE `Customer` (
  `Address` varchar(1000) NOT NULL,
  `Customer_Name` varchar(100) NOT NULL,
  `Customer_Id` int(11) NOT NULL,
  `Phone_Number` varchar(100) NOT NULL,
  `Level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`Address`, `Customer_Name`, `Customer_Id`, `Phone_Number`, `Level`) VALUES
('ផ្លូវលេខ ២១១អាគារ H, Phnom Penh', 'Juden Ung01', 1, '098578578', 'BRONZE');

-- --------------------------------------------------------

--
-- Table structure for table `Food`
--

CREATE TABLE `Food` (
  `Food_Name` varchar(100) NOT NULL,
  `Unit_Price` decimal(10,0) NOT NULL,
  `Food_Id` int(11) NOT NULL,
  `Type_Id` int(11) NOT NULL,
  `photo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Food`
--

INSERT INTO `Food` (`Food_Name`, `Unit_Price`, `Food_Id`, `Type_Id`, `photo`) VALUES
('Coca_Cola', '5', 1, 2, 'images/drinks/202207120346534692.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `Food_Type`
--

CREATE TABLE `Food_Type` (
  `Type_Id` int(11) NOT NULL,
  `Type_Name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Food_Type`
--

INSERT INTO `Food_Type` (`Type_Id`, `Type_Name`) VALUES
(1, 'Food'),
(2, 'Drink');

-- --------------------------------------------------------

--
-- Table structure for table `Invoice`
--

CREATE TABLE `Invoice` (
  `Order_Id` int(11) NOT NULL,
  `Invoice_Id` int(11) NOT NULL,
  `Discount` decimal(10,0) NOT NULL,
  `Grand_Total` decimal(10,0) NOT NULL,
  `Payment` decimal(10,0) NOT NULL,
  `Customer_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Order_Detail`
--

CREATE TABLE `Order_Detail` (
  `Id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Food_Id` int(11) NOT NULL,
  `Order_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Purchase_Order`
--

CREATE TABLE `Purchase_Order` (
  `Order_Id` int(11) NOT NULL,
  `Order_Date` date NOT NULL,
  `Sub_Total` decimal(10,0) NOT NULL,
  `Invoice_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `table_users`
--

CREATE TABLE `table_users` (
  `user_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `table_users`
--

INSERT INTO `table_users` (`user_id`, `password`, `username`) VALUES
(2, '0192023a7bbd73250516f069df18b500', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
  ADD PRIMARY KEY (`Customer_Id`);

--
-- Indexes for table `Food`
--
ALTER TABLE `Food`
  ADD PRIMARY KEY (`Food_Id`),
  ADD KEY `Type_Id` (`Type_Id`);

--
-- Indexes for table `Food_Type`
--
ALTER TABLE `Food_Type`
  ADD PRIMARY KEY (`Type_Id`);

--
-- Indexes for table `Invoice`
--
ALTER TABLE `Invoice`
  ADD PRIMARY KEY (`Invoice_Id`),
  ADD KEY `Customer_Id` (`Customer_Id`);

--
-- Indexes for table `Order_Detail`
--
ALTER TABLE `Order_Detail`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Food_Id` (`Food_Id`),
  ADD KEY `Order_Id` (`Order_Id`);

--
-- Indexes for table `Purchase_Order`
--
ALTER TABLE `Purchase_Order`
  ADD PRIMARY KEY (`Order_Id`),
  ADD KEY `Invoice_Id` (`Invoice_Id`);

--
-- Indexes for table `table_users`
--
ALTER TABLE `table_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Customer`
--
ALTER TABLE `Customer`
  MODIFY `Customer_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Food`
--
ALTER TABLE `Food`
  MODIFY `Food_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Food_Type`
--
ALTER TABLE `Food_Type`
  MODIFY `Type_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Invoice`
--
ALTER TABLE `Invoice`
  MODIFY `Invoice_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Order_Detail`
--
ALTER TABLE `Order_Detail`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Purchase_Order`
--
ALTER TABLE `Purchase_Order`
  MODIFY `Order_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `table_users`
--
ALTER TABLE `table_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Food`
--
ALTER TABLE `Food`
  ADD CONSTRAINT `food_ibfk_1` FOREIGN KEY (`Type_Id`) REFERENCES `Food_Type` (`Type_Id`);

--
-- Constraints for table `Invoice`
--
ALTER TABLE `Invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`Customer_Id`) REFERENCES `Customer` (`Customer_Id`);

--
-- Constraints for table `Order_Detail`
--
ALTER TABLE `Order_Detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`Food_Id`) REFERENCES `Food` (`Food_Id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`Order_Id`) REFERENCES `Purchase_Order` (`Order_Id`);

--
-- Constraints for table `Purchase_Order`
--
ALTER TABLE `Purchase_Order`
  ADD CONSTRAINT `purchase_order_ibfk_1` FOREIGN KEY (`Invoice_Id`) REFERENCES `Invoice` (`Invoice_Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
