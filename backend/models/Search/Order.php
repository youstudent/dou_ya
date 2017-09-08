<?php

namespace backend\models\Search;

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
            [['id', 'order_num', 'order_checking', 'phone', 'sell_all', 'clearing_all', 'sell_all_checking', 'clearing_all_checking', 'order_time'], 'integer'],
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
    public function search($params)
    {
        $query = OrderModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
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
            'phone' => $this->phone,
            'sell_all' => $this->sell_all,
            'clearing_all' => $this->clearing_all,
            'sell_all_checking' => $this->sell_all_checking,
            'clearing_all_checking' => $this->clearing_all_checking,
            'order_time' => $this->order_time,
        ]);

        $query->andFilterWhere(['like', 'order_number', $this->order_number])
            ->andFilterWhere(['like', 'activity_name', $this->activity_name])
            ->andFilterWhere(['like', 'merchant_name', $this->merchant_name])
            ->andFilterWhere(['like', 'order_name', $this->order_name]);

        return $dataProvider;
    }
}
