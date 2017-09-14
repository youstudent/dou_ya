<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\ActivityData */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Activity Datas';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-data-index">

    <h3>数据</h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <div class="box-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'merchant_name',
            'activity_name',
            'order_num',
            'order_number_num',
            'checking_num',
            'transaction_money',
            'footings',
            'checking_transaction_money',
            'checking_footings',
        ],
    ]); ?>
            </div>
            <div class="box-footer clearfix">

            </div>
        </div>
    </div>
</div>
