<?php
/** @var yii\web\View $this */
/** @var \common\models\ProductCategory $category */
?>
<?php if ($category != null){?>

    <ul class="grid">
    <div class="main-bc w-20">
        <ul class="grid">
<!--            --><?//= var_dump($category->getNavCatList(null, 1, 2)); ?>
        </ul>
    </div>

    <div class="main-bc w-80">
        <h3 style="width: 100%; text-align: center"><?= $category->title ?></h3>
        <div class="content-block block-filter">
            Сортировка: <span class="price"> цена</span>
            Cтоимость: <span class="price"> > 700</span>
            Cтоимость: <span class="price"> < 70000</span>
            Наличие: <span class="price"> В наличии</span>
        </div>
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