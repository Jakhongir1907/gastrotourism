<?php

/* @var $this yii\web\View */

?>

<?php if ($index == 0): ?>

    <?php $widget->itemOptions['class'] = 'main-card  mx-auto row col-12'; ?>

    <div class="main-card-img col-12 col-lg-5 lola">
        <img class="img-fluid" style="width: 100%;" src="<?=$model->poster->thumbnails->normal['src']?>" alt="Gastronomic novosti">
    </div>
    <div class="main-card-text lola-text col-12 col-lg-7">
        <div class="card-theme"><h2><?=__("Блог")?></h2></div>
        <div class="card-title"><?=$model->title?></div>
        <div class="card-data row">
            <div class="time col-6"><?=$model->getPrettyDate()?></div>
            <div class="count col-4"><img src="/images/eye.svg" alt="eye" width="25"> <span><?=$model->viewed?></span></div>
        </div>
        <div class="card-body">
            <p><?=$model->anons?></p>
        </div>
        <a href="<?=$model->getLink()?>" class="mt-3"><?=__("Подробнее")?></a>
    </div>

<?php else: ?>

    <?php $widget->itemOptions['class'] = 'main-card row justify-content-between item'; ?>

    <div class="col-12 col-md-2">
        <div class="card-data row justify-content-between">
            <div class="time col-7 col-md-12"><?=$model->getPrettyDate()?></div>
            <div class="count d-flex col-5 col-md-12 "><img src="/images/eye.svg" alt="eye" width="25"> <span><?=$model->viewed?></span></div>
        </div>
    </div>
    <div class="main-card-img col-12 col-md-3">
        <?=\toriphes\lazyload\LazyLoad::widget(['src' => $model->poster->thumbnails->normal['src'], 'cssClass' => 'img-fluid'])?>
    </div>
    <div class="main-card-text col-12 col-md-7">
        <div class="card-title"><?= $model->title ?></div>
        <div class="card-body"><?= $model->anons ?></div>
        <a href="<?= $model->getLink() ?>" class="mt-3"><?=__("Читать подробнее")?></a>
    </div>

<?php endif; ?>