-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 02:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `data_dep`
--

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
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `folder_id` bigint(20) UNSIGNED NOT NULL,
  `hash` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `name`, `path`, `user_id`, `folder_id`, `hash`, `created_at`, `updated_at`, `size`) VALUES
(1, 'New file', 'files/6ACgKnexhKXjs0F6KyBUdtxlSj6MSjoMQ1cr3Xw5.pdf', 1, 5, 'a552f50495febf734fb35a5e8f58e5b6', '2023-02-12 10:38:50', '2023-02-12 10:38:50', '71.328125'),
(2, 'same file', 'files/6ACgKnexhKXjs0F6KyBUdtxlSj6MSjoMQ1cr3Xw5.pdf', 5, 8, 'a552f50495febf734fb35a5e8f58e5b6', '2023-02-12 10:40:26', '2023-02-12 10:40:26', '71.328125'),
(3, 'diff file', 'files/4aRJ3ummfFh9Hvt92NkIWaf6lXrxfihfGY5U3Iy8.doc', 5, 8, 'd410d70ad4c3bfdbeb0b8e00c64f0039', '2023-02-12 10:41:42', '2023-02-12 10:41:42', '62'),
(4, 'Testing sha', 'files/ydTrupbMNAedsn9Tc60Y4bF9N1VuFkdJjdHx3DqP.pptx', 5, 8, 'a82226afe626ff160c5fd79d6590ae948f606a5c', '2023-02-12 10:58:26', '2023-02-12 10:58:26', '823.1806640625');

-- --------------------------------------------------------

--
-- Table structure for table `file_reports`
--

CREATE TABLE `file_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `hash` text DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `file_reports`
--

INSERT INTO `file_reports` (`id`, `name`, `user_id`, `hash`, `size`, `created_at`, `updated_at`) VALUES
(1, 'Duplicate file6808', 1, 'a552f50495febf734fb35a5e8f58e5b6', '71.328125', '2023-02-12 10:39:15', '2023-02-12 10:39:15'),
(2, 'Duplicate file4744', 5, 'a552f50495febf734fb35a5e8f58e5b6', '71.328125', '2023-02-12 10:40:26', '2023-02-12 10:40:26');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `hash` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `name`, `path`, `user_id`, `parent_id`, `hash`, `created_at`, `updated_at`) VALUES
(2, 'Test', 'BlessingMwale/2023-02-0713:18:39', 1, NULL, '7f9dafac23aaeb43c36e0faa07b0a779', '2023-02-07 11:18:39', '2023-02-07 11:18:39'),
(3, 'yep', 'BlessingMwale/2023-02-0713:20:11', 1, NULL, 'f616b8153bf0487135f31930960a8f11', '2023-02-07 11:20:11', '2023-02-07 11:20:11'),
(4, 'My Photos', 'BlessingMwale/2023-02-0813:16:43', 1, NULL, '0193d853f733d1ab885dc7c18ab88554', '2023-02-08 11:16:43', '2023-02-08 11:16:43'),
(5, 'My Documents', 'BlessingMwale/2023-02-0813:16:58', 1, NULL, '928a35bca5d461118b26915218818a17', '2023-02-08 11:16:58', '2023-02-08 11:16:58'),
(6, 'School work', 'BlessingMwale/2023-02-0813:17:07', 1, NULL, 'f7e6fa15c65ecf5c04ed4838c1c32604', '2023-02-08 11:17:07', '2023-02-08 11:17:07'),
(7, 'Work Staff', 'BlessingMwale/2023-02-0813:17:15', 1, NULL, 'ca82011bed1502321ccfce961b8f0670', '2023-02-08 11:17:15', '2023-02-08 11:17:15'),
(8, 'First Folder', 'DenzelMwale/2023-02-1208:58:41', 5, NULL, '102f8b170d1b60aa74553d491d32cbb8', '2023-02-12 06:58:41', '2023-02-12 06:58:41'),
(9, 'Test with user', 'BlessingMwale/2023-02-1212:15:25', 1, NULL, '735b353b90c5412d1497e1a7663f4b0e', '2023-02-12 10:15:25', '2023-02-12 10:15:25');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2023_02_07_084509_create_sessions_table', 1),
(7, '2023_02_07_094734_add_role_to_users_table', 2),
(8, '2023_02_07_114519_create_folders_table', 3),
(11, '2023_02_08_121829_add_status_to_users_table', 5),
(13, '2023_02_07_114709_create_files_table', 6),
(14, '2023_02_07_124421_add_size_to_files_table', 6),
(15, '2023_02_11_083041_create_file_reports_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
('FaP7CjmYmNAmdaGEoyI7Ov9uvmqDQ5RtuK1dyPLV', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRzdTYVlzUHBTMWJxN05aWjU1cWxrT25NSmlwTW5iclBxRVdDZjYyRSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozMzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2ZpbGVzIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1676231862),
('pVmTSbl28rmWRUBpJh2Gm2KUaEBTKkjD7WOhneiv', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiVmtiQnBUSE04QnE0N3dOSmFYd041a3pjZDdUdEpMcExIMERlTXZjeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MjtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCQ4bGRuanpuWGJTMElKS1RjR2p4eUF1bmptaFA0LzlCN041b3IvRHpoNDllUXowdEdzbHBaaSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9maWxlcyI7fX0=', 1676206208),
('wdCAc6t9EGz4nufYYH0FTanatfqR4pfMwDAxi7hd', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 Edg/110.0.1587.41', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidGN2R2I4TlhzNXNvS3hBbFgwaEJvV3I3OEVPVlV6YTRZVUt6dmhFWSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRYdVdGbG94bUpvVWFDVnVGYmJxRU91d2YyQTlGcVQwUTB4Q2JSQWtIR3NyZDlkU3JmbjRGeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2ZpbGVzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1676231945),
('X89pqmB57YJNMAx6oBxuixEIN8e04HPXCH1STwI9', 5, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/110.0.0.0 Safari/537.36 Edg/110.0.1587.41', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiRG82Qzd5REpOSUdxbXlRNU8xdkw0UHlqVTZ4VVdvdkJvTnMydTNkNCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NTtzOjIxOiJwYXNzd29yZF9oYXNoX3NhbmN0dW0iO3M6NjA6IiQyeSQxMCRYdVdGbG94bUpvVWFDVnVGYmJxRU91d2YyQTlGcVQwUTB4Q2JSQWtIR3NyZDlkU3JmbjRGeSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2ZpbGVzIjt9fQ==', 1676206706);

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
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `role`, `status`) VALUES
(1, 'Blessing Mwale', 'blessing@gmail.com', NULL, '$2y$10$TWRB72Vspd./1mS8dqulJ.bAaR4FdsFxBE0ehn2qgkN1788MV5vva', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-07 07:33:05', '2023-02-08 10:49:19', 'user', 'active'),
(2, 'Admin User', 'admin@gmail.com', NULL, '$2y$10$8ldnjznXbS0IJKTcGjxyAunjmhP4/9B7N5or/Dzh49eQz0tGslpZi', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-07 08:17:45', '2023-02-07 08:17:45', 'admin', 'active'),
(3, 'Tatenda Mwale', 'tatenda@gmail.com', NULL, '$2y$10$muGNcBMhcFV.rf37oM5uQeurPdV1k.Klefejo01.kTj8fm9nBkaxi', NULL, NULL, NULL, NULL, NULL, NULL, '2023-02-08 10:41:25', '2023-02-12 10:13:06', 'user', 'active'),
(5, 'Denzel Mwale', 'denzel@gmail.com', NULL, '$2y$10$XuWFloxmJoUaCVuFbbqEOuwf2A9FqT0Q0xCbRAkHGsrd9dSrfn4Fy', NULL, NULL, NULL, 'K0qaMOl98WxVs84G6LejjwH2TqEMwDswYN6soO3jsNNMKSNWEe6FA93MUlbb', NULL, NULL, '2023-02-12 06:55:30', '2023-02-12 06:55:30', 'user', 'active');

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
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `files_user_id_foreign` (`user_id`),
  ADD KEY `files_folder_id_foreign` (`folder_id`);

--
-- Indexes for table `file_reports`
--
ALTER TABLE `file_reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file_reports_user_id_foreign` (`user_id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folders_user_id_foreign` (`user_id`),
  ADD KEY `folders_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `file_reports`
--
ALTER TABLE `file_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_folder_id_foreign` FOREIGN KEY (`folder_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `files_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `file_reports`
--
ALTER TABLE `file_reports`
  ADD CONSTRAINT `file_reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `folders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `folders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
