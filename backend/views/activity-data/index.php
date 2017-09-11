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
