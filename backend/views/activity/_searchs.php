<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\assets\DaterangePickerAsset;

/* @var $this yii\web\View */
/* @var $model backend\models\Search\Activity */
/* @var $form yii\widgets\ActiveForm */

DaterangePickerAsset::register($this);

$this->registerJs(<<<JS
$('input[id="activity-start_time"]').daterangepicker({
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

<div class="activity-search">

    <?php $form = ActiveForm::begin([
        'action' => ['history'],
        'method' => 'get',
        'options' => ['class'=>'form-inline'],
    ]); ?>

    <?= $form->field($model, 'activity_name')->textInput(['class'=>'form-control','placeholder'=>'活动名'])->label(false) ?>

    <?= $form->field($model, 'merchant_name')->textInput(['class'=>'form-control','placeholder'=>'商家名'])->label(false) ?>
    
    <?= $form->field($model, 'start_time')->label(false)->textInput(['placeholder' => '起止时间', 'class' => 'form-control', 'style' => 'width:234px;']) ?>
    
    <?= $form->field($model, 'status')->dropDownList([''=>'全部',1=>'正常',2=>'停封',])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('搜索', ['class' => 'btn btn-sm btn-primary','style'=>'margin-bottom:9px']) ?>
        <?= Html::resetButton('重置', ['class' => 'btn btn-sm btn-default','style'=>'margin-bottom:9px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
