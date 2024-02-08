-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2024 at 07:35 AM
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
-- Database: `digimenu`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cid` int(4) NOT NULL,
  `pid` int(2) NOT NULL,
  `size` varchar(4) NOT NULL,
  `qty` int(2) NOT NULL,
  `oid` int(3) NOT NULL,
  `payment` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cid`, `pid`, `size`, `qty`, `oid`, `payment`) VALUES
(17, 1, 'half', 1, 14, 0);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(2) NOT NULL,
  `img` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `price` int(3) NOT NULL,
  `description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `img`, `name`, `price`, `description`) VALUES
(1, 'img/biryani.jpeg', 'Biryani', 250, 'Fragrant rice dish with meat or vegetables cooked with spices and saffron'),
(2, 'img/butterchicken.jpeg', 'Butter Chicken', 300, 'Chicken cooked in a creamy tomato-based sauce with butter and spices'),
(3, 'img/pannertikka.jpeg', 'Paneer Tikka', 200, 'Grilled cubes of paneer marinated in spices and yogurt'),
(4, 'img/dalmakhni.jpeg', 'Dal Makhani', 150, 'Creamy lentil dish cooked with butter and spices'),
(5, 'img/palakpaneer.jpeg', 'Palak Paneer', 220, 'Cubes of paneer cooked in a spinach-based gravy with spices'),
(6, 'img/tandoorichicken.jpeg', 'Tandoori Chicken', 280, 'Chicken marinated in yogurt and spices, grilled in a tandoor oven'),
(7, 'img/chickentikkamasala.jpeg', 'Chicken Tikka Masala', 280, 'Chunks of chicken cooked in a spicy tomato-based sauce with cream'),
(8, 'img/naan.jpeg', 'Naan', 50, 'Leavened Indian bread baked in a tandoor oven'),
(9, 'img/samosa.jpeg', 'Samosa', 30, 'Crispy pastry filled with spiced potatoes and peas'),
(10, 'img/raita.jpeg', 'Raita', 40, 'Yogurt mixed with grated cucumber, tomatoes, and spices');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `fk_menu_pid` (`pid`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cid` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_menu_pid` FOREIGN KEY (`pid`) REFERENCES `menu` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
