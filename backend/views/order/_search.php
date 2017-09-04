<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_number') ?>

    <?= $form->field($model, 'activity_name') ?>

    <?= $form->field($model, 'merchant_name') ?>

    <?= $form->field($model, 'order_name') ?>

    <?php // echo $form->field($model, 'order_num') ?>

    <?php // echo $form->field($model, 'order_checking') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'sell_all') ?>

    <?php // echo $form->field($model, 'clearing_all') ?>

    <?php // echo $form->field($model, 'sell_all_checking') ?>

    <?php // echo $form->field($model, 'clearing_all_checking') ?>

    <?php // echo $form->field($model, 'order_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
