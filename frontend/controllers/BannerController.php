<?php

namespace frontend\controllers;

use backend\models\Search\Banner;
use common\models\BannerImg;
use yii\helpers\ArrayHelper;

class BannerController extends ObjectController
{
    /**
     *  banner图片
     * @return string
     */
    public function actionIndex()
    {
        $row = Banner::find()->select('id,title')->orderBy('created_at DESC')->asArray()->one();
        if ($row){
            //查询banner图片
            $data = BannerImg::find()->select('img,id')->where(['banner_id'=>$row['id']])->asArray()->all();
            foreach ($data as $key=>&$value){
                $value['img']=\Yii::$app->params['img_domain'].$value['img'];
            }
            $row['imgs']=$data;
          return $this->returnAjax(1,'成功',$row);
        }
          return $this->returnAjax(0,'暂未上传banner图片');
    }

}
