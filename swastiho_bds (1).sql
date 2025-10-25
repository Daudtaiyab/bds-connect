-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2023 at 04:46 PM
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
-- Database: `swastiho_bds`
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
(1, 1, 3, 2, '2022-12-22 17:05:15', '2022-12-22 17:05:15', '2022-12-22 17:05:15'),
(2, 1, 4, 2, '2022-12-22 17:05:15', '2022-12-22 17:05:15', '2022-12-22 17:05:15'),
(3, 1, 5, 2, '2022-12-22 17:05:15', '2022-12-22 17:05:15', '2022-12-22 17:05:15'),
(4, 1, 6, 2, '2022-12-22 17:05:15', '2022-12-22 17:05:15', '2022-12-22 17:05:15'),
(5, 1, 1, 2, '2022-12-22 17:12:18', '2022-12-22 17:12:18', '2022-12-22 17:12:18'),
(6, 1, 2, 2, '2022-12-22 17:12:18', '2022-12-22 17:12:18', '2022-12-22 17:12:18'),
(7, 1, 10, 2, '2022-12-22 17:12:18', '2022-12-22 17:12:18', '2022-12-22 17:12:18'),
(8, 5, 14, 2, '2023-01-03 17:32:39', '2023-01-03 17:32:39', '2024-01-03 17:32:39'),
(9, 5, 15, 2, '2023-01-04 09:49:23', '2023-01-04 09:49:23', '2024-01-04 09:49:23'),
(10, 5, 11, 2, '2023-01-04 15:35:09', '2023-01-04 15:35:09', '2024-01-04 15:35:09'),
(11, 5, 1, 2, '2023-01-05 06:04:11', '2023-01-05 06:04:11', '2024-01-05 06:04:11'),
(12, 5, 10, 2, '2023-01-05 09:17:40', '2023-01-05 09:17:40', '2024-01-05 09:17:40'),
(13, 9, 2, 2, '2023-01-07 10:53:50', '2023-01-07 10:53:50', '2024-01-07 10:53:50'),
(14, 9, 6, 2, '2023-01-07 10:53:50', '2023-01-07 10:53:50', '2024-01-07 10:53:50'),
(15, 9, 5, 2, '2023-01-07 10:54:56', '2023-01-07 10:54:56', '2024-01-07 10:54:56'),
(16, 9, 15, 2, '2023-01-07 10:56:17', '2023-01-07 10:56:17', '2024-01-07 10:56:17'),
(17, 9, 8, 2, '2023-01-07 10:56:46', '2023-01-07 10:56:46', '2024-01-07 10:56:46'),
(18, 9, 14, 2, '2023-01-07 10:56:46', '2023-01-07 10:56:46', '2024-01-07 10:56:46'),
(19, 9, 7, 2, '2023-01-07 10:59:59', '2023-01-07 10:59:59', '2024-01-07 10:59:59'),
(20, 9, 11, 2, '2023-01-07 10:59:59', '2023-01-07 10:59:59', '2024-01-07 10:59:59');

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
  `updated_at` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `code_library_lessons`
--

INSERT INTO `code_library_lessons` (`id`, `lesson_id`, `cat_id`, `level_id`, `code_file`, `code_title`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, 7, 3, 11, '1672330612.1672159371_bds.png', 'trt', 1, 0, '2022-12-29 16:16:52', '2022-12-29 16:16:52'),
(2, 7, 3, 11, '1672330612.1672159478_aps.png', '7657656', 1, 0, '2022-12-29 16:16:52', '2022-12-29 16:16:52'),
(3, 13, 6, 15, '1672910929.01_codey introduces himself 2 (1).mblock', 'Intro 1', 1, 0, '2023-01-05 09:28:49', '2023-01-05 09:28:49'),
(4, 13, 6, 15, '1672910929.01.2 Basic Text (2) (1).mblock', 'Intro 2', 1, 0, '2023-01-05 09:28:49', '2023-01-05 09:28:49'),
(5, 14, 6, 16, '1672911149.01_codey introduces himself 2 (1).mblock', 'Module 1', 1, 0, '2023-01-05 09:32:29', '2023-01-05 09:32:29'),
(6, 14, 6, 16, '1672911149.01.2 Basic Text (3).mblock', 'Module 2', 1, 0, '2023-01-05 09:32:29', '2023-01-05 09:32:29'),
(7, 17, 3, 19, '1673078510_linkedin.png', 'Kumar', 1, 0, '2023-01-06 17:31:25', '2023-01-07 10:34:51'),
(8, 17, 3, 19, '1673026285.bds.png', 'dsddssds', 1, 0, '2023-01-06 17:31:25', '2023-01-07 10:34:51'),
(9, 17, 3, 19, '1673026285.bds.png', 'dssdsssdds', 1, 0, '2023-01-06 17:31:25', '2023-01-07 10:34:51'),
(10, 17, 3, 19, '1673072962.bds.png', 'sddsds', 1, 0, '2023-01-07 06:29:22', '2023-01-07 10:34:51'),
(11, 17, 3, 19, '1673073022.twitter.png', 'sddsds', 1, 0, '2023-01-07 06:30:22', '2023-01-07 10:34:51'),
(12, 17, 3, 19, '1673073022.facebook.png', 'dsddssds', 1, 0, '2023-01-07 06:30:22', '2023-01-07 10:34:51'),
(13, 17, 3, 19, '1673078598_facebook.png', 'RajaKumar', 1, 0, '2023-01-07 07:43:07', '2023-01-07 10:34:52'),
(14, 17, 3, 19, '1673078598.bds.png', 'dfddffffdfdfdfdf', 1, 0, '2023-01-07 08:03:18', '2023-01-07 10:34:52'),
(15, 17, 3, 19, '1673087692.1672163344_1672159478_aps.png', 'daud', 1, 0, '2023-01-07 10:34:52', '2023-01-07 10:34:52');

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
(1, 'Level-1', 1, 16, 2, 1, 1, '2023-01-06 11:06:35', '2023-01-06 11:19:55'),
(2, 'Level-2', 2, 2, 4, 1, 0, '2022-12-19 11:52:05', '2022-12-19 11:52:05'),
(3, 'asdwdadwdasdw', 2, 3, 6, 1, 1, '2022-12-24 08:04:04', '2023-01-06 11:19:25'),
(4, 'sandeep', 1, 16, 2, 1, 1, '2023-01-06 10:59:19', '2023-01-06 11:27:05'),
(5, 'Code Library-1', 1, 16, 3, 1, 1, '2023-01-06 11:00:46', '2023-01-06 11:33:20'),
(6, 'Tt2', 1, 16, 1, 1, 0, '2023-01-06 10:50:45', '2023-01-06 10:50:45'),
(7, 'Test Mbot', 2, 14, 4, 1, 0, '2023-01-03 12:01:03', '2023-01-03 12:01:03'),
(8, 'Raja', 2, 14, 4, 1, 0, '2023-01-04 04:17:19', '2023-01-04 04:17:19'),
(9, 'rrrr', 2, 15, 4, 1, 0, '2023-01-04 04:23:24', '2023-01-04 04:23:24'),
(10, 'Test PDF', 1, 16, 1, 1, 0, '2023-01-06 10:51:11', '2023-01-06 10:51:11'),
(11, 'Add Airblovk', 2, 11, 4, 1, 0, '2023-01-04 10:03:11', '2023-01-04 10:03:11'),
(12, 'introduction to codey rockey', 2, 1, 4, 1, 0, '2023-01-05 00:35:33', '2023-01-05 00:35:33'),
(13, 'sandeep test', 1, 16, 1, 1, 0, '2023-01-05 03:38:09', '2023-01-05 03:38:09'),
(14, 'introduction to airblock', 2, 11, 5, 1, 1, '2023-01-05 03:49:28', '2023-01-06 11:34:18'),
(15, 'Code level', 2, 11, 6, 1, 1, '2023-01-05 03:57:37', '2023-01-06 11:50:04'),
(16, 'Sandeep Level', 2, 11, 6, 1, 0, '2023-01-05 04:01:20', '2023-01-05 04:01:20'),
(17, 'hello', 2, 11, 5, 1, 0, '2023-01-06 01:55:27', '2023-01-06 01:55:27'),
(18, 'sss', 1, 16, 2, 1, 0, '2023-01-06 11:50:55', '2023-01-06 11:50:55'),
(19, 'dddd', 1, 16, 3, 1, 0, '2023-01-06 12:00:51', '2023-01-06 12:00:51');

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
(1, 'Codey Rocky.', '1672850362_codey-rocky.jpg', 2, 2, 1, 0, '2022-12-13 16:34:45', '2023-01-04 16:40:28'),
(2, 'Codey Rocky Neuron Classroom kit (Junior coding lab in a box).', '1672850196_codey-rocky-neuron-classroom-kit.jpg', 2, 2, 1, 0, '2022-12-13 16:34:45', '2023-01-04 16:36:36'),
(3, 'mBot.', '1672850231_mbot.jpg', 2, 2, 1, 0, '2022-12-13 16:34:45', '2023-01-04 16:37:11'),
(4, 'mBot Add-on pack Perception Gizmo.', '1672850242_mbot-add-on-pack-six-legged.jpg', 2, 2, 1, 0, '2022-12-13 16:34:45', '2023-01-04 16:37:22'),
(5, 'mBot Add-on pack Variety Gizmo.', '1672850253_mbot-add-on-pack-servo-pack.jpg', 2, 2, 1, 0, '2022-12-15 16:52:15', '2023-01-04 16:37:33'),
(6, 'mBot Add-on pack Servo.', '1672850263_mbot-add-on-pack-perception-gizmo.jpg', 2, 2, 1, 0, '2022-12-15 16:52:50', '2023-01-04 16:37:43'),
(7, 'mBot Add-on pack Light & Sound.', '1672850276_halocode-standard-kit.jpg', 2, 2, 1, 0, '2022-12-15 16:53:14', '2023-01-04 16:37:56'),
(8, 'mBot Add-on pack Six legged Robot.', '1672850289_mbot-add-on-pack-variety-gizmos.jpg', 2, 2, 1, 0, '2022-12-15 16:54:45', '2023-01-04 16:38:09'),
(9, 'Halo Code standard kit.', '1672850299_cyber-pi-go-kit.jpg', 2, 2, 1, 0, '2022-12-15 16:56:20', '2023-01-04 16:38:19'),
(10, 'Cyber Pi Go Kit (Senior coding lab in a box).', '1672850315_codey-rocky-neuron-classroom-kit.jpg', 2, 2, 1, 1, '2022-12-15 16:58:53', '2023-01-06 17:19:51'),
(11, 'Airblock.', '1672850467_airblock.jpg', 2, 2, 1, 0, '2022-12-15 16:59:33', '2023-01-04 16:41:07'),
(12, 'Codey Rokey', '1672036264_mblock-logo.png', 2, 2, 1, 0, '2022-12-26 06:31:04', '2022-12-26 06:31:04'),
(13, 'Tt', '1672654825_DB1F9C76-DD88-452D-80B7-FD5E99271995.jpeg', 2, 2, 1, 0, '2023-01-02 10:20:25', '2023-01-04 16:59:20'),
(14, 'My Mbot', '1672767101_airblock.jpg', 2, 2, 1, 0, '2023-01-03 17:31:41', '2023-01-03 17:31:41'),
(15, 'TestRaja', '1672825663_1672743291819.jpg', 2, 2, 1, 0, '2023-01-04 09:47:43', '2023-01-04 09:47:43'),
(16, 'Free', '1672825663_1672743291819.jpg', 1, 2, 1, 0, '2023-01-04 09:47:43', '2023-01-04 09:47:43');

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
  `lesson_video` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1=>active 0=>inactive',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=>exist 1=>deleted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course_lessons`
--

INSERT INTO `course_lessons` (`id`, `lesson_number`, `lesson_title`, `lesson_subject`, `level_id`, `cat_id`, `course_id`, `teaching_id`, `lesson_document`, `lesson_iframe_code`, `lesson_video`, `created_by`, `status`, `is_deleted`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Teaching 1', 'Subject', 4, 1, 1, 1, NULL, '<iframe src=\"https://docs.google.com/presentation/d/e/2PACX-1vTT3k_Bafy9pLUqPJk79c9QytRwDLUqJVL974J2KNEDIxxd_cg8o8LwCVbAi4l98qxATLkFQrGMa8K0/embed?start=false&loop=false&delayms=3000\" frameborder=\"0\" width=\"100%\" height=\"100%\" allowfullscreen=\"true\" mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\"></iframe>', NULL, 2, 1, 1, '2022-12-17 12:09:18', '2023-01-06 16:52:04'),
(2, NULL, 'First Video', 'Video Subject First', 18, 2, 16, 1, NULL, 'uytuytu', 'sdfsdfsdfs', 2, 1, 0, '2022-12-18 10:06:40', '2023-01-06 17:36:43'),
(3, NULL, 'Test-1', 'Test-1', 5, 3, 1, 1, '1672163344_1672159478_aps.png', NULL, NULL, 2, 1, 0, '2022-12-27 17:49:04', '2022-12-27 17:49:04'),
(4, NULL, 'test Data', 'test Subject', 7, 4, 14, 2, NULL, '<iframe src=\"https://docs.google.com/presentation/d/e/2PACX-1vTT3k_Bafy9pLUqPJk79c9QytRwDLUqJVL974J2KNEDIxxd_cg8o8LwCVbAi4l98qxATLkFQrGMa8K0/embed?start=false&loop=false&delayms=3000\" frameborder=\"0\" width=\"100%\" height=\"100%\" allowfullscreen=\"true\" mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\"></iframe>', NULL, 2, 1, 0, '2023-01-03 17:32:11', '2023-01-04 15:16:08'),
(5, NULL, 'rr', 'rr', 8, 4, 14, 2, NULL, 'rr', NULL, 2, 1, 0, '2023-01-04 09:48:31', '2023-01-04 09:48:31'),
(6, NULL, 'ffg', 'fghfg', 9, 4, 15, 2, NULL, 'fghfg', NULL, 2, 1, 0, '2023-01-04 09:54:07', '2023-01-04 09:54:07'),
(7, NULL, 'demo pdf', 'demo subject', 10, 1, 13, 1, NULL, '<iframe src=\"https://docs.google.com/presentation/d/e/2PACX-1vQ7GqOVO6gTIMJ_TzYJVohL9KofTpW5QNIspbg3jZ2BkhYkdSwfK8ySC9nWPAVa7UstwCQRk1OPybzU/embed?start=false&loop=false&delayms=3000\" frameborder=\"0\" width=\"960\" height=\"569\" allowfullscreen=\"true\" mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\"></iframe>', NULL, 2, 1, 0, '2023-01-04 15:26:15', '2023-01-04 15:26:15'),
(8, NULL, 'My level', 'my subject', 11, 4, 11, 2, NULL, '<iframe src=\"https://docs.google.com/presentation/d/e/2PACX-1vQ7GqOVO6gTIMJ_TzYJVohL9KofTpW5QNIspbg3jZ2BkhYkdSwfK8ySC9nWPAVa7UstwCQRk1OPybzU/embed?start=false&loop=false&delayms=3000\" frameborder=\"0\" width=\"960\" height=\"569\" allowfullscreen=\"true\" mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\"></iframe>', NULL, 2, 1, 0, '2023-01-04 15:34:19', '2023-01-04 15:34:19'),
(9, NULL, 'yhi hai uppar wala', 'same', 12, 4, 1, 2, NULL, '<iframe src=\"https://docs.google.com/presentation/d/e/2PACX-1vTSyOylPmpIN4QLCUg9AzKk6ASw-Y1jnBOoSVcQqVOFa7RORON1YhReXVPJg7tIV95LoNQgXSmTJZ9W/embed?start=false&loop=false&delayms=3000\" frameborder=\"0\" width=\"960\" height=\"569\" allowfullscreen=\"true\" mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\"></iframe>', NULL, 2, 1, 0, '2023-01-05 06:07:19', '2023-01-05 06:07:19'),
(10, NULL, 'Intro', 'Intro', 13, 1, NULL, 1, NULL, '<iframe src=\"https://docs.google.com/presentation/d/e/2PACX-1vS_zT-kQm89bRZZhRVNSA5aUOPllBEeWlbNe80egde5Hf13KFePiF5f4dtTg3bgeCrocGdXBwlYwL_8/embed?start=false&loop=false&delayms=3000\" frameborder=\"0\" width=\"960\" height=\"569\" allowfullscreen=\"true\" mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\"></iframe>', NULL, 2, 1, 0, '2023-01-05 09:09:27', '2023-01-05 09:09:27'),
(11, NULL, 'intro2', 'intro2', 13, 1, NULL, 1, NULL, '<iframe src=\"https://docs.google.com/presentation/d/e/2PACX-1vS_zT-kQm89bRZZhRVNSA5aUOPllBEeWlbNe80egde5Hf13KFePiF5f4dtTg3bgeCrocGdXBwlYwL_8/embed?start=false&loop=false&delayms=3000\" frameborder=\"0\" width=\"960\" height=\"569\" allowfullscreen=\"true\" mozallowfullscreen=\"true\" webkitallowfullscreen=\"true\"></iframe>', NULL, 2, 1, 0, '2023-01-05 09:12:53', '2023-01-05 09:12:53'),
(12, NULL, 'intro', 'intro', 14, 5, 11, 2, NULL, NULL, 'https://www.youtube.com/watch?v=_pxwtbXRNNY', 2, 1, 0, '2023-01-05 09:20:33', '2023-01-05 09:20:33'),
(13, NULL, 'Intro Lesson', 'Intro Lesson', 15, 6, 11, 2, NULL, NULL, NULL, 2, 1, 0, '2023-01-05 09:28:49', '2023-01-05 09:28:49'),
(14, NULL, 'Sandeep Lesson', 'Sandeep Lesson', 16, 6, 11, 2, NULL, NULL, NULL, 2, 1, 0, '2023-01-05 09:32:29', '2023-01-05 09:32:29'),
(15, NULL, 'asdasdsad', 'asdasdasdas', 17, 5, 11, 2, NULL, NULL, 'asdasdasdasdasdads', 2, 1, 0, '2023-01-06 07:25:45', '2023-01-06 07:25:45'),
(16, NULL, 'dsds', 'sdsdsd', 18, 2, 16, 1, NULL, NULL, '<iframe width=\"100%\" height=\"100%\" src=\"https://www.youtube.com/embed/pmHh_JH1XOE\" title=\"YouTube video player\" frameborder=\"0\" allow=\"accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>', 2, 1, 0, '2023-01-06 17:21:14', '2023-01-06 17:37:14'),
(17, NULL, 'sdsdds', 'sdsdds', 19, 3, 16, 1, NULL, NULL, NULL, 2, 1, 0, '2023-01-06 17:31:24', '2023-01-07 10:34:51');

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
('programmerskills2018@gmail.com', '$2y$10$v84LX94RA75KkYpvpcM84OZw3aOzm1mcBmBLmlK7n/Bdtldl3WJlm', '2023-01-07 10:15:16');

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
  `notification_body` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

--
-- Dumping data for table `tbl_notifications`
--

INSERT INTO `tbl_notifications` (`id`, `notification_type`, `role_id`, `user_id`, `notification_subject`, `notification_body`, `notifiable_type`, `notifiable_id`, `mail_sent_from`, `mail_sent_to`, `mail_subject`, `mail_msg`, `msg_other`, `mail_page_action`, `read_at`, `created_at`, `updated_at`) VALUES
(1, NULL, 0, 0, NULL, '<p>Dear <b>{{$userData->first_name}}</b>,</p>\n                                        <p>Greetings!</p>\n                                        <p>This mail is to inform you that your registration is confirmed on our website bdseducation.in our team will activate your account and assign your purchased courses to your dashboard within 24 hours after that you will receive a mail of course assignation.</p>', NULL, NULL, NULL, 'programmerskills2018@gmail.com', 'New Registeration', NULL, NULL, NULL, NULL, '2023-01-07 03:58:30', '2023-01-07 03:58:30'),
(2, NULL, 0, 0, NULL, '<p>Dear <b>Raja</b>,</p>\n                                        <p>Greetings!</p>\n                                        <p>This mail is to inform you that your registration is confirmed on our website bdseducation.in our team will activate your account and assign your purchased courses to your dashboard within 24 hours after that you will receive a mail of course assignation.</p>', NULL, NULL, NULL, 'programmerskills2018@gmail.com', 'New Registeration', NULL, NULL, NULL, NULL, '2023-01-07 04:00:50', '2023-01-07 04:00:50'),
(3, NULL, 0, 0, NULL, '<p>Dear <b>Raja</b>,</p>\n                                        <p>Greetings!</p>\n                                        <p>This mail is to inform you that your registration is confirmed on our website bdseducation.in our team will activate your account and assign your purchased courses to your dashboard within 24 hours after that you will receive a mail of course assignation.</p>', NULL, NULL, NULL, 'programmerskills2018@gmail.com', 'Welcome to BDS', NULL, NULL, NULL, NULL, '2023-01-07 04:04:27', '2023-01-07 04:04:27'),
(4, NULL, 0, 0, NULL, '<p>Dear <b>Raja</b>,</p>\n                                <p>Greetings!</p>\n                                <p>Your dashboard is activated and your purchased products are assigned to it now you can access your purchased products.</p>\n                                <div>\n                                    <table width=\"100%\">\n                                        <tr>\n                                            <th>Product Name</th>\n                                            <th>Product Duration</th>\n                                        </tr><tr>\n                                            <td>mBot Add-on pack Six legged Robot.</td>\n                                            <td>+365 Days</td>\n                                        </tr><tr>\n                                            <td>My Mbot</td>\n                                            <td>+365 Days</td>\n                                        </tr></table></div>', NULL, NULL, NULL, 'programmerskills2018@gmail.com', 'Activate Account & Assigned Course Notification', NULL, NULL, NULL, NULL, '2023-01-07 05:26:57', '2023-01-07 05:26:57'),
(5, NULL, 0, 0, NULL, '<p>Dear <b>Raja</b>,</p>\n                                <p>Greetings!</p>\n                                <p>Your dashboard is activated and your purchased products are assigned to it now you can access your purchased products.</p>\n                                <div>\n                                    <table width=\"100%\">\n                                        <tr>\n                                            <th>Product Name</th>\n                                            <th>Product Duration</th>\n                                        </tr><tr>\n                                            <td>mBot Add-on pack Light & Sound.</td>\n                                            <td>+365 Days</td>\n                                        </tr><tr>\n                                            <td>Airblock.</td>\n                                            <td>+365 Days</td>\n                                        </tr></table></div>', NULL, NULL, NULL, 'programmerskills2018@gmail.com', 'Activate Account & Assigned Course Notification', NULL, NULL, NULL, NULL, '2023-01-07 05:30:09', '2023-01-07 05:30:09'),
(6, NULL, 0, 0, NULL, '<p>Hello <b>Admin</b>,</p>\n            <p>Someone from bdseducation.in asked a question about this PDF Library   > Test PDF  > demo pdf</p>\n            <p><b>Q.</b> test Form</p>', NULL, NULL, NULL, 'rajakumarbhagat06@gmail.com', 'New Query', NULL, NULL, NULL, NULL, '2023-01-07 07:59:14', '2023-01-07 07:59:14'),
(7, NULL, 0, 0, NULL, '<p>Hello <b>Admin</b>,</p>\n            <p>Someone from bdseducation.in asked a question about this PDF Library   > Test PDF  > demo pdf</p>\n            <p><b>Q.</b> test Form</p>', NULL, NULL, NULL, 'rajakumarbhagat06@gmail.com', 'New Query', NULL, NULL, NULL, NULL, '2023-01-07 07:59:14', '2023-01-07 07:59:14');

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
(1, 'rrr', 'raja@gmail.com', 'rrr', 1234567890, 'raja@gmail.com', 0, NULL, 0, 1, '2023-01-06 07:07:55', 2, 0, NULL, '$2y$10$aflcMfdGwBiLB95qO4DH0uu9tkBAr9/gXRwP86U58QK7Ye6k8KxdW', NULL, '2022-12-11 04:51:33', '2023-01-06 01:37:55'),
(2, 'Admin', 'admin@gmail.com', 'Kumar', 1234567890, 'admin@gmail.com', 1, NULL, 1, 1, '2022-12-12 17:46:44', 2, 0, NULL, '$2y$10$1RckIdBTUn9yc8HjpXvamuAlchhjAmsXWMOLGjfDdhdwp3poFglbu', NULL, '2022-12-11 05:45:21', '2022-12-12 12:16:44'),
(3, 'tryt', 'rajatest2@gmail.com', 'ytuy', 1234567890, 'rajatest2@gmail.com', 2, NULL, 0, 0, NULL, NULL, 0, NULL, '$2y$10$ZgsmvnGvXL3/XhUqkdrFO.k7pwfkBE214LTUp.PDZHdc2gd30NYs.', NULL, '2022-12-11 07:58:37', '2022-12-11 07:58:37'),
(4, 'daud', 'daudtaiyab@gmail.com', 'taiyab', 9988774455, 'daudtaiyab', 2, NULL, 0, 0, NULL, NULL, 0, NULL, '$2y$10$qW12coN0wKa7y7jpjPaMg./GpnjyDRaHUS178hsyCTSiPiHIhD4vK', NULL, '2022-12-20 01:17:30', '2022-12-20 01:17:30'),
(5, 'Front User', 'user@gmail.com', 'User', 1234567890, 'user@gmail.com', 2, NULL, 1, 1, '2022-12-26 17:42:34', 2, 0, NULL, '$2y$10$sq/bHCL1vw9LqofDPNFjTuNA2eUbOWFgcsAH91wZQrgr75kdcA2dK', NULL, '2022-12-26 12:12:10', '2022-12-26 12:12:34'),
(9, 'Raja', 'programmerskills2018@gmail.com', 'Kumar', 1234567890, 'programmerskills2018@gmail.com', 2, NULL, 1, 1, NULL, NULL, 0, NULL, '$2y$10$2VNqAqEOXfholcBDwNGt7e2TkskfbZooE/ZZSUeIDm0y2Qb3J8CfG', NULL, '2023-01-07 04:04:19', '2023-01-07 05:30:09');

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
  ADD KEY `password_resets_email_index` (`email`(191));

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `code_library_lessons`
--
ALTER TABLE `code_library_lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `coursecategories`
--
ALTER TABLE `coursecategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `courselibraries`
--
ALTER TABLE `courselibraries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `course_lessons`
--
ALTER TABLE `course_lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_notifications`
--
ALTER TABLE `tbl_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `teachingoptions`
--
ALTER TABLE `teachingoptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
