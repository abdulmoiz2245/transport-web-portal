-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2021 at 09:02 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transport`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `f_name`, `l_name`, `profile_pic`, `username`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Abdul', 'Moiz', '1631006375_1630999096_the-united-arab-emirates-flag-icon-free-download.jpg', 'abdulmoiz', 'abdulmoiz2245@gmail.com', NULL, '$2y$10$CYuxlq8f.O4EXcMP2D8CvO8d9sPZWinVbDSSM0miND00mZ8uE7kSy', 'lhKD1nYwBC46x8aNJA6wHXJElxCq2YnviuMIU2CVBkfDtP8BcKx0orqG5HXr', '2021-09-01 04:17:51', '2021-09-07 16:19:35');

-- --------------------------------------------------------

--
-- Table structure for table `approvals`
--

CREATE TABLE `approvals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `table_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `approvals`
--

INSERT INTO `approvals` (`id`, `table_name`, `created_at`, `updated_at`) VALUES
(4, 'office__land_contracts', '2021-09-17 23:23:48', '2021-09-17 23:23:48'),
(5, 'muncipality_documents', '2021-09-18 02:23:31', '2021-09-18 02:23:31'),
(6, 'civil_defense_files', '2021-09-18 02:33:20', '2021-09-18 02:33:20'),
(7, 'trained_individuals', '2021-09-18 06:35:18', '2021-09-18 06:35:18'),
(9, 'customer_info', '2021-09-27 10:13:48', '2021-09-27 10:13:48');

-- --------------------------------------------------------

--
-- Table structure for table `civil_defense_documents_histories`
--

CREATE TABLE `civil_defense_documents_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `civil_defense_files`
--

CREATE TABLE `civil_defense_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `expiary_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `civil_defense_files`
--

INSERT INTO `civil_defense_files` (`id`, `document`, `type`, `status`, `status_message`, `action`, `user_id`, `expiary_date`, `created_at`, `updated_at`) VALUES
(2, '1631908125_TRADE_LICENSE,SPONSORS,_PARTNERS_-_Asyncs_(3).xlsx', 'non_mobile', 'approved', NULL, NULL, '0', '2021-09-20', '2021-09-18 02:48:45', '2021-09-18 02:48:45'),
(3, '1631908205_TRADE_LICENSE,SPONSORS,_PARTNERS_-_Asyncs_(3).xlsx', 'mobile', 'approved', 'please approve', 'edit', '7', '2021-09-14', '2021-09-18 02:50:05', '2021-09-18 02:58:41');

-- --------------------------------------------------------

--
-- Table structure for table `company_names`
--

CREATE TABLE `company_names` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_names`
--

INSERT INTO `company_names` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'AFGT', '2021-09-09 14:02:21', '2021-09-09 14:02:21'),
(2, 'PGT', '2021-09-09 14:02:41', '2021-09-09 14:02:41'),
(3, 'AFSW', '2021-09-09 14:03:03', '2021-09-09 14:03:03'),
(4, 'SSGT', '2021-09-09 14:03:20', '2021-09-09 14:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `customer_department`
--

CREATE TABLE `customer_department` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concerned_person_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concerned_person_designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tell` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_department`
--

INSERT INTO `customer_department` (`id`, `customer_id`, `department_name`, `concerned_person_name`, `concerned_person_designation`, `tell`, `mobile`, `fax`, `email`, `created_at`, `updated_at`) VALUES
(2, 6, 'asf', 'afsaf', 'sfsfd', '03134192612', '03134192612', '7865', 'mowakhat@gmail.com', '2021-09-27 05:12:37', '2021-09-27 05:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `customer_histories`
--

CREATE TABLE `customer_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_histories`
--

INSERT INTO `customer_histories` (`id`, `action`, `user_id`, `created_at`, `updated_at`, `date`) VALUES
(1, 'edit', 10, NULL, NULL, '2021-09-27'),
(2, 'add', 10, NULL, NULL, '2021-10-02');

-- --------------------------------------------------------

--
-- Table structure for table `customer_info`
--

CREATE TABLE `customer_info` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trn` int(11) DEFAULT NULL,
  `trn_copy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_term` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portal_login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_license_copy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_license_expiary_date` date DEFAULT NULL,
  `business_contract_copy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_contract_expiary_date` date DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_info`
--

INSERT INTO `customer_info` (`id`, `company_id`, `name`, `trn`, `trn_copy`, `address`, `city`, `country`, `tel_number`, `fax`, `mobile`, `email`, `contact_person`, `des`, `web`, `credit_term`, `remarks`, `portal_login`, `user`, `pw`, `business_license_copy`, `business_license_expiary_date`, `business_contract_copy`, `business_contract_expiary_date`, `status`, `action`, `status_message`, `user_id`, `created_at`, `updated_at`) VALUES
(6, 1, 'Abdul Moiz', 234, NULL, 'House E731, E block, St No 3, Ali Park, Lahore cant', 'Lahore', 'Pakistan', '03134192612', 'af45646', '03134192612', 'abdulmoiz2245@gmail.com', 'Abdul Moiz', 'sdf', 'sf', 45, 'asd', 'asd', 't9lqkr74rzlt', 'sdf', NULL, NULL, NULL, NULL, 'approved', 'edit', NULL, '10', '2021-09-27 05:12:23', '2021-09-27 10:51:09');

-- --------------------------------------------------------

--
-- Table structure for table `customer_rate_card`
--

CREATE TABLE `customer_rate_card` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_id` int(11) NOT NULL,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vechicle_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `driver_comission` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_carges` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_des` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detention` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `charges` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_km` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ap_diesel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_rate_card`
--

INSERT INTO `customer_rate_card` (`id`, `customer_id`, `from`, `to`, `vechicle_type`, `rate`, `driver_comission`, `other_carges`, `other_des`, `detention`, `time`, `charges`, `trip`, `ap_km`, `ap_diesel`, `created_at`, `updated_at`) VALUES
(1, 6, 'Dubai', 'Musafa', 'flatbed', 'per_trip', '30', '45345', 'hahah', 'per_day', '33', '33', 'single_trip', '33', '33', '2021-09-27 05:15:34', '2021-09-27 10:43:29');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_passwords`
--

CREATE TABLE `login_passwords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_password_histories`
--

CREATE TABLE `login_password_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2014_10_12_000000_create_admins_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2021_08_26_193547_create_roles_table', 2),
(10, '2021_08_31_192156_create_modules_table', 2),
(15, '2021_08_31_203003_create_users_table', 3),
(16, '2021_08_31_202606_create_permissions_table', 3),
(17, '2021_09_08_195700_create_company_names_table', 4),
(46, '2021_09_15_193533_create_trade_license_histories_table', 5),
(47, '2021_09_15_204339_create_approvals_table', 5),
(48, '2021_09_08_200009_create_trade_licenses_table', 6),
(49, '2021_09_17_121049_create_office__land_contract_histories_table', 7),
(50, '2021_09_17_121113_create_muncipality_documents_histories_table', 7),
(51, '2021_09_17_121142_create_civil_defense_documents_histories_table', 7),
(52, '2021_09_17_121227_create_login_password_histories_table', 7),
(58, '2021_09_10_145231_create_muncipality_documents_table', 8),
(59, '2021_09_10_145510_create_trained_individuals_table', 8),
(60, '2021_09_10_160123_create_civil_defense_files_table', 8),
(61, '2021_09_10_223411_create_office__land_contracts_table', 8),
(62, '2021_09_11_014129_create_login_passwords_table', 8),
(63, '2021_09_17_175932_create_trained_individuals_histories_table', 9),
(64, '2021_09_25_185032_create_customer_info_table', 10),
(65, '2021_09_25_185107_create_customer_departments_table', 10),
(67, '2021_09_25_185128_create_customer_rate_cards_table', 11),
(68, '2021_09_27_012637_create_customer_histories_table', 12),
(69, '2021_10_02_172756_create_supplier_infos_table', 13),
(70, '2021_10_02_172810_create_supplier_departments_table', 13),
(71, '2021_10_02_184616_create_supplier_histories_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `operations` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `nickname`, `icon`, `link`, `parent_id`, `created_at`, `updated_at`, `operations`) VALUES
(1, 'HR-PRO', 'hr_pro', 'i-Male-21', 'hr-pro', 0, '2021-08-31 19:28:33', '2021-08-31 19:28:33', 'view'),
(2, 'Customer', 'customer', 'i-Administrator', 'customer', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(3, 'Supplier', 'supplier', 'i-Cool-Guy', 'supplier', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(4, 'Purchase', 'purchase', 'i-Add-Cart', 'purchase', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(5, 'Inventory', 'inventory', 'i-Box-Full', 'inventory', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(6, 'Employee', 'employee', 'i-Business-Man', 'employee', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(7, 'Accounts', 'accounts', 'i-Data-Financial', 'accounts', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(8, 'Petty-cash', 'petty_cash', 'i-Cash-register-2', 'petty-cash', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(9, 'Vehicles', 'vehicles', 'i-Truck', 'vehicles', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(10, 'Workshop', 'workshop', 'i-Factory', 'workshop', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(11, 'Sub-Contractors', 'sub_contractors', 'i-Diploma-2', 'sub-contractors', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(12, 'Booking', 'booking', 'i-Calendar-4', 'booking', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(13, 'Reports', 'reports', 'i-File-Clipboard-File--Text', 'reports', 0, '2021-08-31 19:38:25', '2021-08-31 19:38:25', 'view'),
(27, 'Employee', 'hr_pro.employee', 'i-Business-Man', 'hr-pro/employee', 1, NULL, NULL, 'view'),
(28, 'Employee Salaries', 'hr_pro.employee_salaries', 'i-Business-Man', 'hr-pro/employee-salaries', 1, NULL, NULL, 'view'),
(29, 'Complaints', 'hr_pro.complaints', 'i-File-Clipboard-File--Text', 'hr-pro/complaints', 1, NULL, NULL, 'view'),
(30, 'TRADE LICENSE,SPONSORS, PARTNERS', 'hr_pro.trade_license__sponsors__partners', 'i-File-Clipboard-File--Text', 'hr-pro/trade-license-sponsors-partners', 1, NULL, NULL, 'view'),
(31, 'OFFICE CONTRACTS ,LAND CONTRACTS', 'hr_pro.office_contracts__land_contracts', 'i-File-Clipboard-File--Text', 'hr-pro/office-contracts-land-contracts', 1, NULL, NULL, 'view'),
(32, 'NON MOBILES FUEL TANKS RENEWALS(CIVIL DEFENSE AND MUNCIPALITY)', 'hr_pro.non_mobiles_fuel_tanks_renewals', 'i-File-Clipboard-File--Text', 'hr-pro/non-mobiles-fuel-tanks-renewals', 1, NULL, NULL, 'view'),
(33, 'MOBILES FUEL TANKS RENEWALS(CIVIL DEFENSE AND MUNCIPALITY)', 'hr_pro.mobiles_fuel_tanks_renewals', 'i-File-Clipboard-File--Text', 'hr-pro/mobiles-fuel-tanks-renewals', 1, NULL, NULL, 'view'),
(34, 'LOGIN ACCESS AND PASSWORDS', 'hr_pro.login_access_and_passwords', 'i-File-Clipboard-File--Text', 'hr-pro/login-access-passwords', 1, NULL, NULL, 'view'),
(35, 'REQUEST FOR FUNDS', 'hr_pro.request_for_funds', 'i-File-Clipboard-File--Text', 'hr-pro/request-for-funds', 1, NULL, NULL, 'view'),
(36, 'VEHICLE FINES', 'hr_pro.vehicle_fines', 'i-File-Clipboard-File--Text', 'hr-pro/vehicle_fines', 1, NULL, NULL, 'view');

-- --------------------------------------------------------

--
-- Table structure for table `muncipality_documents`
--

CREATE TABLE `muncipality_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiary_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `muncipality_documents`
--

INSERT INTO `muncipality_documents` (`id`, `document`, `type`, `status`, `status_message`, `user_id`, `action`, `expiary_date`, `created_at`, `updated_at`) VALUES
(1, '1631906200_TRADE_LICENSE,SPONSORS,_PARTNERS_-_Asyncs_(4).xlsx', 'mobile', 'approved', NULL, '0', NULL, '2021-09-02', '2021-09-18 02:16:40', '2021-09-18 02:16:40'),
(2, '1631906611_index.php', 'mobile', 'pending', 'please add', '7', 'add', '2021-10-01', '2021-09-18 02:23:31', '2021-09-18 02:23:31'),
(3, '1631906795_TRADE_LICENSE,SPONSORS,_PARTNERS_-_Asyncs_(4).xlsx', 'mobile', 'approved', 'please edit please', '7', 'edit', '2021-09-28', '2021-09-18 02:26:35', '2021-09-18 02:30:18'),
(5, '1631910108_TRADE_LICENSE,SPONSORS,_PARTNERS_-_Asyncs_(4).xlsx', 'non_mobile', 'approved', 'rejjected', '7', 'edit', '2021-09-14', '2021-09-18 03:21:48', '2021-09-18 03:49:57'),
(6, '1632551804_profile-picture.png', 'non_mobile', 'approved', NULL, '0', NULL, '2021-09-22', '2021-09-25 13:36:44', '2021-09-25 13:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `muncipality_documents_histories`
--

CREATE TABLE `muncipality_documents_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `muncipality_documents_histories`
--

INSERT INTO `muncipality_documents_histories` (`id`, `action`, `type`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'add', 'non_mobile', '2021-09-25', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `office__land_contracts`
--

CREATE TABLE `office__land_contracts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contract_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plot_details` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `landloard_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_expiary_date` date DEFAULT NULL,
  `lease_rent` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ijari_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ijari_certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office__land_contracts`
--

INSERT INTO `office__land_contracts` (`id`, `type`, `contract_number`, `plot_details`, `landloard_name`, `contract_expiary_date`, `lease_rent`, `ijari_number`, `ijari_certificate`, `status`, `status_message`, `action`, `user_id`, `created_at`, `updated_at`) VALUES
(3, 'office', 'G4B-3453', 'fasfasfasfdasfsaf', 'Michal Jackson', '2021-08-30', NULL, '465afasfds', NULL, 'approved', NULL, NULL, '0', '2021-09-17 23:17:02', '2021-09-17 23:17:02'),
(4, 'office', '657457', 'fasfasfasfdasfsaf', 'ABdul Moiz', '2021-10-05', NULL, NULL, NULL, 'approved', 'please add', 'edit', '7', '2021-09-17 23:23:48', '2021-09-17 23:34:13'),
(5, 'land', '657457', 'fasfasfasfdasfsaf', 'ABdul Moiz', '2021-09-28', '1631896565_TRADE_LICENSE,SPONSORS,_PARTNERS_-_Asyncs_(3).xlsx', '4653634', NULL, 'approved', 'asfsdf', 'add', '7', '2021-09-17 23:36:05', '2021-09-17 23:38:13');

-- --------------------------------------------------------

--
-- Table structure for table `office__land_contract_histories`
--

CREATE TABLE `office__land_contract_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `office__land_contract_histories`
--

INSERT INTO `office__land_contract_histories` (`id`, `action`, `type`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'add', 'land', '2021-09-17', 0, NULL, NULL),
(2, 'add', 'land', '2021-09-17', 0, NULL, NULL),
(3, 'add', 'land', '2021-09-17', 7, NULL, NULL),
(4, 'edit', 'land', '2021-09-17', 7, NULL, NULL),
(5, 'delete', 'land', '2021-09-17', 7, NULL, NULL),
(6, 'add', 'office', '2021-09-17', 0, NULL, NULL),
(7, 'none', 'office', '2021-09-17', 0, NULL, NULL),
(8, 'none', 'office', '2021-09-17', 0, NULL, NULL),
(9, 'none', 'office', '2021-09-17', 0, NULL, NULL),
(10, 'add', 'office', '2021-09-17', 0, NULL, NULL),
(11, 'edit', 'office', '2021-09-17', 7, NULL, NULL),
(12, 'add', 'land', '2021-09-17', 7, NULL, NULL);

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
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `operation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `module_id`, `role_id`, `operation`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 21:21:26', 1),
(2, 2, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(3, 3, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(4, 4, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(5, 5, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(6, 6, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(7, 7, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(8, 8, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(9, 9, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(10, 10, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(11, 11, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(12, 12, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(13, 13, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 08:57:58', 0),
(14, 27, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 20:12:48', 1),
(15, 28, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 20:12:49', 1),
(16, 29, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 20:12:50', 1),
(17, 30, 16, 'view', '2021-09-12 08:57:58', '2021-09-27 21:15:49', 1),
(18, 31, 16, 'view', '2021-09-12 08:57:58', '2021-09-27 21:15:50', 1),
(19, 32, 16, 'view', '2021-09-12 08:57:58', '2021-09-27 21:15:52', 1),
(20, 33, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 20:12:55', 1),
(21, 34, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 20:12:56', 1),
(22, 35, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 20:12:57', 1),
(23, 36, 16, 'view', '2021-09-12 08:57:58', '2021-09-12 20:12:58', 1),
(24, 1, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(25, 2, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 09:34:54', 1),
(26, 3, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(27, 4, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(28, 5, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(29, 6, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(30, 7, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(31, 8, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(32, 9, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(33, 10, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(34, 11, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(35, 12, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(36, 13, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(37, 27, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(38, 28, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(39, 29, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(40, 30, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(41, 31, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(42, 32, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(43, 33, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(44, 34, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(45, 35, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(46, 36, 17, 'view', '2021-09-27 02:34:12', '2021-09-27 02:34:12', 0),
(47, 1, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(48, 2, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(49, 3, 18, 'view', '2021-10-02 22:20:17', '2021-10-03 05:21:18', 1),
(50, 4, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(51, 5, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(52, 6, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(53, 7, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(54, 8, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(55, 9, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(56, 10, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(57, 11, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(58, 12, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(59, 13, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(60, 27, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(61, 28, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(62, 29, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(63, 30, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(64, 31, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(65, 32, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(66, 33, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(67, 34, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(68, 35, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0),
(69, 36, 18, 'view', '2021-10-02 22:20:17', '2021-10-02 22:20:17', 0);

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
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(15, 'Abdul Moiz', 1, '2021-09-08 21:41:55', '2021-09-08 21:41:55'),
(16, 'HR-PRO', 1, '2021-09-12 15:57:58', '2021-09-12 15:57:58'),
(17, 'Customer', 1, '2021-09-27 09:34:12', '2021-09-27 09:34:32'),
(18, 'supplier', 1, '2021-10-03 05:20:17', '2021-10-03 05:20:17');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_departments`
--

CREATE TABLE `supplier_departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concerned_person_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `concerned_person_designation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tell` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivery_order` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier_histories`
--

CREATE TABLE `supplier_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_histories`
--

INSERT INTO `supplier_histories` (`id`, `action`, `user_id`, `created_at`, `updated_at`, `date`) VALUES
(1, 'edit', 0, NULL, NULL, '2021-10-02'),
(2, 'edit', 0, NULL, NULL, '2021-10-02'),
(3, 'edit', 0, NULL, NULL, '2021-10-02'),
(4, 'edit', 0, NULL, NULL, '2021-10-02'),
(5, 'edit', 0, NULL, NULL, '2021-10-02'),
(6, 'edit', 0, NULL, NULL, '2021-10-02'),
(7, 'edit', 0, NULL, NULL, '2021-10-02'),
(8, 'delete', 8, NULL, NULL, '2021-10-02'),
(9, 'edit', 0, NULL, NULL, '2021-10-02'),
(10, 'delete', 0, NULL, NULL, '2021-10-04');

-- --------------------------------------------------------

--
-- Table structure for table `supplier_infos`
--

CREATE TABLE `supplier_infos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `trn` int(11) DEFAULT NULL,
  `trn_copy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `des` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `web` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `credit_term` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portal_login` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pw` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_license_copy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_license_expiary_date` date DEFAULT NULL,
  `business_contract_copy` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_contract_expiary_date` date DEFAULT NULL,
  `product` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `services` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_guaranty` int(11) NOT NULL,
  `guaranty_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranty_cheque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guaranty_reciving` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trade_licenses`
--

CREATE TABLE `trade_licenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_id` int(11) NOT NULL,
  `member_ship_certificate` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `sponsor_page` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `trade_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trade_license_copy` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `expiary_date` date NOT NULL,
  `manager_id_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `sponsor_id_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `partners_id_card` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `manager_visa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `sponsor_visa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `partners_visa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `manager_passport` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `sponsor_passport` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `partners_passport` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'null',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trade_licenses`
--

INSERT INTO `trade_licenses` (`id`, `company_id`, `member_ship_certificate`, `sponsor_page`, `trade_name`, `license_number`, `trade_license_copy`, `expiary_date`, `manager_id_card`, `sponsor_id_card`, `partners_id_card`, `manager_visa`, `sponsor_visa`, `partners_visa`, `manager_passport`, `sponsor_passport`, `partners_passport`, `status`, `action`, `status_message`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'null', 'null', 'Dummy Trade approved', '0567567', 'null', '2021-09-29', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'null', 'approved', 'edit', 'you are rejected please change', '7', '2021-09-17 18:44:23', '2021-10-03 00:30:48');

-- --------------------------------------------------------

--
-- Table structure for table `trade_license_histories`
--

CREATE TABLE `trade_license_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trade_license_histories`
--

INSERT INTO `trade_license_histories` (`id`, `action`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'edit', '2021-09-18', 7, NULL, NULL),
(2, 'edit', '2021-09-18', 7, NULL, NULL),
(3, 'edit', '2021-09-18', 7, NULL, NULL),
(4, 'edit', '2021-10-02', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `trained_individuals`
--

CREATE TABLE `trained_individuals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pass_card` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `employee_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `expiary_date` date DEFAULT NULL,
  `front_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `back_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trained_individuals`
--

INSERT INTO `trained_individuals` (`id`, `pass_card`, `type`, `card_number`, `employee_name`, `expiary_date`, `front_pic`, `back_pic`, `status`, `status_message`, `action`, `user_id`, `created_at`, `updated_at`) VALUES
(1, NULL, 'non_mobile', '47457456436', 'Dumy Name', '2021-09-21', NULL, NULL, 'approved', NULL, 'edit', '0', '2021-09-18 04:08:45', '2021-09-18 05:01:48'),
(2, NULL, 'non_mobile', '47457456436', 'Dumy Name', NULL, NULL, NULL, 'approved', NULL, NULL, '0', '2021-09-18 05:00:57', '2021-09-18 05:00:57'),
(3, NULL, 'non_mobile', '47457456436', 'cbcvbxcvbx', '2021-10-05', NULL, NULL, 'approved', NULL, NULL, '0', '2021-09-18 05:04:17', '2021-09-18 05:04:17'),
(5, NULL, 'mobile', '47457456436', 'Dumy Name', '2021-09-28', NULL, NULL, 'approved', 'yes delete it', 'delete', '7', '2021-09-18 06:35:19', '2021-09-18 08:58:22');

-- --------------------------------------------------------

--
-- Table structure for table `trained_individuals_histories`
--

CREATE TABLE `trained_individuals_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `trained_individuals_histories`
--

INSERT INTO `trained_individuals_histories` (`id`, `action`, `type`, `date`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'add', 'non_mobile', '2021-09-17', 0, NULL, NULL),
(2, 'edit', 'non_mobile', '2021-09-17', 0, NULL, NULL),
(3, 'add', 'non_mobile', '2021-09-17', 0, NULL, NULL),
(4, 'edit', 'non_mobile', '2021-09-17', 0, NULL, NULL),
(5, 'add', 'non_mobile', '2021-09-17', 0, NULL, NULL),
(6, 'add', 'mobile', '2021-09-17', 0, NULL, NULL),
(7, 'edit', 'mobile', '2021-09-17', 0, NULL, NULL),
(8, 'edit', 'mobile', '2021-09-17', 0, NULL, NULL),
(9, 'delete', 'mobile', '2021-09-18', 7, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `l_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `status` int(11) NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `l_name`, `profile_pic`, `username`, `email`, `role_id`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(7, NULL, NULL, NULL, 'Fa-2019-BSSE-082', 'mowakhat@gmail.com', 16, 1, '$2y$10$ZYoR5hP2nwaJL5HmnMTxauxM21zU1AHF2ruvkSM0uE4I3fwaxppRK', 'buYIEA84pvfDqHD6QsjKt5nYW50P2adno0N9WvZGbfsdMoylwt5pygjrb21G', '2021-09-05 14:21:10', '2021-09-12 20:13:11'),
(8, NULL, NULL, NULL, 'supplier', 'supplier@demo.com', 18, 1, '$2y$10$h7Pqlbfbf0kqyeRrBLOpX.Eriw.rqYAFKe3tkJCsYDPXYxOhEKX4W', 'Zr8HLxFX0PqZmIXFdrbNVwQGGBccxj0vW6EJsFx1tPOHqH6GFu3cBdke2mFc', '2021-09-05 14:23:46', '2021-10-03 05:20:56'),
(10, NULL, NULL, NULL, 'customer', 'customer@demo.com', 17, 1, '$2y$10$fqs273BtjEJpCNEn2yleD.0/qDGL.pqSa7g0BXXqA6j86590M2ogu', 'RqcWBnvC7uE3YfgYGcjOaF76SCgdr30IMd9BMxOH4HCoA3hRQF8M1d3wPXLo', '2021-09-27 09:35:28', '2021-09-27 09:35:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `approvals`
--
ALTER TABLE `approvals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `civil_defense_documents_histories`
--
ALTER TABLE `civil_defense_documents_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `civil_defense_files`
--
ALTER TABLE `civil_defense_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_names`
--
ALTER TABLE `company_names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_department`
--
ALTER TABLE `customer_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_histories`
--
ALTER TABLE `customer_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_info`
--
ALTER TABLE `customer_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_rate_card`
--
ALTER TABLE `customer_rate_card`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `login_passwords`
--
ALTER TABLE `login_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_password_histories`
--
ALTER TABLE `login_password_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muncipality_documents`
--
ALTER TABLE `muncipality_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `muncipality_documents_histories`
--
ALTER TABLE `muncipality_documents_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office__land_contracts`
--
ALTER TABLE `office__land_contracts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `office__land_contract_histories`
--
ALTER TABLE `office__land_contract_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_module_id_foreign` (`module_id`),
  ADD KEY `permissions_role_id_foreign` (`role_id`);

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
-- Indexes for table `supplier_departments`
--
ALTER TABLE `supplier_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_histories`
--
ALTER TABLE `supplier_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier_infos`
--
ALTER TABLE `supplier_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_licenses`
--
ALTER TABLE `trade_licenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trade_license_histories`
--
ALTER TABLE `trade_license_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trained_individuals`
--
ALTER TABLE `trained_individuals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trained_individuals_histories`
--
ALTER TABLE `trained_individuals_histories`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `approvals`
--
ALTER TABLE `approvals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `civil_defense_documents_histories`
--
ALTER TABLE `civil_defense_documents_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `civil_defense_files`
--
ALTER TABLE `civil_defense_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company_names`
--
ALTER TABLE `company_names`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customer_department`
--
ALTER TABLE `customer_department`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_histories`
--
ALTER TABLE `customer_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_info`
--
ALTER TABLE `customer_info`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_rate_card`
--
ALTER TABLE `customer_rate_card`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_passwords`
--
ALTER TABLE `login_passwords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_password_histories`
--
ALTER TABLE `login_password_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `muncipality_documents`
--
ALTER TABLE `muncipality_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `muncipality_documents_histories`
--
ALTER TABLE `muncipality_documents_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `office__land_contracts`
--
ALTER TABLE `office__land_contracts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `office__land_contract_histories`
--
ALTER TABLE `office__land_contract_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `supplier_departments`
--
ALTER TABLE `supplier_departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier_histories`
--
ALTER TABLE `supplier_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `supplier_infos`
--
ALTER TABLE `supplier_infos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trade_licenses`
--
ALTER TABLE `trade_licenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trade_license_histories`
--
ALTER TABLE `trade_license_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `trained_individuals`
--
ALTER TABLE `trained_individuals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trained_individuals_histories`
--
ALTER TABLE `trained_individuals_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`),
  ADD CONSTRAINT `permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
