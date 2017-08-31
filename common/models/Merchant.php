<?php

namespace common\models;

use backend\models\Salesman;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%merchant}}".
 *
 * @property string $id
 * @property string $name
 * @property integer $phone
 * @property string $address
 * @property string $created_at
 * @property string $updated_at
 * @property string $seleaman
 */
class Merchant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%merchant}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','address','phone'], 'required'],
            [['phone'],'match','pattern'=>'/^((13[0-9])|(15[^4])|(18[0,2,3,5-9])|(17[0-8])|(147))\\d{8}$/'],
            [['phone'], 'integer'],
            [['name'], 'string', 'max' => 30],
            [['address'], 'string', 'max' => 255],
            [['seleaman'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '商家名',
            'phone' => '电话',
            'address' => '地址',
            'created_at' => '创建时间',
            'seleaman' => '业务员',
        ];
    }
    
    /**
     * 获取业务员
     * @return array
     */
    public static function getSalesman(){
        $data  = Salesman::find()->all();
        return ArrayHelper::map($data,'name','name');
    }
}
