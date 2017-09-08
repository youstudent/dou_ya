<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Activity */

//$this->title = 'Create Activity';
//$this->params['breadcrumbs'][] = ['label' => 'Activities', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="activity-create">

    <h3>修改管理员</h3>

    <?= $this->render('_update_form', [
        'model' => $model,
    ]) ?>

</div>
