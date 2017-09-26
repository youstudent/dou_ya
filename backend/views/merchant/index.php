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

    <p>
        <?= Html::a('添加商家', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title"></h3>
            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'filterPosition' =>  false,
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
                        'seleaman',
                        'phone',
                        'address',
                        'linkman',
                        [
                            'label'=>'正在进行活动',
                            'value'=>
                                function($model){
                                    return  \common\models\Merchant::getInActivity($model->id);   //主要通过此种方式实现
                                },
                        ],
                        [
                            'label'=>'结束活动',
                            'value'=>
                                function($model){
                                    return  \common\models\Merchant::getHistoryActivity($model->id);   //主要通过此种方式实现
                                },
                        ],
                        /*[
                            'format' => 'raw',
                            'label'=>'封面',
                            'value'=>function($m){
                              return Html::img('@web/'.$m->logo,['width'=> '50px', 'height'=> '50px']);
                            }
                        ],*/
                        [
                            'attribute' => 'created_at',
                            'label'=>'创建时间',
                            'value'=>
                                function($model){
                                    return  date('Y-m-d H:i:s',$model->created_at);   //主要通过此种方式实现
                                },
                        ],
                        [
                            //动作列yii\grid\ActionColumn
                            //用于显示一些动作按钮，如每一行的更新、删除操作。
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '操作',
                            'template' => '{view}{update}{activity}{addactivity}',//只需要展示删除和更新
                            'headerOptions' => ['width' => '240'],
                            'buttons' => [
                                'view' => function ($url, $model, $key) {
                                    return Html::a(Html::tag('span', '查看详情', ['class' => "btn btn-xs btn-primary"]), ['view', 'id'=>$model->id]).'&nbsp';
                                },
                                'update' => function ($url, $model, $key) {
                                    return Html::a(Html::tag('span', '修改', ['class' => "btn btn-xs btn-success"]), ['update', 'id'=>$model->id]).'&nbsp';
                                },
                                /*'delete' => function($url, $model, $key){
                                    return Html::a('删除',
                                            ['delete', 'id' => $key],
                                            [
                                                'class' => 'btn btn-danger btn-xs',
                                                'data' => ['confirm' => '你确定要删除该商家吗？', 'method' => 'post']
                                            ]
                                        ).'&nbsp';
                                },*/
                                'activity' => function ($url, $model, $key) {
                                    return Html::a('活动管理',['/activity/index','Activity'=>['merchant_id'=>$model->id,'id'=>1]],['class' => "btn btn-xs btn-success"]).'&nbsp';
                                },
                                'addactivity' => function ($url, $model, $key) {
                                    return Html::a('添加活动',['/activity/create','name'=>$model->name],['class' => "btn btn-xs btn-success"]).'&nbsp';
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
