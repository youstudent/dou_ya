/*
Navicat MySQL Data Transfer

Source Server         : 豆芽线上
Source Server Version : 50554
Source Host           : 120.27.211.32:3306
Source Database       : douya_market

Target Server Type    : MYSQL
Target Server Version : 50554
File Encoding         : 65001

Date: 2017-09-24 17:47:54
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_activity
-- ----------------------------
INSERT INTO `ya_activity` VALUES ('1', '成都旅游公司', '春熙路三日游', '/upload/activity/74991506224194.jpg', '成都市春熙路', '1506312000', '1506823200', '1507435200', '13219890986', '春熙', '5', '1000', '<p style=\"margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal; text-align: center;\">　9月21日，中国标准动车组“复兴号”正式运营，高铁重回350公里/时，速度再次领跑全世界。</p><p style=\"margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal; text-align: center;\">　　特别强调“重回”，是因为早在2011年，中国已经有包括京津、武广在内的5条高铁按照350公里/时速度运营。</p><p style=\"margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal; text-align: center;\">　　也就是说，高铁这次提速只是回到以前的最高时速。</p><p style=\"margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal; text-align: center;\">　　以2011年为节点，此后的6年时间，速度之外的安全、舒适成为高铁关注的重点。</p><p style=\"margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal; text-align: center;\">　　包括此次“复兴号”的正式运营，对乘客旅行舒适度做了进一步提升。无线WiFi全覆盖，新增USB充电插头，更具人性化的座椅设计等，不一而足。</p><p style=\"margin-top: 15px; margin-bottom: 15px; padding: 0px; line-height: 2em; font-family: &quot;Microsoft YaHei&quot;, u5FAEu8F6Fu96C5u9ED1, Arial, SimSun, u5B8Bu4F53; white-space: normal; text-align: center;\">　　那么，从350公里时速到300公里，再到回归350公里，中国高铁发生了什么？</p><p style=\"text-align: center;\"><img src=\"http://img.douyajishi.com/upload/activity/1506224124537911.jpg\" title=\"1506224124537911.jpg\" alt=\"timg (1).jpg\"/></p>', '1506224194', '1', '600', '560', '1', '32', '1');
INSERT INTO `ya_activity` VALUES ('2', '成都旅游公司', '历史数据', '/upload/activity/38561506236895.jpg', '成都市环球中心', '1506283200', '1506700800', '1507865400', '13219890986', '11212', null, '5', '<p>这是测试的</p>', '1506235754', '1', '6000', '5400', '0', '46', '1');

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
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_activity_data
-- ----------------------------
INSERT INTO `ya_activity_data` VALUES ('1', '1', '3', '1', '2', '600', '560', '300', '280', '春熙路三日游', '成都旅游公司', '1506224194');
INSERT INTO `ya_activity_data` VALUES ('2', '2', '3', '4', '3', '6000', '5400', '3000', '2700', '历史数据', '成都旅游公司', '1506235754');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_activity_ticket
-- ----------------------------
INSERT INTO `ya_activity_ticket` VALUES ('7', '1', '100', '90', '10', '儿童票');
INSERT INTO `ya_activity_ticket` VALUES ('8', '2', '1000', '900', '10', '优惠票');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ya_admin
-- ----------------------------
INSERT INTO `ya_admin` VALUES ('7', 'angke', '', '$2y$13$.scVoyRPgKFOr6lkdvEbueQ9ojhQTP0n7SrSwUdMRIpZjFny7HWWa', null, '', '1', '1506079823', '1506245070', '13219890986', '1212', '1212', null);
INSERT INTO `ya_admin` VALUES ('10', '财务员', '', '$2y$13$PTjRbiPNoxF6c.ge7GCx.uedEUOA9EVkgij6UMVUB1jJ4rweS12b2', null, '', '1', '1506245133', '1506245133', '13219890981', '112', '1212', null);

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
-- Records of ya_auth_assignment
-- ----------------------------
INSERT INTO `ya_auth_assignment` VALUES ('管理员', '7', '1506081159');
INSERT INTO `ya_auth_assignment` VALUES ('财务员', '10', '1506245140');
INSERT INTO `ya_auth_assignment` VALUES ('财务员', '8', '1506149634');
INSERT INTO `ya_auth_assignment` VALUES ('财务员', '9', '1506241835');

-- ----------------------------
-- Table structure for ya_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `ya_auth_item`;
CREATE TABLE `ya_auth_item` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
-- Records of ya_auth_item
-- ----------------------------
INSERT INTO `ya_auth_item` VALUES ('\'/order', '2', null, null, null, '1506174914', '1506174914');
INSERT INTO `ya_auth_item` VALUES ('\'/order/paid-index\',\'Order\'=>[\'status\'=>[1,4]', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/\'/activity/index\'', '2', null, null, null, '1506234172', '1506234172');
INSERT INTO `ya_auth_item` VALUES ('/\'/order/paid-index\'', '2', null, null, null, '1506174800', '1506174800');
INSERT INTO `ya_auth_item` VALUES ('/\'Activity\'=>[\'id\'=>1', '2', null, null, null, '1506234172', '1506234172');
INSERT INTO `ya_auth_item` VALUES ('/\'merchant_id\'=>\'\']', '2', null, null, null, '1506234172', '1506234172');
INSERT INTO `ya_auth_item` VALUES ('/activity-data/*', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/activity-data/create', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/activity-data/delete', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/activity-data/index', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/activity-data/update', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/activity-data/view', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/activity/*', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/activity/create', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/activity/delete', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/activity/history', '2', null, null, null, '1506235612', '1506235612');
INSERT INTO `ya_auth_item` VALUES ('/activity/index', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/activity/index?Activity%5Bid%5D=1', '2', null, null, null, '1506147902', '1506147902');
INSERT INTO `ya_auth_item` VALUES ('/activity/index?Activity%5Bid%5D=1?Activity%255Bmerchant_id%255D=', '2', null, null, null, '1506235012', '1506235012');
INSERT INTO `ya_auth_item` VALUES ('/activity/index?Activity%5Bid%5D=1&Activity%5Bmerchant_id%5D=', '2', null, 'route_rule', 0x613A313A7B733A363A22706172616D73223B613A313A7B733A32353A2241637469766974792535426D65726368616E745F6964253544223B733A303A22223B7D7D, '1506147902', '1506147902');
INSERT INTO `ya_auth_item` VALUES ('/activity/open', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/activity/stop', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/activity/ticket', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/activity/update', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/activity/upload', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/activity/validate-form', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/activity/view', '2', null, null, null, '1506081002', '1506081002');
INSERT INTO `ya_auth_item` VALUES ('/admin/*', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/admin/assignment/*', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/assignment/assign', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/assignment/index', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/assignment/revoke', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/assignment/view', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/default/*', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/default/index', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/logout', '2', null, null, null, '1506149978', '1506149978');
INSERT INTO `ya_auth_item` VALUES ('/admin/menu/*', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/menu/create', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/menu/delete', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/menu/index', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/menu/update', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/menu/view', '2', null, null, null, '1506146100', '1506146100');
INSERT INTO `ya_auth_item` VALUES ('/admin/permission/*', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/permission/assign', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/permission/create', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/permission/delete', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/permission/index', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/permission/remove', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/permission/update', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/permission/view', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/role/*', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/role/assign', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/role/create', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/role/delete', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/role/index', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/role/remove', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/role/update', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/role/view', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/route/*', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/route/assign', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/route/create', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/route/index', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/route/refresh', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/route/remove', '2', null, null, null, '1506146101', '1506146101');
INSERT INTO `ya_auth_item` VALUES ('/admin/rule/*', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/rule/create', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/rule/delete', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/rule/index', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/rule/update', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/rule/view', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/*', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/activate', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/change-password', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/create', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/delete', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/index', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/login', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/logout', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/request-password-reset', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/reset-password', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/signup', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/update', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/admin/user/view', '2', null, null, null, '1506146102', '1506146102');
INSERT INTO `ya_auth_item` VALUES ('/banner/*', '2', null, null, null, '1506080963', '1506080963');
INSERT INTO `ya_auth_item` VALUES ('/banner/create', '2', null, null, null, '1506080962', '1506080962');
INSERT INTO `ya_auth_item` VALUES ('/banner/del', '2', null, null, null, '1506080963', '1506080963');
INSERT INTO `ya_auth_item` VALUES ('/banner/delete', '2', null, null, null, '1506080962', '1506080962');
INSERT INTO `ya_auth_item` VALUES ('/banner/index', '2', null, null, null, '1506080956', '1506080956');
INSERT INTO `ya_auth_item` VALUES ('/banner/update', '2', null, null, null, '1506080962', '1506080962');
INSERT INTO `ya_auth_item` VALUES ('/banner/view', '2', null, null, null, '1506080986', '1506080986');
INSERT INTO `ya_auth_item` VALUES ('/count/*', '2', null, null, null, '1506072024', '1506072024');
INSERT INTO `ya_auth_item` VALUES ('/count/index', '2', null, null, null, '1506072027', '1506072027');
INSERT INTO `ya_auth_item` VALUES ('/debug/*', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/debug/default/*', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/debug/default/db-explain', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/debug/default/download-mail', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/debug/default/index', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/debug/default/toolbar', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/debug/default/view', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/debug/user/*', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/debug/user/reset-identity', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/debug/user/set-identity', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/gii/*', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/gii/default/*', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/gii/default/action', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/gii/default/diff', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/gii/default/index', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/gii/default/preview', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/gii/default/view', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/member/*', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/member/create', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/member/delete', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/member/index', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/member/open', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/member/stop', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/member/update', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/member/view', '2', null, null, null, '1506081037', '1506081037');
INSERT INTO `ya_auth_item` VALUES ('/merchant/*', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/merchant/create', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/merchant/del', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/merchant/delete', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/merchant/index', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/merchant/update', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/merchant/view', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/order/*', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/order/create', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/order/delete', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/order/excel', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/order/get-details', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/order/paid-index', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/order/paid-index?Order%5Bstatus%5D%5B0%5D=1', '2', null, null, null, '1506148456', '1506148456');
INSERT INTO `ya_auth_item` VALUES ('/order/paid-index?Order%5Bstatus%5D%5B0%5D=1?Order%255Bstatus%25', '2', null, null, null, '1506174261', '1506174261');
INSERT INTO `ya_auth_item` VALUES ('/order/paid-index?Order%5Bstatus%5D%5B0%5D=1&Order%5Bstatus%5D%5', '2', null, 'route_rule', 0x613A313A7B733A363A22706172616D73223B613A313A7B733A32343A224F7264657225354273746174757325354425354231253544223B733A313A2234223B7D7D, '1506148456', '1506148456');
INSERT INTO `ya_auth_item` VALUES ('/order/unpaid-index', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/order/unpaid-index?Order%5Bstatus%5D=0', '2', null, null, null, '1506148471', '1506148471');
INSERT INTO `ya_auth_item` VALUES ('/order/update', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/order/view', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/refund-order/*', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/refund-order/get-details', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/refund-order/get-pass', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/refund-order/paid-index', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/refund-order/paid-index?Order%5Bstatus%5D=2', '2', null, null, null, '1506148500', '1506148500');
INSERT INTO `ya_auth_item` VALUES ('/refund-order/un-pass', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/refund-order/unpaid-index', '2', null, null, null, '1506081038', '1506081038');
INSERT INTO `ya_auth_item` VALUES ('/refund-order/unpaid-index?Order%5Bstatus%5D%5B0%5D=3', '2', null, null, null, '1506148526', '1506148526');
INSERT INTO `ya_auth_item` VALUES ('/refund-order/unpaid-index?Order%5Bstatus%5D%5B0%5D=3&Order%5Bst', '2', null, 'route_rule', 0x613A313A7B733A363A22706172616D73223B613A313A7B733A32343A224F7264657225354273746174757325354425354231253544223B733A313A2234223B7D7D, '1506148526', '1506148526');
INSERT INTO `ya_auth_item` VALUES ('/refund-order/update', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/salesman/*', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/salesman/create', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/salesman/delete', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/salesman/index', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/salesman/update', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/salesman/view', '2', null, null, null, '1506081039', '1506081039');
INSERT INTO `ya_auth_item` VALUES ('/site/*', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/activate', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/change-password', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/create', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/delete', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/error', '2', null, null, null, '1506146103', '1506146103');
INSERT INTO `ya_auth_item` VALUES ('/site/index', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/login', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/logout', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/request-password-reset', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/reset-password', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/signup', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/update', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('/site/view', '2', null, null, null, '1506146104', '1506146104');
INSERT INTO `ya_auth_item` VALUES ('管理员', '1', null, null, null, '1506081063', '1506148912');
INSERT INTO `ya_auth_item` VALUES ('财务员', '1', null, null, null, '1506149319', '1506149422');

-- ----------------------------
-- Table structure for ya_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `ya_auth_item_child`;
CREATE TABLE `ya_auth_item_child` (
  `parent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `ya_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `ya_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ya_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `ya_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of ya_auth_item_child
-- ----------------------------
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '\'/order/paid-index\',\'Order\'=>[\'status\'=>[1,4]');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity-data/*');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity-data/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity-data/create');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity-data/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity-data/delete');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity-data/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity-data/index');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity-data/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity-data/update');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity-data/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity-data/view');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity-data/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/*');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/create');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/delete');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/index');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/index');
INSERT INTO `ya_auth_item_child` VALUES ('/activity/index?Activity%5Bid%5D=1&Activity%5Bmerchant_id%5D=', '/activity/index?Activity%5Bid%5D=1');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/index?Activity%5Bid%5D=1');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/index?Activity%5Bid%5D=1');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/index?Activity%5Bid%5D=1&Activity%5Bmerchant_id%5D=');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/index?Activity%5Bid%5D=1&Activity%5Bmerchant_id%5D=');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/open');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/open');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/stop');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/stop');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/ticket');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/ticket');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/update');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/upload');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/upload');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/validate-form');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/validate-form');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/activity/view');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/activity/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/assignment/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/assignment/assign');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/assignment/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/assignment/revoke');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/assignment/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/default/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/default/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/logout');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/menu/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/menu/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/menu/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/menu/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/menu/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/menu/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/permission/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/permission/assign');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/permission/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/permission/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/permission/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/permission/remove');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/permission/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/permission/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/role/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/role/assign');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/role/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/role/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/role/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/role/remove');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/role/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/role/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/route/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/route/assign');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/route/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/route/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/route/refresh');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/route/remove');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/rule/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/rule/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/rule/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/rule/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/rule/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/rule/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/activate');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/change-password');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/index');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/admin/user/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/login');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/logout');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/request-password-reset');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/reset-password');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/signup');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/update');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/admin/user/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/admin/user/view');
INSERT INTO `ya_auth_item_child` VALUES ('财务员', '/admin/user/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/banner/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/banner/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/banner/del');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/banner/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/banner/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/banner/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/banner/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/count/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/count/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/debug/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/debug/default/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/debug/default/db-explain');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/debug/default/download-mail');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/debug/default/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/debug/default/toolbar');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/debug/default/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/debug/user/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/debug/user/reset-identity');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/debug/user/set-identity');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/gii/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/gii/default/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/gii/default/action');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/gii/default/diff');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/gii/default/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/gii/default/preview');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/gii/default/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/member/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/member/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/member/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/member/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/member/open');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/member/stop');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/member/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/member/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/merchant/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/merchant/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/merchant/del');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/merchant/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/merchant/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/merchant/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/merchant/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/excel');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/get-details');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/paid-index');
INSERT INTO `ya_auth_item_child` VALUES ('/order/paid-index?Order%5Bstatus%5D%5B0%5D=1&Order%5Bstatus%5D%5', '/order/paid-index?Order%5Bstatus%5D%5B0%5D=1');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/paid-index?Order%5Bstatus%5D%5B0%5D=1');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/paid-index?Order%5Bstatus%5D%5B0%5D=1&Order%5Bstatus%5D%5');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/unpaid-index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/unpaid-index?Order%5Bstatus%5D=0');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/order/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/refund-order/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/refund-order/get-details');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/refund-order/get-pass');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/refund-order/paid-index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/refund-order/paid-index?Order%5Bstatus%5D=2');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/refund-order/un-pass');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/refund-order/unpaid-index');
INSERT INTO `ya_auth_item_child` VALUES ('/refund-order/unpaid-index?Order%5Bstatus%5D%5B0%5D=3&Order%5Bst', '/refund-order/unpaid-index?Order%5Bstatus%5D%5B0%5D=3');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/refund-order/unpaid-index?Order%5Bstatus%5D%5B0%5D=3');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/refund-order/unpaid-index?Order%5Bstatus%5D%5B0%5D=3&Order%5Bst');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/refund-order/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/salesman/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/salesman/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/salesman/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/salesman/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/salesman/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/salesman/view');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/*');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/activate');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/change-password');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/create');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/delete');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/error');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/index');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/login');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/logout');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/request-password-reset');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/reset-password');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/signup');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/update');
INSERT INTO `ya_auth_item_child` VALUES ('管理员', '/site/view');

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
-- Records of ya_auth_rule
-- ----------------------------
INSERT INTO `ya_auth_rule` VALUES ('route_rule', 0x4F3A33303A226D646D5C61646D696E5C636F6D706F6E656E74735C526F75746552756C65223A333A7B733A343A226E616D65223B733A31303A22726F7574655F72756C65223B733A393A22637265617465644174223B693A313530363134373930323B733A393A22757064617465644174223B693A313530363134373930323B7D, '1506147902', '1506147902');

-- ----------------------------
-- Table structure for ya_banner
-- ----------------------------
DROP TABLE IF EXISTS `ya_banner`;
CREATE TABLE `ya_banner` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'banner管理',
  `title` varchar(20) DEFAULT NULL COMMENT '标题',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_banner
-- ----------------------------
INSERT INTO `ya_banner` VALUES ('29', 'da阿达的', '1506068744');

-- ----------------------------
-- Table structure for ya_banner_img
-- ----------------------------
DROP TABLE IF EXISTS `ya_banner_img`;
CREATE TABLE `ya_banner_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'banner图片',
  `img` varchar(255) DEFAULT NULL,
  `banner_id` int(2) DEFAULT NULL COMMENT 'banner_id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_banner_img
-- ----------------------------
INSERT INTO `ya_banner_img` VALUES ('21', 'uploads/banner/57281504750622.jpg', '8');
INSERT INTO `ya_banner_img` VALUES ('23', '/uploads/banner/31831505299962.jpg', '24');
INSERT INTO `ya_banner_img` VALUES ('24', '/uploads/banner/37491505300557.jpg', '25');
INSERT INTO `ya_banner_img` VALUES ('26', 'uploads/banner/59031505355089.jpg', '26');
INSERT INTO `ya_banner_img` VALUES ('27', '/uploads/banner/42051505355706.jpg', '27');
INSERT INTO `ya_banner_img` VALUES ('43', '/upload/banner/19341506224253.jpg', '29');
INSERT INTO `ya_banner_img` VALUES ('44', '/upload/banner/66551506224253.jpg', '29');
INSERT INTO `ya_banner_img` VALUES ('45', '/upload/banner/20131506224253.jpg', '29');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_collect_activity
-- ----------------------------
INSERT INTO `ya_collect_activity` VALUES ('2', '27', '1', '1506240376');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_collect_merchant
-- ----------------------------
INSERT INTO `ya_collect_merchant` VALUES ('3', '27', '1', '1506240412');

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
-- Records of ya_contract
-- ----------------------------

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_count
-- ----------------------------
INSERT INTO `ya_count` VALUES ('1', '1', '7', '1506221613');
INSERT INTO `ya_count` VALUES ('2', '1', '7', '1506222019');
INSERT INTO `ya_count` VALUES ('3', '1', '7', '1506222264');
INSERT INTO `ya_count` VALUES ('4', '1', '7', '1506223451');
INSERT INTO `ya_count` VALUES ('5', '1', '7', '1506223856');
INSERT INTO `ya_count` VALUES ('6', '1', '2', '1506224194');
INSERT INTO `ya_count` VALUES ('7', '1', '2', '1506235755');
INSERT INTO `ya_count` VALUES ('8', '1', '1', '1506236922');
INSERT INTO `ya_count` VALUES ('9', '300', '3', '1506236922');
INSERT INTO `ya_count` VALUES ('10', '280', '4', '1506236922');
INSERT INTO `ya_count` VALUES ('11', '20', '5', '1506236922');
INSERT INTO `ya_count` VALUES ('12', '1', '1', '1506237159');
INSERT INTO `ya_count` VALUES ('13', '100', '3', '1506237159');
INSERT INTO `ya_count` VALUES ('14', '90', '4', '1506237159');
INSERT INTO `ya_count` VALUES ('15', '10', '5', '1506237159');
INSERT INTO `ya_count` VALUES ('16', '1', '1', '1506238245');
INSERT INTO `ya_count` VALUES ('17', '200', '3', '1506238246');
INSERT INTO `ya_count` VALUES ('18', '190', '4', '1506238246');
INSERT INTO `ya_count` VALUES ('19', '10', '5', '1506238246');
INSERT INTO `ya_count` VALUES ('20', '1', '1', '1506238480');
INSERT INTO `ya_count` VALUES ('21', '1000', '3', '1506238480');
INSERT INTO `ya_count` VALUES ('22', '900', '4', '1506238480');
INSERT INTO `ya_count` VALUES ('23', '100', '5', '1506238480');
INSERT INTO `ya_count` VALUES ('24', '1', '1', '1506238756');
INSERT INTO `ya_count` VALUES ('25', '1000', '3', '1506238756');
INSERT INTO `ya_count` VALUES ('26', '900', '4', '1506238756');
INSERT INTO `ya_count` VALUES ('27', '100', '5', '1506238756');
INSERT INTO `ya_count` VALUES ('28', '1', '1', '1506238774');
INSERT INTO `ya_count` VALUES ('29', '4000', '3', '1506238774');
INSERT INTO `ya_count` VALUES ('30', '3600', '4', '1506238774');
INSERT INTO `ya_count` VALUES ('31', '400', '5', '1506238774');

-- ----------------------------
-- Table structure for ya_member
-- ----------------------------
DROP TABLE IF EXISTS `ya_member`;
CREATE TABLE `ya_member` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户',
  `name` varchar(20) NOT NULL COMMENT '用户名',
  `sex` tinyint(1) DEFAULT NULL COMMENT '用户的性别，值为1时是男性，值为2时是女性，值为0时是未知',
  `phone` varchar(11) DEFAULT NULL COMMENT '电话',
  `last_time` int(11) DEFAULT NULL COMMENT '最后登录时间',
  `status` int(2) DEFAULT NULL COMMENT '状态   1:正常  0:停封',
  `identification` varchar(20) DEFAULT '' COMMENT '证认',
  `order_num` int(10) DEFAULT '0' COMMENT '下单量',
  `order_money` int(10) DEFAULT '0' COMMENT '下单金额',
  `openid` varchar(255) NOT NULL COMMENT '微信openid',
  `headimgurl` varchar(255) NOT NULL COMMENT '微信头像地址',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_member
-- ----------------------------
INSERT INTO `ya_member` VALUES ('1', 'harlen', '2', '', '1506242110', '1', '', null, null, 'orDOGwT-0MguFxydmGnLRF7A7RYc', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqKUBwnzCnRg1lML1NiafjHtQv2xeSzatrc1cHeLsCHpapus6WTScicPLXPfon57tQh2U5SLaA4JiaAQ/0', null);
INSERT INTO `ya_member` VALUES ('5', '国王不在家', '1', '13161672102', '1506160430', '1', '', '2', '5000', 'orDOGwTyCrSpZVWVwp3hEUR0k3bI', 'http://wx.qlogo.cn/mmopen/vi_32/QaavNCABGFby2iczdmYzGicegtEC8pP09qIBOjEMAGPndicwOmtUv8XXBWuMSrMiax2R4M38VgzPNU7MaGXUo22phw/0', null);
INSERT INTO `ya_member` VALUES ('6', '北北', '2', '', null, '1', '', null, null, 'orDOGwVrk_k3XM5yAjy0-7qUdJjE', 'http://wx.qlogo.cn/mmopen/vi_32/lsYr43Q7micmOzgHqgE0M4X1eqCzUHY56942uorjX0U4NC8Tv6MmLOtWhnvtbOXliacZsnk7f6ePGOFZfq1EAibrw/0', null);
INSERT INTO `ya_member` VALUES ('7', '极客侠', '1', '', '1506072038', '1', '', null, null, 'orDOGwZ9_F3ZNRKA7J91xD3Cm9L0', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJzmBzIeVHkjn7Zm90rJZ6lfs5IoIzArpyOl4CibKRWiczkwKo3hAIk0h7RDDTpYlndHibvmEw8JKJbw/0', null);
INSERT INTO `ya_member` VALUES ('8', '小牛', '2', '', null, '1', '', null, null, 'orDOGwavmmTCScsbAxEXdukxl0j4', 'http://wx.qlogo.cn/mmopen/vi_32/YSv4tFLeia3CPtMJPMaN9qcrjERfvlcCy6Urx2Atfl2MzuQg1S0hD7dWdabia3TviaXxrwlZPV2ib9VG1zCA3jtXrQ/0', null);
INSERT INTO `ya_member` VALUES ('9', '小豆芽  up up up', '2', '', '1506161003', '1', '', null, null, 'orDOGwf_K-NpnPrYMYHRq6GwfQ84', 'http://wx.qlogo.cn/mmopen/vi_32/lgups8Cib4dK0Pz4msN524LqQYElvVqdqytKv1tsN2ibTuvZGFA5TDPtRT4FSldomQ3ygibLTYDAzwtnEbp5ibDkhQ/0', null);
INSERT INTO `ya_member` VALUES ('10', 'Z', '2', '', '1506061354', '1', '', null, null, 'orDOGwZ2ZKvYtA5GPxAc9nXbDh4Y', 'http://wx.qlogo.cn/mmopen/vi_32/HjqREdn1mIjA0fLvjjqmORH9wwV9v8PnDPPeaZaibYbz7mChYW8K54mpVwWFBctD0Z57ibcBiakW81obPvRrpy5BQ/0', null);
INSERT INTO `ya_member` VALUES ('11', '卷卷卷卷卷', '1', '', '1506177707', '1', '', null, null, 'orDOGwYRKPmWdcvN9tz8o0KHuFaU', 'http://wx.qlogo.cn/mmopen/vi_32/zBZticicTY3TNMqe4YLic9Z5edM8HsUZntCiap2QXLnic5DIqPQaecQHM8j5ZUanS7YvjpicuNQIMpeoFJnmWK13yjRA/0', null);
INSERT INTO `ya_member` VALUES ('12', '', '1', '', '1505971217', '1', '', null, null, 'orDOGwSfXPnynDGIOzdL6ApbCi_k', 'http://wx.qlogo.cn/mmopen/vi_32/5ohh435JVSzo83yY1myBvr5NdejWmMWDzXqxDmWly8u6o8JvCnCaPoC6rqVgbImaqnj2VoISdwTBz3t0m0wooA/0', null);
INSERT INTO `ya_member` VALUES ('13', '一只耳', '1', '', '1506240010', '1', '', null, null, 'orDOGwbB0pA7abKlnoQ3-0tF8v2s', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLgZE8OzgcoNXvKhzjEBlkjyk3XyfcqMUvnamFIgyNRpWE7EsXomkkgHxRqv2rsQKOHV7rjLMGI3Q/0', null);
INSERT INTO `ya_member` VALUES ('14', '从前 现在 将来 缘起 蜜糖罐 碑文', '1', '', '1505888591', '1', '', null, null, 'orDOGwRVSknUQVkaUbh1pcaT34No', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTLic3bZdAZoy154MerLSSqeSrApTdRcE5UVL0rKeAPpXKL4OLMnafh5iaxObhBFKyhW4edMjFK9UDGg/0', null);
INSERT INTO `ya_member` VALUES ('15', 'changer', '1', '', '1506241613', '1', '', null, null, 'orDOGwbmiDBJuqMwOEv0NJt1Y0VY', 'http://wx.qlogo.cn/mmopen/vi_32/PiajxSqBRaEJOicAkB9ZZ6nzf73IDic8HoM4JwT9ghGmNO4lKgnwwBcCU2waI1ROx0KibZF7TFdicXJLTM8RrZU7icxw/0', null);
INSERT INTO `ya_member` VALUES ('16', 'W-软件开发', '1', '', '1505961707', '1', '', null, null, 'orDOGwVS1WqppQkGesKjW2sD3tdQ', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIQLQs6mgjqfG9XSQ0YXicaZU1NTtfoV7CIdI9PfBdVcwmica4ZtpXu6KppHVHuej7CoVIO9RF78LQw/0', null);
INSERT INTO `ya_member` VALUES ('17', '白色风车', '1', '', '1505961721', '1', '', null, null, 'orDOGwdrjyJI2WHEhrXtBmBm8wJs', 'http://wx.qlogo.cn/mmopen/vi_32/mJYicLxIRVRkuzKOVIiaRbLRlV4ibSdicviazdPEHfRkcBKPib4z4fnF8P5UzehOGr4MKljtCKKfqVauUaJ33rKrfang/0', null);
INSERT INTO `ya_member` VALUES ('18', '无伤有泪', '1', '', '1505961761', '1', '', null, null, 'orDOGwWPNwjguUFzblZ713T8x_VE', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoXibk4hrciboz5R147DCsKh2Fs3fFVr2D4PNWPkXdiaFUauia5uZvguXiaTd4pVlcVTtdFMrlOQUibSYrw/0', null);
INSERT INTO `ya_member` VALUES ('19', '', '2', '', '1505961713', '1', '', null, null, 'orDOGwa2eYRXtw5YM_nYQJ47BzrU', 'http://wx.qlogo.cn/mmopen/vi_32/IWbwF1cLYNYQpRg73NxDpXLXNk2lFMDAPkdWvwg0yT8hrZMqM1JlV7DkV2OMXJGQXOBD0VytJmV3jqL1vqPI3g/0', null);
INSERT INTO `ya_member` VALUES ('20', '文叔叔', '1', '', '1506050032', '1', '', null, null, 'orDOGwW2386xgCT0wC73du_naln4', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erVrJntmXRqoJUsQ9Pn6o4IkRTANOianvSYNzy1PGTx80aDNCM5oKglOBAI1FBu2diaohossIjmWUSw/0', '1506050032');
INSERT INTO `ya_member` VALUES ('21', '陈家yufan', '1', '', '1505961780', '1', '', null, null, 'orDOGwQf99r7rs8JzQLrfhb74wYA', 'http://wx.qlogo.cn/mmopen/vi_32/8qV22vZe0YLA66FLouHH8fptcCjeCs2tVVNupjgM8lgKicKVJkDcq9o1fxYEWUYRO8l8QKfZVobdMPcMjEibf7bw/0', null);
INSERT INTO `ya_member` VALUES ('22', '王萍', '2', '', '1505961899', '1', '', null, null, 'orDOGwfSKcHYKXlAd3xWx9C_Q650', 'http://wx.qlogo.cn/mmopen/vi_32/rMWKYZ1QJfLZtSYuVpaIffJhz3wW1YhH1xZ0PcolhVjoW2fpV1D0e1b5CUyK9dCI4ickIRmpZORa1jBbLKkwNjA/0', null);
INSERT INTO `ya_member` VALUES ('23', '刘同学', '2', '', '1505962000', '1', '', null, null, 'orDOGwYTL5GhTOTIEEyOOWBbj4Do', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIBu5ics2ZWCmRvVJiced5UCy467ibeaichslyCZGUkSz8zmgWnWuXPibJpXGia2s4O2ohBiaoQO4O4bR3mw/0', null);
INSERT INTO `ya_member` VALUES ('24', '马蛋', '1', '', '1506240397', '1', '', null, null, 'orDOGwbnJ9R0fUUjRlhaqZpSRtGA', 'http://wx.qlogo.cn/mmopen/vi_32/Gye08kuhuDXfqrdhvyg1CMM3uKLRx7zn3U2EP3M8aeIbJS6Rj7V4O32pU94NjWRxIgtI2rLscTJT19EwNVeCUw/0', null);
INSERT INTO `ya_member` VALUES ('25', '寒', '1', '', '1505962240', '1', '', null, null, 'orDOGwRq33BxyVKquD4u-kAXAKNI', 'http://wx.qlogo.cn/mmopen/vi_32/2xbxuIEGp4UavZPSUX49KsWmI68fEYoVgsrhAIbk3yPID9BuphvFkObVKm3phyZQC7P3ClUTW8UZkxejlwl1VQ/0', null);
INSERT INTO `ya_member` VALUES ('26', 'SilverFox', '1', '', '1505962648', '1', '', null, null, 'orDOGwWeJ40dLMViCe0YCRSv_gOM', 'http://wx.qlogo.cn/mmopen/vi_32/hrVibbJDIsEFysic1Asw3koqHbhibw1ukDxEF0TX16ib3AZNTXl48wZECRdciaQxBurxKuVbic0iagUANxycV3UBR0rxA/0', null);
INSERT INTO `ya_member` VALUES ('27', '昂恪', '2', '13308025470', '1506239998', '0', '', null, null, 'orDOGwRy1AAl5jG0Nvgj-X516UiM', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIomtwvLMW9m8V1KFeGYCvQrqmox6Arhd5jqYbMHWAxMZkm4xrgOHibxRJm4jkByGxNeGAiauQ6Biavg/0', null);
INSERT INTO `ya_member` VALUES ('28', 'x', '2', '', '1506241620', '1', '', null, null, 'orDOGwRTCLSd33obiC33gzMXcPMU', 'http://wx.qlogo.cn/mmopen/vi_32/S1c0wWsL7ZHficS5Zd2hzejLaSfNn3kVh1zYbwewBK1UUiclykqeXKPAukYPMjLaC0OI9HbOV9JbusmGGic095sqg/0', null);
INSERT INTO `ya_member` VALUES ('29', '安吉', '2', '13308025470', '1506064700', '1', '', null, null, 'orDOGwf0chvH-tN8LoeSboYmAEA0', 'http://wx.qlogo.cn/mmopen/vi_32/G5YX3siaDK8Ib2oIeTTbF7wla2M07uic0C0VDGFv4kDeibd9IdiaJjU3t5qZIvH5SicK8FudRMnXlepxRDRUEtmg2icA/0', null);
INSERT INTO `ya_member` VALUES ('30', '行走的f-type', '1', '', '1506077442', '1', '', null, null, 'orDOGwXQ9j7XAXoXdvsqyuAIPvy0', 'http://wx.qlogo.cn/mmopen/vi_32/BMIbkgGXMEwLPdLdygkHkicDbJaibrU75E1mRx3ic1G5p9Q49jbZWp3wHImR5y7puZQYibNhtZJjGkSASdJQY531dQ/0', null);
INSERT INTO `ya_member` VALUES ('31', '巴山背二哥', '1', '', '1505970305', '1', '', null, null, 'orDOGwRypobuGo2fxX6Gk3IvOong', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTIqVlO9tyKnTV0OLygFqHKtaZ1fTn0jpDT4lVpxEAfHX5GSCREs3LXZiaOeG7pfkwdeeciaQW7BOpicw/0', null);
INSERT INTO `ya_member` VALUES ('32', 'future', '2', '', '1505971187', '1', '', null, null, 'orDOGwcz6PhNAms_zLkoSmtm5ewo', 'http://wx.qlogo.cn/mmopen/vi_32/AhaSicobIfA85ZUYjOZ26AVuQ4lRm3jnm22Ofq6PbbtV6FkgkpCntVRg4epahhO8r5neUlHcDSt1M3uicTFdyy4g/0', null);
INSERT INTO `ya_member` VALUES ('33', '张有竹-豆芽集市', '1', '17323005223', '1506068656', '1', '', null, null, 'orDOGwQ_2pntOTCwa12EEUpBWBRo', 'http://wx.qlogo.cn/mmopen/vi_32/aeLuIDof1ykglnhU2QcXrexnKNzsl7iaKg2w1iayQXs09pmtOiaEPhT6YjLvhEib1iaDxeqH4D0En6wFsJEHr4WxeqQ/0', null);
INSERT INTO `ya_member` VALUES ('34', '都不知道取什么昵称了就叫这个吧', '0', '', '1505973123', '1', '', null, null, 'orDOGwV05PtymkIVYzqVSsAJwi90', 'http://wx.qlogo.cn/mmopen/vi_32/nVMLr1AgPVPqCvgGl1CbPvTHFMfUmxVsrTK6VIU9sIFDaneJ2CLWicp06GSXicz6MPIDoic5ZPLdBUudo71haeMMA/0', null);
INSERT INTO `ya_member` VALUES ('35', '野草', '1', '', '1505974087', '1', '', null, null, 'orDOGwa0hG8zk_65nSbh91bCL6Sk', 'http://wx.qlogo.cn/mmopen/vi_32/y3j1nEibHvd2NbPU2QZvpVhskGLuCUbSPbsFDvRx0QGlLqyr4Lup4DuInFE1VL9emRtribJrD26OsmXlrqxmOibyA/0', null);
INSERT INTO `ya_member` VALUES ('36', '井', '2', '', '1506083470', '1', '', null, null, 'orDOGwVex3ycJoEn2OkyOjcs51JM', 'http://wx.qlogo.cn/mmopen/vi_32/xwnCgMrBIRc4KMkpbHmzUJPmt3p7BkkvjvRicHwVmN64aut9IAVzEzds3wjE9LF4Zpbf0bL6iapK8DIJxuyyNVfQ/0', null);
INSERT INTO `ya_member` VALUES ('37', '没药抱抱-有赞、美业', '1', '', '1505978091', '1', '', null, null, 'orDOGwUrUP_D629Nz-cbLyNV_wX0', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erw4OOJHOMlqG5vcI0yJ50GaSV3QbfEMqg5BIRnUutxKYG3uNGVnsVvsUr6tPFeJs8bV4DayzHAlw/0', null);
INSERT INTO `ya_member` VALUES ('38', '美团点评-蒲万桃', '1', '', '1505978970', '1', '', null, null, 'orDOGwYvf3QyHgP40T7cdtkQaA40', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKSm11Ky4WG7pGJibJI8slNmEIAOa5UEZ0Uib8be4psyibfSdN6nLeD0nwa7QopXJjC0OhTw4oY3EzFQ/0', null);
INSERT INTO `ya_member` VALUES ('39', '许辉', '1', '', '1505979121', '1', '', null, null, 'orDOGweq5AQiwECGaOOZjnn0rErw', 'http://wx.qlogo.cn/mmopen/vi_32/nPTbUv1t8J8N3Wnuf97trWPCdGc1EaTFVlQl5q4SFoCfAiaiaQ7ABf9hz4wlAe30DPh0JMdJZOVDdKJIicKOgNEUA/0', null);
INSERT INTO `ya_member` VALUES ('40', 'R', '0', '', '1505979430', '1', '', null, null, 'orDOGwUTsTgWK8-AC--zSbBkuAcE', 'http://wx.qlogo.cn/mmopen/vi_32/WhoLIb4HZtsRLZzGU5mesLy8wOOqJgoD3TqdCl4xMleoN8sUzWgIMIzlZCuyoKz0miaWibNgsStzNYJcClJrUh9Q/0', null);
INSERT INTO `ya_member` VALUES ('41', '纵横', '1', '', '1505979815', '1', '', null, null, 'orDOGwejmk9DjTtP7SF4uGj96m5Q', 'http://wx.qlogo.cn/mmopen/vi_32/4XibvEicBiciabmRN6rR6DgZLFo1ttICDpkWt3ksyGzVn24foPib4W7fnQ8xZlibbYibHGZ9yibtRBT81YGXteq3lshMXQ/0', null);
INSERT INTO `ya_member` VALUES ('42', '丹妮', '2', '', '1505980420', '1', '', null, null, 'orDOGwe46yESwe4BYJ0kFAb0zvu4', 'http://wx.qlogo.cn/mmopen/vi_32/EkWcckRDZGPuNs2WSaCygjcQibvYwibvSjicN2fibnf9un0wgyiaVjibzudkj3K13nmQfFQQ9bcQNh8vmXibiblNA4B06A/0', null);
INSERT INTO `ya_member` VALUES ('43', '何丹', '2', '', '1505980549', '1', '', null, null, 'orDOGwbDHAPhR8nxq_rPLE_KFHbo', 'http://wx.qlogo.cn/mmopen/vi_32/4vZOhkPI0g3opccJa9ziaohO1Ed0GRzf2xGnN9vmrxBOmnT7pviaF32DSialzC6OqicF8uEGdghHaEzBUpmAjFjK9w/0', null);
INSERT INTO `ya_member` VALUES ('44', '谢海涛', '1', '', '1505981213', '1', '', null, null, 'orDOGwd_vw0yd1DeVvE7MiQJWykk', 'http://wx.qlogo.cn/mmopen/vi_32/NccicREukbZFK8lGdMWjQ3l9zDwtbj77mhJRghMy6c1ac8JzE87JmBfPicIbwxmWkXZW2w1oePmo4q8jwWEnQmpw/0', null);
INSERT INTO `ya_member` VALUES ('45', '美团点评黄欢', '1', '', '1505981497', '1', '', null, null, 'orDOGwYALA5mmpz7ElerypieOD8w', 'http://wx.qlogo.cn/mmopen/vi_32/L6SG55UJpKSCOd9MaGFsObDplrEYiatm9q6uIiaUZNH7MnWmhnOBYDv9EbZt4ccw4oNuGvT5p2jBVa1OeZX3sEvg/0', null);
INSERT INTO `ya_member` VALUES ('46', '程', '1', '', '1505981601', '1', '', null, null, 'orDOGwY7PZar_3xJUmL63abqqXNM', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK9Yvy5STDw82kvE5UKhWMjibj5uBVwY8PiausoicIZlX3GEyGm7OeQGphOwc5FuTX125LjAx8Lbw3QA/0', null);
INSERT INTO `ya_member` VALUES ('47', '唐涛²⁰¹⁷', '1', '', '1505981622', '1', '', null, null, 'orDOGwUj2SlJH0i-c_HnwvSdxtBk', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83erodJv4qrfPuMibV9iakY5PHUOHXKHF53DIc6RYlZ9SKbOxTbXxRwrq81HeJD2nBwe0GFRvyhWrBgeQ/0', null);
INSERT INTO `ya_member` VALUES ('48', 'A曹贤文', '1', '', '1505981619', '1', '', null, null, 'orDOGwffqp37IDARVwwjkdFeUMB0', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eq3oGeTb2L8USh0mstZBBahtrIeG1Bf7Ke7ID7ymDnHp7uloru8fGeFkrO3Diadianxu76ia1VSiaibFzw/0', null);
INSERT INTO `ya_member` VALUES ('49', 'A陶延明', '1', '', '1505982349', '1', '', null, null, 'orDOGwZSlNrSnVkVwTTPSncQdSZg', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoMLDJ8w6NA5mZBKy9XicK99SmEibMuFUIToHnbZk25LjFBu9K8Pf0PozAwGAc5s9HXVL4EuPkRGjKw/0', null);
INSERT INTO `ya_member` VALUES ('50', '他们都叫我狼头', '1', '', '1505982892', '1', '', null, null, 'orDOGwX449xaUFsQEuNSnhi0c2Tg', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKia8M9F5QjW43rcAjzR8VoNuwU37yZPUT5hzdQ2vmGAGElw9l2Ep3YYWXnFalDMz6CGNPFVricLWDg/0', null);
INSERT INTO `ya_member` VALUES ('51', '小倩✨', '2', '', '1505983205', '1', '', null, null, 'orDOGwbHdtVVSJWe-m_SVUf89Sik', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83epUegpRaQcDDYhdc6Nk7umiaywu68DANWzlWUPl0PZelh2Etu4d5S98XPwltI7Od2DuHRj1gYZRU9w/0', null);
INSERT INTO `ya_member` VALUES ('52', 'A0000zl', '1', '', '1505983495', '1', '', null, null, 'orDOGwUFylxAdV6A3FVfv41G70U8', 'http://wx.qlogo.cn/mmopen/vi_32/ia77MZv3aJIVnsfeUeVTGvg5CZiawEYjwlH5U2XCEuSR2nia3yc16ibLfo4o5Bq0Y5Ny9DzGsUPAbNCBBP8lCricKkQ/0', null);
INSERT INTO `ya_member` VALUES ('53', '窦子发了芽', '1', '', '1505984571', '1', '', null, null, 'orDOGwcuyGmTEFG7FZMpDGoLrcCY', 'http://wx.qlogo.cn/mmopen/vi_32/nGzF8AyO8NNIxjInoL7GwzNyomQsMia1Q6gpTwyax1VY4GdHK5cmeKl2vhiajWleF0bNhgTICtu4AmB2KYtCy2Xw/0', null);
INSERT INTO `ya_member` VALUES ('54', '庸人。自扰之', '1', '', '1505984834', '1', '', null, null, 'orDOGwazmFelizlo73Tby-WW78G8', 'http://wx.qlogo.cn/mmopen/vi_32/Bu5PaCSHYJ0dWw7Om5OckibfSialj16d9Q6nA2KZkl6364sHdYDSXXiaTeuDYP9oYfgiaZGmgicxTPticx6O10fAicN3g/0', null);
INSERT INTO `ya_member` VALUES ('55', '巫淼', '1', '', '1505985579', '1', '', null, null, 'orDOGweEnQNUBwgNs5e3n4Kd3U4Q', 'http://wx.qlogo.cn/mmopen/vi_32/UXHJn1yic5Nepr1VaiatzZyic7ncibGS9Xib0HGoqauW0AXXbqbnn6QkibLp6Vnic6acjP5yscSsClPMkQRsweILoibU3Q/0', null);
INSERT INTO `ya_member` VALUES ('56', '李玉婷', '2', '', '1505985594', '1', '', null, null, 'orDOGwXtfyeCFEcLr12C35-ZNdMA', 'http://wx.qlogo.cn/mmopen/vi_32/kl7A9xpCGSENYw3T2iciaG15KqVW9ia373CXyFGnMzjCyibib8XZ4zFRjNNSSGPLrK7Dsw4rs5MUV5mYIxs1E9bAlpw/0', null);
INSERT INTO `ya_member` VALUES ('57', '南人', '1', '', '1505986266', '1', '', null, null, 'orDOGwa454sl7cWyegKVJiL66CEI', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTKBDjiasHUVDINfx2PEtrVRyicQcnnaiciadCVNLbFDXXYibks3kb5EyN83zcphfNDP7YrxTibhZVpclicBA/0', null);
INSERT INTO `ya_member` VALUES ('58', '张四火', '1', '', '1505986365', '1', '', null, null, 'orDOGwevZzpYbW0wjvaeAiKmrQ5A', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eoG8ib2gglicEViamnEhIp8MgJtcCSpnYLKE45NCuxKlGkO3ZuJ6jl5icoGMfwnnTQiag1icfVsuIGVY67Q/0', null);
INSERT INTO `ya_member` VALUES ('59', '郭志渠', '1', '', '1505986821', '1', '', null, null, 'orDOGwXq-EC0QjsEvVW5Hi8r0iGg', 'http://wx.qlogo.cn/mmopen/vi_32/MNMysxfQHbJVYia1y7WBIvA5oxQU4NBvZDUAtRttSuOsZLDvIbwVvEO6ibJRIWI4AXt9DmfVZunvM6Od1xKYNQjA/0', null);
INSERT INTO `ya_member` VALUES ('60', 'coco', '0', '', '1505987354', '1', '', null, null, 'orDOGwRoo-bQywrtLYO44M3RQr7U', 'http://wx.qlogo.cn/mmopen/vi_32/LmwK3XjRNms5ibPeyr40msicxbDPicCb0zt2CYgQZ3lNuV1R4P2cSibdVJ0EfhsX6upia6yexwD7M0LiaD0C9yS1L3dQ/0', null);
INSERT INTO `ya_member` VALUES ('61', '志文', '2', '', '1505989506', '1', '', '0', '0', 'orDOGwQShkbWXgRxLO4Sm0oA0Azw', 'http://wx.qlogo.cn/mmopen/vi_32/kk6Ug21HLJRvaeibibyBWKcYKoWblHCKMFFqic7NroWBmbZUvFstCVVSDvm4vmmF0RL8zu6S2FoTBFzh67vsH1Kvw/0', null);
INSERT INTO `ya_member` VALUES ('62', '山鲁.佐德', '2', '', '1505996195', '1', '', '0', '0', 'orDOGwSjy4wzSUSfqbOtDZ1u_Oy4', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJmmxsDnKczTIDp9FjA6oviaNokXcBFNP8Ed3PzdmCTSfHzDRwXrn2gc4mPd57icJF3bT7ltj0LB8Rg/0', null);
INSERT INTO `ya_member` VALUES ('63', '追风筝的孩子', '1', '', '1505998198', '1', '', '0', '0', 'orDOGwR6tDTZn1NYxoVCMBjkVjJQ', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTK9fuMialZ1qnDBoTujPDHths5K2kRJl2Dun43hCmHrNn1UnIdM4vF1Rn1ibicKjhFmiciaJtSqKAHlorw/0', null);
INSERT INTO `ya_member` VALUES ('64', '任仁', '1', '', '1506036253', '1', '', '0', '0', 'orDOGwdrGK2mq_4k42Se86Y2ge-Q', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eqG2kaGIGolAAoTlSuqdNmibKowiaDltgJlDCKOyictG6cPdpg9q2UicrJ5706iaehlmEZhtnAUiatx734w/0', null);
INSERT INTO `ya_member` VALUES ('65', '美少女璐璐', '2', '', '1506045100', '1', '', '0', '0', 'orDOGwWbwcdj_vDTYQYc1k6zHuzY', 'http://wx.qlogo.cn/mmopen/vi_32/PBw6bjZk1j5JhbpjonYexH892ApNNp7pSwOaDZ5lwqMHGWWq9VG6VHxpibWJBlMzraY5KZqluHoTIFnibKVEgyQQ/0', null);
INSERT INTO `ya_member` VALUES ('66', '黄油泡菜', '2', '', '1506055354', '1', '', '0', '0', 'orDOGwfKXxjF5do9NbHRPG5S4Mro', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJAq9vyWaWt4wOPgwYwOZmuun9xicmvz2qgLre8ebFBGOzfWiaPsbQH0zv5550kpacjmepUUAR7mTiag/0', '1505974542');
INSERT INTO `ya_member` VALUES ('67', '。。。', '1', '', '1506132559', '1', '', '0', '0', 'orDOGwWQUwNwV3q_aUc_CFHgVbxA', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJWy5zktAAqicxSmNvy6FOrrdSyIxqFlcgzA9AXxXOtOPmibOel3VuHJlf6UPV9tVmVJ1DEF0juFG6A/0', null);
INSERT INTO `ya_member` VALUES ('68', '潇雨', '2', '13308025470', '1506070949', '1', '', '2', '19554', 'orDOGwc8noG9ptapCASyF0EQAWxs', 'http://wx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJuFaveoJRPsQkic8Y9al6E96BSQbDU3JMiaIicxGHk47duKPFfcMMmcs4TMv7ynrG4cFVIDyC0g1zoQ/0', '1506070949');
INSERT INTO `ya_member` VALUES ('69', '对方正在输入', '2', '', '1506077535', '1', '', '0', '0', 'orDOGwc28ccHbe9YxaKBd7vxgzFg', 'http://wx.qlogo.cn/mmopen/vi_32/blqrJkleicEuvuKEcaOmDSONna5ykaSeCk689GNy39uWEvdvVoxZkia787T3uZLMGYL5ej7LQudPAVERcy3mWwgA/0', '1506077526');
INSERT INTO `ya_member` VALUES ('70', '夏天与西瓜有染', '2', '', '1506080425', '1', '', '0', '0', 'orDOGwZhqxoZzbwYp-zYQdEpLN14', 'http://wx.qlogo.cn/mmopen/vi_32/F9XQkpeficG8g11mVAiaZLsWfV3UB2SFZtvjpwUnPg0sypqYun4ticoGGAmEJIdeZziaIrmpias9e7YGK6Vo78hFd5w/0', '1506080425');
INSERT INTO `ya_member` VALUES ('71', '旅游户外-桐人', '1', '', '1506233431', '1', '', '0', '0', 'orDOGwetuQw2HPVcu4xoKco9PJFo', 'http://wx.qlogo.cn/mmopen/vi_32/2eJ3opKLvZniblszMj0b21eCvfT0OhglibrB9ZyJmc06LY1IdnPCT9YicFc7r1iavEKDfdbaOpoRRYcU3co3NsWvicQ/0', '1506161154');
INSERT INTO `ya_member` VALUES ('72', 'SUNLILI', '2', '', '1506169955', '1', '', '0', '0', 'orDOGwSXIbxaVZ2cgOAYNykv1fk4', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83eomOsyFaW4dBH9vqOrELsn2bldibibRqYT5ibwUxicu0ybP0UibuGzxtq04PXB8k6S472ZqKIKIblbKIBg/0', '1506169910');
INSERT INTO `ya_member` VALUES ('73', '记得《》微笑', '1', '13219890986', '1506169993', '1', '', '6', '6600', 'orDOGwYlthmbSR_UaJ1Cw50-Ry20', 'http://wx.qlogo.cn/mmopen/vi_32/TlPZTZwIiapicVa6gricPyonaVbl1miaf3JticWqcBflZTB2YJu86uWfly0E8XywqeKGc1UXFOM95pIOjY1yRjALLog/0', '1506169963');
INSERT INTO `ya_member` VALUES ('74', '神志不清的酒徒', '1', '', '1506231079', '1', '', '0', '0', 'orDOGwfScIeQvlv7hlaJ7rvkPIZo', 'http://wx.qlogo.cn/mmopen/vi_32/mzYcHaB3YuNkYPZ2TFASf2MYE1J3fg38fuDkFDiaPsvshGdViacg8bwDqWoyO6BzvZy6I9syKevjoz3D6xicVr2Ow/0', '1506231052');
INSERT INTO `ya_member` VALUES ('75', '狂妄男子', '1', '', '1506240214', '1', '', '0', '0', 'orDOGwb91sB7QOWZiqZ4Rp34NFyA', 'http://wx.qlogo.cn/mmopen/vi_32/DYAIOgq83epLtWBul36VUibaqSYbQiblaqc2slVmG8iaa9pMNLCxSVIp1gXX6GnZRiaVlSCicFibF5BXROlCRKDzf28Q/0', '1506240191');

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_menu
-- ----------------------------
INSERT INTO `ya_menu` VALUES ('2', '用户管理', null, '/member/index', '1', null);
INSERT INTO `ya_menu` VALUES ('3', '业务员管理', null, '/salesman/index', '2', null);
INSERT INTO `ya_menu` VALUES ('4', '商家管理', null, '/merchant/index', '3', null);
INSERT INTO `ya_menu` VALUES ('5', 'banner管理', null, '/banner/index', '4', null);
INSERT INTO `ya_menu` VALUES ('6', '活动管理', null, null, '5', null);
INSERT INTO `ya_menu` VALUES ('7', '活动列表', '6', '/activity/index?Activity%5Bid%5D=1?Activity%255Bmerchant_id%255D=', '1', null);
INSERT INTO `ya_menu` VALUES ('8', '历史', '6', '/activity/history', '2', null);
INSERT INTO `ya_menu` VALUES ('9', '数据', '6', '/activity-data/index', '3', null);
INSERT INTO `ya_menu` VALUES ('10', '运营统计', null, '/count/index', '8', null);
INSERT INTO `ya_menu` VALUES ('11', '管理员列表', null, '/admin/user/index', '9', null);
INSERT INTO `ya_menu` VALUES ('12', '订单管理', null, null, '6', null);
INSERT INTO `ya_menu` VALUES ('13', '已支付', '12', '/order/paid-index', null, null);
INSERT INTO `ya_menu` VALUES ('14', '待支付', '12', '/order/unpaid-index?Order%5Bstatus%5D=0', null, null);
INSERT INTO `ya_menu` VALUES ('15', '退款管理', null, null, '7', null);
INSERT INTO `ya_menu` VALUES ('16', '待处理', '15', '/refund-order/paid-index?Order%5Bstatus%5D=2', null, null);
INSERT INTO `ya_menu` VALUES ('17', '已处理', '15', '/refund-order/unpaid-index', null, null);
INSERT INTO `ya_menu` VALUES ('18', '权限管理', null, null, '10', null);
INSERT INTO `ya_menu` VALUES ('19', '分配', '18', '/admin/assignment/index', null, null);
INSERT INTO `ya_menu` VALUES ('20', '路由', '18', '/admin/route/index', null, null);
INSERT INTO `ya_menu` VALUES ('21', '菜单', '18', '/admin/menu/index', null, null);
INSERT INTO `ya_menu` VALUES ('22', '权限', '18', '/admin/permission/index', null, null);
INSERT INTO `ya_menu` VALUES ('23', '角色', '18', '/admin/role/index', null, null);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_merchant
-- ----------------------------
INSERT INTO `ya_merchant` VALUES ('1', '成都旅游公司', '13219890982', '成都市春熙路饮食广场', '李四', '1506223856', '/upload/merchant/46751506223856.jpg', '好吃,好玩,好喝!!', '成龙', '12KLGIWOSQQ');

-- ----------------------------
-- Table structure for ya_merchant_img
-- ----------------------------
DROP TABLE IF EXISTS `ya_merchant_img`;
CREATE TABLE `ya_merchant_img` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '商家',
  `merchant_id` int(2) DEFAULT NULL COMMENT '商家id',
  `img` varchar(255) DEFAULT NULL COMMENT '合同地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_merchant_img
-- ----------------------------
INSERT INTO `ya_merchant_img` VALUES ('9', '1', '/upload/merchant/35051506223856.jpg');
INSERT INTO `ya_merchant_img` VALUES ('10', '1', '/upload/merchant/56271506223856.jpg');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='短信验证码表';

-- ----------------------------
-- Records of ya_message_code
-- ----------------------------
INSERT INTO `ya_message_code` VALUES ('1', '13219890986', '4634', '0', '1506224490', '0');

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
INSERT INTO `ya_migration` VALUES ('m000000_000000_base', '1504163125');
INSERT INTO `ya_migration` VALUES ('m140602_111327_create_menu_table', '1504163130');
INSERT INTO `ya_migration` VALUES ('m160312_050000_create_user', '1504163130');
INSERT INTO `ya_migration` VALUES ('m140506_102106_rbac_init', '1504163199');

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
  `order_checking` int(3) DEFAULT '0' COMMENT '验证票数量',
  `phone` varchar(11) DEFAULT NULL COMMENT '电话',
  `sell_all` int(11) DEFAULT '0' COMMENT '售卖总额',
  `clearing_all` int(11) DEFAULT NULL COMMENT '结算总额',
  `sell_all_checking` int(11) DEFAULT '0' COMMENT '已验票售卖总额',
  `clearing_all_checking` int(11) DEFAULT '0' COMMENT '已验票结算总额',
  `order_time` int(14) DEFAULT NULL COMMENT '下单时间',
  `status` int(3) DEFAULT NULL COMMENT '状态:  0:待支付  1:已支付   2:退款  3:退款通过  4:退款拒绝',
  `activity_id` int(4) DEFAULT NULL COMMENT '活动ID',
  `user_id` int(3) DEFAULT NULL COMMENT '用户ID',
  `pay_time` int(11) DEFAULT NULL COMMENT '支付时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_order
-- ----------------------------
INSERT INTO `ya_order` VALUES ('1', 'QFGUSVJVQO5Z', '春熙路三日游', '成都旅游公司', '记得《》微笑', '2', '2', '13219890986', '300', '280', '300', '280', '1506224515', '1', '1', '73', '1506236922');
INSERT INTO `ya_order` VALUES ('2', 'S6XL5OWHUDLJ', '春熙路三日游', '成都旅游公司', '记得《》微笑', '1', '0', '13219890986', '100', '90', '0', '0', '1506237152', '3', '1', '73', '1506237159');
INSERT INTO `ya_order` VALUES ('3', 'YWPASAB5YGOV', '春熙路三日游', '成都旅游公司', '记得《》微笑', '1', '0', '13219890986', '200', '190', '0', '0', '1506238206', '1', '1', '73', '1506238245');
INSERT INTO `ya_order` VALUES ('4', 'AKXTABPNDWTY', '历史数据', '成都旅游公司', '记得《》微笑', '1', '0', '13219890986', '1000', '900', '0', '0', '1506238379', '3', '2', '73', '1506238480');
INSERT INTO `ya_order` VALUES ('5', 'P9E64G7C4K98', '历史数据', '成都旅游公司', '记得《》微笑', '4', '2', '13219890986', '4000', '3600', '2000', '1800', '1506238457', '1', '2', '73', '1506238774');
INSERT INTO `ya_order` VALUES ('6', 'JPXHI0LRRYCA', '历史数据', '成都旅游公司', '记得《》微笑', '1', '1', '13219890986', '1000', '900', '1000', '900', '1506238529', '4', '2', '73', '1506238756');
INSERT INTO `ya_order` VALUES ('7', '8BTKKZGNT0D5', '春熙路三日游', '成都旅游公司', '昂恪', '4', '0', '13308025470', '400', '360', '0', '0', '1506240216', '0', '1', '27', null);
INSERT INTO `ya_order` VALUES ('8', 'WXT907YMPWG7', '春熙路三日游', '成都旅游公司', '昂恪', '1', '0', '13308025470', '100', '90', '0', '0', '1506240272', '0', '1', '27', null);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_order_refund
-- ----------------------------
INSERT INTO `ya_order_refund` VALUES ('1', '2', '100', '不想去了', '不能退', '6885978', '9884', '继续', '1506237266', '1506237954');
INSERT INTO `ya_order_refund` VALUES ('2', '2', '100', '理亏破', null, '558248', '5885', '5584', '1506237859', null);
INSERT INTO `ya_order_refund` VALUES ('3', '4', '1000', '题库', null, '58888', '888888', '5558', '1506238509', '1506238521');
INSERT INTO `ya_order_refund` VALUES ('4', '6', '1000', '辣鸡', '不要退啦', '55854', '5585', '555', '1506238970', '1506239032');

-- ----------------------------
-- Table structure for ya_order_ticket
-- ----------------------------
DROP TABLE IF EXISTS `ya_order_ticket`;
CREATE TABLE `ya_order_ticket` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单票种',
  `phone` varchar(11) NOT NULL COMMENT '用手机号',
  `user_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `code` int(11) DEFAULT NULL COMMENT '验票验证码',
  `activity_tivket_id` int(11) DEFAULT NULL COMMENT '票种id',
  `created_at` int(11) DEFAULT NULL COMMENT '创建时间',
  `status` int(2) DEFAULT '9' COMMENT '0 未验票   1: 已经验票    9 无效   10: 退款中',
  `order_id` int(2) DEFAULT NULL COMMENT '订单ID',
  `prize` int(11) DEFAULT NULL COMMENT '售卖价格',
  `settlement` int(11) DEFAULT NULL COMMENT '结算价格',
  `title` varchar(20) DEFAULT NULL COMMENT '票种名',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_order_ticket
-- ----------------------------
INSERT INTO `ya_order_ticket` VALUES ('1', '13219890986', '73', '96580406', '1', '1506224515', '1', '1', '100', '90', '儿童票');
INSERT INTO `ya_order_ticket` VALUES ('2', '13219890986', '73', '67819360', '2', '1506224515', '1', '1', '200', '190', '成人票');
INSERT INTO `ya_order_ticket` VALUES ('4', '13219890986', '73', '87423684', '2', '1506238206', '0', '3', '200', '190', '成人票');
INSERT INTO `ya_order_ticket` VALUES ('6', '13219890986', '73', '42688275', '5', '1506238457', '1', '5', '1000', '900', '优惠票');
INSERT INTO `ya_order_ticket` VALUES ('7', '13219890986', '73', '44605366', '5', '1506238457', '1', '5', '1000', '900', '优惠票');
INSERT INTO `ya_order_ticket` VALUES ('8', '13219890986', '73', '8248336', '5', '1506238457', '0', '5', '1000', '900', '优惠票');
INSERT INTO `ya_order_ticket` VALUES ('9', '13219890986', '73', '53746730', '5', '1506238457', '0', '5', '1000', '900', '优惠票');
INSERT INTO `ya_order_ticket` VALUES ('10', '13219890986', '73', '48663004', '6', '1506238529', '1', '6', '1000', '900', '成人');
INSERT INTO `ya_order_ticket` VALUES ('11', '13308025470', '27', '4497750', '7', '1506240216', '9', '7', '100', '90', '儿童票');
INSERT INTO `ya_order_ticket` VALUES ('12', '13308025470', '27', '73625589', '7', '1506240216', '9', '7', '100', '90', '儿童票');
INSERT INTO `ya_order_ticket` VALUES ('13', '13308025470', '27', '2502035', '7', '1506240216', '9', '7', '100', '90', '儿童票');
INSERT INTO `ya_order_ticket` VALUES ('14', '13308025470', '27', '75932023', '7', '1506240216', '9', '7', '100', '90', '儿童票');
INSERT INTO `ya_order_ticket` VALUES ('15', '13308025470', '27', '1783496', '7', '1506240272', '9', '8', '100', '90', '儿童票');

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
  `bound_merchant` int(20) DEFAULT '0' COMMENT '绑定商户',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ya_salesman
-- ----------------------------
INSERT INTO `ya_salesman` VALUES ('2', '李四', '0209240', '13219890986', '1506221428', '5');

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

-- ----------------------------
-- Records of ya_wechat_user
-- ----------------------------
