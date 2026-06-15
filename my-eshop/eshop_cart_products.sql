-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2024 at 01:51 AM
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
-- Database: `eshop_cart_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(7, 2, 2, 1),
(8, 2, 5, 3),
(9, NULL, 1, 1),
(10, NULL, 1, 1),
(0, 0, 1, 1),
(0, 0, 4, 1),
(0, 0, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(1, 'CPU', 'Central Processing Units'),
(2, 'GPU', 'Graphics Processing Units'),
(3, 'Motherboard', 'Motherboards'),
(4, 'RAM', 'Memory Modules'),
(5, 'Storage', 'Hard Drives and SSDs'),
(6, 'PSU', 'Power Supply Units'),
(7, 'Case', 'Computer Cases');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `image`, `price`) VALUES
(1, 1, 'Intel Core i9-9900K', '8-Core, 16-Thread, 3.6 GHz Base Frequency', 'uploads/i9_9900k.jpg', 499.99),
(2, 2, 'NVIDIA GeForce RTX 3080', '10GB GDDR6X, 8704 CUDA Cores', 'uploads/rtx3080.jpeg', 699.99),
(3, 3, 'ASUS ROG Strix Z490-E', 'LGA 1200, ATX, 14+2 Power Stages', 'uploads/asus_mb.jpeg', 299.99),
(4, 4, 'Corsair Vengeance LPX 16GB', 'DDR4 3200MHz, C16, 2x8GB', 'uploads/corsair_ram.jpeg', 89.99),
(5, 5, 'Samsung 970 EVO Plus 1TB', 'NVMe M.2, Read 3500MB/s, Write 3300MB/s', 'uploads/samsung_1TB.jpeg', 169.99),
(6, 6, 'Corsair RM850x', '850W, 80+ Gold Certified, Fully Modular', 'uploads/psu_850.jpeg', 129.99),
(7, 7, 'NZXT H510', 'Mid Tower, Tempered Glass, ATX', 'uploads/nzxt.jpeg', 89.99),
(8, 1, 'AMD Ryzen 5 5600X 3.7GHz', 'cores: 6 Threads12\r\nBase Frequency: 3,7 GHz\r\nMaximum Frequency 4,6 GHz', 'uploads/ryzen5.png', 149.99),
(9, 2, 'Sapphire Radeon RX 6600', '8GB GDDR6, 128bit', 'uploads/radeon6600.jpeg', 249.99),
(10, 3, 'MSI Mag B650 Tomahawk WIFI', 'AMD AM5 Socket,ATX', 'uploads/msi_mb.jpeg', 199.99),
(11, 4, 'G.SKill Trident Z5 RGB 32GB', 'DDR5 6400MHz,C32,2x16GB', 'uploads/trident_ram.jpeg', 149.99),
(12, 5, 'Kingston NV2 SSD 500GB', 'M.2Read Speed 3500 MB/s,Writespeed 2800MB/s', 'uploads/kingston_ssd.jpeg', 45.99),
(13, 6, 'Be Quiet System Power 10 550W', '550W,80+Bronze,Full Wired', 'uploads/bequiet_psu.jpeg', 59.99),
(14, 7, 'Cougar MX410 MESH-G RGB', 'Full tower,Tempered Glass,ATX', 'uploads/cougar.jpeg', 69.99),
(15, 1, 'Intel Core i7-11700', '8 cores, 16-Threads,2.5 GHz Base Frequency', 'uploads/intel_cpu.jpeg', 249.99);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
