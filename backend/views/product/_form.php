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

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'type_id')->textInput() ?>

    <?
//        $attr = new mirocow\eav\models\EavAttribute();
//        $attr->attributes = [
//            'entityId' => 1,                        // Category ID
//            'typeId' => 1,                          // ID type from eav_attribute_type
//            'name' => 'Color',                    // service name field
//            'label' => 'Color',                   // label text for form
//            'defaultValue' => '#888',              // default value
//            'entityModel' => Product::className(),  // work model
//            'required' => true
//        ];
//        $attr->save();
//            echo $form->field($model,'color', ['class' => '\mirocow\eav\widgets\ActiveField'])->eavInput();
        foreach($model->getEavAttributes()->all() as $attr) {
            echo $form->field($model, $attr->name, ['class' => '\mirocow\eav\widgets\ActiveField'])->eavInput();
        }
    ?>
    <?= \mirocow\eav\admin\widgets\Fields::widget([
        'model' => $model,
        'categoryId' => $model->category_id,
        'entityName' => 'product',
        'entityModel' => Product::className(),
    ])?>
<!--    <table class="table">-->
<!--        --><?php
//        foreach ($model->getEavAttributes()->all() as $attr) {
//            ?>
<!--            <tr>-->
<!--                <td>--><?//= $attr->type; ?><!--</td>-->
<!--                <td>-->
<!--                    <ul>-->
<!--                        --><?php
//                        $attrValue = $model->renderEavAttr($attr, $model);
//                        if ($attrValue[0]['value']) {
//                            foreach ($attrValue as $attrValueItem) {
//                                echo '<li>';
//                                echo $attrValueItem['value'];
//                                echo '</li>';
//                            }
//                        } else echo '---';
//                        ?>
<!--                    </ul>-->
<!--                </td>-->
<!--            </tr>-->
<!--            --><?php
//        }
//        ?>
<!--    </table>-->
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
