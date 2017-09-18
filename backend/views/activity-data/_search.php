<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\ActivityData */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-data-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class'=>'form-inline'],
   ]); ?>

    

    <?= $form->field($model, 'merchant_name')->textInput(['class'=>'form-control','placeholder'=>'商家名称'])->label(false) ?>

    <?= $form->field($model, 'activity_name')->textInput(['class'=>'form-control','placeholder'=>'活动名称'])->label(false) ?>

    <?php // echo $form->field($model, 'order_num') ?>

    <?php // echo $form->field($model, 'order_number_num') ?>

    <?php // echo $form->field($model, 'checking_num') ?>

    <?php // echo $form->field($model, 'transaction_money') ?>

    <?php // echo $form->field($model, 'footings') ?>

    <?php // echo $form->field($model, 'checking_transaction_money') ?>

    <?php // echo $form->field($model, 'checking_footings') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-sm btn-primary','style'=>'margin-bottom:9px']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-sm btn-default','style'=>'margin-bottom:9px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
