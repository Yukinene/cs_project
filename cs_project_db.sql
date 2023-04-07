-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2023 at 11:21 AM
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
(6, '2023-04-07 08:40:02', 125, 'คำสั่งซื้อที่ 1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category`) VALUES
('อัลมอนต์');

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
(2, '2023-04-07 07:47:09', -48.3);

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
(9, '2023-04-07 07:47:09', 41);

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
(2, 'ถั่วดิบ', 1, 0.3, 70);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `amount`, `payment_method`, `name`, `surname`, `building_no`, `line`, `province`, `district`, `sub_district`, `country`, `postal_code`, `created_date`, `status`) VALUES
(1, 1, 125, 'เก็บเงินปลายทาง', 'Pumin', 'Sinpiboon', '119/451', 'หมู่บ้านอัมรินทร์นิเวศน์ 3 ผัง 4 สายไหม15 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-03-18 10:06:07', 6),
(2, 1, 125, 'เก็บเงินปลายทาง', 'Pumin', 'Sinpiboon', '119/451', 'หมู่บ้านอัมรินทร์นิเวศน์ 3 ผัง 4 สายไหม15 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-03-18 10:06:07', 3),
(8, 2, 1880, 'เก็บเงินปลายทาง', 'PUser', 'PSurname', '119/451', 'ซ.สายไหม 15 หมู่บ้านอัมรินทร์นิเวศน์ 3 ผัง 4 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-04-07 05:37:22', 1),
(9, 2, 175, 'เก็บเงินปลายทาง', 'PUser', 'PSurname', '119/451', 'ซ.สายไหม 15 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-04-07 05:42:36', 1),
(10, 2, 1330, 'ไทยพาณิชย์', 'PUser', 'PSurname', '119/451', 'สายไหม 15 ถนนสายไหม', 'กรุงเทพมหานคร', 'สายไหม', 'สายไหม', 'ประเทศไทย', '10220', '2023-04-07 08:51:24', 0);

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
(10, 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `order_id` int(11) NOT NULL,
  `payment_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(5, 'เสร็จสิ้น');

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
(4, 2, 48.3, 48);

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
(5, 1, 0, 100, 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_category`, `product_description`, `product_img`, `product_price`, `product_status`, `product_amount`) VALUES
(1, 'ถั่วเคลือบ', '', 'ถั่วเคลือบ 350 กรัม', '_create_2023-02-22_12_17_09_20230222_175329.jpg', 50, 'active', 198),
(9, 'ถั่วแผ่น', '', 'ถั่วแผ่น 500 กรัม', '_create_2023-02-24_13_55_45_20230222_175350.jpg', 100, 'active', 51),
(10, 'อัลมอนต์คั่ว', 'อัลมอนต์', 'อัลมอนต์คั่ว 1 กิโลกรัม', '_create_2023-03-02_15_52_28_20230302_215103.jpg', 500, 'active', 0);

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
(9, 2, 0.35);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `total_amount`, `username`, `name`, `surname`, `email`, `password`) VALUES
(1, 'admin', 10378, 'admin', 'Pumin', 'Sinpiboon', 'pumin.s@ku.th', '527fba4ad7971649d4fc5986a151e743'),
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
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_order`
--

INSERT INTO `user_order` (`user`, `month`, `year`, `amount`) VALUES
(1, 3, 2023, 8378),
(1, 2, 2023, 2000),
(3, 3, 2023, 0),
(2, 4, 2023, 105);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `material_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `plans`
--
ALTER TABLE `plans`
  MODIFY `plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
