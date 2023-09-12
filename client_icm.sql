-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 12, 2023 at 08:34 AM
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
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_time` datetime NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `reference_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `type`, `date_time`, `text`, `created_at`, `updated_at`, `user_id`, `reference_id`) VALUES
(1, 'user', '2023-07-26 10:15:34', 'Voluptatem at cumque maiores. Ut quis eum earum magni officiis necessitatibus. Delectus optio doloribus modi est alias quasi id nisi.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 7, NULL),
(2, 'user', '2023-07-28 01:56:35', 'Odio suscipit tenetur magni eum. Molestiae deserunt labore est consequatur et atque. Vel non ea consequatur.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 7, NULL),
(3, 'user', '2023-07-27 06:04:46', 'Aut totam et excepturi corrupti architecto. Neque doloribus optio qui iusto. Est voluptatibus dolor quas quos asperiores perspiciatis neque occaecati.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 7, NULL),
(4, 'user', '2023-08-01 16:05:28', 'Itaque vero qui reprehenderit aspernatur error ut. Natus assumenda numquam ex esse ipsum ad explicabo. Est illo ab sed optio est molestias.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 7, NULL),
(5, 'system', '2023-07-30 04:45:39', 'Placeat reprehenderit culpa neque sed. Porro placeat doloribus et nihil reiciendis esse. Beatae quam rerum totam reiciendis. Ut quibusdam eum autem recusandae accusantium aut esse.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 7, NULL),
(6, 'system', '2023-07-26 20:50:49', 'Beatae minus unde velit. Perferendis quae inventore voluptas neque et. Eaque maxime non et a. Suscipit possimus qui totam sint ut. Autem tenetur soluta ad blanditiis. Eius alias adipisci magni.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 7, NULL),
(7, 'system', '2023-07-28 16:22:12', 'Quae dolor expedita quis sunt est qui est deleniti. Voluptatibus velit sed hic porro. Magnam aut perspiciatis non corrupti numquam fugiat labore. Enim aliquam eligendi at.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 7, NULL),
(8, 'system', '2023-07-29 11:56:07', 'Iusto saepe in provident ad. Excepturi qui consectetur culpa facilis ea et ex. Odio quisquam vel aut. Nostrum rerum iure beatae et quasi ut.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 7, NULL),
(9, 'system', '2023-07-29 00:18:00', 'Officia neque neque suscipit dolorum itaque. Consequatur maiores vero eius sed optio recusandae alias est. Et blanditiis earum illum aut saepe qui. Eos perferendis delectus ut cupiditate deserunt.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 7, NULL),
(10, 'system', '2023-08-01 06:18:40', 'Eveniet corrupti commodi quidem. Corrupti possimus quos in molestiae et ea. Praesentium doloribus aliquam quos non. Hic magni quae sint et alias fugiat dolor. Ipsam et repellendus provident.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 7, NULL),
(11, 'user', '2023-07-29 03:33:08', 'Esse ipsam rerum accusamus sunt harum. Fuga sit veniam quisquam incidunt. Esse accusamus animi minima. Labore ullam dicta illo qui velit ut in quos.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 19, NULL),
(12, 'user', '2023-07-30 10:22:02', 'Ut sequi consequuntur dolorem vel. Occaecati iste ducimus dolore corporis. Et minus temporibus possimus perferendis. Laborum eveniet sint tempora.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 19, NULL),
(13, 'user', '2023-07-25 03:49:47', 'Dolore aut ea non nihil ducimus ab. Maxime et consectetur ea voluptates libero eius. In unde sunt totam illo omnis qui nihil.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 19, NULL),
(14, 'system', '2023-07-28 03:49:25', 'Quis architecto aliquam sit autem. Dolores et ducimus vel officia consectetur quidem aspernatur ea. Odio sint velit dolores iusto neque doloribus.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 19, NULL),
(15, 'user', '2023-07-28 05:53:00', 'Minus omnis aliquam cum veritatis ipsum est praesentium. Blanditiis ut est dignissimos aut debitis cum deserunt. Nam sint animi et nihil neque.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 19, NULL),
(16, 'system', '2023-07-26 21:15:50', 'Voluptatem esse facere suscipit sed exercitationem repudiandae ut. Minima cupiditate corrupti magnam aperiam quas officiis mollitia. Voluptatem qui molestiae ad eius deserunt.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 19, NULL),
(17, 'system', '2023-08-01 05:35:11', 'Similique corrupti voluptatum atque. Voluptatem temporibus sit et quia dolores.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 19, NULL),
(18, 'system', '2023-07-29 17:32:07', 'Et quasi et qui velit minima. Quia et magni non tempore placeat voluptatem nesciunt.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 19, NULL),
(19, 'system', '2023-07-30 01:48:20', 'Qui blanditiis rerum itaque tempora. Et qui id soluta omnis numquam. Iste inventore debitis enim sed quia.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 19, NULL),
(20, 'user', '2023-07-24 16:26:01', 'Incidunt porro illum expedita earum tempora quaerat. Sunt molestiae totam nihil soluta architecto. Sunt labore ipsam voluptatem odio repellat.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 19, NULL),
(21, 'system', '2023-07-30 21:49:17', 'Minima velit quia illum aliquam dignissimos dicta. Et est dolorem fuga eligendi incidunt velit nesciunt. Ut fuga iste architecto doloribus ducimus. Esse et et cupiditate eveniet dolor.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 20, NULL),
(22, 'user', '2023-07-24 07:54:16', 'Perferendis rerum asperiores quaerat soluta. Non autem temporibus sunt distinctio totam. At vel facilis quia. Consectetur laboriosam ea et eaque nulla.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 20, NULL),
(23, 'user', '2023-07-30 17:02:30', 'Magni magnam quaerat perferendis maxime qui in dolorum. Ducimus sed reiciendis dolorum atque quam. Eaque quas consequatur sequi porro recusandae nulla.', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 20, NULL),
(24, 'user', '2023-07-28 16:55:26', 'Possimus sit incidunt omnis nostrum. Nisi velit fugiat quo. Enim repellat hic perspiciatis quia assumenda enim. Quia impedit soluta labore facilis accusantium expedita consectetur.', '2023-08-02 22:25:51', '2023-08-02 22:25:51', 20, NULL),
(25, 'system', '2023-07-29 04:57:36', 'Officiis et dicta aliquam assumenda ipsa ullam consectetur. Et quae est aut.', '2023-08-02 22:25:51', '2023-08-02 22:25:51', 20, NULL),
(26, 'system', '2023-07-28 21:25:42', 'Quas dolore dicta nihil ut. Omnis corporis quos fugiat quisquam pariatur aspernatur qui inventore. Repellendus at labore consequatur quasi.', '2023-08-02 22:25:51', '2023-08-02 22:25:51', 20, NULL),
(27, 'user', '2023-07-27 14:35:12', 'Minima officiis ab error est dolor ut optio. Nesciunt rem et exercitationem veritatis facilis. Tenetur dolores eos temporibus saepe porro quidem. Sequi quibusdam quia aliquam perspiciatis nemo.', '2023-08-02 22:25:51', '2023-08-02 22:25:51', 20, NULL),
(28, 'user', '2023-07-30 03:53:11', 'Voluptas est iure deleniti labore. Fugiat ut non quis. Perferendis sed voluptas harum est.', '2023-08-02 22:25:51', '2023-08-02 22:25:51', 20, NULL),
(29, 'user', '2023-08-02 23:48:05', 'Eaque et qui possimus rerum. Voluptas veritatis voluptates maiores eveniet ratione consequatur officiis. Aspernatur repellendus sequi autem.', '2023-08-02 22:25:51', '2023-08-02 22:25:51', 20, NULL),
(30, 'system', '2023-08-01 15:50:46', 'Ad odit ea sint maiores. Sed dolores quasi qui repellendus explicabo eaque. Modi officiis itaque rerum expedita.', '2023-08-02 22:25:51', '2023-08-02 22:25:51', 20, NULL),
(31, 'system', '2023-08-03 04:02:18', 'Login successfully at 8/3/2023 04:02 AM', '2023-08-02 22:32:18', '2023-08-02 22:32:18', 2, NULL),
(32, 'system', '2023-08-03 04:45:08', 'Login successfully at 8/3/2023 04:45 AM', '2023-08-02 23:15:08', '2023-08-02 23:15:08', 4, NULL),
(33, 'system', '2023-08-03 07:05:56', 'Login successfully at 08/03/2023 07:05 AM', '2023-08-03 01:35:56', '2023-08-03 01:35:56', 4, NULL),
(34, 'system', '2023-08-03 08:11:39', 'Logout successfully at 08/03/2023 08:11 AM', '2023-08-03 02:41:39', '2023-08-03 02:41:39', 4, NULL),
(35, 'system', '2023-08-03 08:27:11', 'Logout successfully at 08/03/2023 08:27 AM', '2023-08-03 02:57:11', '2023-08-03 02:57:11', 2, NULL),
(36, 'system', '2023-08-03 08:37:51', 'Login successfully at 08/03/2023 08:37 AM', '2023-08-03 03:07:51', '2023-08-03 03:07:51', 2, NULL),
(37, 'system', '2023-08-10 05:34:21', 'Login successfully at 08/10/2023 05:34 AM', '2023-08-10 00:04:21', '2023-08-10 00:04:21', 2, NULL),
(38, 'system', '2023-08-11 09:29:28', 'Login successfully at 08/11/2023 09:29 AM', '2023-08-11 03:59:28', '2023-08-11 03:59:28', 2, NULL),
(39, 'system', '2023-08-12 03:43:31', 'Login successfully at 08/12/2023 03:43 AM', '2023-08-11 22:13:31', '2023-08-11 22:13:31', 2, NULL),
(40, 'system', '2023-08-12 05:33:12', 'Logout successfully at 08/12/2023 05:33 AM', '2023-08-12 00:03:12', '2023-08-12 00:03:12', 2, NULL),
(41, 'system', '2023-08-16 05:41:27', 'Login successfully at 08/16/2023 05:41 AM', '2023-08-16 00:11:28', '2023-08-16 00:11:28', 2, NULL),
(42, 'system', '2023-08-21 02:36:04', 'Login successfully at 08/21/2023 02:36 AM', '2023-08-20 21:06:04', '2023-08-20 21:06:04', 2, NULL),
(43, 'system', '2023-08-21 06:19:18', 'Login successfully at 08/21/2023 06:19 AM', '2023-08-21 00:49:18', '2023-08-21 00:49:18', 2, NULL),
(44, 'system', '2023-08-21 06:19:48', 'Logout successfully at 08/21/2023 06:19 AM', '2023-08-21 00:49:48', '2023-08-21 00:49:48', 2, NULL),
(45, 'system', '2023-08-21 06:20:57', 'Login successfully at 08/21/2023 06:20 AM', '2023-08-21 00:50:57', '2023-08-21 00:50:57', 2, NULL),
(46, 'system', '2023-08-21 06:24:06', 'Logout successfully at 08/21/2023 06:24 AM', '2023-08-21 00:54:06', '2023-08-21 00:54:06', 2, NULL),
(47, 'system', '2023-08-21 06:24:18', 'Login successfully at 08/21/2023 06:24 AM', '2023-08-21 00:54:18', '2023-08-21 00:54:18', 2, NULL),
(48, 'system', '2023-08-21 06:25:24', 'Logout successfully at 08/21/2023 06:25 AM', '2023-08-21 00:55:24', '2023-08-21 00:55:24', 2, NULL),
(49, 'system', '2023-08-21 06:25:40', 'Login successfully at 08/21/2023 06:25 AM', '2023-08-21 00:55:40', '2023-08-21 00:55:40', 2, NULL),
(50, 'system', '2023-08-23 10:08:45', 'Login successfully at 08/23/2023 10:08 AM', '2023-08-23 04:38:45', '2023-08-23 04:38:45', 2, NULL),
(51, 'system', '2023-08-25 07:25:50', 'Login successfully at 08/25/2023 07:25 AM', '2023-08-25 01:55:50', '2023-08-25 01:55:50', 2, NULL),
(52, 'system', '2023-08-25 08:27:40', 'Logout successfully at 08/25/2023 08:27 AM', '2023-08-25 02:57:40', '2023-08-25 02:57:40', 2, NULL),
(53, 'system', '2023-08-25 08:40:09', 'Login successfully at 08/25/2023 08:40 AM', '2023-08-25 03:10:09', '2023-08-25 03:10:09', 2, NULL),
(54, 'system', '2023-08-25 09:09:49', 'Logout successfully at 08/25/2023 09:09 AM', '2023-08-25 03:39:49', '2023-08-25 03:39:49', 2, NULL),
(55, 'system', '2023-08-25 09:09:55', 'Login successfully at 08/25/2023 09:09 AM', '2023-08-25 03:39:55', '2023-08-25 03:39:55', 2, NULL),
(56, 'system', '2023-08-29 03:50:37', 'Login successfully at 08/29/2023 03:50 AM', '2023-08-28 22:20:37', '2023-08-28 22:20:37', 2, NULL),
(57, 'system', '2023-08-29 06:16:10', 'Login successfully at 08/29/2023 06:16 AM', '2023-08-29 00:46:10', '2023-08-29 00:46:10', 2, NULL),
(58, 'system', '2023-08-29 08:29:05', 'Logout successfully at 08/29/2023 08:29 AM', '2023-08-29 02:59:05', '2023-08-29 02:59:05', 2, NULL),
(59, 'system', '2023-08-29 08:32:01', 'Login successfully at 08/29/2023 08:32 AM', '2023-08-29 03:02:01', '2023-08-29 03:02:01', 2, NULL),
(60, 'system', '2023-08-29 10:24:59', 'Logout successfully at 08/29/2023 10:24 AM', '2023-08-29 04:54:59', '2023-08-29 04:54:59', 2, NULL),
(61, 'system', '2023-08-29 11:17:04', 'Login successfully at 08/29/2023 11:17 AM', '2023-08-29 05:47:04', '2023-08-29 05:47:04', 2, NULL),
(62, 'system', '2023-08-31 02:43:02', 'Login successfully at 08/31/2023 02:43 AM', '2023-08-30 21:13:02', '2023-08-30 21:13:02', 2, NULL),
(63, 'system', '2023-08-31 08:03:32', 'Logout successfully at 08/31/2023 08:03 AM', '2023-08-31 02:33:32', '2023-08-31 02:33:32', 2, NULL),
(64, 'system', '2023-08-31 08:40:59', 'Login successfully at 08/31/2023 08:40 AM', '2023-08-31 03:10:59', '2023-08-31 03:10:59', 2, NULL),
(65, 'system', '2023-09-01 03:55:14', 'Login successfully at 09/01/2023 03:55 AM', '2023-08-31 22:25:14', '2023-08-31 22:25:14', 2, NULL),
(66, 'system', '2023-09-01 08:20:49', 'Logout successfully at 09/01/2023 08:20 AM', '2023-09-01 02:50:49', '2023-09-01 02:50:49', 2, NULL),
(67, 'system', '2023-09-01 08:34:04', 'Login successfully at 09/01/2023 08:34 AM', '2023-09-01 03:04:04', '2023-09-01 03:04:04', 2, NULL),
(68, 'system', '2023-09-04 03:28:23', 'Login successfully at 09/04/2023 03:28 AM', '2023-09-03 21:58:23', '2023-09-03 21:58:23', 2, NULL),
(69, 'system', '2023-09-05 02:48:41', 'Login successfully at 09/05/2023 02:48 AM', '2023-09-04 21:18:41', '2023-09-04 21:18:41', 2, NULL),
(70, 'system', '2023-09-06 03:41:24', 'Login successfully at 09/06/2023 03:41 AM', '2023-09-05 22:11:24', '2023-09-05 22:11:24', 2, NULL),
(71, 'system', '2023-09-08 04:11:16', 'Login successfully at 09/08/2023 04:11 AM', '2023-09-07 22:41:16', '2023-09-07 22:41:16', 2, NULL),
(72, 'system', '2023-09-08 08:08:08', 'Logout successfully at 09/08/2023 08:08 AM', '2023-09-08 02:38:08', '2023-09-08 02:38:08', 2, NULL),
(73, 'system', '2023-09-08 08:53:42', 'Login successfully at 09/08/2023 08:53 AM', '2023-09-08 03:23:42', '2023-09-08 03:23:42', 2, NULL),
(74, 'system', '2023-09-08 09:54:08', 'Logout successfully at 09/08/2023 09:54 AM', '2023-09-08 04:24:08', '2023-09-08 04:24:08', 2, NULL),
(75, 'system', '2023-09-08 09:56:21', 'Login successfully at 09/08/2023 09:56 AM', '2023-09-08 04:26:21', '2023-09-08 04:26:21', 2, NULL),
(76, 'system', '2023-09-08 12:12:07', 'Logout successfully at 09/08/2023 12:12 PM', '2023-09-08 06:42:07', '2023-09-08 06:42:07', 2, NULL),
(77, 'system', '2023-09-08 12:26:19', 'Login successfully at 09/08/2023 12:26 PM', '2023-09-08 06:56:19', '2023-09-08 06:56:19', 2, NULL),
(78, 'system', '2023-09-11 02:57:58', 'Login successfully at 09/11/2023 02:57 AM', '2023-09-10 21:27:58', '2023-09-10 21:27:58', 2, NULL),
(79, 'system', '2023-09-11 05:31:40', 'Logout successfully at 09/11/2023 05:31 AM', '2023-09-11 00:01:40', '2023-09-11 00:01:40', 2, NULL),
(80, 'system', '2023-09-11 05:33:22', 'Login successfully at 09/11/2023 05:33 AM', '2023-09-11 00:03:22', '2023-09-11 00:03:22', 2, NULL),
(81, 'system', '2023-09-11 07:46:40', 'Logout successfully at 09/11/2023 07:46 AM', '2023-09-11 02:16:40', '2023-09-11 02:16:40', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE `calendars` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `all_day` int DEFAULT '0',
  `timezone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calendars`
--

INSERT INTO `calendars` (`id`, `name`, `start_time`, `end_time`, `start_date`, `end_date`, `description`, `color`, `created_at`, `updated_at`, `created_by`, `username`, `tenant_id`, `scope`, `all_day`, `timezone`) VALUES
(1, 'ut', '06:56:50', '06:58:50', '2023-08-05', '2023-08-07', 'Impedit est consequuntur rerum cumque praesentium. Molestiae vero officiis rem aspernatur. Incidunt ullam laudantium maxime voluptatibus.', 'bg-danger', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 1, NULL, NULL, 'system', 0, NULL),
(2, 'nulla', '04:57:50', '05:57:50', '2023-08-05', '2023-08-09', 'Minima quo vel et eaque reprehenderit amet id. Ea aut atque iure consectetur vel. Accusantium natus est aut nihil eum nesciunt ut.', 'bg-primary', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 1, NULL, NULL, 'tenant', 0, NULL),
(3, 'repellendus', '04:56:50', '05:56:50', '2023-08-04', '2023-08-08', 'Atque omnis facilis odit sit quaerat laborum necessitatibus. Reprehenderit nesciunt qui quia. Ut quo reiciendis eaque itaque voluptatem.', 'bg-info', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 1, NULL, NULL, 'user', 0, NULL),
(4, 'provident', '05:56:50', '05:56:50', '2023-08-04', '2023-08-07', 'Distinctio earum qui perferendis. Expedita consequatur fuga cumque consequatur excepturi voluptates esse et. Id ea expedita iure.', 'bg-warning', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 1, NULL, NULL, 'system', 0, NULL),
(5, 'esse', '06:57:50', '06:57:50', '2023-08-05', '2023-08-09', 'Quia molestiae provident corporis sequi laboriosam et. Molestiae quia non ut soluta quia quas voluptatem.', 'bg-warning', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 1, NULL, NULL, 'user', 0, NULL),
(6, 'voluptatem', '04:58:50', '05:57:50', '2023-08-04', '2023-08-07', 'Autem molestiae ea necessitatibus voluptas eos eligendi quia id. Voluptates at iste neque repellendus possimus perferendis eum. Cum vitae qui quas et vel nihil. Itaque dolor eaque sed et.', 'bg-success', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 1, NULL, NULL, 'user', 0, NULL),
(7, 'et', '05:56:50', '06:57:50', '2023-08-04', '2023-08-08', 'Enim ipsum illo dolor id aut voluptatem. Dolorum deleniti velit voluptatem aut. Aspernatur eos est nostrum ea dolor qui beatae.', 'bg-success', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 1, NULL, NULL, 'user', 0, NULL),
(8, 'itaque', '04:58:50', '05:58:50', '2023-08-06', '2023-08-09', 'Et sit in eos esse deleniti est. Excepturi officia nihil dolorum eum neque delectus. Et occaecati dicta possimus qui blanditiis dolor veritatis fugit. Totam eos explicabo eos libero.', 'bg-danger', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 1, NULL, NULL, 'user', 0, NULL),
(9, 'ratione', '05:56:50', '04:57:50', '2023-08-05', '2023-08-07', 'Voluptatem ex et autem incidunt dolor. Est pariatur neque aut eligendi libero exercitationem placeat. Dolorem velit sunt impedit.', 'bg-warning', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 1, NULL, NULL, 'system', 0, NULL),
(10, 'tempore', '05:56:50', '06:57:50', '2023-08-05', '2023-08-08', 'Accusantium beatae ut nobis dolores. Et nihil illum earum at dolor iusto id. Nesciunt explicabo quia explicabo quia aut.', 'bg-danger', '2023-08-02 22:25:50', '2023-08-02 22:25:50', 1, NULL, NULL, 'tenant', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `id` bigint UNSIGNED NOT NULL,
  `batch_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `call_type` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `call_date` date DEFAULT NULL,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calls`
--

INSERT INTO `calls` (`id`, `batch_id`, `subject`, `call_type`, `duration`, `description`, `call_date`, `created_by`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '593ae7e3-8418-3e9e-8d57-d4dfea100944', 'praesentium', 'outbound', '04:56', 'Magni aut perferendis qui. Quae suscipit iusto assumenda sint quia recusandae veritatis. In veritatis et officia aut adipisci praesentium laudantium.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 2),
(2, 'ac6af48b-1a7e-3e91-b5e8-3f568fe6c516', 'excepturi', 'outbound', '05:58', 'Et ad est qui. Aut voluptatem numquam quis quis. Aut earum animi eligendi voluptatem reiciendis laborum.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 2),
(3, 'cd7fac69-f73d-3d27-ac4c-f83c373b09e0', 'quo', 'inbound', '06:58', 'Dolorem sint enim iusto et et vel. Omnis tempore accusamus sunt et facilis ab architecto. Assumenda qui in voluptas. Minus consequatur dolore a voluptatibus velit est. Aut rerum cupiditate et dolore.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 2),
(4, '89c1b868-d29f-3ba7-aa1a-fe77bbd332e5', 'accusantium', 'outbound', '04:57', 'Libero rerum voluptatem animi voluptatem et aut. Expedita quo sit sit laborum et. Nostrum ipsum mollitia ipsam ratione repellat dicta aut. Ut cupiditate dolorem est harum quis.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 3),
(5, '75c439fb-78e5-344a-9756-0f1330eda10e', 'officiis', 'outbound', '05:56', 'Aut itaque itaque blanditiis quam occaecati voluptatem voluptatem. Non earum officiis atque provident. Dolor voluptates repellendus odit repellendus.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 3),
(6, '96ae5902-671d-3027-b043-0e46964cce70', 'tempore', 'inbound', '06:56', 'Et maxime qui non quia molestias officiis. Voluptate aut nisi totam. Et quia aperiam autem aspernatur dolores autem architecto.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 3),
(7, '3affda6e-6ffc-3d8c-89cd-cc89e74ff7b9', 'dolores', 'outbound', '04:56', 'Assumenda non deleniti quasi esse fugit. Expedita placeat nihil amet alias voluptatem omnis incidunt. Eius dolorum error iure autem non omnis sunt. Earum quis iure voluptas odit.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 4),
(8, 'f0bd5970-1380-36e0-bd8b-6f721c35fd11', 'voluptates', 'inbound', '06:56', 'Consequatur itaque sint delectus qui rerum. Et sequi omnis eos aspernatur suscipit facilis praesentium voluptatum. Sunt hic vel nam assumenda. Consequatur rerum quasi nisi in quis ut.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 4),
(9, 'db947810-e60c-381b-a934-0fecbd8c86a2', 'quisquam', 'inbound', '05:57', 'Quis sit provident eius est eligendi et. Eum unde sint eum veniam sit. Saepe itaque molestiae eius eaque cumque omnis omnis.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 4),
(10, '06c18c60-d2b4-304c-a285-a0b54925ca85', 'occaecati', 'outbound', '05:57', 'Velit aperiam mollitia vero velit non. Maiores autem aperiam distinctio quam ratione qui est. Et est veritatis qui. Omnis velit est culpa minima aut voluptatem.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 5),
(11, 'd88d9bd0-f3bc-3ce0-b5cd-96004d69541f', 'sint', 'inbound', '05:56', 'Vitae officiis aspernatur sint explicabo sint saepe voluptates. Rerum voluptatem sunt omnis et saepe sunt ut. Molestiae qui eligendi facilis sunt ut et.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 5),
(12, 'c132dd1f-264e-36b9-b2d9-d7a4beb1bcf8', 'molestiae', 'inbound', '05:56', 'Sunt esse provident sint. Debitis ipsum itaque ut ea. Ea commodi sit totam qui blanditiis aliquam atque. Rem qui ut ea facere magni molestias. Velit excepturi doloremque quod provident perferendis.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 5),
(13, '55414589-1cc9-347b-bfeb-b48eeb861910', 'eos', 'inbound', '05:56', 'Rerum repellat eum praesentium molestias. Distinctio quia optio aut excepturi. Qui dolorum qui qui repellendus et enim iusto. Nihil nesciunt aspernatur iusto veniam esse.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 6),
(14, 'e004ce09-0fc3-3159-a555-06a0dae36e96', 'aspernatur', 'outbound', '05:58', 'Ducimus magni repellat molestiae. Consequatur omnis consequatur fuga perferendis repellendus. Consequuntur aspernatur praesentium et tempora eaque laboriosam.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 6),
(15, '54d8124b-d9f2-3413-a00c-400f680241ff', 'sapiente', 'outbound', '05:58', 'Quis qui excepturi qui ab libero. Voluptas non necessitatibus et et aliquam molestias est sunt. Omnis sed sint et debitis sit vel et.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 6),
(16, '7115e32f-12a4-35e2-a93c-eacd6f35a920', 'praesentium', 'outbound', '06:58', 'Doloribus occaecati non ad et aut aspernatur rem. Iure voluptas ex necessitatibus dicta consequatur. Delectus sunt sed error deleniti.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 7),
(17, '69b90264-2499-39ee-b403-cf6879078784', 'est', 'inbound', '04:58', 'Quisquam magnam iure aut ut. Doloremque animi illum voluptatem totam molestias.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 7),
(18, '6d86c442-3925-336a-af12-1b3364dfcd7c', 'repellat', 'outbound', '06:56', 'Exercitationem inventore temporibus fuga reiciendis. Ut inventore adipisci doloribus ipsam et. Vel rerum blanditiis maxime cum illo sit quos.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 7),
(19, 'e48c5ae2-fab9-3725-b6f1-7f27ba3c6479', 'porro', 'outbound', '06:57', 'Adipisci itaque perspiciatis aut repellendus vel. Facere voluptatibus voluptate sit dolores sequi et quis numquam. Beatae iste fuga quo.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 8),
(20, 'e8a9632c-34e8-362e-b483-23ee0bd83f9e', 'ipsum', 'inbound', '06:57', 'Soluta natus quas voluptatem. Tenetur soluta laborum accusantium et ullam sint doloremque. Non blanditiis non voluptas autem aut aperiam et.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 8),
(21, 'a1a1a0a1-d99f-3f62-baee-ec14dedca6d7', 'non', 'inbound', '05:57', 'Nostrum sed ipsum aliquam deleniti magni. Provident quidem non dolor rerum. Illum dolor id voluptatem aspernatur consectetur dolorem suscipit.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 8),
(22, '1e207d6c-7b63-3f23-aa56-38d0c1fed5fe', 'numquam', 'outbound', '04:57', 'Qui rerum repudiandae beatae molestiae. Itaque voluptatum accusamus neque sunt sit alias autem. Minus maxime adipisci vero voluptas accusantium et tempora.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 9),
(23, '46575274-6c94-3a48-b8e4-d3126b85c9bb', 'expedita', 'inbound', '06:57', 'Consequuntur saepe temporibus sint eos. Dolor cupiditate eos similique labore beatae deserunt architecto. Est dicta consectetur ut qui voluptates ut dolor. Dicta beatae et impedit et ratione.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 9),
(24, '9dd8d2ab-fa81-3e5e-b296-d2d738233d3f', 'nobis', 'outbound', '04:58', 'Vel illo aspernatur quis mollitia sint est. Dolore et eos consequatur ut. Sit ut maiores qui repellendus consequatur eveniet.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 9),
(25, '65cc4ab5-08c6-3fbd-973d-19381253b1c5', 'reiciendis', 'inbound', '05:58', 'Sit fugit rerum consectetur repudiandae. Aliquid enim ut inventore ea quo illo suscipit. Neque repellat est in quam debitis. Praesentium at commodi eos autem.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 10),
(26, '1783217e-b13e-313e-b5ad-b1df2290479e', 'suscipit', 'inbound', '05:58', 'Aperiam esse ut quidem harum sint dignissimos omnis quia. Iure ut sint dicta voluptatibus quia amet. Ipsam ab qui neque consectetur enim.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 10),
(27, '11684cfe-2115-35d2-badd-f960cab153c7', 'voluptatem', 'inbound', '05:58', 'Inventore totam non deserunt. Ratione rerum facere et ut id eos dolore. Nisi repellat consequatur qui.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 10),
(28, '224a9626-338c-3d6f-922d-b6c3f652235b', 'quos', 'inbound', '05:56', 'Occaecati expedita quo illum sunt fugit. Nam minus sint quo explicabo qui. Est qui laboriosam aut in vitae sed suscipit.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 11),
(29, '77b3e9ce-77bb-3c9a-9dce-d1c127461139', 'in', 'inbound', '04:56', 'Aut et dolor minima at ut voluptatem perferendis. Inventore vel id consequatur.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 11),
(30, '4496ab4f-11ba-3cf3-9f84-3293889eef27', 'perferendis', 'inbound', '04:56', 'Itaque nobis qui animi labore quae quia cumque sapiente. Quo sed error quo quae aut explicabo culpa quae. Dolores laboriosam a reiciendis consequatur omnis. Et quod illum vel ut.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 11),
(31, '0178e8ec-2e46-3408-aef3-ff0503027fe9', 'nesciunt', 'outbound', '05:56', 'Dolor natus dignissimos expedita est modi. Aliquam suscipit et esse deleniti natus eum corrupti. Quibusdam similique harum magnam debitis reprehenderit autem beatae blanditiis.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 12),
(32, 'a6b25ad4-1832-3d08-9b1e-f3a7dca48396', 'a', 'inbound', '06:58', 'Quam a necessitatibus quas quia. Est ipsum quibusdam maiores sit fugiat deleniti. Quia ut ea eum laboriosam.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 12),
(33, '8e6bfd4e-ea12-33e0-aa37-2c7935a9465a', 'dolor', 'inbound', '06:56', 'Quasi ad voluptas quis ea. Mollitia qui quisquam quo commodi illum aut et nostrum. Occaecati rerum eum unde rerum fugit.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 12),
(34, 'e5b72351-a376-3996-967e-9a2574aff1c4', 'quisquam', 'outbound', '05:56', 'Magni reiciendis sit minus dolores. Ad fugit praesentium itaque voluptas alias qui explicabo velit. Sapiente sed sit et. Voluptas unde quo quia et sint accusamus minus.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 13),
(35, '4434603f-bb03-3966-aada-cd3a85f282bd', 'autem', 'outbound', '05:56', 'Optio deserunt quis minima nobis et architecto. Voluptas officia sit ad magni optio suscipit est. Illum ducimus molestias dolor.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 13),
(36, '0be156c6-23d9-3676-bf60-061d1733bdb8', 'illo', 'inbound', '06:56', 'Eum molestias non aut laudantium. Velit et et sint enim in. Nisi voluptatem aperiam velit quia.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 13),
(37, '9ee3f77f-a142-330e-a463-139139e9d010', 'dolor', 'outbound', '04:56', 'Aut excepturi quibusdam architecto quo non. Possimus quibusdam quos veniam eveniet ipsum. Voluptas non quaerat quia quisquam saepe quae.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 14),
(38, 'd0e47b7d-22d8-3014-b15b-f360c6f33180', 'corrupti', 'inbound', '04:58', 'Et sunt possimus consequatur id. Quos quo reiciendis veniam sed. Reprehenderit sequi qui reiciendis laudantium vero. Fugiat aliquid animi qui odit.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 14),
(39, 'a61971f3-0e43-37d8-8635-8e5357fc180e', 'labore', 'inbound', '04:56', 'Voluptatem rerum dolorem assumenda. Iusto rem accusantium qui esse. Nam corrupti totam dolorem eveniet eos hic.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 14),
(40, 'd385ace9-e75d-3568-b167-c269161e3379', 'dignissimos', 'inbound', '04:57', 'Et nam ut iure voluptatem. Sit dolorem optio aut dolor nam natus.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 15),
(41, 'd1047330-0c7e-3197-b171-ac3db6e31102', 'quibusdam', 'inbound', '06:57', 'Placeat eveniet aliquam vitae ad. Voluptate soluta vel nostrum commodi. Reiciendis saepe consectetur quas quibusdam dolor.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 15),
(42, '50187d31-8da5-3c98-a381-daf9cf58c9f8', 'eum', 'outbound', '06:56', 'Repudiandae quidem quam reprehenderit aliquam suscipit ut laborum numquam. Non in sed harum minus doloremque sunt aut repellat. Repellat cum id ut laboriosam excepturi nobis. Rem rerum adipisci in.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 15),
(43, '2ae90266-69a9-3b20-9c16-fe835d0c3234', 'explicabo', 'outbound', '04:58', 'Illum eos explicabo quis voluptas. Atque veritatis odit repudiandae possimus culpa. Magni repellat aut omnis quae.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 16),
(44, '38e4f0a7-5d33-339f-926d-521093f32f88', 'velit', 'outbound', '04:57', 'Earum minus eveniet officia vitae. Atque omnis quis iste.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 16),
(45, '961b201c-4ace-3c3a-97b7-71da5aa63163', 'accusantium', 'inbound', '05:56', 'Dicta et est eum quasi libero laudantium assumenda. Suscipit deserunt consequuntur magni omnis nihil vitae veniam.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 16),
(46, 'ddd94f75-8957-3378-9d1d-3c3690853c51', 'sint', 'inbound', '06:57', 'Dolor saepe delectus atque fugit vitae optio. Est similique eum eos eius sint est nihil. Sed porro quibusdam ipsa adipisci animi cumque.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 17),
(47, '26818614-3c05-36b5-a8a4-d6619de7cf89', 'omnis', 'inbound', '05:56', 'Aut quasi quaerat aut eos. Doloremque et explicabo aut vero ipsum nesciunt. Et sunt voluptatibus ut corrupti eius quas sit. Laborum eligendi nesciunt enim tempora est est.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 17),
(48, '8d8545a6-1fa1-34a7-915a-ad7d5a5e6341', 'totam', 'inbound', '06:57', 'Est quisquam facilis eaque commodi dolorem et. Maxime voluptate est aut sapiente culpa facilis veniam. Consequatur qui molestiae accusamus quam animi recusandae.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 17),
(49, '3aa18765-5c71-3ffd-a96d-d2d80b6b27c0', 'unde', 'inbound', '06:57', 'Ut incidunt officiis minima voluptatum. Voluptas corporis aut dolore necessitatibus sunt quam vel sit. Voluptate ab impedit officia asperiores saepe voluptas. Qui sit quisquam cumque et voluptas.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 18),
(50, 'e9f67b16-eb96-39aa-9a0d-64f7ef4e2c04', 'recusandae', 'inbound', '06:57', 'Modi ut neque nesciunt eum sequi sequi. Consequuntur voluptas similique in aut. Doloribus inventore quia ea eveniet alias et consectetur.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 18),
(51, '6ad37f79-6e72-3f6d-9eca-44d38ae7a711', 'quis', 'outbound', '04:57', 'Odit quia in veritatis vitae. Qui suscipit aspernatur ex. Accusamus dolorum nemo officia veniam enim. Quaerat quibusdam cupiditate omnis optio.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 18),
(52, 'a9f66df8-d633-37af-bdfa-faa91757499e', 'voluptatem', 'inbound', '05:57', 'Eum beatae assumenda nostrum eum. Et excepturi officia facilis placeat consequatur reiciendis. Praesentium et blanditiis aliquid eos et. Eos iusto quia earum accusantium.', '2023-08-04', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 19),
(53, '391a1be8-fdd1-35d0-a130-f7bc72591ea4', 'est', 'inbound', '05:56', 'Delectus blanditiis exercitationem facilis. Assumenda qui deserunt minus minima ea ipsum. Minima ullam modi sit praesentium soluta.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 19),
(54, '94c67507-20a5-328e-8b54-9b56e22c4d12', 'est', 'inbound', '05:57', 'Vitae voluptatum placeat qui possimus aperiam. Nostrum soluta voluptatem modi commodi fuga.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 19),
(55, 'ff0a758a-2c53-3eb3-ae28-7f58fa3b98fd', 'ducimus', 'outbound', '04:58', 'Earum ut aut ratione tempore sit omnis. Quaerat expedita doloribus voluptatem quae mollitia. Nihil doloremque modi laudantium non nemo impedit voluptas.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 20),
(56, '19edc078-9d17-3795-9925-adb6f7b7ca0d', 'assumenda', 'inbound', '04:58', 'Molestiae repellat quo vel est. Natus dolor iusto nihil architecto porro. Qui consequatur sit nihil.', '2023-08-06', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 20),
(57, '1548037b-2b40-3a63-a24c-842e187e4858', 'sunt', 'outbound', '05:56', 'Rerum cupiditate a omnis sint ipsum. Quia quia a quas. Nihil ut a est expedita eligendi quam culpa. Commodi ad voluptas iure minima neque.', '2023-08-05', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51', 20);

-- --------------------------------------------------------

--
-- Table structure for table `case_notes`
--

CREATE TABLE `case_notes` (
  `id` bigint UNSIGNED NOT NULL,
  `batch_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `case_notes`
--

INSERT INTO `case_notes` (`id`, `batch_id`, `notes`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'c76e8faf-9065-3a74-aa3a-5800aecbb4ec', 'Pariatur aut atque qui reiciendis occaecati modi ipsa. Soluta dolores assumenda ipsam consequatur modi consectetur laborum. Omnis ipsam ipsum harum omnis sed.', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51'),
(2, 'fa55f216-5863-39e6-9b45-e828a983fc80', 'Aut voluptatem officia beatae dolor eos ut. Nihil hic ut blanditiis quae et. Ipsum corporis harum ipsam modi fugit perspiciatis. Maxime nam sequi harum odit dolorem nam eos optio.', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51'),
(3, '442f9c56-8209-3984-8b71-fbffcce42602', 'Dolor est id est ratione. Libero ut nihil culpa quod. Molestiae dignissimos repellendus aliquam quia. Quia et dolore fuga ea labore facilis.', 1, '2023-08-02 22:25:51', '2023-08-02 22:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `chart_datasources`
--

CREATE TABLE `chart_datasources` (
  `id` bigint UNSIGNED NOT NULL,
  `datasource_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sp_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_favorites`
--

CREATE TABLE `ch_favorites` (
  `id` bigint NOT NULL,
  `favorite_id` bigint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ch_messages`
--

CREATE TABLE `ch_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_id` bigint NOT NULL,
  `to_id` bigint NOT NULL,
  `body` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `attachment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seen` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_pages`
--

CREATE TABLE `custom_pages` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `custom_pages`
--

INSERT INTO `custom_pages` (`id`, `title`, `detail`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'et', '<html><head><title>Modi quibusdam sequi eum qui occaecati.</title></head><body><form action=\"example.org\" method=\"POST\"><label for=\"username\">consequatur</label><input type=\"text\" id=\"username\"><label for=\"password\">aut</label><input type=\"password\" id=\"password\"></form></body></html>\n', '2023-08-02 22:25:52', '2023-08-02 22:25:52', NULL),
(2, 'hic', '<html><head><title>A possimus nihil unde velit.</title></head><body><form action=\"example.org\" method=\"POST\"><label for=\"username\">magni</label><input type=\"text\" id=\"username\"><label for=\"password\">corrupti</label><input type=\"password\" id=\"password\"></form></body></html>\n', '2023-08-02 22:25:52', '2023-08-02 22:25:52', NULL),
(3, 'consequatur', '<html><head><title>Necessitatibus impedit qui dolores.</title></head><body><form action=\"example.net\" method=\"POST\"><label for=\"username\">et</label><input type=\"text\" id=\"username\"><label for=\"password\">assumenda</label><input type=\"password\" id=\"password\"></form></body></html>\n', '2023-08-02 22:25:52', '2023-08-02 22:25:52', NULL),
(4, 'autem', '<html><head><title>Error hic.</title></head><body><form action=\"example.net\" method=\"POST\"><label for=\"username\">porro</label><input type=\"text\" id=\"username\"><label for=\"password\">et</label><input type=\"password\" id=\"password\"></form></body></html>\n', '2023-08-02 22:25:52', '2023-08-02 22:25:52', NULL),
(5, 'dolorem', '<html><head><title>Et ut et.</title></head><body><form action=\"example.org\" method=\"POST\"><label for=\"username\">molestias</label><input type=\"text\" id=\"username\"><label for=\"password\">repellendus</label><input type=\"password\" id=\"password\"></form></body></html>\n', '2023-08-02 22:25:52', '2023-08-02 22:25:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE `discussions` (
  `id` bigint UNSIGNED NOT NULL,
  `batch_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discussions`
--

INSERT INTO `discussions` (`id`, `batch_id`, `comment`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'e4cdf57c-e34f-3a74-9d01-47d3ecafefd6', 'Sunt molestiae repellendus consectetur ea voluptatibus. Eum labore qui et aliquid eaque sequi id.', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52'),
(2, '64a7fa89-f54f-3d8c-828f-aaa747c6bc2e', 'Consequatur repellendus qui maxime. Earum ducimus corrupti provident quis enim iusto eos dolores. Vel rerum amet architecto deleniti incidunt.', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52'),
(3, '8e15d91b-fb62-3487-a32b-8d940dee0799', 'Quas qui libero cum tempora et omnis veniam. Ut et ut inventore fuga corporis. Aut dicta nisi odio quae.', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` bigint UNSIGNED NOT NULL,
  `batch_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emails`
--

INSERT INTO `emails` (`id`, `batch_id`, `to`, `subject`, `description`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'b3714afe-3491-3b2d-9554-f27f391c69ca', 'srice@example.com', 'Ut et unde corrupti.', '<html><head><title>Quia quae corrupti libero nesciunt qui esse ratione quae a ab laboriosam.</title></head><body><form action=\"example.com\" method=\"POST\"><label for=\"username\">nihil</label><input type=\"text\" id=\"username\"><label for=\"password\">aut</label><input type=\"password\" id=\"password\"></form></body></html>\n', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52'),
(2, 'b5c85fdc-89c3-3b00-ba95-6b1cf00e7068', 'rmitchell@example.org', 'Provident ex.', '<html><head><title>Laborum minima qui a omnis.</title></head><body><form action=\"example.net\" method=\"POST\"><label for=\"username\">officiis</label><input type=\"text\" id=\"username\"><label for=\"password\">ipsam</label><input type=\"password\" id=\"password\"></form></body></html>\n', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52'),
(3, '5813eeb5-5584-33f2-af6f-a99100fcefa9', 'vivianne.dietrich@example.net', 'Eum molestiae.', '<html><head><title>Nobis consequatur velit consequuntur est voluptatibus est quidem et.</title></head><body><form action=\"example.org\" method=\"POST\"><label for=\"username\">laudantium</label><input type=\"text\" id=\"username\"><label for=\"password\">a</label><input type=\"password\" id=\"password\"></form></body></html>\n', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `detail`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 'Ipsum eos sit unde.', '<html><head><title>Similique ut eligendi in amet.</title></head><body><form action=\"example.com\" method=\"POST\"><label for=\"username\">aliquam</label><input type=\"text\" id=\"username\"><label for=\"password\">debitis</label><input type=\"password\" id=\"password\"></form></body></html>\n', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52'),
(3, 'Ducimus aut quia.', '<html><head><title>Voluptatem ut dolorem vitae earum consectetur voluptate.</title></head><body><form action=\"example.net\" method=\"POST\"><label for=\"username\">aut</label><input type=\"text\" id=\"username\"><label for=\"password\">tenetur</label><input type=\"password\" id=\"password\"></form></body></html>\n', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `file_download_history`
--

CREATE TABLE `file_download_history` (
  `id` bigint UNSIGNED NOT NULL,
  `tenant_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `filename` varchar(1024) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `download_date` datetime DEFAULT NULL,
  `download_user_id` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `file_download_history`
--

INSERT INTO `file_download_history` (`id`, `tenant_id`, `product_id`, `filename`, `download_date`, `download_user_id`, `updated_at`, `created_at`, `created_by`) VALUES
(1, 'host', 1, '3_f26b13f60c1c4c3e743093fdc4f62307_download.jpg', '2023-08-03 07:08:00', 2, '2023-08-03 07:08:00', '2023-08-03 07:08:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ird_delivery_jobs`
--

CREATE TABLE `ird_delivery_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `job_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ics_appname` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ics_documentid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ird_settings`
--

CREATE TABLE `ird_settings` (
  `id` bigint UNSIGNED NOT NULL,
  `tenant_id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ird_solicitation_emails`
--

CREATE TABLE `ird_solicitation_emails` (
  `id` bigint UNSIGNED NOT NULL,
  `created_by_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `to_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sent_at` datetime DEFAULT NULL,
  `replay_at` datetime DEFAULT NULL,
  `received_at` datetime DEFAULT NULL,
  `doc_count` int NOT NULL DEFAULT '0',
  `email_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ird_statistics`
--

CREATE TABLE `ird_statistics` (
  `id` bigint UNSIGNED NOT NULL,
  `batch_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `request_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `requestor_type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `open_date` date DEFAULT NULL,
  `original_due_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `closed_date` date DEFAULT NULL,
  `total_response_days` int DEFAULT NULL,
  `adjusted_due_date_days` int DEFAULT NULL,
  `additional_info_requested` tinyint(1) DEFAULT NULL,
  `closed_category` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `closed_category_note` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `applied_redaction_codes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `delivery_electronic` tinyint(1) DEFAULT NULL,
  `delivery_physical` tinyint(1) DEFAULT NULL,
  `required_scanning` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ird_time_tracking`
--

CREATE TABLE `ird_time_tracking` (
  `id` bigint UNSIGNED NOT NULL,
  `created_by_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `request_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch_id` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hours` decimal(8,2) NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `layouts`
--

CREATE TABLE `layouts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `single_item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `plural_item` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'top',
  `width` varchar(5) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '100',
  `max_item` int NOT NULL DEFAULT '0',
  `content_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_no` int NOT NULL DEFAULT '0',
  `layout_definition_id` int NOT NULL DEFAULT '0' COMMENT '0 = customer/client, 1 = internal admin, 2 = internal non-admin, 3 = public, 4 = external admin',
  `eform_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `custom_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adv_config` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layouts`
--

INSERT INTO `layouts` (`id`, `title`, `single_item`, `plural_item`, `position`, `width`, `max_item`, `content_type`, `data_source`, `order_no`, `layout_definition_id`, `eform_url`, `created_by`, `created_at`, `updated_at`, `custom_url`, `adv_config`) VALUES
(1, 'Calendar', 'Calendar', 'Calendars', 'top', '100', 10, 'Calendar', 'Standard Calendar', 0, 1, NULL, 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `layout_definitions`
--

CREATE TABLE `layout_definitions` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `user_group` int NOT NULL DEFAULT '1' COMMENT '1= Internal, 2= External, 3= Public',
  `security_groups` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `fixed_layout` int NOT NULL DEFAULT '0',
  `top_card_height` int DEFAULT '0',
  `middle_card_height` int DEFAULT '0',
  `bottom_card_height` int DEFAULT '0',
  `navigation_layout` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'grid'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `layout_definitions`
--

INSERT INTO `layout_definitions` (`id`, `title`, `description`, `user_group`, `security_groups`, `created_at`, `updated_at`, `fixed_layout`, `top_card_height`, `middle_card_height`, `bottom_card_height`, `navigation_layout`) VALUES
(1, 'Engage', NULL, 1, NULL, '2023-08-02 22:25:52', '2023-08-02 22:25:52', 0, 0, 0, 0, 'grid');

-- --------------------------------------------------------

--
-- Table structure for table `mail_settings`
--

CREATE TABLE `mail_settings` (
  `mail_driver` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_host` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_port` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_encryption` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_from_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_from_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_09_15_000010_create_tenants_table', 1),
(5, '2019_09_15_000020_create_domains_table', 1),
(6, '2019_09_22_192348_create_messages_table', 1),
(7, '2019_09_28_102009_create_settings_table', 1),
(8, '2019_10_16_211433_create_favorites_table', 1),
(9, '2019_10_18_223259_add_avatar_to_users', 1),
(10, '2019_10_20_211056_add_messenger_color_to_users', 1),
(11, '2019_10_22_000539_add_dark_mode_to_users', 1),
(12, '2019_10_25_214038_add_active_status_to_users', 1),
(13, '2020_10_23_051256_create_calendars_table', 1),
(14, '2020_12_21_022828_create_activities_table', 1),
(15, '2020_12_22_002833_create_user_notifications_table', 1),
(16, '2021_01_07_230526_create_faqs_table', 1),
(17, '2021_02_12_225828_create_layouts_table', 1),
(18, '2021_02_19_002148_create_discussions_table', 1),
(19, '2021_02_19_032322_create_notes_table', 1),
(20, '2021_02_19_035240_create_calls_table', 1),
(21, '2021_02_19_214632_create_emails_table', 1),
(22, '2021_02_23_022200_create_navigations_table', 1),
(23, '2021_02_25_022925_create_chart_datasources_table', 1),
(24, '2021_05_26_040626_create_ird_solicitation_emails_table', 1),
(25, '2021_05_27_045617_create_ird_time_trackings_table', 1),
(26, '2021_06_29_042141_create_layout_definitions_table', 1),
(27, '2021_09_23_061410_add_setting_to_tenants_table', 1),
(28, '2021_10_01_055949_add_security_groups_to_layout_definitions_table', 1),
(29, '2021_10_08_071518_create_rest_integrations_table', 1),
(30, '2021_10_29_100741_create_case_notes_table', 1),
(31, '2021_11_12_084557_create_custom_pages_table', 1),
(32, '2021_12_06_190141_change_column_type_tenant_id_on_users_table', 1),
(33, '2021_12_07_192258_add_column_eform_url_to_table_navigations', 1),
(34, '2021_12_08_113851_create_sessions_table', 1),
(35, '2021_12_08_142451_add_column_details_type_to_rest_integrations', 1),
(36, '2021_12_09_141212_alter_user_id_field_on_calls_table', 1),
(37, '2021_12_09_141213_alter_user_id_field_on_activities_table', 1),
(38, '2021_12_09_141214_alter_user_id_field_on_user_notifications_table', 1),
(39, '2021_12_09_143732_add_forgein_key_user_id_to_table_calls', 1),
(40, '2022_01_19_131648_add_column_layout_definition_at_users', 1),
(41, '2022_01_19_132802_add_column_custom_url_at_layouts', 1),
(42, '2022_01_20_185116_remove_index_created_by_on_settings_table', 1),
(43, '2022_01_20_186617_add_foreign_key_created_by_to_settings_table', 1),
(44, '2022_01_20_205725_add_foreign_key_created_by_on_discussions_table', 1),
(45, '2022_01_20_210020_add_foreign_key_created_by_on_notes_table', 1),
(46, '2022_01_20_211432_add_foreign_key_created_by_on_emails_table', 1),
(47, '2022_01_20_220507_add_foreign_key_created_by_on_case_notes_table', 1),
(48, '2022_01_24_134804_add_foreign_key_created_by_to_layouts_table', 1),
(49, '2022_01_24_142208_add_foreign_key_user_id_to_user_notification_table', 1),
(50, '2022_01_24_142601_add_foreign_key_user_id_to_activities_table', 1),
(51, '2022_01_24_143046_add_foreign_key_created_by_to_calendars_table', 1),
(52, '2022_01_24_143453_add_foreign_key_created_by_to_ird_solicitation_emails_table', 1),
(53, '2022_01_24_143937_add_foreign_key_created_by_to_rest_integration_table', 1),
(54, '2022_01_24_144241_add_foreign_key_created_by_to_custom_pages_table', 1),
(55, '2022_01_24_144834_add_foreign_key_created_by_to_ird_time_tracking_table', 1),
(56, '2022_01_24_181140_add_foreign_key_user_id_to_ch_favorites_table', 1),
(57, '2022_01_30_201658_alter_table_call_set_batch_id_nullable', 1),
(58, '2022_04_12_173624_add_column_authentication_service_to_tenants', 1),
(59, '2022_04_27_164325_create_okta_information_table', 1),
(60, '2022_05_31_170622_remove_unique_username_clause_from_users_table', 1),
(61, '2022_06_02_152819_create_mail_settings_table', 1),
(62, '2022_06_09_203127_add_column_requires_database_user_to_okta_information', 1),
(63, '2022_06_21_184011_add_require_two_factor_authentication_field_to_tenants_table', 1),
(64, '2022_06_21_195806_create_two_factor_authentication_codes_table', 1),
(65, '2022_08_03_125648_remove_foreign_key_user_id_from_user_notifications_table', 1),
(66, '2022_08_03_130354_remove_foreign_key_user_id_from_activities_table', 1),
(67, '2022_08_03_131010_alter_columns_on_user_notifications_table', 1),
(68, '2022_08_12_142852_create_module_permission_defs_table', 1),
(69, '2022_08_12_142909_create_module_permission_assignments_table', 1),
(70, '2022_08_18_140646_add_column_adv_config_at_navigations', 1),
(71, '2022_08_19_210000_create_ird_delivery_jobs_table', 1),
(72, '2022_08_25_141317_add_column_adv_config_at_layouts', 1),
(73, '2022_09_15_024038_add_column_batch_id_table_ird_solicitation_emails', 1),
(74, '2022_09_15_024641_add_column_batch_id_table_ird_time_tracking', 1),
(75, '2022_09_20_004337_add_column_upload_id_table_ird_solicitation_emails', 1),
(76, '2022_09_20_043023_create_ird_settings_table', 1),
(77, '2022_09_24_081911_alter_email_unique_in_users', 1),
(78, '2022_09_28_153329_add_password_reset_message_to_setting', 1),
(79, '2022_10_05_104800_create_sso_configurations_table', 1),
(80, '2022_10_07_153627_add_branding_column_on_tenants', 1),
(81, '2022_10_27_132037_create_password_reset_tokens_table', 1),
(82, '2022_11_01_142512_remove_okta_information_table', 1),
(83, '2022_11_09_120606_alter_columns_on_calendars_table', 1),
(84, '2022_11_21_070126_create_newsfeeds_table', 1),
(85, '2022_12_09_125234_add_ilinx_user_type_on_user_table', 1),
(86, '2022_12_14_153521_remove_domain_table', 1),
(87, '2022_12_15_151959_alter_columns_on_layout_definitions_table', 1),
(88, '2023_01_04_121244_nullable_image_in_news_feed', 1),
(89, '2023_01_10_122235_add_tenants_to_newsfeeds_table', 1),
(90, '2023_01_10_125638_add_manage_new_posts_on_tenants_table', 1),
(91, '2023_01_10_155355_add_permission_on_module_permission_defs_table', 1),
(92, '2023_01_17_144145_add_powered_by_logo_on_tenants', 1),
(93, '2023_02_07_154448_add_navigation_layout_on_layout_definitions_table', 1),
(94, '2023_02_27_180350_add_reference_i_d_to_activities', 1),
(95, '2023_05_02_174209_nullable_false_tenant_id_users_table', 1),
(96, '2023_05_23_033436_create_ird_statistics_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `module_permission_assignments`
--

CREATE TABLE `module_permission_assignments` (
  `id` bigint UNSIGNED NOT NULL,
  `group_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_value` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `module_permission_defs`
--

CREATE TABLE `module_permission_defs` (
  `id` bigint UNSIGNED NOT NULL,
  `module_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `permission_level` int NOT NULL,
  `permission_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_permission_defs`
--

INSERT INTO `module_permission_defs` (`id`, `module_name`, `permission_key`, `permission_level`, `permission_description`, `created_at`, `updated_at`) VALUES
(1, 'Calendar', 'ALL_TENANTS', 0, 'Manage events for all system users', '2023-08-02 22:25:45', '2023-08-02 22:25:45'),
(2, 'Calendar', 'USER_TENANT', 1, 'Manage events for host users only', '2023-08-02 22:25:45', '2023-08-02 22:25:45'),
(3, 'Calendar', 'PERSONAL', 2, 'Manage personal events only', '2023-08-02 22:25:45', '2023-08-02 22:25:45'),
(4, 'Chat', 'ALL_TENANTS', 0, 'Can chat with any system user', '2023-08-02 22:25:45', '2023-08-02 22:25:45'),
(5, 'Chat', 'HOST_CHAT_USERS', 1, 'Can chat only with enabled host users', '2023-08-02 22:25:45', '2023-08-02 22:25:45'),
(6, 'Help & FAQ', 'ALL_CONTENT', 0, 'Manage all content', '2023-08-02 22:25:45', '2023-08-02 22:25:45'),
(7, 'Custom Pages', 'ALL_CONTENT', 0, 'Manage all content', '2023-08-02 22:25:45', '2023-08-02 22:25:45'),
(8, 'News Feeds', 'ALL_CONTENT', 0, 'Manage all posts', '2023-08-02 22:25:48', '2023-08-02 22:25:48');

-- --------------------------------------------------------

--
-- Table structure for table `navigations`
--

CREATE TABLE `navigations` (
  `id` bigint UNSIGNED NOT NULL,
  `order_no` int NOT NULL DEFAULT '0',
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `data_source` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `show_top_menu` tinyint(1) NOT NULL DEFAULT '1',
  `show_nav_menu` tinyint(1) NOT NULL DEFAULT '1',
  `layout_definition_id` int NOT NULL DEFAULT '0',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `eform_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `adv_config` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `navigations`
--

INSERT INTO `navigations` (`id`, `order_no`, `title`, `content_type`, `data_source`, `show_top_menu`, `show_nav_menu`, `layout_definition_id`, `icon`, `created_at`, `updated_at`, `eform_url`, `adv_config`) VALUES
(1, 0, 'Tasks', 'All workflow views', 'List all Workflow views', 1, 1, 1, 'fas fa-briefcase', '2023-08-02 22:25:52', '2023-08-02 22:25:52', NULL, '0'),
(2, 0, 'Calendar', 'Calendar', 'Standard Calendar', 1, 1, 1, 'fas fa-calendar-alt', '2023-08-02 22:25:52', '2023-08-02 22:25:52', NULL, '0'),
(3, 0, 'Forms', 'Forms', 'Available Forms', 1, 1, 2, 'fab fa-wpforms', '2023-08-02 22:25:52', '2023-08-02 22:25:52', NULL, '0'),
(4, 1, 'Download Center', 'File downloads', 'Standard downloads', 1, 1, 1, 'fas fa-cloud-download-alt', '2023-08-02 22:33:04', '2023-08-02 22:33:04', '', '0');

-- --------------------------------------------------------

--
-- Table structure for table `newsfeeds`
--

CREATE TABLE `newsfeeds` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `image_placement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt_length` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tenants` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` bigint UNSIGNED NOT NULL,
  `batch_id` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `batch_id`, `notes`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '1cb6853c-80d2-3080-9ddd-b980996a463e', 'Nulla natus amet pariatur aperiam itaque facilis omnis cupiditate. Aspernatur qui minima in ut. Quia aut voluptates et.', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52'),
(2, 'd49ecf3a-57e1-3a39-84c6-7da4fc665b16', 'Quisquam praesentium et quidem. Nobis tempora a vitae. Odio inventore tempore culpa soluta velit esse.', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52'),
(3, 'a9638935-46d9-373a-a96f-8fb473c12466', 'Ex ipsum enim sunt qui est voluptatem. Animi quia quas odio in est velit. Rerum beatae officia tempora qui est adipisci fugit et. Est aut mollitia fuga architecto architecto.', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52'),
(4, '7132d071-e903-3a54-8df0-a873d24e4fba', 'Asperiores qui commodi molestiae delectus temporibus aut. Ex vero dolore quis voluptatem esse. Vero quo sunt quo ab voluptatum fugiat. Ut aperiam dolores unde tenetur.', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52'),
(5, 'e1082f5e-01e2-3d3e-8b9c-f6e833a04720', 'Explicabo inventore perspiciatis architecto repellendus corrupti inventore. Expedita autem rerum molestias vel qui. Illo voluptates et minus eius voluptates et. Magnam qui repellendus voluptate unde.', 1, '2023-08-02 22:25:52', '2023-08-02 22:25:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_version` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_version`, `product_name`, `created_at`, `created_by`, `updated_at`) VALUES
(1, 'ILINX 9.1', 'Test Product', '2023-08-03 07:06:44', 2, '2023-08-21 06:28:13'),
(2, 'ILINX 9.1', 'Test', '2023-08-03 07:27:09', 2, '2023-08-21 06:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `product_permissions`
--

CREATE TABLE `product_permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` int DEFAULT NULL,
  `tenant_id` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `rest_integrations`
--

CREATE TABLE `rest_integrations` (
  `id` bigint UNSIGNED NOT NULL,
  `parent_id` int NOT NULL DEFAULT '0' COMMENT '0 for authentication integration, others are child configuration such as search/list configuration and opening document configuration',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `rest_endpoint_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_authentication` int NOT NULL DEFAULT '0' COMMENT '0 means on and 1 means off',
  `http_username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `http_password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `custom_http_headers` int NOT NULL DEFAULT '1' COMMENT '0 means on and 1 means off',
  `http_headers` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `data_format` int NOT NULL DEFAULT '0' COMMENT '0 means Send Key-Value Pairs and 1 means Send Raw Data',
  `data_parameter` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `result_list` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `integration_type` int NOT NULL DEFAULT '0' COMMENT '0 means authentication integration, 1 search/list configuration, 2 means opening document configuration',
  `basic_details` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `details_type` int NOT NULL DEFAULT '0' COMMENT '0 means no details, 1 means basic details, 2 open document',
  `created_by` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rest_integrations`
--

INSERT INTO `rest_integrations` (`id`, `parent_id`, `name`, `rest_endpoint_url`, `http_method`, `http_authentication`, `http_username`, `http_password`, `custom_http_headers`, `http_headers`, `data_format`, `data_parameter`, `result_list`, `integration_type`, `basic_details`, `created_at`, `updated_at`, `details_type`, `created_by`) VALUES
(1, 0, 'Dr. Elenora O\'Kon', 'http://www.legros.com/vitae-accusantium-quis-nam-blanditiis.html', 'post', 0, 'koepp.margot', '5PjT9SwHER', 1, '{\"Content-Type\": \"application/json\"}', 0, '', '[]', 0, '[]', '2023-08-02 22:25:52', '2023-08-02 22:25:52', 2, 1),
(2, 1, 'Verdie Ziemann PhD', 'http://www.gerlach.com/sit-totam-aperiam-doloribus-dolores-voluptates-repellendus-sint-ut', 'put', 0, 'klowe', 'rTRcFMlS6Y', 1, '{\"Content-Type\": \"application/json\"}', 0, '', '[]', 2, '[]', '2023-08-02 22:25:52', '2023-08-02 22:25:52', 2, 1),
(3, 0, 'Brisa Gusikowski MD', 'https://ward.info/est-quia-omnis-nam-aut-voluptates-ut.html', 'put', 1, 'qabernathy', 'RmgS5RgW2y', 0, '{\"Content-Type\": \"application/json\"}', 1, '', '[]', 0, '[]', '2023-08-02 22:25:52', '2023-08-02 22:25:52', 1, 1),
(4, 1, 'Carole Carter Jr.', 'http://www.goodwin.com/optio-ex-dolor-quia-voluptatibus-fugit', 'put', 1, 'ritchie.ada', 'jAPnquu8Yb', 1, '{\"Content-Type\": \"application/json\"}', 1, '', '[]', 2, '[]', '2023-08-02 22:25:52', '2023-08-02 22:25:52', 2, 1),
(5, 1, 'Dr. Nils Farrell', 'http://okeefe.com/', 'post', 1, 'rodrick.bogisich', 'wk1DGJRCyL', 1, '{\"Content-Type\": \"application/json\"}', 0, '', '[]', 0, '[]', '2023-08-02 22:25:52', '2023-08-02 22:25:52', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('yhkEMF3XZONwi6CAEAUfkoXMC84l2u1oE02gQ30l', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjY6Il90b2tlbiI7czo0MDoiZnROVU9SdlVDMzRKZnFVSXRmQXhJWnVrTFdQbEVmNUV2VzRVRWpLSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9ob21lIjt9czoxMToiaGVhZGVyX3RleHQiO3M6MDoiIjt9', 1694424281);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'footer_text', '© 2023 ImageSource', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(2, 'footer_link_1', 'Support', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(3, 'footer_value_1', '#', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(4, 'footer_link_2', 'Terms', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(5, 'footer_value_2', '#', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(6, 'footer_link_3', 'Privacy', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(7, 'footer_value_3', 'https://ilinx.com/privacypolicy/', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(8, 'max_docs_homepage_cards', '5', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(9, 'max_tasks_homepage_cards', '5', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(10, 'welcome_message', 'Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(11, 'document_menu', 'Documents', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(12, 'task_menu', 'Tasks', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(13, 'activities_menu', 'Activities', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(14, 'help_menu', 'Help Center', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(15, 'salutation', '[Good morning|afternoon|evening]', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(16, 'single_task_work_item', 'Task', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(17, 'plural_task_work_item', 'Tasks', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(18, 'help_center_text', '<p><span style=\"\\&quot;margin:\" 0px;=\"\" padding:=\"\" font-family:=\"\" &quot;open=\"\" sans&quot;,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\\\"=\"\">Lorem Ipsum</span><span style=\"\\&quot;font-family:\" &quot;open=\"\" sans&quot;,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\\\"=\"\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p><p><span style=\"\\&quot;font-family:\" &quot;open=\"\" sans&quot;,=\"\" arial,=\"\" sans-serif;=\"\" font-size:=\"\" 14px;=\"\" text-align:=\"\" justify;\\\"=\"\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</span></p>', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(19, 'folder_menu', 'Files', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(20, 'terms_conditions', '#', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(21, 'welcome_message_ext', '<p>Hello World Test Demo External</p>', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(22, 'welcome_message_int', '<p>Hello World Test Demo Internal</p>', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(23, 'sidebar_editor', '<p style=\"line-height: 1;\"><br></p><h6 style=\"text-align: center; line-height: 1;\"></h6><h6><div style=\"text-align: center;\"><b style=\"font-family: inherit; font-size: 1rem; color: rgb(0, 0, 0);\">FREE RESOURCE</b></div><b><div style=\"text-align: center;\"><b style=\"font-family: inherit; font-size: 1rem; color: rgb(0, 0, 0);\">LIBRARY</b></div></b></h6><p style=\"text-align: center; line-height: 1;\"><span style=\"font-size: 12px;\">Start getting a breakthrough with your<br></span><span style=\"font-size: 12px;\">blog today.</span></p><p style=\"text-align: center; line-height: 1;\"><span style=\"font-size: 12px;\"><br></span></p><p style=\"text-align: center; line-height: 1;\"><a href=\"http://www.google.com\" target=\"_blank\" style=\"padding: 10px; color: rgb(255, 255, 255); background-color: rgb(231, 99, 99);\">GET ACCESS</a><br></p>', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(24, 'sidebar_editor_bg', '#df1111', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(25, 'sidebar_editor_style', 'bg_gradient', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(26, 'bg_gradient', 'bg-gradient-warning', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50'),
(27, 'no_password_reset_message', 'We have received a request to reset your password however, your account password is not managed by ILINX and cannot be reset through the ILINX system. Please contact your company’s system administrator for help with resetting your password.', 1, '2023-08-02 22:25:50', '2023-08-02 22:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `sso_configurations`
--

CREATE TABLE `sso_configurations` (
  `id` bigint UNSIGNED NOT NULL,
  `sso_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `issuer_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `logout_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `key_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `autocreate_authenticated_users` tinyint(1) NOT NULL DEFAULT '0',
  `tenant_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` bigint UNSIGNED NOT NULL,
  `tenant_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_status` int NOT NULL DEFAULT '0' COMMENT '1 = Active, 0 = Deactive',
  `message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `primary_contact` int DEFAULT NULL,
  `require_two_factor_authentication` tinyint(1) NOT NULL DEFAULT '0',
  `logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_theme` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_format` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `day_start` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_activities` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `data` json DEFAULT NULL,
  `authentication_service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ilinx',
  `branding_level` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'none',
  `small_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `manage_news_posts` int NOT NULL DEFAULT '0',
  `poweredby_logo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `tenant_id`, `company_name`, `company_phone`, `address`, `city`, `state`, `zip`, `account_status`, `message`, `primary_contact`, `require_two_factor_authentication`, `logo`, `banner_type`, `banner`, `header_text`, `default_theme`, `date_format`, `day_start`, `show_activities`, `created_at`, `updated_at`, `data`, `authentication_service`, `branding_level`, `small_logo`, `manage_news_posts`, `poweredby_logo`) VALUES
(1, 'host', 'ImageSource', '(132)530-6535', NULL, NULL, NULL, NULL, 1, NULL, NULL, 0, 'logo/host/logo.png', NULL, 'logo/host/banner.png', NULL, NULL, 'm/d/Y', '08:00', 0, '2023-08-02 22:25:48', '2023-08-10 00:11:53', NULL, 'ilinx', 'none', NULL, 0, NULL),
(2, 'sso_okta', 'Okta', '(132)530-6535', NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-08-02 22:25:48', '2023-08-02 22:25:48', NULL, 'sso_okta', 'none', NULL, 0, NULL),
(3, 'sso_aad', 'Microsoft Azure Active Directory (AA)', '(132)530-6535', NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2023-08-02 22:25:48', '2023-08-02 22:25:48', NULL, 'sso_aad', 'none', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `two_factor_authentication_codes`
--

CREATE TABLE `two_factor_authentication_codes` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'en',
  `created_by` int NOT NULL DEFAULT '0',
  `account_type` smallint NOT NULL DEFAULT '0' COMMENT '0 = customer/client, 1 = internal admin, 2 = internal non-admin, 3 = public, 4 = external admin',
  `account_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `account_status_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `chat_user` smallint NOT NULL DEFAULT '0',
  `last_login_at` datetime DEFAULT NULL,
  `password_change_at` datetime DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notifications_read` datetime DEFAULT NULL,
  `communication_channel` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `texting_number` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `messenger_color` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '#2180f3',
  `dark_mode` tinyint(1) NOT NULL DEFAULT '0',
  `active_status` tinyint(1) NOT NULL DEFAULT '0',
  `layout_definition` bigint UNSIGNED DEFAULT NULL,
  `ilinx_user_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `password`, `avatar`, `lang`, `created_by`, `account_type`, `account_status`, `account_status_message`, `chat_user`, `last_login_at`, `password_change_at`, `phone`, `notifications_read`, `communication_channel`, `texting_number`, `tenant_id`, `remember_token`, `created_at`, `updated_at`, `messenger_color`, `dark_mode`, `active_status`, `layout_definition`, `ilinx_user_type`) VALUES
(1, 'Vida Hudson Sr.', 'teamdevsquad', 'team@devsquad.com', NULL, '$2y$10$QK3B1fbcbXvYWi4IJlND4OqjAnx6L3Rqhaid4zrff7CFN5qKRUCiK', '', 'hr', 0, 1, 'active', 'Quo ut tenetur voluptas.', 2, '2012-12-31 16:00:18', '2000-02-20 12:02:32', '445.650.0854', '2011-01-02 18:32:31', 'slack', 'officia', 'host', NULL, '2023-08-02 22:25:48', '2023-08-02 22:25:48', '#2180f3', 0, 0, NULL, NULL),
(2, 'Casey Adminner', 'caseadmin', 'case@admin.com', NULL, '$2y$10$H0a4Kw9EyuRseopb2YfM6OBRTtG3o1J2Zl.63O9OoZbKi5XHUKbam', NULL, 'en', 0, 1, 'active', NULL, 0, '2023-09-11 05:33:22', NULL, NULL, '2023-09-11 07:46:40', NULL, NULL, 'host', NULL, '2023-08-02 22:25:48', '2023-09-11 02:16:40', '#2180f3', 0, 0, 1, NULL),
(3, 'VN regular user 1', 'vnr1', 'randyw@imagesourceinc.com', NULL, '$2y$10$H0a4Kw9EyuRseopb2YfM6OBRTtG3o1J2Zl.63O9OoZbKi5XHUKbam', NULL, 'en', 0, 1, 'active', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'host', NULL, '2023-08-02 22:25:48', '2023-08-02 22:25:48', '#2180f3', 0, 0, NULL, NULL),
(4, 'Casey Nonadminner', 'casenonadmin', 'case@casenonadmin.com', NULL, '$2y$10$H0a4Kw9EyuRseopb2YfM6OBRTtG3o1J2Zl.63O9OoZbKi5XHUKbam', NULL, 'en', 0, 2, 'active', NULL, 0, '2023-08-03 07:05:56', NULL, NULL, '2023-08-03 08:11:39', NULL, NULL, 'host', NULL, '2023-08-02 22:25:48', '2023-08-03 02:41:39', '#2180f3', 0, 0, 1, NULL),
(5, 'VN regular user 2', 'vnr2', 'vnr2@bbb.com', NULL, '$2y$10$H0a4Kw9EyuRseopb2YfM6OBRTtG3o1J2Zl.63O9OoZbKi5XHUKbam', NULL, 'en', 0, 2, 'active', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, 'host', NULL, '2023-08-02 22:25:48', '2023-08-02 22:25:48', '#2180f3', 0, 0, NULL, NULL),
(6, 'Luciano Rohan', 'brennon49', 'hosea78@example.org', NULL, '$2y$10$yTibrVdF0JYWREx82BUAG.HiyrDxXMzzIVMcvSTydnxBcq2CNpbs6', '', 'ar', 0, 3, 'inactive', 'Vero cupiditate dolorem eaque.', 4, '2004-05-27 13:48:15', '1992-04-25 21:06:27', '+1-704-512-2560', '2010-06-01 14:09:50', 'slack', 'reiciendis', 'host', NULL, '2023-08-02 22:25:49', '2023-08-02 22:25:49', '#2180f3', 0, 0, NULL, NULL),
(7, 'Markus Ledner', 'hagenes.noah', 'tyree.hirthe@example.com', NULL, '$2y$10$C/ZKeUnNJ9tJtGcn1uGgPuSicHd8wWP/m5dcIE6J632uh.DNN7y0.', '', 'an', 0, 1, 'inactive', 'Eligendi ratione numquam atque sunt porro.', 2, '2019-03-28 20:16:14', '2007-11-07 14:43:42', '513.961.0383', '1980-07-28 15:28:46', 'slack', 'assumenda', 'host', NULL, '2023-08-02 22:25:49', '2023-08-02 22:25:49', '#2180f3', 0, 0, NULL, NULL),
(8, 'Catalina Rohan', 'ilind', 'monica.hodkiewicz@example.net', NULL, '$2y$10$baKjPYVQYckeWE1dJ0sJU.ZUIXRHX1ztGMSf0A0ptWuKsrUGgSxBO', '', 'hy', 0, 4, 'active', 'Odit porro eum porro at quia cum dolorem.', 1, '2018-07-17 09:05:28', '1986-07-14 12:21:42', '380.820.9347', '1974-12-10 19:02:16', 'telegram', 'rerum', 'host', NULL, '2023-08-02 22:25:49', '2023-08-02 22:25:49', '#2180f3', 0, 0, NULL, NULL),
(9, 'Dr. Mohammad Graham PhD', 'jayson.maggio', 'addie07@example.com', NULL, '$2y$10$vJRhWJ/OIDNl4OAirXTPueoVzFZLQTGWm3wZnIRjIWA4AEBixvRM.', '', 'lb', 0, 2, 'active', 'Enim nulla vel libero aperiam.', 3, '1974-04-14 18:04:37', '1989-02-07 19:52:28', '+1-713-731-9908', '1979-03-16 22:00:14', 'instagram', 'necessitatibus', 'host', NULL, '2023-08-02 22:25:49', '2023-08-02 22:25:49', '#2180f3', 0, 0, NULL, NULL),
(10, 'Torey Reilly', 'prohaska.bryon', 'zgusikowski@example.org', NULL, '$2y$10$.E02b2OkPetviMaABV4k.u0UTgZyf1XSa5aFX86bwxgPUb8JKIMQa', '', 'gn', 0, 1, 'active', 'Quis et exercitationem quia nobis eius distinctio.', 3, '2007-05-14 03:34:29', '2018-08-08 06:25:58', '1-978-404-8846', '1973-12-22 17:12:42', 'instagram', 'perspiciatis', 'host', NULL, '2023-08-02 22:25:49', '2023-08-02 22:25:49', '#2180f3', 0, 0, NULL, NULL),
(11, 'Shanny Maggio', 'friesen.keeley', 'schroeder.dorian@example.net', NULL, '$2y$10$4.9j4tOdSsXDlE31ngYSteQ3CvHaGB5tx9QgtRvaIFqKsZTP/oSXu', '', 'st', 0, 1, 'inactive', 'Doloremque voluptates odit aut dicta dolorem.', 1, '1982-02-28 03:25:06', '2010-10-24 05:03:17', '+1-478-622-4100', '1993-10-14 02:21:16', 'telegram', 'nulla', 'sso_okta', NULL, '2023-08-02 22:25:49', '2023-08-02 22:25:49', '#2180f3', 0, 0, NULL, NULL),
(12, 'Ines Corwin', 'tlindgren', 'lemke.alanna@example.org', NULL, '$2y$10$WZnBrnxgL7h3DuOtyg7/FOHl6eR8rQAonJI5hzV2.RMqctTZxIhRm', '', 'dz', 0, 4, 'active', 'Distinctio iure eos tempora odio.', 2, '1998-11-21 23:10:20', '1999-08-27 03:11:21', '1-702-357-7934', '1982-09-12 09:22:01', 'slack', 'a', 'sso_okta', NULL, '2023-08-02 22:25:49', '2023-08-02 22:25:49', '#2180f3', 0, 0, NULL, NULL),
(13, 'Fritz Jerde', 'shields.cierra', 'sincere39@example.com', NULL, '$2y$10$f.NLMfQJDqN4N7N6VXJQcOzuEjIlpE0Vn2BSyDKoI897gcDi/n1Dy', '', 'bs', 0, 1, 'inactive', 'Et dolores et dolorem et.', 4, '1976-12-04 17:43:32', '1985-08-24 21:33:51', '(925) 937-1032', '2019-02-05 03:54:26', 'slack', 'at', 'sso_okta', NULL, '2023-08-02 22:25:49', '2023-08-02 22:25:49', '#2180f3', 0, 0, NULL, NULL),
(14, 'Zita Lesch', 'vgleason', 'lisa.fritsch@example.net', NULL, '$2y$10$bCcSI/pX30BnzifrjEtTfOUypOrDPlXWdCZa6xkhnRewS8EsT2.6K', '', 'id', 0, 0, 'active', 'Fugiat quod eligendi neque accusamus culpa totam dolores quasi.', 4, '1993-05-15 03:13:04', '1999-12-15 14:21:46', '+1-828-515-6727', '1990-03-28 11:25:02', 'telegram', 'et', 'sso_okta', NULL, '2023-08-02 22:25:49', '2023-08-02 22:25:49', '#2180f3', 0, 0, NULL, NULL),
(15, 'Christop Kris IV', 'rohan.oceane', 'name09@example.org', NULL, '$2y$10$pub7tsaTzMDr059oDnF03uo7DrtxyRNWlB8z6.0YUaUVHbBDcpsuK', '', 'oj', 0, 4, 'inactive', 'Ut tenetur error dignissimos voluptas ea.', 0, '2013-07-11 20:32:36', '1977-10-07 19:44:22', '848.244.1387', '2013-12-17 10:03:45', 'instagram', 'ullam', 'sso_okta', NULL, '2023-08-02 22:25:49', '2023-08-02 22:25:49', '#2180f3', 0, 0, NULL, NULL),
(16, 'Carole Lehner', 'dcorkery', 'ehane@example.net', NULL, '$2y$10$r9xSqdnBhfSr.NSTnZ/wVuQiPiBs5.AfUEiTtD.PnWSMcr8OMPvHG', '', 'os', 0, 1, 'active', 'Eos voluptatum dignissimos consequuntur quis quia ut commodi ipsa.', 2, '2022-09-01 23:23:40', '2011-01-02 13:16:11', '(210) 214-4956', '2011-10-29 18:06:22', 'slack', 'et', 'sso_aad', NULL, '2023-08-02 22:25:50', '2023-08-02 22:25:50', '#2180f3', 0, 0, NULL, NULL),
(17, 'Chelsie Hickle', 'marlin05', 'xgleichner@example.net', NULL, '$2y$10$l7Kf.SjbmOH7oKMfKYniqOc2MCrrZjBeEZPlgkmEDWSZMq6dhnaM2', '', 'ca', 0, 2, 'active', 'Eos inventore libero asperiores debitis quis eum.', 1, '1983-11-28 00:01:07', '1975-07-12 21:05:27', '+1-253-885-3816', '1983-12-27 09:16:47', 'telegram', 'ut', 'sso_aad', NULL, '2023-08-02 22:25:50', '2023-08-02 22:25:50', '#2180f3', 0, 0, NULL, NULL),
(18, 'Ayla Fadel', 'nikolaus.kamren', 'juwan.kshlerin@example.com', NULL, '$2y$10$/ZJEOBYlEsLc2hjBeYqZMuj2/QXTox2Mm01LbV6YqfHnEOY6/pHzy', '', 'or', 0, 3, 'inactive', 'Nulla eius sunt ex delectus et quia odio.', 4, '1979-02-26 12:26:29', '1993-09-30 10:27:52', '+1 (410) 533-0230', '2012-07-29 20:06:30', 'instagram', 'quia', 'sso_aad', NULL, '2023-08-02 22:25:50', '2023-08-02 22:25:50', '#2180f3', 0, 0, NULL, NULL),
(19, 'Myrtis Wyman', 'regan.kunde', 'evalyn15@example.net', NULL, '$2y$10$9OXBsp9l0JrSu1m1aN5a2.Dr54ALIb15wS8iFXY3BtLVU.dfnPg/e', '', 'ln', 0, 2, 'active', 'Quaerat et sit pariatur repudiandae.', 1, '1981-04-19 17:21:37', '2021-01-15 14:13:19', '337-330-4071', '2009-08-13 03:57:23', 'slack', 'ad', 'sso_aad', NULL, '2023-08-02 22:25:50', '2023-08-02 22:25:50', '#2180f3', 0, 0, NULL, NULL),
(20, 'Hardy Mraz', 'volkman.miles', 'emilie72@example.org', NULL, '$2y$10$KX1/iRfuDTt8RCZajAKO7.xXJfEHlQy6f8JSo39dPNkRzaefzdJGm', '', 'ii', 0, 4, 'active', 'Officia aut molestiae minima fugiat voluptatum autem.', 4, '1993-12-23 02:22:46', '2005-11-28 04:26:45', '+1-970-304-3371', '2009-09-29 11:40:17', 'instagram', 'facere', 'sso_aad', NULL, '2023-08-02 22:25:50', '2023-08-02 22:25:50', '#2180f3', 0, 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE `user_notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_color` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `link_type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tenant_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scope` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `type`, `link_title`, `link_color`, `link_url`, `link_type`, `created_at`, `updated_at`, `username`, `tenant_id`, `scope`, `text`) VALUES
(1, 'random2', 'cupiditate', 'green', 'http://www.johnson.com/est-consequatur-quaerat-nesciunt-ducimus-blanditiis-neque-voluptas.html', 'type1', '2023-08-02 22:25:52', '2023-08-02 22:25:52', 'teamdevsquad', 'host', 'system', 'Ab officiis beatae delectus et commodi perspiciatis qui quis.'),
(2, 'random2', 'molestias', 'blue', 'http://christiansen.com/', 'type1', '2023-08-02 22:25:52', '2023-08-02 22:25:52', 'teamdevsquad', 'host', 'system', 'Rerum et veniam iste necessitatibus quia.'),
(3, 'random1', 'et', 'red', 'http://upton.net/', 'type1', '2023-08-02 22:25:52', '2023-08-02 22:25:52', 'teamdevsquad', 'host', 'system', 'Beatae voluptatem aut officia velit occaecati ab veritatis aut.'),
(4, 'random2', 'et', 'green', 'http://www.keeling.biz/officia-et-provident-quis-assumenda', 'type2', '2023-08-02 22:25:52', '2023-08-02 22:25:52', 'teamdevsquad', 'host', 'system', 'Assumenda ea ea magnam earum eveniet.'),
(5, 'random2', 'exercitationem', 'green', 'http://russel.net/magni-atque-et-dicta-sapiente-quia-eius', 'type3', '2023-08-02 22:25:52', '2023-08-02 22:25:52', 'teamdevsquad', 'host', 'tenant', 'Facere ut velit quasi dolores.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calendars_created_by_index` (`created_by`);

--
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calls_user_id_index` (`user_id`);

--
-- Indexes for table `case_notes`
--
ALTER TABLE `case_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `case_notes_created_by_index` (`created_by`);

--
-- Indexes for table `chart_datasources`
--
ALTER TABLE `chart_datasources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ch_favorites_user_id_index` (`user_id`);

--
-- Indexes for table `ch_messages`
--
ALTER TABLE `ch_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_pages`
--
ALTER TABLE `custom_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `custom_pages_created_by_index` (`created_by`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `discussions_created_by_index` (`created_by`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emails_created_by_index` (`created_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `file_download_history`
--
ALTER TABLE `file_download_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ird_delivery_jobs`
--
ALTER TABLE `ird_delivery_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ird_settings`
--
ALTER TABLE `ird_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ird_settings_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `ird_solicitation_emails`
--
ALTER TABLE `ird_solicitation_emails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ird_solicitation_emails_created_by_index` (`created_by`);

--
-- Indexes for table `ird_statistics`
--
ALTER TABLE `ird_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ird_time_tracking`
--
ALTER TABLE `ird_time_tracking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ird_time_tracking_created_by_index` (`created_by`);

--
-- Indexes for table `layouts`
--
ALTER TABLE `layouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `layout_definitions`
--
ALTER TABLE `layout_definitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_permission_assignments`
--
ALTER TABLE `module_permission_assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_permission_defs`
--
ALTER TABLE `module_permission_defs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `navigations`
--
ALTER TABLE `navigations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsfeeds`
--
ALTER TABLE `newsfeeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_created_by_index` (`created_by`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_permissions`
--
ALTER TABLE `product_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `qapp_definitions`
--
ALTER TABLE `qapp_definitions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rest_integrations`
--
ALTER TABLE `rest_integrations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rest_integrations_created_by_index` (`created_by`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `settings_created_by_index` (`created_by`);

--
-- Indexes for table `sso_configurations`
--
ALTER TABLE `sso_configurations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sso_configurations_tenant_id_foreign` (`tenant_id`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tenants_tenant_id_unique` (`tenant_id`);

--
-- Indexes for table `two_factor_authentication_codes`
--
ALTER TABLE `two_factor_authentication_codes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `two_factor_authentication_codes_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_tenant_id_foreign` (`tenant_id`),
  ADD KEY `users_layout_definition_foreign` (`layout_definition`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `calendars`
--
ALTER TABLE `calendars`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `case_notes`
--
ALTER TABLE `case_notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chart_datasources`
--
ALTER TABLE `chart_datasources`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ch_messages`
--
ALTER TABLE `ch_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_pages`
--
ALTER TABLE `custom_pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `file_download_history`
--
ALTER TABLE `file_download_history`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ird_delivery_jobs`
--
ALTER TABLE `ird_delivery_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ird_settings`
--
ALTER TABLE `ird_settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ird_solicitation_emails`
--
ALTER TABLE `ird_solicitation_emails`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ird_statistics`
--
ALTER TABLE `ird_statistics`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ird_time_tracking`
--
ALTER TABLE `ird_time_tracking`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `layouts`
--
ALTER TABLE `layouts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `layout_definitions`
--
ALTER TABLE `layout_definitions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `module_permission_assignments`
--
ALTER TABLE `module_permission_assignments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `module_permission_defs`
--
ALTER TABLE `module_permission_defs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `navigations`
--
ALTER TABLE `navigations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `newsfeeds`
--
ALTER TABLE `newsfeeds`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_permissions`
--
ALTER TABLE `product_permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `qapp_definitions`
--
ALTER TABLE `qapp_definitions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rest_integrations`
--
ALTER TABLE `rest_integrations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `sso_configurations`
--
ALTER TABLE `sso_configurations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `two_factor_authentication_codes`
--
ALTER TABLE `two_factor_authentication_codes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calendars`
--
ALTER TABLE `calendars`
  ADD CONSTRAINT `calendars_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `calls`
--
ALTER TABLE `calls`
  ADD CONSTRAINT `calls_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `case_notes`
--
ALTER TABLE `case_notes`
  ADD CONSTRAINT `case_notes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ch_favorites`
--
ALTER TABLE `ch_favorites`
  ADD CONSTRAINT `ch_favorites_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `custom_pages`
--
ALTER TABLE `custom_pages`
  ADD CONSTRAINT `custom_pages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `discussions`
--
ALTER TABLE `discussions`
  ADD CONSTRAINT `discussions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emails`
--
ALTER TABLE `emails`
  ADD CONSTRAINT `emails_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ird_settings`
--
ALTER TABLE `ird_settings`
  ADD CONSTRAINT `ird_settings_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ird_solicitation_emails`
--
ALTER TABLE `ird_solicitation_emails`
  ADD CONSTRAINT `ird_solicitation_emails_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ird_time_tracking`
--
ALTER TABLE `ird_time_tracking`
  ADD CONSTRAINT `ird_time_tracking_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rest_integrations`
--
ALTER TABLE `rest_integrations`
  ADD CONSTRAINT `rest_integrations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `settings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sso_configurations`
--
ALTER TABLE `sso_configurations`
  ADD CONSTRAINT `sso_configurations_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `two_factor_authentication_codes`
--
ALTER TABLE `two_factor_authentication_codes`
  ADD CONSTRAINT `two_factor_authentication_codes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_layout_definition_foreign` FOREIGN KEY (`layout_definition`) REFERENCES `layout_definitions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_tenant_id_foreign` FOREIGN KEY (`tenant_id`) REFERENCES `tenants` (`tenant_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
