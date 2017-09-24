<!--<aside class="main-sidebar">

    <section class="sidebar">
        
        <div class="user-panel">

        </div>
        <?/*= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => '用户管理', 'icon' => 'dashboard', 'url' => ['/member/index']],
                    ['label' => '业务员管理', 'icon' => 'dashboard', 'url' => ['/salesman/index']],
                    ['label' => '商家管理', 'icon' => 'dashboard', 'url' => ['/merchant/index']],
                    ['label' => 'banner管理', 'icon' => 'dashboard', 'url' => ['/banner/index']],
                   ['label' => '活动管理', 'icon' => 'dashboard', 'url' => ['/activity/index','Activity'=>['merchant_id'=>'']]],
                    [
                        'label' => '活动管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '活动列表', 'icon' => 'file-code-o', 'url' => ['/activity/index','Activity'=>['id'=>1,'merchant_id'=>'']]],
                            ['label' => '历史', 'icon' => 'dashboard', 'url' => ['/activity/index'],],
                            ['label' => '数据', 'icon' => 'dashboard', 'url' => ['/activity-data/index'],],
                        ],
                    ],
    
                    [
                        'label' => '订单管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '已支付', 'icon' => 'file-code-o', 'url' => ['/order/paid-index'],],
                            ['label' => '待支付', 'icon' => 'dashboard', 'url' => ['/order/unpaid-index','Order'=>['status'=>0]],],
                        ],
                    ],
                    [
                        'label' => '退款管理',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => '待处理', 'icon' => 'file-code-o', 'url' => ['/refund-order/paid-index','Order'=>['status'=>2]],],
                            ['label' => '已处理', 'icon' => 'dashboard', 'url' => ['/refund-order/unpaid-index'],],
                        ],
                    ],
                    ['label' => '运营统计', 'icon' => 'dashboard', 'url' => ['/count/index']],
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
                   
                    ['label' => 'assignment', 'icon' => 'dashboard', 'url' => ['/admin/assignment']],
                   ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
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
                    ],
                    
                ],
            ]
        ) */?>

    </section>

</aside>-->

<aside class="main-sidebar">

    <section class="sidebar">
        <?php
      $menu = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id);
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                "encodeLabels" => false,
                "options" => ["class" => "sidebar-menu"],
                'items' => $menu
            ]
        ) ?>

    </section>

</aside>



