<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\Order */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Orders';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h3>已支付订单</h3>
    <p style="text-align: right">
        <?= Html::a('导出EXCEL', ['excel','status'=>1], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
                        'order_number',
                        'activity_name',
                        'merchant_name',
                        'order_name',
                        'order_num',
                        'order_checking',
                        'phone',
                        'sell_all',
                        'clearing_all',
                        'sell_all_checking',
                        'clearing_all_checking',
                        [
                            'attribute' => 'order_time',
                            'label'=>'下单时间',
                            'value'=>
                                function($model){
                                    return  date('Y-m-d H:i:s',$model->order_time);   //主要通过此种方式实现
                                },
                        ],
                        [
                            //动作列yii\grid\ActionColumn
                            //用于显示一些动作按钮，如每一行的更新、删除操作。
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '电子票详情',
                            'template' => '{get-details}',//只需要展示删除和更新
                            'headerOptions' => ['width' => '100'],
                            'buttons' => [
                                'get-details' => function ($url, $model, $key) {
                                    return Html::a('详情',$url,
                                        [
                                            'class' => 'btn btn-info btn-xs',
                                            'data' => ['method' => 'post'],
                                        ]
                                    );
                                },
                                /*'get-details' => function ($url, $model, $key) {
                                    return Html::a('更新', '/order/get-details', [
                                        'data-toggle' => 'modal',
                                        'data-target' => '#update-modal',
                                        'class' => 'data-update',
                                        'data-id' => $key,
                                    ]);
                                },*/
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
