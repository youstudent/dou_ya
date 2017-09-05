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

    <h3>退款已处理</h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
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
            //'order_checking',
            'phone',
            'sell_all',
            'clearing_all',
            //'sell_all_checking',
            // 'clearing_all_checking',
            [
                'attribute' => 'order_time',
                'label' => '下单时间',
                'value' =>
                    function ($model) {
                        return date('Y-m-d H:i:s', $model->order_time);   //主要通过此种方式实现
                    },
            ],
            [
                'label' => '申请时间',
                'value' =>
                    function ($model) {
                        return \common\models\OrderRefund::getCreated_at($model->id);
                    },
            ],
            [
                'attribute' => 'status',
                'value' => function ($model, $key, $index, $column) {
                    return $model->status == 3 ? '通过' : '拒绝';
                },
                
                'filter' => Html::activeDropDownList($searchModel,
                    'status', ['3' => '通过', '4' => '拒绝'],
                    ['prompt' => '全部', 'style' => 'height:34px;']
                )
            ],
            [
                //动作列yii\grid\ActionColumn
                //用于显示一些动作按钮，如每一行的更新、删除操作。
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{get-details}{get-pass}{un-pass}',//只需要展示删除和更新
                'headerOptions' => ['width' => '100'],
                'buttons' => [
                    'get-details' => function ($url, $model, $key) {
                        return Html::a('退款详情', ['get-details', 'id' => $model->id, 'status' => $model->status],
                            [
                                'class' => 'btn btn-info btn-xs',
                                'data' => ['method' => 'post'],
                            ]
                        
                        );
                    },
                ],
            ],
        
        ],
    ]); ?>
</div>
