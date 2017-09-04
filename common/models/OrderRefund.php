<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%order_refund}}".
 *
 * @property string $id
 * @property integer $order_id
 * @property integer $money
 * @property string $pass_reason
 * @property string $no_reason
 * @property string $bank_card
 * @property string $opening_bank
 * @property string $opening_man
 * @property integer $created_at
 * @property integer $updated_at
 */
class OrderRefund extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%order_refund}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id','money','pass_reason','bank_card','opening_bank','opening_man'],'required'],
            [['order_id', 'money', 'created_at', 'updated_at'], 'integer'],
            [['pass_reason', 'no_reason'], 'string', 'max' => 255],
            [['bank_card', 'opening_bank', 'opening_man'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' =>'订单号',
            'money' => '退款金额',
            'pass_reason' => '退款原因',
            'no_reason' => '拒绝原因',
            'bank_card' => '银行卡号',
            'opening_bank' => '开户行',
            'opening_man' => '开户人',
            'created_at' => '申请时间',
            'updated_at' => '处理时间',
        ];
    }
}
