<?php

namespace common\models;

use Yii;

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
    /*'title' => string '票品' (length=6)
'price' => string '100' (length=3)
'settlement*/
    public $title1;
    public $price1;
    public $settlement1;
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
            'title1' => '标题',
            'activity_id' => 'Activity ID',
            'price' => '售价',
            'price1' => '售价',
            'settlement1' => '结算价',
            'settlement' => '结算价',
            'return' => '毛利润',
        ];
    }
    
    public function add($data){
        foreach ($data as $key=>$value){
            
            var_dump($key);exit;
        }
    }
}
