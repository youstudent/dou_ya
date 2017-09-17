<?php

namespace backend\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Salesman as SalesmanModel;

/**
 * Salesman represents the model behind the search form about `backend\models\Salesman`.
 */
class Salesman extends SalesmanModel
{
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone','bound_merchant'], 'integer'],
            [['name', 'job_number','created_at'], 'safe'],
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
        $query = SalesmanModel::find();

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
            'bound_merchant' => $this->bound_merchant,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'job_number', $this->job_number])
            ->andFilterWhere(['like', 'phone', $this->phone]);

        return $dataProvider;
    }
}
