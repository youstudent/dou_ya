/*
 Navicat Premium Data Transfer

 Source Server         : 玉鑫电脑
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : 192.168.2.117:3306
 Source Schema         : dou_ya

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 12/09/2017 18:04:28
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ya_activity
-- ----------------------------
DROP TABLE IF EXISTS `ya_activity`;
CREATE TABLE `ya_activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动管理',
  `merchant_name` varchar(30) DEFAULT NULL COMMENT '商家名',
  `activity_name` varchar(20) DEFAULT NULL COMMENT '活动名',
  `activity_img` varchar(255) DEFAULT NULL COMMENT '活动封面',
  `activity_address` varchar(100) DEFAULT NULL COMMENT '活动地址',
  `apply_end_time` int(11) DEFAULT NULL COMMENT '报名截止时间',
  `start_time` int(11) DEFAULT NULL COMMENT '活动开始时间',
  `end_time` int(11) DEFAULT NULL COMMENT '活动结束时间',
  `phone` varchar(11) DEFAULT NULL COMMENT '电话',
  `linkman` varchar(20) DEFAULT NULL COMMENT '联系人',
  `purchase_limitation` int(10) DEFAULT NULL COMMENT '单人限购',
  `on_line` int(11) DEFAULT NULL COMMENT '参与上线',
  `content` text COMMENT '内容',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `status` int(2) DEFAULT NULL COMMENT '状态  :1正常  2:下线  3:停止',
  `total_price` int(11) DEFAULT NULL COMMENT '总售价',
  `total_clearing` int(11) DEFAULT NULL COMMENT '总结算价',
  `collect_number` int(11) DEFAULT '0' COMMENT '搜藏量',
  `allpage_view` int(11) DEFAULT '0' COMMENT '浏览量',
  `merchant_id` int(11) DEFAULT NULL COMMENT '商家ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_activity
-- ----------------------------
BEGIN;
INSERT INTO `ya_activity` VALUES (1, '成都昂科网络科技有限公司', '成都昂科网络科技有限公司[成都春熙路三日', 'uploads/activity/39771504617959.jpg', '成都春熙路', 1506604800, 1504574700, 1505524800, '13219890986', '龙龙', 10, 10000, '<p>我喜欢成都<img src=\"/uploads/activity/1504617922507372.jpg\" title=\"1504617922507372.jpg\" alt=\"5万岸果园-详情.jpg\"/></p>', 1504617959, 1, NULL, NULL, 1, 160, 2);
INSERT INTO `ya_activity` VALUES (3, '成都龙龙公司', '成都龙龙公司[吃!!!喝!!玩]', 'uploads/activity/83771504618302.jpg', '日本东京', 1504426800, 1503865200, 1504531500, '13219890986', '勇勇', 3, 500, '<p>活动好舒服</p>', 1504618302, 0, NULL, NULL, 0, 0, 2);
INSERT INTO `ya_activity` VALUES (4, '快活商家', '成都三日游', 'uploads/activity/96291504836111.jpg', '成都市环球中心', 1504772400, 1504575900, 1505547300, '13219890986', '成', 2, 500, '<p>这是我们的活动,</p>', 1504686388, 1, NULL, NULL, 0, 8, 2);
INSERT INTO `ya_activity` VALUES (5, '龙龙商家', '龙龙商家发布的活动', 'uploads/activity/21141505102446.jpg', '成都市环球中心', 1505440800, 1505872800, 1506736800, '13219890986', '龙龙', 5, 500, '<p>活动有500个名额, 请大家速快报名</p>', 1505102446, 1, NULL, NULL, 1, 14, 3);
INSERT INTO `ya_activity` VALUES (6, '龙龙商家', '龙龙商家发布的2条活动', 'uploads/activity/72501505102693.jpg', '成都石室', 1505356200, 1506749100, 1506786900, '13219890986', '龙龙2号', 2, 1000, '<p>发布活动</p>', 1505102693, 1, 0, 0, 0, 66, 3);
INSERT INTO `ya_activity` VALUES (7, '快活商家', '快活商家', NULL, '尘', 1504677900, 1504737000, 1505976600, '13219890986', '龙龙', 1, 1000, '<p>作为搜会计师考虑</p>', 1505110065, 1, 0, 0, 0, 11, 2);
INSERT INTO `ya_activity` VALUES (8, '龙龙商家', '舒服舒服舒服', NULL, '城市框架房', 1506149400, 1504751400, 1505458200, '13219890986', '111', 1, 1000, '<p>爽肤水</p>', 1505111382, 1, 0, 0, 0, 41, 3);
COMMIT;

-- ----------------------------
-- Table structure for ya_activity_data
-- ----------------------------
DROP TABLE IF EXISTS `ya_activity_data`;
CREATE TABLE `ya_activity_data` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '活动数据',
  `activity_id` int(11) DEFAULT NULL COMMENT '活动ID',
  `order_num` int(11) DEFAULT '0' COMMENT '订单数',
  `order_number_num` int(11) DEFAULT '0' COMMENT '订单人数',
  `checking_num` int(11) DEFAULT '0' COMMENT '验票人数',
  `transaction_money` int(11) DEFAULT '0' COMMENT '交易总额',
  `footings` int(11) DEFAULT '0' COMMENT '结算总额',
  `checking_transaction_money` int(11) DEFAULT '0' COMMENT '交易总额已验票',
  `checking_footings` int(11) DEFAULT '0' COMMENT '结算总额已验票',
  `activity_name` varchar(20) DEFAULT NULL COMMENT '活动名字',
  `merchant_name` varchar(20) DEFAULT NULL COMMENT '商家名',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_activity_data
-- ----------------------------
BEGIN;
INSERT INTO `ya_activity_data` VALUES (1, 7, 0, 0, 0, 0, 0, 0, 0, NULL, NULL);
INSERT INTO `ya_activity_data` VALUES (2, 8, 0, 0, 0, 0, 0, 0, 0, '舒服舒服舒服', '龙龙商家');
COMMIT;

-- ----------------------------
-- Table structure for ya_activity_ticket
-- ----------------------------
DROP TABLE IF EXISTS `ya_activity_ticket`;
CREATE TABLE `ya_activity_ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '票种',
  `activity_id` int(10) NOT NULL COMMENT '活动ID',
  `price` int(10) DEFAULT NULL COMMENT '售价',
  `settlement` int(10) DEFAULT NULL COMMENT '结算',
  `return` int(10) DEFAULT NULL COMMENT '利润',
  `title` varchar(20) DEFAULT NULL COMMENT '标题',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_activity_ticket
-- ----------------------------
BEGIN;
INSERT INTO `ya_activity_ticket` VALUES (5, 1, 5000, 4000, 20, '普通票');
INSERT INTO `ya_activity_ticket` VALUES (6, 1, 1000, 900, 10, '高级票');
INSERT INTO `ya_activity_ticket` VALUES (7, 1, 500, 400, 20, '普通票');
INSERT INTO `ya_activity_ticket` VALUES (8, 1, 10000, 9000, 10, '黄金票');
INSERT INTO `ya_activity_ticket` VALUES (9, 3, 998, 900, 9, '飘飘');
INSERT INTO `ya_activity_ticket` VALUES (16, 4, 500, 400, 20, '儿童票');
INSERT INTO `ya_activity_ticket` VALUES (17, 4, 1000, 900, 10, '成人票');
INSERT INTO `ya_activity_ticket` VALUES (18, 5, 500, 400, 20, '儿童票');
INSERT INTO `ya_activity_ticket` VALUES (19, 6, 100, 50, 50, '成人票');
INSERT INTO `ya_activity_ticket` VALUES (20, 7, 500, 100, 80, '黄金票');
INSERT INTO `ya_activity_ticket` VALUES (21, 8, 1000, 20, 98, '爽肤水');
COMMIT;

-- ----------------------------
-- Table structure for ya_admin
-- ----------------------------
DROP TABLE IF EXISTS `ya_admin`;
CREATE TABLE `ya_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '账号',
  `job_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '工号',
  `type` int(3) DEFAULT NULL COMMENT '类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ya_admin
-- ----------------------------
BEGIN;
INSERT INTO `ya_admin` VALUES (4, '琪琪', '', '$2y$13$I1ceS2TxnDT64O7r.Czim.t6fVkGluyQwuaPW6eI1WqJxMRzyvOTu', NULL, '', 1, 1504513578, 1504515598, '13219890986', 'KJKG12', '1121', NULL);
COMMIT;

-- ----------------------------
-- Table structure for ya_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `ya_auth_assignment`;
CREATE TABLE `ya_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `ya_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `ya_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for ya_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `ya_auth_item`;
CREATE TABLE `ya_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `ya_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `ya_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for ya_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `ya_auth_item_child`;
CREATE TABLE `ya_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `ya_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `ya_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ya_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `ya_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for ya_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `ya_auth_rule`;
CREATE TABLE `ya_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for ya_banner
-- ----------------------------
DROP TABLE IF EXISTS `ya_banner`;
CREATE TABLE `ya_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'banner管理',
  `title` varchar(20) DEFAULT NULL COMMENT '标题',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_banner
-- ----------------------------
BEGIN;
INSERT INTO `ya_banner` VALUES (8, ' 一大波妹子!!', 1504248750);
COMMIT;

-- ----------------------------
-- Table structure for ya_banner_img
-- ----------------------------
DROP TABLE IF EXISTS `ya_banner_img`;
CREATE TABLE `ya_banner_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'banner图片',
  `img` varchar(255) DEFAULT NULL,
  `banner_id` int(2) DEFAULT NULL COMMENT 'banner_id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_banner_img
-- ----------------------------
BEGIN;
INSERT INTO `ya_banner_img` VALUES (21, 'uploads/banner/57281504750622.jpg', 8);
INSERT INTO `ya_banner_img` VALUES (22, 'uploads/banner/28231504750622.jpg', 8);
COMMIT;

-- ----------------------------
-- Table structure for ya_collect_activity
-- ----------------------------
DROP TABLE IF EXISTS `ya_collect_activity`;
CREATE TABLE `ya_collect_activity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '收藏活动',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `activity_id` int(4) DEFAULT NULL COMMENT '活动ID',
  `created_at` int(11) DEFAULT NULL COMMENT '收藏时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_collect_activity
-- ----------------------------
BEGIN;
INSERT INTO `ya_collect_activity` VALUES (29, 1, 5, 1505198346);
INSERT INTO `ya_collect_activity` VALUES (2, 1, 3, 1504683863);
INSERT INTO `ya_collect_activity` VALUES (35, 1, 1, 1505199972);
COMMIT;

-- ----------------------------
-- Table structure for ya_collect_merchant
-- ----------------------------
DROP TABLE IF EXISTS `ya_collect_merchant`;
CREATE TABLE `ya_collect_merchant` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '收藏商家',
  `user_id` int(3) NOT NULL COMMENT '用户ID',
  `merchant_id` int(5) NOT NULL COMMENT '商家ID',
  `created_at` int(11) DEFAULT NULL COMMENT '收藏商家时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_collect_merchant
-- ----------------------------
BEGIN;
INSERT INTO `ya_collect_merchant` VALUES (30, 1, 3, 1505198344);
INSERT INTO `ya_collect_merchant` VALUES (33, 1, 2, 1505205590);
COMMIT;

-- ----------------------------
-- Table structure for ya_contract
-- ----------------------------
DROP TABLE IF EXISTS `ya_contract`;
CREATE TABLE `ya_contract` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '合同号',
  `merchant_id` int(2) DEFAULT NULL COMMENT '商家ID',
  `contract_img` varchar(255) DEFAULT NULL COMMENT '合同图片',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ya_count
-- ----------------------------
DROP TABLE IF EXISTS `ya_count`;
CREATE TABLE `ya_count` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '运营统计',
  `num` int(11) DEFAULT NULL COMMENT '订单数量',
  `type` int(2) DEFAULT NULL COMMENT '1:订单  2:活动  3:流水 4:总金额  5:利润   6:用户数  7:商户数',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_count
-- ----------------------------
BEGIN;
INSERT INTO `ya_count` VALUES (1, 1, 1, 1504617959);
INSERT INTO `ya_count` VALUES (2, 1, 2, 1504618302);
INSERT INTO `ya_count` VALUES (8, 1, 2, 1504686388);
INSERT INTO `ya_count` VALUES (9, 1, 7, 1504688371);
INSERT INTO `ya_count` VALUES (10, 1, 7, 1505102226);
INSERT INTO `ya_count` VALUES (11, 1, 7, 1505102253);
INSERT INTO `ya_count` VALUES (12, 1, 2, 1505102446);
INSERT INTO `ya_count` VALUES (13, 1, 2, 1505102693);
INSERT INTO `ya_count` VALUES (14, 1, 2, 1505110065);
INSERT INTO `ya_count` VALUES (15, 1, 2, 1505111382);
INSERT INTO `ya_count` VALUES (16, 1, 7, 1505111402);
COMMIT;

-- ----------------------------
-- Table structure for ya_member
-- ----------------------------
DROP TABLE IF EXISTS `ya_member`;
CREATE TABLE `ya_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户',
  `name` varchar(20) NOT NULL COMMENT '用户名',
  `sex` tinyint(1) DEFAULT NULL COMMENT '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
  `phone` int(11) DEFAULT NULL COMMENT '电话',
  `last_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `status` int(2) DEFAULT NULL COMMENT '状态   1:正常  0:停封',
  `identification` varchar(20) DEFAULT '' COMMENT '证认',
  `order_num` int(10) DEFAULT NULL COMMENT '下单量',
  `order_money` int(10) DEFAULT NULL COMMENT '下单金额',
  `openid` varchar(255) NOT NULL COMMENT '微信openid',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_member
-- ----------------------------
BEGIN;
INSERT INTO `ya_member` VALUES (1, '', NULL, NULL, NULL, 0, '', NULL, NULL, '');
INSERT INTO `ya_member` VALUES (2, 'harlen', 2, NULL, NULL, 1, '', NULL, NULL, 'orDOGwT-0MguFxydmGnLRF7A7RYc');
COMMIT;

-- ----------------------------
-- Table structure for ya_menu
-- ----------------------------
DROP TABLE IF EXISTS `ya_menu`;
CREATE TABLE `ya_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `ya_menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `ya_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ya_merchant
-- ----------------------------
DROP TABLE IF EXISTS `ya_merchant`;
CREATE TABLE `ya_merchant` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商家',
  `name` varchar(30) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL COMMENT '联系人电话',
  `address` varchar(255) DEFAULT NULL COMMENT '地址',
  `seleaman` varchar(20) DEFAULT NULL COMMENT '业务员',
  `created_at` int(11) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL COMMENT '封面',
  `merchant_label` varchar(255) DEFAULT NULL COMMENT '标签',
  `linkman` varchar(20) DEFAULT NULL COMMENT '联系人',
  `contract_number` varchar(50) DEFAULT NULL COMMENT '合同号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_merchant
-- ----------------------------
BEGIN;
INSERT INTO `ya_merchant` VALUES (2, '快活商家', '13219890982', '成都市环球中心二号', '琪琪', 1504616609, 'uploads/merchant/23881504616609.jpg', '吃饭...住宿...打牌', '江哥', 'IJGIQOPGF13OP4');
INSERT INTO `ya_merchant` VALUES (3, '龙龙商家', '13219890983', '成都市环球中心', '张伟', 1505111402, 'uploads/merchant/46351505102226.jpg', '这是我哥标签', '龙龙', 'LKJIENGISKJG');
COMMIT;

-- ----------------------------
-- Table structure for ya_merchant_img
-- ----------------------------
DROP TABLE IF EXISTS `ya_merchant_img`;
CREATE TABLE `ya_merchant_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商家',
  `merchant_id` int(2) DEFAULT NULL COMMENT '商家id',
  `img` varchar(255) DEFAULT NULL COMMENT '合同地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_merchant_img
-- ----------------------------
BEGIN;
INSERT INTO `ya_merchant_img` VALUES (1, 1, 'uploads/merchant/83991504256109.jpg');
INSERT INTO `ya_merchant_img` VALUES (2, 1, 'uploads/merchant/14501504256109.jpg');
INSERT INTO `ya_merchant_img` VALUES (3, 1, 'uploads/merchant/27401504256109.jpg');
INSERT INTO `ya_merchant_img` VALUES (4, 1, 'uploads/merchant/16711504256553.jpg');
INSERT INTO `ya_merchant_img` VALUES (5, 4, 'uploads/merchant/64721504688371.jpg');
INSERT INTO `ya_merchant_img` VALUES (6, 3, 'uploads/merchant/92321505102253.jpg');
INSERT INTO `ya_merchant_img` VALUES (7, 3, 'uploads/merchant/72941505102253.jpg');
COMMIT;

-- ----------------------------
-- Table structure for ya_message_code
-- ----------------------------
DROP TABLE IF EXISTS `ya_message_code`;
CREATE TABLE `ya_message_code` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `phone` varchar(50) NOT NULL COMMENT '手机号',
  `code` varchar(50) NOT NULL COMMENT '验证码',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '使用状态 0:未使用 1:已使用',
  `created_at` int(11) NOT NULL COMMENT '创建时间',
  `updated_at` int(11) DEFAULT '0' COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='短信验证码表';

-- ----------------------------
-- Table structure for ya_migration
-- ----------------------------
DROP TABLE IF EXISTS `ya_migration`;
CREATE TABLE `ya_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_migration
-- ----------------------------
BEGIN;
INSERT INTO `ya_migration` VALUES ('m000000_000000_base', 1504163125);
INSERT INTO `ya_migration` VALUES ('m140602_111327_create_menu_table', 1504163130);
INSERT INTO `ya_migration` VALUES ('m160312_050000_create_user', 1504163130);
INSERT INTO `ya_migration` VALUES ('m140506_102106_rbac_init', 1504163199);
COMMIT;

-- ----------------------------
-- Table structure for ya_order
-- ----------------------------
DROP TABLE IF EXISTS `ya_order`;
CREATE TABLE `ya_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单',
  `order_number` varchar(100) DEFAULT NULL COMMENT '订单号',
  `activity_name` varchar(20) DEFAULT NULL COMMENT '活动名字',
  `merchant_name` varchar(20) DEFAULT NULL COMMENT '商家名',
  `order_name` varchar(20) DEFAULT NULL COMMENT '下单人',
  `order_num` int(3) DEFAULT NULL COMMENT '订单数量',
  `order_checking` int(3) DEFAULT NULL COMMENT '验证票数量',
  `phone` int(11) DEFAULT NULL COMMENT '电话',
  `sell_all` int(11) DEFAULT NULL COMMENT '售卖总额',
  `clearing_all` int(11) DEFAULT NULL COMMENT '结算总额',
  `sell_all_checking` int(11) DEFAULT NULL COMMENT '已验票售卖总额',
  `clearing_all_checking` int(11) DEFAULT NULL COMMENT '已验票结算总额',
  `order_time` int(14) DEFAULT NULL COMMENT '下单时间',
  `status` int(3) DEFAULT NULL COMMENT '状态:  0:待支付  1:已支付   2:退款  3:退款通过  4:退款拒绝',
  `activity_id` int(4) DEFAULT NULL COMMENT '活动ID',
  `user_id` int(3) DEFAULT NULL COMMENT '用户ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_order
-- ----------------------------
BEGIN;
INSERT INTO `ya_order` VALUES (1, 'akjshkg', '王者活动', '成都宝宝', '琪琪', 100, 99, 1321989098, 5000, 500, 333, 333, 1504515598, 0, 1, 1);
INSERT INTO `ya_order` VALUES (2, 'LKJKG', '好的', '成都宝宝', '成都宝宝', 121, 12, 12, 12, 12, 12, 23, 1504515598, 1, 1, 1);
INSERT INTO `ya_order` VALUES (3, 'safsf', '爽肤水', '是否', '爽肤水', 11, 11, 1321989098, 344, 23, 23, 23, 1504515598, 0, 2, 1);
INSERT INTO `ya_order` VALUES (4, 'safsf', '是否', '舒服舒服', '舒服舒服', 12, 12, 1321989098, 12, 12, 12, 12, 1504515598, 1, 1, 1);
COMMIT;

-- ----------------------------
-- Table structure for ya_order_refund
-- ----------------------------
DROP TABLE IF EXISTS `ya_order_refund`;
CREATE TABLE `ya_order_refund` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '退款表',
  `order_id` int(3) DEFAULT NULL COMMENT '订单ID',
  `money` int(11) DEFAULT NULL COMMENT '退款金额',
  `pass_reason` varchar(255) DEFAULT NULL COMMENT '退款原因',
  `no_reason` varchar(255) DEFAULT NULL COMMENT '拒绝原因',
  `bank_card` char(20) DEFAULT NULL COMMENT '银行卡',
  `opening_bank` varchar(20) DEFAULT NULL COMMENT '开户行',
  `opening_man` varchar(20) DEFAULT NULL COMMENT '开户人',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_order_refund
-- ----------------------------
BEGIN;
INSERT INTO `ya_order_refund` VALUES (2, 1, 2000, '我不想去了', '我不同意的', '62121212321121', '中国工商', '刘玉', NULL, 1504580056);
INSERT INTO `ya_order_refund` VALUES (3, 2, 2000, '我不想去了', NULL, '62121212321121', '中国工商', '刘玉', 1504519941, 1504580164);
COMMIT;

-- ----------------------------
-- Table structure for ya_salesman
-- ----------------------------
DROP TABLE IF EXISTS `ya_salesman`;
CREATE TABLE `ya_salesman` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '业务员',
  `name` varchar(20) DEFAULT NULL COMMENT '业务员名字',
  `job_number` varchar(30) DEFAULT NULL COMMENT '员工号',
  `phone` varchar(14) DEFAULT NULL COMMENT '手机号',
  `created_at` int(11) DEFAULT NULL,
  `bound_merchant` int(20) DEFAULT NULL COMMENT '绑定商户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_salesman
-- ----------------------------
BEGIN;
INSERT INTO `ya_salesman` VALUES (8, '琪琪', '121fhjk', '13219', 2017, 5);
INSERT INTO `ya_salesman` VALUES (9, '张伟', 'aksfj121', '13219890983', 1504169232, 5);
COMMIT;

-- ----------------------------
-- Table structure for ya_wechat_user
-- ----------------------------
DROP TABLE IF EXISTS `ya_wechat_user`;
CREATE TABLE `ya_wechat_user` (
  `id` int(11) NOT NULL,
  `openid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nickname` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '微信昵称',
  `sex` tinyint(4) NOT NULL COMMENT '性别',
  `headimgurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '头像',
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '国家',
  `province` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '省份',
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL COMMENT '城市',
  `access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `refresh_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;
