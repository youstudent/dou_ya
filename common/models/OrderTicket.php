<?php

namespace common\models;

use Codeception\Exception\ElementNotFound;
use Yii;

/**
 * This is the model class for table "{{%order_ticket}}".
 *
 * @property string $id
 * @property string $phone
 * @property integer $user_id
 * @property integer $code
 * @property integer $activity_tivket_id
 * @property integer $created_at
 * @property integer $status
 * @property integer $order_id
 */
class OrderTicket extends \yii\db\ActiveRecord
{
    public $message;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_ticket}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone'], 'required'],
            [['user_id', 'code', 'activity_tivket_id', 'created_at', 'status',], 'integer'],
            [['phone'], 'string', 'max' => 11],
            [['prize','settlement','title','order_id'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => '手机号码',
            'user_id' => '用户ID',
            'code' => '验证码',
            'activity_tivket_id' => '票种ID',
            'created_at' => '创建时间',
            'status' => '状态',
            'order_id' => '订单ID',
            'prize'=>'售卖价格',
            'settlement'=>'结算价格',
            'title'=>'票种名字',
        ];
    }
    
    /**
     * 查询订单的电子票号
     * @param $order_id
     * @return bool|array
     */
    public function select($order_id)
    {
        if (empty($order_id)) {
            $this->message = '没有接收到订单ID';
            return false;
        }
        $data = Order::find()->select(['activity_name','merchant_name','activity_id'])->where(['id' => $order_id, 'status' => [1,4]])->asArray()->one();
        if (!$data) {
            $this->message = '没有该订单,或者订单是支付状态';
            return false;
        }
        //查询活动地点
        $Activity  = Activity::find()->select(['activity_address','start_time','end_time'])->where(['id'=>$data['activity_id']])->asArray()->one();
        $data['activity_address'] = $Activity['activity_address'];
        $data['start_time'] = date('Y年m月d日',$Activity['start_time']);
        $data['end_time'] = date('Y年m月d日',$Activity['end_time']);
        $datas = OrderTicket::find()->select(['phone','code','created_at','title','status','prize'])->where(['order_id'=>$order_id])->asArray()->all();
        foreach ($datas as $key=>&$value){
            $value['created_at']=date('Y年m月d日',$value['created_at']);
        }
        $data['ticket']=$datas;
        return $data;
    }
    
    
    /**
     * 修改该订单的已验票的 金额
     * @param $data
     * @return bool
     */
    public static function updateOrder($data){
      //更新该订单的数据
      $rows  =   self::find()->where(['phone'=>$data['phone'],'code'=>$data['code']])->asArray()->all();
      foreach ($rows as $key=>$value){
         $order=   Order::findOne(['id'=>$value['order_id']]);
         $order->sell_all_checking=$order->sell_all_checking+$value['prize'];
         $order->clearing_all_checking=$order->clearing_all_checking+$value['settlement'];
         $order->order_checking=$order->order_checking+1;
         $re = ActivityData::findOne(['activity_id'=>$order->activity_id]);
         $re->checking_transaction_money= $re->checking_transaction_money+$value['prize'];;
         $re->checking_footings= $re->checking_footings+$value['settlement'];
         $re->checking_num= $re->checking_num+1;
         $re->save(false);
         $order->save(false);
      }
        return true;
    }
}
