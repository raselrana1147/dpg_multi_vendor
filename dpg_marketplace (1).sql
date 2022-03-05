-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2022 at 01:41 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dpg_marketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing_details`
--

CREATE TABLE `billing_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `brand_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=publish,1=unpublish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `brand_name`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'SaRa', '31r0ixgcwm1637470046.jpg', 0, '2021-11-20 22:47:28', '2021-11-20 22:47:28'),
(3, 'lotto', 'khlnrcx6ml1637470303.png', 0, '2021-11-20 22:51:45', '2021-11-20 22:51:45'),
(4, 'Zara', 'esu2xhcdr71637470317.jpg', 0, '2021-11-20 22:51:59', '2021-11-20 22:51:59'),
(5, 'Easy', 'connqlk0tf1637986056.jpg', 0, '2021-11-26 22:07:37', '2021-11-26 22:07:37'),
(6, 'Get Up', 'eduxjoah9j1637986064.jpg', 0, '2021-11-26 22:07:46', '2021-11-26 22:07:46'),
(7, 'Remond', 'mmtkvdhd131637986092.jpg', 0, '2021-11-26 22:08:13', '2021-11-26 22:08:13'),
(8, 'Princed', 'u4ihnjshuo1637986114.jpg', 0, '2021-11-26 22:08:36', '2021-11-26 22:08:36'),
(9, 'Bell', 'ga9gnh55e91637986145.jpg', 0, '2021-11-26 22:09:05', '2021-11-26 22:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `campare_lists`
--

CREATE TABLE `campare_lists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campare_lists`
--

INSERT INTO `campare_lists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(29, 3, 8, '2021-12-11 04:53:31', '2021-12-11 04:53:31'),
(30, 3, 19, '2021-12-28 03:47:53', '2021-12-28 03:47:53'),
(33, 3, 3, '2022-01-04 22:51:11', '2022-01-04 22:51:11'),
(46, 3, 6, '2022-01-15 00:24:03', '2022-01-15 00:24:03'),
(47, 3, 10, '2022-01-15 00:24:12', '2022-01-15 00:24:12'),
(48, 3, 4, '2022-01-15 00:53:34', '2022-01-15 00:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `coupon_id` bigint(20) UNSIGNED DEFAULT NULL,
  `coupon_amount` double(11,2) DEFAULT NULL,
  `coupon_type` tinyint(4) DEFAULT NULL COMMENT '0=flat,1=%',
  `size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `is_flash_deal` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `flash_deal_amount` double(11,2) DEFAULT NULL,
  `flash_deal_type` tinyint(4) DEFAULT NULL COMMENT '0=flat,1=%',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=publish,1=unpublish',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `parent_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Clothing', NULL, 'cugu175tfx1637557594.jpg', 0, '2021-11-21 23:06:36', '2021-11-21 23:06:36'),
(6, 'Women', 5, 'mqljo6wcvs1637557620.png', 0, '2021-11-21 23:07:03', '2021-11-21 23:07:03'),
(7, 'Men', 5, 'lorf7bbojq1637557638.png', 0, '2021-11-21 23:07:21', '2021-11-21 23:07:21'),
(8, 'Furniture', NULL, NULL, 0, '2021-11-21 23:07:27', '2021-11-21 23:07:27'),
(9, 'Chair', 8, NULL, 0, '2021-11-21 23:07:48', '2021-11-21 23:07:48'),
(10, 'Table', 8, NULL, 0, '2021-11-21 23:07:57', '2021-11-21 23:07:57'),
(11, 'Electronics', NULL, NULL, 0, '2021-11-21 23:08:01', '2021-11-21 23:08:01'),
(12, 'Toys', NULL, NULL, 0, '2021-11-22 00:10:44', '2021-11-22 00:10:44'),
(13, 'Remote Control', 12, 'zctywantws1637561492.jpg', 0, '2021-11-22 00:11:33', '2021-11-22 00:11:33'),
(14, 'Mobile', 11, '5difeqjcr61637561556.jpg', 0, '2021-11-22 00:12:37', '2021-11-22 00:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color_name`, `color_code`, `created_at`, `updated_at`) VALUES
(1, 'Red', '#ff4000', '2021-11-22 23:03:17', '2021-11-22 23:03:17'),
(2, 'Blue', '#0040ff', '2021-11-22 23:03:34', '2021-11-22 23:03:34'),
(3, 'Purpule', '#8000ff', '2021-11-22 23:03:50', '2021-11-22 23:03:50'),
(4, 'Pink', '#ff00ff', '2021-11-22 23:04:04', '2021-11-22 23:04:04'),
(5, 'Yello', '#ffff00', '2021-11-22 23:04:29', '2021-11-22 23:43:19');

-- --------------------------------------------------------

--
-- Table structure for table `commission_details`
--

CREATE TABLE `commission_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `defined_commission` double(11,2) DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `is_flash_deal` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 is not, 1 is yes',
  `flash_deal_amount` double(11,2) DEFAULT NULL COMMENT 'flash is counted as %',
  `unit_commission` double(11,2) NOT NULL,
  `total_commission` double(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commission_details`
--

INSERT INTO `commission_details` (`id`, `seller_id`, `defined_commission`, `order_id`, `product_id`, `quantity`, `is_flash_deal`, `flash_deal_amount`, `unit_commission`, `total_commission`, `created_at`, `updated_at`) VALUES
(18, 4, NULL, 28, 15, 2, 0, NULL, 199.90, 399.80, '2021-12-18 00:56:28', '2021-12-18 00:56:28'),
(19, 4, NULL, 28, 13, 1, 0, NULL, 499.80, 499.80, '2021-12-18 00:56:28', '2021-12-18 00:56:28'),
(20, 6, NULL, 28, 19, 1, 0, NULL, 52.50, 52.50, '2021-12-18 00:56:29', '2021-12-18 00:56:29'),
(21, 6, NULL, 27, 19, 1, 0, NULL, 52.50, 52.50, '2021-12-18 00:56:31', '2021-12-18 00:56:31'),
(22, 6, NULL, 27, 19, 1, 0, NULL, 52.50, 52.50, '2021-12-18 00:56:31', '2021-12-18 00:56:31'),
(23, 4, NULL, 27, 15, 2, 0, NULL, 199.90, 399.80, '2021-12-18 00:56:31', '2021-12-18 00:56:31'),
(24, 6, NULL, 31, 19, 1, 0, NULL, 52.50, 52.50, '2021-12-18 01:02:42', '2021-12-18 01:02:42'),
(25, 6, NULL, 48, 19, 4, 0, NULL, 52.50, 210.00, '2022-01-02 04:46:48', '2022-01-02 04:46:48'),
(26, 6, NULL, 41, 19, 1, 0, NULL, 52.50, 52.50, '2022-01-02 04:48:08', '2022-01-02 04:48:08'),
(27, 4, NULL, 41, 15, 1, 0, NULL, 199.90, 199.90, '2022-01-02 04:48:08', '2022-01-02 04:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `earning_histories`
--

CREATE TABLE `earning_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED DEFAULT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `selling_earning` double(11,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `earning_histories`
--

INSERT INTO `earning_histories` (`id`, `order_id`, `seller_id`, `user_type`, `selling_earning`, `created_at`, `updated_at`) VALUES
(11, 28, 4, 'seller', 8096.40, '2021-12-18 00:56:28', '2021-12-18 00:56:28'),
(12, 28, 6, 'seller', 472.50, '2021-12-18 00:56:29', '2021-12-18 00:56:29'),
(13, 27, 6, 'seller', 945.00, '2021-12-18 00:56:31', '2021-12-18 00:56:31'),
(14, 27, 4, 'seller', 3598.20, '2021-12-18 00:56:31', '2021-12-18 00:56:31'),
(15, 31, 6, 'seller', 472.50, '2021-12-18 01:02:42', '2021-12-18 01:02:42'),
(16, 48, 6, 'seller', 1890.00, '2022-01-02 04:46:48', '2022-01-02 04:46:48'),
(17, 41, 6, 'seller', 472.50, '2022-01-02 04:48:08', '2022-01-02 04:48:08'),
(18, 41, 4, 'seller', 1799.10, '2022-01-02 04:48:08', '2022-01-02 04:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `galleries`
--

INSERT INTO `galleries` (`id`, `product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 18, 'cqhlgzjhfm1637729303.jpg', '2021-11-23 22:48:24', '2021-11-23 22:48:24'),
(2, 18, '0eg2i9abct1637729415.jpg', '2021-11-23 22:50:16', '2021-11-23 22:50:16'),
(3, 18, 'usnj39jhca1637729424.jpg', '2021-11-23 22:50:24', '2021-11-23 22:50:24'),
(4, 17, 'nnkhsicxwp1637729439.jpg', '2021-11-23 22:50:40', '2021-11-23 22:50:40'),
(5, 17, 'ulldlkky0c1637729445.png', '2021-11-23 22:50:46', '2021-11-23 22:50:46'),
(6, 17, 'yshe7rwjmi1637729453.jpg', '2021-11-23 22:50:53', '2021-11-23 22:50:53'),
(7, 13, 'o0ftbnq0e61637729466.jpg', '2021-11-23 22:51:07', '2021-11-23 22:51:07'),
(10, 13, '9wa3jpvsti1637729936.jpg', '2021-11-23 22:58:57', '2021-11-23 22:58:57'),
(11, 13, 'ny9djgt5tw1637729953.jpg', '2021-11-23 22:59:13', '2021-11-23 22:59:13'),
(12, 15, 'gmnjn1dg0t1637730948.jpg', '2021-11-23 23:02:01', '2021-11-23 23:15:49'),
(13, 16, 'ukvsseqa0g1637732241.jpg', '2021-11-23 23:37:21', '2021-11-23 23:37:21'),
(14, 20, 'wwqoiwkqu11639291290.jpg', '2021-12-12 00:41:31', '2021-12-12 00:41:31'),
(15, 20, 'lyk4s31yx01639291322.jpg', '2021-12-12 00:42:02', '2021-12-12 00:42:02'),
(16, 20, 'jghupask0f1639291328.jpg', '2021-12-12 00:42:09', '2021-12-12 00:42:09'),
(18, 20, 'tzenob8a2p1639291339.jpg', '2021-12-12 00:42:20', '2021-12-12 00:42:20'),
(19, 19, '2zu4oufyjr1639291451.jpg', '2021-12-12 00:44:12', '2021-12-12 00:44:12'),
(20, 19, 'xdjerfl9bg1639291459.jpg', '2021-12-12 00:44:20', '2021-12-12 00:44:20'),
(21, 19, 'yoodnofjfl1639291473.jpg', '2021-12-12 00:44:34', '2021-12-12 00:44:34');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favicon` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `site_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_charge` float(11,2) NOT NULL DEFAULT 0.00,
  `tax` float(11,2) DEFAULT 0.00,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loader` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slider_background` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_phone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_email` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instrgram` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `logo`, `favicon`, `site_name`, `shipping_charge`, `tax`, `title`, `copyright`, `loader`, `slider_background`, `currency`, `default_image`, `company_address`, `description`, `company_phone`, `company_email`, `facebook`, `instrgram`, `youtube`, `twitter`, `linkedin`, `created_at`, `updated_at`) VALUES
(1, 'nk1bowfkqf1638085444.png', '75gqgfcoei1638085492.png', 'DPG Market Place', 70.00, 50.00, 'Ecommerce', '© Copyright 2021 | Mysoftheaven (BD) Ltd. | All Rights Reserved | Privacy Policy', 'pbip27ztaf1638084935.jpg', 'cdd0k6ualj1638085546.jpg', '$', '4lybz5wbae1637839859.png', 'Raisa & Shikder Tower, Level-5, 3/8, North Pirerbag, 60 Fit Road, Mirpur, Dhaka-1207.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s', '01xxxxxxxxx', 'email.@gmail.com', 'facebook.com/username', 'instragram.com/username', 'youtube.com', 'twitter.com', 'linkedin.com', NULL, '2021-11-28 01:45:46');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2014_10_12_000000_create_users_table', 2),
(7, '2021_11_18_085304_create_categories_table', 3),
(8, '2021_11_20_113936_create_brands_table', 4),
(9, '2021_11_21_050900_create_product_types_table', 5),
(10, '2021_11_21_051103_create_products_table', 6),
(11, '2021_11_21_170340_create_general_settings_table', 7),
(12, '2021_11_22_155702_create_colors_table', 8),
(13, '2021_11_22_155847_create_sizes_table', 8),
(14, '2021_11_24_042330_create_galleries_table', 9),
(15, '2021_11_24_042559_create_stocks_table', 10),
(17, '2021_11_28_060942_create_sliders_table', 11),
(19, '2021_12_06_084357_create_carts_table', 12),
(20, '2021_12_09_084851_create_wishlists_table', 13),
(21, '2021_12_11_083338_create_campare_lists_table', 14),
(23, '2021_12_12_084725_create_orders_table', 15),
(24, '2021_12_12_090113_create_billing_details_table', 16),
(25, '2021_12_12_090522_create_order_details_table', 17),
(26, '2021_12_13_092635_create_order_commissions_table', 18),
(27, '2021_12_13_093238_create_commission_details_table', 19),
(28, '2021_12_13_093558_create_earning_histories_table', 20),
(29, '2021_12_14_095044_create_withdraws_table', 21),
(31, '2021_12_29_043407_create_reviews_table', 22),
(32, '2022_01_08_044549_create_shop_logos_table', 23);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `shipping_detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_total` double(8,2) NOT NULL,
  `tax` double(4,2) NOT NULL,
  `shipping_charge` double(8,2) NOT NULL,
  `grand_total` double(8,2) NOT NULL,
  `order_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_note` mediumtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','processing','confirmed','delivered','declined') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipping_detail`, `quantity`, `sub_total`, `tax`, `shipping_charge`, `grand_total`, `order_number`, `payment_method`, `order_note`, `status`, `created_at`, `updated_at`) VALUES
(27, 3, '{\"lname\":\"Hossain\",\"fname\":\"Milllat\",\"phone\":\"019647193492\",\"email\":\"customer@gmail.com\",\"country\":\"BD\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 3, 5048.00, 50.00, 70.00, 5168.00, '80278', 'cash on delivery', 'dsfdfd', 'delivered', '2021-12-15 05:18:40', '2021-12-12 00:56:31'),
(28, 3, '{\"lname\":\"mia\",\"fname\":\"alamin\",\"phone\":\"254855\",\"email\":\"alamin@gmail.com\",\"country\":\"BD\",\"city\":\"Dhaka\",\"postcode\":\"65656\",\"address\":null}', 3, 9521.00, 50.00, 70.00, 9641.00, '41654', 'cash on delivery', 'dsdfdsf', 'delivered', '2021-11-09 22:26:11', '2022-01-02 05:03:20'),
(31, 3, '{\"lname\":\"Hossain\",\"fname\":\"Milllat\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"BD\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 1, 525.00, 50.00, 70.00, 645.00, '11016', 'cash on delivery', 'hg', 'confirmed', '2021-11-18 00:59:02', '2022-01-02 05:32:09'),
(41, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"BD\",\"city\":\"Chittagong\",\"postcode\":\"Rasel\",\"address\":null}', 2, 2524.00, 50.00, 70.00, 2644.00, '89038', 'cash on delivery', 'hghjhk', 'processing', '2021-12-28 03:17:18', '2022-01-02 05:01:15'),
(48, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"BD\",\"city\":\"Chittagong\",\"postcode\":\"Rasel\",\"address\":null}', 1, 2100.00, 50.00, 70.00, 2220.00, '95780', 'cash on delivery', 'bvb', 'delivered', '2021-12-28 03:29:40', '2022-01-02 05:02:28'),
(49, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 2, 9046.00, 50.00, 70.00, 9166.00, '90234', 'cash on delivery', 'gvfg', 'pending', '2022-01-04 06:19:22', '2022-01-04 06:19:22'),
(50, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 0, 0.00, 50.00, 70.00, 120.00, '41037', 'cash on delivery', 'gvfg', 'pending', '2022-01-04 06:20:13', '2022-01-04 06:20:13'),
(51, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 0, 0.00, 50.00, 70.00, 120.00, '12288', 'cash on delivery', 'gvfg', 'pending', '2022-01-04 06:21:49', '2022-01-04 06:21:49'),
(52, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 0, 0.00, 50.00, 70.00, 120.00, '14000', 'cash on delivery', 'gvfg', 'pending', '2022-01-04 06:21:57', '2022-01-04 06:21:57'),
(53, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 1, 1999.00, 50.00, 70.00, 2119.00, '11585', 'cash on delivery', NULL, 'pending', '2022-01-04 06:22:37', '2022-01-04 06:22:37'),
(54, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 0, 0.00, 50.00, 70.00, 120.00, '66937', 'cash on delivery', NULL, 'pending', '2022-01-04 06:24:20', '2022-01-04 06:24:20'),
(55, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 0, 0.00, 50.00, 70.00, 120.00, '22940', 'cash on delivery', NULL, 'pending', '2022-01-04 06:24:57', '2022-01-04 06:24:57'),
(56, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 0, 0.00, 50.00, 70.00, 120.00, '22542', 'cash on delivery', NULL, 'pending', '2022-01-04 06:25:11', '2022-01-04 06:25:11'),
(57, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 0, 0.00, 50.00, 70.00, 120.00, '28957', 'cash on delivery', NULL, 'pending', '2022-01-04 06:26:49', '2022-01-04 06:26:49'),
(58, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 0, 0.00, 50.00, 70.00, 120.00, '29343', 'cash on delivery', NULL, 'pending', '2022-01-04 06:27:17', '2022-01-04 06:27:17'),
(59, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Dhaka\",\"postcode\":\"12545\",\"address\":null}', 0, 0.00, 50.00, 70.00, 120.00, '99097', 'cash on delivery', NULL, 'pending', '2022-01-04 06:27:30', '2022-01-04 06:27:30'),
(60, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Khulna\",\"postcode\":\"12545\",\"address\":null}', 3, 7047.00, 50.00, 70.00, 7167.00, '27221', 'cash on delivery', NULL, 'pending', '2022-01-04 06:28:40', '2022-01-04 06:28:40'),
(61, 3, '{\"lname\":\"Rasel\",\"fname\":\"Rasel\",\"phone\":\"01964719349\",\"email\":\"raselrana1147@gmail.com\",\"country\":\"Bangladesh\",\"city\":\"Khulna\",\"postcode\":\"12545\",\"address\":null}', 0, 0.00, 50.00, 70.00, 120.00, '83596', 'cash on delivery', NULL, 'declined', '2022-01-04 06:30:38', '2022-01-04 06:30:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_commissions`
--

CREATE TABLE `order_commissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `sub_total` double(8,2) NOT NULL,
  `tax` double(8,2) NOT NULL,
  `charge` double(8,2) NOT NULL,
  `grand_total` double(8,2) NOT NULL,
  `seller_amount` double(11,2) NOT NULL,
  `company_will_get` double(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_commissions`
--

INSERT INTO `order_commissions` (`id`, `order_id`, `sub_total`, `tax`, `charge`, `grand_total`, `seller_amount`, `company_will_get`, `created_at`, `updated_at`) VALUES
(8, 28, 9521.00, 50.00, 70.00, 9641.00, 8568.90, 952.10, '2021-12-18 00:56:29', '2021-12-18 00:56:29'),
(9, 27, 5048.00, 50.00, 70.00, 5168.00, 4543.20, 504.80, '2021-12-18 00:56:31', '2021-12-18 00:56:31'),
(10, 31, 525.00, 50.00, 70.00, 645.00, 472.50, 52.50, '2021-12-18 01:02:42', '2021-12-18 01:02:42'),
(11, 48, 2100.00, 50.00, 70.00, 2220.00, 1890.00, 210.00, '2022-01-02 04:46:48', '2022-01-02 04:46:48'),
(12, 41, 2524.00, 50.00, 70.00, 2644.00, 2271.60, 252.40, '2022-01-02 04:48:08', '2022-01-02 04:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED DEFAULT NULL,
  `color_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_quantity` int(11) NOT NULL,
  `is_flash_deal` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `flash_deal_amount` double(8,2) DEFAULT NULL COMMENT 'flash is counted as %',
  `status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=delivered,2=not delivered',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `seller_id`, `order_id`, `product_id`, `size_id`, `color_id`, `product_quantity`, `is_flash_deal`, `flash_deal_amount`, `status`, `created_at`, `updated_at`) VALUES
(79, 6, 27, 19, 3, 3, 1, 0, NULL, 1, '2021-12-13 05:18:40', '2021-12-13 05:18:40'),
(80, 6, 27, 19, 3, 5, 1, 0, NULL, 1, '2021-12-13 05:18:40', '2021-12-13 05:18:40'),
(81, 4, 27, 15, 1, 2, 2, 0, NULL, 1, '2021-12-13 05:18:40', '2021-12-13 05:18:40'),
(82, 4, 28, 15, 1, 2, 2, 0, NULL, 1, '2021-12-13 22:26:11', '2021-12-13 22:26:11'),
(83, 4, 28, 13, 3, 4, 1, 0, NULL, 1, '2021-12-13 22:26:11', '2021-12-13 22:26:11'),
(84, 6, 28, 19, 3, 3, 1, 0, NULL, 1, '2021-12-13 22:26:11', '2021-12-13 22:26:11'),
(85, 6, 31, 19, 3, 5, 1, 0, NULL, 1, '2021-12-18 00:59:02', '2021-12-18 00:59:02'),
(86, 6, 41, 19, 3, 5, 1, 0, NULL, 1, '2021-12-28 03:17:18', '2021-12-28 03:17:18'),
(87, 4, 41, 15, 3, 3, 1, 0, NULL, 1, '2021-12-28 03:17:18', '2021-12-28 03:17:18'),
(88, 6, 48, 19, 3, 3, 4, 0, NULL, 1, '2021-12-28 03:29:40', '2021-12-28 03:29:40'),
(89, 4, 49, 15, 1, 2, 4, 0, NULL, 1, '2022-01-04 06:19:22', '2022-01-04 06:19:22'),
(90, 6, 49, 19, 3, 5, 2, 0, NULL, 1, '2022-01-04 06:19:22', '2022-01-04 06:19:22'),
(91, 4, 53, 15, 1, 2, 1, 0, NULL, 1, '2022-01-04 06:22:37', '2022-01-04 06:22:37'),
(92, 4, 60, 15, 1, 2, 1, 0, NULL, 1, '2022-01-04 06:28:40', '2022-01-04 06:28:40'),
(93, 4, 60, 15, 3, 3, 2, 0, NULL, 1, '2022-01-04 06:28:40', '2022-01-04 06:28:40'),
(94, 6, 60, 19, 3, 5, 2, 0, NULL, 1, '2022-01-04 06:28:40', '2022-01-04 06:28:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seller_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `last_ordered_at` timestamp NULL DEFAULT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `total_order` int(11) NOT NULL DEFAULT 0,
  `brand_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_price` double(11,2) DEFAULT NULL,
  `previous_price` double(11,2) DEFAULT NULL,
  `current_price` double(11,2) NOT NULL,
  `discount` double(11,2) NOT NULL,
  `thumbnail` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `video_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_keyword` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `click` int(11) NOT NULL DEFAULT 0,
  `stock_type` enum('limited','unlimited') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_impression` int(11) NOT NULL DEFAULT 0,
  `sale_type` enum('whole','retail') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'retail',
  `whole_sale_quantity` int(11) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specification` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_policy` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_raw` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `allow_negetive_stock` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=yes,1=no',
  `flash_deal` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `featured` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `best_sale` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `hot` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `top_sale` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=not',
  `big_save` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=now',
  `new_arrival` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `trending` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `check_attributes` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=yes,1=no',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `title`, `seller_id`, `category_id`, `product_type_id`, `last_ordered_at`, `sub_category_id`, `total_order`, `brand_id`, `purchase_price`, `previous_price`, `current_price`, `discount`, `thumbnail`, `tag`, `slug`, `view`, `video_link`, `meta_title`, `meta_keyword`, `meta_description`, `click`, `stock_type`, `total_impression`, `sale_type`, `whole_sale_quantity`, `description`, `specification`, `return_policy`, `is_raw`, `allow_negetive_stock`, `flash_deal`, `featured`, `best_sale`, `hot`, `top_sale`, `big_save`, `new_arrival`, `trending`, `check_attributes`, `created_at`, `updated_at`) VALUES
(3, 'Half Silk Saree for Women', 'Half Silk Saree for Women', 4, 5, 1, NULL, 7, 0, 1, 5000.00, 5000.00, 5000.00, 0.00, 'fq1lb3zhek1637562430.jpg', NULL, 'hamim-ksr21snxefgrg', 1, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 0, 1, 1, 0, 0, 0, 1, 0, 0, 1, 0, '2021-11-22 00:27:10', '2021-12-29 06:18:31'),
(4, 'Jhum Saree for Women Black', 'Jhum Saree for Women Black', 4, 5, 1, NULL, 6, 0, 4, 5000.00, 7000.00, 6500.00, 7.14, '1hgsf3t1oe1637562631.jpg', NULL, 'hamim-ksr21snxfe', 0, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, 0, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, '2021-11-22 00:30:32', '2021-11-22 00:30:32'),
(5, 'Jhum Saree for Women', 'Jhum Saree for Women', 4, 5, 1, NULL, 6, 0, 1, 5700.00, 6000.00, 5998.00, 0.03, 'drp6vhdadq1637562784.jpg', NULL, 'hamim-ksr21snxdd', 0, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 0, 1, 0, 1, 0, 0, 0, 0, 0, 1, 0, '2021-11-22 00:33:04', '2021-11-22 00:33:04'),
(6, 'Maslaish Cotton Saree for Women', 'Maslaish Cotton Saree for Women', 4, 5, 1, NULL, 6, 0, 1, 10000.00, 12000.00, 10000.00, 16.67, 'ayqij3jmzi1637562883.jpg', NULL, 'hamim-ksr21snx234', 18, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 0, 1, 0, 0, 0, 0, 1, 0, 0, 1, 0, '2021-11-22 00:34:43', '2022-01-02 02:01:13'),
(7, 'Maslies Cotton sari for Women', 'Maslies Cotton sari for Women', 4, 5, 1, NULL, 6, 0, 4, 6000.00, 6000.00, 6000.00, 0.00, 'ig0r8vkecd1637562986.jpg', NULL, 'hamim-ksr21snx22', 0, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0, '2021-11-22 00:36:27', '2021-12-05 05:46:44'),
(8, 'Winter Shal for Women', 'Winter Shal for Women', 4, 5, 1, NULL, 6, 0, 1, 2000.00, 2200.00, 2199.00, 0.05, 'woprgejank1637563131.jpg', NULL, 'hamim-ksr21snx121', 4, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, '2021-11-22 00:38:51', '2022-01-04 22:56:46'),
(9, 'Ash Winter Dhakai Shaal Chador for Women', 'Ash Winter Dhakai Shaal Chador for Women', 4, 5, 1, NULL, 6, 0, 1, 2500.00, 2500.00, 2500.00, 0.00, '0gkluxqbnw1637563169.jpg', NULL, 'hamim-ksr21snx123', 14, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 0, 1, 0, 1, 0, 0, 0, 0, 0, 1, 0, '2021-11-22 00:39:30', '2021-12-29 03:13:48'),
(10, 'Tangail Silk Jamdani Taat Sharee', 'Tangail Silk Jamdani Taat Sharee', 4, 5, 1, NULL, 6, 0, 3, 3600.00, 3800.00, 3799.00, 0.03, 'sdtigtpxqo1637563281.jpg', NULL, 'hamim-ksr21snx14', 5, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-22 00:41:22', '2022-01-04 22:59:09'),
(13, 'Multi functig Chair with Adjustable Angle and Safety Belt', 'Multi functional Premium Baby Rocking Chair with Adjustable Angle and Safety Belt', 4, 12, 3, '2021-11-09 22:26:11', 13, 1, 4, 5000.00, 5000.00, 4998.00, 0.04, 'v2ziwieejv1637563543.jpg', NULL, 'hamim-ksr21snx13', 0, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 0, 1, 0, 1, 0, 0, 1, 0, 0, 0, 0, '2021-11-22 00:45:44', '2022-01-02 05:03:20'),
(14, '5in1 Ya.Ya.Ya. Rocker Bassinet', '5in1 Ya.Ya.Ya. Rocker Bassinet', 4, 12, 1, NULL, 13, 0, 1, 1499.00, 1500.00, 1500.00, 0.00, 'hrnyho5ehw1637563595.jpg', NULL, 'hamim-ksr21snx11', 3, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, 0, 1, 0, 1, 0, 0, 0, 0, 0, 1, 0, '2021-11-22 00:46:36', '2022-01-15 01:06:01'),
(15, 'Baby Carrier Comfort Wrap Bag,', 'Baby Carrier Comfort Wrap Bag,', 4, 12, 1, '2021-11-09 22:26:11', 13, 1, 3, 2000.00, 2000.00, 1999.00, 0.05, 'xmz7e20lqk1637563670.jpg', NULL, 'hamim-ksr21snx412', 16, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'whole', 20, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-11-22 00:47:50', '2022-01-06 05:46:26'),
(16, 'Infant to Toddler Rocker Chair New Boron (Pink)', 'Infant to Toddler Rocker Chair New Boron (Pink)', 4, 12, 1, NULL, 13, 0, 3, 3000.00, 3000.00, 2999.00, 0.03, 'vcvrn826se1637563756.jpg', NULL, 'hamim-ksr21snx43', 15, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, '2021-11-22 00:49:17', '2022-01-04 22:56:52'),
(17, 'From The Same Store', 'From The Same Store', 4, 12, 1, NULL, 13, 0, 4, 1200.00, 1500.00, 1500.00, 0.00, '822rilhzhh1637563820.jpg', NULL, 'hamim-ksr21snx34', 44, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', NULL, NULL, 0, 1, 0, 1, 0, 0, 0, 0, 0, 1, 0, '2021-11-22 00:50:20', '2022-01-02 03:19:14'),
(18, 'realme C21Y - 4GB RAM/64GB ROM', 'realme C21Y - 4GB RAM/64GB ROM', 4, 8, 2, NULL, 9, 0, 4, 12490.00, 12490.00, 12490.00, 0.00, '3ph4bojfvl1638617934.png', NULL, 'hamim-ksr21snx3', 1, NULL, NULL, NULL, NULL, 0, 'unlimited', 0, 'whole', 10, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', '<p><strong style=\"margin: 0px; padding: 0px; font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">Lorem Ipsum</strong><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span><br></p>', 0, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, '2021-11-22 00:52:25', '2022-01-02 05:19:24'),
(19, 'Trendy Collection with Elegant Style Flat Muslin Than Saree For Women', 'Trendy Collection with Elegant Style Flat Muslin Than Saree For Women', 6, 5, 1, '2021-11-09 22:26:11', 6, 2, 5, 580.00, 577.00, 525.00, 9.01, '3ddhbcdnnn1639290644.jpg', NULL, 'hamim-ksr21snx2', 122, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like</span><br></p>', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like</span><br></p>', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-12 00:30:45', '2022-01-06 05:59:01'),
(20, 'Blue Rich Fabric Weightless Jamdani Sharee for Women', 'Blue Rich Fabric Weightless Jamdani Sharee for Women', 6, 5, 1, NULL, 6, 0, 9, 5500.00, 500.00, 198.00, 60.40, 'oehzdbwhwl1639291140.jpg', NULL, 'hamim-ksr21snxd', 2, NULL, NULL, NULL, NULL, 0, 'limited', 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like</span><br></p>', '<p><span style=\"font-family: &quot;Open Sans&quot;, Arial, sans-serif; text-align: justify;\">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like</span><br></p>', 0, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, '2021-12-12 00:39:01', '2022-01-02 02:01:49'),
(21, 'Hamim', NULL, 6, 11, 1, NULL, 14, 0, 7, 50.00, 50.00, 50.00, 0.00, 'meyf8goqxv1640666230.jpg', '[\"ami\",\"tim\",\"se\",\"nai\"]', 'hamim-ksr21snx', 5, 'https://www.youtube.com/watch?v=5HrgUsqY_hY', 'meta', '[\"na\",\"ase\",\"kokon\",\"mkm\",\"sss\",\"swwww\"]', '<p>dsd</p>', 0, NULL, 0, 'retail', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '<p>ds</p>', '<p>dsd</p>', 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2021-12-27 22:37:11', '2022-01-14 23:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'normal', NULL, NULL),
(2, 'digital', NULL, NULL),
(3, 'physical', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `ratting` int(11) NOT NULL,
  `review` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `ratting`, `review`, `name`, `email`, `created_at`, `updated_at`) VALUES
(26, 3, 19, 4, 'rr', 'ee', 'admin@rideshare.com', '2021-12-29 02:41:19', '2021-12-29 02:41:19'),
(27, 3, 19, 3, 'rr', 'ee', 'admin@rideshare.com', '2021-12-29 02:41:25', '2021-12-29 02:41:25'),
(28, 3, 19, 5, 'rr', 'ee', 'admin@rideshare.com', '2021-12-29 02:41:29', '2021-12-29 02:41:29'),
(29, 3, 10, 5, 'fgfdg', 'Hamim', 'seller@gmail.com', '2021-12-29 02:41:50', '2021-12-29 02:41:50'),
(30, 3, 9, 3, 'tt', 'tt', 'admin@rideshare.com', '2021-12-29 03:01:37', '2021-12-29 03:01:37'),
(31, 3, 9, 4, 'dd', 'Hamim', 'raselrana1147@gmail.com', '2021-12-29 03:08:51', '2021-12-29 03:08:51'),
(32, 3, 9, 2, 'sss', 'Hamim', 'admin@rideshare.com', '2021-12-29 03:09:08', '2021-12-29 03:09:08'),
(33, 3, 9, 5, 'ss', 'ss', 'admin@rideshare.com', '2021-12-29 03:09:20', '2021-12-29 03:09:20'),
(34, NULL, 16, 4, 'dd', 'dd', 'admin@gmail.com', '2021-12-29 03:48:38', '2021-12-29 03:48:38'),
(35, NULL, 3, 4, 'ss', 'story', 'raselrana1147@gmail.com', '2021-12-29 06:18:41', '2021-12-29 06:18:41'),
(36, NULL, 6, 5, 'cddfd', 'ghfh', 'raselrana1147@gmail.com', '2022-01-02 01:04:41', '2022-01-02 01:04:41'),
(37, NULL, 6, 4, 'vg', 'Hamim', 'admin@rideshare.com', '2022-01-02 01:23:56', '2022-01-02 01:23:56'),
(38, NULL, 6, 4, 'gfh', 'Half Silk Saree for Women', 'arif@gmail.com', '2022-01-02 01:35:24', '2022-01-02 01:35:24'),
(39, NULL, 6, 2, 'gf', 'd', 'arif@gmail.com', '2022-01-02 01:36:11', '2022-01-02 01:36:11'),
(40, NULL, 6, 4, 'fgd', 'test', 'arif@gmail.com', '2022-01-02 01:36:25', '2022-01-02 01:36:25'),
(41, NULL, 6, 5, 'jhg', 'index', 'raselrana1147@gmail.com', '2022-01-02 01:37:02', '2022-01-02 01:37:02'),
(42, NULL, 6, 4, 'gf', 'index', 'arif@gmail.com', '2022-01-02 01:37:44', '2022-01-02 01:37:44'),
(43, NULL, 6, 3, 'fd', 'test', 'admin@roadhelperbd.com', '2022-01-02 01:38:11', '2022-01-02 01:38:11'),
(44, NULL, 6, 3, 'dfd', 'fdf', 'raselrana1147@gmail.com', '2022-01-02 01:54:06', '2022-01-02 01:54:06'),
(45, NULL, 6, 5, 'fd', 'Hamim', 'raselrana1147@gmail.com', '2022-01-02 01:56:59', '2022-01-02 01:56:59'),
(46, NULL, 6, 5, 'fd', 'Hamim', 'raselrana1147@gmail.com', '2022-01-02 01:57:03', '2022-01-02 01:57:03'),
(47, NULL, 6, 1, 'fdf', 'Hamim', 'raselrana1147@gmail.com', '2022-01-02 02:00:50', '2022-01-02 02:00:50'),
(48, NULL, 20, 3, 'fgfg', 'gf', 'raselrana1147@gmail.com', '2022-01-02 02:01:40', '2022-01-02 02:01:40');

-- --------------------------------------------------------

--
-- Table structure for table `shop_logos`
--

CREATE TABLE `shop_logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size_name`, `size`, `created_at`, `updated_at`) VALUES
(1, 'Small', 'S', '2021-11-22 23:25:37', '2021-11-22 23:25:37'),
(2, 'Large', 'L', '2021-11-22 23:36:37', '2021-11-22 23:36:37'),
(3, 'Extra Large', 'XL', '2021-11-22 23:36:50', '2021-11-22 23:36:50'),
(4, 'Medium', 'M', '2021-11-22 23:36:59', '2021-11-22 23:36:59');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_2` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `button_title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title_1`, `title_2`, `price`, `button_title`, `url`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Mega Offer', 'Buy more get more', 300.00, 'Deal Now', 'http://localhost/DPG_Marketplace/', 'ape1pgimc41638084588.jpg', '2021-11-28 00:40:34', '2021-11-28 01:29:48'),
(2, 'New Year Offer', 'Only for one Week', NULL, 'Start Now', 'http://localhost/DPG_Marketplace/', 'ydt5biulzp1638081840.jpg', '2021-11-28 00:44:01', '2021-11-28 00:44:01'),
(3, NULL, NULL, NULL, NULL, NULL, '4si8lrx9he1638082456.jpg', '2021-11-28 00:54:18', '2021-11-28 00:54:18'),
(4, NULL, NULL, NULL, NULL, NULL, 'ngbxxke1vc1638082496.jpg', '2021-11-28 00:54:58', '2021-11-28 00:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `color_id` bigint(20) UNSIGNED NOT NULL,
  `size_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `color_id`, `size_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 18, 5, 3, 10, '2021-11-23 23:27:41', '2021-11-23 23:35:13'),
(2, 18, 2, 4, 18, '2021-11-23 23:30:09', '2021-11-23 23:35:52'),
(3, 15, 3, 3, 10, '2021-11-23 23:30:28', '2021-11-23 23:30:28'),
(4, 15, 2, 1, 11, '2021-11-23 23:30:37', '2021-12-14 03:27:13'),
(6, 13, 4, 3, 9, '2021-12-04 06:00:39', '2021-12-14 03:27:13'),
(7, 20, 5, 4, 10, '2021-12-12 00:43:30', '2021-12-13 05:06:18'),
(8, 20, 4, 3, 20, '2021-12-12 00:43:44', '2021-12-12 00:43:44'),
(9, 20, 1, 1, 10, '2021-12-12 00:44:45', '2021-12-12 00:44:45'),
(10, 20, 4, 4, 10, '2021-12-12 00:44:53', '2021-12-12 00:44:53'),
(11, 19, 3, 3, 0, '2021-12-12 00:45:27', '2022-01-02 05:00:27'),
(13, 19, 5, 3, 8, '2021-12-12 00:45:50', '2022-01-02 05:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_balance` float(11,2) NOT NULL DEFAULT 0.00,
  `pending_balance` float(11,2) NOT NULL DEFAULT 0.00,
  `display_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tenant_id` bigint(20) UNSIGNED DEFAULT NULL,
  `referral_id` bigint(20) UNSIGNED DEFAULT NULL,
  `company_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_verified_at` timestamp NULL DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `account_verified_at` timestamp NULL DEFAULT NULL,
  `profile_image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner_image_url` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `possitive_ratting` double(11,2) NOT NULL DEFAULT 0.00,
  `shipping_ratting` double(11,2) NOT NULL DEFAULT 0.00,
  `response_ratting` double(11,2) NOT NULL DEFAULT 0.00,
  `is_tenant_admin` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `is_system_admin` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `is_verified` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `is_company_sale_profile` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `default_service_charge` double(8,2) DEFAULT NULL,
  `discount_on_service_charge` double(8,2) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `full_name`, `main_balance`, `pending_balance`, `display_id`, `tenant_id`, `referral_id`, `company_id`, `role_id`, `user_type`, `username`, `gender`, `password`, `email`, `address`, `country_code`, `phone`, `account_type`, `referral_code`, `mobile_verified_at`, `email_verified_at`, `account_verified_at`, `profile_image_url`, `banner_image_url`, `tag`, `shop_name`, `shop_logo`, `possitive_ratting`, `shipping_ratting`, `response_ratting`, `is_tenant_admin`, `is_system_admin`, `is_verified`, `is_company_sale_profile`, `default_service_charge`, `discount_on_service_charge`, `status`, `is_active`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Raseld', 'Rana', 'Raseld Rana', 0.00, 0.00, NULL, NULL, NULL, NULL, 1, 'customer', NULL, 'Male', '$2y$10$0t54e1kW5IenfHh3cAKlMu.cZMASUDLegpHtvKL1nTFc8mxODOAiy', 'raselrana1147@gmail.com', 'Principal Au Kashem Road Mirpur 1, Dhaka', NULL, '01964719349', NULL, NULL, NULL, NULL, NULL, 'btsri46aav1641379471.jpg', NULL, NULL, '', NULL, 0.00, 0.00, 0.00, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, '2021-11-18 00:11:23', '2022-01-05 04:55:13'),
(4, 'Seller', 'Seller', 'Seller Seller', 25188.30, 0.00, NULL, NULL, NULL, NULL, 1, 'seller', NULL, NULL, '$2y$10$V9JgQ.upOIbAXbK.w2A.sOGO2qPAveLmgwK0L2ju73CI6bp8.VlQW', 'seller@gmail.com', 'shop_name', NULL, '019647193493', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'My Shop', NULL, 0.00, 0.00, 0.00, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, '2021-11-18 00:47:43', '2022-01-02 04:48:08'),
(5, 'Admin', 'Admin', 'Admin Admin', 0.00, 0.00, NULL, NULL, NULL, NULL, 1, 'admin', NULL, 'Male', '$2y$10$FgiFlzjiGAW8a2bbqYvkGeAD/LVn/9ofnkuAlMaLevnyN7uf/3lFe', 'admin@gmail.com', 'Mirpur-1', NULL, '01777330786', NULL, NULL, NULL, NULL, NULL, '6b52pqvv5k1642224082.jpeg', NULL, NULL, NULL, NULL, 0.00, 0.00, 0.00, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, '2021-11-18 02:26:43', '2022-01-14 23:37:53'),
(6, 'Arifhhh', 'Arif', 'Arifhhh Arif', 5308.00, 0.00, NULL, NULL, NULL, NULL, 1, 'seller', NULL, 'Male', '$2y$10$pI0l3JyiRDGx3bC.KFUG5e6pGEEqtgxxDC1C/kK6Yr6N9FzoLHODK', 'arif@gmail.com', 'Mirpur 2', NULL, '017444600100', NULL, NULL, NULL, NULL, NULL, 'a2pswmlpzw1641641638.jpeg', NULL, NULL, 'arif enterpricegfvhbgf', 'qimrzs5t5p1641730713.jpeg', 0.00, 0.00, 0.00, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, '2021-12-12 00:23:07', '2022-01-09 06:18:33');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(53, 3, 15, '2022-01-15 00:27:21', '2022-01-15 00:27:21'),
(54, 3, 6, '2022-01-15 00:27:28', '2022-01-15 00:27:28'),
(55, 3, 9, '2022-01-15 00:28:13', '2022-01-15 00:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `withdraws`
--

CREATE TABLE `withdraws` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_id` bigint(20) UNSIGNED DEFAULT NULL,
  `withdraw_amount` double(8,2) NOT NULL,
  `account_holder_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` double(8,2) NOT NULL DEFAULT 0.00,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','accept','reject') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdraws`
--

INSERT INTO `withdraws` (`id`, `seller_id`, `withdraw_amount`, `account_holder_name`, `account_number`, `bank_name`, `branch_name`, `fee`, `note`, `comment`, `status`, `type`, `created_at`, `updated_at`) VALUES
(3, 6, 500.00, 'Rasel Rana', '55935', 'IBBL', 'Mirpur-1', 0.00, 'This is argent withdraw. Please process it very fast', NULL, 'pending', 'seller', '2021-12-14 05:24:40', '2021-12-15 00:22:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billing_details`
--
ALTER TABLE `billing_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billing_details_user_id_foreign` (`user_id`),
  ADD KEY `billing_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `campare_lists`
--
ALTER TABLE `campare_lists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `campare_lists_user_id_foreign` (`user_id`),
  ADD KEY `campare_lists_product_id_foreign` (`product_id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `carts_user_id_foreign` (`user_id`),
  ADD KEY `carts_seller_id_foreign` (`seller_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`),
  ADD KEY `carts_size_id_foreign` (`size_id`),
  ADD KEY `carts_color_id_foreign` (`color_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categories_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `commission_details`
--
ALTER TABLE `commission_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commission_details_seller_id_foreign` (`seller_id`),
  ADD KEY `commission_details_product_id_foreign` (`product_id`),
  ADD KEY `commission_details_order_id_foreign` (`order_id`);

--
-- Indexes for table `earning_histories`
--
ALTER TABLE `earning_histories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `earning_histories_order_id_foreign` (`order_id`),
  ADD KEY `earning_histories_seller_id_foreign` (`seller_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `galleries_product_id_foreign` (`product_id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_commissions`
--
ALTER TABLE `order_commissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_commissions_order_id_foreign` (`order_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_seller_id_foreign` (`seller_id`),
  ADD KEY `order_details_order_id_foreign` (`order_id`),
  ADD KEY `order_details_product_id_foreign` (`product_id`),
  ADD KEY `order_details_size_id_foreign` (`size_id`),
  ADD KEY `order_details_color_id_foreign` (`color_id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `products_seller_id_foreign` (`seller_id`),
  ADD KEY `products_product_type_id_foreign` (`product_type_id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

--
-- Indexes for table `shop_logos`
--
ALTER TABLE `shop_logos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_logos_user_id_foreign` (`user_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_product_id_foreign` (`product_id`),
  ADD KEY `stocks_color_id_foreign` (`color_id`),
  ADD KEY `stocks_size_id_foreign` (`size_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- Indexes for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdraws_seller_id_foreign` (`seller_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billing_details`
--
ALTER TABLE `billing_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `campare_lists`
--
ALTER TABLE `campare_lists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `commission_details`
--
ALTER TABLE `commission_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `earning_histories`
--
ALTER TABLE `earning_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `order_commissions`
--
ALTER TABLE `order_commissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `shop_logos`
--
ALTER TABLE `shop_logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing_details`
--
ALTER TABLE `billing_details`
  ADD CONSTRAINT `billing_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `billing_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `campare_lists`
--
ALTER TABLE `campare_lists`
  ADD CONSTRAINT `campare_lists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `campare_lists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `commission_details`
--
ALTER TABLE `commission_details`
  ADD CONSTRAINT `commission_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commission_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `commission_details_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `earning_histories`
--
ALTER TABLE `earning_histories`
  ADD CONSTRAINT `earning_histories_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `earning_histories_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `galleries`
--
ALTER TABLE `galleries`
  ADD CONSTRAINT `galleries_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_commissions`
--
ALTER TABLE `order_commissions`
  ADD CONSTRAINT `order_commissions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_details_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_product_type_id_foreign` FOREIGN KEY (`product_type_id`) REFERENCES `product_types` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_logos`
--
ALTER TABLE `shop_logos`
  ADD CONSTRAINT `shop_logos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdraws`
--
ALTER TABLE `withdraws`
  ADD CONSTRAINT `withdraws_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
