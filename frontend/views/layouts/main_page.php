<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use kartik\bs4dropdown\Dropdown;
use yii\bootstrap4\Breadcrumbs;
use yii\bootstrap4\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <?php $this->registerCsrfMetaTags() ?>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

</head>
<body>
<?php $this->beginBody() ?>

<header>
    <h2><a href="#"><?=Yii::$app->name?></a></h2>

    <?php
    NavBar::begin([
//        'brandLabel' => Yii::$app->name,
//        'brandUrl' => Yii::$app->homeUrl,
//        'brandOptions' => ['class'=>'p-0'],
        'options' => ['class' => 'navbar navbar-expand-lg navbar-light'/*, 'style' => 'text-color: #ccc'*/]
    ]);
    $itemsCat = (new \common\models\ProductCategory())->getNavCatList(null, 1, 2);

    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Catalog', 'items' => $itemsCat],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'form-inline'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
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



<section class="hero">
    <div class="background-image" style="background-image: url(assets/img/hero.jpg);"></div>
    <h1>Responsive Flexbox Template</h1>
    <h3>A freebie by Tutorialzine.</h3>
    <a href="http://tutorialzine.com/2016/06/freebie-landing-page-template-with-flexbox/" class="btn">Download it Here</a>
</section>


<section class="our-work">
    <h3 class="title">Some of our work</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
    <hr>

    <ul class="grid">
        <li class="small" style="background-image: url(assets/img/coast.jpg);"></li>
        <li class="large" style="background-image: url(assets/img/island.jpg);"></li>
        <li class="large" style="background-image: url(assets/img/balloon.jpg);"></li>
        <li class="small" style="background-image: url(assets/img/mountain.jpg);"></li>
        <li class="middle" style="background-image: url(assets/img/balloon.jpg);"></li>
        <li class="middle" style="background-image: url(assets/img/mountain.jpg);"></li>
    </ul>
</section>


<section class="features">
    <h3 class="title">Features and services</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
    <hr>

    <ul class="grid">
        <li>
            <i class="fa fa-camera-retro"></i>
            <h4>Photography</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices vitae pulvinar velit.</p>
        </li>
        <li>
            <i class="fa fa-cubes"></i>
            <h4>Web Development</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices vitae pulvinar velit.</p>
        </li>
        <li>
            <i class="fa fa-newspaper-o"></i>
            <h4>Content Editing</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices vitae pulvinar velit.</p>
        </li>
        </div>
</section>


<section class="reviews">
    <h3 class="title">What others say:</h3>

    <p class="quote">Mauris sit amet mauris a arcu eleifend ultricies eget ut dolor. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
    <p class="author">— Patrick Farrell</p>

    <p class="quote">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
    <p class="author">— George Smith</p>

    <p class="quote">Donec commodo dolor augue, vitae faucibus tortor tincidunt in. Aliquam vitae leo quis mi pulvinar ornare. Integer eu iaculis metus.</p>
    <p class="author">— Kevin Blake</p>


</section>


<section class="contact">
    <h3 class="title">Join our newsletter</h3>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam id felis et ipsum bibendum ultrices. Morbi vitae pulvinar velit. Sed aliquam dictum sapien, id sagittis augue malesuada eu.</p>
    <hr>

    <form>
        <input type="email" placeholder="Email">
        <a href="#" class="btn">Subscribe now</a>
    </form>
</section>

<footer class="footer mt-auto py-3 text-muted">

    <ul>
        <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
        <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
        <li><a href="#"><i class="fa fa-snapchat-square"></i></a></li>
        <li><a href="#"><i class="fa fa-pinterest-square"></i></a></li>
        <li><a href="#"><i class="fa fa-github-square""></i></a></li>
    </ul>
    <div class="container">
        <p class="float-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
