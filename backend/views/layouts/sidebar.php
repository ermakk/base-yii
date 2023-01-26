
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link" title="Перейти на сайт" >
        <img src="<?= \common\models\Settings::getValue('Logo')?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= \common\models\Settings::getValue('title')?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?=$assetDir?>/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"><?=Yii::$app->user->identity->username ?: '<a href="/user/profile">Укажите свое имя</a>'?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Рабочий стол',
                        'icon' => 'tachometer-alt',
                        'url' => ['/'],
                        'badge' => '<span class="right badge badge-info">2</span>',

                    ],
                    ['label' => 'АДМИНИСТРИРОВАНИЕ', 'header' => true, 'visible' => Yii::$app->user->can('superadmin')],
                        ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank', 'visible' => Yii::$app->user->can('superadmin')],
                        ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank', 'visible' => Yii::$app->user->can('superadmin')],
                    ['label' => 'КАТАЛОГ', 'header' => true],
                    [
                        'label' => 'Продукция',
                        'items' => [
                            ['label' => 'Редактор', 'url' => ['/product/'], 'iconStyle' => 'far'],
                            ['label' => 'Учет продукции', 'iconStyle' => 'far', 'url' => ['/transactions']],
                            [
                                'label' => 'Level2',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                ]
                            ],
                            ['label' => 'Level2', 'iconStyle' => 'far']
                        ]
                    ],
                    ['label' => 'Категории', 'url' => ['/product-category']],
                    ['label' => 'Типы', 'url' => ['/product-type']],
                    ['label' => 'Аттрибуты', 'url' => ['/eav/attribute/index'], 'visible' => Yii::$app->user->can('superadmin')],
                    ['label' => 'ГЛАВНАЯ СТРАНИЦА', 'header' => true],
                        ['label' => 'Слайдер', 'url' => ['/main-page/slider']],
                        ['label' => 'Меню', 'url' => ['/main-page/menu']],
                        ['label' => 'Новости', 'url' => ['/main-page/news']],
                    ['label' => 'ПРОДАЖИ', 'header' => true],
                        [
                            'label' => 'Заказы',
                            'url' => ['/orders'],
                            'icon' => 'money-check-alt',
                            'badge' => '<span class="right badge badge-info">2</span>',

                        ],
                    ['label' => 'КЛИЕНТЫ', 'header' => true],
                        ['label' => 'Важные', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger', 'badge' => '<span class="right badge badge-danger">New</span>'],
                        ['label' => 'Заказчики', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                        ['label' => 'Все пользователи', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                    [
                        'label' => 'НАСТРОЙКИ',
//                        'icon' => 'th'
                        'url' => ['/settings'],
                        'icon' => 'microchip'
                    ],
                ],
                'options' => [
                    'class' => 'nav nav-pills nav-sidebar flex-column nav-legacy nav-compact',
                    'data-widget' => 'treeview',
                    'role' => 'menu',
                    'data-accordion' => 'false'
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>