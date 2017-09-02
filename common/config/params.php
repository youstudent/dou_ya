<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
	'mdm.admin.configs' => [
        'defaultUserStatus' => 0, // 0 = inactive, 10 = active
        'userTable' => '{{%admin}}',
    ],
    'img_domain' => 'www.douya.com/'//图片前缀
];
