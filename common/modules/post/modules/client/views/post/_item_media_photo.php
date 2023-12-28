<?php

/* @var $this yii\web\View */

$category = (sizeof($model->categories) > 0) ? $model->categories[0] : new \common\modules\categories\models\Categories();

?>

<div class="item photo-news-item <?= $index == 0 ? 'first-item' : ($index == 1 ? 'half-itema firsta' : ($index == 2 ? 'half-itema' : '')) ?> new-layout">

    <div class="relative">
        <a href="<?= $model->getLink() ?>" class="news-title">
            <img src="<?= $model->poster->thumbnails->normal['src'] ?>" alt="">
        </a>
        <div class="top_wrapper">
<!--            <div class="space-between">
                <div class="media_icon"></div>
                <a href="<?= $category->getLink() ?>" class="news-category"><?= $category->name ?></a>
            </div> -->
            <div class="space-between">
<!--                <div class="news-views"><?= $model->viewed ?></div>
                <div class="news-data">
                    <?= date('Y-m-d', strtotime($model->published_at)) == date('Y-m-d', time())
                        ? __("Бугун") . ' ' . date('H:i', strtotime($model->published_at))
                        : date('d.m', strtotime($model->published_at)) ?>
                </div> -->
            </div>
        </div>
    </div>
    <a href="<?= $model->getLink() ?>" class="news-title"><?= $model->title ?></a>
</div>
