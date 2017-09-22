<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%count}}".
 *
 * @property string $id
 * @property integer $num
 * @property integer $type
 * @property integer $created_at
 */
class Count extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%count}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['num','created_at','type'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num' => '订单数量',
            'created_at' => '创建时间',
            'type' => '类型',
        ];
    }
    
    /**
     * 统计所有数据
     */
    public function count(){
        //查询总订单数
        $order_num = self::find()->where(['type'=>1])->count();
        //活动总活动数
        $activity_num = self::find()->where(['type'=>2])->count();
        //流水
        $water = self::find()->select(['sum(num)'])->where(['type'=>3])->asArray()->one()['sum(num)'];
        //总金额
        $money = self::find()->select(['sum(num)'])->where(['type'=>4])->asArray()->one()['sum(num)'];
        //利润
        $return = self::find()->select(['sum(num)'])->where(['type'=>5])->asArray()->one()['sum(num)'];
        //用户数
        $user = self::find()->where(['type'=>6])->count();
        //商户数
        $merchant = self::find()->where(['type'=>7])->count();
        //正在进行的活动
        $in_activity =  Activity::find()->where(['and',['<','start_time',time()],['>','end_time',time()]])->count();
        //查询历史活动
        $activity_history =  Activity::find()->where(['<','end_time',time()])->count();
        $data['order_num']=$order_num?$order_num:0;
        $data['activity_num']=$activity_num?$activity_num:0;
        $data['water']=$water?$water:0;
        $data['money']=$money?$money:0;
        $data['return']=$return?$return:0;
        $data['user']=$user?$user:0;
        $data['merchant']=$merchant?$merchant:0;
        $data['in_activity']=$in_activity;
        $data['activity_history']=$activity_history;
        return  $data;
    }
    
    
    public static function merchant(){
       return  Merchant::find()->count();
     }
    
}
