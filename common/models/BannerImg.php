<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%banner_img}}".
 *
 * @property string $id
 * @property string $img
 * @property integer $banner_id
 */
class BannerImg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%banner_img}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['banner_id'], 'integer'],
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
            'img' => 'Img',
            'banner_id' => 'Banner ID',
        ];
    }
}
