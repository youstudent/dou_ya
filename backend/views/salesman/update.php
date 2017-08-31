<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Salesman */

//$this->title = 'Update Salesman: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Salesmen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="salesman-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
