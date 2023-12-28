<?php

/* @var $this yii\web\View */

?>

<?php if ($index == 0): ?>

    <?php $widget->itemOptions['class'] = 'main-card mx-auto row col-12 mb-4'; ?>

    <div class="main-card-img col-12 col-lg-4">
        <img class="img-fluid" src="<?=$model->poster->thumbnails->normal['src']?>" alt="Gastronomic novosti">
    </div>
    <div class="main-card-text col-12 col-lg-8  pl-3 pl-sm-5 pl-md-3 pl-lg-5">
        <div class="card-theme"><h2><?=__("Новости")?></h2></div>
        <div class="card-title"><?=$model->title?></div>
        <div class="card-body">
            <p><?=$model->anons?></p>
        </div>
        <a href="<?=$model->getLink()?>" class="main-card-link"><?=__("Подробнее")?></a>
    </div>

<?php else: ?>

    <?php $widget->itemOptions['class'] = 'col-12 col-md-5 col-lg-4 item'; ?>
    <a href="<?= $model->getLink() ?>" class="card">
        <div class="card-img img-fluid">
            <?=\toriphes\lazyload\LazyLoad::widget(['src' => $model->poster->thumbnails->normal['src']])?>
        </div>
        <div class="card-title"><?= $model->title ?></div>
        <div class="card-btn">
            <div class="view-post"><?=__("Подробнее")?></div>
        </div>
    </a>

<?php endif; ?>