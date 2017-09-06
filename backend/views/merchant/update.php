<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Merchant */

//$this->title = 'Update Merchant: ' . $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Merchants', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="merchant-update">

    <h3>用户电话修改</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
