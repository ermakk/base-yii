<?php
/** @var yii\web\View $this */
/** @var \common\models\ProductCategory $category */
/** @var \common\models\Product[] $products */
/** @var array $params */

use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
use yii\helpers\Url;
use yii\widgets\Pjax;

$this->title = 'view';
if(array_key_exists('code', $_GET)) {
    $this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => \yii\helpers\Url::to(['/product/category'])];
    $this->params['breadcrumbs'][] = ['label' => $category->title, 'url' => \yii\helpers\Url::to(['/product/category/'.$_GET['code']])];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Каталог', 'url' => \yii\helpers\Url::to(['/product/category'])];
}
$get = $_GET;
if(array_key_exists('sort', $get)) {
    unset($get['sort']);
}
if(Yii::$app->request->pathInfo != 'product/index' && array_key_exists('code', $get)) {
    unset($get['code']);
}


?>
<?php if ($category !== null){?>
    <h4 style="width: 100%; text-align: center"><?= $category->title?> <span class="counts-product-view"> <?= count($category->products) ?> товаров</span> </h4>

<?php } else { ?>

    <h4 style="width: 100%; text-align: center">Все товары </h4>
<?php } ?>

<?php Pjax::begin(['id'=>'id-pjax', 'options' => ['tag' => 'ul', 'class' => 'grid']]); ?>
    <div class="main-bc w-20">
        <div class="grid">
            <div class="main-bc filter">
                <?php for ($i = 1; $i<=5; $i++){?>
                    <div  class="filter-item filter-item-title" data-toggle="collapse" data-target="#collapseExample<?=$i?>" aria-expanded="false" aria-controls="collapseExample" style="cursor: pointer">
                        &nbsp;По наличию
                    </div>
                    <div class="collapse" id="collapseExample<?=$i?>">
                        <div class="filter-item filter-item-body">
                            в наличии
                        </div>
                    </div>
                <?php }?>
            </div>
<!--            --><?//= var_dump($category->getNavCatList(null, 1, 2)); ?>
        </div>
    </div>

    <div class="main-bc w-80">
        <div class="content-block block-filter" style="font-size: 12pt">
                <div class="">
                    Сортировка:
                </div>
                <div class="">
                    <?= Html::dropDownList(
                        'sort',
                        Yii::$app->request->get('sort'),
                        [
                            'category_id' => 'По категории',
                            'title' => 'По названию ▲',
                            '-title' => 'По названию ▼',
                            'price' => 'Дешевле',
                            '-price' => 'Дороже'
                        ],
                        [
                            'id' => 'sort_form',
                            'class' => 'filter_value',
                            'onchange' => '
                                let sort_val = $("#sort_form").val();
                                window.location.href = "'.Url::to(array_merge([Yii::$app->request->pathInfo], count($get) ? $get : [])).(count($get) ? '&' : '?').'sort="+sort_val
                            ',
                        ]);

                    ?>
                </div>
            Фильтры:&nbsp;
            <?php foreach ($params as $key => $param) { ?>
                <?php if(!in_array($key, ['page', 'sort', 'per-page'])) { ?>
                    <span class="filter_value">
                        <?php switch ($key) {
                            case 'title':
                                echo "Название: %".$param."%";
                                break;
                            case 'price_max':
                                echo "Стоимость до: ".$param;
                                break;
                            case 'price_min':
                                echo "Стоимость от: ".$param;
                                break;
                            case 'code':
                                echo "Категория: ".$category->title;
                                break;
                            default:
                                echo $param;
                        } ?>
                    </span>
<!--                Cтоимость: <span class="price"> > 700</span>-->
<!--                Cтоимость: <span class="price"> < 70000</span>-->
<!--                Наличие: <span class="price"> В наличии</span>-->
                <?php } ?>
            <?php } ?>
        </div>
<ul class="grid">
    <?php
    if ($arProducts = $category ? $category->products : $products->models){
        foreach ($arProducts as $pkey => $product) { ?>
            <li class="f-col-3 cursore-pointer" >
                <div class="product-image square">
                    <div id="carouselExampleIndicators<?=$pkey?>" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php foreach ($product->images as $key => $images){?>

                                <div class="carousel-item<?php if($key == 0){?> active<?php }?>">
                                    <img class="d-block w-100" src="<?= \yii\helpers\Url::to(['/upload/imgprev/'.($images ? $images->path : '')]) ?>">
                                </div>
                            <?}?>
                        </div>
                        <?php if(is_array($product->images) && count($product->images)>1) { ?>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators<?=$pkey?>" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators<?=$pkey?>" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        <? } ?>
                    </div>
                </div>

                <div class="persent">
                    <div class="persent-100">
                        <div class="product-title" onclick="window.location.href = '<?= \yii\helpers\Url::to(['/product/view', 'id' => $product->id]) ?>'"><?= $product->title ?></div>
                    </div>
                    <div class="persent-50">
                        <div class="product-action btn btn-success">Купить&nbsp;
<!--                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" width="20px" height="20px" x="0px" y="0px" viewBox="0 0 19.25 19.25" style="enable-background:new 0 0 19.25 19.25;" xml:space="preserve">-->
<!--                                <g>-->
<!--                                    <g id="Layer_1_107_">-->
<!--                                        <g>-->
<!--                                            <path style="fill:#fff;" d="M19.006,2.97c-0.191-0.219-0.466-0.345-0.756-0.345H4.431L4.236,1.461     C4.156,0.979,3.739,0.625,3.25,0.625H1c-0.553,0-1,0.447-1,1s0.447,1,1,1h1.403l1.86,11.164c0.008,0.045,0.031,0.082,0.045,0.124     c0.016,0.053,0.029,0.103,0.054,0.151c0.032,0.066,0.075,0.122,0.12,0.179c0.031,0.039,0.059,0.078,0.095,0.112     c0.058,0.054,0.125,0.092,0.193,0.13c0.038,0.021,0.071,0.049,0.112,0.065c0.116,0.047,0.238,0.075,0.367,0.075     c0.001,0,11.001,0,11.001,0c0.553,0,1-0.447,1-1s-0.447-1-1-1H6.097l-0.166-1H17.25c0.498,0,0.92-0.366,0.99-0.858l1-7     C19.281,3.479,19.195,3.188,19.006,2.97z M17.097,4.625l-0.285,2H13.25v-2H17.097z M12.25,4.625v2h-3v-2H12.25z M12.25,7.625v2     h-3v-2H12.25z M8.25,4.625v2h-3c-0.053,0-0.101,0.015-0.148,0.03l-0.338-2.03H8.25z M5.264,7.625H8.25v2H5.597L5.264,7.625z      M13.25,9.625v-2h3.418l-0.285,2H13.25z"/>-->
<!--                                            <circle style="fill:#fff;" cx="6.75" cy="17.125" r="1.5"/>-->
<!--                                            <circle style="fill:#fff;" cx="15.75" cy="17.125" r="1.5"/>-->
<!--                                        </g>-->
<!--                                    </g>-->
<!--                                </g>-->
<!--                            </svg>-->
                        </div>
                    </div>
                    <div class="persent-50">
                        <div class="product-price"><?= $product->priceValue ?></div>
                    </div>
                </div>
            </li>
            <?php

            $JS = "$('#carouselExampleIndicators".$pkey."').carousel('pause');";
            $this->registerJs($JS, $this::POS_LOAD);
            ?>
        <?php } ?>
    <?php } ?>

        </ul>

        <?= LinkPager::widget([
            'pagination' => $products->pagination,
        ]); ?>
    </div>
<?php Pjax::end(); ?>
