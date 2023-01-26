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
$this->params['breadcrumbs'][] = ['label' => $attribute->name, 'url' => ['attribute/update', 'id' => $attribute->id]];
$this->params['breadcrumbs'][] = ['label' => 'Options', 'url' => ['attribute-option/index', 'attributeId' => $attribute->id]];
$this->params['breadcrumbs'][] = 'Create';
?>
<div class="eav-attribute-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'attribute' => $attribute,
    ]) ?>
</div>
