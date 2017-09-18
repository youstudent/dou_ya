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
            [['merchant_id','id', 'apply_end_time', 'end_time', 'phone', 'purchase_limitation', 'on_line', 'created_at','status','total_clearing','total_price'], 'integer'],
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
        if ($this->id==1){
            $query->andWhere(['>','end_time',time()]);
        }else{
            $query->andWhere(['<','end_time',time()]);
        }
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $start='';
        $end = '';
        //格式化时间
        if ($this->start_time){
            $start_date = substr($this->start_time,0,10);
            $start = strtotime($start_date);
            $end_date =  substr($this->start_time,12);
            $end = strtotime($end_date);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'apply_end_time' => $this->apply_end_time,
            'merchant_id' => $this->merchant_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'phone' => $this->phone,
            'purchase_limitation' => $this->purchase_limitation,
            'on_line' => $this->on_line,
            'created_at' => $this->created_at,
            'status' => $this->status,
        ])->andFilterWhere(['>=','start_time',$start])->andFilterWhere(['<=','start_time',$end]);

        $query->andFilterWhere(['like', 'merchant_name', $this->merchant_name])
            ->andFilterWhere(['like', 'activity_name', $this->activity_name])
            ->andFilterWhere(['like', 'activity_img', $this->activity_img])
            ->andFilterWhere(['like', 'activity_address', $this->activity_address])
            ->andFilterWhere(['like', 'linkman', $this->linkman])
            ->andFilterWhere(['like', 'total_clearing', $this->total_clearing])
            ->andFilterWhere(['total_price', 'linkman', $this->total_price])
            ->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
