<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\Merchant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="merchant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class'=>'form-inline'],
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['placeholder' => '商家名字','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'phone')->textInput(['placeholder' => '电话','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'linkman')->textInput(['placeholder' => '联系人姓名','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'seleaman')->textInput(['placeholder' => '业务员','class'=>'form-control'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary','style'=>'margin-bottom:9px']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-sm btn-default','style'=>'margin-bottom:9px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
