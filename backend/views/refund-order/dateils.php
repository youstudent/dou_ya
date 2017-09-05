<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Merchant */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="" style="margin-left: 200px">
    <?php $form = ActiveForm::begin();?>
    <?= $form->field($model, 'money')->textInput(['readonly'=>'true'])?>
    <?= $form->field($model, 'bank_card')->textInput(['readonly'=>'true'])?>
    <?= $form->field($model, 'opening_bank')->textInput(['readonly'=>'true'])?>
    <?= $form->field($model, 'opening_man')->textInput(['readonly'=>'true'])?>
    <?= $form->field($model, 'pass_reason')->textarea(['readonly'=>'true'])?>
    <?php if ($status==4):?>
    <?= $form->field($model, 'no_reason')->textarea(['readonly'=>'true'])?>
    <?php endif;?>
    <div class="form-group">
        <?php if ($status==2):?>
            <?= Html::a('返回订单', ['/refund-order/paid-index','Order'=>['status'=>2]], ['class' => 'btn btn-success']) ?>
            <?php else:?>
            <?= Html::a('返回订单', ['/refund-order/unpaid-index','Order'=>['status'=>[3,4]]], ['class' => 'btn btn-success']) ?>
        <?php endif;?>
    </div>
    <?php ActiveForm::end(); ?>
    
</div>
