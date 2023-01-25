<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\ProductCategory $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $data_category */
?>

<div class="product-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::classname(), [
        'data' => $data_category,
        'options' => ['placeholder' => 'Нет родительской'],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 1,
//            'ajax' => [
//                'url' => Url::to(['film/getfilmname']),
////                    'delay' => 250,
//                'dataType' => 'json',
//                'data' =>  new JsExpression('function(params) { return {q:params.term}; }'),
//            ],
        ],
//        'addon' => [
//            'append' => [
//                'content' => Html::button('<i class="fas fa-plus"></i> Новая', [
//                    'id' => 'create_film_button',
//                    'class' => 'btn btn-secondary',
//                    'href' => Url::to(['product-category/create']),
//                    'title' => 'Mark on map',
////                            'data-toggle' => 'kartik-popover',
//                    'data-bs-toggle' => "modal",
//                    'data-bs-target' => "#kartik-popover"
//                ]),
//                'asButton' => true
//            ]
//        ]
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
