<?php
/**
 * @var $this yii\web\View
 * @var $attribute \yarcode\eav\models\Attribute
 * @var $model \yarcode\eav\models\AttributeOption
 * @var $entityName string
 */
use yii\helpers\Html;
$this->title = $entityName . ' Attribute Options';
$this->params['breadcrumbs'][] = ['label' => $entityName . ' Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $attribute->name, 'url' => ['attribute/update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' => 'Options', 'url' => ['update', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="eav-attribute-option-update">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'attribute' => $attribute,
    ]) ?>
</div>
