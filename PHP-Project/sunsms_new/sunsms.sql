/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50528
Source Host           : localhost:3306
Source Database       : sunsms

Target Server Type    : MYSQL
Target Server Version : 50528
File Encoding         : 65001

Date: 2016-06-26 11:26:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `academic_year`
-- ----------------------------
DROP TABLE IF EXISTS `academic_year`;
CREATE TABLE `academic_year` (
  `id_academic_year` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_academic_year`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of academic_year
-- ----------------------------
INSERT INTO `academic_year` VALUES ('6', '1', 'iowefuh', '2016-06-10', '2016-06-30', 'lds', '1', '2016-06-26 11:19:35');

-- ----------------------------
-- Table structure for `board`
-- ----------------------------
DROP TABLE IF EXISTS `board`;
CREATE TABLE `board` (
  `id_board` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) NOT NULL,
  `board_name` varchar(255) DEFAULT NULL,
  `board_description` text,
  `status` tinyint(4) DEFAULT '1',
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_board`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of board
-- ----------------------------
INSERT INTO `board` VALUES ('1', '1', 'board1', 'testing', '1', '2016-06-25 21:03:33');
INSERT INTO `board` VALUES ('3', '1', 'board1', 'df', '0', '2016-06-25 22:12:23');

-- ----------------------------
-- Table structure for `city`
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `id_city` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_city`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('1', 'Hyderabad', '2');
INSERT INTO `city` VALUES ('2', 'Guntur', '1');

-- ----------------------------
-- Table structure for `country`
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id_country` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_country`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', 'india');

-- ----------------------------
-- Table structure for `course`
-- ----------------------------
DROP TABLE IF EXISTS `course`;
CREATE TABLE `course` (
  `id_course` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) DEFAULT NULL,
  `board_id` int(11) NOT NULL,
  `course_name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_course`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of course
-- ----------------------------
INSERT INTO `course` VALUES ('1', '1', '1', 'course', '56', '1', '2016-06-25 22:17:40');
INSERT INTO `course` VALUES ('3', '1', '1', 'test', 'test', '1', '2016-06-25 23:13:00');

-- ----------------------------
-- Table structure for `school`
-- ----------------------------
DROP TABLE IF EXISTS `school`;
CREATE TABLE `school` (
  `id_school` int(11) NOT NULL AUTO_INCREMENT,
  `school_name` varchar(255) DEFAULT NULL,
  `school_logo` text,
  `address` text,
  `city_id` int(255) DEFAULT NULL,
  `state_id` int(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `registration_id` varchar(225) DEFAULT NULL,
  `founded_on` date DEFAULT NULL,
  `curriculam` varchar(225) DEFAULT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `alternative_phone` bigint(20) DEFAULT NULL,
  `email` varchar(225) DEFAULT NULL,
  `fax` varchar(225) DEFAULT NULL,
  `fav_icon` text,
  `principle_name` varchar(255) DEFAULT NULL,
  `principle_email` varchar(255) DEFAULT NULL,
  `principle_phone` bigint(20) DEFAULT NULL,
  `principle_mobile` bigint(20) DEFAULT NULL,
  `academic_year` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_school`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of school
-- ----------------------------
INSERT INTO `school` VALUES ('1', 'sri chaitanya1', '1465708418sri.gif', 'ameerpet, hyderabad, telangana', '2', '1', '1', '', '3', '1', null, '123456', '2016-06-15', '', '0', '0', 'krishna@gmail.com', '', null, '', '', '0', '0', null);
INSERT INTO `school` VALUES ('2', 'Viveka school', '1465716411viveka.png', 'test', '1', '2', '1', null, '4', '1', '2016-06-12 12:55:06', null, null, null, null, null, null, null, null, null, null, null, null, null);
INSERT INTO `school` VALUES ('3', 'Hyderabad Public School', '1465725171anthemum.jpg', 'Hyderabad', '2', '1', '1', null, '5', '1', '2016-06-12 15:22:52', null, null, null, null, null, null, null, null, null, null, null, null, null);

-- ----------------------------
-- Table structure for `school_academic_year`
-- ----------------------------
DROP TABLE IF EXISTS `school_academic_year`;
CREATE TABLE `school_academic_year` (
  `id_school_academic_year` int(11) NOT NULL AUTO_INCREMENT,
  `school_id` int(11) DEFAULT NULL,
  `academic_year` varchar(255) DEFAULT NULL,
  `finance_year_start` datetime DEFAULT NULL,
  `finance_year_end` datetime DEFAULT NULL,
  `created_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_school_academic_year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of school_academic_year
-- ----------------------------

-- ----------------------------
-- Table structure for `state`
-- ----------------------------
DROP TABLE IF EXISTS `state`;
CREATE TABLE `state` (
  `id_state` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(255) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_state`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of state
-- ----------------------------
INSERT INTO `state` VALUES ('1', 'Andra Pradesh', '1');
INSERT INTO `state` VALUES ('2', 'Telangana', '1');

-- ----------------------------
-- Table structure for `subject`
-- ----------------------------
DROP TABLE IF EXISTS `subject`;
CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `subject_name` varchar(255) DEFAULT NULL,
  `subject_code` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `created_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_subject`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of subject
-- ----------------------------
INSERT INTO `subject` VALUES ('2', '1', 'subject', '123', '1', '2016-06-25 23:24:15');
INSERT INTO `subject` VALUES ('3', '1', 'bhjk', 'hl', '1', '2016-06-26 10:05:17');

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `user_type_id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `user_image` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `user_status` tinyint(4) NOT NULL DEFAULT '0',
  `user_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`),
  KEY `user_type_id` (`user_type_id`),
  CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id_user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '1', 'super', 'admin', null, 'superadmin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', null, '1', '2016-06-11 23:14:04');
INSERT INTO `user` VALUES ('3', '2', 'krishna', 'krishna', null, 'krishna@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456789', '1', '2016-06-12 10:43:38');
INSERT INTO `user` VALUES ('4', '2', 'raghu', 'raghu', null, 'prasad@gmail.com', 'VBCDb8', '1234567890', '0', '2016-06-12 12:55:06');
INSERT INTO `user` VALUES ('5', '2', 'ravi', 'ravi', null, 'ravi@gmail.com', 'Mvl4Ay', '1234567890', '0', '2016-06-12 15:22:51');

-- ----------------------------
-- Table structure for `user_type`
-- ----------------------------
DROP TABLE IF EXISTS `user_type`;
CREATE TABLE `user_type` (
  `id_user_type` int(11) NOT NULL AUTO_INCREMENT,
  `user_type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_user_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of user_type
-- ----------------------------
INSERT INTO `user_type` VALUES ('1', 'super admin');
INSERT INTO `user_type` VALUES ('2', 'school admin');
INSERT INTO `user_type` VALUES ('3', 'teacher');
INSERT INTO `user_type` VALUES ('4', 'parent');
INSERT INTO `user_type` VALUES ('5', 'student');
