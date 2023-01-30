<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProductPrice $model */
/** @var array $data_product */

$this->title = 'Create Product Price';
$this->params['breadcrumbs'][] = ['label' => 'Product Prices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-price-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'data_product' => $data_product
    ]) ?>

</div>
