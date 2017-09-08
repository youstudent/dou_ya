<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
	'mdm.admin.configs' => [
        'defaultUserStatus' => 0, // 0 = inactive, 10 = active
        'userTable' => '{{%admin}}',
    ],
    'img_domain' => 'http://192.168.2.117:8082/',//图片前缀
    //微信登录参数
   /* 'wechat'=>[
        'oauth' => [
            'scopes'   => ['snsapi_userinfo'],
            'callback' => '/oauth_callback',
            'AppID'=>'wx700876c550efc7f7',
            'token'   =>'bobxu20170412'
        ],
    ],*/
    'WECHAT'=>[
        /**
         * Debug 模式，bool 值：true/false
         *
         * 当值为 false 时，所有的日志都不会记录
         */
        'debug'  => true,
        /**
         * 账号基本信息，请从微信公众平台/开放平台获取
         */
        'app_id'  => 'wx700876c550efc7f7',         // AppID
        'secret'  => '70984938708ac4916e6c59af2560040e',     // AppSecret
        'token'   => 'bobxu20170412',          // Token
        'aes_key' => 'sB7m998DhoBMmkYj5MeGJqcEFfnr7tMabPEVBt61v1R',// EncodingAESKey，安全模式下请一定要填写！！！
        /**
         * 日志配置
         *
         * level: 日志级别, 可选为：
         *         debug/info/notice/warning/error/critical/alert/emergency
         * permission：日志文件权限(可选)，默认为null（若为null值,monolog会取0644）
         * file：日志文件位置(绝对路径!!!)，要求可写权限
         */
        'log' => [
            'level'      => 'debug',
            'permission' => 0777,
            'file'       => '/tmp/easywechat.log',
        ],
        /**
         * OAuth 配置
         *
         * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
         * callback：OAuth授权完成后的回调页地址
         */
        'oauth' => [
            'scopes'   => ['snsapi_userinfo'],
            'callback' => '/banner/index',
        ],
    ]
];
