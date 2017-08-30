<?php
use yii\widgets\Breadcrumbs;

?>
<!-- begin #content -->
<div id="content" class="content">
    <!-- begin breadcrumb -->
    <?=
    Breadcrumbs::widget(
        [
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'options' => ['class'=> 'breadcrumb pull-right']
        ]
    ) ?>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
    <!-- end page-header -->

    <?= $content ?>

</div>
<!-- end #content -->

<!-- begin theme-panel -->
<div class="theme-panel">
    <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
    <div class="theme-panel-content">
        <h5 class="m-t-0">主题设置</h5>
<!--        <ul class="theme-list clearfix">-->
<!--            <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>-->
<!--            <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>-->
<!--            <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>-->
<!--            <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>-->
<!--            <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>-->
<!--            <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>-->
<!--        </ul>-->
        <div class="divider"></div>
        <div class="row m-t-10">
            <div class="col-md-5 control-label double-line">顶部颜色</div>
            <div class="col-md-7">
                <select name="header-styling" class="form-control input-sm">
                    <option value="1">默认</option>
                    <option value="2">反色</option>
                </select>
            </div>
        </div>
<!--        <div class="row m-t-10">-->
<!--            <div class="col-md-5 control-label">头</div>-->
<!--            <div class="col-md-7">-->
<!--                <select name="header-fixed" class="form-control input-sm">-->
<!--                    <option value="1">固定</option>-->
<!--                    <option value="2">默认</option>-->
<!--                </select>-->
<!--            </div>-->
<!--        </div>-->
        <div class="row m-t-10">
            <div class="col-md-5 control-label double-line">菜单间隔</div>
            <div class="col-md-7">
                <select name="sidebar-styling" class="form-control input-sm">
                    <option value="1">隐藏</option>
                    <option value="2">显示</option>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-5 control-label">侧边栏</div>
            <div class="col-md-7">
                <select name="sidebar-fixed" class="form-control input-sm">
                    <option value="1">固定</option>
                    <option value="2">滚动</option>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-5 control-label double-line">侧边栏梯度</div>
            <div class="col-md-7">
                <select name="content-gradient" class="form-control input-sm">
                    <option value="1">禁用</option>
                    <option value="2">启用</option>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-5 control-label double-line">内容样式</div>
            <div class="col-md-7">
                <select name="content-styling" class="form-control input-sm">
                    <option value="1">默认</option>
                    <option value="2">黑色</option>
                </select>
            </div>
        </div>
        <div class="row m-t-10">
            <div class="col-md-12">
                <a href="#" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage"><i class="fa fa-refresh m-r-3"></i>默认设置</a>
            </div>
        </div>
    </div>
</div>
<!-- end theme-panel -->

<!-- begin scroll to top btn -->
<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
<!-- end scroll to top btn -->

