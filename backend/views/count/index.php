<?php

use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

use yii\widgets\LinkPager;
?>
<h2 style="color: #3C8DBC;text-align: center;margin-bottom: 60px;">运营统计</h2>
<div class="cf well form-search text-right" style="height: 68px;">
    <?php
    $this->title = '';
    $form = \yii\bootstrap\ActiveForm::begin(
        ['method'=>'get',
            'options'=>['class'=>'form-inline'],
            'action'=>\yii\helpers\Url::to(['count/index']),
        ]
    );
    echo $form->field($search,'start')->widget(\kartik\datetime\DateTimePicker::className(), [
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
        ]
    ]).'&nbsp &nbsp &nbsp';
    //echo $form->field($search,'end')->textInput(['placeholder'=>'结束时间'])->label(false).'&nbsp &nbsp &nbsp';
    echo $form->field($search,'end')->widget(\kartik\datetime\DateTimePicker::className(), [
        'options' => ['placeholder' => ''],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
        ]
    ]);
    echo \yii\bootstrap\Html::submitButton('搜索',['class'=>'btn btn-xs btn-primary','style'=>'margin-bottom:11px;margin-left:19px;height:32px;width:44px']);
    \yii\bootstrap\ActiveForm::end();
    ?>
</div>
<h3>区间报表</h3>
<table class="table table-hover table-bordered table-striped" >
  <thead>
    <tr class="success" >
      <th class="text-center">订单数</th>
      <th class="text-center">活动数</th>
      <th class="text-center">流水</th>
      <th class="text-center">结算金额</th>
      <th class="text-center">利润</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($count as $value):?>
  <tr>
      <td class="text-center"><?=$value['order_num']?></td>
      <td class="text-center"><?=$value['activity_num']?></td>
      <td class="text-center"><?=$value['running_water']?></td>
      <td class="text-center"><?=$value['auditing_money']?></td>
      <td class="text-center"><?=$value['return']?></td>
  </tr>
  <?php endforeach;?>
  <!--
  <tr>
      <td>分享收益（直推）</td>
      <td>产生的所有分享奖金（包括额外分享）</td>
      <td>绩效业绩（见点）：产生的所有绩效奖金</td>
      <td>统计产生了多少个5金果的奖励</td>
      <td>成功提现总额</td>
      <td>平台充值出去的总金种子数-财务总支出</td>
      <td>会员人数*900</td>
    </tr>
  -->
  </tbody>
</table>

<h3>总额统计</h3>
<table class="table table-hover table-bordered table-striped" style="width: 800px;" >
    <thead>
    <tr class="success" >
        <th class="text-center" width="100">用户数</th>
        <th class="text-center" width="100">商户数</th>
        <th class="text-center" width="100">订单数</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-center">1</td>
        <td class="text-center">12</td>
        <td class="text-center">12</td>
    </tr>
    </tbody>

</table>
<table class="table table-hover table-bordered table-striped" style="width: 800px;" >
    <thead>
    <tr class="success" >
        <th class="text-center" width="100">活动总数</th>
        <th class="text-center" width="100">正在进行活动数</th>
        <th class="text-center" width="100">历史活动数</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-center">1</td>
        <td class="text-center">12</td>
        <td class="text-center">12</td>
    </tr>
    </tbody>
</table>
<table class="table table-hover table-bordered table-striped" style="width: 800px;">
    <thead>
    <tr class="success" >
        <th class="text-center" width="100">总流水</th>
        <th class="text-center" width="100">总结算金额</th>
        <th class="text-center" width="100">总利润</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-center">1</td>
        <td class="text-center">12</td>
        <td class="text-center">12</td>
    </tr>
    </tbody>
</table>


