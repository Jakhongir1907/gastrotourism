<?php

/* @var $this \yii\web\View */
/* @var $content string */

use common\modules\menu\components\FrontendMenu;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>


<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="http://gastrotourism.uz/images/Group%20173.png">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="wrapp"></div>
<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand " href="/">  <img class="img-fluid" src="/images/Group 173.png" alt="Gastronomic" id='MainLogo'>
    </a>
    <button class="navbar-toggler" data-toggle="collapse" data-target='#navbar'>
        <span class="navbar-toggler-icon text-dark"></span>
    </button>

    <?php new FrontendMenu(['alias' => 'front', 'without_cache' => true]); ?>

</nav>

<div class="container-fluid">
    <?= Alert::widget() ?>
    <?= $content ?>



    <div class="container mt-5">
        <div class="partnyor-container">
            <h1><?=__("Наше любимие партнеры")?></h1>
            <div class="naw-partnyor">
                <div class="logos owl-carousel owl-theme" id="logos">
                    <div class="item">
                        <img src="/images/logo-oshpazlar-uyushmasi.png" class='oshpazlar-uyushmasi' style="width: 90px !important;" />
                    </div>
                    <div class="item">
                        <img src="/images/logo-tashkent.png" class='logo-tashkent' />
                    </div>
                    <div class="item">
                        <img src="/images/uzbekistan (2).png" class='uzb' />
                    </div>
                    <div class="item">
                        <img src="/images/english.png" class='english' />
                    </div>
                    <div class="item">
                        <img src="/images/tashkent.png" class='tashkent' />
                    </div>
                    <div class="item">
                        <img src="/images/sbc.png" class='sbc' />
                    </div>
                    <div class="item">
                        <img src="/images/gtd.png" class='gtd' />
                    </div>
                    <div class="item">
                        <img src="/images/guides3x.png" class='guide' />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-container">
        <div class="row">
            <div class="row col-12 col-md-8">
                <div class="col-3 col-md-2 navbar-brand">
                    <img class="img-fluid" src="/images/Group 173.png" alt="">
                </div>


                <div class="col-12 col-sm-9 row justify-content-around " >
                    <div class="col-4 col-sm-3 col-md-2 ">
                        <ul>
                            <li><a href="#">Новости</a></li>
                            <li><a href="#">Фестивали</a></li>
                            <li><a href="#">Топ 10</a></li>
                            <li><a href="#">Контакт</a></li>
                        </ul>
                    </div>
                    <div class=" col-4 col-sm-3 col-md-2">
                        <ul>
                            <li><a href="#">Фестивали</a></li>
                            <li><a href="#">Контакты</a></li>
                            <li><a href="#">10 блюд которых ты должен попробовать в Узбекистане</a></li>
                        </ul>
                    </div>
                    <div class="col-4 col-sm-3 col-md-2">
                        <ul>
                            <li><a href="#">Главная</a></li>
                            <li><a href="#">О нас</a></li>
                            <li><a href="#">Топ 10</a></li>
                            <li><a href="#">Новости</a></li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="col-sm-12 col-md-4 ">
                <h3><?=__("Наше контакты")?></h3>
                <div class="panel-bg">
                    <div class="panel">
                        <div class="panel-title"><?=__("Приходите в Гости!")?></div>
                        <div class="panel-body">
                            <span> <h4><?=__("Наш адрес:")?></h4>   12/1, улица Лабзака, Ташкент, Узбекистан.</span>
                            <a href="#"> <img src="/images/gps.png" alt="gps"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chasi-raboti  col-sm-12 col-md-8">
                <h3><?=__("Часы работы")?></h3>
                <div class="row">
                    <div class="work-table row col-12 col-md-7">
                        <div class="col-6">
                            <p> Пнд - Втр : <span>9.00 - 18.00</span> </p>
                            <p>Срд - Чтв : <span>9.00 - 18.00</span></p>
                        </div>
                        <div class="col-6">
                            <p>Птн -Сбт : <span>9.00 - 18.00</span></p>
                            <p>Воскресенье <span id='otdux'>Выходной</span></p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3" id="svyaz">
                        <p><?=__("Номера для связи:")?></p>
                        <span><?=\common\modules\settings\models\Settings::value(['organization-phone'])?></span>
                        <p><?=__("Наше электронная почта:")?></p>
                        <a href="#"><span><?=\common\modules\settings\models\Settings::value(['organization-email'])?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer class="row">
    <div class="turizm col-9"> <?=\common\modules\settings\models\Settings::value(['copyright'])?></div>
    <a href="https://rteco.uz" class="rteco col-3 d-flex"><img class="img-fluid d-flex" src="/images/logoRTECO.svg" alt="Разработано в RTECO"></a>
</footer>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
