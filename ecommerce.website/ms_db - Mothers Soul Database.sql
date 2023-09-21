-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 15, 2023 at 06:44 PM
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
-- Database: `ms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`) VALUES
(0, 'Admin1', 'Pass1'),
(0, 'Admin1', '1a8565a9dc72048ba03b4156be3e569f22771f23');

-- --------------------------------------------------------

--
-- Table structure for table `bag`
--

CREATE TABLE `bag` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `item_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `price` int(10) NOT NULL,
  `quantity` int(10) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bag`
--

INSERT INTO `bag` (`id`, `user_id`, `item_id`, `name`, `price`, `quantity`, `img`) VALUES
(7, 3, 0, 'The Meatiest Veggie ', 36, 1, 'burger.PNG'),
(27, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(28, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(29, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(30, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(31, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(32, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(33, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(34, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(35, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(36, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(37, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(38, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png'),
(39, 1, 4, 'Fresh Fruit Juice - ', 12, 1, 'Juice1.png');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(10) NOT NULL,
  `img_1` varchar(100) NOT NULL,
  `img_2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `details`, `price`, `img_1`, `img_2`) VALUES
(1, 'The Meatiest Veggie Burger - sandwich', 'This veggie burger has not one, but three secret ingredients in the mix. Tomato paste, Parmesan cheese, and soy sauce come together to infuse this veggie burger with a blast of umami for maximum flavor.', 36, 'burger.PNG', 'burger.PNG'),
(4, 'Fresh Fruit Juice - Drinks', 'Mother&#39;s Soul fruity flavored beverages. All are made  from locally picked fruits and mixed with spring water with no added sugar!', 12, 'Juice1.png', 'Juice2.png'),
(5, 'Muffins -Dessert', 'Our finest bakers make different flavored muffins just for you.', 5, 'muf1.png', 'muff2.png'),
(6, 'Chocolate Cakes - Dessert', 'Wonderful Chocolate Cakes', 25, 'Cake2.png', 'Cake.png'),
(7, 'Espresso -Drinks', 'Espresso!! No suger :)', 12, 'coffee.png', 'coffee.png'),
(8, 'Fried Salmon with Sweat Patato - Main', 'Pan-fried Salmon with Sweet Potato and tender asparagus.', 40, 'main1.png', 'main1.png'),
(9, 'Beer - Drinks', 'Beer', 20, 'beer1.jpg', 'beer2.jpg'),
(10, 'French Fries - Appetizer', 'Not from France but just as fancy!', 15, 'ff1.jpg', 'ff2.jpg'),
(11, 'Hot Grilled Park with Rice - Main', 'Hot Grilled Park with Rice', 40, 'r1.jpg', 'r2.jpg'),
(12, 'Fried Rice - Main', 'What some Asian-styled take out here you are! A Chinese and Indian blend of rice.', 35, 'r11.jpg', 'r21.jpg'),
(13, 'CocaCola - Drinks', 'CocaCola Classic 340ml', 15, 'c.jpg', 'c1.jpg'),
(14, 'Pepsi - Drinks', 'Classic Pepsi Cola 340ml', 13, 'p.jpg', 'p2.jpg'),
(15, 'Avacado Salad - Appetizer', 'Delightful Avo Salad', 10, 'av.jpg', 'av.jpg'),
(16, 'Crumbed Mushrooms - Appetizer', 'Crumbed Mushrooms', 10, 'mush.jpg', 'mush.jpg'),
(17, 'Bean Salad - Appetizer', 'Bean Salad', 10, 'bean.jpg', 'bean.jpg'),
(18, 'Bunny Chow - Appetizer', 'Bunny Chow', 15, 'chow.jpg', 'chow.jpg'),
(19, 'Grilled  Lamb Chops Pizza Delux - Main', 'Grilled  Lamb Chops Pizza Delux', 186, 'chops.jpg', 'chops.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `number` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `payment_option` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `item_total` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `transaction_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `payment_option`, `address`, `item_total`, `total_price`, `order_date`, `transaction_status`) VALUES
(1, 1, 'test', 670416560, 'test@gmail.com', '', 'flat no. 11 - 1', 'The Meatiest Veggie  (36 x 1) - Fresh Fruit Juice -  (12 x 1) - ', 48, '2023-06-03', 'completed'),
(2, 1, 'test', 670416560, 'test@gmail.com', 'paytm', 'flat no. 11 - 1', 'Muffins -Dessert (5 x 3) - Fried Salmon with Sw (40 x 1) - ', 55, '2023-06-03', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'test', 'test@gmail.com', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3'),
(2, 'Person', 'person@email.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef'),
(3, 'John', 'mrwick@email.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bag`
--
ALTER TABLE `bag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bag`
--
ALTER TABLE `bag`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
