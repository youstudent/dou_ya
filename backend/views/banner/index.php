<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\Banner */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="banner-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建banner', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',
            [
                'format' => 'raw',
                'label'=>'图片',
                'value'=>function($m){
                    foreach ($m->img as $value){
                        return Html::img('@web/'.$value->img,['width'=> '50px', 'height'=> '50px']
                        );
                    }
                }
            ],
            [
                'attribute' => 'created_at',
                'label'=>'创建时间',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->created_at);   //主要通过此种方式实现
                    },
            ],
            
            [
                //动作列yii\grid\ActionColumn
                //用于显示一些动作按钮，如每一行的更新、删除操作。
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{view}{update}{delete}',//只需要展示删除和更新
                'headerOptions' => ['width' => '240'],
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span', '查看详情', ['class' => "btn btn-xs btn-primary"]), ['view', 'id'=>$model->id]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span', '修改', ['class' => "btn btn-xs btn-success"]), ['update', 'id'=>$model->id]);
                    },
                    'delete' => function($url, $model, $key){
                        return Html::a('删除',
                            ['delete', 'id' => $model->id],
                            [
                                'class' => 'btn btn-danger btn-xs',
                                'data' => ['confirm' => '你确定要删除文章吗？', 'method' => 'post'],
                                
                            ]
                        );
                    },
        
                ],
            ],
        ],
    ]); ?>
</div>
