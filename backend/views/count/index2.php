<section class="content-header">
    <h1>
        区间统计
    </h1>
    <ol class="breadcrumb">
            <?php
            $this->title = '';
            $form = \yii\bootstrap\ActiveForm::begin(
                ['method' => 'get',
                    'options' => ['class' => 'form-inline'],
                    'action' => \yii\helpers\Url::to(['count/index']),
                ]
            );
            echo $form->field($search, 'start')->widget(\kartik\datetime\DateTimePicker::className(), [
                    'options' => ['placeholder' => ''],
                    'pluginOptions' => [
                        'autoclose' => true,
                        'todayHighlight' => true,
                    ]
                ]) . '&nbsp &nbsp &nbsp';
            //echo $form->field($search,'end')->textInput(['placeholder'=>'结束时间'])->label(false).'&nbsp &nbsp &nbsp';
            echo $form->field($search, 'end')->widget(\kartik\datetime\DateTimePicker::className(), [
                'options' => ['placeholder' => ''],
                'pluginOptions' => [
                    'autoclose' => true,
                    'todayHighlight' => true,
                ]
            ]);
            echo \yii\bootstrap\Html::submitButton('搜索', ['class' => 'btn btn-xs btn-primary', 'style' => 'margin-bottom:11px;margin-left:19px;height:32px;width:44px']);
            \yii\bootstrap\ActiveForm::end();
            ?>
    </ol>
</section>

<!-- Main content -->
<section class="content" style="margin-top: 60px">
    <!-- Info boxes -->
    <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">

                <span class="info-box-icon bg-aqua"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">订单数</span>
                    <span class="info-box-number"><?=$rows['order_num']?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">活动数</span>
                    <span class="info-box-number"><?=$rows['activity_num']?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">流水</span>
                    <span class="info-box-number"><?=$rows['water']?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">结算金额</span>
                    <span class="info-box-number"><?=$rows['money']?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">利润</span>
                    <span class="info-box-number"><?=$rows['return']?></span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">总额统计</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">

                            <span class="info-box-icon bg-aqua"><i class="fa fa-google-plus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">用户数</span>
                                <span class="info-box-number"><?=$row['user']?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">商户数</span>
                                <span class="info-box-number"><?=$row['merchant']?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->

                    <!-- fix for small devices only -->
                    <div class="clearfix visible-sm-block"></div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="fa fa-google-plus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">订单数</span>
                                <span class="info-box-number"><?=$row['order_num']?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">活动总数</span>
                                <span class="info-box-number"><?=$row['activity_num']?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">正在进行活动</span>
                                <span class="info-box-number"><?=$row['in_activity']?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">历史活动数</span>
                                <span class="info-box-number"><?=$row['activity_history']?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">总流水</span>
                                <span class="info-box-number"><?=$row['water']?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">总结算金额</span>
                                <span class="info-box-number"><?=$row['money']?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="fa fa-google-plus"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">总利润</span>
                                <span class="info-box-number"><?=$row['return']?></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
</section>

  


