<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\ProductReceipt $model */

$this->title = 'Update Product Receipt: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Product Receipts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="product-receipt-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
