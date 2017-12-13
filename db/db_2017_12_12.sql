/*
Navicat MySQL Data Transfer

Source Server         : 45.76.180.116
Source Server Version : 50720
Source Host           : 45.76.180.116:3306
Source Database       : toolkits

Target Server Type    : MYSQL
Target Server Version : 50720
File Encoding         : 65001

Date: 2017-12-12 23:37:15
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for m_category
-- ----------------------------
DROP TABLE IF EXISTS `m_category`;
CREATE TABLE `m_category` (
  `m_ctg_id` int(11) NOT NULL AUTO_INCREMENT,
  `ctg_name` text COLLATE utf8_unicode_ci,
  `add_datetime` datetime DEFAULT NULL,
  `upd_datetime` datetime DEFAULT NULL,
  `del_flg` int(1) DEFAULT '0',
  PRIMARY KEY (`m_ctg_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_define
-- ----------------------------
DROP TABLE IF EXISTS `m_define`;
CREATE TABLE `m_define` (
  `m_define_id` bigint(20) NOT NULL,
  `def_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `def_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `del_flg` int(1) DEFAULT '0',
  `add_datetime` datetime DEFAULT NULL,
  `upd_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`m_define_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_friends
-- ----------------------------
DROP TABLE IF EXISTS `m_friends`;
CREATE TABLE `m_friends` (
  `m_friends_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `m_user_id` bigint(20) DEFAULT NULL,
  `uid` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(255) DEFAULT NULL,
  `upd_datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`m_friends_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_menu
-- ----------------------------
DROP TABLE IF EXISTS `m_menu`;
CREATE TABLE `m_menu` (
  `m_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` text COLLATE utf8_unicode_ci,
  `menu_link` text COLLATE utf8_unicode_ci,
  `menu_type` text COLLATE utf8_unicode_ci,
  `sort_no` int(11) DEFAULT NULL,
  `mobile_display` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `add_datetime` datetime DEFAULT NULL,
  `upd_datetime` datetime DEFAULT NULL,
  `del_flg` int(1) DEFAULT '0',
  PRIMARY KEY (`m_menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_product
-- ----------------------------
DROP TABLE IF EXISTS `m_product`;
CREATE TABLE `m_product` (
  `m_product_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_ctg_id` int(11) NOT NULL,
  `product_name` text COLLATE utf8_unicode_ci,
  `product_price` int(11) DEFAULT NULL,
  `product_info` text COLLATE utf8_unicode_ci,
  `discount_price` int(11) DEFAULT '0',
  `group_type` text COLLATE utf8_unicode_ci,
  `add_datetime` datetime DEFAULT NULL,
  `upd_datetime` datetime DEFAULT NULL,
  `del_flg` int(1) DEFAULT '0',
  PRIMARY KEY (`m_product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_seconds_delay
-- ----------------------------
DROP TABLE IF EXISTS `m_seconds_delay`;
CREATE TABLE `m_seconds_delay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `seconds_delay` bigint(255) DEFAULT NULL,
  `use_flg` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_token
-- ----------------------------
DROP TABLE IF EXISTS `m_token`;
CREATE TABLE `m_token` (
  `m_token_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user` text COLLATE utf8_unicode_ci NOT NULL,
  `pass` text COLLATE utf8_unicode_ci,
  `user_id` bigint(20) NOT NULL,
  `cookie` text COLLATE utf8_unicode_ci,
  `token1` text COLLATE utf8_unicode_ci,
  `token2` text COLLATE utf8_unicode_ci,
  `full_name` text COLLATE utf8_unicode_ci,
  `total_friends` int(4) DEFAULT '0',
  `last_use_datetime` datetime DEFAULT NULL,
  `use_flg` int(1) DEFAULT '0',
  `info_status` int(1) DEFAULT '0',
  `m_user_id` bigint(20) DEFAULT NULL,
  `del_flg` int(1) DEFAULT '0',
  `add_datetime` datetime DEFAULT NULL,
  `upd_datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`m_token_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_user
-- ----------------------------
DROP TABLE IF EXISTS `m_user`;
CREATE TABLE `m_user` (
  `m_user_id` bigint(20) NOT NULL,
  `user_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `del_flg` int(1) DEFAULT '0',
  `add_datetime` datetime DEFAULT NULL,
  `upd_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`m_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for m_user_config
-- ----------------------------
DROP TABLE IF EXISTS `m_user_config`;
CREATE TABLE `m_user_config` (
  `m_user_config_id` bigint(20) NOT NULL,
  `m_user_id` bigint(20) DEFAULT NULL,
  `del_flg` int(1) DEFAULT '0',
  `add_datetime` datetime DEFAULT NULL,
  `upd_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`m_user_config_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
