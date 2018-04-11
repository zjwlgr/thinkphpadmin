<?php
$config = array(
    /* 项目信息设置 */
    'DEVELOP'            => 'ZJWLGR', //开发者 昵称
    'WEB_URL'            => 'http://'.$_SERVER['HTTP_HOST'],     // 项目域名
    'WEB_TITLE'          => 'PHP程序系统',     // 项目名称
    'ADMIN_NAME'		 => '后台管理系统',// 后台管理 名称
    'VERSION'      => 'zjwlgr.tp3.2', //后台框架版本

    /* URL设置 */
    'URL_HTML_SUFFIX'       => 'html',  // URL伪静态后缀设置
    'URL_CASE_INSENSITIVE'  =>  true,   // 默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'             =>  2,       // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE  模式); 3 (兼容模式)  默认为PATHINFO 模式

    /* 子域名设置 */
    'APP_SUB_DOMAIN_DEPLOY' =>  false,   // 是否开启子域名部署
    'APP_SUB_DOMAIN_RULES'  =>  array(
        'admin'        => 'Admin',  // admin子域名指向Admin模块
        'admin.domain1.com'  => 'Admin'  // admin.domain1.com域名指向Admin模块
    ), // 子域名部署规则

    'MODULE_ALLOW_LIST'  => array('Home','adminindex','Api'),//要访问的模块
    'MODULE_DENY_LIST'   => array('Common'),//禁止访问的模块
    'DEFAULT_MODULE'     => 'Home',//默认模块
    'DEFAULT_CONTROLLER' => 'Index', // 默认控制器名称
    'DEFAULT_ACTION'     => 'index', // 默认操作名称
    'URL_DENY_SUFFIX'    => 'ico|png|gif|jpg', // URL禁止访问的后缀设置
    'CONTROLLER_LEVEL'   =>  1,//设置控制器的分级层次
    'URL_MODULE_MAP'     =>  array('adminindex'=>'admin'),//设置了模块映射后，原来的Admin模块将不能访问，只能访问test模块。

    /*令牌验证功能*/
    'TOKEN_ON'      =>    true,  // 是否开启令牌验证 默认关闭
    'TOKEN_NAME'    =>    '__hash__',    // 令牌验证的表单隐藏字段名称，默认为__hash__
    'TOKEN_TYPE'    =>    'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'   =>    true,  //令牌验证出错后是否重置令牌 默认为true

    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  '127.0.0.1', // 服务器地址
    'DB_NAME'               =>  'databasename',          // 数据库名
    'DB_USER'               =>  'username',      // 用户名
    'DB_PWD'                =>  'password',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
    'DB_PREFIX'             =>  'xx_',    // 数据库表前缀
    'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查
    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
    'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
    'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
    'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
    'DB_SLAVE_NO'           =>  '', // 指定从服务器序号
    'DB_SQL_BUILD_CACHE'    =>  false, // 数据库查询的SQL创建缓存
    'DB_SQL_BUILD_QUEUE'    =>  'file',   // SQL缓存队列的缓存方式 支持 file xcache和apc
    'DB_SQL_BUILD_LENGTH'   =>  20, // SQL缓存的队列长度
    'DB_SQL_LOG'            =>  false, // SQL执行日志记录
    'DB_BIND_PARAM'         =>  false, // 数据库写入数据自动参数绑定

    // 配置邮件发送服务器
    //'MAIL_HOST' =>'smtp.exmail.qq.com',//smtp服务器的名称
    'MAIL_HOST' =>'smtp.qq.com',//smtp服务器的名称
    'MAIL_SMTPAUTH' =>TRUE, //启用smtp认证
    'MAIL_USERNAME' =>'2949992173@qq.com',//你的邮箱名
    'MAIL_FROM' =>'2949992173@qq.com',//发件人地址
    'MAIL_FROMNAME'=>'链币',//发件人姓名
    'MAIL_PASSWORD' =>'zjwlgr47782906',//邮箱密码
    'MAIL_CHARSET' =>'utf-8',//设置邮件编码
    'MAIL_ISHTML' =>TRUE, // 是否HTML格式邮件

    'APITYPE'       =>  array(
        '1' => '张健开发API',
        '2' => '大彭开发API'
    ),

);

return array_merge($config, require(BASE_PATH.'/db.inc.php'));//不要改动