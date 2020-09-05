-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 05, 2020 at 07:04 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `finder`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `acted_on` int(10) UNSIGNED NOT NULL,
  `acted_by` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `name`, `acted_on`, `acted_by`, `created_at`, `updated_at`) VALUES
(7, 'like', 2, 1, '2020-09-05 02:11:42', '2020-09-05 02:11:42'),
(8, 'dislike', 2, 1, '2020-09-05 02:11:45', '2020-09-05 02:11:45'),
(9, 'like', 4, 1, '2020-09-05 02:16:10', '2020-09-05 02:16:10'),
(10, 'dislike', 4, 1, '2020-09-05 02:18:14', '2020-09-05 02:18:14'),
(11, 'like', 5, 1, '2020-09-05 02:18:17', '2020-09-05 02:18:17'),
(26, 'like', 1, 5, '2020-09-05 04:59:59', '2020-09-05 04:59:59'),
(27, 'like', 2, 5, '2020-09-05 05:00:11', '2020-09-05 05:00:11'),
(28, 'like', 1, 4, '2020-09-05 08:47:35', '2020-09-05 08:47:35');

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
(3, '2014_10_12_000000_create_users_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(7, '2020_09_04_124351_drop_location_from_users', 2),
(10, '2020_09_04_124725_add_latitude_and_longitude_to_users', 3),
(11, '2020_09_05_062720_create_activities_table', 4);

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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `profile_image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `latitude`, `longitude`, `profile_image`, `gender`, `dob`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'sunzid02', 'sunzid02@gmail.com', '$2y$10$HZL.YbkEaalHS88rQqq8sOdesp3UyuLMxthCjPUFYduG6q59OvuFO', 23.7298, 90.3854, 'php7jxp4h.jpg', 'male', '1996-09-05', '85cc1EnkRg9Bwj9Sbie2br8xbqQo6xtxz2SrmLoCPaWPuWuodhAcUvspUBRf', '2020-09-04 07:10:22', '2020-09-05 09:11:47'),
(2, 'user2', 'uklocko.lora@example.net', '$2y$10$Xco265FkJvonrojo2GzETuPo6DFcRCXy31ub02BDrjpsCRFyM7Q8W', 23.746466, 90.376015, 'phpZWOKUO.jpg', 'male', '1994-09-05', 'dbAAQ2BfWeDJ1jeSF5giHVPNqec5eeUbqOZGorhPH8idXX2CsSThIlH0unfO', '2020-09-04 07:21:59', '2020-09-04 07:21:59'),
(3, 'user3', 'user3@example.net', '$2y$10$EWq4bjbq/6H9mAXMzKcsjuzkvLvnpPDE/akXPlFNEY4rkssNy1lwy', 37.056519, -94.537453, 'phpCbnqUV.jpg', 'male', '1995-09-03', 'pHL6NgqiW4qtsrLMKYsniAJrjP9yqNLkD63BcPjHipmcuNXnRsayMQ7gMNjG', '2020-09-04 07:29:45', '2020-09-04 07:29:45'),
(4, 'dhanmondi', 'dhanmondi@example.net', '$2y$10$627E1r4eQZKd5IHP1tLdDe2PdkMKgx1eVnAkPApDfdNhBL//8yJci', 23.746466, 90.376015, 'phpsg5UHw.jpg', 'male', '2000-09-04', 'AXxn3Fl2VCwe8quw1s3u1vPZYLAMxARz6nATCmKeYU5zTS0nBqmCqL1WafwE', '2020-09-04 07:34:18', '2020-09-04 07:34:18'),
(5, 'lalbag', 'lalbag@example.net', '$2y$10$dEtMM/ub3vczqg0T8sLHhOe8ojmQS1sitMV3rEF9Nj7NehaPRnLDC', 23.718176, 90.386604, 'phpYtpQnf.jpg', 'male', '2001-09-01', 'elXS4fygrb76beu3vaaQSSKQqU1D42p0YSc5bNpZodIjZ3f0ockKYGVg6Idy', '2020-09-04 07:35:52', '2020-09-04 07:35:52'),
(6, 'gulshan', 'gulshan@example.net', '$2y$10$yo3XH4AOnUBgapxl0CeYXO06zqLVmVOZjGP25zOgDDn6I7nrjlh06', 37.056519, -94.537453, 'phpJ6j8qd.jpg', 'male', '2001-09-03', 'Q0sUTWr8f7vqXVTHelOEdIUucQY4g0l8embvcBPaC8C2dR9IuT7hg2mgRx4h', '2020-09-04 07:41:59', '2020-09-04 07:41:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activities_acted_on_foreign` (`acted_on`),
  ADD KEY `activities_acted_by_foreign` (`acted_by`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `activities_acted_by_foreign` FOREIGN KEY (`acted_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `activities_acted_on_foreign` FOREIGN KEY (`acted_on`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
