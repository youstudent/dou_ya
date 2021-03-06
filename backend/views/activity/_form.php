<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Activity */
/* @var $form yii\widgets\ActiveForm */

$fileuploadedJs = <<<JS
 $('#activity-limitation_num input[value=1]').click(function () {
          $('#limit').removeClass('hide')
    });
    
 $('#activity-limitation_num input[value=0]').click(function () {
          $('#limit').addClass('hide')
    });
        var tempTheLastBoxNum;
      var i=1;
  $('#add').click(function() {
      var html1 = '<div id="addTheTicket'+ i +'"><div class="form-group field-activityticket-title required">'+
        '<label class="control-label" for="activityticket-title">标题[票种'+i+']</label>'+
        '<input type="text" id="activityticket-title" class="form-control" name="ActivityTicket[title]['+i+']" aria-required="true">'+
        '<div class="help-block"></div>'+
        '</div>'+
        '<div class="form-group field-activityticket-title required">'+
        '<label class="control-label" for="activityticket-title">售价</label>'+
        '<input type="text" id="activityticket-title" class="form-control" name="ActivityTicket[price]['+i+']" aria-required="true">'+
        '<div class="help-block"></div>'+
        '</div>'+
        '<div class="form-group field-activityticket-title required">'+
        '<label class="control-label" for="activityticket-title">结算价</label>'+
        '<input type="text" id="activityticket-title" class="form-control" name="ActivityTicket[settlement]['+i+']" aria-required="true">'+
        '<div class="help-block"></div>'+
        '</div></div>';
      tempTheLastBoxNum = i;
      i += 1;
      
    console.log(tempTheLastBoxNum + '======' + i);
    $('#DDD').append(html1);
  });
  $('#del').click(function() {
    $('#addTheTicket' + tempTheLastBoxNum).remove();
    tempTheLastBoxNum -= 1;
    if(i <= 1){
        return
    }else {
        i -= 1;
    }
  })
JS;
$this->registerJs($fileuploadedJs);
?>

<div class="activity-form";>

    <?php $form = ActiveForm::begin([
        'id' => 'form-id',
        'enableAjaxValidation' => true,//是否开启ajax修改，这里的validationUrl需要自己定义，否则会在失去焦点的时候就更改当前的值了！
        'validationUrl' => \yii\helpers\Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'merchant_name')->textInput(['readonly'=>'true']) ?>

    <?= $form->field($model, 'activity_name')->textInput() ?>
    
    <?= $form->field($model, 'sms_title')->textInput(['placeholder'=>'字数小于11']) ?>

    <?= $form->field($model, 'file')->fileInput()?>
    
    <?= $form->field($model, 'activity_address')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'apply_end_time')->widget(\kartik\datetime\DateTimePicker::classname(), [
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
        ]
    ]); ?>
    
    <?= $form->field($model, 'start_time')->widget(\kartik\datetime\DateTimePicker::classname(), [
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
        ]
    ]); ?>
    
    <?= $form->field($model, 'end_time')->widget(\kartik\datetime\DateTimePicker::classname(), [
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
        ]
    ]); ?>
    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'linkman')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'limitation_num')->radioList(\common\models\Activity::$num)?>
    <div class="hide" id="limit">
        <?= $form->field($model, 'purchase_limitation')->textInput(['style'=>'width:50px;height:34px'])->label(false) ?>
    </div>

    <?= $form->field($model, 'on_line')->textInput() ?>
    <?= $form->field($model, 'content')->widget(\kucha\ueditor\UEditor::className(),[
        'clientOptions'=>[
            'initialFrameHeight' => '100',
            'initialFrameWidth' => '80%',
        ]
        
    ]) ?>
    <?= Html::button('添加票种',['id'=>'add'])?>
    <?= Html::button('删除票种',['id'=>'del'])?>
    <?= $form->field($models, 'title[0]')->textInput()->label('标题[票种1]') ?>
    <?= $form->field($models, 'price[0]')->textInput() ?>
    <?= $form->field($models, 'settlement[0]')->textInput() ?>
    <div id="DDD">
    
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>




