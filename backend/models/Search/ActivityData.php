<?php

namespace backend\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ActivityData as ActivityDataModel;

/**
 * ActivityData represents the model behind the search form about `common\models\ActivityData`.
 */
class ActivityData extends ActivityDataModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['activity_id', 'order_num', 'order_number_num', 'checking_num', 'transaction_money', 'footings', 'checking_transaction_money', 'checking_footings'], 'integer'],
            [['merchant_name','activity_name'],'safe']
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
        $query = ActivityDataModel::find();

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

        // grid filtering conditions
        $query->andFilterWhere([
            'activity_id' => $this->activity_id,
            'order_num' => $this->order_num,
            'order_number_num' => $this->order_number_num,
            'checking_num' => $this->checking_num,
            'transaction_money' => $this->transaction_money,
            'footings' => $this->footings,
            'checking_transaction_money' => $this->checking_transaction_money,
            'checking_footings' => $this->checking_footings,
            'merchant_name' => $this->merchant_name,
            'activity_name' => $this->activity_name,
        ]);
        $query->andFilterWhere(['like', 'merchant_name', $this->merchant_name])
        ->andFilterWhere(['like', 'activity_name', $this->activity_name]);
        return $dataProvider;
    }
}
