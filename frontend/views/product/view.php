<?php
/** @var yii\web\View $this */
/** @var \common\models\Product $product */

use common\models\ObjectAttributeValue;
use kartik\rating\StarRating;
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
//var_dump($product->getReatingValue());
$JS = "colorSelect = function(el){
        $('#order-btn-product').data('attr', el.dataset.attr);
        $(el).parent().find('a').each(function(){
            $(this).removeClass('selected');
        });
        $(el).addClass('selected');
    }
    orderBtnClick = function(el){
        products = [];
        if (localStorage.getItem('product') !== null){
            products = JSON.parse(localStorage.getItem('product')).concat( [
                {
                    pid: $(el).data('pid'),
                    attr: [
                        $(el).data('attr')
                    ]   
                }
            ]);
        } else {
            products = [
                {
                    pid: $(el).data('pid'),
                    attr: [
                        $(el).data('attr')
                    ]   
                }
            ];
        }
        localStorage.setItem('product', JSON.stringify(products));
    }
    ";
$this->registerJs($JS, $this::POS_READY);
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
                <div class="d-flex flex-row">
                    <div class="persent-50">
                        <div class="artikul">Артикул: <span><?= $product->artikul ?></span></div>
                    </div>
                    <div class="persent-50">
                        <?= StarRating::widget([
                                'name' => 'reating',
                            'value' =>  $product->getReatingValue(),
                            'pluginOptions' => [
                                'displayOnly' => true,
                                'size' => 'xs',
                            ]
                        ]);?>

                    </div>
                    <div class="persent-50">
                        <?php $reviewCount = strval( $product->getReviews()->count());  ?>
                        <a href="#review-block"><?=$reviewCount. ' '.( !in_array(substr($reviewCount, strlen($reviewCount) - 2, 2), ['11', '12', '13', '14']) &&  in_array(substr($reviewCount, strlen($reviewCount) - 1, 1), ['1', '2', '3', '4']) ? 'отзыва' :'отзывов')?></a>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-row p-3">
                <div class="persent-50">
                    <div class="product-action btn btn-success" id="order-btn-product" data-pid="<?= $product->id ?>" data-attr="" onclick="orderBtnClick(this)">Купить&nbsp;</div>
                </div>
                <div class="persent-50">
                    <div class="price-detail"><?= $product->priceValue ?></div>
                </div>
            </div>
<!---->
            <?php
            if ($eav = $product->getEavModel(['selected' => 'Selected'])) {
                foreach ( $eav->handlers as $handler){ ?>

                    <div class="persent-100 d-flex flex-row mb-3">
                        <?php
                            echo $handler->run([
                                'selected' => true,
                                'onclick' => "colorSelect(this)"
                            ]);
                        ?>
                    </div>
                <?php }
            }?>
            <div class="persent-100 mb-2">
            Характеристики:
            </div>
            <?php
            if($eav){
                foreach ( $eav->handlers as $handler){ ?>

                    <div class="persent-100 d-flex flex-row ml-5">
                        <?php
                        echo $handler->run([
                            'selected' => false
                        ]); ?>
                    </div>
                <?php }
            }?>
        </div>
    </div>

</div>
<div class="aspect-auto hr-bottom p-4">
    <h6>Описание:</h6>
    <div class=" text-justify" style="text-align: justify !important;">
        <?= $product->text?>
    </div>
</div>
<?php if($product->reviews) { ?>
    <div class="aspect-auto hr-bottom p-4" id="review-block">
        <h6>Отзывы:</h6>
        <div class=" text-justify" style="text-align: justify !important;">
            <?php foreach ($product->reviews as $review){?>
                <div class="d-flex flex-column mb-5">
                    <div class="persent-100 d-flex flex-row">
                        <div class="persent-10">
                            <div class="user-avatar"><img src="https://loremflickr.com/100/100?random=<?= $review->userCreated->id ?>"></div>
                            <div class="user-name"><?= $review->userCreated->username ?></div>
                        </div>
                        <div class="persent-100">
                            <?= StarRating::widget([
                                'name' => 'reating',
                                'value' =>  $review->reating,
                                'pluginOptions' => [
                                    'displayOnly' => true,
                                    'size' => 'xs',
                                ]
                            ]);?>
                        </div>
                    </div>
                    <div class="persent-100 d-flex flex-column">
                        <div class="persent-100 p-3" style="border-radius: 10px; background-color: #eee;">
                            <div class="review-data">
<!--                                --><?//= $review->created_at ?>
                                <?= date("m.d.y") ?>
                            </div>
                            <div class="review-text ml-5 m-3 pl-3" style="border-left: 2px solid #888;">
                                <?= $review->value ?>
                            </div>
                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php } ?>