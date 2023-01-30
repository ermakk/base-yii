<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ProductPrice $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-price-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'value')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
