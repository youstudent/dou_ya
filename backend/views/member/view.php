<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Member */

//$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Members', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
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
            'identification',
            'order_num',
            'order_money',
        ],
    ]) ?>

</div>
