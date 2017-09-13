<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/4
 * Time: 17:23
 */

namespace frontend\controllers;


use common\components\GetUserInfo;
use common\models\Activity;
use common\models\ActivityTicket;
use common\models\Member;
use common\models\MessageCode;
use common\models\Order;
use common\models\OrderRefund;
use common\models\OrderTicket;
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
        if (OrderTicket::find()->where(['order_id' => $model->order_id, 'status' => 1])->exists()) {
            return $this->returnAjax(0, '该订单已有票种验票,不能进行退款');
        }
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
     * @return mixed
     */
    public function actionOrder()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请求方式POST');
        }
        $data = \Yii::$app->request->post();
        $order = new Order();
        
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            // 查询活动是否在报名截止时间之内和 停封启用状态
            $row = Activity::find()->andWhere(['id' => $data['activity_id'], 'status' => 1])->andWhere(['>=', 'apply_end_time', time()])->asArray()->one();
            if (!$row) {
                return $this->returnAjax(0, '报名时间截止或活动已下线');
            }
            $order->order_number = $this->getRandChar(12);
            $order->order_num = 1;
            $order->activity_name = $row['activity_name'];
            $order->merchant_name = $row['merchant_name'];
            $member = Member::findOne(['id' => GetUserInfo::actionGetUserId()]);
            if (!$member) {
                return $this->returnAjax(0, '没有查询到用户信息');
            }
            $order->order_name = $member->name;
            $order->phone = $member->phone;
            $order->order_time = time();
            $order->activity_id = $row['id'];
            $order->user_id = $member->id;
            if ($order->save(false) == false) throw new Exception('保存订单失败');
            //保存票种
            $t = [
                ['id' => 5, 'num' => 2],
                ['id' => 6, 'num' => 2],
            ];
            
            foreach ($t as $value) {
                $ActivityTicket = ActivityTicket::findOne(['id' => $value['id']]);
                for ($i = 1; $i <= $value['num']; $i++) {
                    $OrderTicket = new OrderTicket();
                    $OrderTicket->order_id = $order->id;
                    $OrderTicket->user_id = $member->id;
                    $OrderTicket->phone = $member->phone;
                    $OrderTicket->code = $this->getRand(8);
                    $OrderTicket->activity_tivket_id = $value['id'];
                    $OrderTicket->created_at = time();
                    $OrderTicket->prize = $ActivityTicket->price;
                    $OrderTicket->settlement = $ActivityTicket->settlement;
                    if ($OrderTicket->save() == false) throw new Exception('保存订单票种失败');
                }
            }
            $new_order = Order::findOne(['id' => $order->id]);
            $new_order->sell_all = OrderTicket::find()->select('sum(prize)')->where(['order_id' => $order->id, 'status' => 0])->asArray()->one()['sum(prize)'];
            $new_order->clearing_all = OrderTicket::find()->select('sum(settlement)')->where(['order_id' => $order->id, 'status' => 0])->asArray()->one()['sum(settlement)'];
            $new_order->order_num = OrderTicket::find()->where(['order_id' => $order->id])->count();
            if ($new_order->save(false) == false) throw new Exception('订单数据更新失败');
            $transaction->commit();
            //订单提交后台
            return $this->redirect('/order/pay');
           // return $this->returnAjax(1, '下单成功等待支付');
        } catch (\Exception $e) {
            $transaction->rollBack();
            return $this->returnAjax(0, current($order->getFirstErrors()));
        }
    }
    
    
    /**
     * 用户删除订单
     * @return mixed
     */
    public function actionDel()
    {
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $order_id = \Yii::$app->request->post();
        if (!$order_id) {
            return $this->returnAjax(0, '请传订单id');
        }
        $order = Order::findOne(['id' => $order_id]);
        if ($order) {
            $order->status = 5;  //逻辑删除订单
            return $order->save(false) ? $this->returnAjax(1, '删除成功') : $this->returnAjax(0, '删除失败');
        }
        return $this->returnAjax(0, '订单未找到');
    }
    
    /**
     *  生成订单号
     * @param $length
     * @return null|string
     */
    function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $max = strlen($strPol)-1;
        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        
        return $str;
    }
    
    /**
     *  验票码
     * @param $length
     * @return null|string
     */
    function getRand($length){
        $str = null;
        $strPol = "0123456789";
        $max = strlen($strPol)-1;
        for($i=0;$i<$length;$i++){
            $str.=$strPol[rand(0,$max)];//rand($min,$max)生成介于min和max两个数之间的一个随机整数
        }
        
        return $str;
    }
    
    /**
     *  下单成功后,,支付订单
     */
    public function actionPay(){
        echo '下单成功等待支付';
        //支付成功发送短信给用户
    }
    
    
    
    
    
    public function actionCheckTicket(){
        if (!\Yii::$app->request->isPost){
            return $this->returnAjax(0,'POST请求方式');
        }
       // $data  = \Yii::$app->request->post();
        $data =[
          'phone'=>13219890986,
            'code'=>['52885879']
            
        ];
        /**
         *  查找所有未验票的 的票
         */
        $id ='';
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($data['code'] as $v){
                $row = OrderTicket::findOne(['code'=>$v,'phone'=>$data['phone'],'status'=>0]);
                if (!$row){
                    throw new Exception('验票中有不正确的验证码');
                }
                $id=$row->order_id;
                $row->status=1;
                if ($row->save(false)==false ) throw new \Exception('验票失败');
            }
            $transaction->commit();
            //验票成功 发送短信给用户
            $MessageCode = new MessageCode();
            $MessageCode->send($id);
        } catch (\Exception $e){
            $transaction->rollBack();
            return $this->returnAjax(0,'验票码无效');
        }
        
        
    }
    
    
    
}