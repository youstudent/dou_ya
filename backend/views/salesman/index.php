<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\Salesman */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = '业务员';
//$this->params['breadcrumbs'][] = '业务员';
?>
<div class="salesman-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加业务员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?= GridView::widget([
        'tableOptions' => ['class' => 'table table-hover'],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout'=> '{items}<div class="text-right tooltip-demo">{pager}</div>',
        'pager'=>[
            //'options'=>['class'=>'hidden']//关闭分页
            'firstPageLabel'=>"首页",
            'prevPageLabel'=>'上一页',
            'nextPageLabel'=>'下一页',
            'lastPageLabel'=>'尾页',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'job_number',
            'phone',
            'bound_merchant',
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
                        return Html::a(Html::tag('span', '查看详情', ['class' => "btn btn-xs btn-primary"]), ['/salesman/view', 'id'=>$model->id]);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span', '修改', ['class' => "btn btn-xs btn-success"]), ['/salesman/update', 'id'=>$model->id]);
                    },
                    'delete' => function($url, $model, $key){
                        return Html::a('删除',
                            ['delete', 'id' => $key],
                            [
                                'class' => 'btn btn-danger btn-xs',
                                'data' => ['confirm' => '你确定要删除文章吗？','method' => 'post']
                            ]
                        );
                    },
                    
                ],
            ],
        ],
    ]); ?>
    
</div>
