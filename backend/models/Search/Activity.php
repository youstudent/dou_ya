<?php

namespace backend\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Activity as ActivityModel;

/**
 * Activity represents the model behind the search form about `common\models\Activity`.
 */
class Activity extends ActivityModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'apply_end_time', 'start_time', 'end_time', 'phone', 'purchase_limitation', 'on_line', 'created_at','status'], 'integer'],
            [['merchant_name', 'activity_name', 'activity_img', 'activity_address', 'linkman', 'content'], 'safe'],
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
        $query = ActivityModel::find();

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
            'id' => $this->id,
            'apply_end_time' => $this->apply_end_time,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'phone' => $this->phone,
            'purchase_limitation' => $this->purchase_limitation,
            'on_line' => $this->on_line,
            'created_at' => $this->created_at,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'merchant_name', $this->merchant_name])
            ->andFilterWhere(['like', 'activity_name', $this->activity_name])
            ->andFilterWhere(['like', 'activity_img', $this->activity_img])
            ->andFilterWhere(['like', 'activity_address', $this->activity_address])
            ->andFilterWhere(['like', 'linkman', $this->linkman])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
