<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Merchant */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="merchant-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'money')->textInput(['readonly'=>'true'])?>
    <?= $form->field($model, 'bank_card')->textInput(['readonly'=>'true'])?>
    <?= $form->field($model, 'opening_bank')->textInput(['readonly'=>'true'])?>
    <?= $form->field($model, 'opening_man')->textInput(['readonly'=>'true'])?>
    <?= $form->field($model, 'pass_reason')->textarea()->textInput(['readonly'=>'true'])?>
    <?= $form->field($model, 'no_reason')->textarea()?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加商家' : '确认拒绝', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
