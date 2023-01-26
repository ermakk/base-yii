<?php
/**
 * @var $this yii\web\View
 * @var $attribute \yarcode\eav\models\Attribute
 * @var $entityName string
 */
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = $entityName . ' Attribute Options';
$this->params['breadcrumbs'][] = ['label' => $entityName . ' Attributes', 'url' => ['attribute/index']];
$this->params['breadcrumbs'][] = ['label' => $attribute->name, 'url' => ['attribute/update', 'id' => $attribute->id]];
$this->params['breadcrumbs'][] = 'Options';
?>
<div class="eav-attribute-options">
    <div class="eav-attribute-index">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a('Create Option', ['create', 'attributeId' => $attribute->id], ['class' => 'btn btn-success']) ?>
        </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'value',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{delete}',
                    'headerOptions' => ['style' => 'width: 48px'],
                ]
            ],
        ]) ?>
    </div>
</div>
