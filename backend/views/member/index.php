<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\Member */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Members';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::a('Create Member', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
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
                        [
                            'attribute' => 'sex',
                            'label'=>'性别',
                            'value'=>
                                function($model){
                                    return  $model->sex==1?'男':'女';   //主要通过此种方式实现
                                },
                        ],
                        'phone',
                       [
                            'attribute' => 'last_time',
                            'label'=>'最后登录时间',
                            'value'=>
                                function($model){
                                    return  date('Y-m-d H:i:s',$model->last_time);   //主要通过此种方式实现
                                },
                        ],
                       /* [
                            'attribute' => 'last_time',
                            'label' => '最后登录时间',
                            'value' => function ($model) {
                                return date('Y-m-d H:i:s', $model->last_time);
                            },
                            'filter'    => \bburim\daterangepicker\DateRangePicker::widget([
                                'model'         => $searchModel,
                                'attribute'     => 'last_time',
                                'convertFormat' => true,
                                'pluginOptions' => [
                                    'locale' => ['format' => 'Y-m-d'],
                                ],
                            ]),
                            'headerOptions' => ['width' => '200'],
    
                        ],*/
                        //'identification',
                        'order_num',
                        'order_money',
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
                        [
                            //动作列yii\grid\ActionColumn
                            //用于显示一些动作按钮，如每一行的更新、删除操作。
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{update}{stop}{open}',//只需要展示删除和更新
                            'headerOptions' => ['width' => '100'],
                            'buttons' => [
                                'update' => function ($url, $model, $key) {
                                    return Html::a(Html::tag('span', '修改电话', ['class' => "btn btn-xs btn-success"]), ['member/update', 'id'=>$model->id]). '&nbsp';
                                },
                                'stop' => function ($url, $model, $key) {
                                    if ($model->status==1){
                                        return Html::a('停封',
                                                ['stop', 'id' => $model->id],
                                                [
                                                    'class' => 'btn btn-success btn-xs',
                                                    'data' => ['confirm' => '你确定要停封该用户吗？', 'method' => 'post'],
                                                ]
                                            ) . '&nbsp';
                                    }

                                },
                                'open' => function ($url, $model, $key) {
                                    if ($model->status==0){
                                        return Html::a('解封',
                                            ['open', 'id' => $model->id],
                                            [
                                                'class' => 'btn btn-danger btn-xs',
                                                'data' => ['confirm' => '你确定要解封该用户吗？', 'method' => 'post'],
                                            ]
                                        );
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

