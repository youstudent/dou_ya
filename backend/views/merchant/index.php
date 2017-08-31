<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\Search\Merchant */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = '商家列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('添加商家', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
            'phone',
            'address',
            [
                'attribute' => 'created_at',
                'label'=>'创建时间',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->created_at);   //主要通过此种方式实现
                    },
            ],
            'seleaman',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
