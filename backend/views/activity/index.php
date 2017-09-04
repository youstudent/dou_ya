<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\Activity */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Activities';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-index">

    <h3>活动管首页</h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加活动', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            'merchant_name',
            'activity_name',
            'activity_address',
            [
                'attribute' => 'apply_end_time',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->apply_end_time);   //主要通过此种方式实现
                    },
            ],
            [
                'attribute' => 'start_time',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->start_time);   //主要通过此种方式实现
                    },
            ],
            [
                'attribute' => 'end_time',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->end_time);   //主要通过此种方式实现
                    },
            ],
            'total_price',
            'total_clearing',
            [
                'attribute' => 'status',
                'value'=>function ($model,$key,$index,$column){
                    return $model->status==1?'正常':'停封';
                },
        
                'filter' => Html::activeDropDownList($searchModel,
                    'status',['1'=>'正常','0'=>'停封'],
                    ['prompt'=>'全部','style'=>'height:34px;']
                )
            ],
           // 'phone',
           // 'linkman',
           // 'purchase_limitation',
            //'on_line',
            [
                //动作列yii\grid\ActionColumn
                //用于显示一些动作按钮，如每一行的更新、删除操作。
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view}{update}{delete}',//只需要展示删除和更新
                'headerOptions' => ['width' => '240'],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span', '查看详情', ['class' => "btn btn-xs btn-primary"]), ['view', 'id'=>$model->id]).'&nbsp';
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span', '修改', ['class' => "btn btn-xs btn-success"]), ['update', 'id'=>$model->id]).'&nbsp';
                    },
                    'delete' => function($url, $model, $key){
                        return Html::a('删除',
                            ['delete', 'id' => $model->id],
                            [
                                'class' => 'btn btn-danger btn-xs',
                                'data' => ['confirm' => '确认删除该活动吗？', 'method' => 'post'],
                    
                            ]
                        );
                    },
        
                ],
            ],
        ],
    ]); ?>
</div>
