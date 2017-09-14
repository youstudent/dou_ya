<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Merchant */

//$this->title = $model->name;
//$this->params['breadcrumbs'][] = ['label' => 'Merchants', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="merchant-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '你确认要删除这条数据吗?',
                'method' => 'post',
            ],
        ]) ?>
   
    </p>
    <h3>合同图片</h3>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'phone',
            'address',
            'linkman',
            'merchant_label',
            [
                'attribute' => 'created_at',
                'label'=>'创建时间',
                'value'=>
                    function($model){
                        return  date('Y-m-d H:i:s',$model->created_at);   //主要通过此种方式实现
                    },
            ],
            'seleaman',
            [
                'format' => 'raw',
                'label'=>'封面',
                'value'=>function($m){
                  return Html::img('@web'.$m->logo,['width'=> '300px', 'height'=> '200px']);
                }
            ],
            [
                'label'=>'',
                'value'=>function($m){
                    foreach ($m->img as $value){
                        echo Html::img('@web'.$value->img,['width'=> '300px', 'height'=> '200px','style'=>'margin-left: 26px;']
                            ).Html::a('删除',['merchant/del','id'=>$value->id,'v'=>$value->merchant_id],['class'=>'btn btn-danger',  'style'=>"margin-top-width: 162px;margin-top: 161px;",'data' => [
                                'confirm' => '确认删除这一张图片吗?',
                                'method' => 'post',
                            ],]);
                    }
                }
            ],
        ],
    ]) ?>

</div>

<script>
    function openAgency(_this, title) {
        swal({
                title: title,
                text: "请确认你的操作时经过再三是考虑!",
                type: "warning",
                showCancelButton: true,
                confirmButtonText: "确认",
                cancelButtonText: "取消",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            },
            function () {
                console.log(_this.href);
                $.ajax({
                    url: _this.href,
                    success: function (res) {
                        if (res.code == 1) {
                            swal(
                                {
                                    title: res.message,
                                    type: "success",
                                    showCancelButton: false,
                                    confirmButtonText: "确认",
                                    closeOnConfirm: false,
                                    showLoaderOnConfirm: true
                                }, function () {
                                    window.location.reload();
                                }
                            );
                        } else {
                            swal(
                                {
                                    title: res.message,
                                    type: "error",
                                    showCancelButton: false,
                                    confirmButtonText: "确认",
                                    closeOnConfirm: false,
                                }
                            );
                        }
                    }
                });
            });

        return false;
    }
</script>