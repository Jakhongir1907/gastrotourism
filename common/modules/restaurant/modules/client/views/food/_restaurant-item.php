<?php

/* @var $this yii\web\View */

?>

<div class="img-wrap">
    <?=\toriphes\lazyload\LazyLoad::widget(['src' => $model->poster->thumbnails->normal['src']])?>
    <a href='<?=$model->getLink()?>' class="img-title">
        <p class="name"><?= $model->name ?></p>
        <p class="adres"><?= $model->address ?></p>
    </a>
</div>