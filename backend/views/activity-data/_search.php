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
    ]); ?>

    

    <?= $form->field($model, 'order_num') ?>

    <?= $form->field($model, 'order_number_num') ?>

    <?= $form->field($model, 'checking_num') ?>

    <?php // echo $form->field($model, 'transaction_money') ?>

    <?php // echo $form->field($model, 'footings') ?>

    <?php // echo $form->field($model, 'checking_transaction_money') ?>

    <?php // echo $form->field($model, 'checking_footings') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
