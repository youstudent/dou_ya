<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\DaterangePickerAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\Order */
/* @var $form yii\widgets\ActiveForm */
DaterangePickerAsset::register($this);

$this->registerJs(<<<JS
$('input[id="order-order_time"]').daterangepicker({
    "showDropdowns": true,
    "timePicker": true,
    "ranges": {
           '今日': [moment().startOf('day'), moment()],
            '昨日': [moment().subtract(1, 'days').startOf('day'), moment().subtract(1, 'days').endOf('day')],
            '最近7日': [moment().subtract(6, 'days'), moment()],
            '最近30日': [moment().subtract(29, 'days'), moment()],
            '本月': [moment().startOf("month"),moment().endOf("month")],
            '上个月': [moment().subtract(1,"month").startOf("month"),moment().subtract(1,"month").endOf("month")]
    },
    "autoUpdateInput": false,
    "locale": {
        "format": "YYYY-MM-DD HH:mm",
        "separator": " - ",
        "applyLabel": "确定",
        "cancelLabel": "清空",
        "fromLabel": "从",
        "toLabel": "到",
        "customRangeLabel": "自定义",
        "weekLabel": "周",
        "daysOfWeek": [
            "日",
            "一",
            "二",
            "三",
            "四",
            "五",
            "六"
        ],
        "monthNames": [
            "一月",
            "二月",
            "三月",
            "四月",
            "五月",
            "六月",
            "七月",
            "八月",
            "九月",
            "十月",
            "十一月",
            "十二月"
        ],
        "firstDay": 1
    },
    "linkedCalendars": false,
    "alwaysShowCalendars": true,
    "startDate": "2017-07-19"
}).
on('apply.daterangepicker', function(ev, picker) {
  $(this).val(picker.startDate.format('YYYY-MM-DD HH:mm') + ' - ' + picker.endDate.format('YYYY-MM-DD HH:mm'));
}).
on('cancel.daterangepicker', function(ev, picker) {
  $(this).val('');
});

JS
)
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['/refund-order/paid-index'],
        'method' => 'get',
        'options' => ['class'=>'form-inline'],
    ]); ?>

    <?= $form->field($model, 'order_number')->textInput(['placeholder' => '订单号','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'order_name')->textInput(['placeholder' => '下单人昵称','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'phone')->textInput(['placeholder' => '电话','class'=>'form-control'])->label(false) ?>
    
    <?= $form->field($model, 'order_time')->label(false)->textInput(['placeholder' => '起止时间', 'class' => 'form-control', 'style' => 'width:234px;']) ?>

    <?= $form->field($model, 'activity_name')->textInput(['placeholder' => '活动名','class'=>'form-control'])->label(false) ?>

    <?= $form->field($model, 'merchant_name')->textInput(['placeholder' => '商家名','class'=>'form-control'])->label(false) ?>
    
    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary','style'=>'margin-bottom:9px']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-sm btn-default','style'=>'margin-bottom:9px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
