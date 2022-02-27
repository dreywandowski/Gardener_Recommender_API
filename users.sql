-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 27, 2022 at 08:24 PM
-- Server version: 8.0.28-0ubuntu0.20.04.3
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eden_api`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_customer` tinyint(1) NOT NULL,
  `assigned_gardener` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assigned_customer` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `location`, `country`, `is_customer`, `assigned_gardener`, `assigned_customer`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Gardener_1', 'dickinson.jayne@example.org', 'Lagos', 'Nigeria', 0, '', NULL, '2022-02-27 19:11:34', '$2y$10$QAPfqhZbeccLCaI5.qpC/.1KnqqDyVcFtKR63L9gi28L4k1K4xm/y', 'AINDRZiF9M', '2022-02-27 19:11:35', '2022-02-27 19:11:35'),
(2, 'Gardener_1', 'watson.kuphal@example.com', 'Lagos', 'Nigeria', 0, '', NULL, '2022-02-27 19:11:34', '$2y$10$viWtrIlFIJTQqCcraMlzN.LfgBNT4UJTnBG52TDghOfEUKD1gJbHO', 'YTanF0AQRP', '2022-02-27 19:11:35', '2022-02-27 19:11:35'),
(3, 'Gardener_1', 'doyle.maeve@example.org', 'Lagos', 'Nigeria', 0, '', NULL, '2022-02-27 19:11:34', '$2y$10$h1qpLXYiIZJLVvpD5XAfkODbQxchSoCtw5.hZ.vSPZhI6g50vMypi', '5cVqMMTGXQ', '2022-02-27 19:11:35', '2022-02-27 19:11:35'),
(4, 'Gardener_1', 'efarrell@example.org', 'Lagos', 'Nigeria', 0, '', NULL, '2022-02-27 19:11:34', '$2y$10$F4n.g9Z3Oe/dGoNuYkI.Y...A36UUnLIzR1s7rI2rwHMZZI9b.cm.', 'xeN6CQ4zZT', '2022-02-27 19:11:35', '2022-02-27 19:11:35'),
(5, 'Gardener_1', 'imani57@example.org', 'Lagos', 'Nigeria', 0, '', NULL, '2022-02-27 19:11:34', '$2y$10$0O1Eu5xdPWo2G57GjP9zIuh8twYPX2ZcI.58Gm/gTy.dfL1scguZK', 'cTNWMa98c0', '2022-02-27 19:11:35', '2022-02-27 19:11:35'),
(6, 'Gardener_1', 'guillermo.hermann@example.org', 'Lagos', 'Nigeria', 0, '', NULL, '2022-02-27 19:11:35', '$2y$10$JqQUimO2gYWtDn8.dE0qfuYxBnIeu2cnSTcXbpzhcPeTDa3QErqo6', 'exbrnfkfSR', '2022-02-27 19:11:35', '2022-02-27 19:11:35'),
(9, 'EmmAdura', 'teste6@test.com', 'Nairobi', 'Kenya', 1, NULL, NULL, NULL, '$2y$10$kv.4.q76bZseJKbPBoSf.ez/DJD2skVyjd943IcYvyARrJyI6ZPUK', NULL, '2022-02-27 20:04:12', '2022-02-27 20:04:12'),
(10, 'EmmAduralele', 'test2@test.com', 'Lagos', 'Nigeria', 0, NULL, NULL, NULL, '$2y$10$MMEnFAAcdr//TXgQNb3zX.QvJbqT6tgLPRV1C2zTPHfWiAwKDZQKW', NULL, '2022-02-27 20:04:38', '2022-02-27 20:04:38'),
(12, 'Victor Moses', 'test2_guard@test.com', 'Ibadan', 'Nigeria', 0, NULL, NULL, NULL, '$2y$10$dUfG66P.MUwIqdWaJv7d/e4xNEBW2oj3oGFIJfv4jCEu5nnMgMgMy', NULL, '2022-02-27 20:18:53', '2022-02-27 20:18:53');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
