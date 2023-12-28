<?php

/* @var $this yii\web\View */

use common\modules\filemanager\models\Files;

$restaurantPoster = (($model->poster instanceOf Files) && array_key_exists("src", $model->poster->thumbnails->normal)) ? $model->poster->thumbnails->normal['src'] : '/images/Group 173.png';

?>

<div class="img-wrap">
    <?=\toriphes\lazyload\LazyLoad::widget(['src' => $restaurantPoster])?>
    <a href='<?=$model->getLink()?>' class="img-title">
        <p class="name"><?= $model->name ?></p>
        <p class="adres"><?= $model->address ?></p>
    </a>
</div>