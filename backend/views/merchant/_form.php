<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Merchant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="merchant-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'file')->fileInput()?>

    <?= $form->field($model, 'phone')->textInput() ?>
    
    <?= $form->field($model, 'merchant_label')->textInput() ?>
    
    <?= $form->field($model, 'linkman')->textInput() ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'contract_number')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'imgs[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>

    <?= $form->field($model, 'seleaman')->dropDownList(\common\models\Merchant::getSalesman()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加商家' : '修改商家', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
