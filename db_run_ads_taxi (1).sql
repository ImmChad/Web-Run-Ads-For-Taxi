-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 23, 2023 lúc 04:00 PM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_run_ads_taxi`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `name_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  `num_phone_admin` varchar(255) NOT NULL,
  `birthday_admin` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id_admin`, `name_admin`, `password_admin`, `num_phone_admin`, `birthday_admin`) VALUES
(1, 'Tung Admin', 'soaika1810', '0123456789', '2003-02-18');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `company_photo`
--

CREATE TABLE `company_photo` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `is_active` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `company_photo`
--

INSERT INTO `company_photo` (`id`, `company_id`, `photo_id`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 2, 13, b'1', '2023-02-21 15:44:30', NULL, NULL),
(6, 18, 14, b'1', '2023-02-21 15:46:34', NULL, NULL),
(7, 2, 14, b'1', '2023-02-21 22:52:50', NULL, NULL),
(8, 0, 13, b'1', '2023-02-22 07:25:27', NULL, NULL),
(9, 0, 15, b'1', '2023-02-22 11:05:44', NULL, NULL),
(10, 18, 13, b'1', '2023-02-22 16:06:58', NULL, NULL),
(11, 0, 16, b'1', '2023-02-22 22:18:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `company_video`
--

CREATE TABLE `company_video` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `video_id` int(11) DEFAULT NULL,
  `change_time` int(11) DEFAULT NULL,
  `is_active` bit(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `company_video`
--

INSERT INTO `company_video` (`id`, `company_id`, `video_id`, `change_time`, `is_active`, `created_at`, `updated_at`) VALUES
(7, 2, 32, 1, b'1', '2023-02-21 15:44:30', NULL),
(8, 18, 33, 3, b'1', '2023-02-21 15:46:34', NULL),
(9, 2, 33, 1, b'1', '2023-02-21 22:52:50', NULL),
(10, 0, 32, 1, b'1', '2023-02-22 07:25:27', NULL),
(11, 0, 34, 1, b'1', '2023-02-22 11:05:44', NULL),
(12, 18, 35, 1, b'1', '2023-02-22 16:06:58', NULL),
(13, 0, 36, 1, b'1', '2023-02-22 22:18:33', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `photo`
--

CREATE TABLE `photo` (
  `id` int(11) NOT NULL,
  `photo_path` varchar(255) DEFAULT NULL,
  `photo_name` varchar(255) DEFAULT NULL,
  `photo_description` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `photo`
--

INSERT INTO `photo` (`id`, `photo_path`, `photo_name`, `photo_description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(13, 'uploads/photo/switzerland24.jpg', 'Switzerland', NULL, '2023-02-21 14:16:55', NULL, NULL),
(14, 'uploads/photo/cool_red18.jpg', 'red', NULL, '2023-02-21 14:19:23', NULL, NULL),
(15, 'uploads/photo/wpp (77)44.jpg', 'bbq image', NULL, '2023-02-22 11:05:09', NULL, NULL),
(16, 'uploads/photo/astronaut-galaxy-space-suit-dream-triangle-butterflies-3840x2160-808580.jpg', 'astronaut image', NULL, '2023-02-22 22:18:14', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taxi`
--

CREATE TABLE `taxi` (
  `id` int(11) NOT NULL,
  `vehicle_num` varchar(15) NOT NULL,
  `company_id` int(11) NOT NULL,
  `tablet_id` int(11) DEFAULT NULL,
  `sim_number` varchar(15) DEFAULT NULL,
  `app_id` varchar(255) NOT NULL DEFAULT 'soaika1810',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `taxi`
--

INSERT INTO `taxi` (`id`, `vehicle_num`, `company_id`, `tablet_id`, `sim_number`, `app_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '00506KF', 2, 2147483643, '1', 'patrick8301', NULL, NULL, NULL),
(17, '00507KF', 2, 2147483647, '2', 'soaika1810', NULL, NULL, NULL),
(18, '00508KF', 2, 2147483647, '3', 'soaika1811', NULL, NULL, NULL),
(19, '00509KF', 2, 214748369, '4', 'soaika1812', NULL, NULL, NULL),
(28, '43F1543', 18, 1677025399, '5', 'Taxi1677025399', NULL, NULL, NULL),
(29, '00506K0', 19, 1677071185, '111', 'Taxi1677071185', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taxi_company`
--

CREATE TABLE `taxi_company` (
  `company_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `company_group` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `taxi_company`
--

INSERT INTO `taxi_company` (`company_id`, `parent_id`, `company_group`) VALUES
(1, 0, 'Monaco'),
(2, 1, 'Group 1'),
(18, 1, 'Group 2'),
(19, 1, 'Group 3'),
(20, 1, 'Group 4'),
(21, 1, 'Group 5'),
(22, 0, 'Paris'),
(23, 22, 'Group 1'),
(24, 22, 'Group 2'),
(25, 22, 'Group 3'),
(26, 22, 'Group 4'),
(27, 22, 'Group 5'),
(28, 0, 'Danang'),
(29, 28, 'Mai Linh 1'),
(30, 28, 'Mai Linh 2'),
(31, 28, 'Mai Linh 3'),
(32, 28, 'Mai Linh 4'),
(33, 28, 'Mai Linh 5'),
(37, 0, 'Tokyo'),
(38, 37, 'Group 1'),
(39, 37, 'Group 2'),
(40, 37, 'Group 3'),
(41, 37, 'Group 4'),
(42, 0, 'Seoul'),
(43, 42, 'Group 1'),
(44, 42, 'Group 2'),
(45, 42, 'Group 3'),
(46, 42, 'Group 4'),
(51, 1, 'Group 6'),
(52, 1, 'Group 7'),
(53, 1, 'Group 8');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `taxi_video_statistics`
--

CREATE TABLE `taxi_video_statistics` (
  `id` int(11) NOT NULL,
  `taxi_id` int(11) NOT NULL,
  `company_video_id` int(11) NOT NULL,
  `human_type` int(11) NOT NULL,
  `human_time` datetime NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `taxi_video_statistics`
--

INSERT INTO `taxi_video_statistics` (`id`, `taxi_id`, `company_video_id`, `human_type`, `human_time`, `created_at`, `updated_at`) VALUES
(10, 17, 9, 1, '2023-02-21 23:11:00', NULL, NULL),
(11, 17, 9, 2, '2023-02-21 23:11:29', NULL, NULL),
(12, 17, 9, 3, '2023-02-21 23:12:31', NULL, NULL),
(13, 17, 9, 0, '2023-02-21 23:12:46', NULL, NULL),
(14, 17, 10, 1, '2023-02-22 07:25:37', NULL, NULL),
(15, 17, 10, 2, '2023-02-22 07:26:09', NULL, NULL),
(16, 17, 10, 3, '2023-02-22 08:27:09', NULL, NULL),
(17, 17, 10, 0, '2023-02-22 08:27:28', NULL, NULL),
(18, 18, 10, 1, '2023-02-22 07:53:48', NULL, NULL),
(19, 18, 10, 2, '2023-02-22 07:54:05', NULL, NULL),
(20, 18, 10, 3, '2023-02-22 07:54:11', NULL, NULL),
(21, 18, 10, 2, '2023-02-22 07:54:35', NULL, NULL),
(22, 18, 10, 3, '2023-02-22 07:54:41', NULL, NULL),
(23, 18, 10, 0, '2023-02-22 07:54:45', NULL, NULL),
(24, 18, 10, 1, '2023-02-22 08:02:50', NULL, NULL),
(25, 18, 10, 2, '2023-02-22 08:03:07', NULL, NULL),
(26, 18, 10, 3, '2023-02-22 08:03:31', NULL, NULL),
(27, 18, 10, 0, '2023-02-22 08:03:37', NULL, NULL),
(28, 18, 10, 1, '2023-02-22 08:15:38', NULL, NULL),
(29, 18, 10, 2, '2023-02-22 08:15:54', NULL, NULL),
(30, 18, 10, 3, '2023-02-22 08:16:08', NULL, NULL),
(31, 18, 10, 0, '2023-02-22 08:16:14', NULL, NULL),
(37, 18, 10, 1, '2023-01-01 08:15:38', NULL, NULL),
(38, 18, 10, 2, '2023-01-01 08:15:54', NULL, NULL),
(39, 18, 10, 3, '2023-01-01 12:16:08', NULL, NULL),
(40, 18, 10, 0, '2023-01-01 13:16:14', NULL, NULL),
(41, 19, 10, 1, '2023-02-22 10:23:04', NULL, NULL),
(42, 19, 10, 0, '2023-02-22 10:23:49', NULL, NULL),
(43, 28, 11, 1, '2023-02-22 11:06:10', NULL, NULL),
(44, 28, 11, 0, '2023-02-22 11:06:33', NULL, NULL),
(45, 17, 11, 1, '2023-02-22 15:16:26', NULL, NULL),
(46, 17, 11, 0, '2023-02-22 15:16:35', NULL, NULL),
(47, 28, 12, 1, '2023-02-22 17:08:11', NULL, NULL),
(48, 28, 12, 0, '2023-02-22 17:31:55', NULL, NULL),
(49, 28, 12, 1, '2023-02-22 17:39:34', NULL, NULL),
(50, 28, 12, 0, '2023-02-22 17:39:38', NULL, NULL),
(51, 28, 12, 1, '2023-02-22 17:51:13', NULL, NULL),
(52, 28, 12, 0, '2023-02-22 17:51:27', NULL, NULL),
(53, 28, 12, 1, '2023-02-22 18:25:32', NULL, NULL),
(54, 28, 12, 2, '2023-02-22 18:27:46', NULL, NULL),
(55, 28, 12, 3, '2023-02-22 18:28:46', NULL, NULL),
(56, 28, 12, 0, '2023-02-22 18:31:37', NULL, NULL),
(57, 28, 12, 2, '2023-02-22 18:32:27', NULL, NULL),
(58, 28, 12, 3, '2023-02-22 18:32:33', NULL, NULL),
(59, 28, 12, 2, '2023-02-22 18:32:43', NULL, NULL),
(60, 28, 12, 3, '2023-02-22 18:32:46', NULL, NULL),
(61, 28, 12, 1, '2023-02-22 18:32:54', NULL, NULL),
(62, 28, 12, 2, '2023-02-22 18:32:57', NULL, NULL),
(63, 28, 12, 3, '2023-02-22 18:33:00', NULL, NULL),
(64, 28, 12, 0, '2023-02-22 18:33:02', NULL, NULL),
(65, 28, 12, 1, '2023-02-22 18:33:42', NULL, NULL),
(66, 28, 12, 2, '2023-02-22 18:33:52', NULL, NULL),
(67, 28, 12, 3, '2023-02-22 18:33:58', NULL, NULL),
(68, 28, 12, 0, '2023-02-22 18:34:04', NULL, NULL),
(73, 17, 11, 1, '2023-02-22 19:30:04', NULL, NULL),
(74, 17, 11, 2, '2023-02-22 19:31:55', NULL, NULL),
(75, 17, 11, 3, '2023-02-22 19:32:33', NULL, NULL),
(76, 17, 11, 0, '2023-02-22 19:32:36', NULL, NULL),
(77, 17, 11, 1, '2023-02-22 19:34:02', NULL, NULL),
(78, 17, 11, 2, '2023-02-22 19:34:23', NULL, NULL),
(79, 17, 11, 3, '2023-02-22 19:34:28', NULL, NULL),
(80, 17, 11, 0, '2023-02-22 19:34:31', NULL, NULL),
(81, 17, 13, 1, '2023-02-22 22:18:55', NULL, NULL),
(82, 17, 13, 2, '2023-02-22 22:19:23', NULL, NULL),
(83, 17, 13, 3, '2023-02-22 22:20:01', NULL, NULL),
(84, 17, 13, 0, '2023-02-22 22:20:05', NULL, NULL),
(85, 1, 13, 1, '2023-02-23 20:18:16', NULL, NULL),
(86, 1, 13, 0, '2023-02-23 20:18:25', NULL, NULL),
(87, 1, 13, 1, '2023-02-23 20:19:06', NULL, NULL),
(88, 1, 13, 2, '2023-02-23 20:19:24', NULL, NULL),
(89, 1, 13, 3, '2023-02-23 20:19:35', NULL, NULL),
(90, 1, 13, 0, '2023-02-23 20:19:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `video_path` text NOT NULL,
  `video_name` varchar(255) DEFAULT NULL,
  `video_description` varchar(255) DEFAULT NULL,
  `video_length` varchar(255) DEFAULT NULL,
  `video_thumbnail` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `video`
--

INSERT INTO `video` (`id`, `video_path`, `video_name`, `video_description`, `video_length`, `video_thumbnail`, `created_at`, `updated_at`, `deleted_at`) VALUES
(32, 'uploads/video/pexels-darlene-alderson-70401236.mp4', 'Nice green', NULL, '8 seconds', NULL, '2023-02-21 14:16:10', NULL, NULL),
(33, 'uploads/video/pexels-askar-abayev-561630323.mp4', 'Grilled', NULL, '15 seconds', NULL, '2023-02-21 14:18:21', NULL, NULL),
(34, 'uploads/video/pexels-tom-leishman-902087724.mp4', 'bbq', NULL, '21 seconds', NULL, '2023-02-22 11:04:30', NULL, NULL),
(35, 'uploads/video/pexels-artem-podrez-68242551.mp4', 'note', NULL, '11 seconds', NULL, '2023-02-22 16:02:25', NULL, NULL),
(36, 'uploads/video/video54.mp4', 'astronaut', NULL, '28 seconds', NULL, '2023-02-22 22:17:45', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Chỉ mục cho bảng `company_photo`
--
ALTER TABLE `company_photo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `company_video`
--
ALTER TABLE `company_video`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `taxi`
--
ALTER TABLE `taxi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `taxi_company`
--
ALTER TABLE `taxi_company`
  ADD PRIMARY KEY (`company_id`) USING BTREE;

--
-- Chỉ mục cho bảng `taxi_video_statistics`
--
ALTER TABLE `taxi_video_statistics`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Chỉ mục cho bảng `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `company_photo`
--
ALTER TABLE `company_photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT cho bảng `company_video`
--
ALTER TABLE `company_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `photo`
--
ALTER TABLE `photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `taxi`
--
ALTER TABLE `taxi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `taxi_company`
--
ALTER TABLE `taxi_company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT cho bảng `taxi_video_statistics`
--
ALTER TABLE `taxi_video_statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT cho bảng `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
