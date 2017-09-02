<?php

namespace frontend\controllers;

use backend\models\Search\Banner;
use yii\helpers\ArrayHelper;

class BannerController extends ObjectController
{
    /**
     *  banner图片
     * @return string
     */
    public function actionIndex()
    {
        $row = Banner::find()->orderBy('created_at DESC')->one();
        if ($row){
            $data =[];
            foreach ($row->img as $value){
                $data[]=$value['img'];
            }
            $data['title']=$row->title;
          return $this->returnAjax(1,'成功',$data);
        }
          return $this->returnAjax(0,'暂未上传banner图片');
    }

}
