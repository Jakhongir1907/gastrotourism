<?php

/* @var $this yii\web\View */

$category = (sizeof($model->categories) > 0) ? $model->categories[0] : new \common\modules\categories\models\Categories();

?>

<div class="item photo-news-item first-item new-layout">
    <div class="relative">
        <a href="<?= $model->getLink() ?>" class="video_play_button"></a>
        <img src="<?= $model->poster->thumbnails->normal['src'] ?>" alt="">
        <div class="top_wrapper">
            <div class="space-between">
            </div>
            <div class="space-between">
            </div>
        </div>
    </div>
    <a href="<?= $model->getLink() ?>" class="news-title"><?= $model->title ?></a>

</div>
