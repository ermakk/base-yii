<?php

use common\models\Product;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'artikul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $model->category_id == null ? $form->field($model, 'category_id')->textInput() : '' ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?php
        if (isset($eav) && $eav !== null) {
            $eav->activeForm = $form;
            foreach ($eav->handlers as $handler) {
                echo $handler->run();
            }
        }
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
