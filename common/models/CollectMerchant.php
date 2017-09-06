<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%collect_merchant}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $merchant_id
 * @property integer $created_at
 */
class CollectMerchant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%collect_merchant}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'merchant_id'], 'required'],
            [['id', 'user_id', 'merchant_id', 'created_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '用户ID',
            'merchant_id' => '商家ID',
            'created_at' => '收藏时间',
        ];
    }
}
