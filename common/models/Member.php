<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property string $id
 * @property string $name
 * @property string $sex
 * @property integer $phone
 * @property integer $last_time
 * @property integer $status
 * @property string $identification
 * @property integer $order_num
 * @property integer $order_money
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['phone'], 'required','on'=>'update'],
            [['phone', 'last_time', 'status', 'order_num', 'order_money'], 'integer'],
            [['name', 'identification'], 'string', 'max' => 20],
            [['sex'], 'string', 'max' => 10],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => '用户名',
            'sex' => '性别',
            'phone' => '电话',
            'last_time' => '最后登录时间',
            'status' => '状态',
            'identification' => '认证',
            'order_num' => '下单量',
            'order_money' => '下单总金额',
        ];
    }
    
   
}
