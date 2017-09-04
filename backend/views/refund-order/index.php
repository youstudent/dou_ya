<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\Order */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Orders';
//$this->params['breadcrumbs'][] = $this->title;
$js =<<<js
    function openAgency(_this, title) {
        swal({
                title: title,
                text: "请确认你的操作时经过再三是考虑!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            },
            function () {
                console.log(_this.href);
                $.ajax({
                    url: _this.href,
                    success: function (res) {
                        if (res.code == 1) {
                            swal(
                                {
                                    title: res.message,
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "确认",
                                    closeOnConfirm: false,
                                    showLoaderOnConfirm: true
                                }, function () {
                                    window.location.reload();
                                }
                            );
                        } else {
                            swal(
                                {
                                    title: res.message,
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonText: "确认",
                                    closeOnConfirm: false,
                                }
                            );
                        }
                    }
                });
            });

        return false;
    }
js;
$this->registerJs($js);

?>
<div class="order-index">

    <h3>退款待处理</h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'order_number',
            'activity_name',
            'merchant_name',
            'order_name',
            'order_num',
           // 'order_checking',
            'phone',
            'sell_all',
            //'clearing_all',
            //'sell_all_checking',
           // 'clearing_all_checking',
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
                'header' => '操作',
                'template' => '{get-details}{get-pass}{un-pass}',//只需要展示删除和更新
                'headerOptions' => ['width' => '240'],
                'buttons' => [
                    'get-details' => function ($url, $model, $key) {
                        return Html::a('退款详情',$url,
                            [
                                'class' => 'btn btn-info btn-xs',
                                'data' => ['method' => 'post'],
                            ]
                        
                        ).'&nbsp';
                    },
                    'get-pass' => function($url, $model, $key){
                        return Html::a('通过',
                            ['get-pass', 'id' => $model->id],
                            [
                                'class' => 'btn btn-success btn-xs',
                                'data' => ['confirm' => '你确定要通过该退款吗？', 'method' => 'post'],
                            ]
                        ).'&nbsp';
                    },
                    'un-pass' => function($url, $model, $key){
                        return Html::a('拒绝',
                            ['un-pass', 'id' => $model->id],
                            [
                                'class' => 'btn btn-danger btn-xs',
                                'data' => ['confirm' => '你确定要拒绝该退款吗？', 'method' => 'post'],
                            ]
                        );
                    },
        
                ],
            ],
            
        ],
    ]); ?>
</div>
