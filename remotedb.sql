-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 21, 2017 at 05:57 PM
-- Server version: 5.5.50-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `inv_currency`
--

CREATE TABLE IF NOT EXISTS `inv_currency` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_currency_code` varchar(45) DEFAULT NULL,
  `currency_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `inv_currency`
--

INSERT INTO `inv_currency` (`id`, `inv_currency_code`, `currency_name`) VALUES
(1, 'CAD', ''),
(2, 'USD', ''),
(3, 'EUR', '');

-- --------------------------------------------------------

--
-- Table structure for table `inv_customer`
--

CREATE TABLE IF NOT EXISTS `inv_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_customer_name` varchar(45) DEFAULT NULL,
  `inv_customer_email` varchar(75) NOT NULL,
  `inv_customer_phone_number` varchar(12) NOT NULL,
  `inv_customer_company` varchar(45) NOT NULL,
  `inv_customer_street_address` varchar(45) NOT NULL,
  `inv_customer_city` tinytext NOT NULL,
  `inv_customer_province` tinytext NOT NULL,
  `inv_customer_postal_code` varchar(10) NOT NULL,
  `inv_customer_country` tinytext NOT NULL,
  `inv_currency_inv_currency_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inv_customer_inv_currency1_idx` (`inv_currency_inv_currency_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_customer_has_wp_users`
--

CREATE TABLE IF NOT EXISTS `inv_customer_has_wp_users` (
  `inv_customer_inv_customer_id` int(11) NOT NULL,
  `wp_users_id_users` int(11) NOT NULL,
  PRIMARY KEY (`inv_customer_inv_customer_id`,`wp_users_id_users`),
  KEY `fk_inv_customer_has_wp_users_wp_users1_idx` (`wp_users_id_users`),
  KEY `fk_inv_customer_has_wp_users_inv_customer1_idx` (`inv_customer_inv_customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_i18n_entity`
--

CREATE TABLE IF NOT EXISTS `inv_i18n_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_i18n_string`
--

CREATE TABLE IF NOT EXISTS `inv_i18n_string` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_i18n_string_locale` varchar(45) DEFAULT NULL,
  `inv_i18n_string_value` text,
  `inv_i18n_entity_inv_i18n_entity_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inv_i18n_string_inv_i18n_entity1_idx` (`inv_i18n_entity_inv_i18n_entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_inventory`
--

CREATE TABLE IF NOT EXISTS `inv_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_inventory_date` datetime DEFAULT NULL,
  `wp_users_id_users` int(11) NOT NULL,
  `inv_location_inv_location_id` int(11) NOT NULL,
  PRIMARY KEY (`inv_location_inv_location_id`),
  UNIQUE KEY `inv_inventory_id_UNIQUE` (`id`),
  KEY `fk_inv_inventory_wp_users1_idx` (`wp_users_id_users`),
  KEY `fk_inv_inventory_inv_location1_idx` (`inv_location_inv_location_id`),
  KEY `inv_location_inv_location_id` (`inv_location_inv_location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_inventory_line`
--

CREATE TABLE IF NOT EXISTS `inv_inventory_line` (
  `id` int(11) NOT NULL,
  `inv_inventory_line_amount` float DEFAULT NULL,
  `inv_inventory_inv_inventory_id` int(11) NOT NULL,
  `inv_inventory_units_inv_inventory_units_id` int(11) NOT NULL,
  `inv_supplier_inv_supplier_id` int(11) NOT NULL,
  `inv_product_id_inv_product` int(11) NOT NULL,
  `inv_inventory_line_user_id` int(11) NOT NULL,
  `inv_inventory_line_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `inv_location_line_inv_location_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inv_inventory_line_inv_inventory1_idx` (`inv_inventory_inv_inventory_id`),
  KEY `fk_inv_inventory_line_inv_inventory_units1_idx` (`inv_inventory_units_inv_inventory_units_id`),
  KEY `fk_inv_inventory_line_inv_supplier1_idx` (`inv_supplier_inv_supplier_id`),
  KEY `fk_inv_inventory_line_inv_product1_idx` (`inv_product_id_inv_product`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_inventory_units`
--

CREATE TABLE IF NOT EXISTS `inv_inventory_units` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_inventory_units_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_location`
--

CREATE TABLE IF NOT EXISTS `inv_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_location_name` varchar(45) DEFAULT NULL,
  `inv_location_parent` enum('location','section','shelf') DEFAULT NULL,
  `inv_location_street_address` varchar(45) NOT NULL,
  `inv_location_city` tinytext NOT NULL,
  `inv_location_province` tinytext NOT NULL,
  `inv_location_postal_code` varchar(10) NOT NULL,
  `inv_location_country` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `inv_location_id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_order_data`
--

CREATE TABLE IF NOT EXISTS `inv_order_data` (
  `inv_order_orderid` int(11) NOT NULL AUTO_INCREMENT,
  `inv_order_datetime` datetime NOT NULL,
  `inv_customer_inv_customer_id` int(11) NOT NULL,
  `inv_supplier_inv_supplier_id` int(11) NOT NULL,
  `inv_order_total` int(11) DEFAULT NULL,
  PRIMARY KEY (`inv_order_orderid`),
  KEY `fk_inv_stock_inv_customer1_idx` (`inv_customer_inv_customer_id`),
  KEY `fk_inv_stock_inv_supplier1_idx` (`inv_supplier_inv_supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_order_details`
--

CREATE TABLE IF NOT EXISTS `inv_order_details` (
  `id` int(11) NOT NULL,
  `inv_order_line_qty` float DEFAULT NULL,
  `inv_product_id_inv_product` int(11) NOT NULL,
  `inv_inventory_units_inv_inventory_units_id` int(11) NOT NULL,
  `inv_stock_line_pricepunit` float DEFAULT NULL,
  `inv_currency_inv_currency_id` int(11) NOT NULL,
  `inv_order_data_inv_orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`,`inv_order_data_inv_orderid`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_inv_stock_line_inv_product1_idx` (`inv_product_id_inv_product`),
  KEY `fk_inv_stock_line_inv_inventory_units1_idx` (`inv_inventory_units_inv_inventory_units_id`),
  KEY `fk_inv_stock_line_inv_currency1_idx` (`inv_currency_inv_currency_id`),
  KEY `fk_inv_order_data_inv_order_detail` (`inv_order_data_inv_orderid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_product`
--

CREATE TABLE IF NOT EXISTS `inv_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_product_name` tinytext NOT NULL,
  `inv_product_barcode` varchar(100) NOT NULL,
  `inv_product_size` int(11) NOT NULL,
  `inv_product_full_weight` int(11) NOT NULL,
  `inv_product_empty_weight` int(11) NOT NULL,
  `inv_product_cost` int(11) NOT NULL,
  `inv_i18n_entity_name` int(11) NOT NULL,
  `inv_product_category_id` int(11) DEFAULT NULL,
  `inv_product_supplier_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inv_product_inv_i18n_entity1_idx` (`inv_i18n_entity_name`),
  KEY `fk_inv_product_inv_product_cat_idx` (`inv_product_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_product_cat`
--

CREATE TABLE IF NOT EXISTS `inv_product_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_product_cat_name` varchar(45) NOT NULL,
  `inv_product_cat_parent` int(11) NOT NULL,
  `inv_product_cat_desc` text,
  `inv_i18n_entitie_name` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inv_product_cat_inv_i18n_entitie1_idx` (`inv_i18n_entitie_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_product_recipe_mapping`
--

CREATE TABLE IF NOT EXISTS `inv_product_recipe_mapping` (
  `inv_product_id_inv_product` int(11) NOT NULL,
  `inv_recipe_inv_recipe_id` int(11) NOT NULL,
  `inv_product_has_inv_recipe_qty` float DEFAULT NULL,
  `inv_inventory_units_inv_inventory_units_id` int(11) NOT NULL,
  PRIMARY KEY (`inv_product_id_inv_product`,`inv_recipe_inv_recipe_id`),
  KEY `fk_inv_product_has_inv_recipe_inv_recipe1_idx` (`inv_recipe_inv_recipe_id`),
  KEY `fk_inv_product_has_inv_recipe_inv_product1_idx` (`inv_product_id_inv_product`),
  KEY `fk_inv_product_has_inv_recipe_inv_inventory_units1_idx` (`inv_inventory_units_inv_inventory_units_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_recipe`
--

CREATE TABLE IF NOT EXISTS `inv_recipe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_recipe_category_inv_recipe_category_id` int(11) NOT NULL,
  `inv_recipe_name` varchar(45) DEFAULT NULL,
  `inv_image_inv_image` int(11) NOT NULL,
  `inv_i18n_entity_name` int(11) NOT NULL,
  `inv_recipe_instructions` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_inv_recipe_inv_recipe_category1_idx` (`inv_recipe_category_inv_recipe_category_id`),
  KEY `fk_inv_recipe_inv_i18n_entity1_idx` (`inv_i18n_entity_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inv_recipe_cat`
--

CREATE TABLE IF NOT EXISTS `inv_recipe_cat` (
  `id` int(11) NOT NULL,
  `inv_i18n_entity_name` int(11) NOT NULL,
  `inv_recipe_cat_name` varchar(45) DEFAULT NULL,
  `inv_recipe_cat_desc` text,
  PRIMARY KEY (`id`),
  KEY `fk_inv_recipe_cat_inv_i18n_entity1_idx` (`inv_i18n_entity_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `inv_supplier`
--

CREATE TABLE IF NOT EXISTS `inv_supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inv_supplier_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inv_customer`
--
ALTER TABLE `inv_customer`
  ADD CONSTRAINT `fk_inv_customer_inv_currency1` FOREIGN KEY (`inv_currency_inv_currency_id`) REFERENCES `inv_currency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inv_i18n_string`
--
ALTER TABLE `inv_i18n_string`
  ADD CONSTRAINT `fk_inv_i18n_string_inv_i18n_entity1` FOREIGN KEY (`inv_i18n_entity_inv_i18n_entity_id`) REFERENCES `inv_i18n_entity` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inv_inventory`
--
ALTER TABLE `inv_inventory`
  ADD CONSTRAINT `fk_inv_inventory_inv_location1` FOREIGN KEY (`inv_location_inv_location_id`) REFERENCES `inv_location` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inv_inventory_line`
--
ALTER TABLE `inv_inventory_line`
  ADD CONSTRAINT `fk_inv_inventory_line_inv_inventory1` FOREIGN KEY (`inv_inventory_inv_inventory_id`) REFERENCES `inv_inventory` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_inventory_line_inv_inventory_units1` FOREIGN KEY (`inv_inventory_units_inv_inventory_units_id`) REFERENCES `inv_inventory_units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_inventory_line_inv_product1` FOREIGN KEY (`inv_product_id_inv_product`) REFERENCES `inv_product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_inventory_line_inv_supplier1` FOREIGN KEY (`inv_supplier_inv_supplier_id`) REFERENCES `inv_supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inv_order_data`
--
ALTER TABLE `inv_order_data`
  ADD CONSTRAINT `fk_inv_stock_inv_customer1` FOREIGN KEY (`inv_customer_inv_customer_id`) REFERENCES `inv_customer` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_stock_inv_supplier1` FOREIGN KEY (`inv_supplier_inv_supplier_id`) REFERENCES `inv_supplier` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inv_order_details`
--
ALTER TABLE `inv_order_details`
  ADD CONSTRAINT `fk_inv_stock_line_inv_currency1` FOREIGN KEY (`inv_currency_inv_currency_id`) REFERENCES `inv_currency` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_stock_line_inv_inventory_units1` FOREIGN KEY (`inv_inventory_units_inv_inventory_units_id`) REFERENCES `inv_inventory_units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_stock_line_inv_product1` FOREIGN KEY (`inv_product_id_inv_product`) REFERENCES `inv_product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_order_data_inv_order_details` FOREIGN KEY (`inv_order_data_inv_orderid`) REFERENCES `inv_order_data` (`inv_order_orderid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inv_product`
--
ALTER TABLE `inv_product`
  ADD CONSTRAINT `fk_inv_product_inv_i18n_entity1` FOREIGN KEY (`inv_i18n_entity_name`) REFERENCES `inv_i18n_entity` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_product_inv_product_cat` FOREIGN KEY (`inv_product_category_id`) REFERENCES `inv_product_cat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inv_product_cat`
--
ALTER TABLE `inv_product_cat`
  ADD CONSTRAINT `fk_inv_product_cat_inv_i18n_entitie1` FOREIGN KEY (`inv_i18n_entitie_name`) REFERENCES `inv_i18n_entity` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inv_product_recipe_mapping`
--
ALTER TABLE `inv_product_recipe_mapping`
  ADD CONSTRAINT `fk_inv_product_has_inv_recipe_inv_inventory_units1` FOREIGN KEY (`inv_inventory_units_inv_inventory_units_id`) REFERENCES `inv_inventory_units` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_product_has_inv_recipe_inv_product1` FOREIGN KEY (`inv_product_id_inv_product`) REFERENCES `inv_product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_product_has_inv_recipe_inv_recipe1` FOREIGN KEY (`inv_recipe_inv_recipe_id`) REFERENCES `inv_recipe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inv_recipe`
--
ALTER TABLE `inv_recipe`
  ADD CONSTRAINT `fk_inv_recipe_inv_i18n_entity1` FOREIGN KEY (`inv_i18n_entity_name`) REFERENCES `inv_i18n_entity` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inv_recipe_inv_recipe_category1` FOREIGN KEY (`inv_recipe_category_inv_recipe_category_id`) REFERENCES `inv_recipe_cat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `inv_recipe_cat`
--
ALTER TABLE `inv_recipe_cat`
  ADD CONSTRAINT `fk_inv_recipe_cat_inv_i18n_entity1` FOREIGN KEY (`inv_i18n_entity_name`) REFERENCES `inv_i18n_entity` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
