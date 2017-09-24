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
    <p>
        <?= Html::a('请在商家管理中添加活动', ['/merchant/index'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <?php  echo $this->render('_searchs', ['model' => $searchModel]); ?>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'filterPosition' => false,
                    'pager'=>[
                        //'options'=>['class'=>'hidden']//关闭分页
                        'firstPageLabel'=>"首页",
                        'prevPageLabel'=>'上一页',
                        'nextPageLabel'=>'下一页',
                        'lastPageLabel'=>'尾页',
                    ],
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
                            'template' => '{view}{update}{stop}{open}{ticket}',//只需要展示删除和更新
                            'headerOptions' => ['width' => '240'],
                            'buttons' => [
                                'ticket' => function ($url, $model, $key) {
                                    return Html::a(Html::tag('span', '查看票种', ['class' => "btn btn-xs btn-primary"]), ['ticket', 'id'=>$model->id]).'&nbsp';
                                },
                                'view' => function ($url, $model, $key) {
                                    return Html::a(Html::tag('span', '查看详情', ['class' => "btn btn-xs btn-primary"]), ['view', 'id'=>$model->id]).'&nbsp';
                                },
                                'update' => function ($url, $model, $key) {
                                    return Html::a(Html::tag('span', '修改', ['class' => "btn btn-xs btn-success"]), ['update', 'id'=>$model->id]).'&nbsp';
                                },
                                'stop' => function ($url, $model, $key) {
                                    if ($model->status==1){
                                        return Html::a('停封',
                                                ['stop', 'id' => $model->id,'Activity'=>Yii::$app->request->get()],
                                                [
                                                    'class' => 'btn btn-success btn-xs',
                                                    'data' => ['confirm' => '你确定要停封该活动吗？', 'method' => 'post'],
                                                ]
                                            ) . '&nbsp';
                                    }

                                },
                                'open' => function ($url, $model, $key) {
                                    if ($model->status==0){
                                        return Html::a('启用',
                                            ['open', 'id' => $model->id,'Activity'=>Yii::$app->request->get()],
                                            [
                                                'class' => 'btn btn-danger btn-xs',
                                                'data' => ['confirm' => '你确定要启用该活动吗？', 'method' => 'post'],
                                            ]
                                        ) . '&nbsp';
                                    }

                                },

                            ],
                        ],
                    ],
                ]); ?>
            </div>
            <div class="box-footer clearfix">

            </div>
        </div>
    </div>
</div>
