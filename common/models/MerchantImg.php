<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%merchant_img}}".
 *
 * @property string $id
 * @property integer $merchant_id
 * @property string $img
 */
class MerchantImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant_img}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['merchant_id'], 'integer'],
            [['img'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'merchant_id' => 'Merchant ID',
            'img' => 'Img',
        ];
    }
}
