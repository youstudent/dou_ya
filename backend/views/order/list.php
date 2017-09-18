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

    <h3>待支付订单</h3>
    <p style="text-align: right">
        <?= Html::a('导出EXCEL', ['excel','status'=>0], ['class' => 'btn btn-success']) ?>
    </p>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterPosition' => false,
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
                'label'=>'下单时间',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->order_time);   //主要通过此种方式实现
                    },
            ],
            
        ],
    ]); ?>
</div>
