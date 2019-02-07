/*
Navicat MySQL Data Transfer

Source Server         : gani
Source Server Version : 50505
Source Host           : 127.0.0.1:3306
Source Database       : layanan

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2019-02-07 16:16:35
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'perubahan atau penambahan aplikas', '2019-02-03 11:24:37', '2019-02-03 11:24:42');
INSERT INTO `categories` VALUES ('2', 'permintaan akses', '2019-02-03 11:25:27', '2019-02-03 11:25:32');

-- ----------------------------
-- Table structure for incidents
-- ----------------------------
DROP TABLE IF EXISTS `incidents`;
CREATE TABLE `incidents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `impact` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `stage_id` int(10) unsigned NOT NULL,
  `ticket` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of incidents
-- ----------------------------

-- ----------------------------
-- Table structure for incident_approvals
-- ----------------------------
DROP TABLE IF EXISTS `incident_approvals`;
CREATE TABLE `incident_approvals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `incident_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of incident_approvals
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('12', '2014_10_12_000000_create_users_table', '1');
INSERT INTO `migrations` VALUES ('13', '2014_10_12_100000_create_password_resets_table', '1');
INSERT INTO `migrations` VALUES ('14', '2019_01_18_075248_create_layanan_tables', '1');
INSERT INTO `migrations` VALUES ('15', '2019_01_21_090953_create_permission_tables', '1');
INSERT INTO `migrations` VALUES ('16', '2019_01_22_075346_create_notifications_table', '1');

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES ('1', 'App\\User', '6833');
INSERT INTO `model_has_roles` VALUES ('2', 'App\\User', '3');
INSERT INTO `model_has_roles` VALUES ('3', 'App\\User', '10112');
INSERT INTO `model_has_roles` VALUES ('4', 'App\\User', '5');
INSERT INTO `model_has_roles` VALUES ('6', 'App\\User', '4');
INSERT INTO `model_has_roles` VALUES ('10', 'App\\User', '6');
INSERT INTO `model_has_roles` VALUES ('17', 'App\\User', '10112');

-- ----------------------------
-- Table structure for notifications
-- ----------------------------
DROP TABLE IF EXISTS `notifications`;
CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of notifications
-- ----------------------------
INSERT INTO `notifications` VALUES ('001c71ce-9615-4b68-9ec2-7955ea16ddc7', 'App\\Notifications\\RequestCreated', 'App\\User', '6', '{\"stage_id\":2,\"id\":2,\"business_benefit\":\"Tes permintaan\"}', null, '2019-02-07 04:08:19', '2019-02-07 04:08:19');
INSERT INTO `notifications` VALUES ('21a394dc-6f11-41a7-8397-42b7ba4a4ce7', 'App\\Notifications\\RequestCreated', 'App\\User', '5', '{\"stage_id\":2,\"id\":2,\"business_benefit\":\"Tes permintaan\"}', '2019-02-07 04:21:52', '2019-02-07 04:08:19', '2019-02-07 04:21:52');
INSERT INTO `notifications` VALUES ('2385a593-0052-45e2-a41a-40ec720f57d8', 'App\\Notifications\\RequestCreated', 'App\\User', '6', '{\"stage_id\":7,\"id\":1,\"business_benefit\":\"Tes alasan permintaan\"}', null, '2019-02-07 07:56:40', '2019-02-07 07:56:40');
INSERT INTO `notifications` VALUES ('273bed53-81f2-4e02-8e02-e6c785baaf0f', 'App\\Notifications\\RequestCreated', 'App\\User', '6', '{\"stage_id\":7,\"id\":2,\"business_benefit\":\"Tes permintaan\"}', null, '2019-02-07 07:34:20', '2019-02-07 07:34:20');
INSERT INTO `notifications` VALUES ('32063bb4-cf06-4a41-80ef-7b6efb5f618b', 'App\\Notifications\\RequestCreated', 'App\\User', '4', '{\"stage_id\":10,\"id\":1,\"business_benefit\":\"Tes alasan permintaan\"}', '2019-02-07 07:24:25', '2019-02-07 04:28:44', '2019-02-07 07:24:25');
INSERT INTO `notifications` VALUES ('41afe4cc-520e-4613-bec8-d51bfca393b4', 'App\\Notifications\\RequestCreated', 'App\\User', '10112', '{\"stage_id\":2,\"id\":2,\"business_benefit\":\"Tes permintaan\"}', null, '2019-02-07 04:08:19', '2019-02-07 04:08:19');
INSERT INTO `notifications` VALUES ('531529bb-37c2-448a-9319-141a66663eda', 'App\\Notifications\\RequestCreated', 'App\\User', '6', '{\"stage_id\":7,\"id\":1,\"business_benefit\":\"Tes alasan permintaan\"}', null, '2019-02-07 07:24:32', '2019-02-07 07:24:32');
INSERT INTO `notifications` VALUES ('6bfc93cb-e588-4894-96a9-755c4856569b', 'App\\Notifications\\RequestCreated', 'App\\User', '6', '{\"stage_id\":7,\"id\":1,\"business_benefit\":\"Tes alasan permintaan\"}', null, '2019-02-07 07:24:24', '2019-02-07 07:24:24');
INSERT INTO `notifications` VALUES ('7a4e7718-d791-45c4-a275-c55d81584140', 'App\\Notifications\\RequestCreated', 'App\\User', '6', '{\"stage_id\":7,\"id\":2,\"business_benefit\":\"Tes permintaan\"}', null, '2019-02-07 07:55:23', '2019-02-07 07:55:23');
INSERT INTO `notifications` VALUES ('88b92822-052e-434a-9dce-86518fe5b10b', 'App\\Notifications\\RequestCreated', 'App\\User', '10112', '{\"stage_id\":1,\"id\":1,\"business_benefit\":\"Tes alasan permintaan\"}', '2019-02-06 09:55:34', '2019-02-06 09:52:12', '2019-02-06 09:55:34');
INSERT INTO `notifications` VALUES ('8efdc767-6199-40b2-bca9-098ba051f422', 'App\\Notifications\\RequestCreated', 'App\\User', '6', '{\"stage_id\":2,\"id\":1,\"business_benefit\":\"Tes alasan permintaan\"}', null, '2019-02-06 09:55:34', '2019-02-06 09:55:34');
INSERT INTO `notifications` VALUES ('8f08735f-46a9-471f-a1ac-01952b955ef8', 'App\\Notifications\\RequestCreated', 'App\\User', '5', '{\"stage_id\":2,\"id\":1,\"business_benefit\":\"Tes alasan permintaan\"}', null, '2019-02-06 09:55:33', '2019-02-06 09:55:33');
INSERT INTO `notifications` VALUES ('c1678f83-e929-4f9a-a4c3-bf185526d5f5', 'App\\Notifications\\RequestCreated', 'App\\User', '4', '{\"stage_id\":10,\"id\":2,\"business_benefit\":\"Tes permintaan\"}', '2019-02-07 07:34:20', '2019-02-07 04:21:52', '2019-02-07 07:34:20');
INSERT INTO `notifications` VALUES ('d056640f-dc56-46a4-ac38-12718aef77d5', 'App\\Notifications\\RequestCreated', 'App\\User', '10112', '{\"stage_id\":2,\"id\":1,\"business_benefit\":\"Tes alasan permintaan\"}', null, '2019-02-06 09:55:34', '2019-02-06 09:55:34');
INSERT INTO `notifications` VALUES ('dbaa58e1-b131-41f2-991c-c84dc6461ab5', 'App\\Notifications\\RequestCreated', 'App\\User', '4', '{\"stage_id\":10,\"id\":2,\"business_benefit\":\"Tes permintaan\"}', null, '2019-02-07 04:19:56', '2019-02-07 04:19:56');
INSERT INTO `notifications` VALUES ('fedda311-c543-4ff8-9da8-9148035bbc8d', 'App\\Notifications\\RequestCreated', 'App\\User', '10112', '{\"stage_id\":1,\"id\":2,\"business_benefit\":\"Tes permintaan\"}', '2019-02-07 04:08:19', '2019-02-07 04:07:22', '2019-02-07 04:08:19');

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of password_resets
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES ('1', 'browse request', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `permissions` VALUES ('2', 'create request', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `permissions` VALUES ('3', 'edit request', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `permissions` VALUES ('4', 'delete request', 'web', '2019-02-01 03:10:01', '2019-02-01 03:10:01');
INSERT INTO `permissions` VALUES ('5', 'browse incident', 'web', '2019-02-01 03:10:01', '2019-02-01 03:10:01');
INSERT INTO `permissions` VALUES ('6', 'create incident', 'web', '2019-02-01 03:10:01', '2019-02-01 03:10:01');
INSERT INTO `permissions` VALUES ('7', 'edit incident', 'web', '2019-02-01 03:10:01', '2019-02-01 03:10:01');
INSERT INTO `permissions` VALUES ('8', 'delete incident', 'web', '2019-02-01 03:10:01', '2019-02-01 03:10:01');
INSERT INTO `permissions` VALUES ('9', 'employee incident', 'web', '2019-02-01 03:10:01', '2019-02-01 03:10:01');
INSERT INTO `permissions` VALUES ('10', 'crud stages', 'web', '2019-02-01 03:10:01', '2019-02-01 03:10:01');
INSERT INTO `permissions` VALUES ('11', 'crud statuses', 'web', '2019-02-01 03:10:01', '2019-02-01 03:10:01');
INSERT INTO `permissions` VALUES ('12', 'crud services', 'web', '2019-02-01 03:10:01', '2019-02-01 03:10:01');
INSERT INTO `permissions` VALUES ('13', 'boss approval', 'web', '2019-02-01 03:10:01', '2019-02-01 03:10:01');
INSERT INTO `permissions` VALUES ('14', 'operation approval', 'web', '2019-02-01 03:10:02', '2019-02-01 03:10:02');
INSERT INTO `permissions` VALUES ('15', 'servicedesk update', 'web', '2019-02-01 03:10:02', '2019-02-01 03:10:02');
INSERT INTO `permissions` VALUES ('16', 'so approval', 'web', '2019-02-01 03:10:02', '2019-02-01 03:10:02');

-- ----------------------------
-- Table structure for requests
-- ----------------------------
DROP TABLE IF EXISTS `requests`;
CREATE TABLE `requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_need` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_benefit` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attachment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci,
  `ticket` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) DEFAULT NULL,
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `stage_id` int(10) unsigned NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nda` int(1) DEFAULT NULL,
  `so` int(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of requests
-- ----------------------------
INSERT INTO `requests` VALUES ('1', '3', 'Tes Judul', 'Tes alasan permintaan', 'Tes manfaat terhadap bisnis', 'attachments/aCmfg9JsZB3DelnC3sanwW5Kro82oFdO2sLJafJE.jpeg', null, null, '2', 'tes \r\ntes', '6833', '7', 'Tes keterangan tambahan', '1', '6', '2019-02-06 09:52:12', '2019-02-07 07:56:40');
INSERT INTO `requests` VALUES ('2', '3', 'Tes', 'Tes permintaan', 'Tes manfaat', 'attachments/rZUFHKyJCSGIAniqeFaIpgCEljdRaj523FfzW1lc.jpeg', null, null, '2', 'tessss', '6833', '10', 'Tes keterangan', '1', '6', '2019-02-07 04:07:21', '2019-02-07 07:54:48');

-- ----------------------------
-- Table structure for request_approvals
-- ----------------------------
DROP TABLE IF EXISTS `request_approvals`;
CREATE TABLE `request_approvals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `stage_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of request_approvals
-- ----------------------------
INSERT INTO `request_approvals` VALUES ('1', '1', '6833', '1', '1', '2019-02-06 09:52:12', '2019-02-06 09:52:12');
INSERT INTO `request_approvals` VALUES ('2', '1', '10112', '2', '2', '2019-02-06 09:55:33', '2019-02-06 09:55:33');
INSERT INTO `request_approvals` VALUES ('3', '2', '6833', '1', '1', '2019-02-07 04:07:21', '2019-02-07 04:07:21');
INSERT INTO `request_approvals` VALUES ('4', '2', '10112', '2', '2', '2019-02-07 04:08:18', '2019-02-07 04:08:18');
INSERT INTO `request_approvals` VALUES ('5', '2', '5', '2', '10', '2019-02-07 04:11:52', '2019-02-07 04:11:52');
INSERT INTO `request_approvals` VALUES ('6', '2', '5', '2', '10', '2019-02-07 04:15:20', '2019-02-07 04:15:20');
INSERT INTO `request_approvals` VALUES ('7', '2', '5', '2', '10', '2019-02-07 04:18:46', '2019-02-07 04:18:46');
INSERT INTO `request_approvals` VALUES ('8', '2', '5', '2', '10', '2019-02-07 04:19:56', '2019-02-07 04:19:56');
INSERT INTO `request_approvals` VALUES ('9', '2', '5', '2', '10', '2019-02-07 04:21:51', '2019-02-07 04:21:51');
INSERT INTO `request_approvals` VALUES ('10', '1', '5', '2', '10', '2019-02-07 04:28:44', '2019-02-07 04:28:44');
INSERT INTO `request_approvals` VALUES ('11', '1', '4', '2', '7', '2019-02-07 07:24:24', '2019-02-07 07:24:24');
INSERT INTO `request_approvals` VALUES ('12', '1', '4', '2', '7', '2019-02-07 07:24:32', '2019-02-07 07:24:32');
INSERT INTO `request_approvals` VALUES ('13', '2', '4', '2', '7', '2019-02-07 07:34:20', '2019-02-07 07:34:20');
INSERT INTO `request_approvals` VALUES ('14', '2', '4', '2', '7', '2019-02-07 07:55:21', '2019-02-07 07:55:21');
INSERT INTO `request_approvals` VALUES ('15', '1', '4', '2', '7', '2019-02-07 07:56:40', '2019-02-07 07:56:40');

-- ----------------------------
-- Table structure for request_attachments
-- ----------------------------
DROP TABLE IF EXISTS `request_attachments`;
CREATE TABLE `request_attachments` (
  `id` int(10) NOT NULL,
  `request_id` int(10) DEFAULT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of request_attachments
-- ----------------------------

-- ----------------------------
-- Table structure for request_reasonfiles
-- ----------------------------
DROP TABLE IF EXISTS `request_reasonfiles`;
CREATE TABLE `request_reasonfiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_id` int(10) DEFAULT NULL,
  `attachment` text,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of request_reasonfiles
-- ----------------------------
INSERT INTO `request_reasonfiles` VALUES ('1', '1', 'attachments/dpIPKdxGb9DtKx3ckqWdGaB1SrkmwTxafcd7sxui.jpeg', '2019-02-07 07:24:24', '2019-02-07 07:24:24');
INSERT INTO `request_reasonfiles` VALUES ('2', '1', 'attachments/Mq7srlGiIa1rGaOxJggfVD6foEOQrhDu1igDmxA0.jpeg', '2019-02-07 07:24:32', '2019-02-07 07:24:32');
INSERT INTO `request_reasonfiles` VALUES ('3', '2', 'attachments/BnvSoS4cxW4xuhlgfd0qSlYeP5AuTV8ZOXF5PSRM.jpeg', '2019-02-07 07:34:20', '2019-02-07 07:34:20');
INSERT INTO `request_reasonfiles` VALUES ('4', '1', 'attachments/dYmegbmZCzJC9s7Zil0V8w700igpfop3auZfgxiL.jpeg', '2019-02-07 07:45:07', '2019-02-07 07:45:07');
INSERT INTO `request_reasonfiles` VALUES ('5', '1', 'attachments/g69e8Q0hVPY9aO66GreCvVPrJBl9geNHT2ifzILY.jpeg', '2019-02-07 07:48:06', '2019-02-07 07:48:06');
INSERT INTO `request_reasonfiles` VALUES ('6', '2', 'attachments/HcMBwx7gPT33ApsxGbqxOzWbRDPsWTFmQSvnGyNt.jpeg', '2019-02-07 07:55:21', '2019-02-07 07:55:21');
INSERT INTO `request_reasonfiles` VALUES ('7', '2', 'attachments/v7HWXIB8r6YfndkvuoBeZovysZ48DeYIaqH99x91.jpeg', '2019-02-07 07:55:21', '2019-02-07 07:55:21');
INSERT INTO `request_reasonfiles` VALUES ('8', '1', 'attachments/DDmnVOx1E2u5UwTtTIPSbRcpGjycI4l6rXW0MrFH.jpeg', '2019-02-07 07:56:40', '2019-02-07 07:56:40');
INSERT INTO `request_reasonfiles` VALUES ('9', '1', 'attachments/cw9y0rWxR6vsanTA0UgBY73yxHpZKxor1mhVWVyw.jpeg', '2019-02-07 07:56:40', '2019-02-07 07:56:40');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'employee', 'web', '2019-02-01 03:09:59', '2019-02-01 03:09:59');
INSERT INTO `roles` VALUES ('2', 'service desk', 'web', '2019-02-01 03:09:59', '2019-02-01 03:09:59');
INSERT INTO `roles` VALUES ('3', 'boss', 'web', '2019-02-01 03:09:59', '2019-02-01 03:09:59');
INSERT INTO `roles` VALUES ('4', 'operation sd', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('5', 'so mes flat', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('6', 'so web', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('7', 'so mes long', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('8', 'so sap hr', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('9', 'so sap pp', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('10', 'operation ict', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('11', 'so sap fi', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('12', 'so sap co', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('13', 'so sap sd', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('14', 'so mes im', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('15', 'so mes mm', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('16', 'so sap ps', 'web', '2019-02-01 03:10:00', '2019-02-01 03:10:00');
INSERT INTO `roles` VALUES ('17', 'manager beict', 'web', '2019-02-01 10:46:56', '2019-02-01 10:47:02');
INSERT INTO `roles` VALUES ('18', 'so sap', 'web', '2019-02-03 17:12:07', '2019-02-03 17:12:11');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES ('1', '1');
INSERT INTO `role_has_permissions` VALUES ('1', '17');
INSERT INTO `role_has_permissions` VALUES ('2', '1');
INSERT INTO `role_has_permissions` VALUES ('2', '17');
INSERT INTO `role_has_permissions` VALUES ('3', '1');
INSERT INTO `role_has_permissions` VALUES ('3', '17');
INSERT INTO `role_has_permissions` VALUES ('4', '1');
INSERT INTO `role_has_permissions` VALUES ('4', '17');
INSERT INTO `role_has_permissions` VALUES ('5', '1');
INSERT INTO `role_has_permissions` VALUES ('6', '1');
INSERT INTO `role_has_permissions` VALUES ('7', '1');
INSERT INTO `role_has_permissions` VALUES ('8', '1');
INSERT INTO `role_has_permissions` VALUES ('9', '1');
INSERT INTO `role_has_permissions` VALUES ('10', '2');
INSERT INTO `role_has_permissions` VALUES ('11', '2');
INSERT INTO `role_has_permissions` VALUES ('12', '2');
INSERT INTO `role_has_permissions` VALUES ('13', '3');
INSERT INTO `role_has_permissions` VALUES ('14', '4');
INSERT INTO `role_has_permissions` VALUES ('14', '10');
INSERT INTO `role_has_permissions` VALUES ('15', '2');
INSERT INTO `role_has_permissions` VALUES ('16', '5');
INSERT INTO `role_has_permissions` VALUES ('16', '6');
INSERT INTO `role_has_permissions` VALUES ('16', '7');
INSERT INTO `role_has_permissions` VALUES ('16', '8');
INSERT INTO `role_has_permissions` VALUES ('16', '9');
INSERT INTO `role_has_permissions` VALUES ('16', '11');
INSERT INTO `role_has_permissions` VALUES ('16', '12');
INSERT INTO `role_has_permissions` VALUES ('16', '13');
INSERT INTO `role_has_permissions` VALUES ('16', '14');
INSERT INTO `role_has_permissions` VALUES ('16', '16');

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` int(10) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`,`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of services
-- ----------------------------
INSERT INTO `services` VALUES ('1', 'Layanan aplikasi sap', '6', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `services` VALUES ('2', 'Layanan aplikasi mes', '6', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `services` VALUES ('3', 'Layanan aplikasi web', '6', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `services` VALUES ('4', 'Layanan aplikasi Office', '6', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `services` VALUES ('5', 'Layanan messaging', '6', '2019-02-01 13:31:48', '2019-02-01 13:31:54');
INSERT INTO `services` VALUES ('6', 'Layanan perangkat komputer', '6', '2019-02-01 13:32:29', '2019-02-01 13:32:33');
INSERT INTO `services` VALUES ('7', 'Layanan printer', '6', '2019-02-01 13:32:58', '2019-02-01 13:33:03');
INSERT INTO `services` VALUES ('8', 'Layanan Jaringan', '6', '2019-02-01 13:33:26', '2019-02-01 13:33:30');
INSERT INTO `services` VALUES ('9', 'Layanan video conference', '6', '2019-02-01 13:34:15', '2019-02-01 13:34:22');

-- ----------------------------
-- Table structure for stages
-- ----------------------------
DROP TABLE IF EXISTS `stages`;
CREATE TABLE `stages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of stages
-- ----------------------------
INSERT INTO `stages` VALUES ('1', 'waiting for boss approval', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `stages` VALUES ('2', 'waiting for operation desk', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `stages` VALUES ('3', 'waiting for service desk', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `stages` VALUES ('4', 'ticket created', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `stages` VALUES ('5', 'resolved', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `stages` VALUES ('6', 'waiting user confirmation', '2019-01-29 14:27:28', '2019-01-29 14:27:33');
INSERT INTO `stages` VALUES ('7', 'waiting for operation ict', '2019-01-30 17:05:49', '2019-01-30 17:05:54');
INSERT INTO `stages` VALUES ('8', 'request denied', '2019-01-30 17:35:37', '2019-01-30 17:35:43');
INSERT INTO `stages` VALUES ('9', 'closed', '2019-01-30 17:49:03', '2019-01-30 17:49:12');
INSERT INTO `stages` VALUES ('10', 'waiting for so approval', '2019-01-23 20:57:15', '2019-01-30 20:57:20');
INSERT INTO `stages` VALUES ('11', 'request rejected', '2019-02-01 11:13:35', '2019-02-08 11:13:40');

-- ----------------------------
-- Table structure for statuses
-- ----------------------------
DROP TABLE IF EXISTS `statuses`;
CREATE TABLE `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of statuses
-- ----------------------------
INSERT INTO `statuses` VALUES ('1', 'waiting for approval', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `statuses` VALUES ('2', 'approved', '2019-01-23 07:33:31', '2019-01-23 07:33:31');
INSERT INTO `statuses` VALUES ('3', 'rejected', '2019-01-23 07:33:31', '2019-01-23 07:33:31');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10113 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('3', 'ITA NURJANAH', 'sd@fmail.com', '$2y$10$8NeU0ilffIdzD0UsYGuPzeKoCefm9gUXxpwF/uq0x3w352TnyMkO2', 'hxI5jKRgujyq4nX94dZVHgz3VBgTW5cUf5uU8hmKxMNZp0cm0nXEAezuVEku', '2019-01-23 07:33:32', '2019-01-23 07:33:32');
INSERT INTO `users` VALUES ('4', 'RAHMADHANY TRIASTANTO', 'so@fmail.com', '$2y$10$1ulV41HzatLGU8uZ7t.7bOfBC4fGyVccUpTSeyV7aMYYnBLdqeBnO', 'bv3zSWhMO55T0iVDC15lhQyu3O9W6COuLIH5M0rQzSz8nijwbDQSbcVXNo3S', '2019-01-23 07:33:32', '2019-01-23 07:33:32');
INSERT INTO `users` VALUES ('5', 'ANDI SOFIA KARINA', 'spsd@fmail.com', '$2y$10$xvhQgX5JDIBA5t3SSpmWbOodbYz6xliIlHMFkgBVuAMb6/bXCfYP.', 'gUQEzE77KHmSN9mUGxoRHL71CTgYLJNw397eSX1qj0w7KxipxECGdlBBZCRp', '2019-01-23 07:33:33', '2019-01-23 07:33:33');
INSERT INTO `users` VALUES ('6', 'OTTE DA', 'spict@fmail.com', '$2y$10$ecD/iKvERilg1v.edwBKJO9HQLHzu2EcJLb79AWtMMUrHGcZuFH0O', 'rtMlyJpuhDfUfTwJ6fedfBzCCyFA8m3bF4x0hFi8jgCfjkmr9qIYBiPfm3gA', '2019-01-23 07:33:33', '2019-01-23 07:33:33');
INSERT INTO `users` VALUES ('6833', 'UJANG FURKON', 'user@test.com', '$2y$10$W0lJHrCa4U45Gf0Mnnww9OnrBYZFTQyBwTisx..VMeIb24e1txyRK', 'S4XUzrV7kfkEagsLgi4BEPlYnYwaKz83W6VTTcAJ1WtILwdp6xBIylmQ4PeT', '2019-01-23 07:33:32', '2019-01-25 07:29:32');
INSERT INTO `users` VALUES ('10112', 'MUHAMMAD HELMI NUR WIDIYARTO', 'el@fmail.com', '$2y$10$siWBJZrI4NfMPVnMq1ZaEOmbChtgrem25ecoK8MnWyAXrw6hdhHsq', 'iz5M3BSx0UcVJ3ipiTLTq3KUuRmhj0uW6NdYgoqSMxJ51VYaR4gzraA94nRH', '2019-01-23 07:33:32', '2019-01-24 02:02:56');
