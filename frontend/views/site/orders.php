<?php
/** @var yii\web\View $this */
/** @var array $arResult */

$JS = "
    $( document ).ready(function() {
        $.ajax({
            method: 'post',
           dataType: 'json',
            data: localStorage.getItem('product'),
            url: '".\yii\helpers\Url::to(['/ajax/get-product'])."',
            success: function(data){
                $('#basket-orders-block').html(data);
            }
        })
    });
";

$this->registerJs($JS, $this::POS_READY);

?>
<div id="basket-orders-block">

</div>