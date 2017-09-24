<?php

namespace backend\models\Search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Member as MemberModel;

/**
 * Member represents the model behind the search form about `common\models\Member`.
 */
class Member extends MemberModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'last_time', 'status', 'order_num', 'order_money'], 'integer'],
            [['name', 'sex', 'identification'], 'safe'],
            [['phone'],'integer','message'=>''],
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
        $query = MemberModel::find()->orderBy('created_at DESC');

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
            'id' => $this->id,
            'last_time' => $this->last_time,
            'status' => $this->status,
            'order_num' => $this->order_num,
            'order_money' => $this->order_money,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'identification', $this->identification]);

        return $dataProvider;
    }
}
