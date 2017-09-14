<?php

namespace common\models;

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
            [['user_id', 'code', 'activity_tivket_id', 'created_at', 'status', 'order_id'], 'integer'],
            [['phone'], 'string', 'max' => 11],
            [['prize','settlement'],'safe']
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
        ];
    }
}
