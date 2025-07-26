-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 26, 2025 at 10:41 AM
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
-- Database: `inovant_solution`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('02j7PfhGQMhH3D3I', 'a:1:{s:11:\"valid_until\";i:1752663800;}', 1784193260),
('0Ot5QHVotw1h7aGi', 'a:1:{s:11:\"valid_until\";i:1752665600;}', 1784201540),
('1y62cYEHfJq4uH90', 'a:1:{s:11:\"valid_until\";i:1752666070;}', 1784202130),
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1753389442),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1753389442;', 1753389442),
('5ghS5LOSrKtOP7R1', 'a:1:{s:11:\"valid_until\";i:1752665696;}', 1784201756),
('6pCc7K3a7l5RYIvs', 'a:1:{s:11:\"valid_until\";i:1752738787;}', 1784274787),
('7MW37zH5uaiSSXcS', 'a:1:{s:11:\"valid_until\";i:1752845669;}', 1784379809),
('8F2nFUEiJ7zXTL4l', 'a:1:{s:11:\"valid_until\";i:1752735605;}', 1784267285),
('9Gqbjg5SYVlXvhht', 'a:1:{s:11:\"valid_until\";i:1752736056;}', 1784272056),
('CtQLGIck7vIayiDM', 'a:1:{s:11:\"valid_until\";i:1752663851;}', 1784199911),
('dPjpNcEslGvL8irB', 'a:1:{s:11:\"valid_until\";i:1752666840;}', 1784202840),
('e5gV1hN6DOaQka3C', 'a:1:{s:11:\"valid_until\";i:1752665874;}', 1784201934),
('emC1vRJOLiZLHXcY', 'a:1:{s:11:\"valid_until\";i:1752236200;}', 1783768060),
('eqe6TAlYDlYjepf4', 'a:1:{s:11:\"valid_until\";i:1752815909;}', 1784300789),
('eQipcZuwTBU6VXuH', 'a:1:{s:11:\"valid_until\";i:1752664922;}', 1784200982),
('Eym84HEuSyP6xZxF', 'a:1:{s:11:\"valid_until\";i:1752832655;}', 1784351195),
('fasF2KaDtTjdRRMP', 'a:1:{s:11:\"valid_until\";i:1753081846;}', 1784614726),
('fhEBqIbO482nnMiq', 'a:1:{s:11:\"valid_until\";i:1752664030;}', 1784200090),
('g943d0vGeI4brDGj', 'a:1:{s:11:\"valid_until\";i:1752840354;}', 1784374554),
('hj5VzCjSrEGJSLbm', 'a:1:{s:11:\"valid_until\";i:1752735962;}', 1784267822),
('id1IfYSCFFDIwwwu', 'a:1:{s:11:\"valid_until\";i:1752666611;}', 1784202671),
('IeaC1PHpMSM6LOdE', 'a:1:{s:11:\"valid_until\";i:1752666348;}', 1784202408),
('IJW8OtLlnR0s3lsW', 'a:1:{s:11:\"valid_until\";i:1752664316;}', 1784008736),
('JST9CA9oyoo1KcsK', 'a:1:{s:11:\"valid_until\";i:1752664236;}', 1784200296),
('JtmhXryKZtI0PtTz', 'a:1:{s:11:\"valid_until\";i:1752666431;}', 1784202491),
('LdMZ5tr0bm1clQ3s', 'a:1:{s:11:\"valid_until\";i:1752667048;}', 1784203108),
('LUuQsMdGiKxoq0xx', 'a:1:{s:11:\"valid_until\";i:1752236473;}', 1783771693),
('m84qRu4tiNKVMYQv', 'a:1:{s:11:\"valid_until\";i:1752738710;}', 1784274770),
('MawscxkTJSwLTl9C', 'a:1:{s:11:\"valid_until\";i:1752846273;}', 1784382213),
('MkaML3JlM1g6NxC6', 'a:1:{s:11:\"valid_until\";i:1752736402;}', 1784272162),
('N0fC6ExnQDEyBXQx', 'a:1:{s:11:\"valid_until\";i:1752664427;}', 1784200487),
('nzxc3RrQLQNRoMMP', 'a:1:{s:11:\"valid_until\";i:1752662552;}', 1784197712),
('OGguHXHAKuvwOWSS', 'a:1:{s:11:\"valid_until\";i:1752469744;}', 1784005624),
('Ovd3y6GxlH0VfVUf', 'a:1:{s:11:\"valid_until\";i:1752834676;}', 1784369956),
('p5x7recb5y0evCJC', 'a:1:{s:11:\"valid_until\";i:1752846442;}', 1784382382),
('PLe3gADLxhRWHSRl', 'a:1:{s:11:\"valid_until\";i:1752238146;}', 1783774086),
('QIIj4Y9Oun2lIRkh', 'a:1:{s:11:\"valid_until\";i:1753271357;}', 1784806457),
('qYJTWPBlA8CzUAe0', 'a:1:{s:11:\"valid_until\";i:1752665187;}', 1784201187),
('rcEfWwMl1QIxQwwF', 'a:1:{s:11:\"valid_until\";i:1752663938;}', 1784199998),
('T28D9I5RQ3cmkNjN', 'a:1:{s:11:\"valid_until\";i:1753100844;}', 1784355444),
('TDPsFttS0u8kDuyc', 'a:1:{s:11:\"valid_until\";i:1752237959;}', 1783773299),
('teabivpKTEZZvetf', 'a:1:{s:11:\"valid_until\";i:1752666293;}', 1784202353),
('U04K4I9FKDkRGvRt', 'a:1:{s:11:\"valid_until\";i:1752664095;}', 1784200155),
('un5cOKhp1pBzF6we', 'a:1:{s:11:\"valid_until\";i:1752666555;}', 1784202615),
('urXW4wdpVTA6usU1', 'a:1:{s:11:\"valid_until\";i:1752665298;}', 1784201358),
('uS0p7lms6yaJH0gh', 'a:1:{s:11:\"valid_until\";i:1752666119;}', 1784202179),
('VAyI97ET7MkaZehD', 'a:1:{s:11:\"valid_until\";i:1752237001;}', 1783772881),
('vNUQf362N9FU7Khf', 'a:1:{s:11:\"valid_until\";i:1753074728;}', 1784384648),
('X20X68sLnaJ5OPX3', 'a:1:{s:11:\"valid_until\";i:1752738365;}', 1784203145),
('y2RMSxFXPxgS06fX', 'a:1:{s:11:\"valid_until\";i:1752751550;}', 1784285330),
('z2KVyU50tweVexzJ', 'a:1:{s:11:\"valid_until\";i:1752664281;}', 1784200341),
('ZpgqwW30eyqyurhJ', 'a:1:{s:11:\"valid_until\";i:1752665781;}', 1784201841),
('ZryBb4lE33nGUd9X', 'a:1:{s:11:\"valid_until\";i:1752848536;}', 1784383036),
('zzzrg5gS5pTqhFwc', 'a:1:{s:11:\"valid_until\";i:1752664205;}', 1784200265);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `customer_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(4, 1, 6, 1, '2025-07-24 15:09:51', '2025-07-24 15:09:51'),
(5, 1, 7, 2, '2025-07-24 15:12:10', '2025-07-24 15:13:29');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `address`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Alex', 'alex@gmail.com', '8596857485', 'Mumbai', '$2y$12$aORdlgWbwaMObPFyI73TheVcx2q6mo6x1froM9j715Zl69Fn2v8kS', '2025-07-24 18:34:18', '2025-07-24 18:34:18'),
(2, 'ABC', 'xyz@gmail.com', '8585968574', 'Bhiwandi', '$2y$12$7PV7j4YcUSN6lIfSh3lYauJSIhlrJBeizMST8FVks8Kb0wtFSb.i6', '2025-07-26 03:00:51', '2025-07-26 03:00:51'),
(3, 'Example1', 'example1@gmail.com', '8574859652', 'Airoli', '$2y$12$oQJ8YNlFcsbasJYTS02V9.Ci9mHaPhgqH2Zby/jzJYRPxLe0bMgEe', '2025-07-26 03:02:38', '2025-07-26 03:02:38'),
(4, 'Example2', 'example2@gmail.com', '8574859641', 'Rabale', '$2y$12$A.FkrzySPKnoPiA6aPCdCeO2NvtqjmyTMb7BsoDYV.B20JM1vhv2G', '2025-07-26 03:02:53', '2025-07-26 03:02:53'),
(5, 'Example3', 'example3@gmail.com', '8574459641', 'Ghansoli', '$2y$12$dsch9inqKKKx/VWgyXAK9uCi/R76yP0d2ykFXrsoj8cehQA4uvvzq', '2025-07-26 03:03:11', '2025-07-26 03:03:11'),
(6, 'Example4', 'example4@gmail.com', '8574459685', 'Sanpada', '$2y$12$oKfj4Qcl/l4mqmw0lsJag..r8lGfyd5ied0.7KBMaX1DPs7gOdayq', '2025-07-26 03:03:29', '2025-07-26 03:03:29'),
(7, 'Example5', 'example5@gmail.com', '8552459685', 'Vashi', '$2y$12$9qnGQkUPO64FI.8RS7F.g.o36itfMMQG9XyvK.H0Rjje7LBwAFzyu', '2025-07-26 03:03:51', '2025-07-26 03:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(23, '2025_07_23_184509_create_products_table', 2),
(24, '2025_07_23_184632_create_product_images_table', 2),
(25, '2025_07_23_193513_create_customers_table', 3),
(26, '2025_07_23_184650_create_carts_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `price`, `description`, `status`, `created_at`, `updated_at`) VALUES
(6, 'Mobile', 'mobile', 45000.00, 'The iPhone is a line of smartphones designed and marketed by Apple Inc. that runs on Apple\'s iOS operating system', 1, '2025-07-24 15:05:33', '2025-07-24 15:05:33'),
(7, 'Monitor', 'monitor', 5600.00, 'A monitor is an electronic visual display, often part of a computer system, that presents text, images, and video', 1, '2025-07-24 15:06:39', '2025-07-24 15:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `images` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `images`, `created_at`, `updated_at`) VALUES
(11, 6, '1753389333_662945_mobile.jpg', '2025-07-24 15:05:33', '2025-07-24 15:05:33'),
(12, 7, '1753389399_509142_monitor.webp', '2025-07-24 15:06:39', '2025-07-24 15:06:39');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('0clkoJc6O7sXCa81Rkp0OEEzPd2weIoomaEP8huq', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaWtWQW9sTTdKOUhXUE11SFI4TjBvNjdaRXR2TG1VakpSZ29NWldReiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zZXJ2aWNlLXdvcmtlci5qcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1753514888),
('ZSUaP8Ov5qGfUd8U5OMgxSeWjlZmDBoCNTAx8IAT', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiSm9EU0l6blZkZUVGWHllYm1FWDV4Tm96VmRFaVFSZDU4bmp3TWVuTCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL3Byb2R1Y3RzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9wcm9kdWN0cyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7fQ==', 1753519280);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Inovant Solution', 'admin@gmail.com', NULL, '$2y$12$iD1seGzdkhU0WHwFUk.IjumyXg/H0QoSjuCTsPZrkLRYzNe3Y2fNS', NULL, '2025-07-09 15:25:33', '2025-07-23 13:21:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_customer_id_foreign` (`customer_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `customers_email_unique` (`email`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
