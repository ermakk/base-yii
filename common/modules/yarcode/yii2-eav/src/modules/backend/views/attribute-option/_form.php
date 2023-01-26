<?php
/**
 * @var $this yii\web\View
 * @var $model \yarcode\eav\models\Attribute
 * @var $attribute \yarcode\eav\models\Attribute
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<div class="eav-attribute-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'value')->textInput() ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update',
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::a('Cancel', ['index', 'attributeId' => $attribute->id], ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
