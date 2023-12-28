<?php

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/assets/bbd5f3aa/css/rest1.css');
$this->registerCssFile('/assets/bbd5f3aa/css/salat.css');

?>

<div class="container">
    <div class="row justify-content-center m-0">
        <div class="col-12 row rest-header" <?= sizeof($model->files) > 1 ? "style='background: url({$model->files[1]->thumbnails->normal['src']})  no-repeat center center / cover'" : '' ?> >
            <div class="col-12 col-md-7 row about-rest">
                <h2 class="col-12 rest-name p-0"><?=$model->name?></h2>
                <div class="col-12 col-md-6 p-0 row">
                    <div class="col-12 p-0">
                        <p class="title"><?=__("Адрес:")?></p>
                        <p class="main"><?=$model->address?></p>
                    </div>
                    <div class="col-12 p-0">
                        <p class="title"><?=__("ВРЕМЯ РАБОТЫ:")?></p>
                        <p class="main"><?=$model->work_time_start?> - <?=$model->work_time_end?></p>
                    </div>
                </div>
                <div class="col-12 col-md-6 row pl-0 pl-md-3">
                    <div class="col-12 pad-0">
                        <p class="title"><?=__("ТЕЛЕФОННЫЕ НОМЕРА:")?></p>
                        <p class="main"><?=$model->phone?></p>
                    </div>
                    <div class="col-12 pad-0">
                        <p class="title"><?=__("ДОСТАВКА ЕСТЬ/ НЕТ:")?></p>
                        <p class="main"><?=$model->delivery ? __("Есть") : __("Нет")?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab col-12 p-0 mt-3 mt-md-5">
            <div class="rest-grid">
                <a href="<?=\Yii::$app->urlManager->createUrl(['restaurant/show', 'slug' => $model->slug])?>"><?=__("О Рестране")?></a>
                <a
                    <?=\Yii::$app->request->absoluteUrl == \Yii::$app->urlManager->createAbsoluteUrl([
                        'restaurant/show',
                        'slug' => $model->slug,
                    ]) . "/foods" ? "class='active'" : ''?>
                    href="<?=\Yii::$app->urlManager->createUrl(['restaurant/show', 'slug' => $model->slug]) . "/foods"?>">
                        <?=__("Блюда")?>
                </a>
                <a
                    <?=\Yii::$app->request->absoluteUrl == \Yii::$app->urlManager->createAbsoluteUrl([
                        'restaurant/show',
                        'slug' => $model->slug,
                    ]) . "/salats" ? "class='active'" : ''?>
                    href="<?=\Yii::$app->urlManager->createUrl(['restaurant/show', 'slug' => $model->slug]) . "/salats"?>">
                        <?=__("Салаты")?>
                </a>
                <a <?=\Yii::$app->request->absoluteUrl == \Yii::$app->urlManager->createAbsoluteUrl([
                        'restaurant/show',
                        'slug' => $model->slug,
                    ]) . "/deserts" ? "class='active'" : ''?>
                    href="<?=\Yii::$app->urlManager->createUrl(['restaurant/show', 'slug' => $model->slug]) . "/deserts"?>">
                        <?=__("Десерт")?>
                </a>
                <a <?=\Yii::$app->request->absoluteUrl == \Yii::$app->urlManager->createAbsoluteUrl([
                        'restaurant/show',
                        'slug' => $model->slug,
                    ]) . "/drinks" ? "class='active'" : ''?>
                    href="<?=\Yii::$app->urlManager->createUrl(['restaurant/show', 'slug' => $model->slug]) . "/drinks"?>">
                        <?=__("Напитки")?>
                </a>
                <a <?=\Yii::$app->request->absoluteUrl == \Yii::$app->urlManager->createAbsoluteUrl([
                        'restaurant/show',
                        'slug' => $model->slug,
                    ]) . "/alcohols" ? "class='active'" : ''?>
                    href="<?=\Yii::$app->urlManager->createUrl(['restaurant/show', 'slug' => $model->slug]) . "/alcohols"?>"><?=__("Алкогольные напитки")?></a>
            </div>
        </div>

        <div class="salat row col-12">
            <?php foreach($foods as $index => $food): ?>
            <div class="salat-item col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="salat-img" style="padding: 1em" data-toggle="modal" data-target="#modal<?=$index?>">
                    <?=\toriphes\lazyload\LazyLoad::widget(['src' => $food->poster->thumbnails->low['src']])?>
                </div>
                <div class="salat-name"><?=$food->name?></div>
                <div class="salat-price"><?=$food->price?></div>

                <div class="modal fade border-0" id="modal<?=$index?>" tabindex="-1" >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: 50px;">
                                    <span aria-hidden="true"><img src='/images/close.svg'></span>
                                </button>
                            </div>
                            <div class="modal-body bg-light">
                                <div class="salat-title"> <?=__("Ингредиенты")?> </div>
                                <div class="about-salat"><?=$food->ingredients?></div>
                                <div class="salat-title"><?=__("Этапы приготовления")?></div>
                                <div class="about-salat"><?=$food->cook_steps?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
