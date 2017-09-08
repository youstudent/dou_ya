<?php

namespace common\models;

use Yii;

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
            [['order_num', 'order_checking', 'phone', 'sell_all', 'clearing_all', 'sell_all_checking', 'clearing_all_checking', 'order_time'], 'integer'],
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
        ];
    }
}
