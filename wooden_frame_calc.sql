-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 09:10 AM
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
-- Database: `wooden_frame_calc`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `order_id` int(3) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `product_id` int(3) NOT NULL,
  `width` float DEFAULT NULL,
  `height` float DEFAULT NULL,
  `quantity` int(3) DEFAULT 1,
  `order_status` enum('on','off') DEFAULT 'on',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`order_id`, `session_id`, `product_id`, `width`, `height`, `quantity`, `order_status`, `created_at`) VALUES
(1, 'vnjljiukeri42j8nj2kq70vkee', 1, 10, 10, 2, 'on', '2024-09-22 05:25:58'),
(2, 'vnjljiukeri42j8nj2kq70vkee', 2, 12, 16, 1, 'off', '2024-09-22 06:04:29'),
(3, 'vnjljiukeri42j8nj2kq70vkee', 5, 40, 24, 3, 'on', '2024-09-22 06:12:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `product_id` int(3) UNSIGNED NOT NULL,
  `product_sku` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_status` enum('on','off') NOT NULL DEFAULT 'on',
  `entry_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`product_id`, `product_sku`, `product_name`, `product_price`, `product_status`, `entry_datetime`) VALUES
(1, '001', 'Classic Wooden Frame', 10.00, 'on', '2024-09-21 21:54:47'),
(2, '002', 'Vintage Wooden Frame', 14.00, 'on', '2024-09-21 21:54:47'),
(3, '003', 'Texture Wooden Frame', 15.00, 'on', '2024-09-21 21:57:34'),
(4, '004', 'Artistic Wooden Frame', 22.00, 'on', '2024-09-21 21:57:34'),
(5, '005', 'Plain Wooden Frame', 8.00, 'on', '2024-09-21 21:57:34');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `order_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `product_id` int(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
