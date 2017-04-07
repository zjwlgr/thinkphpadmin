

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `ta_class`
-- ----------------------------
DROP TABLE IF EXISTS `ta_class`;
CREATE TABLE `ta_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL DEFAULT '0',
  `nexus` varchar(2048) DEFAULT NULL COMMENT '关系ID',
  `depth` int(11) NOT NULL DEFAULT '0' COMMENT '深度',
  `name` varchar(64) DEFAULT NULL,
  `sort` int(10) NOT NULL DEFAULT '0',
  `ctime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=186 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ta_class`
-- ----------------------------
BEGIN;
INSERT INTO `ta_class` VALUES ('140', '135', '135,', '2', 'Style', '2', '1477207782'), ('141', '135', '135,', '2', 'Javascript', '3', '1477207788'), ('144', '136', '135,136,', '3', 'Nginx', '0', '1477232511'), ('145', '136', '135,136,', '3', 'Apache', '0', '1477232517'), ('135', '0', '', '1', '技术文章分类', '0', '1474956620'), ('155', '137', '135,137,', '3', 'Mongodb', '0', '1477359228'), ('156', '141', '135,141,', '3', 'JS', '0', '1477359320'), ('157', '136', '135,136,', '3', 'Command', '0', '1477362925'), ('158', '139', '135,139,', '3', 'PHPcode', '0', '1477363504'), ('159', '136', '135,136,', '3', 'Memcached', '0', '1477367537'), ('139', '135', '135,', '2', 'PHP', '4', '1477207777'), ('137', '135', '135,', '2', 'Database', '5', '1477207764'), ('136', '135', '135,', '2', 'Linux', '63', '1477207757'), ('154', '137', '135,137,', '3', 'Redis', '0', '1477359201'), ('153', '136', '135,136,', '3', 'GIT', '0', '1477359189'), ('152', '136', '135,136,', '3', 'SVN', '0', '1477359177'), ('151', '140', '135,140,', '3', 'Html5', '0', '1477232607'), ('150', '140', '135,140,', '3', 'Bootstrap', '0', '1477232586'), ('149', '140', '135,140,', '3', 'Css', '0', '1477232569'), ('148', '141', '135,141,', '3', 'Jquery', '0', '1477232562'), ('147', '139', '135,139,', '3', 'Thinkphp', '2', '1477232554'), ('146', '139', '135,139,', '3', 'Yii2', '1', '1477232547'), ('143', '137', '135,137,', '3', 'Mysql', '0', '1477232495');
COMMIT;

-- ----------------------------
--  Table structure for `ta_function`
-- ----------------------------
DROP TABLE IF EXISTS `ta_function`;
CREATE TABLE `ta_function` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fid` int(10) NOT NULL DEFAULT '0',
  `fname` varchar(64) DEFAULT NULL,
  `furi` varchar(128) DEFAULT NULL,
  `sort` int(5) NOT NULL DEFAULT '0',
  `candel` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0可以删除，1不可以删除',
  `state` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0显示，1不显示',
  `ctime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ta_function`
-- ----------------------------
BEGIN;
INSERT INTO `ta_function` VALUES ('12', '0', '系统常规功能', 'none', '1', '1', '0', '1472277965'), ('13', '12', '系统信息查看', 'Index/index', '0', '1', '0', '1472277965'), ('14', '0', '测试列表', 'none', '1', '0', '0', '1472278180'), ('16', '12', '管理员登录日志', 'ManagerRecord/lists', '1', '1', '0', '1472279022'), ('17', '12', '管理员管理', 'Manager/lists', '3', '1', '0', '1472279078'), ('18', '12', '管理员分组管理', 'ManagerGroup/lists', '4', '1', '0', '1472279093'), ('19', '12', '系统功能管理', 'Function/lists', '5', '1', '0', '1472279107'), ('43', '14', '测试列表管理', 'article/list', '0', '0', '0', '1472474271'), ('45', '12', '系统分类管理', 'Class/index', '7', '0', '0', '1472483198'), ('118', '14', '测试列表管理', 'Csdf/sdf', '0', '0', '0', '1487667890');
COMMIT;

-- ----------------------------
--  Table structure for `ta_manager`
-- ----------------------------
DROP TABLE IF EXISTS `ta_manager`;
CREATE TABLE `ta_manager` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `uname` varchar(32) NOT NULL COMMENT '管理员姓名',
  `group_id` int(5) NOT NULL DEFAULT '0' COMMENT '管理员分组ID',
  `locking` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0为正常，1为锁定',
  `number` int(10) DEFAULT '0' COMMENT '登录次数',
  `login_ip` varchar(15) DEFAULT NULL COMMENT '最后一次登录IP',
  `login_time` int(11) DEFAULT '0' COMMENT '最后一次登录时间',
  `ctime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ta_manager`
-- ----------------------------
BEGIN;
INSERT INTO `ta_manager` VALUES ('1', 'zjwlgr', '02bbc9253fb630843b6af6a95a501908', '张健', '1', '0', '150', '119.255.37.225', '1487667760', '1473512951'), ('2', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '管理员', '2', '0', '16', '127.0.0.1', '1487581877', '1473512951');
COMMIT;

-- ----------------------------
--  Table structure for `ta_manager_group`
-- ----------------------------
DROP TABLE IF EXISTS `ta_manager_group`;
CREATE TABLE `ta_manager_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gname` varchar(32) DEFAULT NULL,
  `function` varchar(1024) DEFAULT '',
  `ctime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ta_manager_group`
-- ----------------------------
BEGIN;
INSERT INTO `ta_manager_group` VALUES ('1', '超级管理员', 'CJ', '499965143'), ('2', '运营部', '{\"12\":[\"13\",\"16\",\"19\"],\"14\":[\"43\",\"15\"],\"22\":[\"24\",\"25\",\"26\"]}', '1474202021');
COMMIT;

-- ----------------------------
--  Table structure for `ta_manager_record`
-- ----------------------------
DROP TABLE IF EXISTS `ta_manager_record`;
CREATE TABLE `ta_manager_record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `uname` varchar(32) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `browser` varchar(512) DEFAULT NULL COMMENT '浏览器信息',
  `system` varchar(512) DEFAULT NULL COMMENT '系统信息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=176 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `ta_manager_record`
-- ----------------------------
BEGIN;
INSERT INTO `ta_manager_record` VALUES ('151', '1', 'zjwlgr', '哈哈', '127.0.0.1', '1483770004', 'Chrome 44.0', 'Mac OS'), ('152', '1', 'xt', '张健', '127.0.0.1', '1483770195', 'Chrome 44.0', 'Mac OS'), ('153', '1', 'zjwlgr', '张健', '127.0.0.1', '1483771489', 'Chrome 44.0', 'Mac OS'), ('154', '1', 'zjwlgr', '张健', '127.0.0.1', '1483927700', 'Chrome 51.0', 'Windows 7'), ('155', '1', 'zjwlgr', '张健', '127.0.0.1', '1483931862', 'Chrome 51.0', 'Windows 7'), ('156', '1', 'zjwlgr', '张健', '127.0.0.1', '1483940037', 'Chrome 51.0', 'Windows 7'), ('157', '1', 'zjwlgr', '张健', '127.0.0.1', '1483940877', 'Chrome 51.0', 'Windows 7'), ('158', '1', 'zjwlgr', '张健', '127.0.0.1', '1483940896', 'Chrome 51.0', 'Windows 7'), ('159', '1', 'zjwlgr', '张健', '127.0.0.1', '1483941704', 'Chrome 51.0', 'Windows 7'), ('162', '1', 'zjwlgr', '张健', '127.0.0.1', '1483949417', 'Chrome 51.0', 'Windows 7'), ('163', '1', 'zjwlgr', '张健', '127.0.0.1', '1483949422', 'Chrome 51.0', 'Windows 7'), ('164', '1', 'zjwlgr', '张健', '127.0.0.1', '1483949429', 'Chrome 51.0', 'Windows 7'), ('165', '1', 'zjwlgr', '张健', '127.0.0.1', '1486224551', 'Chrome 44.0', 'Mac OS'), ('166', '1', 'zjwlgr', '张健', '127.0.0.1', '1487560056', 'Chrome 55.0', 'Windows 7'), ('167', '1', 'zjwlgr', '张健', '127.0.0.1', '1487574541', 'Chrome 55.0', 'Windows 7'), ('168', '1', 'zjwlgr', '张健', '127.0.0.1', '1487576768', 'Chrome 55.0', 'Windows 7'), ('169', '20', 'qwqwqw', 'qqqq', '127.0.0.1', '1487577704', 'Chrome 55.0', 'Windows 7'), ('170', '1', 'zjwlgr', '张健', '127.0.0.1', '1487577754', 'Chrome 55.0', 'Windows 7'), ('171', '2', 'admin', '管理员', '127.0.0.1', '1487581877', 'Chrome 55.0', 'Windows 7'), ('172', '1', 'zjwlgr', '张健', '127.0.0.1', '1487581906', 'Chrome 55.0', 'Windows 7'), ('173', '1', 'zjwlgr', '张健', '127.0.0.1', '1487661815', 'Chrome 55.0', 'Windows 7'), ('174', '1', 'zjwlgr', '张健', '127.0.0.1', '1487661951', 'Chrome 55.0', 'Windows 7'), ('175', '1', 'zjwlgr', '张健', '119.255.37.225', '1487667760', 'Chrome 55.0', 'Windows 7');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
