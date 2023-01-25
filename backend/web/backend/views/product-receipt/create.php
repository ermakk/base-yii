<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProductReceipt $model */

$this->title = 'Create Product Receipt';
$this->params['breadcrumbs'][] = ['label' => 'Product Receipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-receipt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
