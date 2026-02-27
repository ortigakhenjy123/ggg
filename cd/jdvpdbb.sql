-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2026 at 04:31 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jdvpdbb`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `qty_ordered` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `payment_method` varchar(50) NOT NULL,
  `payment_details` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `user_name`, `address`, `mobile_number`, `qty_ordered`, `total_amount`, `order_date`, `payment_method`, `payment_details`) VALUES
(1, 39, 'wdsd', 'dsds', '', 1, 69.00, '2026-02-27 02:09:18', '', NULL),
(2, 31, 'dcdsc', 'sdsad', '', 1, 123.00, '2026-02-27 02:09:49', '', NULL),
(3, 31, 'dvfsvsfv', '342432', '', 2, 246.00, '2026-02-27 02:10:50', '', NULL),
(4, 31, 'dwasd', 'sads', '22e3', 1, 123.00, '2026-02-27 02:12:59', '', NULL),
(5, 39, 'fers', 's123dsfddc', '22322313', 1, 0.00, '2026-02-27 02:52:59', 'COD', 'N/A (COD)'),
(6, 31, 'sc', 'cad', '2323', 1, 0.00, '2026-02-27 02:53:49', 'COD', 'N/A (COD)'),
(7, 31, 'wew', 'wew', '11111', 1, 0.00, '2026-02-27 02:55:55', 'GCash', '1111'),
(8, 39, 'popopo', 'popopo', '1222', 1, 0.00, '2026-02-27 02:56:42', 'Bank Transfer', '2132312'),
(9, 39, '121', '1212', '1212', 1, 0.00, '2026-02-27 02:57:11', 'COD', 'N/A (COD)'),
(10, 31, '1212', '12121', '1212', 2, 0.00, '2026-02-27 02:58:21', 'Bank Transfer', '12121');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `desc`, `img`, `price`, `quantity`) VALUES
(31, 'GULAY', 'fod', 'vg3.jpg', 123.00, 0),
(39, 'LAYGU', 'wa', 'vg.jpg', 69.00, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
