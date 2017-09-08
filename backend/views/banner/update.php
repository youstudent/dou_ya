<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Banner */

//$this->title = 'Update Banner: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Banners', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="banner-update">

    <h3>banner图片修改</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
