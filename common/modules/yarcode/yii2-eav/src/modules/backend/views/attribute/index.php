<?php
/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $entityName string
 */
use yii\grid\GridView;
use yii\helpers\Html;

$this->title = $entityName . ' Attributes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eav-attribute-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create ' . $entityName . ' Attribute', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'layout' => "{items}\n{pager}",
        'columns' => [
            'name',
            'type.name:text:Type',
            [
                'header' => 'Options',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{options}',
                'buttons' => [
                    'options' => function ($url, $model, $key) {
                        /** @var $model \yarcode\eav\models\Attribute */
                        if (!$model->type->hasOptions()) {
                            return '';
                        }
                        $options = [
                            'title' => 'Edit attribute options',
                            'data-pjax' => '0',
                        ];
                        return Html::a('<span class="glyphicon glyphicon-list-alt"></span>',
                            ['attribute-option/index', 'attributeId' => $model->id], $options);
                    }
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
</div>
