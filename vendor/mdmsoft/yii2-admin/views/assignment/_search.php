<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var mdm\admin\models\searchs\Menu $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options'=>['class'=>'form-inline'],
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['placeholder' => '姓名','class'=>'form-control'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('rbac-admin', '搜索'), ['class' => 'btn btn-sm btn-primary','style'=>'margin-bottom:9px']) ?>
        <?= Html::resetButton(Yii::t('rbac-admin', '重置'), ['class' => 'btn btn-sm btn-default','style'=>'margin-bottom:9px']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
