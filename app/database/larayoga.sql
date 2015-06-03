-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.20 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-06-03 08:42:57
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for larayoga
CREATE DATABASE IF NOT EXISTS `larayoga` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `larayoga`;


-- Dumping structure for table larayoga.admins
CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.admins: ~0 rows (approximately)
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` (`id`, `username`, `password`) VALUES
	(1, 'a', 'a');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;


-- Dumping structure for table larayoga.associated_products
CREATE TABLE IF NOT EXISTS `associated_products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_product_id` int(10) DEFAULT NULL,
  `associated_product_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `update_type` varchar(50) DEFAULT 'created',
  PRIMARY KEY (`id`),
  KEY `FK_associated_products_products` (`parent_product_id`),
  KEY `FK_associated_products_products_2` (`associated_product_id`),
  CONSTRAINT `FK_associated_products_products` FOREIGN KEY (`parent_product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_associated_products_products_2` FOREIGN KEY (`associated_product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.associated_products: ~1 rows (approximately)
/*!40000 ALTER TABLE `associated_products` DISABLE KEYS */;
INSERT INTO `associated_products` (`id`, `parent_product_id`, `associated_product_id`, `created_at`, `updated_at`, `status`, `update_type`) VALUES
	(2, 19, 20, '2015-04-29 04:30:27', '2015-04-29 04:30:27', 'active', 'created');
/*!40000 ALTER TABLE `associated_products` ENABLE KEYS */;


-- Dumping structure for table larayoga.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `url_key` varchar(255) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image_name` varchar(255) DEFAULT NULL,
  `image_saved_name` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `sort_order` int(11) DEFAULT '0',
  `page_title` varchar(255) DEFAULT NULL,
  `header_data` text,
  `custom_json_data` text,
  `status` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `update_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.categories: ~12 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `url_key`, `parent_id`, `image_name`, `image_saved_name`, `description`, `sort_order`, `page_title`, `header_data`, `custom_json_data`, `status`, `created_at`, `updated_at`, `update_type`) VALUES
	(2, 'aaa', 'aaa', -1, 'Lighthouse.jpg', '1429498702.jpg', 'acaa', 1, NULL, NULL, NULL, 'active', '2015-04-12 08:03:20', '2015-04-20 02:58:22', 'Sort order updated'),
	(3, 'a11', 'a11', 2, 'Chrysanthemum.jpg', '1429072222.jpg', 'abc', 0, NULL, NULL, NULL, 'active', '2015-04-12 08:03:37', '2015-04-15 04:30:22', NULL),
	(4, 'a2', 'a2', 2, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'active', '2015-04-12 08:03:37', '2015-04-12 08:03:38', NULL),
	(5, 'b', 'b', -1, 'Tulips.jpg', '1429069867.jpg', 'ttt', 2, NULL, NULL, NULL, 'active', '2015-04-12 08:04:49', '2015-04-17 04:09:03', 'Sort order updated'),
	(6, 'b1', 'b1', 5, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'active', '2015-04-12 07:04:49', '2015-04-12 07:04:51', NULL),
	(7, 'b2', 'b2', 5, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'removed', '2015-04-12 07:04:49', '2015-04-16 05:02:06', NULL),
	(8, 'b11', 'b11', 6, NULL, NULL, NULL, 0, NULL, NULL, NULL, 'removed', '2015-04-12 07:04:49', '2015-04-16 04:54:53', NULL),
	(9, 'A3', 'a3', -1, 'Desert.jpg', '1428981913.8975jpg', 'abc', 3, NULL, NULL, NULL, 'active', '2015-04-14 03:25:13', '2015-04-17 04:09:03', 'Sort order updated'),
	(10, 'b3', 'b3', 5, 'Hydrangeas.jpg', '1428984721.0011jpg', 'aaaa', 0, NULL, NULL, NULL, 'removed', '2015-04-14 04:12:01', '2015-04-16 04:49:55', NULL),
	(11, 'a112', 'a112', 3, 'Chrysanthemum.jpg', '1429072254.871jpg', 'asdf', 0, NULL, NULL, NULL, 'removed', '2015-04-15 04:30:54', '2015-04-16 05:00:40', NULL),
	(12, 'a12', 'aa', 3, 'Desert.jpg', '1429497571.5885jpg', 'abc', 0, NULL, NULL, NULL, 'active', '2015-04-20 02:39:31', '2015-04-20 02:39:31', NULL),
	(13, 'a13', 'a13', 3, 'Hydrangeas.jpg', '1429497829.3342jpg', 'abc', 0, NULL, NULL, NULL, 'active', '2015-04-20 02:43:49', '2015-04-20 02:43:49', NULL);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table larayoga.category_products
CREATE TABLE IF NOT EXISTS `category_products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `update_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_product_categories_categories` (`category_id`),
  KEY `FK_product_categories_products` (`product_id`),
  CONSTRAINT `FK_product_categories_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_product_categories_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.category_products: ~3 rows (approximately)
/*!40000 ALTER TABLE `category_products` DISABLE KEYS */;
INSERT INTO `category_products` (`id`, `product_id`, `category_id`, `created_at`, `updated_at`, `update_type`) VALUES
	(1, 19, 6, '2015-06-03 02:49:15', '2015-06-03 02:49:15', 'Product added in category'),
	(2, 20, 6, '2015-06-03 02:49:16', '2015-06-03 02:49:16', 'Product added in category'),
	(3, 21, 6, '2015-06-03 02:49:16', '2015-06-03 02:49:16', 'Product added in category');
/*!40000 ALTER TABLE `category_products` ENABLE KEYS */;


-- Dumping structure for table larayoga.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reward_points` float DEFAULT '0',
  `activation_key` varchar(255) DEFAULT NULL,
  `activation_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL COMMENT 'pending, active, disabled, removed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.customers: ~0 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;


-- Dumping structure for table larayoga.customer_addresses
CREATE TABLE IF NOT EXISTS `customer_addresses` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `location_type` varchar(50) DEFAULT NULL COMMENT 'house, office, flat etc.',
  `address_type` varchar(50) DEFAULT NULL COMMENT 'billing, shipping',
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__customers` (`customer_id`),
  CONSTRAINT `FK__customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.customer_addresses: ~0 rows (approximately)
/*!40000 ALTER TABLE `customer_addresses` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer_addresses` ENABLE KEYS */;


-- Dumping structure for table larayoga.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `net_amount` float DEFAULT NULL,
  `reward_points_used` float DEFAULT NULL COMMENT 'reward points earned',
  `reward_point_deduction` float DEFAULT NULL COMMENT 'cost decreased from amount',
  `promo_code` varchar(50) DEFAULT NULL COMMENT 'promo code used',
  `promo_discount_deduction` float DEFAULT NULL COMMENT 'cost decreased by promo code',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT 'pending',
  PRIMARY KEY (`id`),
  KEY `FK_orders_customers` (`customer_id`),
  CONSTRAINT `FK_orders_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.orders: ~0 rows (approximately)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;


-- Dumping structure for table larayoga.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_id` int(10) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_order_items_orders` (`order_id`),
  KEY `FK_order_items_products` (`product_id`),
  CONSTRAINT `FK_order_items_orders` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  CONSTRAINT `FK_order_items_products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.order_items: ~0 rows (approximately)
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;


-- Dumping structure for table larayoga.packages
CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `update_type` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.packages: ~2 rows (approximately)
/*!40000 ALTER TABLE `packages` DISABLE KEYS */;
INSERT INTO `packages` (`id`, `name`, `description`, `created_at`, `updated_at`, `update_type`, `status`) VALUES
	(2, 'aaa', 'bbb', '2015-05-01 01:36:34', '2015-05-01 01:36:34', 'created', 'active'),
	(3, 'pack2', 'abc', '2015-06-03 02:51:30', '2015-06-03 02:51:30', 'created', 'active');
/*!40000 ALTER TABLE `packages` ENABLE KEYS */;


-- Dumping structure for table larayoga.package_products
CREATE TABLE IF NOT EXISTS `package_products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `package_id` int(10) DEFAULT NULL,
  `product_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `update_type` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__packages` (`package_id`),
  KEY `FK__products` (`product_id`),
  CONSTRAINT `FK__packages` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`),
  CONSTRAINT `FK__products` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.package_products: ~4 rows (approximately)
/*!40000 ALTER TABLE `package_products` DISABLE KEYS */;
INSERT INTO `package_products` (`id`, `package_id`, `product_id`, `created_at`, `updated_at`, `update_type`, `status`) VALUES
	(9, 2, 22, '2015-05-02 07:16:04', '2015-05-02 07:16:04', 'created', 'active'),
	(10, 2, 23, '2015-05-02 07:16:04', '2015-05-02 07:16:04', 'created', 'active'),
	(12, 3, 20, '2015-06-03 02:51:31', '2015-06-03 02:51:31', 'created', 'active'),
	(13, 3, 19, '2015-06-03 02:52:27', '2015-06-03 02:52:27', 'created', 'active');
/*!40000 ALTER TABLE `package_products` ENABLE KEYS */;


-- Dumping structure for table larayoga.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `special_price` float DEFAULT NULL,
  `pre_order` varchar(3) DEFAULT NULL,
  `url_key` varchar(255) DEFAULT NULL,
  `description` text,
  `sort_order` int(11) DEFAULT '0',
  `page_title` varchar(255) DEFAULT NULL,
  `custom_json_data` text,
  `header_data` text,
  `status` varchar(10) DEFAULT 'active' COMMENT 'active, removed, disabled',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `update_type` varchar(255) DEFAULT 'created',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sku` (`sku`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.products: ~8 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `sku`, `quantity`, `price`, `special_price`, `pre_order`, `url_key`, `description`, `sort_order`, `page_title`, `custom_json_data`, `header_data`, `status`, `created_at`, `updated_at`, `update_type`) VALUES
	(19, 'ab1', 'a2', 33, 3333, 2222, 'ab3', 'ab4', 'ab5', 0, 'ab7', 'a8', 'a9', 'active', '2015-04-26 11:07:17', '2015-04-26 11:07:17', 'imported'),
	(20, 'abc2', 'a3', 22, 444, 222, 'ab3', 'aaa', 'bbb', 0, 'abc', 'a4', 'a6', 'active', '2015-04-26 17:39:13', '2015-04-26 17:39:13', 'imported'),
	(21, 'abc3', 'a4', 23, 445, 223, 'ab4', 'aaa', 'bbb', 0, 'abc', 'a5', 'a7', 'active', '2015-04-26 17:39:13', '2015-04-26 17:39:13', 'imported'),
	(22, 'abc4', 'a5', 24, 446, 224, 'ab5', 'aaa', 'bbb', 0, 'abc', 'a6', 'a8', 'active', '2015-04-26 17:39:13', '2015-04-26 17:39:13', 'imported'),
	(23, 'abc5', 'a6', 25, 447, 225, 'ab6', 'aaa', 'bbb', 0, 'abc', 'a7', 'a9', 'active', '2015-04-26 17:39:13', '2015-04-26 17:39:13', 'imported'),
	(24, 'abc6', 'a7', 26, 448, 226, 'ab7', 'aaa', 'bbb', 0, 'abc', 'a8', 'a10', 'active', '2015-04-26 17:39:13', '2015-04-26 17:39:13', 'imported'),
	(25, 'abc7', 'a8', 27, 449, 227, 'ab8', 'aaa', 'bbb', 0, 'abc', 'a9', 'a11', 'active', '2015-04-26 17:39:13', '2015-04-26 17:39:13', 'imported'),
	(26, 'abc8', 'a9', 28, 450, 228, 'ab9', 'aaa', 'bbb', 0, 'abc', 'a10', 'a12', 'active', '2015-04-26 17:39:13', '2015-04-26 17:39:13', 'imported');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


-- Dumping structure for table larayoga.product_pictures
CREATE TABLE IF NOT EXISTS `product_pictures` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `product_id` int(10) DEFAULT NULL,
  `filename` varchar(1000) DEFAULT NULL,
  `saved_filename` varchar(1000) DEFAULT NULL,
  `data` varchar(1000) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL COMMENT 'active, removed, disabled',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.product_pictures: ~0 rows (approximately)
/*!40000 ALTER TABLE `product_pictures` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_pictures` ENABLE KEYS */;


-- Dumping structure for table larayoga.promo_codes
CREATE TABLE IF NOT EXISTS `promo_codes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `code_name` varchar(50) DEFAULT NULL,
  `code_value` float DEFAULT NULL,
  `minimum_amount` float DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.promo_codes: ~0 rows (approximately)
/*!40000 ALTER TABLE `promo_codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `promo_codes` ENABLE KEYS */;


-- Dumping structure for table larayoga.reward_points_earned
CREATE TABLE IF NOT EXISTS `reward_points_earned` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) DEFAULT NULL,
  `points` int(10) DEFAULT NULL,
  `reward_point_source` int(10) DEFAULT NULL COMMENT 'order_id, admin (-1), registration (-2), referreral (-3)',
  `created_at` datetime DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL COMMENT 'active, removed',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.reward_points_earned: ~0 rows (approximately)
/*!40000 ALTER TABLE `reward_points_earned` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_points_earned` ENABLE KEYS */;


-- Dumping structure for table larayoga.reward_points_spent
CREATE TABLE IF NOT EXISTS `reward_points_spent` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) DEFAULT NULL,
  `points` int(10) DEFAULT NULL,
  `spent_on` int(10) DEFAULT NULL COMMENT 'order (1)',
  `created_at` datetime DEFAULT NULL COMMENT 'order (1)',
  `status` varchar(10) DEFAULT NULL COMMENT 'order (1)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.reward_points_spent: ~0 rows (approximately)
/*!40000 ALTER TABLE `reward_points_spent` DISABLE KEYS */;
/*!40000 ALTER TABLE `reward_points_spent` ENABLE KEYS */;


-- Dumping structure for table larayoga.similar_products
CREATE TABLE IF NOT EXISTS `similar_products` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_product_id` int(10) DEFAULT NULL,
  `similar_product_id` int(10) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `update_type` varchar(50) DEFAULT 'created',
  PRIMARY KEY (`id`),
  KEY `FK_similar_products_products` (`parent_product_id`),
  KEY `FK_similar_products_products_2` (`similar_product_id`),
  CONSTRAINT `FK_similar_products_products` FOREIGN KEY (`parent_product_id`) REFERENCES `products` (`id`),
  CONSTRAINT `FK_similar_products_products_2` FOREIGN KEY (`similar_product_id`) REFERENCES `products` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- Dumping data for table larayoga.similar_products: ~3 rows (approximately)
/*!40000 ALTER TABLE `similar_products` DISABLE KEYS */;
INSERT INTO `similar_products` (`id`, `parent_product_id`, `similar_product_id`, `created_at`, `updated_at`, `status`, `update_type`) VALUES
	(28, 19, 23, '2015-04-29 03:43:58', '2015-04-29 03:43:58', 'active', 'created'),
	(29, 19, 25, '2015-04-29 03:43:58', '2015-04-29 03:43:58', 'active', 'created'),
	(30, 20, 19, '2015-04-30 01:25:50', '2015-04-30 01:25:50', 'active', 'created');
/*!40000 ALTER TABLE `similar_products` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
