/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50714
Source Host           : localhost:3306
Source Database       : demo

Target Server Type    : MYSQL
Target Server Version : 50714
File Encoding         : 65001

Date: 2018-12-04 09:50:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `demo_articles`
-- ----------------------------
DROP TABLE IF EXISTS `demo_articles`;
CREATE TABLE `demo_articles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `name` varchar(255) NOT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `content` text,
  `imgpath` varchar(255) NOT NULL COMMENT '图片路径',
  `active` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1激活0未激活',
  `created_at` varchar(255) NOT NULL,
  `updated_at` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo_articles
-- ----------------------------
INSERT INTO `demo_articles` VALUES ('2', '\r\n澳洲留学需要准备哪些东西', '\r\n澳洲留学需要准备哪些东西', '\r\n澳洲留学需要准备哪些东西', '<b>aaaa</b>', 'uploads/common/haoi80x8dtY45Ucksvn31uGqYKtJnl3JVDq3IzEf.jpeg', '1', '1543807873', '1543807873');
INSERT INTO `demo_articles` VALUES ('3', 'PTE听力应该如何练习', 'PTE听力应该如何练习', 'PTE听力应该如何练习', 'aa<img src=\"/uploads/temp/PkA1OAlplJO9QQRC27tfVQvXoVmvR9TIFum4l9pr.jpeg\" alt=\"undefined\">', 'uploads/common/tWxLbSHkr6i9N67kUptER3id3OECLc4KNv82u6sH.jpeg', '1', '1543807941', '1543807941');

-- ----------------------------
-- Table structure for `demo_configs`
-- ----------------------------
DROP TABLE IF EXISTS `demo_configs`;
CREATE TABLE `demo_configs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text,
  `desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo_configs
-- ----------------------------
INSERT INTO `demo_configs` VALUES ('4', 'canalert', '1', '弹出公告 （1弹出|0不弹）');
INSERT INTO `demo_configs` VALUES ('9', 'debugmails', 'fangzheng@kewo.com', '异常接收邮箱');
INSERT INTO `demo_configs` VALUES ('10', 'isSend', '1', '是否发送给异常 （1发送|0不发）');
INSERT INTO `demo_configs` VALUES ('11', 'notice', '<b>sssss</b>', '系统公告');
INSERT INTO `demo_configs` VALUES ('12', 'webname', '课窝后台DEMO', '网站名称');
INSERT INTO `demo_configs` VALUES ('13', 'domain', 'http://demo.com', '网站前台地址');

-- ----------------------------
-- Table structure for `demo_logs`
-- ----------------------------
DROP TABLE IF EXISTS `demo_logs`;
CREATE TABLE `demo_logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL COMMENT '用户',
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `type` int(11) DEFAULT '1' COMMENT '1登录 2新增 3编辑 4删除',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `mark` varchar(255) DEFAULT NULL COMMENT '备注，登录ip 操作数据库',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=250 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of demo_logs
-- ----------------------------
INSERT INTO `demo_logs` VALUES ('4', '1', 'Administrator', '1', '1538215978', '1538215978', 'Administrator于2018-09-29 10:12:58登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('5', '1', 'Administrator', '5', '1538215990', '1538215990', 'Administrator于2018-09-29 10:13:10退出了系统。');
INSERT INTO `demo_logs` VALUES ('6', '1', 'Administrator', '1', '1538270262', '1538270262', 'Administrator于2018-09-30 01:17:42登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('7', '1', 'Administrator', '1', '1538287631', '1538287631', 'Administrator于2018-09-30 06:07:11登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('8', '1', 'Administrator', '1', '1538967471', '1538967471', 'Administrator于2018-10-08 02:57:51登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('9', '1', 'Administrator', '1', '1539056380', '1539056380', 'Administrator于2018-10-09 03:39:40登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('10', '1', 'Administrator', '1', '1539075162', '1539075162', 'Administrator于2018-10-09 08:52:42登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('11', '1', 'Administrator', '1', '1539148393', '1539148393', 'Administrator于2018-10-10 05:13:13登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('12', '1', 'Administrator', '1', '1539225062', '1539225062', 'Administrator于2018-10-11 02:31:02登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('13', '1', 'Administrator', '1', '1539253102', '1539253102', 'Administrator于2018-10-11 10:18:22登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('14', '1', 'Administrator', '1', '1539306647', '1539306647', 'Administrator于2018-10-12 01:10:47登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('15', '1', 'Administrator', '5', '1539313401', '1539313401', 'Administrator于2018-10-12 03:03:21退出了系统。');
INSERT INTO `demo_logs` VALUES ('16', '1', 'Administrator', '1', '1539313407', '1539313407', 'Administrator于2018-10-12 03:03:27登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('17', '1', 'Administrator', '5', '1539313466', '1539313466', 'Administrator于2018-10-12 03:04:26退出了系统。');
INSERT INTO `demo_logs` VALUES ('18', '1', 'Administrator', '1', '1539313470', '1539313470', 'Administrator于2018-10-12 03:04:30登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('19', '1', 'Administrator', '5', '1539313488', '1539313488', 'Administrator于2018-10-12 03:04:48退出了系统。');
INSERT INTO `demo_logs` VALUES ('20', '1', 'Administrator', '1', '1539313493', '1539313493', 'Administrator于2018-10-12 03:04:53登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('21', '1', 'Administrator', '4', '1539314737', '1539314737', 'Administrator于2018-10-12 11:25:37删除了用户manager');
INSERT INTO `demo_logs` VALUES ('22', '1', 'Administrator', '2', '1539314774', '1539314774', 'Administrator于2018-10-12 11:26:14创建了新用户');
INSERT INTO `demo_logs` VALUES ('23', '1', 'Administrator', '2', '1539314937', '1539314937', 'Administrator于2018-10-12 11:28:57创建了新用户editor;ID:9');
INSERT INTO `demo_logs` VALUES ('24', '1', 'Administrator', '3', '1539314937', '1539314937', 'Administrator于2018-10-12 11:28:57编辑了用户editor;ID:9');
INSERT INTO `demo_logs` VALUES ('25', '1', 'Administrator', '3', '1539315118', '1539315118', 'Administrator于2018-10-12 11:31:58编辑了用户editor;ID:9');
INSERT INTO `demo_logs` VALUES ('26', '1', 'Administrator', '5', '1539315846', '1539315846', 'Administrator于2018-10-12 11:44:06退出了系统。');
INSERT INTO `demo_logs` VALUES ('27', '8', 'manager', '1', '1539315864', '1539315864', 'manager于2018-10-12 11:44:24登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('28', '8', 'manager', '5', '1539315870', '1539315870', 'manager于2018-10-12 11:44:30退出了系统。');
INSERT INTO `demo_logs` VALUES ('29', '8', 'manager', '1', '1539315894', '1539315894', 'manager于2018-10-12 11:44:54登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('30', '8', 'manager', '5', '1539316017', '1539316017', 'manager于2018-10-12 11:46:57退出了系统。');
INSERT INTO `demo_logs` VALUES ('31', '9', 'editor', '1', '1539316052', '1539316052', 'editor于2018-10-12 11:47:32登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('32', '9', 'editor', '5', '1539316057', '1539316057', 'editor于2018-10-12 11:47:37退出了系统。');
INSERT INTO `demo_logs` VALUES ('33', '1', 'Administrator', '1', '1539316071', '1539316071', 'Administrator于2018-10-12 11:47:51登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('34', '1', 'Administrator', '5', '1539316076', '1539316076', 'Administrator于2018-10-12 11:47:56退出了系统。');
INSERT INTO `demo_logs` VALUES ('35', '1', 'Administrator', '1', '1539316081', '1539316081', 'Administrator于2018-10-12 11:48:01登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('36', '1', 'Administrator', '1', '1539393320', '1539393320', 'Administrator于2018-10-13 09:15:19登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('37', '1', 'Administrator', '1', '1539592677', '1539592677', 'Administrator于2018-10-15 16:37:57登录了系统，登录ip为：127.0.0.1');
INSERT INTO `demo_logs` VALUES ('38', '1', 'Administrator', '1', '1539932556', '1539932556', 'Administrator于2018-10-19 15:02:36登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('39', '1', 'Administrator', '1', '1540285778', '1540285778', 'Administrator于2018-10-23 17:09:38登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('40', '1', 'Administrator', '1', '1540351150', '1540351150', 'Administrator于2018-10-24 11:19:10登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('41', '1', 'Administrator', '1', '1540371167', '1540371167', 'Administrator于2018-10-24 16:52:47登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('42', '1', 'Administrator', '1', '1540517182', '1540517182', 'Administrator于2018-10-26 09:26:22登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('43', '1', 'Administrator', '1', '1540610944', '1540610944', 'Administrator于2018-10-27 11:29:04登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('44', '1', 'Administrator', '1', '1540865019', '1540865019', 'Administrator于2018-10-30 10:03:39登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('45', '1', 'Administrator', '1', '1540881275', '1540881275', 'Administrator于2018-10-30 14:34:35登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('46', '1', 'Administrator', '1', '1541050418', '1541050418', 'Administrator于2018-11-01 13:33:38登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('47', '1', 'Administrator', '1', '1541121435', '1541121435', 'Administrator于2018-11-02 09:17:15登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('48', '1', 'Administrator', '1', '1541135348', '1541135348', 'Administrator于2018-11-02 13:09:08登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('49', '1', 'Administrator', '2', '1541145539', '1541145539', 'Administrator于2018-11-02 15:58:59:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('50', '1', 'Administrator', '2', '1541145778', '1541145778', 'Administrator于2018-11-02 16:02:58:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('51', '1', 'Administrator', '1', '1541239328', '1541239328', 'Administrator于2018-11-03 18:02:08:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('52', '1', 'Administrator', '1', '1542089347', '1542089347', 'Administrator于2018-11-13 14:09:07:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('53', '1', 'Administrator', '1', '1542158151', '1542158151', 'Administrator于2018-11-14 09:15:51:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('54', '1', 'Administrator', '1', '1542185536', '1542185536', 'Administrator于2018-11-14 16:52:16:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('55', '1', 'Administrator', '1', '1542247575', '1542247575', 'Administrator于2018-11-15 10:06:15:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('56', '1', 'Administrator', '1', '1542332093', '1542332093', 'Administrator于2018-11-16 09:34:53:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('57', '1', 'Administrator', '1', '1542349084', '1542349084', 'Administrator于2018-11-16 14:18:04:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('58', '1', 'Administrator', '1', '1542590351', '1542590351', 'Administrator于2018-11-19 09:19:11:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('59', '1', 'Administrator', '5', '1542592653', '1542592653', 'Administrator于2018-11-19 09:57:33:退出了系统。');
INSERT INTO `demo_logs` VALUES ('60', '1', 'Administrator', '1', '1542592657', '1542592657', 'Administrator于2018-11-19 09:57:37:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('61', '1', 'Administrator', '1', '1542593029', '1542593029', 'Administrator于2018-11-19 10:03:49:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('62', '1', 'Administrator', '5', '1542593190', '1542593190', 'Administrator于2018-11-19 10:06:30:退出了系统。');
INSERT INTO `demo_logs` VALUES ('63', '1', 'Administrator', '1', '1542593202', '1542593202', 'Administrator于2018-11-19 10:06:42:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('64', '8', 'Administrator', '5', '1542607979', '1542607979', 'Administrator于2018-11-19 14:12:59:退出了系统。');
INSERT INTO `demo_logs` VALUES ('65', '8', 'Administrator', '1', '1542607984', '1542607984', 'Administrator于2018-11-19 14:13:04:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('66', '1', 'Administrator', '5', '1542609380', '1542609380', 'Administrator于2018-11-19 14:36:20:退出了系统。');
INSERT INTO `demo_logs` VALUES ('67', '1', 'Administrator', '1', '1542609385', '1542609385', 'Administrator于2018-11-19 14:36:25:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('68', '1', 'Administrator', '2', '1542613533', '1542613533', 'Administrator于2018-11-19 15:45:33:新增数据：4,控制器为：Draft');
INSERT INTO `demo_logs` VALUES ('69', '1', 'Administrator', '3', '1542613638', '1542613638', 'Administrator于2018-11-19 15:47:18:编辑数据ID：4,控制器为：Draft');
INSERT INTO `demo_logs` VALUES ('70', '1', 'Administrator', '4', '1542613731', '1542613731', 'Administrator于2018-11-19 15:48:51:删除数据ID：4,,控制器为：Draft');
INSERT INTO `demo_logs` VALUES ('71', '1', 'Administrator', '6', '1542614345', '1542614345', 'Administrator于2018-11-19 15:59:05:回复发文记录id：10,并修改状态为:合格');
INSERT INTO `demo_logs` VALUES ('72', '1', 'Administrator', '6', '1542614608', '1542614608', 'Administrator于2018-11-19 16:03:28:更新角色（游客）的权限表');
INSERT INTO `demo_logs` VALUES ('73', '1', 'Administrator', '6', '1542614705', '1542614705', 'Administrator于2018-11-19 16:05:05:更新用户（editor）负责站点');
INSERT INTO `demo_logs` VALUES ('74', '1', 'Administrator', '2', '1542614810', '1542614810', 'Administrator于2018-11-19 16:06:50:新增统计数据id:5');
INSERT INTO `demo_logs` VALUES ('75', '1', 'Administrator', '3', '1542614839', '1542614839', 'Administrator于2018-11-19 16:07:19:更新统计数据id:5');
INSERT INTO `demo_logs` VALUES ('76', '1', 'Administrator', '2', '1542614921', '1542614921', 'Administrator于2018-11-19 16:08:41:设定用户（8）目标数:12');
INSERT INTO `demo_logs` VALUES ('77', '1', 'Administrator', '3', '1542616604', '1542616604', 'Administrator于2018-11-19 16:36:44:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('78', '1', 'Administrator', '3', '1542616713', '1542616713', 'Administrator于2018-11-19 16:38:33:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('79', '1', 'Administrator', '3', '1542616722', '1542616722', 'Administrator于2018-11-19 16:38:42:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('80', '1', 'Administrator', '3', '1542616982', '1542616982', 'Administrator于2018-11-19 16:43:02:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('81', '1', 'Administrator', '3', '1542617881', '1542617881', 'Administrator于2018-11-19 16:58:01:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('82', '1', 'Administrator', '3', '1542618033', '1542618033', 'Administrator于2018-11-19 17:00:33:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('83', '1', 'Administrator', '3', '1542618152', '1542618152', 'Administrator于2018-11-19 17:02:32:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('84', '1', 'Administrator', '1', '1542695994', '1542695994', 'Administrator于2018-11-20 14:39:54:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('85', '1', 'Administrator', '2', '1542696644', '1542696644', 'Administrator于2018-11-20 14:50:44:新增数据ID：11,控制器为：Record');
INSERT INTO `demo_logs` VALUES ('86', '1', 'Administrator', '2', '1542696684', '1542696684', 'Administrator于2018-11-20 14:51:24:新增数据ID：12,控制器为：Record');
INSERT INTO `demo_logs` VALUES ('87', '1', 'Administrator', '2', '1542696719', '1542696719', 'Administrator于2018-11-20 14:51:59:新增数据ID：13,控制器为：Record');
INSERT INTO `demo_logs` VALUES ('88', '1', 'Administrator', '2', '1542697190', '1542697190', 'Administrator于2018-11-20 14:59:50:新增数据ID：14,控制器为：Record');
INSERT INTO `demo_logs` VALUES ('89', '1', 'Administrator', '2', '1542697215', '1542697215', 'Administrator于2018-11-20 15:00:15:新增数据ID：15,控制器为：Record');
INSERT INTO `demo_logs` VALUES ('90', '1', 'Administrator', '1', '1542699838', '1542699838', 'Administrator于2018-11-20 15:43:58:登录了系统，登录ip为：127.0.0.1');
INSERT INTO `demo_logs` VALUES ('91', '1', 'Administrator', '1', '1542699878', '1542699878', 'Administrator于2018-11-20 15:44:38:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('92', '1', 'Administrator', '6', '1542701191', '1542701191', 'Administrator于2018-11-20 16:06:31:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('93', '1', 'Administrator', '6', '1542703960', '1542703960', 'Administrator于2018-11-20 16:52:40:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('94', '1', 'Administrator', '6', '1542704079', '1542704079', 'Administrator于2018-11-20 16:54:39:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('95', '1', 'Administrator', '6', '1542704372', '1542704372', 'Administrator于2018-11-20 16:59:32:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('96', '1', 'Administrator', '2', '1542704867', '1542704867', 'Administrator于2018-11-20 17:07:47:新增数据ID：12,控制器为：Operation');
INSERT INTO `demo_logs` VALUES ('97', '1', 'Administrator', '6', '1542704885', '1542704885', 'Administrator于2018-11-20 17:08:05:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('98', '1', 'Administrator', '3', '1542704961', '1542704961', 'Administrator于2018-11-20 17:09:21:编辑数据ID：16,控制器为：Menu');
INSERT INTO `demo_logs` VALUES ('99', '1', 'Administrator', '3', '1542705212', '1542705212', 'Administrator于2018-11-20 17:13:32:编辑数据ID：16,控制器为：Menu');
INSERT INTO `demo_logs` VALUES ('100', '1', 'Administrator', '3', '1542705237', '1542705237', 'Administrator于2018-11-20 17:13:57:编辑数据ID：16,控制器为：Menu');
INSERT INTO `demo_logs` VALUES ('101', '1', 'Administrator', '3', '1542705573', '1542705573', 'Administrator于2018-11-20 17:19:33:编辑数据ID：16,控制器为：Menu');
INSERT INTO `demo_logs` VALUES ('102', '1', 'Administrator', '6', '1542705894', '1542705894', 'Administrator于2018-11-20 17:24:54:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('103', '1', 'Administrator', '3', '1542705906', '1542705906', 'Administrator于2018-11-20 17:25:06:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('104', '1', 'Administrator', '3', '1542706182', '1542706182', 'Administrator于2018-11-20 17:29:42:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('105', '1', 'Administrator', '3', '1542706297', '1542706297', 'Administrator于2018-11-20 17:31:37:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('106', '1', 'Administrator', '3', '1542706501', '1542706501', 'Administrator于2018-11-20 17:35:01:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('107', '1', 'Administrator', '3', '1542706538', '1542706538', 'Administrator于2018-11-20 17:35:38:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('108', '1', 'Administrator', '3', '1542706587', '1542706587', 'Administrator于2018-11-20 17:36:27:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('109', '1', 'Administrator', '3', '1542706594', '1542706594', 'Administrator于2018-11-20 17:36:34:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('110', '1', 'Administrator', '3', '1542706695', '1542706695', 'Administrator于2018-11-20 17:38:15:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('111', '1', 'Administrator', '3', '1542706705', '1542706705', 'Administrator于2018-11-20 17:38:25:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('112', '1', 'Administrator', '3', '1542706732', '1542706732', 'Administrator于2018-11-20 17:38:52:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('113', '1', 'Administrator', '2', '1542708558', '1542708558', 'Administrator于2018-11-20 18:09:18:新增数据ID：1,控制器为：Msg');
INSERT INTO `demo_logs` VALUES ('114', '1', 'Administrator', '2', '1542709375', '1542709375', 'Administrator于2018-11-20 18:22:55:新增数据ID：2,控制器为：Msg');
INSERT INTO `demo_logs` VALUES ('115', '1', 'Administrator', '1', '1542755179', '1542755179', 'Administrator于2018-11-21 07:06:19:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('116', '1', 'Administrator', '2', '1542755189', '1542755189', 'Administrator于2018-11-21 07:06:29:新增数据ID：3,控制器为：Msg');
INSERT INTO `demo_logs` VALUES ('117', '1', 'Administrator', '4', '1542755280', '1542755280', 'Administrator于2018-11-21 07:08:00:已读消息通知ID：2,');
INSERT INTO `demo_logs` VALUES ('118', '1', 'Administrator', '4', '1542755376', '1542755376', 'Administrator于2018-11-21 07:09:36:已读消息通知ID：2,');
INSERT INTO `demo_logs` VALUES ('119', '1', 'Administrator', '4', '1542755383', '1542755383', 'Administrator于2018-11-21 07:09:43:已读消息通知ID：3,');
INSERT INTO `demo_logs` VALUES ('120', '1', 'Administrator', '5', '1542762686', '1542762686', 'Administrator于2018-11-21 09:11:25:退出了系统。');
INSERT INTO `demo_logs` VALUES ('121', '1', 'Administrator', '1', '1542762694', '1542762694', 'Administrator于2018-11-21 09:11:34:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('122', '1', 'Administrator', '2', '1542763135', '1542763135', 'Administrator于2018-11-21 09:18:55:新增数据ID：4,控制器为：Msg');
INSERT INTO `demo_logs` VALUES ('123', '1', 'Administrator', '2', '1542763176', '1542763176', 'Administrator于2018-11-21 09:19:36:新增数据ID：5,控制器为：Msg');
INSERT INTO `demo_logs` VALUES ('124', '1', 'Administrator', '2', '1542763271', '1542763271', 'Administrator于2018-11-21 09:21:11:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('125', '1', 'Administrator', '2', '1542763309', '1542763309', 'Administrator于2018-11-21 09:21:49:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('126', '1', 'Administrator', '2', '1542763377', '1542763377', 'Administrator于2018-11-21 09:22:57:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('127', '1', 'Administrator', '4', '1542765986', '1542765986', 'Administrator于2018-11-21 10:06:26:已读消息通知ID：5,');
INSERT INTO `demo_logs` VALUES ('128', '1', 'Administrator', '4', '1542766077', '1542766077', 'Administrator于2018-11-21 10:07:57:已读消息通知ID：4,');
INSERT INTO `demo_logs` VALUES ('129', '1', 'Administrator', '4', '1542767484', '1542767484', 'Administrator于2018-11-21 10:31:24:已读消息通知ID：5,');
INSERT INTO `demo_logs` VALUES ('130', '1', 'Administrator', '4', '1542767558', '1542767558', 'Administrator于2018-11-21 10:32:38:已读消息通知ID：2,');
INSERT INTO `demo_logs` VALUES ('131', '1', 'Administrator', '4', '1542767558', '1542767558', 'Administrator于2018-11-21 10:32:38:已读消息通知ID：2,');
INSERT INTO `demo_logs` VALUES ('132', '1', 'Administrator', '2', '1542768290', '1542768290', 'Administrator于2018-11-21 10:44:50:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('133', '1', 'Administrator', '2', '1542768322', '1542768322', 'Administrator于2018-11-21 10:45:22:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('134', '1', 'Administrator', '2', '1542768388', '1542768388', 'Administrator于2018-11-21 10:46:28:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('135', '1', 'Administrator', '2', '1542768823', '1542768823', 'Administrator于2018-11-21 10:53:43:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('136', '1', 'Administrator', '2', '1542768859', '1542768859', 'Administrator于2018-11-21 10:54:19:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('137', '1', 'Administrator', '2', '1542768893', '1542768893', 'Administrator于2018-11-21 10:54:53:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('138', '1', 'Administrator', '2', '1542769087', '1542769087', 'Administrator于2018-11-21 10:58:07:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('139', '1', 'Administrator', '2', '1542769312', '1542769312', 'Administrator于2018-11-21 11:01:52:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('140', '1', 'Administrator', '2', '1542769677', '1542769677', 'Administrator于2018-11-21 11:07:57:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('141', '1', 'Administrator', '2', '1542771974', '1542771974', 'Administrator于2018-11-21 11:46:14:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('142', '1', 'Administrator', '2', '1542771993', '1542771993', 'Administrator于2018-11-21 11:46:33:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('143', '1', 'Administrator', '2', '1542772004', '1542772004', 'Administrator于2018-11-21 11:46:44:登录PTE俱乐部,身份为：1');
INSERT INTO `demo_logs` VALUES ('144', '1', 'Administrator', '2', '1542779653', '1542779653', 'Administrator于2018-11-21 13:54:13:登录PTE俱乐部');
INSERT INTO `demo_logs` VALUES ('145', '1', 'Administrator', '1', '1542942699', '1542942699', 'Administrator于2018-11-23 11:11:39:登录了系统，登录ip为：127.0.0.1');
INSERT INTO `demo_logs` VALUES ('146', '1', 'Administrator', '6', '1542954714', '1542954714', 'Administrator于2018-11-23 14:31:54:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('147', '1', 'Administrator', '6', '1542956250', '1542956250', 'Administrator于2018-11-23 14:57:30:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('148', '1', 'Administrator', '6', '1542956424', '1542956424', 'Administrator于2018-11-23 15:00:24:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('149', '1', 'Administrator', '6', '1542956452', '1542956452', 'Administrator于2018-11-23 15:00:52:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('150', '1', 'Administrator', '6', '1542957558', '1542957558', 'Administrator于2018-11-23 15:19:18:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('151', '1', 'Administrator', '6', '1542958010', '1542958010', 'Administrator于2018-11-23 15:26:50:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('152', '1', 'Administrator', '6', '1542958680', '1542958680', 'Administrator于2018-11-23 15:38:00:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('153', '1', 'Administrator', '6', '1542958764', '1542958764', 'Administrator于2018-11-23 15:39:24:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('154', '1', 'Administrator', '6', '1542958821', '1542958821', 'Administrator于2018-11-23 15:40:21:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('155', '1', 'Administrator', '6', '1542959014', '1542959014', 'Administrator于2018-11-23 15:43:34:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('156', '1', 'Administrator', '3', '1542959017', '1542959017', 'Administrator于2018-11-23 15:43:37:编辑数据ID：1,控制器为：Menu');
INSERT INTO `demo_logs` VALUES ('157', '1', 'Administrator', '6', '1542959024', '1542959024', 'Administrator于2018-11-23 15:43:44:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('158', '1', 'Administrator', '6', '1542959154', '1542959154', 'Administrator于2018-11-23 15:45:54:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('159', '1', 'Administrator', '6', '1542959415', '1542959415', 'Administrator于2018-11-23 15:50:15:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('160', '1', 'Administrator', '6', '1542959436', '1542959436', 'Administrator于2018-11-23 15:50:36:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('161', '1', 'Administrator', '6', '1542959491', '1542959491', 'Administrator于2018-11-23 15:51:31:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('162', '1', 'Administrator', '6', '1542960279', '1542960279', 'Administrator于2018-11-23 16:04:39:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('163', '1', 'Administrator', '6', '1542960503', '1542960503', 'Administrator于2018-11-23 16:08:23:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('164', '1', 'Administrator', '6', '1542960720', '1542960720', 'Administrator于2018-11-23 16:12:00:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('165', '1', 'Administrator', '6', '1542961059', '1542961059', 'Administrator于2018-11-23 16:17:39:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('166', '1', 'Administrator', '6', '1542961382', '1542961382', 'Administrator于2018-11-23 16:23:02:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('167', '1', 'Administrator', '6', '1542961569', '1542961569', 'Administrator于2018-11-23 16:26:09:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('168', '1', 'Administrator', '6', '1542961717', '1542961717', 'Administrator于2018-11-23 16:28:37:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('169', '1', 'Administrator', '6', '1542964350', '1542964350', 'Administrator于2018-11-23 17:12:30:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('170', '1', 'Administrator', '6', '1542964416', '1542964416', 'Administrator于2018-11-23 17:13:36:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('171', '1', 'Administrator', '6', '1542964491', '1542964491', 'Administrator于2018-11-23 17:14:51:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('172', '1', 'Administrator', '6', '1542965144', '1542965144', 'Administrator于2018-11-23 17:25:44:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('173', '1', 'Administrator', '6', '1542965219', '1542965219', 'Administrator于2018-11-23 17:26:59:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('174', '1', 'Administrator', '6', '1542965352', '1542965352', 'Administrator于2018-11-23 17:29:12:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('175', '1', 'Administrator', '6', '1542965363', '1542965363', 'Administrator于2018-11-23 17:29:23:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('176', '1', 'Administrator', '6', '1542965681', '1542965681', 'Administrator于2018-11-23 17:34:41:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('177', '1', 'Administrator', '6', '1542965857', '1542965857', 'Administrator于2018-11-23 17:37:37:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('178', '1', 'Administrator', '6', '1542966090', '1542966090', 'Administrator于2018-11-23 17:41:30:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('179', '1', 'Administrator', '6', '1542966229', '1542966229', 'Administrator于2018-11-23 17:43:49:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('180', '1', 'Administrator', '6', '1542966247', '1542966247', 'Administrator于2018-11-23 17:44:07:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('181', '1', 'Administrator', '6', '1542966462', '1542966462', 'Administrator于2018-11-23 17:47:42:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('182', '1', 'Administrator', '6', '1542966479', '1542966479', 'Administrator于2018-11-23 17:47:59:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('183', '1', 'Administrator', '6', '1542966649', '1542966649', 'Administrator于2018-11-23 17:50:49:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('184', '1', 'Administrator', '6', '1542966651', '1542966651', 'Administrator于2018-11-23 17:50:51:回复发文记录id：14,');
INSERT INTO `demo_logs` VALUES ('185', '1', 'Administrator', '6', '1542966703', '1542966703', 'Administrator于2018-11-23 17:51:43:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('186', '1', 'Administrator', '6', '1542966944', '1542966944', 'Administrator于2018-11-23 17:55:44:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('187', '1', 'Administrator', '6', '1542967086', '1542967086', 'Administrator于2018-11-23 17:58:06:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('188', '1', 'Administrator', '6', '1542967319', '1542967319', 'Administrator于2018-11-23 18:01:59:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('189', '1', 'Administrator', '6', '1542967397', '1542967397', 'Administrator于2018-11-23 18:03:17:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('190', '1', 'Administrator', '6', '1542967411', '1542967411', 'Administrator于2018-11-23 18:03:31:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('191', '1', 'Administrator', '6', '1542967425', '1542967425', 'Administrator于2018-11-23 18:03:45:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('192', '1', 'Administrator', '4', '1542967428', '1542967428', 'Administrator于2018-11-23 18:03:48:已读消息通知ID：3,');
INSERT INTO `demo_logs` VALUES ('193', '1', 'Administrator', '6', '1542967575', '1542967575', 'Administrator于2018-11-23 18:06:15:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('194', '8', 'Administrator', '6', '1542967669', '1542967669', 'Administrator于2018-11-23 18:07:49:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('195', '1', 'Administrator', '6', '1542967806', '1542967806', 'Administrator于2018-11-23 18:10:06:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('196', '1', 'Administrator', '6', '1542967874', '1542967874', 'Administrator于2018-11-23 18:11:14:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('197', '1', 'Administrator', '6', '1542973981', '1542973981', 'Administrator于2018-11-23 19:53:01:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('198', '1', 'Administrator', '6', '1542974214', '1542974214', 'Administrator于2018-11-23 19:56:54:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('199', '1', 'Administrator', '6', '1542974326', '1542974326', 'Administrator于2018-11-23 19:58:46:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('200', '1', 'Administrator', '1', '1543041942', '1543041942', 'Administrator于2018-11-24 14:45:42:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('201', '1', 'Administrator', '2', '1543042597', '1543042597', 'Administrator于2018-11-24 14:56:37:新增数据ID：1,控制器为：Siteroute');
INSERT INTO `demo_logs` VALUES ('202', '1', 'Administrator', '3', '1543042695', '1543042695', 'Administrator于2018-11-24 14:58:15:编辑数据ID：1,控制器为：Siteroute');
INSERT INTO `demo_logs` VALUES ('203', '1', 'Administrator', '4', '1543042699', '1543042699', 'Administrator于2018-11-24 14:58:19:删除数据ID：1,,控制器为：Siteroute');
INSERT INTO `demo_logs` VALUES ('204', '1', 'Administrator', '2', '1543042742', '1543042742', 'Administrator于2018-11-24 14:59:02:新增数据ID：2,控制器为：Siteroute');
INSERT INTO `demo_logs` VALUES ('205', '1', 'Administrator', '1', '1543195346', '1543195346', 'Administrator于2018-11-26 09:22:26:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('206', '1', 'Administrator', '3', '1543195913', '1543195913', 'Administrator于2018-11-26 09:31:53:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('207', '1', 'Administrator', '3', '1543198807', '1543198807', 'Administrator于2018-11-26 10:20:07:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('208', '1', 'Administrator', '3', '1543199854', '1543199854', 'Administrator于2018-11-26 10:37:34:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('209', '1', 'Administrator', '1', '1543210119', '1543210119', 'Administrator于2018-11-26 13:28:39:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('210', '1', 'Administrator', '3', '1543216743', '1543216743', 'Administrator于2018-11-26 15:19:03:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('211', '1', 'Administrator', '1', '1543224908', '1543224908', 'Administrator于2018-11-26 17:35:08:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('212', '1', 'Administrator', '3', '1543225285', '1543225285', 'Administrator于2018-11-26 17:41:25:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('213', '1', 'Administrator', '3', '1543225607', '1543225607', 'Administrator于2018-11-26 17:46:47:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('214', '1', 'Administrator', '3', '1543225752', '1543225752', 'Administrator于2018-11-26 17:49:12:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('215', '1', 'Administrator', '3', '1543225798', '1543225798', 'Administrator于2018-11-26 17:49:58:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('216', '1', 'Administrator', '3', '1543225812', '1543225812', 'Administrator于2018-11-26 17:50:12:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('217', '1', 'Administrator', '3', '1543225883', '1543225883', 'Administrator于2018-11-26 17:51:23:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('218', '1', 'Administrator', '6', '1543226119', '1543226119', 'Administrator于2018-11-26 17:55:19:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('219', '1', 'Administrator', '6', '1543226446', '1543226446', 'Administrator于2018-11-26 18:00:46:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('220', '1', 'Administrator', '6', '1543226455', '1543226455', 'Administrator于2018-11-26 18:00:55:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('221', '1', 'Administrator', '6', '1543226463', '1543226463', 'Administrator于2018-11-26 18:01:03:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('222', '1', 'Administrator', '6', '1543226536', '1543226536', 'Administrator于2018-11-26 18:02:16:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('223', '1', 'Administrator', '6', '1543226587', '1543226587', 'Administrator于2018-11-26 18:03:07:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('224', '1', 'Administrator', '6', '1543226592', '1543226592', 'Administrator于2018-11-26 18:03:12:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('225', '1', 'Administrator', '6', '1543226639', '1543226639', 'Administrator于2018-11-26 18:03:59:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('226', '1', 'Administrator', '1', '1543287689', '1543287689', 'Administrator于2018-11-27 11:01:29:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('227', '1', 'Administrator', '2', '1543293164', '1543293164', 'Administrator于2018-11-27 12:32:44:新增数据ID：23,控制器为：Siteroute');
INSERT INTO `demo_logs` VALUES ('228', '1', 'Administrator', '4', '1543295790', '1543295790', 'Administrator于2018-11-27 13:16:30:删除数据ID：23,,控制器为：Siteroute');
INSERT INTO `demo_logs` VALUES ('229', '1', 'Administrator', '5', '1543572797', '1543572797', 'Administrator于2018-11-30 10:13:17:退出了系统。');
INSERT INTO `demo_logs` VALUES ('230', '1', 'admin', '1', '1543629030', '1543629030', 'admin于2018-12-01 01:50:30:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('231', '1', 'admin', '5', '1543635668', '1543635668', 'admin于2018-12-01 03:41:08:退出了系统。');
INSERT INTO `demo_logs` VALUES ('232', '1', 'admin', '1', '1543635701', '1543635701', 'admin于2018-12-01 03:41:41:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('233', '1', 'admin', '1', '1543643368', '1543643368', 'admin于2018-12-01 05:49:28:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('234', '1', 'admin', '1', '1543799069', '1543799069', 'admin于2018-12-03 09:04:29:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('235', '1', 'admin', '5', '1543800665', '1543800665', 'admin于2018-12-03 09:31:05:退出了系统。');
INSERT INTO `demo_logs` VALUES ('236', '1', 'admin', '1', '1543800735', '1543800735', 'admin于2018-12-03 09:32:15:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('237', '1', 'admin', '6', '1543815463', '1543815463', 'admin于2018-12-03 13:37:43:更新角色（游客）的权限表');
INSERT INTO `demo_logs` VALUES ('238', '1', 'admin', '6', '1543815669', '1543815669', 'admin于2018-12-03 13:41:09:更新角色（游客）的权限表');
INSERT INTO `demo_logs` VALUES ('239', '1', 'admin', '4', '1543818232', '1543818232', 'admin于2018-12-03 14:23:52:删除数据ID：62,61,60,,控制器为：Permission');
INSERT INTO `demo_logs` VALUES ('240', '1', 'admin', '4', '1543826672', '1543826672', 'admin于2018-12-03 16:44:32:删除数据ID：33,,控制器为：Menu');
INSERT INTO `demo_logs` VALUES ('241', '1', 'admin', '4', '1543826676', '1543826676', 'admin于2018-12-03 16:44:36:删除数据ID：32,,控制器为：Menu');
INSERT INTO `demo_logs` VALUES ('242', '1', 'admin', '3', '1543828809', '1543828809', 'admin于2018-12-03 17:20:09:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('243', '1', 'admin', '3', '1543829920', '1543829920', 'admin于2018-12-03 17:38:40:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('244', '1', 'admin', '3', '1543829979', '1543829979', 'admin于2018-12-03 17:39:39:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('245', '1', 'admin', '3', '1543830026', '1543830026', 'admin于2018-12-03 17:40:26:更新网站配置项');
INSERT INTO `demo_logs` VALUES ('246', '1', 'admin', '1', '1543886691', '1543886691', 'admin于2018-12-04 09:24:51:登录了系统，登录ip为：::1');
INSERT INTO `demo_logs` VALUES ('247', '1', 'admin', '6', '1543886981', '1543886981', 'admin于2018-12-04 09:29:41:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('248', '1', 'admin', '6', '1543886995', '1543886995', 'admin于2018-12-04 09:29:55:更新角色（超级管理员）的权限表');
INSERT INTO `demo_logs` VALUES ('249', '1', 'admin', '3', '1543888187', '1543888187', 'admin于2018-12-04 09:49:47:更新网站配置项');

-- ----------------------------
-- Table structure for `demo_menus`
-- ----------------------------
DROP TABLE IF EXISTS `demo_menus`;
CREATE TABLE `demo_menus` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `href` varchar(255) DEFAULT NULL COMMENT '菜单路径',
  `name` varchar(255) DEFAULT NULL COMMENT '菜单名称',
  `title` varchar(255) DEFAULT NULL COMMENT '菜单标题',
  `icon` varchar(255) DEFAULT NULL COMMENT 'icon',
  `spread` int(11) DEFAULT '0' COMMENT '是否展开 0 false 1 true',
  `pid` int(11) DEFAULT '0' COMMENT '0顶级1二级',
  `sort` int(11) DEFAULT '1' COMMENT '排序',
  `active` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='后台菜单';

-- ----------------------------
-- Records of demo_menus
-- ----------------------------
INSERT INTO `demo_menus` VALUES ('19', null, '网站管理', '网站管理', null, '0', '0', '1', '1');
INSERT INTO `demo_menus` VALUES ('20', null, '内容管理', '内容管理', null, '0', '0', '1', '1');
INSERT INTO `demo_menus` VALUES ('21', '/admins/operations', '操作管理', '操作管理', null, '0', '19', '1', '1');
INSERT INTO `demo_menus` VALUES ('22', '/admins/menus', '后台菜单', '后台菜单', null, '0', '19', '1', '1');
INSERT INTO `demo_menus` VALUES ('23', '/admins/roles', '角色管理', '角色管理', null, '0', '19', '1', '1');
INSERT INTO `demo_menus` VALUES ('24', '/admins/users', '用户管理', '用户管理', null, '0', '19', '1', '1');
INSERT INTO `demo_menus` VALUES ('25', '/admins/permissions', '权限管理', '权限管理', null, '0', '19', '1', '1');
INSERT INTO `demo_menus` VALUES ('26', '/admins/config', '网站设置', '网站设置', null, '0', '19', '1', '1');
INSERT INTO `demo_menus` VALUES ('27', null, '分类管理', '分类管理', null, '0', '20', '1', '1');
INSERT INTO `demo_menus` VALUES ('28', '/admins/articles', '文章管理', '文章管理', null, '0', '20', '1', '1');
INSERT INTO `demo_menus` VALUES ('34', '/admins/logs', '日志管理', '日志管理', null, '0', '20', '1', '1');

-- ----------------------------
-- Table structure for `demo_operations`
-- ----------------------------
DROP TABLE IF EXISTS `demo_operations`;
CREATE TABLE `demo_operations` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '菜单名',
  `named` varchar(255) DEFAULT NULL COMMENT '命名：user 则控制器UserController ORM User ',
  `created_at` varchar(255) DEFAULT NULL,
  `updated_at` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL COMMENT '菜单icon图标',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='后台操作数据统计表';

-- ----------------------------
-- Records of demo_operations
-- ----------------------------
INSERT INTO `demo_operations` VALUES ('1', '角色管理', 'role', null, null, null);
INSERT INTO `demo_operations` VALUES ('2', '节点管理', 'permission', null, null, null);
INSERT INTO `demo_operations` VALUES ('3', '菜单管理', 'menu', null, null, null);
INSERT INTO `demo_operations` VALUES ('4', '日志管理', 'log', null, null, null);

-- ----------------------------
-- Table structure for `demo_permissions`
-- ----------------------------
DROP TABLE IF EXISTS `demo_permissions`;
CREATE TABLE `demo_permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `the_alias` varchar(255) DEFAULT NULL,
  `sort` int(11) DEFAULT '0',
  `menu_id` int(11) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8 COMMENT='权限表';

-- ----------------------------
-- Records of demo_permissions
-- ----------------------------
INSERT INTO `demo_permissions` VALUES ('64', '首页', 'operation.index', '1', '21');
INSERT INTO `demo_permissions` VALUES ('65', '新增', 'operation.add', '0', '21');
INSERT INTO `demo_permissions` VALUES ('66', '编辑', 'operation.edit', '0', '21');
INSERT INTO `demo_permissions` VALUES ('67', '删除', 'operation.delete', '0', '21');
INSERT INTO `demo_permissions` VALUES ('68', '列表', 'operation.list', '0', '21');
INSERT INTO `demo_permissions` VALUES ('69', '首页', 'menu.index', '0', '22');
INSERT INTO `demo_permissions` VALUES ('70', '列表', 'menu.list', '0', '22');
INSERT INTO `demo_permissions` VALUES ('71', '新增', 'menu.add', '0', '22');
INSERT INTO `demo_permissions` VALUES ('72', '编辑', 'menu.edit', '0', '22');
INSERT INTO `demo_permissions` VALUES ('73', '删除', 'menu.delete', '0', '22');
INSERT INTO `demo_permissions` VALUES ('74', '首页', 'role.index', '0', '23');
INSERT INTO `demo_permissions` VALUES ('75', '列表', 'role.list', '0', '23');
INSERT INTO `demo_permissions` VALUES ('76', '新增', 'role.add', '0', '23');
INSERT INTO `demo_permissions` VALUES ('77', '编辑', 'role.edit', '0', '23');
INSERT INTO `demo_permissions` VALUES ('78', '删除', 'role.delete', '0', '23');
INSERT INTO `demo_permissions` VALUES ('79', '首页', 'user.index', '0', '24');
INSERT INTO `demo_permissions` VALUES ('80', '列表', 'user.list', '0', '24');
INSERT INTO `demo_permissions` VALUES ('81', '新增', 'user.add', '0', '24');
INSERT INTO `demo_permissions` VALUES ('82', '编辑', 'user.edit', '0', '24');
INSERT INTO `demo_permissions` VALUES ('83', '删除', 'user.delete', '0', '24');
INSERT INTO `demo_permissions` VALUES ('84', '首页', 'permission.index', '0', '25');
INSERT INTO `demo_permissions` VALUES ('85', '列表', 'permission.list', '0', '25');
INSERT INTO `demo_permissions` VALUES ('86', '新增', 'permission.add', '0', '25');
INSERT INTO `demo_permissions` VALUES ('87', '编辑', 'permission.edit', '0', '25');
INSERT INTO `demo_permissions` VALUES ('88', '删除', 'permission.delete', '0', '25');
INSERT INTO `demo_permissions` VALUES ('89', '配置', 'config.index', '0', '26');
INSERT INTO `demo_permissions` VALUES ('90', '首页', 'article.index', '0', '28');
INSERT INTO `demo_permissions` VALUES ('91', '列表', 'article.list', '0', '28');
INSERT INTO `demo_permissions` VALUES ('92', '新增', 'article.add', '0', '28');
INSERT INTO `demo_permissions` VALUES ('93', '编辑', 'article.edit', '0', '28');
INSERT INTO `demo_permissions` VALUES ('94', '删除', 'article.delete', '0', '28');
INSERT INTO `demo_permissions` VALUES ('95', '首页', 'log.index', '0', '34');
INSERT INTO `demo_permissions` VALUES ('96', '列表', 'log.list', '0', '34');
INSERT INTO `demo_permissions` VALUES ('97', '查看所有', 'log.listall', '0', '34');

-- ----------------------------
-- Table structure for `demo_roles`
-- ----------------------------
DROP TABLE IF EXISTS `demo_roles`;
CREATE TABLE `demo_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '角色名称',
  `sort` int(11) DEFAULT '1' COMMENT '排序',
  `active` tinyint(1) DEFAULT '1' COMMENT '1激活 0禁用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='角色';

-- ----------------------------
-- Records of demo_roles
-- ----------------------------
INSERT INTO `demo_roles` VALUES ('1', '超级管理员', '1', '1');
INSERT INTO `demo_roles` VALUES ('2', '网站管理员', '1', '1');
INSERT INTO `demo_roles` VALUES ('3', '网站编辑', '1', '1');
INSERT INTO `demo_roles` VALUES ('4', '游客', '11', '1');

-- ----------------------------
-- Table structure for `demo_role_menu`
-- ----------------------------
DROP TABLE IF EXISTS `demo_role_menu`;
CREATE TABLE `demo_role_menu` (
  `role_id` int(11) unsigned NOT NULL,
  `menu_id` int(11) unsigned NOT NULL,
  KEY `role_id` (`role_id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `demo_role_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `demo_roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `demo_role_menu_ibfk_2` FOREIGN KEY (`menu_id`) REFERENCES `demo_menus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色菜单表';

-- ----------------------------
-- Records of demo_role_menu
-- ----------------------------
INSERT INTO `demo_role_menu` VALUES ('1', '21');
INSERT INTO `demo_role_menu` VALUES ('1', '22');
INSERT INTO `demo_role_menu` VALUES ('1', '23');
INSERT INTO `demo_role_menu` VALUES ('1', '24');
INSERT INTO `demo_role_menu` VALUES ('1', '25');
INSERT INTO `demo_role_menu` VALUES ('1', '26');
INSERT INTO `demo_role_menu` VALUES ('1', '27');
INSERT INTO `demo_role_menu` VALUES ('1', '28');
INSERT INTO `demo_role_menu` VALUES ('1', '34');

-- ----------------------------
-- Table structure for `demo_role_permission`
-- ----------------------------
DROP TABLE IF EXISTS `demo_role_permission`;
CREATE TABLE `demo_role_permission` (
  `role_id` int(11) unsigned DEFAULT NULL,
  `permission_id` int(11) unsigned DEFAULT NULL,
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`),
  CONSTRAINT `demo_role_permission_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `demo_roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `demo_role_permission_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `demo_permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='角色权限表';

-- ----------------------------
-- Records of demo_role_permission
-- ----------------------------
INSERT INTO `demo_role_permission` VALUES ('1', '64');
INSERT INTO `demo_role_permission` VALUES ('1', '65');
INSERT INTO `demo_role_permission` VALUES ('1', '66');
INSERT INTO `demo_role_permission` VALUES ('1', '67');
INSERT INTO `demo_role_permission` VALUES ('1', '68');
INSERT INTO `demo_role_permission` VALUES ('1', '69');
INSERT INTO `demo_role_permission` VALUES ('1', '70');
INSERT INTO `demo_role_permission` VALUES ('1', '71');
INSERT INTO `demo_role_permission` VALUES ('1', '72');
INSERT INTO `demo_role_permission` VALUES ('1', '73');
INSERT INTO `demo_role_permission` VALUES ('1', '74');
INSERT INTO `demo_role_permission` VALUES ('1', '75');
INSERT INTO `demo_role_permission` VALUES ('1', '76');
INSERT INTO `demo_role_permission` VALUES ('1', '77');
INSERT INTO `demo_role_permission` VALUES ('1', '78');
INSERT INTO `demo_role_permission` VALUES ('1', '79');
INSERT INTO `demo_role_permission` VALUES ('1', '80');
INSERT INTO `demo_role_permission` VALUES ('1', '81');
INSERT INTO `demo_role_permission` VALUES ('1', '82');
INSERT INTO `demo_role_permission` VALUES ('1', '83');
INSERT INTO `demo_role_permission` VALUES ('1', '84');
INSERT INTO `demo_role_permission` VALUES ('1', '85');
INSERT INTO `demo_role_permission` VALUES ('1', '86');
INSERT INTO `demo_role_permission` VALUES ('1', '87');
INSERT INTO `demo_role_permission` VALUES ('1', '88');
INSERT INTO `demo_role_permission` VALUES ('1', '89');
INSERT INTO `demo_role_permission` VALUES ('1', '90');
INSERT INTO `demo_role_permission` VALUES ('1', '91');
INSERT INTO `demo_role_permission` VALUES ('1', '92');
INSERT INTO `demo_role_permission` VALUES ('1', '93');
INSERT INTO `demo_role_permission` VALUES ('1', '94');
INSERT INTO `demo_role_permission` VALUES ('1', '95');
INSERT INTO `demo_role_permission` VALUES ('1', '96');
INSERT INTO `demo_role_permission` VALUES ('1', '97');

-- ----------------------------
-- Table structure for `demo_runexceptions`
-- ----------------------------
DROP TABLE IF EXISTS `demo_runexceptions`;
CREATE TABLE `demo_runexceptions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT '异常名称',
  `time` int(11) DEFAULT NULL COMMENT '异常发生时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='异常表';

-- ----------------------------
-- Records of demo_runexceptions
-- ----------------------------
INSERT INTO `demo_runexceptions` VALUES ('23', 'syntax error, unexpected \'$menus\' (T_VARIABLE)', '1543888107');

-- ----------------------------
-- Table structure for `demo_users`
-- ----------------------------
DROP TABLE IF EXISTS `demo_users`;
CREATE TABLE `demo_users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `username` varchar(255) NOT NULL COMMENT '用户名',
  `password` varchar(255) NOT NULL COMMENT '密码',
  `created_at` varchar(255) DEFAULT NULL COMMENT '创建日期',
  `updated_at` varchar(255) DEFAULT NULL COMMENT '更新日期',
  `remember_token` varchar(255) DEFAULT NULL COMMENT '记住我',
  `avatar` varchar(255) DEFAULT NULL COMMENT '用户头像',
  `logins` int(11) DEFAULT '1' COMMENT '登录次数',
  `active` int(11) DEFAULT '1' COMMENT '1激活0禁用',
  `role_id` int(11) unsigned DEFAULT '0' COMMENT '角色id',
  `last_login` int(11) DEFAULT '0' COMMENT '上次登录时间',
  `last_ip` varchar(255) DEFAULT NULL COMMENT '上次登录ip',
  `this_login` int(11) DEFAULT NULL,
  `this_ip` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL COMMENT '昵称',
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `demo_users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `demo_roles` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='后台用户表';

-- ----------------------------
-- Records of demo_users
-- ----------------------------
INSERT INTO `demo_users` VALUES ('1', 'admin', '$2y$10$TLe4ghOviKiYtSXw/GzjuO5s8Dpbkxqq4PbdpkjbTnmTIQXgRYew6', null, '1543886691', 'qo6uB281PgF1BRIQmJmPBETJoY2W1Akq51HmVeVQeNSRwJvPNhwD0oLKssID', 'uploads/avatar/76IF0yHNm4yLhxAubVjNwbaUzioipO33lgVE7XaA.png', '49', '1', '1', '1543800735', '::1', '1543886691', '::1', '管理员');
INSERT INTO `demo_users` VALUES ('8', 'manager', 'e10adc3949ba59abbe56e057f20f883e', '1539314774', '1539315894', '7ypenTh20PPJJI4WyLbZlA6qhqeX7h0u52QouyeELbJ4nOIkPJ6rRsppdMO2', 'uploads/avatar/Zz5iRWZPQhDBxxKcOdTRHcewI8VMnyeQ8WRpdxkS.png', '3', '1', '2', '1539315864', '::1', '1539315894', '::1', '管理员');
INSERT INTO `demo_users` VALUES ('9', 'editor', 'e10adc3949ba59abbe56e057f20f883e', '1539314937', '1539316052', 'dL450UhBMG0xhWUi5vbH0pusnZYmAqrCWP5vA1t2bFt4oXHverMZCe4j8zCu', 'uploads/avatar/4EangxIn3UDNgAeAwL7043uyKjXQjhStdpiV7esd.png', '2', '1', '3', null, null, '1539316052', '::1', '管理员');
INSERT INTO `demo_users` VALUES ('10', 'ww', '4eae35f1b35977a00ebd8086c259d4c9', '1543657103', '1543657103', null, 'uploads/avatar/Owloz46lndfOEJA1FbIKRoD5Pk1PFEAjSP4pcTRD.png', '1', '1', '1', '0', null, null, null, 'ww');
