<?php
/** @var yii\web\View $this */
/** @var \common\models\Product $product */

$this->title = $product ? $product->title : 'Ошибка';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => \yii\helpers\Url::to(['/product/category'])];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php var_dump($product);?>
