-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 03, 2023 at 05:29 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs_project_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `time_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `amount` double NOT NULL,
  `info` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `time_log`, `amount`, `info`) VALUES
(1, '2023-04-02 15:39:25', 10000, 'เงินตั้งต้น'),
(2, '2023-04-02 15:48:42', -5000, 'ค่าลงทุนพื้นฐาน');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category`) VALUES
('ถั่ว'),
('อัลมอนต์');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `tier` varchar(255) NOT NULL,
  `order_price` int(11) NOT NULL,
  `discount_percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`tier`, `order_price`, `discount_percentage`) VALUES
('ขาประจำ', 1000, 5),
('ลูกค้าสุดพิเศษ', 20000, 10);

-- --------------------------------------------------------

--
-- Table structure for table `freight`
--

CREATE TABLE `freight` (
  `price` int(11) NOT NULL,
  `ordermore` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `freight`
--

INSERT INTO `freight` (`price`, `ordermore`) VALUES
(80, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `log_materials`
--

CREATE TABLE `log_materials` (
  `material_id` int(11) NOT NULL,
  `time_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `material_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_materials`
--

INSERT INTO `log_materials` (`material_id`, `time_log`, `material_amount`) VALUES
(1, '2023-04-02 15:30:51', 100);

-- --------------------------------------------------------

--
-- Table structure for table `log_products`
--

CREATE TABLE `log_products` (
  `product_id` int(11) NOT NULL,
  `time_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_products`
--

INSERT INTO `log_products` (`product_id`, `time_log`, `product_amount`) VALUES
(1, '2023-04-02 12:40:03', 0),
(9, '2023-04-02 12:40:03', 0),
(1, '2023-04-02 12:40:59', -2),
(9, '2023-04-02 12:40:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `material_id` int(11) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `bought_amount` double NOT NULL DEFAULT 0,
  `material_amount` double NOT NULL DEFAULT 0,
  `bought_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `material_name`, `bought_amount`, `material_amount`, `bought_price`) VALUES
(1, 'น้ำตาล', 1, 100, 26),
(2, 'ถั่วดิบ', 1, 0.6, 70);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `building_no` varchar(100) NOT NULL,
  `line` varchar(255) NOT NULL,
  `province` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `sub_district` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `postal_code` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `amount`, `payment_method`, `name`, `surname`, `building_no`, `line`, `province`, `district`, `sub_district`, `country`, `postal_code`, `created_date`, `status`) VALUES
(1, 1, 125, 'เก็บเงินปลายทาง', 'Pumin', 'Sinpiboon', '119/451', 'หมู่บ้านอัมรินทร์นิเวศน์ 3 ผัง 4 สายไหม15 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-03-18 10:06:07', 3),
(2, 1, 125, 'เก็บเงินปลายทาง', 'Pumin', 'Sinpiboon', '119/451', 'หมู่บ้านอัมรินทร์นิเวศน์ 3 ผัง 4 สายไหม15 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-03-18 10:06:07', 3);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1),
(2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `order_id` int(11) NOT NULL,
  `payment_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `method` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT ' ',
  `payment_status` varchar(100) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`method`, `description`, `payment_status`) VALUES
('เก็บเงินปลายทาง', '', 'active'),
('ไทยพาณิชย์', 'ชื่อบัญชี นายภูมินทร์ สินพิบูลย์\r\nเลขที่บัญชี 235XXX27X9', 'deactive');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `plan_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'เตรียมแผน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`plan_id`, `status`) VALUES
(1, 'เสร็จสิ้น');

-- --------------------------------------------------------

--
-- Table structure for table `plan_materials`
--

CREATE TABLE `plan_materials` (
  `plan_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `material_amount` double NOT NULL DEFAULT 0,
  `material_amount_f` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `plan_orders`
--

CREATE TABLE `plan_orders` (
  `plan_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_orders`
--

INSERT INTO `plan_orders` (`plan_id`, `order_id`) VALUES
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `plan_products`
--

CREATE TABLE `plan_products` (
  `plan_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_amount` int(11) NOT NULL DEFAULT 0,
  `plan_amount` int(11) NOT NULL DEFAULT 0,
  `total_amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan_products`
--

INSERT INTO `plan_products` (`plan_id`, `product_id`, `order_amount`, `plan_amount`, `total_amount`) VALUES
(1, 1, 2, 0, 0),
(1, 9, 0, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) DEFAULT '',
  `product_category` varchar(255) DEFAULT NULL,
  `product_description` varchar(200) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `product_status` varchar(200) NOT NULL DEFAULT 'active',
  `product_amount` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_img`, `product_price`, `product_status`, `product_amount`) VALUES
(1, 'ถั่วเคลือบ', 'ถั่ว', 'ถั่วเคลือบ 350 กรัม', '_create_2023-02-22_12_17_09_20230222_175329.jpg', 50, 'active', 4),
(9, 'ถั่วแผ่น', 'ถั่ว', 'ถั่วแผ่น 500 กรัม', '_create_2023-02-24_13_55_45_20230222_175350.jpg', 100, 'active', 10),
(10, 'อัลมอนต์คั่ว', 'อัลมอนต์', 'อัลมอนต์คั่ว 1 กิโลกรัม', '_create_2023-03-02_15_52_28_20230302_215103.jpg', 500, 'active', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_materials`
--

CREATE TABLE `product_materials` (
  `product_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `material_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_materials`
--

INSERT INTO `product_materials` (`product_id`, `material_id`, `material_amount`) VALUES
(1, 1, 0.25),
(1, 2, 0.35),
(9, 2, 0.35);

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `order_id` int(11) NOT NULL,
  `shipment_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`order_id`, `shipment_img`) VALUES
(1, 'shipment_order_1_user_1_00.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `total_amount` int(11) NOT NULL DEFAULT 0,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `total_amount`, `username`, `name`, `surname`, `email`, `password`) VALUES
(1, 'admin', 10378, 'admin', 'Pumin', 'Sinpiboon', 'pumin.s@ku.th', 'c33985e74687725b91756b694376250f'),
(2, 'user', 0, 'user01', 'PUser', 'PSurname', 'pmail@mail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'user', 0, 'puminfong', 'Pumin', 'Sinpiboon', 'pumin.s@mail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `user` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`user`, `month`, `year`, `amount`) VALUES
(1, 3, 2023, 8378),
(1, 2, 2023, 2000),
(3, 3, 2023, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `payment_method` (`payment_method`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
