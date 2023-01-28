<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = 'Create Product';
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
       if(isset($eav) && $eav !== null) {
           echo $this->render('_form', [

               'model' => $model,
               'eav' => $eav,
               'categoryList' => $categoryList
           ]);
       } else {
           echo $this->render('_form', [
               'model' => $model,
               'categoryList' => $categoryList
           ]);
       }
    ?>

</div>
