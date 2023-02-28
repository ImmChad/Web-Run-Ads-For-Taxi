-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3307
-- Thời gian đã tạo: Th2 28, 2023 lúc 04:44 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.2.0

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
(9, 2, 32, 1, b'1', '2023-02-21 22:52:50', NULL),
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
(90, 1, 13, 0, '2023-02-23 20:19:37', NULL, NULL),
(155, 17, 13, 1, '2023-02-26 20:25:42', NULL, NULL),
(156, 17, 13, 2, '2023-02-26 20:26:05', NULL, NULL),
(157, 17, 13, 3, '2023-02-26 20:26:06', NULL, NULL),
(158, 17, 13, 0, '2023-02-26 20:26:06', NULL, NULL),
(159, 17, 13, 1, '2023-02-26 20:30:21', NULL, NULL),
(160, 17, 13, 2, '2023-02-26 20:30:44', NULL, NULL),
(161, 17, 13, 3, '2023-02-26 20:30:47', NULL, NULL),
(162, 17, 13, 0, '2023-02-26 20:30:48', NULL, NULL),
(163, 17, 13, 1, '2023-02-26 20:32:59', NULL, NULL),
(164, 17, 13, 2, '2023-02-26 20:33:22', NULL, NULL),
(165, 17, 13, 3, '2023-02-26 20:33:37', NULL, NULL),
(166, 17, 13, 0, '2023-02-26 20:33:46', NULL, NULL),
(167, 17, 13, 1, '2023-02-26 20:47:12', NULL, NULL),
(168, 17, 13, 2, '2023-02-26 20:47:23', NULL, NULL),
(169, 17, 13, 3, '2023-02-26 20:47:25', NULL, NULL),
(170, 17, 13, 0, '2023-02-26 20:47:25', NULL, NULL),
(171, 17, 13, 1, '2023-02-26 20:48:04', NULL, NULL),
(172, 17, 13, 2, '2023-02-26 20:48:15', NULL, NULL),
(173, 17, 13, 3, '2023-02-26 20:48:35', NULL, NULL),
(174, 17, 13, 2, '2023-02-26 20:48:41', NULL, NULL),
(175, 17, 13, 3, '2023-02-26 20:48:48', NULL, NULL),
(176, 17, 13, 0, '2023-02-26 20:48:48', NULL, NULL),
(177, 17, 13, 1, '2023-02-27 08:37:23', NULL, NULL),
(178, 17, 13, 0, '2023-02-27 08:37:26', NULL, NULL),
(179, 17, 13, 1, '2023-02-27 08:55:08', NULL, NULL),
(180, 17, 13, 0, '2023-02-27 08:55:14', NULL, NULL),
(181, 17, 13, 1, '2023-02-27 09:00:31', NULL, NULL),
(182, 17, 13, 2, '2023-02-27 09:00:40', NULL, NULL),
(183, 17, 13, 3, '2023-02-27 09:00:55', NULL, NULL),
(184, 17, 13, 2, '2023-02-27 09:01:04', NULL, NULL),
(185, 17, 13, 3, '2023-02-27 09:01:05', NULL, NULL),
(186, 17, 13, 0, '2023-02-27 09:01:05', NULL, NULL),
(187, 17, 13, 1, '2023-02-27 09:02:24', NULL, NULL),
(188, 17, 13, 0, '2023-02-27 09:02:31', NULL, NULL),
(189, 17, 13, 1, '2023-02-27 09:07:59', NULL, NULL),
(190, 17, 13, 0, '2023-02-27 09:08:17', NULL, NULL),
(191, 17, 13, 1, '2023-02-27 09:11:59', NULL, NULL),
(192, 17, 13, 2, '2023-02-27 09:12:01', NULL, NULL),
(193, 17, 13, 3, '2023-02-27 09:12:04', NULL, NULL),
(194, 17, 13, 0, '2023-02-27 09:12:04', NULL, NULL),
(195, 17, 13, 1, '2023-02-27 09:15:21', NULL, NULL),
(196, 17, 13, 0, '2023-02-27 09:15:36', NULL, NULL),
(197, 17, 13, 1, '2023-02-27 09:15:39', NULL, NULL),
(198, 17, 13, 2, '2023-02-27 09:15:42', NULL, NULL),
(199, 17, 13, 3, '2023-02-27 09:15:44', NULL, NULL),
(200, 17, 13, 0, '2023-02-27 09:15:44', NULL, NULL),
(201, 17, 13, 1, '2023-02-27 09:18:08', NULL, NULL),
(202, 17, 13, 0, '2023-02-27 09:18:17', NULL, NULL),
(203, 17, 13, 1, '2023-02-27 09:18:20', NULL, NULL),
(204, 17, 13, 0, '2023-02-27 09:18:21', NULL, NULL),
(205, 17, 13, 1, '2023-02-27 09:18:24', NULL, NULL),
(206, 17, 13, 2, '2023-02-27 09:18:24', NULL, NULL),
(207, 17, 13, 3, '2023-02-27 09:18:42', NULL, NULL),
(208, 17, 13, 0, '2023-02-27 09:18:43', NULL, NULL),
(209, 17, 13, 1, '2023-02-27 09:23:13', NULL, NULL),
(210, 17, 13, 2, '2023-02-27 09:23:22', NULL, NULL),
(211, 17, 13, 3, '2023-02-27 09:23:25', NULL, NULL),
(212, 17, 13, 0, '2023-02-27 09:23:25', NULL, NULL),
(213, 17, 13, 1, '2023-02-27 09:31:04', NULL, NULL),
(214, 17, 13, 2, '2023-02-27 09:32:02', NULL, NULL),
(215, 17, 13, 3, '2023-02-27 09:32:46', NULL, NULL),
(216, 17, 13, 0, '2023-02-27 09:32:47', NULL, NULL),
(217, 17, 13, 1, '2023-02-27 09:36:59', NULL, NULL),
(218, 17, 13, 0, '2023-02-27 09:37:03', NULL, NULL),
(219, 17, 13, 1, '2023-02-27 09:37:07', NULL, NULL),
(220, 17, 13, 2, '2023-02-27 09:37:12', NULL, NULL),
(221, 17, 13, 3, '2023-02-27 09:37:13', NULL, NULL),
(222, 17, 13, 0, '2023-02-27 09:37:14', NULL, NULL),
(223, 17, 13, 1, '2023-02-27 09:40:22', NULL, NULL),
(224, 17, 13, 2, '2023-02-27 09:40:33', NULL, NULL),
(225, 17, 13, 3, '2023-02-27 09:40:34', NULL, NULL),
(226, 17, 13, 0, '2023-02-27 09:40:35', NULL, NULL),
(227, 17, 13, 1, '2023-02-27 09:58:15', NULL, NULL),
(228, 17, 13, 0, '2023-02-27 09:58:20', NULL, NULL),
(229, 17, 13, 1, '2023-02-27 09:58:32', NULL, NULL),
(230, 17, 13, 0, '2023-02-27 09:58:41', NULL, NULL),
(231, 17, 13, 1, '2023-02-27 09:58:47', NULL, NULL),
(232, 17, 13, 2, '2023-02-27 09:58:48', NULL, NULL),
(233, 17, 13, 3, '2023-02-27 09:58:51', NULL, NULL),
(234, 17, 13, 0, '2023-02-27 09:58:51', NULL, NULL),
(235, 17, 13, 1, '2023-02-27 09:59:41', NULL, NULL),
(236, 17, 13, 2, '2023-02-27 09:59:51', NULL, NULL),
(237, 17, 13, 3, '2023-02-27 09:59:53', NULL, NULL),
(238, 17, 13, 0, '2023-02-27 09:59:53', NULL, NULL),
(239, 17, 13, 1, '2023-02-27 10:04:15', NULL, NULL),
(240, 17, 13, 2, '2023-02-27 10:04:16', NULL, NULL),
(241, 17, 13, 3, '2023-02-27 10:05:26', NULL, NULL),
(242, 17, 13, 0, '2023-02-27 10:05:27', NULL, NULL),
(243, 17, 13, 1, '2023-02-27 10:05:49', NULL, NULL),
(244, 17, 13, 2, '2023-02-27 10:05:49', NULL, NULL),
(245, 17, 13, 3, '2023-02-27 10:06:02', NULL, NULL),
(246, 17, 13, 0, '2023-02-27 10:06:12', NULL, NULL),
(247, 17, 13, 1, '2023-02-27 10:15:05', NULL, NULL),
(248, 17, 13, 2, '2023-02-27 10:15:08', NULL, NULL),
(249, 17, 13, 3, '2023-02-27 10:15:35', NULL, NULL),
(250, 17, 13, 0, '2023-02-27 10:15:36', NULL, NULL),
(251, 17, 13, 1, '2023-02-27 10:21:29', NULL, NULL),
(252, 17, 13, 2, '2023-02-27 10:21:39', NULL, NULL),
(253, 17, 13, 3, '2023-02-27 10:21:41', NULL, NULL),
(254, 17, 13, 0, '2023-02-27 10:21:42', NULL, NULL),
(255, 17, 13, 1, '2023-02-27 10:23:21', NULL, NULL),
(256, 17, 13, 0, '2023-02-27 10:23:29', NULL, NULL),
(257, 17, 13, 1, '2023-02-27 10:23:33', NULL, NULL),
(258, 17, 13, 2, '2023-02-27 10:23:35', NULL, NULL),
(259, 17, 13, 3, '2023-02-27 10:23:38', NULL, NULL),
(260, 17, 13, 0, '2023-02-27 10:23:38', NULL, NULL),
(261, 17, 13, 1, '2023-02-27 10:26:05', NULL, NULL),
(262, 17, 13, 0, '2023-02-27 10:26:11', NULL, NULL),
(263, 17, 13, 1, '2023-02-27 10:26:13', NULL, NULL),
(264, 17, 13, 2, '2023-02-27 10:26:16', NULL, NULL),
(265, 17, 13, 3, '2023-02-27 10:26:17', NULL, NULL),
(266, 17, 13, 0, '2023-02-27 10:26:18', NULL, NULL),
(267, 17, 13, 1, '2023-02-27 10:26:24', NULL, NULL),
(268, 17, 13, 0, '2023-02-27 10:26:26', NULL, NULL),
(269, 17, 13, 1, '2023-02-27 10:30:49', NULL, NULL),
(270, 17, 13, 0, '2023-02-27 10:33:04', NULL, NULL),
(271, 17, 13, 1, '2023-02-27 10:46:28', NULL, NULL),
(272, 17, 13, 0, '2023-02-27 10:46:31', NULL, NULL),
(273, 17, 13, 1, '2023-02-27 10:47:06', NULL, NULL),
(274, 17, 13, 2, '2023-02-27 10:47:15', NULL, NULL),
(275, 17, 13, 3, '2023-02-27 10:47:23', NULL, NULL),
(276, 17, 13, 0, '2023-02-27 10:47:23', NULL, NULL),
(277, 17, 13, 1, '2023-02-27 10:48:45', NULL, NULL),
(278, 17, 13, 0, '2023-02-27 10:48:49', NULL, NULL),
(279, 17, 13, 1, '2023-02-27 10:48:52', NULL, NULL),
(280, 17, 13, 2, '2023-02-27 10:48:55', NULL, NULL),
(281, 17, 13, 3, '2023-02-27 10:48:57', NULL, NULL),
(282, 17, 13, 0, '2023-02-27 10:48:57', NULL, NULL),
(283, 17, 13, 1, '2023-02-27 10:53:27', NULL, NULL),
(284, 17, 13, 0, '2023-02-27 10:55:42', NULL, NULL),
(285, 17, 13, 1, '2023-02-27 10:56:03', NULL, NULL),
(286, 17, 13, 0, '2023-02-27 10:56:07', NULL, NULL),
(287, 17, 13, 1, '2023-02-27 10:56:08', NULL, NULL),
(288, 17, 13, 0, '2023-02-27 10:56:11', NULL, NULL),
(289, 17, 13, 1, '2023-02-27 10:56:12', NULL, NULL),
(290, 17, 13, 2, '2023-02-27 10:56:18', NULL, NULL),
(291, 17, 13, 3, '2023-02-27 10:56:20', NULL, NULL),
(292, 17, 13, 0, '2023-02-27 10:56:20', NULL, NULL),
(293, 17, 13, 1, '2023-02-27 10:56:28', NULL, NULL),
(294, 17, 13, 0, '2023-02-27 10:56:32', NULL, NULL),
(295, 17, 13, 1, '2023-02-27 10:56:34', NULL, NULL),
(296, 17, 13, 2, '2023-02-27 10:56:41', NULL, NULL),
(297, 17, 13, 3, '2023-02-27 10:56:43', NULL, NULL),
(298, 17, 13, 0, '2023-02-27 10:56:44', NULL, NULL),
(299, 17, 13, 1, '2023-02-27 10:59:24', NULL, NULL),
(300, 17, 13, 0, '2023-02-27 10:59:28', NULL, NULL),
(301, 17, 13, 1, '2023-02-27 10:59:30', NULL, NULL),
(302, 17, 13, 2, '2023-02-27 10:59:37', NULL, NULL),
(303, 17, 13, 3, '2023-02-27 10:59:39', NULL, NULL),
(304, 17, 13, 0, '2023-02-27 10:59:40', NULL, NULL),
(305, 17, 13, 1, '2023-02-27 10:59:42', NULL, NULL),
(306, 17, 13, 0, '2023-02-27 10:59:49', NULL, NULL),
(307, 17, 13, 1, '2023-02-27 11:01:07', NULL, NULL),
(308, 17, 13, 2, '2023-02-27 11:01:17', NULL, NULL),
(309, 17, 13, 3, '2023-02-27 11:01:33', NULL, NULL),
(310, 17, 13, 0, '2023-02-27 11:01:38', NULL, NULL),
(311, 17, 13, 1, '2023-02-27 11:02:01', NULL, NULL),
(312, 17, 13, 0, '2023-02-27 11:02:02', NULL, NULL),
(313, 17, 13, 1, '2023-02-27 11:02:04', NULL, NULL),
(314, 17, 13, 2, '2023-02-27 11:02:06', NULL, NULL),
(315, 17, 13, 3, '2023-02-27 11:02:09', NULL, NULL),
(316, 17, 13, 0, '2023-02-27 11:02:09', NULL, NULL),
(317, 17, 13, 1, '2023-02-27 11:02:51', NULL, NULL),
(318, 17, 13, 0, '2023-02-27 11:02:56', NULL, NULL),
(319, 17, 13, 1, '2023-02-27 11:03:00', NULL, NULL),
(320, 17, 13, 2, '2023-02-27 11:03:04', NULL, NULL),
(321, 17, 13, 3, '2023-02-27 11:03:06', NULL, NULL),
(322, 17, 13, 0, '2023-02-27 11:03:06', NULL, NULL),
(323, 17, 13, 1, '2023-02-27 11:08:35', NULL, NULL),
(324, 17, 13, 0, '2023-02-27 11:08:38', NULL, NULL),
(325, 17, 13, 1, '2023-02-27 11:08:40', NULL, NULL),
(326, 17, 13, 0, '2023-02-27 11:09:06', NULL, NULL),
(327, 17, 13, 1, '2023-02-27 11:09:11', NULL, NULL),
(328, 17, 13, 0, '2023-02-27 11:09:22', NULL, NULL),
(329, 17, 13, 1, '2023-02-27 21:43:19', NULL, NULL),
(330, 17, 13, 0, '2023-02-27 21:43:37', NULL, NULL),
(331, 17, 13, 1, '2023-02-27 21:43:48', NULL, NULL),
(332, 17, 13, 0, '2023-02-27 21:43:53', NULL, NULL),
(333, 17, 13, 1, '2023-02-27 21:43:55', NULL, NULL),
(334, 17, 13, 0, '2023-02-27 21:43:57', NULL, NULL),
(335, 17, 13, 1, '2023-02-27 21:45:54', NULL, NULL),
(336, 17, 13, 0, '2023-02-27 21:45:55', NULL, NULL),
(337, 17, 13, 1, '2023-02-27 21:46:25', NULL, NULL),
(338, 17, 13, 0, '2023-02-27 21:46:35', NULL, NULL),
(339, 17, 13, 1, '2023-02-27 22:09:59', NULL, NULL),
(340, 17, 13, 2, '2023-02-27 22:10:11', NULL, NULL),
(341, 17, 13, 3, '2023-02-27 22:10:25', NULL, NULL),
(342, 17, 13, 0, '2023-02-27 22:10:25', NULL, NULL),
(343, 17, 13, 1, '2023-02-27 22:10:40', NULL, NULL),
(344, 17, 13, 0, '2023-02-27 22:11:03', NULL, NULL),
(345, 17, 13, 1, '2023-02-27 22:23:46', NULL, NULL),
(346, 17, 13, 0, '2023-02-27 22:24:10', NULL, NULL),
(347, 17, 13, 1, '2023-02-27 22:24:29', NULL, NULL),
(348, 17, 13, 0, '2023-02-27 22:24:38', NULL, NULL),
(349, 17, 13, 1, '2023-02-27 22:43:06', NULL, NULL),
(350, 17, 13, 0, '2023-02-27 22:43:16', NULL, NULL),
(351, 17, 13, 1, '2023-02-27 22:53:26', NULL, NULL),
(352, 17, 13, 0, '2023-02-27 22:53:27', NULL, NULL),
(353, 17, 13, 1, '2023-02-27 22:55:10', NULL, NULL),
(354, 17, 13, 0, '2023-02-27 22:55:11', NULL, NULL),
(355, 17, 13, 1, '2023-02-27 22:55:13', NULL, NULL),
(356, 17, 13, 0, '2023-02-27 22:55:14', NULL, NULL),
(357, 17, 13, 1, '2023-02-27 22:56:54', NULL, NULL),
(358, 17, 13, 0, '2023-02-27 22:56:56', NULL, NULL),
(359, 17, 13, 1, '2023-02-28 08:38:29', NULL, NULL),
(360, 17, 13, 0, '2023-02-28 08:38:30', NULL, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=361;

--
-- AUTO_INCREMENT cho bảng `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
