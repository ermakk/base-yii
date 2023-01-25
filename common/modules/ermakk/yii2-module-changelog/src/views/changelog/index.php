<?php
/***
* @var $log ActiveDataProvider
 ***/

use ermakk\changelog\widgets\logRowDecode\LogRowDecode;
use yii\grid\GridView;

echo GridView::widget([
    'dataProvider' => $log,
    'columns' => [
//        'id',
//        [
//            'label' => 'fields',
//            'value' => function($data){
//                return json_encode(json_decode($data->fields,true), JSON_UNESCAPED_UNICODE );
//            }
//        ],
        [
            'label' => 'Действие',
            'format' => 'raw',
            'value' => function($data){
                return LogRowDecode::widget([
                    'row' => $data,
                    'classLabelList' => [
                        \common\models\Product::className() => 'Товар',
                        \common\models\Settings::className() => 'Настройку',
                        \common\models\ProductPrice::className() => 'Цену товара',
                        \common\models\ProductReceipt::className() => 'Учет товара',
                        \common\models\ProductCategory::className() => 'Категорию товара',
                        \common\models\ProductType::className() => 'Тип товара',
                    ]
                ] );
            }
        ],
        'date:datetime'
    ],
]);
