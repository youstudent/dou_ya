<?php

namespace common\models;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Yii;

/**
 * This is the model class for table "{{%activity_data}}".
 *
 * @property string $id
 * @property integer $activity_id
 * @property integer $order_num
 * @property integer $order_number_num
 * @property integer $checking_num
 * @property integer $transaction_money
 * @property integer $footings
 * @property integer $checking_transaction_money
 * @property integer $checking_footings
 */
class ActivityData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'order_num', 'order_number_num', 'checking_num', 'transaction_money', 'footings', 'checking_transaction_money', 'checking_footings'], 'integer'],
            [['merchant_name','activity_name'],'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'activity_id' => '活动ID',
            'order_num' => '订单数',
            'order_number_num' => '订单人数',
            'checking_num' => '验票数',
            'transaction_money' => '交易总额',
            'footings' => '结算总额',
            'checking_transaction_money' => '交易总额[已验票]',
            'checking_footings' => '结算总额[已验票]',
            'merchant_name' => '商家名',
            'activity_name' => '活动名',
        ];
    }
    
    /**
     *  和活动建立一对一的关系
     */
    public function getActivity(){
        return $this->hasOne(Activity::className(),['id'=>'activity_id']);
    }
    
    
    /**
     * 更新活动的数据
     * @param $new_orde
     */
    public function edit($new_order){
       $data =  ActivityData::findOne(['activity_id'=>$new_order['activity_id']]);
       $data-> order_num =$data-> order_num+1;
       $data-> order_number_num =OrderTicket::find()->where(['order_id'=>$new_order['id']])->count();
       $data-> transaction_money =$data-> transaction_money+$new_order['sell_all'];
       $data-> footings =$data-> footings+$new_order['clearing_all'];
       return $data->save(false);
       
    }
}
