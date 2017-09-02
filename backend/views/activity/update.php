<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Activity */

//$this->title = 'Update Activity: ' . $model->id;
//$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="activity-update">

    <h3>修改活动</h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
