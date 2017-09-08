<?php
use yii\bootstrap\Modal;
// 更新操作
Modal::begin([
    'id' => 'update-modal',
    'header' => '<h4 class="modal-title">更新</h4>',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',
]);
$requestUpdateUrl = \yii\helpers\Url::toRoute('update');
$updateJs = <<<JS
$('.data-update').on('click', function () {
$.get('{$requestUpdateUrl}', { id: $(this).closest('tr').data('key') },
function (data) {
$('.modal-body').html(data);
}
);
});
JS;
$this->registerJs($updateJs);
Modal::end();
?>