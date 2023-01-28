<?php

use common\models\Product;
use yii\grid\DataColumn;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Product $model */
/** @var array $eav_attr */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' =>  array_merge(
            [
                'id',
                'title',
                'code',
                'artikul',
                'text',
                'category_id',
                'type_id',
                [
                    'label' => 'Изображения',
                    'class' => DataColumn::class,
                    'format' => 'raw',
                    'value' => function(Product $model){
                        $res = '';
                        foreach ($model->image_list as $image){
                            $res .= "<img src='/upload/imgprev/{$image->path}' height='150px' width='auto'>";
                        }
                        return $res;
                    },
                ],
            ],
//            \yii\helpers\ArrayHelper::map($eav_attr, 'label','value')
            $eav_attr
        ),
    ]) ?>

</div>
