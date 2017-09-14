<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'order_number')->textInput(['disabled'=>"disabled"]) ?>
    <?= $form->field($model, 'activity_name')->textInput(['disabled'=>"disabled"]) ?>
    <?= $form->field($model, 'merchant_name')->textInput(['disabled'=>"disabled"]) ?>
    <?= $form->field($model, 'order_num')->textInput(['disabled'=>"disabled"]) ?>
    <?php foreach ($data as $value):?>
        <div class="form-group field-order-merchant_name">
            <label class="control-label" for="order-merchant_name">电子票票号<?php echo $value['status']==0?'[未验票]':'[已验票]'?></label>
            <input type="text" id="order-merchant_name" class="form-control" name="Order[merchant_name]" value="<?php echo $value['code']?>" disabled>
            <div class="help-block"></div>
        </div>
    <?php endforeach;?>
    <?php ActiveForm::end(); ?>
</div>