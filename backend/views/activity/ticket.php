<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">
    <h3>活动票种</h3>
    <?php $form = ActiveForm::begin(); ?>
    <?php foreach ($models as  $key=>$v):?>
      
            <div class="form-group field-activityticket-title required">
                <label class="control-label" for="activityticket-title">标题</label>
                <input type="text" id="activityticket-title" class="form-control" name="ActivityTicket[title][<?php echo $key ?>]"
                       value="<?= $v['title'] ?>" aria-required="true">
                <div class="help-block"></div>
            </div>
            <div class="form-group field-activityticket-price required">
                <label class="control-label" for="activityticket-price">单人售价</label>
                <input type="text" id="activityticket-price" class="form-control"
                       name="ActivityTicket[price][<?php echo $key ?>]" value="<?= $v['price'] ?>" aria-required="true">
                <div class="help-block"></div>
            </div>
            <div class="form-group field-activityticket-settlement required">
                <label class="control-label" for="activityticket-settlement">单人结算价</label>
                <input type="text" id="activityticket-settlement" class="form-control"
                       name="ActivityTicket[settlement][<?php echo $key ?>]" value="<?= $v['settlement'] ?>"
                       aria-required="true">
                <div class="help-block"></div>
            </div>
            <div class="form-group field-activityticket-settlement required">
                <label class="control-label" for="activityticket-return">毛利润</label>
                <input type="text" id="activityticket-return" class="form-control"
                       name="ActivityTicket[return][<?php echo $key ?>]" value="<?= $v['return'] . '%' ?>" aria-required="true"
                       disabled>
                <div class="help-block"></div>
            </div>
    <?php endforeach;?>
    
    <?php ActiveForm::end(); ?>
</div>