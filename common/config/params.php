<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
	'mdm.admin.configs' => [
        'defaultUserStatus' => 0, // 0 = inactive, 10 = active
        'userTable' => '{{%admin}}',
    ],
    'img_domain' => 'http://192.168.2.117:8082/'//图片前缀
];
