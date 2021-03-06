<?php

namespace common\models;

use PHPUnit\Framework\Constraint\IsFalse;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%order}}".
 *
 * @property string $id
 * @property string $order_number
 * @property string $activity_name
 * @property string $merchant_name
 * @property string $order_name
 * @property integer $order_num
 * @property integer $order_checking
 * @property integer $phone
 * @property integer $sell_all
 * @property integer $clearing_all
 * @property integer $sell_all_checking
 * @property integer $clearing_all_checking
 * @property integer $order_time
 */
class Order extends \yii\db\ActiveRecord
{
    public $message ='success';  //保存信息
    public $ticket;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_num', 'order_checking', 'phone', 'sell_all', 'clearing_all', 'sell_all_checking', 'clearing_all_checking', 'order_time','pay_time'], 'integer'],
            [['order_number'], 'string', 'max' => 100],
            [['activity_name', 'merchant_name', 'order_name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_number' => '订单号',
            'activity_name' => '活动名',
            'merchant_name' => '商家名',
            'order_name' => '下单人',
            'order_num' => '下单数量',
            'order_checking' => '验票数',
            'phone' => '电话',
            'sell_all' => '售卖总额',
            'clearing_all' => '结算总额',
            'sell_all_checking' => '售卖总额(已验票)',
            'clearing_all_checking' => '结算总额(已验票)',
            'order_time' => '下单时间',
            'status' => '状态',
            'ticket' => '票验证码',
            'user_id' => '票验证码',
            'pay_time' => '支付时间',
            'activity_id' => '活动编号',
        ];
    }
    
    
    /**
     * 订单的支付
     * @param $order_id $openid
     * @return bool
     */
    public function pay($order_id, $openid)
    {
        if (empty($order_id)) {
            $this->message = '请传订单信息';
            return false;
        }
        //找出订单进行支付
        $order = Order::find()->where(['id' => $order_id, 'status' => 0])->asArray()->one();
        if (!$order) {
            $this->message = '该订单不能重复支付';
            return false;
        }
        //查询该订单的活动是否在报名截止时间之类
        $data = Activity::find()->where(['id' => $order['activity_id']])->one();
        if (!$data) {
            $this->message = '该活动已下线';
            return false;
        }
        if ($data->status !== 1) {
            $this->message = '该活动已下线';
            return false;
        }
        if ($data->apply_end_time < time()) {
            $this->message = '该活动时间报名截止';
            return false;
        }
        //查询票种是否还够  查询该活动的票种
        $orders = Order::find()->andWhere(['activity_id'=>$data->id])->asArray()->all();
        $ids = ArrayHelper::map($orders,'id','id');
        $num = OrderTicket::find()->where(['order_id'=>$ids,'status'=>[0,1,10]])->count();
        if ($num>=$data->on_line) {
            $this->message = '该票已售卖完';
            return false;
        }
        
        $Wechat = new Wechat();
        $res = $Wechat->createWechatOrder($order, $openid);
        return $res;
        
    }
}
