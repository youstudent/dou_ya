<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\Activity */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class'=>'form-inline'],
    ]); ?>

    <?= $form->field($model, 'activity_name')->textInput(['class'=>'form-control','placeholder'=>'活动名称'])->label(false) ?>

    <?= $form->field($model, 'merchant_name')->textInput(['class'=>'form-control','placeholder'=>'活动名称'])->label(false) ?>

    <?= $form->field($model, 'start_time')->label(false)->widget(DateTimePicker::className(), [
        'options' => ['placeholder' => '开始时间'],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
        ]
    ]) ?>

    <?php // echo $form->field($model, 'activity_img') ?>

    <?php // echo $form->field($model, 'activity_address') ?>

    <?php // echo $form->field($model, 'apply_end_time') ?>

    <?php // echo $form->field($model, 'start_time') ?>

    <?php // echo $form->field($model, 'end_time') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'linkman') ?>

    <?php // echo $form->field($model, 'purchase_limitation') ?>

    <?php // echo $form->field($model, 'on_line') ?>

    <?php // echo $form->field($model, 'content') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-sm btn-primary','style'=>'margin-bottom:9px']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-sm btn-default','style'=>'margin-bottom:9px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
