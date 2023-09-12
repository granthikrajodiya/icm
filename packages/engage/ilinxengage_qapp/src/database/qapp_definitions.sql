-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2023 at 08:56 AM
-- Server version: 8.0.34-0ubuntu0.20.04.1
-- PHP Version: 8.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_icm`
--

-- --------------------------------------------------------

--
-- Table structure for table `qapp_definitions`
--

CREATE TABLE `qapp_definitions` (
  `id` int NOT NULL,
  `tenant_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `online` int NOT NULL DEFAULT '0',
  `allow_upload` int NOT NULL DEFAULT '0',
  `allow_download` int NOT NULL DEFAULT '0',
  `allow_print` int NOT NULL DEFAULT '0',
  `form_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `ics_appname` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `card_mode` int NOT NULL DEFAULT '0',
  `navigation_mode` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `qapp_definitions`
--
ALTER TABLE `qapp_definitions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `qapp_definitions`
--
ALTER TABLE `qapp_definitions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
