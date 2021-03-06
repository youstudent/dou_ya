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
            [['merchant_id', 'phone', 'purchase_limitation', 'on_line', 'created_at','total_clearing','total_price'], 'integer'],
            [['start_time'], 'string'],
            [['merchant_name', 'activity_name', 'activity_img', 'activity_address', 'linkman', 'content','status','id'], 'safe'],
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
       // var_dump($params);EXIT;
        $query = ActivityModel::find()->orderBy('created_at DESC');
        
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
        if ($this->start_time){
            $start_date = substr($this->start_time,0,17);
            $start = strtotime($start_date);

            if($start > 0){
                $query->andFilterWhere(['>=','start_time',$start]);
            }

            $end_date =  substr($this->start_time,19);
            $end = strtotime($end_date);
            if($end > 0){
                $query->andFilterWhere(['<=','start_time',$end]);
            }
        }else{
           // if ($this->id==1){
                $query->andWhere(['>','end_time',time()]);
           /// }else{
                //$query->andWhere(['<','end_time',time()]);
           // }
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'apply_end_time' => $this->apply_end_time,
            'merchant_id' => $this->merchant_id,
            'phone' => $this->phone,
            'purchase_limitation' => $this->purchase_limitation,
            'on_line' => $this->on_line,
            'status' => $this->status,
        ]);
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
    
    
    public function searchs($params)
    {
        // var_dump($params);EXIT;
        $query = ActivityModel::find()->orderBy('created_at DESC');
        
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
        if ($this->start_time){
            $start_date = substr($this->start_time,0,17);
            $start = strtotime($start_date);
            
            if($start > 0){
                $query->andFilterWhere(['>=','start_time',$start]);
            }
            
            $end_date =  substr($this->start_time,19);
            $end = strtotime($end_date);
            if($end > 0){
                $query->andFilterWhere(['<=','start_time',$end]);
            }
        }else{
           $query->andWhere(['<','end_time',time()]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'apply_end_time' => $this->apply_end_time,
            'merchant_id' => $this->merchant_id,
            'phone' => $this->phone,
            'purchase_limitation' => $this->purchase_limitation,
            'on_line' => $this->on_line,
            'status' => $this->status,
        ]);
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
