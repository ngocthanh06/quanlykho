-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2020 at 07:17 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qlk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `damin_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`, `damin_phone`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Nguyen Thao', '0123123123', '2020-03-08 17:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tôn', 2020, '2020-04-05 08:45:42'),
(2, 'Sắt Thép', 2020, '2020-04-07 02:02:32'),
(3, 'Ngói', 2020, '2020-04-05 08:49:33'),
(4, 'Sơn', 2020, '2020-04-05 08:50:06'),
(5, 'Gạch', 2020, '2020-04-05 08:50:25'),
(6, 'Xi măng', 2020, '2020-04-05 08:50:49'),
(7, 'aaa', 2020, '2020-04-07 02:02:19'),
(8, 'khác', 2020, '2020-04-07 01:53:36');

-- --------------------------------------------------------

--
-- Table structure for table `chitietnhapkho`
--

CREATE TABLE `chitietnhapkho` (
  `id_nhapkho` int(10) UNSIGNED NOT NULL,
  `id_SP` int(10) UNSIGNED NOT NULL,
  `dvt` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `soluong` int(10) NOT NULL,
  `gianhap` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_03_14_160651_create_admin_table', 1),
(4, '2020_03_31_101013_create_category', 2),
(5, '2020_03_31_153918_create_product', 3),
(6, '2020_03_31_154637_create_supplier', 3);

-- --------------------------------------------------------

--
-- Table structure for table `nhapkho`
--

CREATE TABLE `nhapkho` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) NOT NULL,
  `Noidung` text NOT NULL,
  `Tongtien` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `soluong` int(10) UNSIGNED NOT NULL,
  `id_category` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price_after` int(10) UNSIGNED NOT NULL,
  `price_before` int(10) UNSIGNED NOT NULL,
  `dvt` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_supplier` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `soluong`, `id_category`, `name`, `price_after`, `price_before`, `dvt`, `created_at`, `updated_at`, `id_supplier`) VALUES
(15, 0, '2', 'Thép Ø 6 Hòa Phát', 11000, 14000, 'kg', '2020-04-05 09:34:12', '2020-04-06 09:12:26', '1'),
(18, 0, '2', 'Thép Ø 8 Hòa Phát', 13000, 16000, 'kg', '2020-04-06 03:19:06', '2020-04-06 09:12:38', '1'),
(19, 0, '2', 'Thép Ø 10 Hòa Phát', 70000, 80000, 'cây', '2020-04-06 09:12:11', '2020-04-06 09:13:51', '1'),
(20, 0, '2', 'Thép Ø 12 Hòa Phát', 115000, 125000, 'cây', '2020-04-06 09:15:19', '2020-04-06 09:15:19', '1'),
(21, 0, '2', 'Thép Ø 14 Hòa Phát', 160000, 170000, 'cây', '2020-04-06 09:16:14', '2020-04-06 09:16:14', '1'),
(22, 0, '2', 'Thép Ø 16 Hòa Phát', 205000, 215000, 'cây', '2020-04-06 09:16:57', '2020-04-06 09:16:57', '1'),
(23, 0, '2', 'Thép Ø 18 Hòa Phát', 270000, 280000, 'cây', '2020-04-06 09:17:45', '2020-04-06 09:17:45', '1'),
(24, 0, '2', 'Thép Ø 20 Hòa Phát', 340000, 350000, 'cây', '2020-04-06 09:18:16', '2020-04-06 09:18:16', '1'),
(25, 0, '2', 'Thép buộc', 16000, 18000, 'kg', '2020-04-06 09:19:32', '2020-04-06 09:19:32', '1'),
(26, 0, '2', 'Đinh', 16000, 18000, 'kg', '2020-04-06 09:20:19', '2020-04-06 09:20:19', '1'),
(27, 0, '5', 'Gạch Thẻ', 1500, 2000, 'viên', '2020-04-06 09:31:08', '2020-04-06 09:31:08', '2'),
(28, 0, '5', 'gạch terrazzo', 2000, 3000, 'viên', '2020-04-06 09:42:36', '2020-04-06 09:42:36', '2'),
(29, 0, '6', 'Xi măng Nghi Sơn', 1500000, 1600000, 'tấn', '2020-04-06 09:55:35', '2020-04-06 09:55:35', '3'),
(30, 0, '6', 'xi măng Long Thọ', 1200000, 1300000, 'tấn', '2020-04-06 09:56:25', '2020-04-06 09:56:25', '3'),
(31, 0, '6', 'xi măng Kim Đỉnh', 1250000, 1350000, 'tấn', '2020-04-06 09:57:22', '2020-04-06 09:57:22', '3'),
(32, 0, '6', 'xi măng Đồng Lâm', 1300000, 1400000, 'tấn', '2020-04-06 09:58:07', '2020-04-06 09:58:07', '3'),
(33, 0, '4', 'Sơn lót ngoài trời', 900000, 1000000, 'Thùng', '2020-04-06 10:14:32', '2020-04-06 10:19:17', '4'),
(34, 0, '4', 'Sơn lót trong nhà', 600000, 700000, 'Thùng', '2020-04-06 10:16:16', '2020-04-06 10:16:16', '4'),
(35, 0, '4', 'Sơn nước ngoài trời (Mờ)', 2000000, 2100000, 'Thùng', '2020-04-06 10:18:18', '2020-04-06 10:18:18', '4'),
(36, 0, '4', 'Sơn nước ngoài trời (bóng)', 2200000, 2300000, 'Thùng', '2020-04-06 10:21:51', '2020-04-06 10:21:51', '4'),
(37, 0, '4', 'Sơn trong nhài (Mờ)', 1600000, 1700000, 'Thùng', '2020-04-06 10:23:37', '2020-04-06 10:23:37', '4'),
(38, 0, '1', 'Sơn nước trong nhài (bóng)', 1700000, 1800000, 'Thùng', '2020-04-06 10:24:35', '2020-04-06 10:24:35', '4'),
(39, 0, '4', 'Bột trét tường', 13000, 14000, 'kg', '2020-04-06 10:25:49', '2020-04-06 10:27:00', '4'),
(40, 0, '4', 'Chất chống thấm', 50000, 60000, 'kg', '2020-04-06 10:26:49', '2020-04-06 10:26:49', '4'),
(41, 0, '2', 'Sắt phi 6', 10000, 12000, 'kg', '2020-04-07 02:05:13', '2020-04-07 02:05:13', '1'),
(42, 0, '2', 'Sắt phi 8', 11000, 12000, 'kg', '2020-04-07 02:06:02', '2020-04-07 02:06:02', '1'),
(43, 0, '2', 'Sắt phi 10', 70000, 80000, 'cây', '2020-04-07 02:17:26', '2020-04-07 02:17:26', '1'),
(44, 0, '2', 'Sắt phi 12', 100000, 110000, 'cây', '2020-04-07 02:18:10', '2020-04-07 02:18:10', '1'),
(45, 0, '2', 'Sắt phi 14', 130000, 140000, 'cây', '2020-04-07 02:18:46', '2020-04-07 02:18:46', '1'),
(46, 0, '2', 'Sắt phi 16', 180000, 190000, 'cây', '2020-04-07 02:19:44', '2020-04-07 02:19:44', '1'),
(47, 0, '2', 'Sắt phi 18', 220000, 240000, 'cây', '2020-04-07 02:20:33', '2020-04-07 02:20:33', '1'),
(48, 0, '2', 'Sắt phi 20', 270000, 290000, 'cây', '2020-04-07 02:21:54', '2020-04-07 02:21:54', '1'),
(49, 0, '3', 'Ngói lợp', 11000, 13000, 'viên', '2020-04-07 02:31:05', '2020-04-07 02:31:05', '5'),
(50, 0, '1', 'Ngói nóc', 22000, 25000, 'viên', '2020-04-07 02:34:01', '2020-04-07 02:34:01', '5'),
(51, 0, '3', 'Ngói rìa', 22000, 25000, 'viên', '2020-04-07 02:34:48', '2020-04-07 02:34:48', '5'),
(52, 0, '3', 'Ngói cuối nóc', 30000, 40000, 'viên', '2020-04-07 02:35:36', '2020-04-07 02:35:36', '5'),
(53, 0, '3', 'Ngói cuối rìa', 40000, 50000, 'viên', '2020-04-07 02:36:07', '2020-04-07 02:36:07', '5'),
(54, 0, '1', 'ngói vảy cá to', 8000, 10000, 'viên', '2020-04-07 02:38:34', '2020-04-07 02:38:34', '5'),
(55, 0, '3', 'Ngói lợp tráng men', 40000, 50000, 'viên', '2020-04-07 02:40:07', '2020-04-07 02:40:07', '5'),
(56, 0, '1', 'tôn lạnh 2.8dem', 45000, 60000, 'm', '2020-04-07 02:51:39', '2020-04-07 02:57:29', '6'),
(57, 0, '1', 'tôn lạnh 3.20dem', 50000, 60000, 'm', '2020-04-07 02:58:34', '2020-04-07 02:58:34', '6'),
(58, 0, '1', 'tôn lạnh 3.30dem', 55000, 65000, 'm', '2020-04-07 02:59:33', '2020-04-07 02:59:33', '6'),
(59, 0, '1', 'tôn lạnh 3.60dem', 60000, 65000, 'm', '2020-04-07 03:00:15', '2020-04-07 03:00:15', '6'),
(60, 0, '1', 'tôn lạnh 4.20dem', 60000, 80000, 'm', '2020-04-07 03:01:25', '2020-04-07 03:01:25', '6'),
(61, 0, '1', 'tôn lạnh 4.50dem', 70000, 85000, 'm', '2020-04-07 03:02:13', '2020-04-07 03:02:13', '6'),
(62, 0, '1', 'Tôn mạ kẽm 4.40dem', 70000, 80000, 'm', '2020-04-07 03:03:12', '2020-04-07 03:03:12', '6'),
(63, 0, '1', 'Tôn mạ kẽm 5.30dem', 80000, 95000, 'm', '2020-04-07 03:03:52', '2020-04-07 03:03:52', '6'),
(64, 0, '1', 'Tôn nhựa 1 lớp', 30000, 40000, 'm', '2020-04-07 03:04:43', '2020-04-07 03:04:43', '6'),
(65, 0, '1', 'Tôn nhựa 2 lớp', 70000, 90000, 'm', '2020-04-07 03:05:14', '2020-04-07 03:05:14', '6'),
(66, 1, '1', 'Thạnh', 1, 1, 'kg', '2020-04-10 19:18:54', '2020-04-10 19:18:54', '1');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `TenNCC` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SDT` char(20) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `created_at`, `updated_at`, `TenNCC`, `Email`, `SDT`) VALUES
(1, '2020-04-06 03:07:58', '2020-04-06 10:31:44', 'Công ty phân phối sắt thép Tân Thạch', 'tanthach@gmail.com', '0354841265'),
(2, '2020-04-06 03:08:11', '2020-04-06 10:29:38', 'Công ty phân phối gạch Đoàn Luyến', 'doanluyen@gmail.com', '0376984862'),
(3, '2020-04-06 03:08:28', '2020-04-06 10:29:53', 'Công ty phân phối xi măng Song Danh', 'songdanh@gmail.com', '0398745625'),
(4, '2020-04-06 08:53:20', '2020-04-06 10:18:56', 'Công ty phân phối sơn Dulux Đức Thịnh', 'ducthinh@gmail.com', '0358774948'),
(5, '2020-04-06 08:58:26', '2020-04-06 10:36:32', 'Công ty phân phối ngói Anh Dũng', 'anhdung@gmail.com', '0358749687'),
(6, '2020-04-07 02:54:54', '2020-04-07 02:57:06', 'Công ty phân phối tôn Phát Đạt', 'phatdat@gmail.com', '0354853548');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chitietnhapkho`
--
ALTER TABLE `chitietnhapkho`
  ADD KEY `id_nhapkho` (`id_nhapkho`),
  ADD KEY `id_SP` (`id_SP`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nhapkho`
--
ALTER TABLE `nhapkho`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `nhapkho`
--
ALTER TABLE `nhapkho`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
