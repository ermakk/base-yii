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
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::$app->session->hasFlash('error')): ?>
        <div class="alert alert-danger alert-dismissable">
            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php endif; ?>
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
//                'label' => 'Товары',
                'class' => DataColumn::class,
                'format' => 'raw',
                'value' => function(ProductCategory $model){
                    return Html::a('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 50 50" width="16" height="16">
<circle style="fill:#43B05C;" cx="25" cy="25" r="25"/>
<line style="fill:none;stroke:#FFFFFF;stroke-width:4;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="25" y1="13" x2="25" y2="38"/>
<line style="fill:none;stroke:#FFFFFF;stroke-width:4;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="37.5" y1="25" x2="12.5" y2="25"/>
</svg>', ['/product/create', 'category_id' => $model->id], ['title' => 'Добавить товар в категорию']);
                },
            ],
            [
//                'label' => 'Аттрибуты',
                'class' => DataColumn::class,
                'format' => 'raw',
                'value' => function(ProductCategory $model){
                    return Html::a('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="16" width="16" version="1.1" id="Capa_1" viewBox="0 0 57 57" xml:space="preserve">
<circle style="fill:#7383BF;" cx="11" cy="28.456" r="9"/>
<circle style="fill:#7383BF;" cx="46" cy="48" r="9"/>
<circle style="fill:#7383BF;" cx="46" cy="9" r="9"/>
<g>
	<path style="fill:#424A60;" d="M19.017,25.36c0.176,0,0.354-0.046,0.515-0.144l18.908-11.388c0.473-0.285,0.625-0.899,0.34-1.372   c-0.285-0.474-0.899-0.627-1.373-0.341L18.5,23.504c-0.473,0.285-0.625,0.899-0.34,1.372C18.347,25.188,18.677,25.36,19.017,25.36z   "/>
	<path style="fill:#424A60;" d="M38.442,43.171L19.535,31.694c-0.472-0.287-1.087-0.138-1.374,0.336   c-0.287,0.472-0.136,1.087,0.336,1.373L37.404,44.88c0.162,0.099,0.341,0.146,0.518,0.146c0.338,0,0.667-0.171,0.856-0.481   C39.065,44.072,38.915,43.457,38.442,43.171z"/>
</g>
</svg>', ['/eav/attribute/create', 'category_id' => $model->id], ['title' => 'Добавить динамические аттрибуты в категорию']);
                },
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {strictDelete}',
                'urlCreator' => function ($action, ProductCategory $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                'buttons'=>[
                    'view'=>function ($url) {
                        return Html::a('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 52.966 52.966" xml:space="preserve">
<circle style="fill:#57ABC1;" cx="21.983" cy="21" r="20"/>
<line style="fill:none;stroke:#556080;stroke-width:2;stroke-linecap:round;stroke-miterlimit:10;" x1="35.437" y1="35.798" x2="50.983" y2="51.966"/>
<path style="fill:#7CCBD8;" d="M3.002,27.253c0.848,2.582,2.24,5.018,4.167,7.146L35.382,6.186  c-2.129-1.928-4.564-3.319-7.146-4.167L3.002,27.253z"/>
<path style="fill:#556080;" d="M21.983,42c-11.58,0-21-9.42-21-21s9.42-21,21-21s21,9.42,21,21S33.562,42,21.983,42z M21.983,2  c-10.477,0-19,8.523-19,19s8.523,19,19,19s19-8.523,19-19S32.459,2,21.983,2z"/>
</svg>', $url, ['title' => 'Посмотреть категорию']);
                    },
                    'update'=>function ($url) {
                        return Html::a('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="16" width="16" version="1.1" id="Capa_1" viewBox="0 0 53.255 53.255" xml:space="preserve">
<path style="fill:#D75A4A;" d="M39.598,2.343c3.124-3.124,8.19-3.124,11.314,0s3.124,8.19,0,11.314L39.598,2.343z"/>
<polygon style="fill:#ED8A19;" points="42.426,17.899 16.512,43.814 15.982,48.587 44.548,20.02 44.548,20.02 "/>
<polygon style="fill:#ED8A19;" points="10.325,42.93 15.098,42.4 41.012,16.485 36.77,12.243 10.855,38.157 "/>
<polygon style="fill:#ED8A19;" points="35.356,10.829 33.234,8.707 33.234,8.707 4.668,37.273 9.441,36.743 "/>
<polygon style="fill:#C7CAC7;" points="48.79,15.778 48.79,15.778 50.912,13.657 39.598,2.343 37.476,4.465 37.477,4.465 "/>
<polygon style="fill:#C7CAC7;" points="36.062,5.879 36.062,5.879 34.648,7.293 34.648,7.293 45.962,18.606 45.962,18.606   47.376,17.192 47.376,17.192 "/>
<path style="fill:#FBCE9D;" d="M14.424,44.488l-5.122,0.569c-0.036,0.004-0.073,0.006-0.109,0.006c0,0-0.001,0-0.001,0H9.192H9.192  c-0.001,0-0.001,0-0.001,0c-0.036,0-0.073-0.002-0.109-0.006c-0.039-0.004-0.071-0.026-0.108-0.035  c-0.072-0.017-0.141-0.035-0.207-0.067c-0.05-0.024-0.093-0.053-0.138-0.084c-0.057-0.04-0.109-0.083-0.157-0.134  c-0.038-0.04-0.069-0.081-0.1-0.127c-0.038-0.057-0.069-0.116-0.095-0.181c-0.022-0.054-0.038-0.107-0.05-0.165  c-0.007-0.032-0.024-0.059-0.028-0.092c-0.004-0.038,0.01-0.073,0.01-0.11c0-0.038-0.014-0.072-0.01-0.11l0.569-5.122l-5.122,0.569  c-0.037,0.004-0.075,0.006-0.111,0.006c-0.079,0-0.152-0.024-0.227-0.042L0.442,51.399l2.106-2.106c0.391-0.391,1.023-0.391,1.414,0  s0.391,1.023,0,1.414l-2.106,2.106l12.03-2.864c-0.026-0.109-0.043-0.222-0.03-0.339L14.424,44.488z"/>
<path style="fill:#38454F;" d="M3.962,49.293c-0.391-0.391-1.023-0.391-1.414,0l-2.106,2.106L0,53.255l1.856-0.442l2.106-2.106  C4.352,50.316,4.352,49.684,3.962,49.293z"/>
<polygon style="fill:#F2ECBF;" points="48.79,15.778 37.477,4.465 37.476,4.465 36.062,5.879 36.062,5.879 47.376,17.192   47.376,17.192 48.79,15.778 "/>
<path style="fill:#EBBA16;" d="M41.012,16.485L15.098,42.4l-4.773,0.53l0.53-4.773L36.77,12.243l-1.414-1.414L9.441,36.743  l-4.773,0.53l-1.133,1.133l-0.228,0.957c0.075,0.018,0.147,0.042,0.227,0.042c0.036,0,0.074-0.002,0.111-0.006l5.122-0.569  l-0.569,5.122c-0.004,0.038,0.01,0.073,0.01,0.11c0,0.038-0.014,0.072-0.01,0.11c0.004,0.033,0.021,0.06,0.028,0.092  c0.012,0.057,0.029,0.112,0.05,0.165c0.026,0.064,0.057,0.124,0.095,0.181c0.03,0.045,0.063,0.088,0.1,0.127  c0.047,0.05,0.1,0.094,0.157,0.134c0.044,0.031,0.089,0.061,0.138,0.084c0.065,0.031,0.135,0.05,0.207,0.067  c0.038,0.009,0.069,0.03,0.108,0.035c0.036,0.004,0.072,0.006,0.109,0.006h0.001h0h0.001h0.001c0,0,0.001,0,0.001,0h0  c0.035,0,0.072-0.002,0.109-0.006l5.122-0.569l-0.569,5.122c-0.013,0.118,0.004,0.23,0.03,0.339l0.963-0.229l1.133-1.132l0.53-4.773  l25.914-25.915L41.012,16.485z"/>
<polygon style="fill:#F2ECBF;" points="45.962,18.606 34.648,7.293 34.648,7.293 33.234,8.707 33.234,8.707 35.356,10.829   36.77,12.243 41.012,16.485 42.426,17.899 44.548,20.02 44.548,20.02 45.962,18.606 "/>
</svg>', $url, ['title' => 'Изменить категорию']);
                    },
                    'delete'=>function ($url) {
                        return Html::a('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16"  viewBox="0 0 58 58" xml:space="preserve">
<path style="fill:#23A24D;" d="M49,7l-1.956,47c0,0-0.085,4-3.908,4H28.54h-0.059H14.864c-3.823,0-3.908-4-3.908-4L9,7"/>
<path style="fill:none;stroke:#33636C;stroke-width:2;stroke-miterlimit:10;" d="M36.999,7c0,0,0.156-6-4-6h-5.061h0.122H23  c-4.156,0-4,6-4,6"/>
<line style="fill:none;stroke:#61B872;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="29" y1="17" x2="29" y2="50"/>
<line style="fill:none;stroke:#61B872;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="19" y1="17" x2="19" y2="50"/>
<line style="fill:none;stroke:#61B872;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="39" y1="17" x2="39" y2="50"/>
<line style="fill:none;stroke:#33636C;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="6" y1="7" x2="52" y2="7"/>
</svg>', $url, ['title' => 'Удалить категорию']);
                    },
                    'strictDelete'=>function ($url) {
                        if(Yii::$app->user->can('superadmin')) {
                            return Html::a('<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="16" height="16" viewBox="0 0 58 58" xml:space="preserve">
<path style="fill:none;stroke:#DC691D;stroke-width:2;stroke-miterlimit:10;" d="M36.999,7c0,0,0.156-6-4-6h-5.061h0.122H23  c-4.156,0-4,6-4,6"/>
<line style="fill:none;stroke:#DC691D;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="6" y1="7" x2="52" y2="7"/>
<path style="fill:#DC691D;" d="M9.167,11l1.789,43c0,0,0.085,4,3.908,4h13.617h0.059h14.596c3.823,0,3.908-4,3.908-4l1.789-43H9.167  z"/>
<line style="fill:none;stroke:#EBBA16;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="17" y1="53" x2="41" y2="53"/>
<line style="fill:none;stroke:#EBBA16;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="17" y1="48" x2="41" y2="48"/>
<line style="fill:none;stroke:#EBBA16;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;" x1="17" y1="43" x2="41" y2="43"/>
</svg>', $url, ['title' => 'Удалить категорию несмотря на связи']);
                        } else {
                            return '';
                        }
                    },
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
