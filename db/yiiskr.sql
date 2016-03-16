/*
Navicat MySQL Data Transfer

Source Server         : slave
Source Server Version : 50505
Source Host           : 192.168.1.253:3306
Source Database       : yiiskr

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-03-16 10:45:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for migration
-- ----------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of migration
-- ----------------------------
INSERT INTO `migration` VALUES ('m000000_000000_base', '1457580792');
INSERT INTO `migration` VALUES ('m140209_132017_init', '1457580798');
INSERT INTO `migration` VALUES ('m140403_174025_create_account_table', '1457580798');
INSERT INTO `migration` VALUES ('m140504_113157_update_tables', '1457580799');
INSERT INTO `migration` VALUES ('m140504_130429_create_token_table', '1457580799');
INSERT INTO `migration` VALUES ('m140830_171933_fix_ip_field', '1457580799');
INSERT INTO `migration` VALUES ('m140830_172703_change_account_table_name', '1457580800');
INSERT INTO `migration` VALUES ('m141222_110026_update_ip_field', '1457580800');
INSERT INTO `migration` VALUES ('m141222_135246_alter_username_length', '1457580800');
INSERT INTO `migration` VALUES ('m150614_103145_update_social_account_table', '1457580801');
INSERT INTO `migration` VALUES ('m150623_212711_fix_username_notnull', '1457580801');

-- ----------------------------
-- Table structure for profile
-- ----------------------------
DROP TABLE IF EXISTS `profile`;
CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `public_email` varchar(255) DEFAULT NULL,
  `gravatar_email` varchar(255) DEFAULT NULL,
  `gravatar_id` varchar(32) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `bio` text,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of profile
-- ----------------------------
INSERT INTO `profile` VALUES ('1', null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for rent_chart
-- ----------------------------
DROP TABLE IF EXISTS `rent_chart`;
CREATE TABLE `rent_chart` (
  `rent_chart_id` int(11) NOT NULL AUTO_INCREMENT,
  `rent_chart_an` int(11) DEFAULT NULL,
  `rent_chart_date` date DEFAULT NULL,
  `rent_chart_dep` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`rent_chart_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of rent_chart
-- ----------------------------
INSERT INTO `rent_chart` VALUES ('8', '590000449', '2016-03-14', 'opd');

-- ----------------------------
-- Table structure for social_account
-- ----------------------------
DROP TABLE IF EXISTS `social_account`;
CREATE TABLE `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `data` text,
  `code` varchar(32) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of social_account
-- ----------------------------

-- ----------------------------
-- Table structure for temp_hn
-- ----------------------------
DROP TABLE IF EXISTS `temp_hn`;
CREATE TABLE `temp_hn` (
  `hn` varchar(7) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of temp_hn
-- ----------------------------

-- ----------------------------
-- Table structure for token
-- ----------------------------
DROP TABLE IF EXISTS `token`;
CREATE TABLE `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of token
-- ----------------------------
INSERT INTO `token` VALUES ('1', 'H8OF7DjQKWOUcOj9Khk0bysyakcaMiu7', '1457580967', '0');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(60) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_email` (`email`),
  UNIQUE KEY `user_unique_username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=tis620;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'bomkeen', 'bomkeen66@hotmail.com', '$2y$12$/7vuDI5jxBoDkXdyteAQw.hSY9Lit2h1PVHNSUqoslq9q7XIICp7C', 'ahmxQO98Y1tmwzkdCbrRrIiRv9-XsZ0R', null, null, null, '127.0.0.1', '1457580967', '1457580967', '0');
