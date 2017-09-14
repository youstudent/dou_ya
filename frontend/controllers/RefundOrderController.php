<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/6
 * Time: 10:35
 */

namespace frontend\controllers;


use Behat\Gherkin\Loader\YamlFileLoader;
use common\components\GetUserInfo;
use common\models\Activity;
use common\models\Order;
use common\models\OrderRefund;
use PHPUnit\Framework\Constraint\IsFalse;

class RefundOrderController extends ObjectController
{
    /**
     * 查询我的退款订单
     * @return mixed
     */
    public function actionRefund()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请使用POST方式');
        }
        $user_id = GetUserInfo::actionGetUserId();
        //查询用户退款订单
        $data = Order::find()->select(['order_number', 'activity_name', 'status', 'id','activity_id'])->where(['user_id' => $user_id, 'status' => [2, 3, 4]])->asArray()->all();
        if (!$data) {
            return $this->returnAjax(0, '没有退款信息');
        }
        foreach ($data as $key => &$v) {
            if ($rows = Activity::findOne(['id'=>$v['activity_id']])){
                $v['activity_img'] = $rows->activity_img;
            }
            if ($row = OrderRefund::findOne(['order_id' => $v['id']])) {
                $v['created_at'] = date('Y年m月d日', $row->created_at);
                $v['money'] = $row->money;
            }
           /* if ($v['status'] == 2) {
                $v['status'] = '待处理';
            }
            if ($v['status'] == 3) {
                $v['status'] = '退款通过';
            }
            if ($v['status'] == 4) {
                $v['status'] = '拒绝退款';
            }*/
            
        }
        return $this->returnAjax(1, '成功', $data);
        
    }
    
    
    /**
     * 查询我的订单详情
     * @return mixed
     */
    public function actionRefundDetail()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请使用POST方式');
        }
        $order_id = \Yii::$app->request->post('order_id');
        if (!$order_id ) {
            return $this->returnAjax(0, '请传order_id参数或者user_id');
        }
        //查询用户退款订单
        $data = Order::find()->select(['order_number', 'activity_name', 'status', 'id'])->where(['id' => $order_id])->asArray()->one();
        if (!$data) {
            return $this->returnAjax(0, '查询到退款详情');
        }
        if ($row = OrderRefund::findOne(['order_id' => $order_id])) {
            $data['created_at'] = date('Y年m月d日 H:i:s', $row->created_at);
            $data['money'] = $row->money;
            $data['no_reason'] = $row->no_reason;
        }
       /* if ($data['status'] == 2) {
            $data['status'] = '待处理';
        }
        if ($data['status'] == 3) {
            $data['status'] = '退款通过';
        }
        if ($data['status'] == 4) {
            $data['status'] = '拒绝退款';
        }*/
        return $this->returnAjax(1, '成功', $data);
        
    }
    
    
}