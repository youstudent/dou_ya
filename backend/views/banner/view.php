<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */

//$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
?>
<div class="banner-view">

    <h3>banner图片详情</h3>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确认删除吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            [
                'attribute' => 'created_at',
                'label'=>'创建时间',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->created_at);   //主要通过此种方式实现
                    },
            ],
            [
                'label'=>'',
                'value'=>function($m){
                    foreach ($m->img as $value){
                        echo Html::img('@web'.$value->img,['width'=> '200px', 'height'=> '200px','style'=>'margin-left: 26px;']
                        ).Html::a('删除',['banner/del','id'=>$value->id,'v'=>$value->banner_id],['class'=>'btn btn-danger',  'style'=>"margin-top-width: 162px;margin-top: 161px;",'data' => [
                                'confirm' => '确认删除这一张图片吗?',
                                'method' => 'post',
                            ],]);
                    }
                }
            ],
        ],
    ]) ?>

</div>
