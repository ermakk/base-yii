<?php

use common\widgets\Alert;
use frontend\assets\AppAsset;
use kartik\bs4dropdown\Dropdown;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
?>
<header class="header">
    <h2><a href="/"><?=Yii::$app->name?></a></h2>

    <?php

    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
//        'brandOptions' => ['class'=>'p-0'],
        'options' => ['class' => 'navbar navbar-expand-lg navbar-light'/*, 'style' => 'text-color: #ccc'*/]
    ]);
    $itemsCat = (new \common\models\ProductCategory())->getNavCatList();

    $menuItems = [
        ['label' => 'Домой', 'url' => ['/site/index']],
        ['label' => 'Каталог', 'items' => $itemsCat],
        ['label' => 'Контакты', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Регистрация', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                'Выйти (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
        $menuItems[] =
            ['label' => 'Корзина', 'option' => ['id' => 'basket-link'],'class'=>"fa fa-shopping-basket", 'url' => ['/site/orders']/*, 'visible' => !Yii::$app->user->isGuest*/];
    }
    echo Nav::widget([
//        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
        'dropdownClass' => Dropdown::class, // use the custom dropdown
        'options' => ['class' => 'navbar-nav mr-auto me-auto'],
    ]);
    NavBar::end();
    ?>
</header>