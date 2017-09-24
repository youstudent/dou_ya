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
        return $this->redirect(['/admin/user/index']);

    }
}
