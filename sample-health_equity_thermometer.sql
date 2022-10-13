-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 13, 2022 at 10:59 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `health_equity_thermometer`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_10_07_134621_create_questions_table', 2),
(6, '2022_10_07_142537_create_question_options_table', 2),
(7, '2022_10_07_161227_create_results_table', 2),
(8, '2022_10_10_191506_create_verification_codes_table', 2);

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `text` varchar(256) NOT NULL,
  `image_url` varchar(256) NOT NULL,
  `information` varchar(20000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `image_url`, `information`) VALUES
(1, 'Colour of the sky?', 'https://cdn.hswstatic.com/gif/why-is-sky-blue.jpg', 'Maybe blue?'),
(2, 'Is water wet?', 'https://cdn.hswstatic.com/gif/water-update.jpg', 'Yes!'),
(3, 'Is Sun hot?', 'https://i.natgeofe.com/n/2f169ccb-e943-4772-8bd1-c92e79db64ab/gsfc_20171208_archive_e000922_orig_square.jpg', 'Not sure?');

-- --------------------------------------------------------

--
-- Table structure for table `question_options`
--

CREATE TABLE `question_options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `text` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `question_options`
--

INSERT INTO `question_options` (`id`, `question_id`, `text`) VALUES
(1, 1, 'Yellow'),
(2, 1, 'Red'),
(3, 1, 'Blue'),
(4, 2, 'Yes'),
(5, 2, 'No'),
(6, 3, 'Yes'),
(7, 3, 'No');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selected_options` json NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `user_id`, `selected_options`) VALUES
(1, 3, '{\"aaa\": \"aaa\"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin Admin', 'admin@black.com', '2022-10-11 14:16:42', '$2y$10$F2lCooxDRW8bYm6KUVoSA.Njqfvjht05gQ04eD4RjDPpEEsPC10re', NULL, '2022-10-11 14:16:42', '2022-10-11 14:16:42'),
(2, NULL, 'admin@igoo.co.uk', NULL, NULL, NULL, '2022-10-11 14:23:20', '2022-10-11 14:23:20'),
(3, NULL, 'yasin@igoo.co.uk', NULL, NULL, NULL, '2022-10-12 10:07:22', '2022-10-12 10:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `verification_codes`
--

CREATE TABLE `verification_codes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `code` varchar(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `verification_codes`
--

INSERT INTO `verification_codes` (`id`, `user_id`, `code`, `updated_at`, `created_at`) VALUES
(1, 3, 'vL826', '2022-10-12 10:27:29', '2022-10-12 10:27:29'),
(2, 3, 'KDenq', '2022-10-12 10:33:04', '2022-10-12 10:33:04'),
(3, 3, 'MafwH', '2022-10-12 10:33:56', '2022-10-12 10:33:56'),
(4, 3, 'vZOBt', '2022-10-12 10:34:57', '2022-10-12 10:34:57'),
(5, 3, 'dk21q', '2022-10-12 10:42:23', '2022-10-12 10:42:23'),
(6, 3, 'TKYSp', '2022-10-12 10:43:09', '2022-10-12 10:43:09'),
(7, 3, 'lwJMb', '2022-10-12 10:45:48', '2022-10-12 10:45:48'),
(8, 3, 'fxEi4', '2022-10-12 10:46:18', '2022-10-12 10:46:18'),
(9, 3, 'VDUst', '2022-10-12 10:51:49', '2022-10-12 10:51:49'),
(10, 3, '11dZA', '2022-10-12 10:52:46', '2022-10-12 10:52:46'),
(11, 3, 'nw8c8', '2022-10-12 10:54:43', '2022-10-12 10:54:43'),
(12, 3, 'ukyTu', '2022-10-12 10:57:08', '2022-10-12 10:57:08'),
(13, 3, 'Jglnz', '2022-10-12 11:05:08', '2022-10-12 11:05:08'),
(14, 3, 'sWexB', '2022-10-12 11:08:27', '2022-10-12 11:08:27'),
(15, 3, 'UOYdZ', '2022-10-12 11:08:58', '2022-10-12 11:08:58'),
(16, 3, '6Yk1i', '2022-10-12 11:09:42', '2022-10-12 11:09:42'),
(17, 3, 'XBs5r', '2022-10-12 11:10:44', '2022-10-12 11:10:44'),
(18, 3, 'BzoaN', '2022-10-12 11:11:11', '2022-10-12 11:11:11'),
(19, 3, 'EFgvA', '2022-10-12 11:14:58', '2022-10-12 11:14:58'),
(20, 3, 'uxywx', '2022-10-12 11:16:25', '2022-10-12 11:16:25'),
(21, 3, 'upPEu', '2022-10-12 11:17:48', '2022-10-12 11:17:48'),
(22, 3, 'zJ5CB', '2022-10-12 13:39:02', '2022-10-12 13:39:02'),
(23, 3, 'XihXD', '2022-10-12 13:40:21', '2022-10-12 13:40:21'),
(24, 3, 'OenRh', '2022-10-12 13:41:13', '2022-10-12 13:41:13'),
(25, 3, 'heZQv', '2022-10-12 13:42:28', '2022-10-12 13:42:28'),
(26, 3, 'JrKml', '2022-10-12 13:43:15', '2022-10-12 13:43:15'),
(27, 3, 'K1eDQ', '2022-10-12 13:45:49', '2022-10-12 13:45:49'),
(28, 3, 'Ls8PQ', '2022-10-12 13:47:06', '2022-10-12 13:47:06'),
(29, 3, 'c2TMF', '2022-10-12 13:47:47', '2022-10-12 13:47:47'),
(30, 3, 'VtP2h', '2022-10-12 13:48:07', '2022-10-12 13:48:07'),
(31, 3, 'v9m2c', '2022-10-12 13:48:17', '2022-10-12 13:48:17'),
(32, 3, '0844Y', '2022-10-12 13:48:57', '2022-10-12 13:48:57'),
(33, 3, '5a2rr', '2022-10-12 13:52:54', '2022-10-12 13:52:54'),
(34, 3, 'i1Ewa', '2022-10-12 13:53:52', '2022-10-12 13:53:52'),
(35, 3, 'Kr3JB', '2022-10-12 13:54:09', '2022-10-12 13:54:09'),
(36, 3, 'hjhlY', '2022-10-12 13:56:07', '2022-10-12 13:56:07'),
(37, 3, 'xY0aa', '2022-10-12 13:56:37', '2022-10-12 13:56:37'),
(38, 3, '6Nj4L', '2022-10-12 13:59:12', '2022-10-12 13:59:12'),
(39, 3, '5MuYF', '2022-10-12 13:59:36', '2022-10-12 13:59:36'),
(40, 3, 'uNKsC', '2022-10-12 14:00:22', '2022-10-12 14:00:22'),
(41, 3, 'mNdZe', '2022-10-12 14:02:22', '2022-10-12 14:02:22'),
(42, 3, 'rAWij', '2022-10-12 14:02:46', '2022-10-12 14:02:46'),
(43, 3, 'FZWsL', '2022-10-13 08:08:29', '2022-10-13 08:08:29'),
(44, 3, 'rZZsK', '2022-10-13 08:08:39', '2022-10-13 08:08:39'),
(45, 3, 'w2pKz', '2022-10-13 08:59:17', '2022-10-13 08:59:17'),
(46, 3, 'Yq6Dp', '2022-10-13 09:14:07', '2022-10-13 09:14:07'),
(47, 3, '0p5kF', '2022-10-13 09:15:06', '2022-10-13 09:15:06'),
(48, 3, 'BWb8o', '2022-10-13 09:16:01', '2022-10-13 09:16:01'),
(49, 3, '4jKOx', '2022-10-13 09:17:20', '2022-10-13 09:17:20'),
(50, 3, 'JcWRe', '2022-10-13 09:22:56', '2022-10-13 09:22:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question_options`
--
ALTER TABLE `question_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verification_codes`
--
ALTER TABLE `verification_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `question_options`
--
ALTER TABLE `question_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `verification_codes`
--
ALTER TABLE `verification_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
