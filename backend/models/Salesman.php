<?php

namespace backend\models;

use common\models\Merchant;
use Yii;

/**
 * This is the model class for table "{{%salesman}}".
 *
 * @property string $id
 * @property string $name
 * @property string $job_number
 * @property integer $phone
 */
class Salesman extends \yii\db\ActiveRecord
{
    public $num;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%salesman}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name','job_number','phone'], 'required'],
            [['phone'],'match','pattern'=>'/^((13[0-9])|(15[^4])|(18[0,2,3,5-9])|(17[0-8])|(147))\\d{8}$/'],
            [['name','job_number','phone'], 'unique'],
            [['phone'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['job_number'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '业务员姓名',
            'job_number' => '员工号',
            'phone' => '电话',
            'created_at' => '创建时间',
            'bound_merchant' => '绑定商户数',
        ];
    }
    
    /**
     * 业务员绑定商户数量
     * @param $name
     * @return int|string
     */
    public static function select($name){
       return  Merchant::find()->where(['seleaman'=>$name])->count();
    }
}
