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
            'sex',
            'phone',
            [
                'attribute' => 'last_time',
                'label'=>'创建时间',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->last_time);   //主要通过此种方式实现
                    },
            ],
            [
                'attribute' => 'status',
                'value'=>function ($model,$key,$index,$column){
                    return $model->status==1?'正常':'停封';
                },
                
                'filter' => Html::activeDropDownList($searchModel,
                    'status',['1'=>'正常','0'=>'停封'],
                    ['prompt'=>'全部']
                )
            ],
            'identification',
            'order_num',
            'order_money',
            [
                //动作列yii\grid\ActionColumn
                //用于显示一些动作按钮，如每一行的更新、删除操作。
                'class' => 'yii\grid\ActionColumn',
                'header' => '操作',
                'template' => '{update}',//只需要展示删除和更新
                'headerOptions' => ['width' => '240'],
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a(Html::tag('span', '修改', ['class' => "btn btn-xs btn-success"]), ['member/update', 'id'=>$model->id]);
                    },
                ],
            ],
        ],
    ]);
    ?>
</div>

