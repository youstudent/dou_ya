<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%activity_ticket}}".
 *
 * @property string $id
 * @property integer $activity_id
 * @property integer $price
 * @property integer $settlement
 * @property integer $return
 */
class ActivityTicket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity_ticket}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['price','title','settlement'], 'required'],
            [['activity_id', 'price', 'settlement', 'return'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'activity_id' => 'Activity ID',
            'price' => '售价',
            'settlement' => '结算价',
            'return' => '毛利润',
        ];
    }
    
    /**
     * 更新 订单状态
     * @param $order_id
     */
    public function Status($order_id){
        OrderTicket::updateAll(['status' => 9], ['order_id' => $order_id]);
    }
}
