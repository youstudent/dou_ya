<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Salesman */


$this->params['breadcrumbs'][] = ['label' => 'Salesmen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="salesman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
