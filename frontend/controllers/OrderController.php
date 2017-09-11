<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/4
 * Time: 17:23
 */

namespace frontend\controllers;


use common\models\Order;
use common\models\OrderRefund;
use rmrevin\yii\fontawesome\FA;
use yii\db\Exception;

class OrderController extends ObjectController
{
    
    /**
     * 申请退款
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
        
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            //添加退款信息
            $model->created_at = time(); //申请时间
            if ($model->save() == false) throw new Exception('申请信息保存失败');
            //改变订单状态
            $order = Order::findOne(['id' => $model->order_id]);
            $order->status = 2;
            if ($order->save(false) == false) throw new Exception('订单状态变更失败');
            $transaction->commit();
            return $this->returnAjax(1, '退款申请成功!等待平台审核');
        } catch (\Exception $e) {
            $transaction->rollBack();
            return $this->returnAjax(0, current($model->getFirstErrors()));
        }
    }
    
    /**
     * 用户下单
     */
    public function actionOrder()
    {
    
    
    }
    
    
}