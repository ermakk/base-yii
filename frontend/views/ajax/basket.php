<?php
/** @var yii\web\View $this */
/** @var array $arResult */
var_dump($arResult); die;
if(array_key_exists('products', $arResult)){
?>
<table>
    <thead>
        <tr>#</tr>
        <tr>Товар</tr>
        <tr>Количество</tr>
    </thead>
    <tbody>
<?php
    foreach ($arResult['products'] as $key => $product){ /** @var \common\models\Product $product */?>
        <td><?= $key ?></td>
        <td><?= $product->title ?></td>
        <td></td>
    <?php } ?>
    </tbody>
</table>
<?php } else { ?>
    Добавьте товар в корзину
<?php }