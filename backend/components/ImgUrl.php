<?php
namespace backend\components;
use yii\helpers\FileHelper;

/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/17
 * Time: 11:25
 */
class ImgUrl
{
    
    /**
     * 创建上传文件
     * @param $Url
     */
   public static function Url($Url){
       $directory = \Yii::getAlias('@common/static'.$Url);
       if (!is_dir($directory)) {
          FileHelper::createDirectory($directory);
       }
       return $directory;
   }
    
}