<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/5
 * Time: 20:36
 */

namespace common\components;


class Count
{
    public static function create($num=1,$type){
        $model = new \common\models\Count();
        $model->type=$type;
        $model->num=$num;
        $model->created_at=time();
        return $model->save(false);
    }
    
}