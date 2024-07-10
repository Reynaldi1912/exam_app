-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 10, 2024 at 12:10 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exam_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `answer_question`
--

CREATE TABLE `answer_question` (
  `id` int UNSIGNED NOT NULL,
  `question_id` int DEFAULT NULL,
  `question_type` int DEFAULT NULL,
  `answer` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `is_true` int DEFAULT NULL,
  `parent_answer_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `answer_question`
--

INSERT INTO `answer_question` (`id`, `question_id`, `question_type`, `answer`, `file`, `is_true`, `parent_answer_id`, `created_at`, `updated_at`) VALUES
(5, 12, 1, 'BENAR', NULL, 1, NULL, NULL, '2024-07-07 14:31:38'),
(6, 12, 1, 'SALAH', NULL, 0, NULL, NULL, '2024-07-07 14:31:42'),
(7, 13, 3, 'Raffi', NULL, 1, NULL, NULL, NULL),
(8, 13, 3, 'Nagita', NULL, 1, 7, NULL, '2024-07-03 13:53:22'),
(9, 13, 3, 'Reynaldi', NULL, 1, NULL, NULL, NULL),
(10, 13, 3, 'Ericha', NULL, 1, 9, NULL, '2024-07-03 13:53:26'),
(11, 14, 2, 'Harimau', NULL, 1, NULL, NULL, NULL),
(12, 14, 2, 'Udang', NULL, 1, NULL, NULL, NULL),
(13, 14, 2, 'Meja', NULL, 0, NULL, NULL, NULL),
(14, 15, 1, 'Benar', NULL, 1, NULL, NULL, NULL),
(15, 15, 1, 'Salah', NULL, 0, NULL, NULL, NULL),
(16, 16, 1, 'Benar', NULL, 1, NULL, NULL, NULL),
(17, 16, 1, 'Salah', NULL, 0, NULL, NULL, NULL),
(18, 18, 1, 'Reynaldi', NULL, 1, NULL, NULL, NULL),
(19, 18, 1, 'Reynaldo', NULL, 0, NULL, NULL, NULL),
(20, 18, 1, 'Ronaldo', NULL, 0, NULL, NULL, NULL),
(21, 18, 1, 'Messi', NULL, 0, NULL, NULL, NULL),
(22, 18, 1, 'Reynaldus', NULL, 0, NULL, NULL, NULL),
(23, 18, 1, 'Aldous', NULL, 0, NULL, NULL, NULL),
(24, 19, 2, 'Ojin', NULL, 1, NULL, NULL, NULL),
(25, 19, 2, 'Nizar', NULL, 1, NULL, NULL, NULL),
(26, 19, 2, 'Eba', NULL, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_exam`
--

CREATE TABLE `app_exam` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail_app` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `max_exam` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_exam`
--

INSERT INTO `app_exam` (`id`, `name`, `detail_app`, `user_id`, `max_exam`, `created_at`, `updated_at`) VALUES
(2, 'Exam App 2', 'Detail Exam App 2', 1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `detail_questions`
--

CREATE TABLE `detail_questions` (
  `id` bigint UNSIGNED NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_key` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `exams`
--

CREATE TABLE `exams` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `app_exam_id` int NOT NULL,
  `duration` int NOT NULL,
  `start_at` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exams`
--

INSERT INTO `exams` (`id`, `name`, `description`, `app_exam_id`, `duration`, `start_at`, `created_at`, `updated_at`) VALUES
(4, 'Sesi Try Out 1', 'ini adalah sesi try put 1', 2, 120, '2024-06-11 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_users`
--

CREATE TABLE `exam_users` (
  `id` bigint UNSIGNED NOT NULL,
  `exam_id` int NOT NULL,
  `user_id` int NOT NULL,
  `start_at` datetime DEFAULT NULL,
  `finish_at` datetime DEFAULT NULL,
  `status` smallint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `exam_users`
--

INSERT INTO `exam_users` (`id`, `exam_id`, `user_id`, `start_at`, `finish_at`, `status`, `created_at`, `updated_at`) VALUES
(3, 4, 4, NULL, NULL, 1, '2024-06-22 07:58:31', '2024-06-29 08:16:45'),
(4, 4, 5, NULL, NULL, 0, '2024-06-29 08:04:59', '2024-07-07 07:05:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_06_06_030823_create_app_exam', 1),
(5, '2024_06_06_030852_create_questions', 1),
(6, '2024_06_06_030900_create_detail_questions', 1),
(7, '2024_06_06_031016_create_user_answers', 1),
(8, '2024_06_06_031031_create_exams', 1),
(9, '2024_06_06_042139_create_exam_users', 1),
(10, '2024_06_06_042611_create_question_type', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_type_id` int NOT NULL,
  `exam_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `question_type_id`, `exam_id`, `created_at`, `updated_at`) VALUES
(12, '<p>Tuliskan Pertanyaan Anda</p>', 1, 4, NULL, NULL),
(13, '<p>Jodohkan Pasangan Berikut</p>', 3, 4, NULL, NULL),
(14, '<p>Manakah Hewan ?</p>', 2, 4, NULL, NULL),
(15, '<p>Apakah Buaya Amphibi ?</p>', 1, 4, NULL, NULL),
(16, '<p>Mobil Beroda 4 ?</p>', 1, 4, NULL, NULL),
(17, '<p>Jelaskan Apa Itu Laptop ?</p>', 4, 4, NULL, NULL),
(18, '<p>Siapa Nama Pacar Ericha Yang Benar Dibawah Ini ?</p>', 1, 4, NULL, NULL),
(19, '<p>Siapa yg merupakan mantan ericha yg benar ?</p>', 2, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_type`
--

CREATE TABLE `question_type` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_id` int NOT NULL,
  `correct_answer_value` int NOT NULL DEFAULT '0',
  `wrong_answer_value` int NOT NULL DEFAULT '0',
  `empty_answer_value` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2Ah5J2c03vpDdTlxwXyXY1QxF1R1ClYYzYHE0QN8', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiZmplSlZCeWhRcTNtUVZ6YmRkZnY3RU5DQ0RpaTNtb0d5OWxKb1h0RSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM5OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvY3JlYXRlLXF1ZXN0aW9uLzQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjMyOiJjYjM5NDY2ZTZjYjI3ZWJhODAwNmQ4ZWYwNWMyYWZhNiI7fQ==', 1720544409),
('EOQTkafMUSJCEKv1WdB3HgiuaRZQYKsvHag3iD1J', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTUhYY3RUVklIREI5dnpDYlFTZjQwUG5yYVU5ajJZSHlBOFo5OUZFVCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvcnVubmluZy1leGFtLzYiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo0O3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjMyOiJhZTBiMmIyZDljOGM0NjYyZDQyMDQyZGQzYWUzNzZiMiI7fQ==', 1720544864);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exam_app` int DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `role`, `exam_app`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@exam.com', 'admin', NULL, NULL, 'cb39466e6cb27eba8006d8ef05c2afa6', NULL, NULL, NULL),
(4, 'siswa1', 'siswa1@exam.com', 'user', 2, NULL, 'ae0b2b2d9c8c4662d42042dd3ae376b2', NULL, NULL, NULL),
(5, 'siswa2', 'siswa2@exam.com', 'user', 2, NULL, 'ae0b2b2d9c8c4662d42042dd3ae376b2', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL,
  `user_answer_id` int NOT NULL,
  `is_key_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `user_id`, `user_answer_id`, `is_key_status`, `created_at`, `updated_at`) VALUES
(1, 4, 5, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer_question`
--
ALTER TABLE `answer_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_exam`
--
ALTER TABLE `app_exam`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `detail_questions`
--
ALTER TABLE `detail_questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_questions_is_key_index` (`is_key`);

--
-- Indexes for table `exams`
--
ALTER TABLE `exams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exam_users`
--
ALTER TABLE `exam_users`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_question_type_id_exam_id_index` (`question_type_id`,`exam_id`);

--
-- Indexes for table `question_type`
--
ALTER TABLE `question_type`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_username_index` (`username`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_user_id_user_answer_id_index` (`user_id`,`user_answer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answer_question`
--
ALTER TABLE `answer_question`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `app_exam`
--
ALTER TABLE `app_exam`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `detail_questions`
--
ALTER TABLE `detail_questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exams`
--
ALTER TABLE `exams`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exam_users`
--
ALTER TABLE `exam_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `question_type`
--
ALTER TABLE `question_type`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
