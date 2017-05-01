/*
Navicat MySQL Data Transfer

Source Server         : Ghost
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : ladylike

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2017-03-30 21:23:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for city
-- ----------------------------
DROP TABLE IF EXISTS `city`;
CREATE TABLE `city` (
  `CitySno` int(11) NOT NULL AUTO_INCREMENT,
  `InDateTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdateOn` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `InUID` varchar(50) DEFAULT NULL,
  `MachineIP` varchar(50) DEFAULT NULL,
  `MachineName` varchar(50) DEFAULT NULL,
  `Active` int(1) DEFAULT NULL,
  `CityCode` varchar(30) DEFAULT NULL,
  `CityName` varchar(255) DEFAULT NULL,
  `TalukaSno` int(11) DEFAULT NULL,
  `StateSno` int(11) DEFAULT NULL,
  `CountrySno` int(11) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`CitySno`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of city
-- ----------------------------
INSERT INTO `city` VALUES ('1', '2017-03-18 19:44:26', '2017-03-18 19:44:26', '1', '1', '127.0.0.1', 'Maa', '1', 'Vad', 'Vadodara', '0', '1', '1', 'Vadodara');
INSERT INTO `city` VALUES ('2', '2017-03-09 22:30:26', '2017-03-09 22:30:26', '1', '1', '127.0.0.1', 'Maa', '1', 'Mumbai', 'Mumbai', '0', '2', '1', 'Mumbai');
INSERT INTO `city` VALUES ('3', '2017-03-13 09:54:07', '2017-03-13 09:54:07', '1', '1', '127.0.0.1', 'Maa', '0', 'Lk', 'Lakhtar', '1', '1', '1', 'Lakhtar');
INSERT INTO `city` VALUES ('4', '2017-03-24 20:59:54', '2017-03-24 20:59:54', '1', '1', '127.0.0.1', 'Maa', '1', 'ibbj', 'jbjh', '0', '1', '1', '');
INSERT INTO `city` VALUES ('5', '2017-03-24 20:59:35', '2017-03-24 20:59:35', '1', '1', '127.0.0.1', 'Maa', '1', 'bharuch', 'bharuch', '1', '1', '1', 'bharuch');
INSERT INTO `city` VALUES ('13', '2017-03-24 21:00:17', '2017-03-24 21:00:17', '1', '1', '127.0.0.1', 'Maa', '1', 'jbjjb', 'jkbkjb', '0', '4', '2', '');
INSERT INTO `city` VALUES ('14', '2017-03-23 23:11:42', '2017-03-23 23:11:42', '1', '1', '127.0.0.1', 'Maa', '1', 'nkj', 'kjnkj', '0', '2', '1', 'cd');
INSERT INTO `city` VALUES ('15', '2017-03-24 00:20:41', '2017-03-24 00:20:41', '1', '1', '127.0.0.1', 'Maa', '1', '2154', '65684', '0', '4', '2', '454');
INSERT INTO `city` VALUES ('16', '2017-03-24 00:30:38', '2017-03-24 00:30:38', '1', '1', '127.0.0.1', 'Maa', '1', 'jhvyjv', 'kjbb', '0', '3', '4', '');
INSERT INTO `city` VALUES ('17', '2017-03-24 00:30:49', '2017-03-24 00:30:49', '1', '1', '127.0.0.1', 'Maa', '1', 'kjbb', 'kjbub', '0', '7', '1', '');
INSERT INTO `city` VALUES ('18', '2017-03-24 21:00:14', '2017-03-24 21:00:14', '1', '1', '127.0.0.1', 'Maa', '1', 'hgvhv', 'jhvj', '0', '8', '4', '');
INSERT INTO `city` VALUES ('19', '2017-03-24 00:31:25', '2017-03-24 00:31:25', '1', '1', '127.0.0.1', 'Maa', '1', 'kjbk', 'kjjbkb', '0', '1', '1', 'kb');

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `CountrySno` int(11) NOT NULL AUTO_INCREMENT,
  `InDateTime` datetime DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `InUID` varchar(50) DEFAULT NULL,
  `MachineIP` varchar(50) DEFAULT NULL,
  `MachineName` varchar(50) DEFAULT NULL,
  `Active` int(1) DEFAULT NULL,
  `CountyCode` varchar(30) DEFAULT NULL,
  `CountryName` varchar(255) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`CountrySno`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO `country` VALUES ('1', '2017-03-09 20:32:51', '2017-03-13 10:07:27', '1', '1', '127.0.0.1', 'Maa', '1', 'IND', 'INDIA', 'country');
INSERT INTO `country` VALUES ('2', '2017-03-09 20:34:33', '2017-03-09 20:34:33', '1', '1', '127.0.0.1', 'Maa', '1', 'Pak', 'Pakistan', 'country');
INSERT INTO `country` VALUES ('3', '2017-03-09 20:34:46', '2017-03-09 20:34:46', '1', '1', '127.0.0.1', 'Maa', '1', 'Chin', 'China', 'country');
INSERT INTO `country` VALUES ('4', '2017-03-09 20:34:57', '2017-03-18 19:17:40', '1', '1', '127.0.0.1', 'Maa', '1', 'Eng', 'England', 'country');
INSERT INTO `country` VALUES ('5', '2017-03-09 20:35:08', '2017-03-09 20:35:08', '1', '1', '127.0.0.1', 'Maa', '1', 'USA', 'USA', 'country');

-- ----------------------------
-- Table structure for doctor
-- ----------------------------
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor` (
  `DoctorSno` bigint(11) NOT NULL AUTO_INCREMENT,
  `InDateTime` datetime DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `InUID` varchar(50) DEFAULT NULL,
  `MachineIP` varchar(50) DEFAULT NULL,
  `MachineName` varchar(50) DEFAULT NULL,
  `Active` int(1) DEFAULT NULL,
  `DoctorName` varchar(100) DEFAULT NULL,
  `Gender` int(1) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `MaritalStatus` int(1) DEFAULT NULL,
  `Avtar` varchar(500) DEFAULT NULL,
  `Address` varchar(500) DEFAULT NULL,
  `HospitalSno` bigint(11) DEFAULT NULL,
  `CitySno` bigint(11) DEFAULT NULL,
  `TalukaSno` bigint(11) DEFAULT NULL,
  `StateSno` bigint(11) DEFAULT NULL,
  `CountrySno` bigint(11) DEFAULT NULL,
  `StdCode` varchar(10) DEFAULT NULL,
  `PhoneNo` varchar(20) DEFAULT NULL,
  `MobileNo` varchar(15) DEFAULT NULL,
  `DocEmail` varchar(30) DEFAULT NULL,
  `PanNo` varchar(50) DEFAULT NULL,
  `DoctorRegistrationNo` varchar(50) DEFAULT NULL,
  `About` longtext,
  PRIMARY KEY (`DoctorSno`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of doctor
-- ----------------------------
INSERT INTO `doctor` VALUES ('1', '2017-03-26 23:22:14', '2017-03-29 22:16:24', '1', '1', '127.0.0.1', 'Maa', '1', 'jbjhb', '1', '2019-02-03', '1', 'c8b382d3c1edaff4277930e53a0cfacb201703292203158009950.jpeg', 'uyygujy 154544', '2', '5', '1', '1', '5', '1541', '5154', '155', 'jjjhb', 'lmlkm', '51544g', 'jnkn');
INSERT INTO `doctor` VALUES ('2', '2017-03-26 23:23:47', '2017-03-27 00:14:22', '1', '1', '127.0.0.1', 'Maa', '1', 'yyy', '1', '2006-02-03', '1', 'c8b382d3c1edaff4277930e53a0cfacb201703270014222763930.jpeg', '54145', '2', '5', '1', '1', '5', '11', '4455', '11155', 'jhbjh', 'vhgv', '551154', 'jhjh');
INSERT INTO `doctor` VALUES ('3', '2017-03-27 01:58:08', '2017-03-29 22:02:51', '1', '1', '127.0.0.1', 'Maa', '1', '454', '1', '2019-03-03', '1', 'lehappyfacebyluch201703292202517120960.png', '', '0', '0', '0', '0', '0', '', '', '5454', '', '', '566464', '');
INSERT INTO `doctor` VALUES ('4', '2017-03-29 22:02:22', '2017-03-29 22:02:29', '1', '1', '127.0.0.1', 'Maa', '1', 'Akshay Mahajan', '1', '2019-05-03', '1', 'lehappyfacebyluch201703292202220427780.png', '5154151515', '2', '5', '1', '1', '5', '1515415', '5415415415', '56465', 'ihiuidsiuiiu@gmail.com', '5515475', '54848', '5555415545');
INSERT INTO `doctor` VALUES ('5', '2017-03-29 22:52:26', '2017-03-29 22:52:26', '1', '1', '127.0.0.1', 'Maa', '1', 'gjghhj', '1', '2019-05-03', '1', null, '', '2', '0', '0', '0', '0', '', '', '', '', '', '', '');
INSERT INTO `doctor` VALUES ('6', '2017-03-29 22:53:56', '2017-03-29 22:53:56', '1', '1', '127.0.0.1', 'Maa', '1', '445', '1', '2019-05-03', '1', null, '', '1', '0', '0', '0', '0', '', '', '', '', '', '', '');
INSERT INTO `doctor` VALUES ('7', '2017-03-29 22:56:37', '2017-03-29 22:56:37', '1', '1', '127.0.0.1', 'Maa', '1', 'fsf', '1', '2019-05-03', '1', null, '', '2', '0', '0', '0', '0', '', '', '', '', '', '', '');
INSERT INTO `doctor` VALUES ('8', '2017-03-29 22:57:37', '2017-03-29 22:57:37', '1', '1', '127.0.0.1', 'Maa', '1', '', '1', '2019-05-03', '1', null, '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '');
INSERT INTO `doctor` VALUES ('9', '2017-03-29 23:03:15', '2017-03-29 23:03:15', '1', '1', '127.0.0.1', 'Maa', '1', '', '1', '2019-05-03', '1', null, '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '');
INSERT INTO `doctor` VALUES ('10', '2017-03-29 23:06:13', '2017-03-29 23:06:13', '1', '1', '127.0.0.1', 'Maa', '1', '', '1', '2019-05-03', '1', null, '', '0', '0', '0', '0', '0', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for hospital
-- ----------------------------
DROP TABLE IF EXISTS `hospital`;
CREATE TABLE `hospital` (
  `HospitalSno` bigint(11) NOT NULL AUTO_INCREMENT,
  `InDateTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdateOn` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `InUID` varchar(50) DEFAULT NULL,
  `MachineIP` varchar(50) DEFAULT NULL,
  `MachineName` varchar(50) DEFAULT NULL,
  `Active` int(1) DEFAULT NULL,
  `HospitalName` varchar(100) DEFAULT NULL,
  `Address` varchar(500) DEFAULT NULL,
  `CitySno` bigint(11) DEFAULT NULL,
  `TalukaSno` bigint(11) DEFAULT NULL,
  `StateSno` bigint(11) DEFAULT NULL,
  `CountrySno` bigint(11) DEFAULT NULL,
  `PinCode` varchar(10) DEFAULT NULL,
  `StdCode` varchar(10) DEFAULT NULL,
  `PhoneNo` varchar(20) DEFAULT NULL,
  `MobileNo` varchar(20) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Website` varchar(30) DEFAULT NULL,
  `Remark` longtext,
  PRIMARY KEY (`HospitalSno`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of hospital
-- ----------------------------
INSERT INTO `hospital` VALUES ('1', '2017-03-19 18:58:30', '2017-03-19 18:58:30', '1', '1', '127.0.0.1', 'Maa', '1', '1', '1', '5', '1', '1', '1', '11', '1', '1', '1', '1@gmail.com', 'www.1.com', '1');
INSERT INTO `hospital` VALUES ('2', '2017-03-19 18:58:25', '2017-03-19 18:58:25', '1', '1', '127.0.0.1', 'Maa', '1', 'jhbj', 'up', '1', '0', '1', '1', '11515', '55316', '61651', '165165', 'jhhbjbj@', 'kjnkn', 'jhbhjb');
INSERT INTO `hospital` VALUES ('3', '2017-03-19 20:20:00', '2017-03-19 20:20:00', '1', '1', '127.0.0.1', 'Maa', '1', '12', '', '5', '1', '1', '1', '', '', '', '123', '', '', '');

-- ----------------------------
-- Table structure for loginattempts
-- ----------------------------
DROP TABLE IF EXISTS `loginattempts`;
CREATE TABLE `loginattempts` (
  `LoginAttempSno` int(11) NOT NULL AUTO_INCREMENT,
  `InDateTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdateOn` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `InUID` varchar(50) DEFAULT NULL,
  `MachineIP` varchar(255) DEFAULT NULL,
  `MachineName` varchar(255) DEFAULT NULL,
  `EmailID` varchar(100) DEFAULT NULL,
  `LoginTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Browser` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`LoginAttempSno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of loginattempts
-- ----------------------------

-- ----------------------------
-- Table structure for speciality
-- ----------------------------
DROP TABLE IF EXISTS `speciality`;
CREATE TABLE `speciality` (
  `SpecialitySno` int(11) NOT NULL AUTO_INCREMENT,
  `InDateTime` datetime DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `InUID` varchar(50) DEFAULT NULL,
  `MachineIP` varchar(50) DEFAULT NULL,
  `MachineName` varchar(50) DEFAULT NULL,
  `Active` int(1) DEFAULT NULL,
  `SpecialityCode` varchar(30) DEFAULT NULL,
  `SpecialityName` varchar(255) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`SpecialitySno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of speciality
-- ----------------------------
INSERT INTO `speciality` VALUES ('1', '2017-03-11 19:44:40', '2017-03-13 10:28:48', '1', '1', '127.0.0.1', 'Maa', '1', 'jhbjhbv', 'jvjvjv', 'jvjhhvjvhj');

-- ----------------------------
-- Table structure for state
-- ----------------------------
DROP TABLE IF EXISTS `state`;
CREATE TABLE `state` (
  `StateSno` int(11) NOT NULL AUTO_INCREMENT,
  `InDateTime` datetime DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `InUID` varchar(50) DEFAULT NULL,
  `MachineIP` varchar(50) DEFAULT NULL,
  `MachineName` varchar(50) DEFAULT NULL,
  `Active` int(1) DEFAULT NULL,
  `StateCode` varchar(30) DEFAULT NULL,
  `StateName` varchar(255) DEFAULT NULL,
  `CountrySno` bigint(11) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`StateSno`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of state
-- ----------------------------
INSERT INTO `state` VALUES ('1', '2017-03-09 20:53:23', '2017-03-13 10:11:18', '1', '1', '127.0.0.1', 'Maa', '1', 'Guj', 'Gujarat', '1', 'Very nice state');
INSERT INTO `state` VALUES ('2', '2017-03-09 20:57:01', '2017-03-18 19:24:50', '1', '1', '127.0.0.1', 'Maa', '1', 'MH', 'Maharasta', '1', 'Maharasta');
INSERT INTO `state` VALUES ('3', '2017-03-09 21:04:10', '2017-03-09 21:04:10', '1', '1', '127.0.0.1', 'Maa', '1', 'SUR', 'Surrey', '4', 'Surrey');
INSERT INTO `state` VALUES ('4', '2017-03-09 21:05:20', '2017-03-18 19:24:48', '1', '1', '127.0.0.1', 'Maa', '1', 'Sindth', 'Sindth', '2', 'Sindthi');
INSERT INTO `state` VALUES ('5', '2017-03-09 21:30:59', '2017-03-09 21:30:59', '1', '1', '127.0.0.1', 'Maa', '0', 'Hamp', 'Hampshire', '4', 'Hampshire');
INSERT INTO `state` VALUES ('6', '2017-03-09 21:32:47', '2017-03-09 21:32:47', '1', '1', '127.0.0.1', 'Maa', '0', 'Lan', 'Lancashire', '4', 'Lancashire');
INSERT INTO `state` VALUES ('7', '2017-03-13 14:11:51', '2017-03-18 19:24:44', '1', '1', '127.0.0.1', 'Maa', '1', 'jbjhb', 'hjbjb', '1', '');
INSERT INTO `state` VALUES ('8', '2017-03-18 19:25:45', '2017-03-18 19:25:45', '1', '1', '127.0.0.1', 'Maa', '1', 'jkkjb', 'jbkbj', '4', '');

-- ----------------------------
-- Table structure for taluka
-- ----------------------------
DROP TABLE IF EXISTS `taluka`;
CREATE TABLE `taluka` (
  `TalukaSno` int(11) NOT NULL AUTO_INCREMENT,
  `InDateTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdateOn` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `InUID` varchar(50) DEFAULT NULL,
  `MachineIP` varchar(50) DEFAULT NULL,
  `MachineName` varchar(50) DEFAULT NULL,
  `Active` int(1) DEFAULT NULL,
  `TalukaCode` varchar(30) DEFAULT NULL,
  `TalukaName` varchar(255) DEFAULT NULL,
  `StateSno` int(11) DEFAULT NULL,
  `CountrySno` int(11) DEFAULT NULL,
  `Description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`TalukaSno`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of taluka
-- ----------------------------
INSERT INTO `taluka` VALUES ('1', '2017-03-13 14:31:25', '2017-03-13 14:31:25', '1', '1', '127.0.0.1', 'Maa', '1', 'Lk', 'Lakhtar', '1', '1', 'Lakhtar Description');
INSERT INTO `taluka` VALUES ('2', '2017-03-13 09:48:09', '2017-03-13 09:48:09', '1', '1', '127.0.0.1', 'Maa', '0', 'Vir', 'Viramgam', '1', '1', 'Description');
INSERT INTO `taluka` VALUES ('3', '2017-03-18 19:34:01', '2017-03-18 19:34:01', '1', '1', '127.0.0.1', 'Maa', '1', 'xzzxv', 'dgggsd', '1', '1', '');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `UserSno` int(11) NOT NULL AUTO_INCREMENT,
  `InDateTime` datetime DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `InUID` varchar(50) DEFAULT NULL,
  `MachineIP` varchar(50) DEFAULT NULL,
  `MachineName` varchar(255) DEFAULT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Active` int(1) DEFAULT NULL,
  `UserType` int(1) DEFAULT NULL,
  `Mobile` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`UserSno`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', null, null, null, null, null, null, 'Ghost Protocol', 'admin@admin.com', '$2y$10$30bCXzs6A5m8nYXmcxssoO6T0zTZ4n7obE1pa0x8tIv5hzRCbswji', '1', '1', null);

-- ----------------------------
-- Table structure for userinoutlog
-- ----------------------------
DROP TABLE IF EXISTS `userinoutlog`;
CREATE TABLE `userinoutlog` (
  `UserInOutLogSno` int(11) NOT NULL AUTO_INCREMENT,
  `InDateTime` datetime DEFAULT NULL,
  `UpdateOn` datetime DEFAULT NULL,
  `UpdatedBy` varchar(50) DEFAULT NULL,
  `InUID` varchar(50) DEFAULT NULL,
  `MachineIP` varchar(255) DEFAULT NULL,
  `MachineName` varchar(255) DEFAULT NULL,
  `EmailID` varchar(100) DEFAULT NULL,
  `UserInTime` datetime DEFAULT NULL,
  `UserOutTime` datetime DEFAULT NULL,
  `Browser` varchar(255) DEFAULT NULL,
  `UserSessionID` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`UserInOutLogSno`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of userinoutlog
-- ----------------------------
INSERT INTO `userinoutlog` VALUES ('1', '2017-03-09 20:58:18', '2017-03-09 20:58:18', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-09 20:58:18', '2017-03-09 21:21:04', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '186dc0bf21852897e970c2bb93a618e43d8e73fef75f69eabe3d64ccdcf8052eb610b81d8a2510c90b2a9553ef7cd7a5178514602803dad5ee66ebf8e863183b');
INSERT INTO `userinoutlog` VALUES ('2', '2017-03-09 21:30:21', '2017-03-09 21:30:21', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-09 21:30:21', '2017-03-09 22:47:11', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'e61845945d62dc5fe25f85bc55f74237c1b06c6c001f3efe46666bf8c413cd3069611352e7ee7e370df982f9e86215a1c8b5fb42577e0052942373bf3ede1f69');
INSERT INTO `userinoutlog` VALUES ('3', '2017-03-09 22:48:41', '2017-03-09 22:48:41', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-09 22:48:41', '2017-03-09 23:03:45', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '890be09457750c395d3c5820d2599d9db1eafc90733b4aadce38fb8286aae2a2a8ba8ba2e44f4bbb5082751952f266e6193f83f6cc279bf6acab5d539cc36fea');
INSERT INTO `userinoutlog` VALUES ('4', '2017-03-09 23:13:14', '2017-03-09 23:13:14', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-09 23:13:14', '2017-03-09 23:36:37', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'b22c934a26e8058e0df85d7bf33a08e37648e99b50493c012af07440e6af6d908aeae61ec2ebb03d5d76943080fb012e7637170e635895e8eb7a87f3a977e1bb');
INSERT INTO `userinoutlog` VALUES ('5', '2017-03-09 23:36:44', '2017-03-09 23:36:44', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-09 23:36:44', '2017-03-09 23:36:53', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'eb017b5123ff696c56074fcf122ee75b2512c820b3c7d78bd5017767c7e050e13c34b71e58eaf646a411990f63e4c73bfbc8a8a5ca2f8bcc953e9bbc87be6eb9');
INSERT INTO `userinoutlog` VALUES ('6', '2017-03-09 23:37:00', '2017-03-09 23:37:00', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-09 23:37:00', '2017-03-10 07:31:29', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '2e404b5842e76d3280277791142fea031ddb1ac124defa46d75d49dc13ef6a984c0f893e918ae908b22f74243c85c766bea836c57a9736bd0896a5da1942adcd');
INSERT INTO `userinoutlog` VALUES ('7', '2017-03-10 07:38:59', '2017-03-10 07:38:59', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-10 07:38:59', '2017-03-10 20:05:24', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '559f995782aa5b3238358825096df337f3d791d54e6c7ea1c37a1d976528788fa291245053ffaea927b30760ddb2896e2286b5e94c9940053c1e001420c3d94a');
INSERT INTO `userinoutlog` VALUES ('8', '2017-03-10 20:16:59', '2017-03-10 20:16:59', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-10 20:16:59', '2017-03-10 21:50:31', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'ee804364594c60c0a814e36fbd5cdde361f796f3d80721be528d7ecbcd445d149765021fec134aa3928437b344e89310fe895a9fd046d1c8d765c65621e2b1e7');
INSERT INTO `userinoutlog` VALUES ('9', '2017-03-10 22:09:12', '2017-03-10 22:09:12', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-10 22:09:12', '2017-03-10 22:46:16', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '753acc3e87faf59e852699cdb07cf4cf0edbcd493fd64372659c75a289a2e118d27788774e844ffca26632b10f910f23a1674359b14c34187f90587359dd30e4');
INSERT INTO `userinoutlog` VALUES ('10', '2017-03-10 22:50:23', '2017-03-10 22:50:23', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-10 22:50:23', '2017-03-11 07:38:29', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '4ee38f7ec06df8d007568e589046293995b75319636a8a94b5fe27daf7b07e0dfc07218f6022ac0c7a9a062c44bcd2d8c30d261035ee0b42756cee4a174b0c03');
INSERT INTO `userinoutlog` VALUES ('11', '2017-03-11 19:33:42', '2017-03-11 19:33:42', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-11 19:33:42', '2017-03-11 20:40:52', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'abdeaa716302cf8f04726bb1419a490feaf74222f064b5ab57767a83488c0344af5ff6625aec5a723f53cdb6ec12067b54658ebc9453eb6751be60f171b2b50e');
INSERT INTO `userinoutlog` VALUES ('12', '2017-03-11 20:53:23', '2017-03-11 20:53:23', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-11 20:53:23', '2017-03-11 22:16:45', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '9877766e93960f8506148e89849321dffcafd721f6e437eba85fdcbe3c673990f6521cd37333f218a362da1f930c6047563ebb391b8e5942497444b88d838fef');
INSERT INTO `userinoutlog` VALUES ('13', '2017-03-11 22:19:04', '2017-03-11 22:19:04', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-11 22:19:04', '2017-03-11 22:31:44', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '86169614ec157d20cc00bfca7e862112600ed8279212c1762cbc0e3e9f6f70df28c0b3432ce87723ffe3e59cfe7b3ffb361411fb63e318464c2da1fd2ea68f96');
INSERT INTO `userinoutlog` VALUES ('14', '2017-03-11 22:48:50', '2017-03-11 22:48:50', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-11 22:48:50', '2017-03-11 23:25:07', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '86e68f19f9bc88ca524712bc6919a971eb0fea70f5f36b2eb6fafc21c726cc2ba91ebd42a660f33ddd37eb18ef593a0f32e8fc9f5fd7f99e0912381becd56209');
INSERT INTO `userinoutlog` VALUES ('15', '2017-03-12 08:16:48', '2017-03-12 08:16:48', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 08:16:48', '2017-03-12 08:54:57', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'ddb1a98fcf92e4514d6960d63699dc676bbaca9067ec8d93b93407a968c9763bca5353ae2577977c540d1b29e9ac4f211026d6dfb3cabea870c760e75760f1a3');
INSERT INTO `userinoutlog` VALUES ('16', '2017-03-12 09:18:51', '2017-03-12 09:18:51', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 09:18:51', null, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '1ce52178bcb1822ed6354a24543ce035738ca3f3dc16aa346b524bc96783f18701aa5d7911750580d3368498cfdffa1e1c472b1a17d1dd51b67548bf7c95a3fd');
INSERT INTO `userinoutlog` VALUES ('17', '2017-03-12 11:25:58', '2017-03-12 11:25:58', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 11:25:58', null, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'bafaf5c477a567fb1d15658156fdf7caefadaf682e69e00f04ca3d4e4ab38b7850acbcb6685bb9e2814206157e116b22d8388cd23205daca2ec6a2b9de4feb72');
INSERT INTO `userinoutlog` VALUES ('18', '2017-03-12 11:27:36', '2017-03-12 11:27:36', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 11:27:36', '2017-03-12 11:35:13', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '8cc37fe897f37e2569f6b678ef23f45c27de9520a828d3df3d9a784344082cf4118394120d9bf4ba3b13399df0c64057ecc1f55f2833d0282afb74042076b73a');
INSERT INTO `userinoutlog` VALUES ('19', '2017-03-12 11:35:21', '2017-03-12 11:35:21', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 11:35:21', '2017-03-12 11:38:56', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'a6411da250d8b6c63237edcd51748e88a0cd5e054f6b8d6b635ce4d0d993059d1ba4f3fd6e851ee011e300f6b8f0b1a1f71838e67a9cd804ff9ed6c9bc61322b');
INSERT INTO `userinoutlog` VALUES ('20', '2017-03-12 11:39:04', '2017-03-12 11:39:04', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 11:39:04', '2017-03-12 11:39:34', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '993ba489d2dfbadf15e71185e8fb3b1086dcf7f71f4121bd6fd8528d5e205573907e8bf953ead589f4b8e0fc119c57fef7cc0caa889cdaf61f29c259f80f01d2');
INSERT INTO `userinoutlog` VALUES ('21', '2017-03-12 12:22:32', '2017-03-12 12:22:32', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 12:22:32', '2017-03-12 12:37:57', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'bd642ece1f707551134f26e397f1516e9265c160639e850b6237037ad8b9c051c892b206d4f44bc1a4a5e598ff21356c8232b023797b3de64bb4840698c3d65d');
INSERT INTO `userinoutlog` VALUES ('22', '2017-03-12 12:40:35', '2017-03-12 12:40:35', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 12:40:35', '2017-03-12 12:50:58', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'b7f13b23c28a54df57fe21617546ced2726ddbc753749fe4acb9fccf2aa83ef5b8e593f5ef9624c8bff935e4c2ffc202eb13e5cc6ce4073cbc66cd6aab805b47');
INSERT INTO `userinoutlog` VALUES ('23', '2017-03-12 12:55:38', '2017-03-12 12:55:38', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 12:55:38', '2017-03-12 13:17:24', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '82cea6f8ee62dead005e5b7ed7d74d7e2b80e763c65eb454529c156019aa8146897d94989537040bcca3d72db3d668a2f98ecaa12643cd20f03a33968fbbb435');
INSERT INTO `userinoutlog` VALUES ('24', '2017-03-12 13:29:28', '2017-03-12 13:29:28', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 13:29:28', '2017-03-12 16:41:29', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '0e7b409bde77776ad02a749466959a78a26be18efd89fdfe3ae1a5cd55dc5b3d8256bde35271b5ea99b52c40c17654adb74c606e55bfcba90a1c56a0cae1e011');
INSERT INTO `userinoutlog` VALUES ('25', '2017-03-12 16:44:00', '2017-03-12 16:44:00', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 16:44:00', '2017-03-12 19:08:17', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '529fd1c30f73c21b1ab02bcb552b26772a8d0bad6f84a7c9327adeb47fdd0c8e5d72e9b05f3c1f0daedaf14a4de4448f0b24bcc1d9d1eb9321528f7da8c352e9');
INSERT INTO `userinoutlog` VALUES ('26', '2017-03-12 18:49:12', '2017-03-12 18:49:12', '1', '1', '::1', 'Maa', 'admin@admin.com', '2017-03-12 18:49:12', null, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', '8ec41d3bcdce74b397bef613e2d1daa97da90eda05e2bb23d570c7931ec3b5b3a87ff58d4b35cb600209807b61dc33d602cf206415645ce0d31a9c0038155fe6');
INSERT INTO `userinoutlog` VALUES ('27', '2017-03-12 19:06:45', '2017-03-12 19:06:45', '1', '1', '::1', 'Maa', 'admin@admin.com', '2017-03-12 19:06:45', null, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', '9e2b3da07c053abe2b5d683269db79bf1cd045d551f6e09ad91885bcd82b6f785c626c21b7c49b35bc7bf0d50af07819e1b4405c4b2bd28edcb3345277546e18');
INSERT INTO `userinoutlog` VALUES ('28', '2017-03-12 19:08:38', '2017-03-12 19:08:38', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 19:08:38', '2017-03-12 19:24:19', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '04e2de0db8a091a026303e584280aad1eac991bc66e2536e09e0024918adebf35f23cf6893c6efde720b166b8ee0d8233f2191ff770a8dee487c3d0d1a10bfa3');
INSERT INTO `userinoutlog` VALUES ('29', '2017-03-12 19:45:36', '2017-03-12 19:45:36', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 19:45:36', '2017-03-12 19:48:47', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '5c09f591f8d5f3cef905a21e3ff3295fac9fd35d28010d01c21bb4dd46f8b5bc515dcd870d4543e48e542407f42a9561fdd0a8bd4125a30a5484c32fce72f341');
INSERT INTO `userinoutlog` VALUES ('30', '2017-03-12 19:48:57', '2017-03-12 19:48:57', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 19:48:57', '2017-03-12 19:50:11', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '9db83c7777a3e7959f1c1abe542608dd08f95730556d49f814b28ee728273368fc22109eb7ed54d2473a8c1741d95386d8d1dcb318a9b32f38c865ea42980fe7');
INSERT INTO `userinoutlog` VALUES ('31', '2017-03-12 19:50:46', '2017-03-12 19:50:46', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 19:50:46', '2017-03-12 19:52:03', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '015ca8e92f856b571c68c865b1cc2e55793e42883b841bf4d39ce47057104be5f57eadfa374c9fc29715de285a6e95e47a9e95c52aac86b8dc0687728b7dcf7c');
INSERT INTO `userinoutlog` VALUES ('32', '2017-03-12 19:54:59', '2017-03-12 19:54:59', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 19:54:59', '2017-03-12 19:56:03', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '30e6c8825c21c12e07e521a9a976ef0049f50e461868f42c83d41751c0fe152db5d8a20f3cf28aeca933039fdc6a687af40782b42316e8d7c05ed35eb3c19052');
INSERT INTO `userinoutlog` VALUES ('33', '2017-03-12 19:56:37', '2017-03-12 19:56:37', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 19:56:37', '2017-03-12 20:11:40', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '11a04f4fe9c811c8620d768ac435d6793034affcfa6404423d8b3c5459202915c8c8ab87bfdd868ce3f6fe8652ca7fccc1727b5273c125f3df5cbda3946d0816');
INSERT INTO `userinoutlog` VALUES ('34', '2017-03-12 20:29:01', '2017-03-12 20:29:01', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 20:29:01', '2017-03-12 23:24:40', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '274acf9b59e48992fc2f54bb4336c7f23b1b30eeb13e9ae80577bbfa872195495200abf4db0082e8326e6d739a715b8ba9b6ee599003f042fb64dfabb9d6a04d');
INSERT INTO `userinoutlog` VALUES ('35', '2017-03-12 23:30:31', '2017-03-12 23:30:31', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-12 23:30:31', '2017-03-13 07:51:08', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '307bf45cdf557691fce0d22c5367d52beb1505adbaf87cb59361d4d43c4045f7e4d194d256bc2efb966af070680bdd172b4ea7deb5b3083b347ab0547367db0a');
INSERT INTO `userinoutlog` VALUES ('36', '2017-03-13 08:02:31', '2017-03-13 08:02:31', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-13 08:02:31', '2017-03-13 08:03:10', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '1596b2f838e6a6baf26b6c3b27fbef260c7baea51ac5402af86549120161f90449e0723dfd872db0f1d130b88ae803b06718e2e9bd09b91f38e6c678d61c6a06');
INSERT INTO `userinoutlog` VALUES ('37', '2017-03-13 08:04:06', '2017-03-13 08:04:06', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-13 08:04:06', '2017-03-13 08:19:19', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '028dc9b47eaa4db20681a827ee44376a5d5511bfebd0e46a000eaed3db619586e0442f1e0223bb4f716e98b02c089894ca52947a92bff93f9d89e2e1c8620bbd');
INSERT INTO `userinoutlog` VALUES ('38', '2017-03-13 08:34:58', '2017-03-13 08:34:58', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-13 08:34:58', '2017-03-13 09:09:35', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '5a96b82d6ff79a00ad24313a7fa3995cc1d76412ced1a532ee5296c5142797235c7a438f23b5b13ca3cc816dbb892bbe6e45b507cc952d8455ea0ce0cdc398c4');
INSERT INTO `userinoutlog` VALUES ('39', '2017-03-13 09:15:26', '2017-03-13 09:15:26', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-13 09:15:26', '2017-03-13 11:52:50', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '85a6d9ea0292c3a3e4bd16c42fc0ad97b869b0c07e3dbddabfa04ffcf7f586256a6bce23363294afd49d32da49665134ab7f7302fb877ceb20889c83c8d7e90a');
INSERT INTO `userinoutlog` VALUES ('40', '2017-03-13 13:00:53', '2017-03-13 13:00:53', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-13 13:00:53', '2017-03-13 13:31:06', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', 'c1089de1729e7417a351ed44062171b8745d054a88a4182411da26def24f852c4202c41a3ef3aab4a9c634ee96d460dca2dadb2037fdf04e32e08a640894ebf2');
INSERT INTO `userinoutlog` VALUES ('41', '2017-03-13 13:38:53', '2017-03-13 13:38:53', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-13 13:38:53', null, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0', '4960556b5b6faa11c60f9a710e4ceef16cbc79978082b4452b7d981f27b9c6d7440410f3443dff15bf8c670640aaa10ead850ded81909bf2814915bca1a38331');
INSERT INTO `userinoutlog` VALUES ('42', '2017-03-13 14:23:26', '2017-03-13 14:23:26', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-13 14:23:26', '2017-03-13 20:23:49', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', 'cff5c188845730c7145ea35a17252b43de8a08bbb71776d6a83e60f3063945cf94d56ddf24899669491a1a9692818c206f744003c749898400dc106de23f5dbf');
INSERT INTO `userinoutlog` VALUES ('43', '2017-03-13 20:43:35', '2017-03-13 20:43:35', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-13 20:43:35', '2017-03-14 00:29:16', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '01e5d43e25f84748f98e662792aa6561e639c2433d2f40d3582454a2a255e85415448ab8d4b35dac174483424c8cf30160e43a4f72a5334fbb636d50eb7641b5');
INSERT INTO `userinoutlog` VALUES ('44', '2017-03-13 21:32:34', '2017-03-13 21:32:34', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-13 21:32:34', '2017-03-13 21:47:39', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '4c2523a0d7139909e59bf003b3241244b4a419bab0d6162e73a3a9a2a8210c809290f222f4f132bd16107eccd13f03e3b6ef3687ea5777fb385b3c8eff9727b0');
INSERT INTO `userinoutlog` VALUES ('45', '2017-03-14 07:11:57', '2017-03-14 07:11:57', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-14 07:11:57', '2017-03-14 20:05:40', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '234ab0bb462e7650eb2c235786a468e7b5213d39290648794fc9777a521110d81a414d3cdd1716d9230c14553750339927d1d3a6bc0edc45aa3d075b085b8fb8');
INSERT INTO `userinoutlog` VALUES ('46', '2017-03-17 19:23:20', '2017-03-17 19:23:20', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-17 19:23:20', '2017-03-17 20:18:53', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '103b5af2745c6799058a96c51842fe29b487c0587e15c4ffe119ef912336bc4c6fcd428449fda3bec6326aad9da6f39d880d4ace607b8eb55092b01675938ce2');
INSERT INTO `userinoutlog` VALUES ('47', '2017-03-17 20:22:24', '2017-03-17 20:22:24', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-17 20:22:24', '2017-03-17 23:04:07', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', 'fddbacb3fa5560b6880aeebd8a5cc80f1e88fa58841add7b843e3b52a653c37fa7e5e0d0f72a024e1d3b991eacce53c1149a09369b72e53e458f6ce4f21bcc09');
INSERT INTO `userinoutlog` VALUES ('48', '2017-03-17 23:05:52', '2017-03-17 23:05:52', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-17 23:05:52', '2017-03-18 07:03:51', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '3c48c89f9da507fdd3f4c6f517ff2330f0e9f7d9756a6ebcd5ec174c05bb5cda12cb1fe99c8ecbc78e68b1abed646757e1814d522492e65c8c3017ecd2ce5893');
INSERT INTO `userinoutlog` VALUES ('49', '2017-03-18 07:04:09', '2017-03-18 07:04:09', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-18 07:04:09', '2017-03-18 18:17:32', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', 'c957425ba5006acf082f91c8db401eb9292601f44054990feb20ec02de7fd75c630eb6b53242e266624d2a17097220c41af2411eec4f6dda178f8317c4d0f32d');
INSERT INTO `userinoutlog` VALUES ('50', '2017-03-18 18:22:27', '2017-03-18 18:22:27', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-18 18:22:27', '2017-03-18 18:54:21', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '0e442ce6be6cbb44c5c8f2b3d35ef134232b33d612d5a84b04e2f100c0805e789bce2f4c254f8eeb1b1962fe5b090c6fe8fae0a32f752b29f6ab54fb762d5d47');
INSERT INTO `userinoutlog` VALUES ('51', '2017-03-18 18:55:01', '2017-03-18 18:55:01', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-18 18:55:01', '2017-03-18 20:54:40', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '4b23d795cd97fe01d371b8baee8590fc84605a4e6328662c576dc452b2380f178970a5007ed0c9f5f55f23bfe73c33a2c5ab365f4f1b768211e3de7678aca180');
INSERT INTO `userinoutlog` VALUES ('52', '2017-03-18 21:18:38', '2017-03-18 21:18:38', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-18 21:18:38', '2017-03-18 22:07:53', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '02573c86ebf72c9a11134ba4634fda4d916232aa7680ad5a3df6d9d677d766591e1998b282f2f49a7d961253bfb2527ce32aa1fa893752233231b403b85861d8');
INSERT INTO `userinoutlog` VALUES ('53', '2017-03-18 22:08:31', '2017-03-18 22:08:31', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-18 22:08:31', null, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', 'b7e80a80fd8a50eae884f84ae3011fc36411cb465b232d1104884dd74efc8d86def8552e4cb0917f6031132cef59763fd1950e73027468c98a03509e4e681442');
INSERT INTO `userinoutlog` VALUES ('54', '2017-03-19 10:12:29', '2017-03-19 10:12:29', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-19 10:12:29', '2017-03-19 12:45:41', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '3e481e9bfc3f94cca3bc51a0b2e6c6f64b41982ce60f0573edabee3c352bcad855c9f5e72a195fa67ee89709a8690c8e298363b68af26dc6cd52c855993ef621');
INSERT INTO `userinoutlog` VALUES ('55', '2017-03-19 12:49:11', '2017-03-19 12:49:11', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-19 12:49:11', '2017-03-19 16:22:52', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '18fd075f2eb0a0f2d2640a484c39abad1798251294fa330db2d73e20187582c853448bd6133dc87544971f18bc0dcbc27960d31e44aa9d683df06060351b6a81');
INSERT INTO `userinoutlog` VALUES ('56', '2017-03-19 18:52:45', '2017-03-19 18:52:45', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-19 18:52:45', '2017-03-19 21:24:49', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '413998352a7d31ff4d421f1e57bf025fe87225be4c2d735b87bb15baec32ca5fa38a51d71dd42507fed7f72cde7ce272832d54447de77649291b2877745d62e8');
INSERT INTO `userinoutlog` VALUES ('57', '2017-03-19 21:31:43', '2017-03-19 21:31:43', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-19 21:31:43', '2017-03-20 00:40:08', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', 'bf3b076dcf88d48bb69fec7803aaaff8617e01d5952332db9fbbf4637c336b27c2519d2e02e24cb7ceee27adacdc581fc884fb0639f3b167f632b32729f41a9e');
INSERT INTO `userinoutlog` VALUES ('58', '2017-03-20 20:41:06', '2017-03-20 20:41:06', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-20 20:41:06', '2017-03-20 21:50:40', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '098f1249172045c3fbec865cb565f0cc98f9a42856a547a18ad51114871ce7292f586894f65b3e35c554929833e3b8ac369a873af8bf6cb6375fdd51b159931c');
INSERT INTO `userinoutlog` VALUES ('59', '2017-03-20 21:55:50', '2017-03-20 21:55:50', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-20 21:55:50', '2017-03-20 22:30:33', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', 'fbfacd08acd01e2f21c84e941150ea5423c5a9ac0633141c96c2fea91cd530405d915bfb8688e2308e1ee44afa0b016284c938641201ac7f48007c96a8779c69');
INSERT INTO `userinoutlog` VALUES ('60', '2017-03-20 22:31:52', '2017-03-20 22:31:52', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-20 22:31:52', '2017-03-21 00:45:19', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '7e3574e72571b9036f29bd6f3e7f1382b0f07e057eb1aec56accf77695b5602fdc15e9a7e38c320f59de0997ad7731bd4555493b281711d58b2d1d08786d0a94');
INSERT INTO `userinoutlog` VALUES ('61', '2017-03-21 00:48:45', '2017-03-21 00:48:45', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-21 00:48:45', null, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '52c7956a67670778b21d017ce1165aa7067ed91423802b18e3a40da3ab908bc77d8ef209c383f5fbe9e667d3011efe1924ba2bdeffc682f6b3e25be8e6ed87ab');
INSERT INTO `userinoutlog` VALUES ('62', '2017-03-21 21:21:05', '2017-03-21 21:21:05', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-21 21:21:05', '2017-03-21 22:31:30', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', 'c45b51a9a136cc0f4900d5af8d0481df9780ef1864ea6fddcca929fd6af8ec665fda6dcfce7803f8f6a0d1a10a1ae3afc197ffa39902f53eb8dbfeccdbd0d5c4');
INSERT INTO `userinoutlog` VALUES ('63', '2017-03-21 22:16:39', '2017-03-21 22:16:39', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-21 22:16:39', '2017-03-21 22:31:43', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '548f4e5d02a825071475ceef6613fa19b78a606cdb774ecffc12b6799113efc15f988996af370b6f47a465e8846de56159e8afbe34c8b06b0d2396dbc9f0e694');
INSERT INTO `userinoutlog` VALUES ('64', '2017-03-22 08:06:20', '2017-03-22 08:06:20', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-22 08:06:20', '2017-03-22 19:38:07', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', 'd617612feff649a6323f3506f90b5729c58bc20797c301a00d2344017af7299a02172ac59a61d849794f2c2329c5b93a0f6335310ca22a3e32ca6aa387300987');
INSERT INTO `userinoutlog` VALUES ('65', '2017-03-22 20:39:38', '2017-03-22 20:39:38', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-22 20:39:38', '2017-03-22 23:04:36', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '834458eeea6722731f456485c04ec703531770b5ac42dfa3364179969cbee394ba7cd62e334421ca5f66930122e20a0c7202a4905e39a7f5e7d6a75580306906');
INSERT INTO `userinoutlog` VALUES ('66', '2017-03-22 23:06:11', '2017-03-22 23:06:11', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-22 23:06:11', '2017-03-22 23:42:13', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '19531cbcc86a75f06b16af133ec922b580fbebc80e4b95c97bd9ccc836bf54319ed424223c6e9bb0353901ef1b85286c723f4cd06eb936b53caa5c8b0a4c4db2');
INSERT INTO `userinoutlog` VALUES ('67', '2017-03-22 23:42:21', '2017-03-22 23:42:21', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-22 23:42:21', '2017-03-26 09:35:10', 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '831ce162ae4b99acb9c3ec934e5c9182f7632e0d6e2d353f6bd90796924f89c13ab47cc9dd23e3d585e8bf01b60afdd002e63d8933808389a204af0e84ec94d0');
INSERT INTO `userinoutlog` VALUES ('68', '2017-03-26 09:35:40', '2017-03-26 09:35:40', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-26 09:35:40', null, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', 'fe603751a4e82a828928391c50d6da426696f48bb4d083e9c30ff786461b23addfc9502fb5c2b26c9f406f1dc0e9210e4ebe1b9621b3d0f85e845a4f9b710fb4');
INSERT INTO `userinoutlog` VALUES ('69', '2017-03-28 23:25:26', '2017-03-28 23:25:26', '1', '1', '::1', 'Maa', 'admin@admin.com', '2017-03-28 23:25:26', null, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', '3f9329c02e32ce2293146f51432f09d112a48d0d6447ab1b6105d164a662ffb368bc1c121ccb6790aca8535baf00913cd27ffa639275754b8846c0534a0c5415');
INSERT INTO `userinoutlog` VALUES ('70', '2017-03-29 21:20:15', '2017-03-29 21:20:15', '1', '1', '127.0.0.1', 'Maa', 'admin@admin.com', '2017-03-29 21:20:15', null, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:52.0) Gecko/20100101 Firefox/52.0', '78a69f45aca8f65354d8cccada7266a35cae32f8c3f6c26a4c73401f76c5ff4708f565bca369be8b9d323aa16a2ab0d142c8f08370141fa8d70f705675c841e4');
SET FOREIGN_KEY_CHECKS=1;
