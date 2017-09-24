<?php

namespace backend\models\Search;

use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order as OrderModel;

/**
 * Order represents the model behind the search form about `common\models\Order`.
 */
class Order extends OrderModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'order_num', 'order_checking', 'phone', 'sell_all', 'clearing_all', 'sell_all_checking', 'clearing_all_checking'], 'integer'],
            [['order_time'], 'string'],
            [['order_number', 'activity_name', 'merchant_name', 'order_name','status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function searchs($params)
    {
        $query = OrderModel::find()->orderBy('order_time DESC');
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => Yii::$app->params['pageSize'],],
        ]);
        
        $this->load($params);
        $this->status=[1,4];
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //格式化时间  已支付和退款被拒绝的
        if ($this->order_time){
            $start_date = substr($this->order_time,0,17);
            $start = strtotime($start_date);
        
            if($start > 0){
                $query->andFilterWhere(['>=','order_time',$start]);
            }
        
            $end_date =  substr($this->order_time,19);
            $end = strtotime($end_date);
            if($end > 0){
                $query->andFilterWhere(['<=','order_time',$end]);
            }
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'status'=>$this->status,
            'order_num' => $this->order_num,
            'order_checking' => $this->order_checking,
            'sell_all' => $this->sell_all,
            'clearing_all' => $this->clearing_all,
            'sell_all_checking' => $this->sell_all_checking,
            'clearing_all_checking' => $this->clearing_all_checking,
        ]);
        
        $query->andFilterWhere(['like', 'order_number', $this->order_number])
            ->andFilterWhere(['like', 'activity_name', $this->activity_name])
            ->andFilterWhere(['like', 'merchant_name', $this->merchant_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'order_name', $this->order_name]);
        
        return $dataProvider;
    }
    
    public function searchss($params)
    {
        $query = OrderModel::find()->orderBy('order_time DESC');
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => Yii::$app->params['pageSize'],],
        ]);
        
        $this->load($params);
        
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        //格式化时间
        if ($this->order_time){
            $start_date = substr($this->order_time,0,17);
            $start = strtotime($start_date);
        
            if($start > 0){
                $query->andFilterWhere(['>=','order_time',$start]);
            }
        
            $end_date =  substr($this->order_time,19);
            $end = strtotime($end_date);
            if($end > 0){
                $query->andFilterWhere(['<=','order_time',$end]);
            }
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'status'=>$this->status,
            'order_num' => $this->order_num,
            'order_checking' => $this->order_checking,
            'sell_all' => $this->sell_all,
            'clearing_all' => $this->clearing_all,
            'sell_all_checking' => $this->sell_all_checking,
            'clearing_all_checking' => $this->clearing_all_checking,
        ]);
        
        $query->andFilterWhere(['like', 'order_number', $this->order_number])
            ->andFilterWhere(['like', 'activity_name', $this->activity_name])
            ->andFilterWhere(['like', 'merchant_name', $this->merchant_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'order_name', $this->order_name]);
        
        return $dataProvider;
    }
    
    
    
    public function search($params)
    {
        $query = OrderModel::find()->orderBy('order_time DESC');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => Yii::$app->params['pageSize'],],
        ]);

        $this->load($params);
        $this->status=[3,4];
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'status'=>$this->status,
            'order_num' => $this->order_num,
            'order_checking' => $this->order_checking,
            'sell_all' => $this->sell_all,
            'clearing_all' => $this->clearing_all,
            'sell_all_checking' => $this->sell_all_checking,
            'clearing_all_checking' => $this->clearing_all_checking,
            'order_time' => $this->order_time,
        ]);

        $query->andFilterWhere(['like', 'order_number', $this->order_number])
            ->andFilterWhere(['like', 'activity_name', $this->activity_name])
            ->andFilterWhere(['like', 'merchant_name', $this->merchant_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'order_name', $this->order_name]);

        return $dataProvider;
    }
}
