<?php
/** @var yii\web\View $this */
/** @var \common\models\ProductCategory $category */
?>
<h1><?= $category->title ?></h1>
<?php if ($category != null){?>

    <ul class="grid">
    <div class="main-bc w-20">
        <ul class="grid">
<!--            --><?//= var_dump($category->getNavCatList(null, 1, 2)); ?>
        </ul>
    </div>

    <div class="main-bc w-80">
<ul class="grid">
    <?php
    if ($products = $category->products){
        foreach ($products as $product) { ?>
            <li class="f-col-3 cursore-pointer" onclick="window.location.href = '<?= \yii\helpers\Url::to(['/product/view', 'id' => $product->id]) ?>'">
                <div class="product-image square" style="background-image: url(<?= \yii\helpers\Url::to(['/upload/imgprev/'.($product->images ? $product->images[0]->path : '')]) ?>);"></div>
                <div class="product-title"><?= $product->title ?></div>
                <div class="product-price"><?= $product->priceValue ?></div>
            </li>
        <?php } ?>
    <?php } ?>

</ul></div>
    </ul>
<?php } ?>