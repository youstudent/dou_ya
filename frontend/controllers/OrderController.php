<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/4
 * Time: 17:23
 */

namespace frontend\controllers;


use common\models\OrderRefund;

class OrderController extends ObjectController
{
    
    /**
     * 退款详情
     * @return mixed
     */
    public function actionRefund()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $keyword = \Yii::$app->request->post();
        if (!$keyword) {
            return $this->returnAjax(0, '请传退款申请参数');
        }
        $model = new OrderRefund();
        $model->load($keyword, '');
        
        
        //验证该订单号所属的票号有没有验证过
        
        
        //没有验证
        $model->created_at = time(); //申请时间
        $model->updated_at = time();//处理时间
        if ($model->save()) {
            return $this->returnAjax(1, '退款申请成功!等待平台审核');
        }
        return $this->returnAjax(0, $model->getFirstErrors());
    }
    
}