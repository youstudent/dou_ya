<?php
/**
 * Created by PhpStorm.
 * User: gba12
 * Date: 2017/9/4
 * Time: 17:23
 */

namespace frontend\controllers;


use Codeception\PHPUnit\Constraint\JsonContains;
use common\models\Activity;
use common\models\ActivityData;
use common\models\ActivityTicket;
use common\models\Member;
use common\models\MessageCode;
use common\models\Order;
use common\models\OrderRefund;
use common\models\OrderTicket;
use common\models\Wechat;
use EasyWeChat\Js\Js;
use frontend\models\GetUserInfo;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use PHPUnit\Framework\Constraint\IsFalse;
use rmrevin\yii\fontawesome\FA;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class OrderController extends ObjectController
{
    
    /**
     *  申请退款页面订单数据
     * @return mixed
     */
    public function actionOrderRefund()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, 'POST请求方式');
        }
        $order_id = \Yii::$app->request->post('order_id');
        if (!$order_id){
            return $this->returnAjax(0,'请传订单order_id');
        }
        $data = Order::find()->select(['order_time', 'activity_name', 'sell_all', 'order_number'])->where(['id' => $order_id])->asArray()->one();
        if (!$data) {
            return $this->returnAjax(0, '没有查询到订单详情数据');
        }
        $data['order_time'] = date('Y年m月d日 H:i:s', $data['order_time']);
        return $this->returnAjax(1, '成功', $data);
        
    }
    
    /**
     * 申请退款
     * @return mixed
     */
    public function actionRefund()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请用POST请求方式');
        }
        $keyword = \Yii::$app->request->post();
        if (!$keyword) {
            return $this->returnAjax(0, '请传退款申请参数');
        }
        $model = new OrderRefund();
        $model->load($keyword, '');
        //查询该订单 是否已经申请过退款
        if (Order::find()->where(['id' => $model->order_id, 'status' => 2])->exists()) {
            return $this->returnAjax(0, '该订单不能重复申请退款');
        }
        //验证该订单号所属的票号有没有验证过
        if (OrderTicket::find()->where(['order_id' => $model->order_id, 'status' => 1])->exists()) {
            return $this->returnAjax(0, '该订单已有票种验票,不能进行退款');
        }
        $price = Order::findOne(['id'=>$model->order_id])->sell_all;
       // $price = OrderTicket::find()->select('sum(prize)')->where(['order_id' => $model->order_id, 'status' => 0])->asArray()->one()['sum(prize)'];
        if ($model->money > $price) {
            return $this->returnAjax(0, '退款金额不能大于订单总金额');
        }
        $model->money = $price;
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            //添加退款信息
            $model->created_at = time(); //申请时间
            if ($model->save(false) == false) throw new Exception('申请信息保存失败');
            //改变订单状态
            $order = Order::findOne(['id' => $model->order_id]);
            $order->status = 2;
            if ($order->save(false) == false) throw new Exception('订单状态变更失败');
            //根据订单找到. 票的验证码 改变状态
            if (OrderTicket::updateAll(['status' => 10], ['order_id' => $model->order_id]) == false) throw new Exception('票种验证码状态更新失败');
            $transaction->commit();
            return $this->returnAjax(1, '退款申请成功!等待平台审核');
        } catch (\Exception $e) {
            $transaction->rollBack();
            return $this->returnAjax(0, current($model->getFirstErrors()));
        }
    }
    
    /**
     * 用户下单 加支付
     * @return mixed
     */
    public function actionOrder()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        
        if (!\Yii::$app->request->isPost) {
            return $this->returnAjax(0, '请求方式POST');
        }
        $data = \Yii::$app->request->post();
        $tickets = $data['ticket'];
        //判断该用户有没有绑定手机号
        $member = new Member();
        if(!$member->checkPhone()){
            return $this->returnAjax(1,'请绑定手机号');
        }
        // 查询活动是否在报名截止时间之内和 停封启用状态
        $row = Activity::find()->andWhere(['id' => $data['activity_id'], 'status' => 1])->andWhere(['>=', 'apply_end_time', time()])->asArray()->one();
        if (!$row) {
            return $this->returnAjax(0, '报名时间截止或活动已下线');
        }
        //判断该活动是否还有票种
        $activity = new Activity();
        if (!$activity->check($data)){
            return $this->returnAjax(0,'票已经售完');
        }
        //判断用户 加上当前购买的票种数量是否超过限制数量
        if (!$activity->checkOrderNum($data)){
            return $this->returnAjax(0,$activity->message);
        }
        $order = new Order();
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $order->order_number = $this->getRandChar(12);
            $order->order_num = 1;
            $order->activity_name = $row['activity_name'];
            $order->merchant_name = $row['merchant_name'];
            $order->status = 0;
            $member = Member::findOne(['id' =>GetUserInfo::GetUserId()]);
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
            foreach ($tickets as $value) {
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
                    $OrderTicket->title = $ActivityTicket->title;
                    if ($OrderTicket->save(false) == false) throw new Exception('保存订单票种失败');
                }
            }
            //更新待支付订单 状态:未支付
            $new_order = Order::findOne(['id' => $order->id]);
            $new_order->sell_all = OrderTicket::find()->select('sum(prize)')->where(['order_id' => $order->id, 'status' => 9])->asArray()->one()['sum(prize)'];
            $new_order->clearing_all = OrderTicket::find()->select('sum(settlement)')->where(['order_id' => $order->id, 'status' => 9])->asArray()->one()['sum(settlement)'];
            $new_order->order_num = OrderTicket::find()->where(['order_id' => $order->id])->count();
            if ($new_order->save(false) == false) throw new Exception('订单数据更新失败');
            $transaction->commit();
            $weachat = new Wechat();
            //TODO 要修改的:openid
            // 创建微信支付订单
            $res = $weachat->createWechatOrder($new_order, $this->login_member['openid']);//$this->login_member['openid']
            if ($res !== false) {
                return $this->returnAjax(1, $weachat->message, $res);
            }
            return $this->returnAjax(0, $weachat->message);
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
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        
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
     * 验票
     * @return mixed
     */
    public function actionCheckTicket(){
        if (!\Yii::$app->request->isPost){
            return $this->returnAjax(0,'POST请求方式');
        }
       $data  = \Yii::$app->request->post();
        /**
         *  查找所有未验票的 的票
         */
        $id ='';
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            foreach ($data['code'] as $v){
                //根据 票号查找活动是否
                $row = OrderTicket::findOne(['code'=>$v,'phone'=>$data['phone'],'status'=>0]);
                if (!$row){
                    throw new Exception('验票中有不正确的验证码');
                }
                $id=$row->order_id;
                $row->status=1;
                if ($row->save(false)==false ) throw new \Exception('验票失败');
            }
            $transaction->commit();
            //验票成功后修改该订单已验票的金额[售卖价,结算价]
             OrderTicket::updateOrder($data);
            //验票成功 发送短信给用户
            $MessageCode = new MessageCode();
            $order= Order::findOne(['id'=>$id]);
            if ($MessageCode->send($id)){
                return $this->returnAjax(1,'验证成功,活动名:'.$order->activity_name);
            }
              return $this->returnAjax(1,'验票成功,活动名:'.$order->activity_name);
        } catch (\Exception $e){
            $transaction->rollBack();
            return $this->returnAjax(0,'验票码无效');
        }
        
    }
    
    
    /**
     * 我的电子票号
     * @return mixed
     */
    public function actionEticket()
    {
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        
        $order = new OrderTicket();
        if ($re = $order->select(\Yii::$app->request->post('order_id'))) {
            return $this->returnAjax(1, $order->message, $re);
        }
            return $this->returnAjax(0, $order->message);
        
    }
    
    /**
     * 订单的支付
     * @return mixed
     */
    public function actionPay(){
        if (!GetUserInfo::check()){
            return $this->returnAjax(0, '你被停封了!请联系管理员');
        }
        
        /*return $this->returnAjax(1,'成功',[
            'jsApiConfig' => [
                'appId' => 'xxx',
                'timeStamp' => strval(time()),
                'nonceStr' => uniqid(),
                'package' => "prepay_id=11",
                'signType' => 'MD5',
                'paySign' => 'xxx',
            ],
            'orderData' => [
                'openid'       => 111 ,
                'trade_type'   => 'JSAPI', // JSAPI，NATIVE，APP...
                'body'         => '活动',
                'detail'       => '好的活动',
                'out_trade_no' => 'sfsf',
                'total_fee'    => 112, // 单位：分
                'total_fee'    => 1, // 单位：分
                'notify_url'   => 'http://api.douyajishi.com/wechat/order-notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            ],
        ]);*/
        $order  = new Order();
        //TODO 要修改的:openid
        $re = $order->pay(\Yii::$app->request->post('order_id'),$this->login_member['openid']);
        if ($re !==false){  //$this->login_member['openid']
            return $this->returnAjax(1,'成功',$re);
        }
        if ($order->message!=='success'){
            $re =$order->message;
        }else{
            $re ='微信支付异常, 请稍后再试';
        }
           return $this->returnAjax(0,$re);
        
    }
    
}