<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/pokerdragon/color-admin/assets');
$this->registerJs('
App.init(ajax=true);
LoginV2.init();
', View::POS_END)
?>
<div class="login-cover">
    <div class="login-cover-image"><img src="<?= $directoryAsset ?>/img/login-bg/bg-1.jpg" data-id="login-cover-image" alt="" /></div>
    <div class="login-cover-bg"></div>
</div>

<!-- begin #page-container -->
<div id="page-container" class="fade">
    <!-- begin login -->
    <div class="login login-v2" data-pageload-addclass="animated fadeIn">
        <!-- begin brand -->
        <div class="login-header">
            <div class="brand">
                <span class="logo"></span> Color Admin
                <small>responsive bootstrap 3 admin template</small>
            </div>
            <div class="icon">
                <i class="fa fa-sign-in"></i>
            </div>
        </div>
        <!-- end brand -->
        <div class="login-content">
            <form action="index.html" method="POST" class="margin-bottom-0">
                <div class="form-group m-b-20">
                    <input type="text" class="form-control input-lg" placeholder="Email Address" required />
                </div>
                <div class="form-group m-b-20">
                    <input type="password" class="form-control input-lg" placeholder="Password" required />
                </div>
                <div class="checkbox m-b-20">
                    <label>
                        <input type="checkbox" /> Remember Me
                    </label>
                </div>
                <div class="login-buttons">
                    <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                </div>
                <div class="m-t-20">
                    Not a member yet? Click <a href="#">here</a> to register.
                </div>
            </form>
        </div>
    </div>
    <!-- end login -->

    <ul class="login-bg-list clearfix">
        <li class="active"><a href="#" data-click="change-bg"><img src="<?= $directoryAsset ?>/img/login-bg/bg-1.jpg" alt="" /></a></li>
        <li><a href="#" data-click="change-bg"><img src="<?= $directoryAsset ?>/img/login-bg/bg-2.jpg" alt="" /></a></li>
        <li><a href="#" data-click="change-bg"><img src="<?= $directoryAsset ?>/img/login-bg/bg-3.jpg" alt="" /></a></li>
        <li><a href="#" data-click="change-bg"><img src="<?= $directoryAsset ?>/img/login-bg/bg-4.jpg" alt="" /></a></li>
        <li><a href="#" data-click="change-bg"><img src="<?= $directoryAsset ?>/img/login-bg/bg-5.jpg" alt="" /></a></li>
        <li><a href="#" data-click="change-bg"><img src="<?= $directoryAsset ?>/img/login-bg/bg-6.jpg" alt="" /></a></li>
    </ul>

    <!-- begin theme-panel -->
    <div class="theme-panel">
        <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
        <div class="theme-panel-content">
            <h5 class="m-t-0">Color Theme</h5>
            <ul class="theme-list clearfix">
                <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
            </ul>
            <div class="divider"></div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label double-line">Header Styling</div>
                <div class="col-md-7">
                    <select name="header-styling" class="form-control input-sm">
                        <option value="1">default</option>
                        <option value="2">inverse</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label">Header</div>
                <div class="col-md-7">
                    <select name="header-fixed" class="form-control input-sm">
                        <option value="1">fixed</option>
                        <option value="2">default</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label double-line">Sidebar Styling</div>
                <div class="col-md-7">
                    <select name="sidebar-styling" class="form-control input-sm">
                        <option value="1">default</option>
                        <option value="2">grid</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label">Sidebar</div>
                <div class="col-md-7">
                    <select name="sidebar-fixed" class="form-control input-sm">
                        <option value="1">fixed</option>
                        <option value="2">default</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label double-line">Sidebar Gradient</div>
                <div class="col-md-7">
                    <select name="content-gradient" class="form-control input-sm">
                        <option value="1">disabled</option>
                        <option value="2">enabled</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label double-line">Content Styling</div>
                <div class="col-md-7">
                    <select name="content-styling" class="form-control input-sm">
                        <option value="1">default</option>
                        <option value="2">black</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-12">
                    <a href="#" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage"><i class="fa fa-refresh m-r-3"></i> Reset Local Storage</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end theme-panel -->
</div>
<!-- end page container -->