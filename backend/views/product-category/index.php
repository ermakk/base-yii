<?php

use common\models\ProductCategory;
use kartik\select2\Select2;
use yii\grid\DataColumn;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\ProductCategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Product Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Product Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'code',
            'comment',
//            'parentName',
            [
                'attribute' => 'parentName',
                'label' => 'Родительская категория',
                'headerOptions' => [
                    'style' => 'width: 100px; white-space: normal;',
                    'class' => 'text-center'
                ],
                'filterOptions' => [
                    'style' => 'width: 150px; white-space: normal;'
                ],
                'value' => function($model){
                    return $model->parentName;
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'parent_id',
                    'data' => ArrayHelper::map(ProductCategory::find()->all(), 'id', 'title'),
                    'options' => [
                        'placeholder' => 'Выберите категорию',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                ]),
            ],
            [
                'label' => 'Товары',
                'class' => DataColumn::class,
                'format' => 'raw',
                'value' => function(ProductCategory $model){
                    return Html::a('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 50 50" width="20" height="20">
<circle style="fill:#43B05C;" cx="25" cy="25" r="25"/>
<line style="fill:none;stroke:#FFFFFF;stroke-width:4;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="25" y1="13" x2="25" y2="38"/>
<line style="fill:none;stroke:#FFFFFF;stroke-width:4;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="37.5" y1="25" x2="12.5" y2="25"/>
</svg>', ['/product/create', 'category_id' => $model->id]);
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ProductCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
