<?php

namespace backend\models\search;


use common\models\Count;
use yii\base\Model;

class CountSearch extends Model
{
    public $start;  //开始日期
    public $end;    //结束日期

    //验证规则
    public function rules()
    {
        return [
            [['start','end'],'required','message'=>''],
            [['start','end'],'string'],
        ];
    }

    //字段名
    public function attributeLabels()
    {
        return [
          'start'=>'开始日期:',
          'end'=>'结束日期:'
        ];
    }

    //搜索
    public function search(){
        $query = Count::find();
        $this->load(\Yii::$app->request->get());
        if ($this->start && $this->end){
            $start = strtotime($this->start);
            $end = strtotime($this->end);
            $query->andWhere(['>=','created_at',$start]);
            $query->andWhere(['<=','created_at',$end]);
        }
        //查询订单数
        $order_num = $query->andWhere(['type'=>1])->count();
        //活动数
        $activity_num = $query->andWhere(['type'=>2])->count();
        //流水
        $water = $query->select(['sum(num)'])->andWhere(['type'=>3])->asArray()->one()['sum(num)'];
        //结算
        $money = $query->select(['sum(num)'])->andWhere(['type'=>4])->asArray()->one()['sum(num)'];
        //利润
        $return = $query->select(['sum(num)'])->andWhere(['type'=>5])->asArray()->one()['sum(num)'];
        $data['order_num']=$order_num?$order_num:0;
        $data['activity_num']=$activity_num?$activity_num:0;
        $data['water']=$water?$water:0;
        $data['money']=$money?$money:0;
        $data['return']=$return?$return:0;
        return $data;
    }


}