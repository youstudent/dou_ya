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
            [['price','settlement'], 'checktagname'],
        ];
    }
    
    
    /**
     * 验证结算价不能大于售价
     * @param $attribute
     * @param $params
     */
    public function checktagname($attribute,$params){
        exit;
        if($this->settlement > $this->price){
            $this->addError($attribute, '结算价不能大于售价');
        }
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
        //支付成功,订单票该为未验票
        OrderTicket::updateAll(['status' => 0], ['order_id' => $order_id]);
    }
}
