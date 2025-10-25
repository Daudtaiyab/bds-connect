-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2022 at 06:15 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bds`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_user_courses`
--

CREATE TABLE `assign_user_courses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `valid_date_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assign_user_courses`
--

INSERT INTO `assign_user_courses` (`id`, `user_id`, `course_id`, `created_by`, `created_at`, `updated_at`, `valid_date_time`) VALUES
(1, 1, 2, 2, '2022-12-24 08:21:04', '2022-12-24 15:36:29', '2022-12-24 08:21:04');

-- --------------------------------------------------------

--
-- Table structure for table `code_library_lessons`
--

CREATE TABLE `code_library_lessons` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `level_id` int(11) NOT NULL,
  `code_file` varchar(255) DEFAULT NULL,
  `code_title` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=>inactive,1=>active',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=>exist,1=>deleted',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `code_library_lessons`
--

INSERT INTO `code_library_lessons` (`id`, `lesson_id`, `cat_id`, `level_id`, `code_file`, `code_title`, `status`, `is_deleted`, `created_at`, `update_at`) VALUES
(1, 7, 3, 11, '1672330612.1672159371_bds.png', 'trt', 1, 0, '2022-12-29 16:16:52', '2022-12-29 16:16:52'),
(2, 7, 3, 11, '1672330612.1672159478_aps.png', '7657656', 1, 0, '2022-12-29 16:16:52', '2022-12-29 16:16:52');

-- --------------------------------------------------------

--
-- Table structure for table `coursecategories`
--

CREATE TABLE `coursecategories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `teaching_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0=>inactive,1=>active',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=>exist, 1=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursecategories`
--

INSERT INTO `coursecategories` (`id`, `category_name`, `teaching_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'PDF Library', 1, 1, 0, '2022-12-12 17:52:35', '2022-12-12 17:52:35'),
(2, 'Video library', 1, 1, 0, '2022-12-12 17:52:35', '2022-12-12 17:52:35'),
(3, 'Project cum Code library', 1, 1, 0, '2022-12-12 17:53:15', '2022-12-12 17:53:15'),
(4, 'PDF Library', 2, 1, 0, '2022-12-12 17:52:35', '2022-12-12 17:52:35'),
(5, 'Video library', 2, 1, 0, '2022-12-12 17:52:35', '2022-12-12 17:52:35'),
(6, 'Project cum Code library', 2, 1, 0, '2022-12-12 17:53:15', '2022-12-12 17:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `courselibraries`
--

CREATE TABLE `courselibraries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teaching_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `course_cat_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courselibraries`
--

INSERT INTO `courselibraries` (`id`, `name`, `teaching_id`, `course_id`, `course_cat_id`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Level 8', 2, 3, 4, 1, 0, '2022-12-25 08:04:51', '2022-12-25 08:04:51'),
(2, 'Level 1', 1, 12, 1, 1, 0, '2022-12-25 08:03:41', '2022-12-25 08:03:41'),
(3, 'Level 2', 1, 12, 1, 1, 0, '2022-12-25 08:03:49', '2022-12-25 08:03:49'),
(4, 'Level 3', 1, 12, 1, 1, 0, '2022-12-25 08:03:59', '2022-12-25 08:03:59'),
(5, 'Level 7', 1, 19, 2, 1, 0, '2022-12-26 10:43:38', '2022-12-26 10:43:38'),
(6, 'Level 4', 1, 12, 1, 1, 0, '2022-12-25 08:04:25', '2022-12-25 08:04:25'),
(7, 'Level  5', 1, 12, 2, 1, 0, '2022-12-25 08:04:19', '2022-12-25 08:04:19'),
(8, 'Level 6', 1, 12, 1, 1, 0, '2022-12-25 08:04:35', '2022-12-25 08:04:35'),
(9, 'Code Level-1', 1, 19, 3, 1, 0, '2022-12-27 10:59:52', '2022-12-27 10:59:52'),
(10, 'Code Level-2', 1, 19, 3, 1, 0, '2022-12-27 11:00:06', '2022-12-27 11:00:06'),
(11, 'Level-1', 1, 21, 3, 1, 0, '2022-12-27 11:04:06', '2022-12-27 11:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_img` varchar(255) DEFAULT NULL,
  `teaching_id` int(11) NOT NULL COMMENT 'id of teaching options',
  `created_by` int(11) NOT NULL,
  `status` int(11) DEFAULT 1 COMMENT '1=>active 0=>inactive',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=>exist 1=>deleted',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `course_img`, `teaching_id`, `created_by`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'AA', '1671642019_airblock.jpg', 2, 2, 1, 0, '2022-12-13 16:34:45', '2022-12-22 16:58:38'),
(2, 'AA', '1671642173_codey-rocky.jpg', 2, 2, 1, 0, '2022-12-13 16:34:45', '2022-12-21 17:02:53'),
(3, 'AA', NULL, 2, 2, 1, 0, '2022-12-13 16:34:45', '2022-12-22 16:58:11'),
(4, 'AA', NULL, 2, 2, 1, 0, '2022-12-13 16:34:45', '2022-12-22 16:58:17'),
(5, 'Test', NULL, 2, 2, 1, 0, '2022-12-15 16:52:15', '2022-12-22 16:58:31'),
(6, 'Testfhg', NULL, 2, 2, 1, 0, '2022-12-15 16:52:50', '2022-12-22 16:58:44'),
(7, 'Testfhgasdas', NULL, 2, 2, 1, 0, '2022-12-15 16:53:14', '2022-12-22 16:58:52'),
(8, 'sadasdasda', NULL, 2, 2, 1, 0, '2022-12-15 16:54:45', '2022-12-22 16:59:00'),
(9, 'sadasdasdasaasdasd', NULL, 2, 2, 1, 0, '2022-12-15 16:56:20', '2022-12-22 16:59:08'),
(10, 'sadasdasdasaasdasdasdasdas', NULL, 2, 2, 1, 0, '2022-12-15 16:58:53', '2022-12-15 16:58:53'),
(11, 'sadasdasdasaasdasdasdasdassdsdfsd', NULL, 2, 2, 1, 0, '2022-12-15 16:59:33', '2022-12-22 16:59:21'),
(12, 'Free', NULL, 1, 1, 1, 0, NULL, NULL),
(13, 'ddssd', '1671877623_codey-rocky.jpg', 1, 2, 1, 0, '2022-12-24 10:27:03', '2022-12-24 10:27:03'),
(14, 'ddssdddssd', '1671877644_cyber-pi-go-kit.jpg', 1, 2, 1, 0, '2022-12-24 10:27:24', '2022-12-24 10:27:24'),
(15, 'ddssdddssdddd', '1671877687_airblock.jpg', 1, 2, 1, 0, '2022-12-24 10:28:07', '2022-12-24 10:28:07'),
(16, 'dssd', '1671877720_codey-rocky-neuron-classroom-kit.jpg', 1, 2, 1, 0, '2022-12-24 10:28:40', '2022-12-24 10:28:40'),
(17, 'dsdfsdfsdfsdfsd', '1671877739_mbot-add-on-pack-servo-pack.jpg', 1, 2, 1, 0, '2022-12-24 10:28:59', '2022-12-24 10:28:59'),
(18, 'dsdfsdfsdfsdfsddd', '1671877798_airblock.jpg', 1, 2, 1, 0, '2022-12-24 10:29:58', '2022-12-24 10:29:58'),
(19, 'sdsd', '1671877837_mbot-add-on-pack-perception-gizmo.jpg', 1, 2, 1, 0, '2022-12-24 10:30:37', '2022-12-24 10:30:37'),
(20, 'Test-1', '1672158652_aps.png', 1, 2, 1, 0, '2022-12-27 16:30:52', '2022-12-27 16:30:52'),
(21, 'Test-2', '1672158665_codey-robot.gif', 1, 2, 1, 0, '2022-12-27 16:31:05', '2022-12-27 16:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `course_lessons`
--

CREATE TABLE `course_lessons` (
  `id` int(11) NOT NULL,
  `lesson_number` int(11) DEFAULT NULL,
  `lesson_title` varchar(255) DEFAULT NULL,
  `lesson_subject` varchar(255) DEFAULT NULL,
  `level_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `teaching_id` int(11) DEFAULT NULL,
  `lesson_document` varchar(255) DEFAULT NULL,
  `lesson_iframe_code` text DEFAULT NULL,
  `lesson_video` varchar(255) DEFAULT NULL,
  `code_library` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=>active 0=>inactive',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=>exist 1=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_lessons`
--

INSERT INTO `course_lessons` (`id`, `lesson_number`, `lesson_title`, `lesson_subject`, `level_id`, `cat_id`, `course_id`, `teaching_id`, `lesson_document`, `lesson_iframe_code`, `lesson_video`, `code_library`, `created_by`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Motivation of children to Coding.', 'Motivation of children to Coding.', 5, 2, 19, 1, NULL, '<iframe src=\"https://docs.google.com/presentation/d/e/2PACX-1vTT3k_Bafy9pLUqPJk79c9QytRwDLUqJVL974J2KNEDIxxd_cg8o8LwCVbAi4l98qxATLkFQrGMa8K0/embed?start=false&loop=false&delayms=3000\" frameborder=\"0\" width=\"100%\" height=\"100%\" allowfullscreen=\"true\" mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\"></iframe>', '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/pmHh_JH1XOE\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', NULL, 2, 1, 0, '2022-12-17 12:09:18', '2022-12-26 22:11:45'),
(2, NULL, 'rfytrytry', 'oiuoiuoi', 2, 1, 12, 1, NULL, '<iframe src=\"https://docs.google.com/presentation/d/e/2PACX-1vTT3k_Bafy9pLUqPJk79c9QytRwDLUqJVL974J2KNEDIxxd_cg8o8LwCVbAi4l98qxATLkFQrGMa8K0/embed?start=false&loop=false&delayms=3000\" frameborder=\"0\" width=\"100%\" height=\"100%\" allowfullscreen=\"true\" mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\"></iframe>', NULL, NULL, 2, 1, 0, '2022-12-18 10:06:40', '2022-12-26 22:11:54'),
(3, NULL, 'Test', 'Test', 2, 1, 12, 1, NULL, 'test', NULL, NULL, 2, 1, 0, '2022-12-24 07:41:36', '2022-12-24 07:42:16'),
(4, NULL, 'test', 'test', 1, 4, 3, 2, NULL, 'test', NULL, NULL, 2, 1, 0, '2022-12-24 07:41:59', '2022-12-24 07:42:07'),
(5, NULL, 'test1ss', 'testss', 11, 3, 21, 1, '1672159371_bds.png', NULL, NULL, NULL, 2, 1, 0, '2022-12-27 16:42:51', '2022-12-27 20:17:41'),
(6, NULL, 'test-2', 'test-2', 11, 3, 21, 1, '1672159478_aps.png', NULL, NULL, NULL, 2, 1, 0, '2022-12-27 16:44:38', '2022-12-27 20:15:09'),
(7, NULL, 'rtrt', 'uyuyu', 11, 3, 21, 1, '1672330612_1672159371_bds.png', NULL, NULL, NULL, 2, 1, 0, '2022-12-29 16:16:52', '2022-12-29 16:16:52'),
(8, NULL, 'yty', 'uyuyu', 1, 4, 3, 2, NULL, 'yty', NULL, NULL, 2, 1, 0, '2022-12-29 16:19:35', '2022-12-29 16:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_12_13_183844_create_courselibraries_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rajatest@gmail.com', '$2y$10$ehYIsY08vt09odd9CjNvYuglaqWd8du9RysJMHzDQFKA9DgvBTzIq', '2022-12-29 11:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE `tbl_notifications` (
  `id` int(11) NOT NULL,
  `notification_type` tinyint(3) DEFAULT NULL COMMENT '1: Alert 2:Information 3:Escalation',
  `role_id` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT 0,
  `notification_subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notification_body` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'table:gi_data_entry,ModelName',
  `notifiable_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'modules record ID',
  `mail_sent_from` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_sent_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_msg` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `msg_other` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_page_action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Url:Go approval page',
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachingoptions`
--

CREATE TABLE `teachingoptions` (
  `id` int(11) NOT NULL,
  `option_name` varchar(255) DEFAULT NULL,
  `option_url` varchar(255) DEFAULT NULL,
  `free_paid` int(11) DEFAULT 1 COMMENT '1=>free 2=>paid',
  `status` int(11) NOT NULL DEFAULT 1,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachingoptions`
--

INSERT INTO `teachingoptions` (`id`, `option_name`, `option_url`, `free_paid`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Teaching with Sprites', NULL, 1, 1, 0, '2022-12-11 13:52:10', '2022-12-11 13:52:10'),
(2, 'Teaching with Devices', NULL, 2, 1, 0, '2022-12-11 13:53:02', '2022-12-11 13:53:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_role_id` int(11) NOT NULL,
  `school_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0 COMMENT '0=>Inactive,1=>active',
  `is_approved` int(11) DEFAULT 0 COMMENT '0=>unapproved,1=>approved,2=>rejected',
  `approved_date` datetime DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=>active 1=>deleted',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `email`, `last_name`, `phone_number`, `username`, `user_role_id`, `school_id`, `status`, `is_approved`, `approved_date`, `approved_by`, `is_deleted`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'rrr', 'raja@gmail.com', 'rrr', 1234567890, 'admin@admin.com', 0, NULL, 0, 1, '2022-12-24 08:16:23', 2, 0, NULL, '$2y$10$aflcMfdGwBiLB95qO4DH0uu9tkBAr9/gXRwP86U58QK7Ye6k8KxdW', NULL, '2022-12-11 04:51:33', '2022-12-24 02:46:23'),
(2, 'raja', 'rajatest@gmail.com', 'Kumar', 1234567890, 'rajatest@gmail.com', 1, NULL, 1, 1, '2022-12-19 19:08:32', 2, 0, NULL, '$2y$10$1RckIdBTUn9yc8HjpXvamuAlchhjAmsXWMOLGjfDdhdwp3poFglbu', NULL, '2022-12-11 05:45:21', '2022-12-19 13:38:32'),
(3, 'tryt', 'programmerskills2018@gmail.com', 'ytuy', 1234567890, 'rajatest2@gmail.com', 2, NULL, 1, 0, NULL, NULL, 0, NULL, '$2y$10$o0vRq51b9I3LiNKocHbAHOUoDjGEvVv4GcogwcG/Y/BUVaZJTCPhO', 'KTWZdyaldbUuhDrCwwO4778kQT4tafDArMCHfRbGxjnEk7KlbEC0HsiNnwaK', '2022-12-11 07:58:37', '2022-12-29 11:42:44'),
(4, 'Front', 'user@gmail.com', 'User', 1234567890, 'user@gmail.com', 2, NULL, 1, 1, '2022-12-25 11:14:50', 2, 0, NULL, '$2y$10$lTtlO6TEnM4zUJS2iQmb.eAWNiEJf.4EoGKl8d2B91SMWMzMPV6zq', NULL, '2022-12-25 05:44:19', '2022-12-25 05:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1 COMMENT '0=>inactive 1=>active',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '1=>deleted,0=>exist',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_name`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 0, '2022-12-11 11:38:16', '2022-12-11 11:38:16'),
(2, 'User', 1, 0, '2022-12-11 11:38:16', '2022-12-11 11:38:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assign_user_courses`
--
ALTER TABLE `assign_user_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `code_library_lessons`
--
ALTER TABLE `code_library_lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coursecategories`
--
ALTER TABLE `coursecategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courselibraries`
--
ALTER TABLE `courselibraries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_lessons`
--
ALTER TABLE `course_lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`(191),`notifiable_id`);

--
-- Indexes for table `teachingoptions`
--
ALTER TABLE `teachingoptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assign_user_courses`
--
ALTER TABLE `assign_user_courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `code_library_lessons`
--
ALTER TABLE `code_library_lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coursecategories`
--
ALTER TABLE `coursecategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courselibraries`
--
ALTER TABLE `courselibraries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `course_lessons`
--
ALTER TABLE `course_lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teachingoptions`
--
ALTER TABLE `teachingoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
