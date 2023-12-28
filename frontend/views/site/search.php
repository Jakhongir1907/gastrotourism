<?php

/* @var $this yii\web\View */

$this->title = __("Search - Gastronomic tourism Association of Uzbekistan");
$this->registerCssFile('/assets/bbd5f3aa/css/topRest.css');

?>

<?php if (sizeof($posts) > 0): ?>

<div class="container news">
    <div class="novosti-container">
        <h3><?=__("Новости")?></h3>
        <div class="row justify-start">

            <?php foreach($posts as $post): ?>
                <div class="col-sm-12 col-md-6 col-lg-4 p-2">
                    <a href="<?=$post->getLink()?>" class="card">
                        <div class="card-img">
                            <?=\toriphes\lazyload\LazyLoad::widget(['src' => $post->files[0]->thumbnails->normal['src']])?>
                        </div>
                        <div class="card-title">
                            <?=$post->title?>
                        </div>
                        <div class="card-btn">
                            <div class="button"><?=__("Подробнее")?></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="pokazat row col-12 justify-content-center">
            <a href="<?=\Yii::$app->urlManager->createUrl(['post/index'])?>"><?=__("Показать еще")?></a>
        </div>
    </div>
</div>

<?php endif; ?>

<?php if (sizeof($festivals) > 0): ?>

    <div class="container news mt-5">
    <div class="novosti-container">
        <h3><?=__("Фестивали")?></h3>
        <div class="row justify-start">

            <?php foreach($festivals as $post): ?>
                <div class="col-sm-12 col-md-6 col-lg-4 p-2">
                    <a href="<?=$post->getLink()?>" class="card">
                        <div class="card-img">
                            <?=\toriphes\lazyload\LazyLoad::widget(['src' => $post->files[0]->thumbnails->normal['src']])?>
                        </div>
                        <div class="card-title">
                            <?=$post->title?>
                        </div>
                        <div class="card-btn">
                            <div class="button"><?=__("Подробнее")?></div>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
        <div class="pokazat row col-12 justify-content-center">
            <a href="<?=\Yii::$app->urlManager->createUrl(['festival/index'])?>"><?=__("Показать еще")?></a>
        </div>
    </div>
</div>

<?php endif; ?>

<?php if (sizeof($restaurants) > 0): ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <h1 class="col-12 rest-title"><?=__("Рестораны")?></h1>
        <div class="row mt-5 ">
            <?php foreach ($restaurants as $restaurant): ?>
                <div class="col-md-4">
                    <div class="img-wrap">
                        <?=\toriphes\lazyload\LazyLoad::widget(['src' => $restaurant->poster->thumbnails->normal['src']])?>
                        <a href='<?=$restaurant->getLink()?>' class="img-title">
                            <p class="name"><?= $restaurant->name ?></p>
                            <p class="adres"><?= $restaurant->address ?></p>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>

<?php endif; ?>