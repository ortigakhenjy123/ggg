-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2026 at 04:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
  `payment_method` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `product_id`, `user_name`, `address`, `mobile_number`, `qty_ordered`, `total_amount`, `order_date`, `payment_method`) VALUES
(9, 39, '121', '1212', '1212', 1, 0.00, '2026-02-27 02:57:11', 'COD'),
(10, 31, '1212', '12121', '1212', 2, 0.00, '2026-02-27 02:58:21', 'Bank Transfer'),
(11, 39, 'wewe', 'wewe', '11111', 1, 0.00, '2026-03-22 12:59:02', 'COD'),
(12, 31, 'ghh', 'ooo', '9999999999', 1, 0.00, '2026-03-22 12:59:52', 'COD'),
(13, 31, 'ghh', 'ooo', '9999999999', 1, 0.00, '2026-03-22 13:00:21', 'COD'),
(14, 31, 'ghh', 'ooo', '9999999999', 1, 0.00, '2026-03-22 15:29:33', 'COD'),
(15, 39, 'wewe', 'wewe', '11111', 1, 0.00, '2026-03-22 15:30:44', 'GCash'),
(16, 31, 'wewe', 'ooo', '9999999999', 1, 0.00, '2026-03-22 15:31:43', 'COD'),
(17, 39, 'wewe', 'wewe', '11111', 1, 0.00, '2026-03-22 15:31:55', 'GCash'),
(18, 31, 'wewe', 'ooo', '9999999999', 1, 0.00, '2026-03-22 15:33:01', 'Bank Transfer'),
(19, 39, 'wewe', 'wewe', '11111', 2, 138.00, '2026-03-22 15:35:28', 'GCash'),
(20, 31, 'wewe', 'ooo', '9999999999', 2, 246.00, '2026-03-22 15:40:00', 'Bank Transfer'),
(21, 31, 'wewe', 'ooo', '9999999999', 2, 246.00, '2026-03-22 15:41:01', 'COD');

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
(31, 'GULAY', 'fod', 'vg3.jpg', 123.00, 89),
(39, 'LAYGU', 'wa', 'vg.jpg', 69.00, 98);

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
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
