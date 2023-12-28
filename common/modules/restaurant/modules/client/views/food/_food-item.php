<?php

/* @var $this yii\web\View */

?>
<?php if ($index > 9) return; ?>
<?php if ($index == 0): ?>

    <?php $widget->itemOptions['class'] = 'main-card col-12 col-md-11 row justify-content-between m-0'; ?>

    <div class="main-card-img col-12 col-md-5  p-md-0">
        <div class="img-wrap">
            <img class="img-fluid" src="<?=$model->poster->thumbnails->normal['src']?>" alt="Gastronomic novosti">
            <span>#<?=($index + 1)?></span>
        </div>
    </div>
    <div class="main-card-text col-12 col-md-6  p-md-0">
        <div class="card-theme">
            <?=__("10 блюд которых ты должен попробовать в Узбекистане")?>
        </div>
        <div class="card-title pl-0">
            <?=$model->name?>
        </div>
        <div class="card-body">
            <?=mb_substr(strip_tags($model->description), 0, 60, "utf-8")?>
        </div>
        <div class="card-button mt-5">
            <a href="<?=$model->getLink()?>"><?=__("Подробнее")?></a>
        </div>
    </div>

<?php else: ?>

    <?php $widget->itemOptions['class'] = 'col-12 col-sm-6 col-lg-4 mt-5 item'; ?>

    <a href="<?=$model->getLink()?>" class="card">
        <div class="card-img">
            <div class="img-wrap">
                <?=\toriphes\lazyload\LazyLoad::widget(['src' => $model->poster->thumbnails->normal['src']])?>
                <span>#<?=($index + 1)?></span>
            </div>
        </div>
        <div class="card-title">
            <?=$model->name?>
        </div>
    </a>
<?php endif; ?>
