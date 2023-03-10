<?php
/**
 * @var $this yii\web\View
 * @var $model \yarcode\eav\models\Attribute
 * @var $entityName string
 * @var $typesQuery \yii\db\ActiveQuery
 */
use yii\helpers\Html;

$this->title = $entityName . ' Attributes';
$this->params['breadcrumbs'][] = ['label' => $entityName . ' Attributes', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Create';
?>
<div class="eav-attribute-create">
    <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
        'typesQuery' => $typesQuery,
        'categoryList' => $categoryList,
    ]) ?>
</div>
