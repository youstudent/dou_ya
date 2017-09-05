<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%message_code}}".
 *
 * @property string $id
 * @property string $phone
 * @property string $code
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class MessageCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone', 'code', 'created_at'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['phone', 'code'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'phone' => 'Phone',
            'code' => 'Code',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
