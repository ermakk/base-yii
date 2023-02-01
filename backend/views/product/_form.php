<?php

use common\models\Product;
use kartik\file\FileInput;
use lo\widgets\modal\ModalAjax;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>


    <?= $form->field($model, 'file[]')->label('Изображения')->widget(FileInput::classname(), [
        'options' => [
            'multiple' => true,
            'accept' => 'image/*'
        ],
        'pluginOptions' => [
            'deleteUrl' => Url::toRoute(['product/delete-image', 'id' => $model->id]), //это урл экшэна.
            'previewFileType' => 'image' ,
            'showUpload' => false,
            'showPreview' => true,
            'showCaption' => false,
            'showRemove' => false,
            'language' => 'ru',
            'initialPreview'=>  array_column($model->imageList, 'path'),
            'initialPreviewConfig' => $model->imageList,
            'overwriteInitial' => false,
//            'uploadToken' => Yii::$app->request->getCsrfToken(),
            'initialPreviewAsData'=>true,
            'maxFileCount' => 10
        ],
        'pluginEvents' => [
            "fileremove" => "function() { console.log(\"fileclear\"); }",
        ],

    ]);?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true])->label($model->getAttributeLabel('title'). '  
        <span  class="" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
            &nbsp;(Заполнить поле CODE?)
        </span>') ?>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?= $form->field($model, 'artikul')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(),[
        'editorOptions' => [
            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
            'inline' => false, //по умолчанию false
        ],
    ]); ?>

    <?= !isset($model->category_id) || isset($model->id) ? $form->field($model, 'category_id')->dropDownList(\yii\helpers\ArrayHelper::map($categoryList, 'id', 'title')) : '' ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?php
        if (isset($eav) && $eav !== null) {
            $eav->activeForm = $form;
//            var_dump($eav->handlers); die;
            if ($eav->handlers !== null) {
                foreach ($eav->handlers as $handler) {
                    echo $handler->run();
                }
            }
        }
    ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
