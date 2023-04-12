-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 12, 2023 at 10:46 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `time_log`, `amount`, `info`) VALUES
(1, '2023-04-02 15:39:25', 10000, 'เงินตั้งต้น'),
(2, '2023-04-02 15:48:42', -5000, 'ค่าลงทุนพื้นฐาน'),
(3, '2023-04-07 07:39:57', -2380, 'ซื้อวัตถุดิบในแผนที่ 3'),
(4, '2023-04-07 07:45:50', -3360, 'ซื้อวัตถุดิบในแผนที่ 4'),
(6, '2023-04-07 08:40:02', 125, 'คำสั่งซื้อที่ 1'),
(7, '2023-04-10 05:30:47', -40000, 'ซื้อวัตถุดิบในแผนที่ 6'),
(8, '2023-04-10 05:39:49', 1330, 'คำสั่งซื้อที่ 10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category`) VALUES
('ถั่ว'),
('อัลมอนต์');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int(11) NOT NULL,
  `coupon_name` varchar(255) NOT NULL,
  `coupon_price` int(11) NOT NULL DEFAULT 0,
  `expire_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `coupon_name`, `coupon_price`, `expire_date`) VALUES
(1, 'C_001', 50, '2023-04-15 00:00:00'),
(2, 'C_002', 20, '2023-04-30 00:00:00'),
(3, 'AP_04', 1000, '2023-05-05 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `coupon_usage`
--

CREATE TABLE `coupon_usage` (
  `coupon_name` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `usage_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon_usage`
--

INSERT INTO `coupon_usage` (`coupon_name`, `user_id`, `usage_date`) VALUES
('C_002', 1, '2023-04-11 14:48:09');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `tier` varchar(255) NOT NULL,
  `order_price` int(11) NOT NULL,
  `discount_percentage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_materials`
--

INSERT INTO `log_materials` (`material_id`, `time_log`, `material_amount`) VALUES
(1, '2023-04-02 15:30:51', 100),
(2, '2023-04-07 07:39:57', 34),
(1, '2023-04-07 07:40:16', -24.25),
(2, '2023-04-07 07:40:16', -33.95),
(2, '2023-04-07 07:45:50', 48),
(1, '2023-04-07 07:47:09', -24.25),
(2, '2023-04-07 07:47:09', -48.3),
(3, '2023-04-10 05:30:47', 100),
(3, '2023-04-10 05:30:53', -98);

-- --------------------------------------------------------

--
-- Table structure for table `log_products`
--

CREATE TABLE `log_products` (
  `product_id` int(11) NOT NULL,
  `time_log` timestamp NOT NULL DEFAULT current_timestamp(),
  `product_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_products`
--

INSERT INTO `log_products` (`product_id`, `time_log`, `product_amount`) VALUES
(1, '2023-04-02 12:40:03', 0),
(9, '2023-04-02 12:40:03', 0),
(1, '2023-04-02 12:40:59', -2),
(9, '2023-04-02 12:40:59', 0),
(1, '2023-04-07 07:40:16', 97),
(1, '2023-04-07 07:47:09', 97),
(9, '2023-04-07 07:47:09', 41),
(10, '2023-04-10 05:30:53', 98),
(1, '2023-04-10 05:30:58', -1),
(9, '2023-04-10 05:30:58', -2),
(10, '2023-04-10 05:30:58', -2);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material_id`, `material_name`, `bought_amount`, `material_amount`, `bought_price`) VALUES
(1, 'น้ำตาล', 1, 51.5, 26),
(2, 'ถั่วดิบ', 1, 0.3, 70),
(3, 'อัลมอนต์', 10, 2, 4000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `amount`, `payment_method`, `name`, `surname`, `building_no`, `line`, `province`, `district`, `sub_district`, `country`, `postal_code`, `created_date`, `status`) VALUES
(1, 1, 125, 'เก็บเงินปลายทาง', 'Pumin', 'Sinpiboon', '119/451', 'หมู่บ้านอัมรินทร์นิเวศน์ 3 ผัง 4 สายไหม15 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-03-18 10:06:07', 6),
(2, 1, 125, 'เก็บเงินปลายทาง', 'Pumin', 'Sinpiboon', '119/451', 'หมู่บ้านอัมรินทร์นิเวศน์ 3 ผัง 4 สายไหม15 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-03-18 10:06:07', 3),
(8, 2, 1880, 'เก็บเงินปลายทาง', 'PUser', 'PSurname', '119/451', 'ซ.สายไหม 15 หมู่บ้านอัมรินทร์นิเวศน์ 3 ผัง 4 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-04-07 05:37:22', 1),
(9, 2, 175, 'เก็บเงินปลายทาง', 'PUser', 'PSurname', '119/451', 'ซ.สายไหม 15 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-04-07 05:42:36', 1),
(10, 2, 1330, 'ไทยพาณิชย์', 'PUser', 'PSurname', '119/451', 'สายไหม 15 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-04-07 08:51:24', 6),
(12, 1, 128, 'ไทยพาณิชย์', 'Pumin', 'Sinpiboon', '119/451', 'สายไหม 15', 'กรุงเทพมหานคร', 'สายไหม', 'ออเงิน', 'ประเทศไทย', '10220', '2023-04-11 07:43:47', 0),
(13, 1, 108, 'ไทยพาณิชย์', 'Pumin', 'Sinpiboon', '119/451', 'สายไหม 15', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-04-11 07:48:09', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

CREATE TABLE `order_products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`order_id`, `product_id`, `quantity`) VALUES
(1, 1, 1),
(2, 1, 1),
(9, 9, 1),
(10, 1, 1),
(10, 9, 2),
(10, 10, 2),
(12, 1, 1),
(13, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `order_id` int(11) NOT NULL,
  `payment_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`order_id`, `payment_img`) VALUES
(10, 'payment_order_10_user_2_TXN_202212204X5peKAXnznH1zEmw[1].jpg');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `method` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT ' ',
  `payment_status` varchar(100) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`method`, `description`, `payment_status`) VALUES
('เก็บเงินปลายทาง', '', 'active'),
('ไทยพาณิชย์', 'ชื่อบัญชี นายภูมินทร์ สินพิบูลย์\r\nเลขที่บัญชี 235XXX27X9', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `plans`
--

CREATE TABLE `plans` (
  `plan_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'เตรียมแผน'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plans`
--

INSERT INTO `plans` (`plan_id`, `status`) VALUES
(1, 'เสร็จสิ้น'),
(3, 'เสร็จสิ้น'),
(4, 'เสร็จสิ้น'),
(5, 'เสร็จสิ้น'),
(6, 'เสร็จสิ้น');

-- --------------------------------------------------------

--
-- Table structure for table `plan_materials`
--

CREATE TABLE `plan_materials` (
  `plan_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `material_amount` double NOT NULL DEFAULT 0,
  `material_amount_f` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan_materials`
--

INSERT INTO `plan_materials` (`plan_id`, `material_id`, `material_amount`, `material_amount_f`) VALUES
(3, 1, 24.25, -75),
(3, 2, 33.95, 34),
(4, 1, 24.25, -75),
(4, 2, 48.3, 48),
(6, 3, 98, 100);

-- --------------------------------------------------------

--
-- Table structure for table `plan_orders`
--

CREATE TABLE `plan_orders` (
  `plan_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan_orders`
--

INSERT INTO `plan_orders` (`plan_id`, `order_id`) VALUES
(1, 1),
(1, 2),
(6, 10);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan_products`
--

INSERT INTO `plan_products` (`plan_id`, `product_id`, `order_amount`, `plan_amount`, `total_amount`) VALUES
(1, 1, 2, 0, 0),
(1, 9, 0, 6, 0),
(3, 1, 0, 100, 97),
(4, 1, 0, 100, 97),
(4, 9, 0, 50, 41),
(5, 1, 0, 100, 0),
(6, 1, 1, 0, 0),
(6, 9, 2, 0, 0),
(6, 10, 2, 95, 98);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) DEFAULT '',
  `product_description` varchar(200) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `product_status` varchar(200) NOT NULL DEFAULT 'active',
  `product_amount` double NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_description`, `product_img`, `product_price`, `product_status`, `product_amount`) VALUES
(1, 'ถั่วเคลือบ', 'ถั่วเคลือบ 350 กรัม', '_create_2023-02-22_12_17_09_20230222_175329.jpg', 50, 'active', 197),
(9, 'ถั่วแผ่น', 'ถั่วแผ่น 500 กรัม', '_create_2023-02-24_13_55_45_20230222_175350.jpg', 100, 'active', 49),
(10, 'อัลมอนต์คั่ว', 'อัลมอนต์คั่ว 1 กิโลกรัม', '_create_2023-03-02_15_52_28_20230302_215103.jpg', 500, 'active', 96);

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `product_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`product_id`, `category`) VALUES
(10, 'อัลมอนต์'),
(9, 'อัลมอนต์'),
(9, 'ถั่ว');

-- --------------------------------------------------------

--
-- Table structure for table `product_materials`
--

CREATE TABLE `product_materials` (
  `product_id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `material_amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_materials`
--

INSERT INTO `product_materials` (`product_id`, `material_id`, `material_amount`) VALUES
(1, 1, 0.25),
(1, 2, 0.35),
(9, 2, 0.35),
(10, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `order_id` int(11) NOT NULL,
  `shipment_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`order_id`, `shipment_img`) VALUES
(1, 'shipment_order_1_user_1_00.png'),
(10, 'shipment_order_10_user_2_20230222_175433[1].jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL,
  `total_amount` double NOT NULL DEFAULT 0,
  `username` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `total_amount`, `username`, `name`, `surname`, `email`, `password`) VALUES
(1, 'admin', 10742, 'admin', 'Pumin', 'Sinpiboon', 'pumin.s@ku.th', 'c33985e74687725b91756b694376250f'),
(2, 'user', 105, 'user01', 'PUser', 'PSurname', 'pmail@mail.com', '81dc9bdb52d04dc20036dbd8313ed055'),
(3, 'user', 0, 'puminfong', 'Pumin', 'Sinpiboon', 'pumin.s@mail.com', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `user_order`
--

CREATE TABLE `user_order` (
  `user` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`user`, `month`, `year`, `amount`) VALUES
(1, 3, 2023, 8378),
(1, 2, 2023, 2000),
(3, 3, 2023, 0),
(2, 4, 2023, 105),
(1, 4, 2023, 364);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`),
  ADD UNIQUE KEY `coupon_name` (`coupon_name`);

--
-- Indexes for table `coupon_usage`
--
ALTER TABLE `coupon_usage`
  ADD UNIQUE KEY `coupon_name` (`coupon_name`),
  ADD KEY `fk_coupon_user_id` (`user_id`);

--
-- Indexes for table `log_materials`
--
ALTER TABLE `log_materials`
  ADD KEY `fk_log_material_id` (`material_id`);

--
-- Indexes for table `log_products`
--
ALTER TABLE `log_products`
  ADD KEY `fk_log_product_id` (`product_id`);

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
-- Indexes for table `order_products`
--
ALTER TABLE `order_products`
  ADD KEY `fk_order_product_id` (`product_id`),
  ADD KEY `fk_product_order_id` (`order_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`method`);

--
-- Indexes for table `plans`
--
ALTER TABLE `plans`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `plan_materials`
--
ALTER TABLE `plan_materials`
  ADD KEY `fk_material_id` (`material_id`),
  ADD KEY `fk_plan_id` (`plan_id`);

--
-- Indexes for table `plan_orders`
--
ALTER TABLE `plan_orders`
  ADD KEY `fk_plan_order_id` (`order_id`),
  ADD KEY `fk_order_plan_id` (`plan_id`);

--
-- Indexes for table `plan_products`
--
ALTER TABLE `plan_products`
  ADD KEY `fk_product_plan_id` (`plan_id`),
  ADD KEY `fk_plan_product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD KEY `fk_categories_product_id` (`product_id`),
  ADD KEY `fk_product_categories_name` (`category`);

--
-- Indexes for table `product_materials`
--
ALTER TABLE `product_materials`
  ADD KEY `fk_product_material_id` (`material_id`),
  ADD KEY `fk_material_product_id` (`product_id`);

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
-- Indexes for table `user_order`
--
ALTER TABLE `user_order`
  ADD KEY `fk_order_user_id` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `coupon_usage`
--
ALTER TABLE `coupon_usage`
  ADD CONSTRAINT `fk_coupon_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_coupon_name` FOREIGN KEY (`coupon_name`) REFERENCES `coupons` (`coupon_name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_materials`
--
ALTER TABLE `log_materials`
  ADD CONSTRAINT `fk_log_material_id` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log_products`
--
ALTER TABLE `log_products`
  ADD CONSTRAINT `fk_log_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_order_payment_method` FOREIGN KEY (`payment_method`) REFERENCES `payment_method` (`method`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_products`
--
ALTER TABLE `order_products`
  ADD CONSTRAINT `fk_order_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `fk_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `plan_materials`
--
ALTER TABLE `plan_materials`
  ADD CONSTRAINT `fk_material_id` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plan_orders`
--
ALTER TABLE `plan_orders`
  ADD CONSTRAINT `fk_order_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_plan_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `plan_products`
--
ALTER TABLE `plan_products`
  ADD CONSTRAINT `fk_plan_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`plan_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD CONSTRAINT `fk_categories_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_categories_name` FOREIGN KEY (`category`) REFERENCES `categories` (`category`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product_materials`
--
ALTER TABLE `product_materials`
  ADD CONSTRAINT `fk_material_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_product_material_id` FOREIGN KEY (`material_id`) REFERENCES `materials` (`material_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shipment`
--
ALTER TABLE `shipment`
  ADD CONSTRAINT `fk_shipment_order_id` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `fk_order_user_id` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
