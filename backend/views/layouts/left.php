<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    ['label' => '用户管理', 'icon' => 'dashboard', 'url' => ['/member/index']],
                    ['label' => '业务员管理', 'icon' => 'dashboard', 'url' => ['/salesman/index']],
                    ['label' => '商家管理', 'icon' => 'dashboard', 'url' => ['/merchant/index']],
                    ['label' => 'banner管理', 'icon' => 'dashboard', 'url' => ['/banner/index']],
                    ['label' => '活动管理', 'icon' => 'dashboard', 'url' => ['/activity/index']],
    
                    [
                        'label' => '订单管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '已支付', 'icon' => 'file-code-o', 'url' => ['order/paid-index','Order'=>['status'=>1]],],
                            ['label' => '待支付', 'icon' => 'dashboard', 'url' => ['order/unpaid-index','Order'=>['status'=>0]],],
                        ],
                    ],
                    [
                        'label' => '退款管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '待处理', 'icon' => 'file-code-o', 'url' => ['refund-order/paid-index','Order'=>['status'=>2]],],
                            ['label' => '已处理', 'icon' => 'dashboard', 'url' => ['refund-order/unpaid-index','Order'=>['status'=>[3,4]]],],
                        ],
                    ],
                    ['label' => '运营统计', 'icon' => 'dashboard', 'url' => ['/banner/index']],
                    ['label' => '系统设置', 'icon' => 'dashboard', 'url' => ['/banner/index']],
                    ['label' => '管理员列表', 'icon' => 'dashboard', 'url' => ['/admin/user']],
                    [
                        'label' => '权限管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '分配', 'icon' => 'dashboard', 'url' => ['/admin']],
                            ['label' => '路由', 'icon' => 'dashboard', 'url' => ['/admin/route']],
                            ['label' => '菜单', 'icon' => 'dashboard', 'url' => ['/admin/menu']],
                            ['label' => '权限', 'icon' => 'dashboard', 'url' => ['/admin/permission']],
                            ['label' => '角色', 'icon' => 'dashboard', 'url' => ['/admin/role']],
                        ],
                    ],
                    ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii']],
                    ['label' => '日志', 'icon' => 'dashboard', 'url' => ['/debug']],
                    
                   // ['label' => 'assignment', 'icon' => 'dashboard', 'url' => ['/admin/assignment']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    /*[
                        'label' => 'Same tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],*/
                    
                ],
            ]
        ) ?>

    </section>

</aside>
