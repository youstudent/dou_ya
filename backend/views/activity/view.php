<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Activity */

//$this->title = $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-view">

    <h3>活动详情</h3>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'merchant_name',
            'activity_name',
            [
                'attribute' => 'activity_img',
                'label' => '封面',
                'format' => 'raw',
                'value' =>  function($model){
                    if ($model->activity_img){
                        return  Html::img(Yii::$app->params['imgs'].$model->activity_img, ['width'=> '100px', 'height'=> '100px']);
                    }
                    return '还未上传图片';
            
                },
            ],
            
            'activity_address',
            [
                'attribute' => 'apply_end_time',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->apply_end_time);   //主要通过此种方式实现
                    },
            ],
            [
                'attribute' => 'start_time',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->start_time);   //主要通过此种方式实现
                    },
            ],
            [
                'attribute' => 'end_time',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->end_time);   //主要通过此种方式实现
                    },
            ],
            'phone',
            'linkman',
            [
                'attribute' => 'purchase_limitation',
                'value'=>
                    function($model){
                        return $model->purchase_limitation?$model->purchase_limitation:'无限制';   //主要通过此种方式实现
                    },
            ],
            'on_line',
            [
                'attribute' => 'created_at',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->created_at);   //主要通过此种方式实现
                    },
            ],
            [
                'attribute' => 'content',
                'label' => '活动详情',
                'format' => 'raw',
                'value' =>  function($model){
                    return $model->content;
                },
            ],
        ],
    ]) ?>

</div>
