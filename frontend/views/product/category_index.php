<?php
/** @var yii\web\View $this */
/** @var \common\models\ProductCategory $category */
?>
<h1><?= $category->title ?></h1>
<?php if ($category != null){?>
<ul class="grid">
    <?php
    if ($products = $category->products){
        foreach ($products as $product) { ?>
            <li class="col-3">
                <div class="product-image square" style="background-image: url(<?= \yii\helpers\Url::to(['/upload/imgprev/'.($product->images ? $product->images[0]->path : '')]) ?>);"></div>
                <a href="<?= \yii\helpers\Url::to(['/product/view', 'id' => $product->id]) ?>"><div class="product-title"><?= $product->title ?></div></a>
                <div class="product-price"><?= $product->priceValue ?></div>
            </li>
        <?php } ?>
    <?php } ?>
</ul>
<?php } ?>