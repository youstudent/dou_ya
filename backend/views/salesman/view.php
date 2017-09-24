<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Salesman */

//$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Salesmen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesman-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确定要删除该业务员吗?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'job_number',
            'phone',
            [
            'attribute' => 'created_at',
            'label'=>'创建时间',
            'value'=>
                function($model){
                    return  date('Y-m-d H:i:s',$model->created_at);   //主要通过此种方式实现
                },
            ],
        ],
    ]) ?>

</div>
