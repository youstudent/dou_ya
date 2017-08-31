<?php
namespace backend\controllers;

use mdm\admin\controllers\UserController;

/**
 * Site controller
 */
class SiteController extends UserController
{
    public function actionError()
    {
        echo '在这里捕获错误';

    }
}
