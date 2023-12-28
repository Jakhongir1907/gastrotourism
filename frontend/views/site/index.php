<?php

/* @var $this yii\web\View */

$this->title = __("Main - Gastronomic tourism Association of Uzbekistan");

$this->registerMetaTag(['property' => 'keywords', 'content' => "Uzbek food,Uzbek cuisine,Uzbek culinary,Uzbek gastronomy,Uzbek pilaf,plov,Uzbek national dishes,Uzbek restaurants,Uzbek gastronomy tourism association,Where to eat in Uzbekistan,10 best uzbek restaurants,What to try in Uzbekistan,List of Uzbek national food,Uzbek street food,Uzbek national food"]);

$this->registerMetaTag(['property' => 'description', 'content' => __("Основной целью Ассоциации является продвижение, популяризировать и продвижение гастрономического туризма в Узбекистане. Консолидация физических и юридических лиц в сфере общественного питания и бытовых услуг.")]);

$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'og:url', 'content' => \Yii::$app->urlManager->createAbsoluteUrl(['site/index'])]);
$this->registerMetaTag(['property' => 'og:description', 'content' => __("Основной целью Ассоциации является продвижение, популяризировать и продвижение гастрономического туризма в Узбекистане. Консолидация физических и юридических лиц в сфере общественного питания и бытовых услуг.")]);

$this->registerMetaTag(['property' => 'twitter:domain', 'content' => \Yii::$app->urlManager->createAbsoluteUrl(['site/index'])]);
$this->registerMetaTag(['property' => 'twitter:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'twitter:url', 'content' => \Yii::$app->urlManager->createAbsoluteUrl(['site/index'])]);
$this->registerMetaTag(['property' => 'twitter:description', 'content' => __("Основной целью Ассоциации является продвижение, популяризировать и продвижение гастрономического туризма в Узбекистане. Консолидация физических и юридических лиц в сфере общественного питания и бытовых услуг.")]);

?>

<div class="container">
    <div class="vastok-container">
        <h1><?=__("Почуствуй вкус Востока!")?></h1>
        <div class="row justify-content-between">
            <div class="col-12 col-md-6 slide-col">
                <div id="mySlider" class="">
                    <div class="owl-carousel owl-theme" id="myOwl">

                        <?php foreach($restaurants as $restaurant):?>

                            <div class="item" style="background: url(<?=$restaurant->poster->thumbnails->normal['src']?>) no-repeat center center / cover">
                                <div class="panel">
                                    <div class="p-title">
                                        <h3><?=$restaurant->name?></h3>
                                        <p> </p>
                                    </div>
                                    <div class="p-body">
                                        <?php if(strlen($restaurant->description) > 140): ?>
                                            <?=mb_substr($restaurant->description, 0, 140, "utf-8")."..."?>
                                        <?php else: ?>
                                            <?=$restaurant->description?>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?=$restaurant->getLink()?>"> <?=__("Подробнее")?> </a>
                                </div>
                            </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 slide-col plov">
                <div class="owl-carousel owl-theme slider" id="myOwl2">

                    <?php foreach($foods as $food):?>
                        <div class="panel item">
                            <h3><?=$food->name?></h3>
                            <p><?=mb_substr(strip_tags($food->description), 0, 120, 'utf-8')?></p>
                            <a class="button" href="<?=$food->getLink()?>"><?=__("Подробнее")?></a>
                            <img src="<?=$food->poster->thumbnails->normal['src']?>" class='lazy plov-img' />
                        </div>
                    <?php endforeach; ?>

                </div>

            </div>
        </div>
    </div>

    <?php if ($foodVersus instanceof \common\modules\restaurant\models\FoodVs): ?>

        <div class="vs-container">
            <div class="wrap-vs ">
                <div class="uzbek">
                    <img class="like-img" src="<?=$foodVersus->foodVsFirstFoodFlagFiles[0]->thumbnails->low['src']?>" alt="flag country">
                    <button class="like" data-vs-id="<?=$foodVersus->id?>" data-like="first_likes" style="font-size: 1.5em;"><?=$foodVersus->first_food_name?>
                        <img class="yurak" src="/images/heart (1).png" alt="yuraks">
                        <img class='clicked-like' src="/images/Clickedlike.svg" alt="Clickedlike">
                        <span><?=$foodVersus->first_likes + 1?></span>
                    </button>
                    <img class="salat" src="<?=$foodVersus->foodVsFirstFoodImageFiles[0]->thumbnails->normal['src']?>" alt="uzbek-salat">
                    <div data-toggle="modal" data-target="#modal" style="text-align: center; font-weight: bold; color: #dba965; font-size: 1.5em; margin-top: 1.5em; cursor: pointer;"><?=__("Подробнее")?></div>
                </div>
                <div class="vs">
                    <p>   VS  </p>
                    <img class="vs-img" src="/images/VS.svg" alt="vs">
                </div>
                <div class="france">
                    <img class="like-img" src="<?=$foodVersus->foodVsSecondFoodFlagFiles[0]->thumbnails->low['src']?>" alt="flag france">
                    <button class="like" data-vs-id="<?=$foodVersus->id?>" data-like="second_likes" style="font-size: 1.5em;"><?=$foodVersus->second_food_name?>
                        <img class="yurak" src="/images/heart (1).png" alt="yurak">
                        <img class='clicked-like' src="/images/Clickedlike.svg" alt="Clickedlike">
                        <span><?=$foodVersus->second_likes + 1?></span>
                    </button>
                    <img  class="salat" src="<?=$foodVersus->foodVsSecondFoodImageFiles[0]->thumbnails->normal['src']?>" alt="france-salat">
                    <div data-toggle="modal" data-target="#modal" style="text-align: center; font-weight: bold; color: #dba965; font-size: 1.5em; margin-top: 1.5em; cursor: pointer;"><?=__("Подробнее")?></div>
                </div>
            </div>

            <div class="modal fade border-0" id="modal" tabindex="-1" >
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="vs-modal__title" style="font-family: CeraPro;font-size: 36px;font-weight: bold;line-height: 1.36;color: #302f2e;"> <?=$foodVersus->title?> </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="width: 50px;">
                                <span aria-hidden="true"><img src='/images/close.svg'></span>
                            </button>
                        </div>
                        <div class="modal-body bg-light">
                            <div class="vs-modal__content" style="font-family: CaviarDreams;font-size: 18px;font-weight: bold;line-height: 1.91;color: #302f2e;"><?=$foodVersus->first_food_description?></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    <?php endif; ?>
</div>

<div class="forma-container">
    <div class="div" id="form-cont">
        <?php $form = \yii\bootstrap\ActiveForm::begin([
            'options' => [
                'class' => 'forma'
            ]
        ]); ?>
            <?=$form->field($contact, 'name')->textInput(['placeholder' => __('Фамилия Имя Отчество')])->label(false)?>
            <?=$form->field($contact, 'subject')->textInput(['placeholder' => __('Страна')])->label(false)?>
            <?=$form->field($contact, 'phone')->textInput(['placeholder' => __('Телефон номер')])->label(false)?>
        <?php \yii\bootstrap\ActiveForm::end()?>
    </div>
    <div class="forma-panel">
        <h3><?=__("Ассоциация гастрономического туризма Узбекистана")?></h3>
        <p><?=__("Мы хотим чтобы туристы наслаждались вкусной едой и качественном сервисом!")?></p>
        <button class="form-submit"><?=__("Отправить заявку")?></button>
    </div>
    <div class="meva-cheva img-fluid">
        <?=\toriphes\lazyload\LazyLoad::widget(['src' => "/images/fruits.png"])?>
    </div>
</div>

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
        <div class="pred-sled">
            <button class="prev"> <img src="/images/arrow left.svg" alt="left"> </button>
            <button class="next"> <img src="/images/arrow right.svg" alt="right"> </button>
        </div>
    </div>
</div>


<div class="festival-container">
    <h1><?=__("Ближающий Фестивали")?></h1>
    <div class="festival">
        <div class="slider owl-carousel owl-theme " id='festival'>
            <?php foreach($festivals as $festival): ?>
            <div class="item">
                <div class="img-left">
                    <?=\toriphes\lazyload\LazyLoad::widget(['src' => $festival->poster->thumbnails->normal['src']])?>
                </div>
                <div class="festival-panel">
                    <h3> <?=$festival->title?> </h3>
                    <button> <?=__("Читать подробнее")?> </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="img-right">
            <?=\toriphes\lazyload\LazyLoad::widget(['src' => "/images/shar.png"])?>
        </div>
    </div>
</div>

<div class="container">
    <div class="statistika-container">
        <div class="statistika row">
            <h1 class="col-12"> <?=__("Статистика")?> </h1>
            <div class="restoran col-6">
                <p><?=__("Рестораны")?></p>
                <span><?=$restaurantsCount?></span>
            </div>
            <div class="members col-6">
                <p><?=__("Члены")?></p>
                <span><?=$membersCount?></span>
            </div>
            <div class="festi col-6">
                <p><?=__("Фестивали")?></p>
                <span><?=$festivalsCount?></span>
            </div>
            <div class="partnyor col-6">
                <p><?=__("Патрнеры")?></p>
                <span><?=$partnersCount?></span>
            </div>
        </div>
        <div class="statistika-panel-fon">
            <div class="statistika-panel">
                <div class="panel-title">
                    <?=__("Преимущества работы с нами")?>
                </div>
                <div class="panel-body">
                    <?=__("Become one of the most visited restaurants in Uzbekistan")?>
                </div>
                <div class="panel-button">
                    <a class="button" href="/menu/features"> <?=__("Подробнее")?> </a>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="galereya-container">
    <h1><?=__("Фото галерея")?></h1>
    <div class="galereya">
        <div class="galereya-panel">
            <div class="panel-title">
                <?=__("Следите за нами в социальных сетях тоже!")?>
            </div>
            <div class="panel-body">
                <?=__("Подпишитесь на наши новости Узнавайте первыми!")?>
            </div>
            <div class="panel-form">
                <input type="text" placeholder="<?=__("Введите адрес электронной почты")?>">
                <button> <img src="/images/send.png" alt="send"> </button>
            </div>
        </div>
    </div>
    <div class="galereya-img">
        <div class="img-1">
            <?=\toriphes\lazyload\LazyLoad::widget(['src' => "/images/galereya-1.png"])?>
            <?=\toriphes\lazyload\LazyLoad::widget(['src' => "/images/galereya-3.png"])?>
        </div>
        <div class="img-2">
            <?=\toriphes\lazyload\LazyLoad::widget(['src' => "/images/galereya-2.png"])?>
            <?=\toriphes\lazyload\LazyLoad::widget(['src' => "/images/galereya-4.png"])?>
        </div>
    </div>
    <div class="social">
        <a href="#"><img src="/images/facebook (2).png" alt="facebook"></a>
        <a href="#"><img src="/images/instagram (2).png" alt="instagram"></a>
        <a href="#"><img src="/images/twitter.png" alt="twitter"></a>
    </div>
</div>

<div class="container">
    <div class="contact-container row justify-content-around">
        <a href="https://t.me/gastrotourism_uz" class="telegram col-md-6 col-sm-12">
            <div class="tg-link"><img src="/images/telegram (2).png" alt="telegram" />Telegram</div>
            <p>t.me@gastrotourism_uz</p>
        </a>
        <div class="tel col-md-6 col-sm-12 ">
            <div class="tel-text row">
                <div class="col-10 m-0 p-0"><?=__("Спешите, позвоните нам и откройте двери возможностей!")?></div>
                <div class="col-2 p-0"><img class="img-fluid" src="/images/call.svg" alt="call"></div>
            </div>
            <div class="tel-number">
                <a href="tel:<?=\common\modules\settings\models\Settings::value(['organization-phone'])?>"><?=\common\modules\settings\models\Settings::value(['organization-phone'])?></a>
            </div>
        </div>
    </div>
</div>