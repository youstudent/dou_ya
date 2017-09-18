<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\Member */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="member-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options'=>['class'=>'form-inline'],
//        'action'=>\yii\helpers\Url::to(['count/index']),
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['placeholder' => '姓名','class'=>'form-control'])->label(false) ?>&nbsp;&nbsp;&nbsp;&nbsp;

    <?= $form->field($model, 'phone')->textInput(['placeholder' => '电话','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'account')->textInput(['placeholder' => '账号','class'=>'form-control'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary','style'=>'margin-bottom:9px']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-sm btn-default','style'=>'margin-bottom:9px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
