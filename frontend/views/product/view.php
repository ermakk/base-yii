<?php
/** @var yii\web\View $this */
/** @var \common\models\Product $product */

use common\models\ObjectAttributeValue;
use yii\bootstrap4\ActiveForm;

$this->title = $product ? $product->title : 'Ошибка';
$this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => \yii\helpers\Url::to(['/product/category'])];

/**
* Хлебные крошки.
* Иерархия категорий в хлебных крошках в обратном порядке
*/
$cat = $product->category;
$this->params['breadcrumbs_temp'] = [];
$this->params['breadcrumbs_temp'][] = ['label' => $cat->title, 'url' => \yii\helpers\Url::to(['/product/category/'.$cat->code])];
while ($cat->parent_id !== null){
    $cat = $cat->parent;
    $this->params['breadcrumbs_temp'] = array_merge([['label' => $cat->title, 'url' => \yii\helpers\Url::to(['/product/category/'.$cat->code])]], $this->params['breadcrumbs_temp']);
}
$this->params['breadcrumbs'] = array_merge($this->params['breadcrumbs'], $this->params['breadcrumbs_temp']);
$this->params['breadcrumbs'][] = $this->title;
/**
 * Хлебные крошки.
 */

?>
<div class="d-flex flex-row p-5" style="width: 100vw">
    <div class="d-flex flex-column persent-70">
        <div id="carouselExampleIndicators<?=$product->id?>"  class="carousel slide overflow-hidden d-flex flex-column  justify-content-center align-items-center" data-ride="carousel" >
            <div class="carousel-inner" style="height: 30vw; width: 40vw">
                <?php foreach ($product->images as $key => $images){?>
                    <div class="carousel-item <?php if($key == 0){?> active<?php }?>">
                        <img class="d-block" src="<?= \yii\helpers\Url::to(['/upload/images/'.($images ? $images->path : '')]) ?>">
                    </div>
                <?}?>
            </div>
            <div class="d-flex flex-row justify-content-center " style=" height: 110px;  width: 40vw">
                <?php foreach ($product->images as $key => $images){?>
                    <div data-target="#carouselExampleIndicators<?=$product->id?>" data-slide-to="<?= $key ?>" class="<?php if($key == 0){?> active<?php }?>" style="height: 10% !important; margin: 5px !important;">
                        <img src="<?= \yii\helpers\Url::to(['/upload/imgprev/'.($images ? $images->path : '')]) ?>" style="height: 100px">
                    </div>
                <?}?>
            </div>
        </div>
    </div>
    <div class="persent-30">
        <div class="d-flex flex-column">
            <div class="persent-100">
                <h4><?= $product->title; ?></h4>
                <div class="artikul">Артикул: <span><?= $product->artikul ?></span></div>
            </div>
            <div class="d-flex flex-row p-5">
                <div class="persent-50">
                    <div class="product-action btn btn-success">Купить&nbsp;</div>
                </div>
                <div class="persent-50">
                    <div class="price-detail"><?= $product->priceValue ?></div>
                </div>
            </div>
            <div class="persent-100 mb-2">
            Характеристики:
            </div>
            <?php
            $eav = $product->getEavModel();
            foreach ( $eav->handlers as $handler){ ?>

                <div class="persent-100 d-flex flex-row ml-5">
                    <?php echo $handler->run(); ?>
                </div>
            <?php } ?>
        </div>
    </div>

</div>
<div class="aspect-auto hr-bottom p-4">
    <h6>Описание:</h6>
    <div class=" text-justify" style="text-align: justify !important;">
        <?= $product->text?>
    </div>
</div>