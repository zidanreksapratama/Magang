-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2025 at 10:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magang`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `parent_company_id` smallint(5) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `email`, `password`, `role_id`, `parent_company_id`, `created_at`) VALUES
(1, 'PT Induk Sejahtera', 'induk@example.com', '$2y$10$GYaep72XRXEDDZXGqCVDZeWM8daCBfOICyXa5EnS7SZTETtvgdAfm', 1, NULL, '2025-07-31 23:37:59'),
(2, 'PT Anak Mandiri', 'anak@example.com', '$2y$10$GYaep72XRXEDDZXGqCVDZeWM8daCBfOICyXa5EnS7SZTETtvgdAfm', 1, 1, '2025-07-31 23:37:59');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `tenant_company_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `email`, `password`, `role_id`, `tenant_company_id`, `created_at`, `updated_at`) VALUES
(1, 'Budi', 'budi@example.com', '$2y$10$GYaep72XRXEDDZXGqCVDZeWM8daCBfOICyXa5EnS7SZTETtvgdAfm', 3, 1, '2025-07-31 23:37:59', '2025-08-02 03:08:56'),
(2, 'Sari', 'sari@example.com', '$2y$10$GYaep72XRXEDDZXGqCVDZeWM8daCBfOICyXa5EnS7SZTETtvgdAfm', 3, 2, '2025-07-31 23:37:59', '2025-08-02 03:09:01'),
(3, 'Andi', 'andi@example.com', '$2y$10$GYaep72XRXEDDZXGqCVDZeWM8daCBfOICyXa5EnS7SZTETtvgdAfm', 3, 3, '2025-07-31 23:37:59', '2025-08-02 03:09:04'),
(4, 'John Doe', 'john123@example.com', '$2y$10$XpwmS9deNKC3gh9BOtIA1.R8HtyJpBnM6I3QFdgQpMpvMEC6Ol4yW', 3, 1, '2025-08-01 20:36:18', '2025-08-01 20:36:18');

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
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2025_08_01_043058_create_roles_table', 1),
(3, '2025_08_01_043115_create_companies_table', 1),
(4, '2025_08_01_043116_create_tenant_companies_table', 1),
(5, '2025_08_01_043118_create_news_table', 1),
(6, '2025_08_01_043258_create_karyawan_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by_company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_by_tenant_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `image`, `created_at`, `updated_at`, `created_by_company_id`, `created_by_tenant_id`) VALUES
(1, 'Induk News 1', 'News content from PT Induk Sejahtera.', 'news1.jpg', '2025-07-31 23:37:59', '2025-07-31 23:37:59', 1, NULL),
(2, 'Tenant Alpha News', 'News content from Tenant Alpha.', 'news2.png', '2025-07-31 23:37:59', '2025-07-31 23:37:59', NULL, 1),
(3, 'Tenant Beta News', 'News content from Tenant Beta.', 'news3.jpeg', '2025-07-31 23:37:59', '2025-07-31 23:37:59', NULL, 2),
(4, 'Subsidiary News', 'News from PT Anak Mandiri.', 'news4.jpg', '2025-07-31 23:37:59', '2025-07-31 23:37:59', 2, NULL),
(5, 'Tenant Gamma News', 'News content from Tenant Gamma.', 'news5.jpg', '2025-07-31 23:37:59', '2025-07-31 23:37:59', NULL, 3),
(6, 'Berita Pertama kedua', 'Ini adalah isi berita.', 'https://example.com/image.jpg', '2025-08-01 20:37:53', '2025-08-01 20:37:53', NULL, 1);

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\Company', 1, 'company-token', 'f1651c1390e9667dd52fe4de9db158253630aa812487719a16d37d8aca32a3b3', '[\"*\"]', '2025-08-01 20:11:10', NULL, '2025-08-01 20:10:27', '2025-08-01 20:11:10'),
(2, 'App\\Models\\Employees', 1, 'employees-token', 'bfa8e347ddb8a62603ed3e5b25a5ce2ce3fdb3285e048ed69dd770f2e6794f43', '[\"*\"]', NULL, NULL, '2025-08-01 20:17:05', '2025-08-01 20:17:05'),
(3, 'App\\Models\\TenantCompany', 1, 'tenant-token', '7c93fabe15a2b9fb8f016cfb8d4dc773f40a9726fa919a8e7e415764fc88da7f', '[\"*\"]', '2025-08-01 20:37:53', NULL, '2025-08-01 20:37:15', '2025-08-01 20:37:53'),
(4, 'App\\Models\\Company', 1, 'company-token', '67ae8fd0026c7bc69478540032a0fbfcc076490287243b7ddc2abab5e7cd5cee', '[\"*\"]', NULL, NULL, '2025-08-01 20:42:41', '2025-08-01 20:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`) VALUES
(1, 'Admin Perusahaan', '2025-08-02 03:05:09'),
(2, 'Admin Tenant', '2025-08-02 03:05:09'),
(3, 'Karyawan', '2025-08-02 03:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `tenant_companies`
--

CREATE TABLE `tenant_companies` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `role_id` tinyint(3) UNSIGNED NOT NULL,
  `company_id` smallint(5) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenant_companies`
--

INSERT INTO `tenant_companies` (`id`, `name`, `address`, `email`, `password`, `role_id`, `company_id`, `created_at`) VALUES
(1, 'Tenant Alpha', 'tegal', 'alpha@example.com', '$2y$10$GYaep72XRXEDDZXGqCVDZeWM8daCBfOICyXa5EnS7SZTETtvgdAfm', 2, 1, '2025-07-31 23:37:59'),
(2, 'Tenant Beta', 'tegal', 'beta@example.com', '$2y$10$GYaep72XRXEDDZXGqCVDZeWM8daCBfOICyXa5EnS7SZTETtvgdAfm', 2, 1, '2025-07-31 23:37:59'),
(3, 'Tenant Gamma', 'tegal', 'gamma@example.com', '$2y$10$GYaep72XRXEDDZXGqCVDZeWM8daCBfOICyXa5EnS7SZTETtvgdAfm', 2, 2, '2025-07-31 23:37:59'),
(4, 'Tenant 123', 'tegal', 'tenant123@example.com', '$2y$10$FA6vao5vQRFh/yIDSyqecOuQomegL6qWxIYzuU7qkr7Bz1nuEi2BW', 2, 1, '2025-08-02 03:11:10'),
(5, 'Mahasiswa Pejuang Rupiah', 'Tegal\r\nadiwerna', 'adminer@gmail.com', '$2y$10$NX1LAGk8b5dHOZxJypaa4uu0Zcs4do6Xp/JO1NiSkhr3uIOyFCDKm', 2, 1, '2025-08-02 08:12:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_email_unique` (`email`),
  ADD KEY `companies_role_id_foreign` (`role_id`),
  ADD KEY `companies_parent_company_id_foreign` (`parent_company_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employees_email_unique` (`email`),
  ADD KEY `employees_role_id_foreign` (`role_id`),
  ADD KEY `employees_tenant_company_id_foreign` (`tenant_company_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_companies`
--
ALTER TABLE `tenant_companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tenant_companies_email_unique` (`email`),
  ADD KEY `tenant_companies_role_id_foreign` (`role_id`),
  ADD KEY `tenant_companies_company_id_foreign` (`company_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tenant_companies`
--
ALTER TABLE `tenant_companies`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_parent_company_id_foreign` FOREIGN KEY (`parent_company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `companies_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `employees_tenant_company_id_foreign` FOREIGN KEY (`tenant_company_id`) REFERENCES `tenant_companies` (`id`);

--
-- Constraints for table `tenant_companies`
--
ALTER TABLE `tenant_companies`
  ADD CONSTRAINT `tenant_companies_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`),
  ADD CONSTRAINT `tenant_companies_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
