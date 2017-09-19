<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['order/paid-index'],
        'method' => 'get',
        'options' => ['class'=>'form-inline'],
    ]); ?>

    <?= $form->field($model, 'order_number')->textInput(['placeholder' => '订单号','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'order_name')->textInput(['placeholder' => '下单人昵称','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'phone')->textInput(['placeholder' => '电话','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'order_time')->textInput(['placeholder' => '下单时间','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'activity_name')->textInput(['placeholder' => '活动名','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'merchant_name')->textInput(['placeholder' => '商家名','class'=>'form-control'])->label(false) ?>

    <?php // echo $form->field($model, 'order_num') ?>

    <?php // echo $form->field($model, 'order_checking') ?>

    <?php // echo $form->field($model, 'sell_all') ?>

    <?php // echo $form->field($model, 'clearing_all') ?>

    <?php // echo $form->field($model, 'sell_all_checking') ?>

    <?php // echo $form->field($model, 'clearing_all_checking') ?>


    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary','style'=>'margin-bottom:9px']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-sm btn-default','style'=>'margin-bottom:9px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
