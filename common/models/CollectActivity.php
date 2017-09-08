<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%collect_activity}}".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $activity_id
 * @property integer $created_at
 */
class CollectActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%collect_activity}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','activity_id'],'required'],
            [['user_id', 'activity_id', 'created_at'], 'integer'],
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
            'activity_id' => '活动ID',
            'created_at' => '收藏时间',
        ];
    }
}
