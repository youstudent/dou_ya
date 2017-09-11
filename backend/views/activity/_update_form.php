<?php
$i=1;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Activity */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="activity-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-id',
        'enableAjaxValidation' => true,//是否开启ajax修改，这里的validationUrl需要自己定义，否则会在失去焦点的时候就更改当前的值了！
        'validationUrl' => \yii\helpers\Url::toRoute(['validate-form']),
    ]); ?>

    <?= $form->field($model, 'merchant_name')->textInput() ?>

    <?= $form->field($model, 'activity_name')->textInput() ?>

    <?= $form->field($model, 'file')->fileInput()?>
    <?= Html::img('@web/'.$model->activity_img,['width'=> '100px', 'height'=> '100px'])?>
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
    <?= Html::button('删除票种',['id'=>'add'])?>
    <?php foreach ($models as  $key=>$v):?>
            <div class="form-group field-activityticket-title required">
            <label class="control-label" for="activityticket-title">标题[票种<?php echo $i?>]</label>
            <input type="text" id="activityticket-title" class="form-control" name="ActivityTicket[title][<?php echo $key?>]" value="<?=$v['title']?>" aria-required="true">
            <div class="help-block"></div>
            </div>
        <div class="form-group field-activityticket-price required">
            <label class="control-label" for="activityticket-price">单人售价</label>
            <input type="text" id="activityticket-price" class="form-control" name="ActivityTicket[price][<?php echo $key?>]" value="<?=$v['price']?>" aria-required="true">
            <div class="help-block"></div>
        </div>
        <div class="form-group field-activityticket-settlement required">
            <label class="control-label" for="activityticket-settlement">单人结算价</label>
            <input type="text" id="activityticket-settlement" class="form-control" name="ActivityTicket[settlement][<?php echo $key?>]" value="<?=$v['settlement']?>" aria-required="true">
            <div class="help-block"></div>
        </div>
        <div class="form-group field-activityticket-settlement required">
            <label class="control-label" for="activityticket-return">毛利润</label>
            <input type="text" id="activityticket-return" class="form-control" name="ActivityTicket[return][<?php echo $key?>]" value="<?=$v['return'].'%'?>" aria-required="true" disabled>
            <div class="help-block"></div>
        </div>
     <?php $i++?>
    <?php endforeach;?>
   
    <div id="DDD">
    
    </div>
    <div class="form-group">
        <?php if ($model->end_time>date('Y-m-d H:i:s')):?>
            <?= Html::submitButton($model->isNewRecord ? '添加' : '修改', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php endif;?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$fileuploadedJs = <<<JS
 $('#activity-limitation_num input[value=1]').click(function () {
          $('#limit').removeClass('hide')
    });
    
 $('#activity-limitation_num input[value=0]').click(function () {
          $('#limit').addClass('hide')
    });
 
 
  $('#add').click(function() {
      var html1 = '<div ><div class="form-group field-activityticket-title required">'+
        '<label class="control-label" for="activityticket-title">标题[票种'+$i+']</label>'+
        '<input type="text" id="activityticket-title" class="form-control" name="ActivityTicket[title]['+$i+']" aria-required="true">'+
        '<div class="help-block"></div>'+
        '</div>'+
        '<div class="form-group field-activityticket-title required">'+
        '<label class="control-label" for="activityticket-price">售价</label>'+
        '<input type="text" id="activityticket-price" class="form-control" name="ActivityTicket[price]['+$i+']" aria-required="true">'+
        '<div class="help-block"></div>'+
        '</div>'+
        '<div class="form-group field-activityticket-title required">'+
        '<label class="control-label" for="activityticket-settlement">结算价</label>'+
        '<input type="text" id="activityticket-settlement" class="form-control" name="ActivityTicket[settlement]['+$i+']" aria-required="true">'+
        '<div class="help-block"></div>'+
        '</div></div>';
    $('#DDD').append(html1);
    
  });
JS;
$this->registerJs($fileuploadedJs);

?>




