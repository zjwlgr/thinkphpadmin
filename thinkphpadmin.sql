/*
Navicat MySQL Data Transfer

Source Server         : 阿里云测试数据库
Source Server Version : 50615
Source Host           : 121.42.231.177:3306
Source Database       : lianbiotc

Target Server Type    : MYSQL
Target Server Version : 50615
File Encoding         : 65001

Date: 2018-04-11 15:07:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ta_api_document
-- ----------------------------
DROP TABLE IF EXISTS `ta_api_document`;
CREATE TABLE `ta_api_document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(512) DEFAULT NULL,
  `content` text,
  `sort` int(11) DEFAULT NULL,
  `ctime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1842 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='api接口文档管理';

-- ----------------------------
-- Records of ta_api_document
-- ----------------------------
INSERT INTO `ta_api_document` VALUES ('2', '1', 'Token实现方法', '<pre class=\"prettyprint lang-html\">Token：sha1(md5(date(&quot;YmdHi&quot;).&#39;&amp;%@$Xi768&#39;.$phone));</pre>', '0', '1469581373');
INSERT INTO `ta_api_document` VALUES ('112', '1', '服务器时间获取接口', '<pre class=\"prettyprint lang-html\">地址：https://api.lianbi.io/Index/serverTime\r\n方式：GET\r\n参数：无\r\n例子：https://api.lianbi.io/Index/serverTime\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&quot;date1&quot;:&nbsp;&quot;2016-03-28&nbsp;16:31&quot;,\r\n&nbsp;&nbsp;&quot;date2&quot;:&nbsp;&quot;201603281631&quot;,\r\n&nbsp;&nbsp;&quot;date3&quot;:&nbsp;1459153860\r\n}</pre>', '0', '1506395224');
INSERT INTO `ta_api_document` VALUES ('113', '1', '发送手机验证码接口', '<pre class=\"brush:html;toolbar:false\">地址：https://api.lianbi.io/User/sendCode?sign=参数1&amp;phone=参数2\r\n方式：GET\r\n参数：*参数1=token，*参数2=手机号\r\n例子：https://api.lianbi.io/User/sendCode?sign=tokenzjwlgrtoken&amp;phone=13141437817\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;200,&nbsp;\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;短信发送成功&quot;,&nbsp;\r\n&nbsp;&nbsp;&quot;data&quot;:&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;validate&quot;:&nbsp;&quot;468524&quot;\r\n&nbsp;&nbsp;}\r\n}\r\n\r\n失败返回：\r\n{\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;1.缺少参数&nbsp;2.验签失败&nbsp;3.短信发送失败&quot;,&nbsp;\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;403,\r\n}</pre><p><br/></p>', '1', '1506401818');
INSERT INTO `ta_api_document` VALUES ('115', '1', '用户注册接口', '<pre class=\"brush:html;toolbar:false\">地址：https://api.lianbi.io/User/userRegister\r\n方式：POST\r\n参数：&nbsp;*sign=token，*phone=手机号，*password=密码（需要MD5后），*code=验证码，invitation=邀请码\r\n例子：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;sign&quot;:&nbsp;&quot;b086f15cfafbd634270d44946459f69e2efeb1da&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;phone&quot;:&nbsp;&quot;13141437817&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;password&quot;:&nbsp;&quot;123456&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;code&quot;:&quot;235534&quot;，\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;invitation&quot;:&quot;5789272c&quot;\r\n}\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;code&quot;:&nbsp;&quot;200&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;成功&quot;,\r\n}\r\n失败返回：\r\n{\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;1.缺少参数&nbsp;2.验签失败&nbsp;3.用户注册失败&nbsp;4.手机号与验证码不匹配&quot;,\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;403,\r\n}</pre><p><br/></p>', '5', '1506570441');
INSERT INTO `ta_api_document` VALUES ('167', '1', '验证用户是否存在', '<pre class=\"brush:html;toolbar:false\">地址：https://api.lianbi.io/User/checkUser?sign=参数1&amp;phone=参数2\r\n方式：GET\r\n参数：*参数1=token，*参数2=手机号\r\n例子：https://api.lianbi.io/User/checkUser?sign=d07c239b51c6826a276b2987a3ecc86e703251af&amp;phone=13141437817\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;code&quot;:&nbsp;&quot;200&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;成功&quot;\r\n}\r\n\r\n失败返回：\r\n{\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;403,\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;1.缺少参数&nbsp;2.验签失败&nbsp;3.用户已存在&quot;\r\n}</pre><p><br/></p>', '4', '1521526383');
INSERT INTO `ta_api_document` VALUES ('168', '1', '用户登录接口', '<pre class=\"brush:html;toolbar:false\">地址：https://api.lianbi.io/User/userLogin\r\n方式：POST\r\n参数：&nbsp;*sign=token，*phone=手机号，*password=密码（需MD5后）\r\n例子：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;sign&quot;:&nbsp;&quot;b086f15cfafbd634270d44946459f69e2efeb1da&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;phone&quot;:&nbsp;&quot;13311528848&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;password&quot;:&nbsp;&quot;e10adc3949ba59abbe56e057f20f883e&quot;\r\n}\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;code&quot;:&nbsp;&quot;200&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;成功&quot;,\r\n}\r\n\r\n失败返回：\r\n{\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;1.缺少参数&nbsp;2.验签失败&nbsp;3.账户或密码不正确&quot;,\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;403,\r\n}</pre><p><br/></p>', '6', '1521528585');
INSERT INTO `ta_api_document` VALUES ('169', '1', '修改密码接口', '<pre class=\"brush:html;toolbar:false\">地址：https://api.lianbi.io/User/setPassword\r\n方式：POST\r\n参数：&nbsp;*sign=token，*phone=手机号，*password=密码（需要MD5后），*code=验证码\r\n例子：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;sign&quot;:&nbsp;&quot;b086f15cfafbd634270d44946459f69e2efeb1da&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;phone&quot;:&nbsp;&quot;13141437817&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;password&quot;:&nbsp;&quot;111111&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;code&quot;:&quot;235534&quot;\r\n}\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;code&quot;:&nbsp;&quot;200&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;成功&quot;,\r\n}\r\n失败返回：\r\n{\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;1.缺少参数&nbsp;2.验签失败&nbsp;3.用户不存在&quot;,\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;403,\r\n}</pre><p><br/></p>', '7', '1521529442');
INSERT INTO `ta_api_document` VALUES ('170', '1', '用户身份认证接口', '<pre>地址：https://api.lianbi.io/User/userAuthentication\r\n方式：POST\r\n参数：&nbsp;*sign=token，*phone=手机号，*name=姓名，*identity=身份证号，*images=三张图片\r\n例子：\r\nsign&nbsp;=&nbsp;b086f15cfafbd634270d44946459f69e2efeb1da,\r\nphone&nbsp;=&nbsp;13141437817,\r\nname&nbsp;=&nbsp;谢大吊,\r\nidentity&nbsp;=&nbsp;1308789198766765651,\r\nimages&nbsp;=&nbsp;files\r\n测试：https://api.lianbi.io/Index/uploadimg\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;code&quot;:&nbsp;&quot;200&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;成功&quot;,\r\n}\r\n失败返回：\r\n{\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;1.缺少参数&nbsp;2.验签失败&nbsp;3.缺少认证图片，4.上传失败&quot;,\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;403,\r\n}</pre><p><br/></p>', '8', '1521535976');
INSERT INTO `ta_api_document` VALUES ('171', '1', '用户绑定银行卡接口', '<pre class=\"brush:html;toolbar:false\">地址：https://api.lianbi.io/User/userBinding\r\n方式：POST\r\n参数：&nbsp;*sign=token，*phone=手机号，*name=账户姓名\r\n参数：&nbsp;*bankname=开户行名称，branchname=支行名称，cardnumber=银行卡号\r\n例子：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;sign&quot;:&nbsp;&quot;b086f15cfafbd634270d44946459f69e2efeb1da&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;phone&quot;:&nbsp;&quot;13141437817&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;name&quot;:&nbsp;&quot;谢大吊&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;bankname&quot;:&quot;中国工商银行&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;branchname&quot;:&quot;北三环安华桥支行&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;cardnumber&quot;:&quot;200987653454549009&quot;\r\n}\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;code&quot;:&nbsp;&quot;200&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;成功&quot;,\r\n}\r\n失败返回：\r\n{\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;1.缺少参数&nbsp;2.验签失败&nbsp;3.账户姓名与认证姓名不一致&nbsp;4.绑定失败&quot;,\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;403,\r\n}</pre><p><br/></p>', '9', '1521597853');
INSERT INTO `ta_api_document` VALUES ('172', '1', '个人中心接口', '<pre class=\"brush:html;toolbar:false\">地址：https://api.lianbi.io/User/userHome?sign=参数1&amp;phone=参数2\r\n方式：GET\r\n参数：*参数1=token，*参数2=手机号\r\n例子：https://api.lianbi.io/User/userHome?sign=fbadea5087ba11fc36c91fcbcd8c502589ddee43&amp;phone=13141437817\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;code&quot;:&nbsp;&quot;200&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;成功&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;data&quot;:&nbsp;{&nbsp;\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;id&quot;:&nbsp;&quot;1&quot;,&nbsp;//用户ID\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;invitation&quot;:&nbsp;&quot;5789272c&quot;,&nbsp;//邀请码\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;phone&quot;:&nbsp;&quot;13141437817&quot;,&nbsp;//手机号\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;name&quot;:&nbsp;&quot;谢大吊&quot;,&nbsp;//真实姓名\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;identity&quot;:&nbsp;&quot;1129878198766540102&quot;,&nbsp;//身份证号\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;identity_front_img&quot;:&nbsp;&quot;/U.../5ab1ba8ed578d.jpg&quot;,&nbsp;//正面\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;identity_after_img&quot;:&nbsp;&quot;/U.../8edbd1f.jpg&quot;,&nbsp;//背面\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;identity_hand_img&quot;:&nbsp;&quot;/U...1/5ab1ba8edf7b8.jpg&quot;,&nbsp;//手持\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;status&quot;:&nbsp;&quot;1&quot;,&nbsp;//0未认证，1审核中，2成功，3失败\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;email&quot;:&nbsp;&quot;&quot;,&nbsp;//邮箱地址\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;email_status&quot;:&nbsp;&quot;0&quot;,&nbsp;//0未认证，1已认证\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;headimgurl&quot;:&nbsp;&quot;/U...4/sdsdfsdf34.jpg&quot;,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;bank&quot;:&nbsp;{&nbsp;//银行卡信息\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;name&quot;:&nbsp;&quot;谢大吊&quot;,&nbsp;//账户名\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;bankname&quot;:&nbsp;&quot;中国工商银行&quot;,&nbsp;//开户行\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;branchname&quot;:&nbsp;&quot;北三环安华桥支行&quot;,&nbsp;//支行\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;cardnumber&quot;:&nbsp;&quot;15215995541521599554&quot;&nbsp;//卡号\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;},\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&quot;abouturl&quot;:&nbsp;&quot;/Index/abouturl&quot;&nbsp;//关于我们H5地址\r\n&nbsp;&nbsp;&nbsp;&nbsp;}\r\n}\r\n\r\n失败返回：\r\n{\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;1.缺少参数&nbsp;2.验签失败&nbsp;3.用户不存在&quot;,&nbsp;\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;403,\r\n}</pre><p><br/></p>', '10', '1521612579');
INSERT INTO `ta_api_document` VALUES ('173', '1', '发送邮箱验证码接口', '<pre class=\"brush:html;toolbar:false\">地址：https://api.lianbi.io/User/emailVerification?sign=参数1&amp;phone=参数2&amp;email=参数3\r\n方式：GET\r\n参数：*参数1=token，*参数2=手机号，*参数3=正确的邮箱地址\r\n例子：https://api.lianbi.io/User/emailVerification?sign=b469dd8523f27403d7c7c&amp;phone=13141437817&amp;email=zjwlgr@yeah.net\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;200,&nbsp;\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;验证码发送成功&quot;,&nbsp;\r\n&nbsp;&nbsp;&quot;data&quot;:&nbsp;{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;validate&quot;:&nbsp;&quot;468524&quot;\r\n&nbsp;&nbsp;}\r\n}\r\n\r\n失败返回：\r\n{\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;1.缺少参数&nbsp;2.验签失败&nbsp;3.发送失败&quot;,&nbsp;\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;403,\r\n}</pre><p><br/></p>', '11', '1521615902');
INSERT INTO `ta_api_document` VALUES ('174', '1', '用户认证邮箱接口', '<pre class=\"brush:html;toolbar:false\">地址：https://api.lianbi.io/User/emailAuthentication?sign=参数1&amp;phone=参数2&amp;email=参数3&amp;code=参数4\r\n方式：GET\r\n参数：*参数1=token，*参数2=手机号，*参数3=正确的邮箱地址，*参数4=验证码\r\n例子：https://api.lianbi.io/User/emailAuthentication?sign=fb43&amp;phone=131414817&amp;email=zjr@yeh.net&amp;code=791629\r\n成功返回：\r\n{\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;code&quot;:&nbsp;200,\r\n&nbsp;&nbsp;&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;成功&quot;,\r\n}\r\n\r\n失败返回：\r\n{\r\n&nbsp;&nbsp;&quot;msg&quot;:&nbsp;&quot;1.缺少参数&nbsp;2.验签失败&nbsp;3.认证失败&quot;,&nbsp;\r\n&nbsp;&nbsp;&quot;code&quot;:&nbsp;403,\r\n}</pre><p><br/></p>', '12', '1521617320');

-- ----------------------------
-- Table structure for ta_class
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
-- Records of ta_class
-- ----------------------------

-- ----------------------------
-- Table structure for ta_function
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
-- Records of ta_function
-- ----------------------------
INSERT INTO `ta_function` VALUES ('12', '0', '系统常规功能', 'none', '1', '1', '0', '1472277965');
INSERT INTO `ta_function` VALUES ('13', '12', '系统信息查看', 'Index/index', '0', '1', '0', '1472277965');
INSERT INTO `ta_function` VALUES ('14', '0', '接口文档管理', 'none', '1', '0', '0', '1472278180');
INSERT INTO `ta_function` VALUES ('16', '12', '管理员登录日志', 'ManagerRecord/lists', '1', '1', '0', '1472279022');
INSERT INTO `ta_function` VALUES ('17', '12', '管理员管理', 'Manager/lists', '3', '1', '0', '1472279078');
INSERT INTO `ta_function` VALUES ('18', '12', '管理员分组管理', 'ManagerGroup/lists', '4', '1', '0', '1472279093');
INSERT INTO `ta_function` VALUES ('19', '12', '系统功能管理', 'Function/lists', '5', '1', '0', '1472279107');
INSERT INTO `ta_function` VALUES ('43', '14', '接口文档管理', 'Document/tp_document', '0', '0', '0', '1472474271');
INSERT INTO `ta_function` VALUES ('45', '12', '系统分类管理', 'Class/index', '7', '0', '0', '1472483198');

-- ----------------------------
-- Table structure for ta_manager
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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ta_manager
-- ----------------------------
INSERT INTO `ta_manager` VALUES ('1', 'zjwlgr', '02bbc9253fb630843b6af6a95a501908', '张健', '1', '0', '214', '127.0.0.1', '1523429608', '1473512951');
INSERT INTO `ta_manager` VALUES ('22', 'pengfei', 'a3d4869a4077ddf307eae2d40320141b', '彭飞', '1', '0', '92', '127.0.0.1', '1523427106', '1501049250');

-- ----------------------------
-- Table structure for ta_manager_group
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
-- Records of ta_manager_group
-- ----------------------------
INSERT INTO `ta_manager_group` VALUES ('1', '超级管理员', 'CJ', '499965143');
INSERT INTO `ta_manager_group` VALUES ('2', '运营部', '{\"12\":[\"13\",\"16\",\"19\"],\"14\":[\"43\",\"15\"],\"22\":[\"24\",\"25\",\"26\"]}', '1474202021');

-- ----------------------------
-- Table structure for ta_manager_record
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
) ENGINE=MyISAM AUTO_INCREMENT=179 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ta_manager_record
-- ----------------------------
INSERT INTO `ta_manager_record` VALUES ('151', '1', 'zjwlgr', '哈哈', '127.0.0.1', '1483770004', 'Chrome 44.0', 'Mac OS');
INSERT INTO `ta_manager_record` VALUES ('152', '1', 'xt', '张健', '127.0.0.1', '1483770195', 'Chrome 44.0', 'Mac OS');
INSERT INTO `ta_manager_record` VALUES ('153', '1', 'zjwlgr', '张健', '127.0.0.1', '1483771489', 'Chrome 44.0', 'Mac OS');
INSERT INTO `ta_manager_record` VALUES ('154', '1', 'zjwlgr', '张健', '127.0.0.1', '1483927700', 'Chrome 51.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('155', '1', 'zjwlgr', '张健', '127.0.0.1', '1483931862', 'Chrome 51.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('156', '1', 'zjwlgr', '张健', '127.0.0.1', '1483940037', 'Chrome 51.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('157', '1', 'zjwlgr', '张健', '127.0.0.1', '1483940877', 'Chrome 51.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('158', '1', 'zjwlgr', '张健', '127.0.0.1', '1483940896', 'Chrome 51.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('159', '1', 'zjwlgr', '张健', '127.0.0.1', '1483941704', 'Chrome 51.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('162', '1', 'zjwlgr', '张健', '127.0.0.1', '1483949417', 'Chrome 51.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('163', '1', 'zjwlgr', '张健', '127.0.0.1', '1483949422', 'Chrome 51.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('164', '1', 'zjwlgr', '张健', '127.0.0.1', '1483949429', 'Chrome 51.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('165', '1', 'zjwlgr', '张健', '127.0.0.1', '1486224551', 'Chrome 44.0', 'Mac OS');
INSERT INTO `ta_manager_record` VALUES ('166', '1', 'zjwlgr', '张健', '127.0.0.1', '1487560056', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('167', '1', 'zjwlgr', '张健', '127.0.0.1', '1487574541', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('168', '1', 'zjwlgr', '张健', '127.0.0.1', '1487576768', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('169', '20', 'qwqwqw', 'qqqq', '127.0.0.1', '1487577704', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('170', '1', 'zjwlgr', '张健', '127.0.0.1', '1487577754', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('171', '2', 'admin', '管理员', '127.0.0.1', '1487581877', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('172', '1', 'zjwlgr', '张健', '127.0.0.1', '1487581906', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('173', '1', 'zjwlgr', '张健', '127.0.0.1', '1487661815', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('174', '1', 'zjwlgr', '张健', '127.0.0.1', '1487661951', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('175', '1', 'zjwlgr', '张健', '119.255.37.225', '1487667760', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('176', '1', 'zjwlgr', '张健', '127.0.0.1', '1523415038', 'Chrome 55.0', 'Windows 7');
INSERT INTO `ta_manager_record` VALUES ('177', '22', 'pengfei', '彭飞', '127.0.0.1', '1523427106', 'Chrome 65.0', 'Windows 32');
INSERT INTO `ta_manager_record` VALUES ('178', '1', 'zjwlgr', '张健', '127.0.0.1', '1523429608', 'Chrome 55.0', 'Windows 7');
