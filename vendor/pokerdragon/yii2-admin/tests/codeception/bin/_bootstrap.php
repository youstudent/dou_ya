<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');

defined('pd_ADMIN_BASE_PATH') or define('pd_ADMIN_BASE_PATH', dirname(dirname(dirname(__DIR__))));

require(pd_ADMIN_BASE_PATH . '/vendor/autoload.php');
require(pd_ADMIN_BASE_PATH . '/vendor/yiisoft/yii2/Yii.php');

Yii::setAlias('@tests', dirname(dirname(__DIR__)));
