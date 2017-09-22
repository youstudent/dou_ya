<?php
/**
 * User: harlen-angkemac
 * Date: 2017/7/18 - 下午4:33
 *
 */

namespace backend\assets;

use yii\web\AssetBundle;

class DaterangePickerAsset extends AssetBundle
{
    public $sourcePath = '@vendor/bower';

    public $css = [
        'bootstrap-daterangepicker/daterangepicker.css',
    ];
    public $js = [
        'moment/moment.js',
        'moment/locale/zh-cn.js',
        'bootstrap-daterangepicker/daterangepicker.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}