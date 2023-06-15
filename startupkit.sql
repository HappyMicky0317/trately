-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2022 at 10:12 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `startup_kit`
--

-- --------------------------------------------------------

--
-- Table structure for table `brain_storms`
--

CREATE TABLE `brain_storms` (
                                `id` bigint(20) UNSIGNED NOT NULL,
                                `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                                `workspace_id` int(10) UNSIGNED NOT NULL,
                                `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `src` longtext COLLATE utf8mb4_unicode_ci,
                                `description` text COLLATE utf8mb4_unicode_ci,
                                `shareable_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `is_public` tinyint(1) NOT NULL DEFAULT '0',
                                `sort_order` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                `group_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_models`
--

CREATE TABLE `business_models` (
                                   `id` bigint(20) UNSIGNED NOT NULL,
                                   `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `workspace_id` int(10) UNSIGNED NOT NULL,
                                   `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                   `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                   `partners` text COLLATE utf8mb4_unicode_ci,
                                   `activities` text COLLATE utf8mb4_unicode_ci,
                                   `resources` text COLLATE utf8mb4_unicode_ci,
                                   `value_propositions` text COLLATE utf8mb4_unicode_ci,
                                   `customer_relationships` text COLLATE utf8mb4_unicode_ci,
                                   `channels` text COLLATE utf8mb4_unicode_ci,
                                   `customer_segments` text COLLATE utf8mb4_unicode_ci,
                                   `cost_structure` text COLLATE utf8mb4_unicode_ci,
                                   `revenue_stream` text COLLATE utf8mb4_unicode_ci,
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `business_plans`
--

CREATE TABLE `business_plans` (
                                  `id` bigint(20) UNSIGNED NOT NULL,
                                  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `workspace_id` int(10) UNSIGNED NOT NULL,
                                  `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `date` date DEFAULT NULL,
                                  `website` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                  `description` text COLLATE utf8mb4_unicode_ci,
                                  `ex_summary` text COLLATE utf8mb4_unicode_ci,
                                  `m_analysis` text COLLATE utf8mb4_unicode_ci,
                                  `management` text COLLATE utf8mb4_unicode_ci,
                                  `product` text COLLATE utf8mb4_unicode_ci,
                                  `marketing` text COLLATE utf8mb4_unicode_ci,
                                  `budget` text COLLATE utf8mb4_unicode_ci,
                                  `investment` text COLLATE utf8mb4_unicode_ci,
                                  `finance` text COLLATE utf8mb4_unicode_ci,
                                  `appendix` text COLLATE utf8mb4_unicode_ci,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE `calendars` (
                             `id` bigint(20) UNSIGNED NOT NULL,
                             `workspace_id` int(10) UNSIGNED NOT NULL,
                             `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                             `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `start_date` datetime DEFAULT NULL,
                             `end_date` datetime DEFAULT NULL,
                             `description` text COLLATE utf8mb4_unicode_ci,
                             `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE `credit_cards` (
                                `id` bigint(20) UNSIGNED NOT NULL,
                                `user_id` int(10) UNSIGNED NOT NULL,
                                `gateway_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                `gateway_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
                             `id` bigint(20) UNSIGNED NOT NULL,
                             `workspace_id` int(10) UNSIGNED NOT NULL,
                             `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                             `related_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `related_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                             `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                             `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
                               `id` bigint(20) UNSIGNED NOT NULL,
                               `workspace_id` int(10) UNSIGNED NOT NULL,
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
                                                          (286, '2021_07_03_221331_create_goal_plans_table', 1),
                                                          (287, '2021_07_03_233802_create_weekly_plans_table', 1),
                                                          (288, '2021_07_06_190721_create_to_learns_table', 1),
                                                          (291, '2021_07_07_162828_create_five_minute_journals_table', 1),
                                                          (294, '2021_07_11_135255_create_todos_table', 1),
                                                          (295, '2021_07_12_154443_create_goals_table', 1),
                                                          (304, '2022_02_24_160109_create_sticky_notes_table', 1),
                                                          (335, '2021_07_07_194524_create_images_table', 2),
                                                          (342, '2021_10_06_113130_create_newsletters_table', 2),
                                                          (518, '2014_10_12_000000_create_users_table', 3),
                                                          (519, '2014_10_12_100000_create_password_resets_table', 3),
                                                          (520, '2019_08_19_000000_create_failed_jobs_table', 3),
                                                          (521, '2021_06_13_173242_create_documents_table', 3),
                                                          (522, '2021_06_15_091441_create_settings_table', 3),
                                                          (523, '2021_07_06_212302_create_notes_table', 3),
                                                          (524, '2021_07_07_102711_create_projects_table', 3),
                                                          (525, '2021_07_08_175558_create_calendars_table', 3),
                                                          (526, '2021_07_27_190149_create_workspaces_table', 3),
                                                          (527, '2021_07_31_204942_create_subscription_plans_table', 3),
                                                          (528, '2021_08_02_202546_create_payment_gateways_table', 3),
                                                          (529, '2021_08_03_161432_create_credit_cards_table', 3),
                                                          (530, '2021_08_04_120944_create_business_plans_table', 3),
                                                          (531, '2022_02_19_121858_create_business_models_table', 3),
                                                          (532, '2022_02_23_185259_create_project_replies_table', 3),
                                                          (533, '2022_02_25_115453_create_swot_analyses_table', 3),
                                                          (534, '2022_03_08_192532_create_tasks_table', 3),
                                                          (535, '2022_03_08_192633_create_task_relations_table', 3),
                                                          (536, '2022_04_13_181434_create_pest_analyses_table', 3),
                                                          (537, '2022_04_15_161155_create_brain_storms_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `workspace_id` int(10) UNSIGNED NOT NULL,
                         `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                         `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `topic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `notes` text COLLATE utf8mb4_unicode_ci,
                         `cover_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `payment_gateways`
--

CREATE TABLE `payment_gateways` (
                                    `id` bigint(20) UNSIGNED NOT NULL,
                                    `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `api_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                    `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `api_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `api_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `api_password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `public_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `private_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `currency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                    `description` text COLLATE utf8mb4_unicode_ci,
                                    `instruction` text COLLATE utf8mb4_unicode_ci,
                                    `active` tinyint(1) NOT NULL DEFAULT '1',
                                    `live` tinyint(1) NOT NULL DEFAULT '1',
                                    `created_at` timestamp NULL DEFAULT NULL,
                                    `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pest_analyses`
--

CREATE TABLE `pest_analyses` (
                                 `id` bigint(20) UNSIGNED NOT NULL,
                                 `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `workspace_id` int(10) UNSIGNED NOT NULL,
                                 `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                 `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `political` text COLLATE utf8mb4_unicode_ci,
                                 `economic` text COLLATE utf8mb4_unicode_ci,
                                 `social` text COLLATE utf8mb4_unicode_ci,
                                 `technological` text COLLATE utf8mb4_unicode_ci,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
                            `id` bigint(20) UNSIGNED NOT NULL,
                            `workspace_id` int(10) UNSIGNED NOT NULL,
                            `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                            `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                            `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `start_date` date DEFAULT NULL,
                            `end_date` date DEFAULT NULL,
                            `status` enum('Pending','Started','Finished') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
                            `description` text COLLATE utf8mb4_unicode_ci,
                            `summary` text COLLATE utf8mb4_unicode_ci,
                            `message` longtext COLLATE utf8mb4_unicode_ci,
                            `members` text COLLATE utf8mb4_unicode_ci,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_replies`
--

CREATE TABLE `project_replies` (
                                   `id` bigint(20) UNSIGNED NOT NULL,
                                   `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                                   `workspace_id` int(10) UNSIGNED NOT NULL,
                                   `visitor_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                   `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                   `agent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                   `project_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                   `message` text COLLATE utf8mb4_unicode_ci,
                                   `is_private` tinyint(1) NOT NULL DEFAULT '0',
                                   `agent_can_view` tinyint(1) NOT NULL DEFAULT '1',
                                   `created_at` timestamp NULL DEFAULT NULL,
                                   `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
                            `id` bigint(20) UNSIGNED NOT NULL,
                            `workspace_id` int(10) UNSIGNED NOT NULL,
                            `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                            `value` text COLLATE utf8mb4_unicode_ci,
                            `created_at` timestamp NULL DEFAULT NULL,
                            `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `workspace_id`, `key`, `value`, `created_at`, `updated_at`) VALUES
    (1, 1, 'company_name', 'CloudOnex', '2022-04-19 08:11:44', '2022-04-19 08:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `sticky_notes`
--

CREATE TABLE `sticky_notes` (
                                `id` bigint(20) UNSIGNED NOT NULL,
                                `workspace_id` int(10) UNSIGNED NOT NULL,
                                `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                                `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `topic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `notes` text COLLATE utf8mb4_unicode_ci,
                                `cover_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                `created_at` timestamp NULL DEFAULT NULL,
                                `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sticky_notes`
--

INSERT INTO `sticky_notes` (`id`, `workspace_id`, `uuid`, `admin_id`, `title`, `topic`, `notes`, `cover_photo`, `created_at`, `updated_at`) VALUES
    (1, 1, 'dd1461cc-b219-45ef-8a4c-03d01ef9a927', 0, NULL, NULL, 'ff', NULL, '2022-03-08 21:14:37', '2022-03-08 21:14:37');

-- --------------------------------------------------------

--
-- Table structure for table `subscription_plans`
--

CREATE TABLE `subscription_plans` (
                                      `id` bigint(20) UNSIGNED NOT NULL,
                                      `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                      `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                      `price_monthly` decimal(8,2) UNSIGNED DEFAULT NULL,
                                      `price_yearly` decimal(8,2) UNSIGNED DEFAULT NULL,
                                      `price_two_years` decimal(8,2) UNSIGNED DEFAULT NULL,
                                      `price_three_years` decimal(8,2) UNSIGNED DEFAULT NULL,
                                      `description` text COLLATE utf8mb4_unicode_ci,
                                      `features` text COLLATE utf8mb4_unicode_ci,
                                      `modules` text COLLATE utf8mb4_unicode_ci,
                                      `maximum_allowed_users` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                      `has_modules` tinyint(1) NOT NULL DEFAULT '0',
                                      `free` tinyint(1) NOT NULL DEFAULT '0',
                                      `active` tinyint(1) NOT NULL DEFAULT '1',
                                      `featured` tinyint(1) NOT NULL DEFAULT '0',
                                      `per_user_pricing` tinyint(1) NOT NULL DEFAULT '0',
                                      `users_limit` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                      `created_at` timestamp NULL DEFAULT NULL,
                                      `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `swot_analyses`
--

CREATE TABLE `swot_analyses` (
                                 `id` bigint(20) UNSIGNED NOT NULL,
                                 `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                                 `workspace_id` int(10) UNSIGNED NOT NULL,
                                 `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                                 `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                                 `strengths` text COLLATE utf8mb4_unicode_ci,
                                 `weaknesses` text COLLATE utf8mb4_unicode_ci,
                                 `opportunities` text COLLATE utf8mb4_unicode_ci,
                                 `threats` text COLLATE utf8mb4_unicode_ci,
                                 `created_at` timestamp NULL DEFAULT NULL,
                                 `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `workspace_id` int(10) UNSIGNED NOT NULL,
                         `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                         `owner_id` int(10) UNSIGNED DEFAULT NULL,
                         `assignee_id` int(10) UNSIGNED DEFAULT NULL,
                         `contact_id` int(10) UNSIGNED DEFAULT NULL,
                         `ticket_id` int(10) UNSIGNED DEFAULT NULL,
                         `deal_id` int(10) UNSIGNED DEFAULT NULL,
                         `priority_id` int(10) UNSIGNED DEFAULT NULL,
                         `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `description` text COLLATE utf8mb4_unicode_ci,
                         `due_date` datetime DEFAULT NULL,
                         `start_date` datetime DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_relations`
--

CREATE TABLE `task_relations` (
                                  `id` bigint(20) UNSIGNED NOT NULL,
                                  `uuid` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `workspace_id` int(10) UNSIGNED NOT NULL,
                                  `task_id` int(10) UNSIGNED NOT NULL,
                                  `user_id` int(10) UNSIGNED NOT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `workspace_id` int(10) UNSIGNED NOT NULL,
                         `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `description` text COLLATE utf8mb4_unicode_ci,
                         `admin_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                         `date` date DEFAULT NULL,
                         `related_to` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `related_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                         `completed` tinyint(1) NOT NULL DEFAULT '0',
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
                         `id` bigint(20) UNSIGNED NOT NULL,
                         `workspace_id` int(10) UNSIGNED NOT NULL,
                         `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `password_reset_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `mobile_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `facebook` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `address_1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `address_2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `email_verified_at` timestamp NULL DEFAULT NULL,
                         `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                         `language` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `cover_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `super_admin` tinyint(1) NOT NULL DEFAULT '0',
                         `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT NULL,
                         `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `workspace_id`, `first_name`, `last_name`, `email`, `phone_number`, `password_reset_key`, `mobile_number`, `twitter`, `facebook`, `linkedin`, `address_1`, `address_2`, `zip`, `city`, `state`, `country`, `email_verified_at`, `password`, `language`, `photo`, `cover_photo`, `super_admin`, `remember_token`, `created_at`, `updated_at`) VALUES
    (1, 1, 'Jason', 'M', 'demo@cloudonex.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$XGyD8DKPv9jABNS8Jaq3.ezS/sdQ6HdPJA3cFwfGPs.2WqeASBEfK', NULL, NULL, NULL, 1, NULL, '2022-04-19 08:11:44', '2022-04-19 08:11:44');

-- --------------------------------------------------------

--
-- Table structure for table `workspaces`
--

CREATE TABLE `workspaces` (
                              `id` bigint(20) UNSIGNED NOT NULL,
                              `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                              `plan_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                              `owner_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
                              `active` tinyint(1) NOT NULL DEFAULT '1',
                              `subscribed` tinyint(1) NOT NULL DEFAULT '0',
                              `term` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
                              `subscription_start_date` date DEFAULT NULL,
                              `next_renewal_date` date DEFAULT NULL,
                              `price` decimal(8,2) UNSIGNED DEFAULT NULL,
                              `trial` tinyint(1) NOT NULL DEFAULT '1',
                              `trial_start_date` date DEFAULT NULL,
                              `trial_end_date` date DEFAULT NULL,
                              `created_at` timestamp NULL DEFAULT NULL,
                              `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `workspaces`
--

INSERT INTO `workspaces` (`id`, `name`, `plan_id`, `owner_id`, `active`, `subscribed`, `term`, `subscription_start_date`, `next_renewal_date`, `price`, `trial`, `trial_start_date`, `trial_end_date`, `created_at`, `updated_at`) VALUES
    (1, 'CloudOnex', 0, 0, 1, 0, NULL, NULL, NULL, NULL, 1, NULL, NULL, '2022-04-19 08:11:44', '2022-04-19 08:11:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brain_storms`
--
ALTER TABLE `brain_storms`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_models`
--
ALTER TABLE `business_models`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `business_plans`
--
ALTER TABLE `business_plans`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calendars`
--
ALTER TABLE `calendars`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_cards`
--
ALTER TABLE `credit_cards`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
    ADD PRIMARY KEY (`id`);

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
-- Indexes for table `notes`
--
ALTER TABLE `notes`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
    ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pest_analyses`
--
ALTER TABLE `pest_analyses`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_replies`
--
ALTER TABLE `project_replies`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sticky_notes`
--
ALTER TABLE `sticky_notes`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `swot_analyses`
--
ALTER TABLE `swot_analyses`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_relations`
--
ALTER TABLE `task_relations`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`),
  ADD UNIQUE KEY `users_password_reset_key_unique` (`password_reset_key`),
  ADD UNIQUE KEY `users_mobile_number_unique` (`mobile_number`),
  ADD UNIQUE KEY `users_twitter_unique` (`twitter`),
  ADD UNIQUE KEY `users_facebook_unique` (`facebook`),
  ADD UNIQUE KEY `users_linkedin_unique` (`linkedin`),
  ADD UNIQUE KEY `users_address_1_unique` (`address_1`),
  ADD UNIQUE KEY `users_address_2_unique` (`address_2`),
  ADD UNIQUE KEY `users_zip_unique` (`zip`),
  ADD UNIQUE KEY `users_city_unique` (`city`),
  ADD UNIQUE KEY `users_state_unique` (`state`),
  ADD UNIQUE KEY `users_country_unique` (`country`);

--
-- Indexes for table `workspaces`
--
ALTER TABLE `workspaces`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brain_storms`
--
ALTER TABLE `brain_storms`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_models`
--
ALTER TABLE `business_models`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `business_plans`
--
ALTER TABLE `business_plans`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calendars`
--
ALTER TABLE `calendars`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credit_cards`
--
ALTER TABLE `credit_cards`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
    MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=538;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_gateways`
--
ALTER TABLE `payment_gateways`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pest_analyses`
--
ALTER TABLE `pest_analyses`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_replies`
--
ALTER TABLE `project_replies`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sticky_notes`
--
ALTER TABLE `sticky_notes`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscription_plans`
--
ALTER TABLE `subscription_plans`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `swot_analyses`
--
ALTER TABLE `swot_analyses`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `task_relations`
--
ALTER TABLE `task_relations`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `workspaces`
--
ALTER TABLE `workspaces`
    MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
