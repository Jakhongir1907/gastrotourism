<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = __("About - Gastronomic tourism Association of Uzbekistan");
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/assets/bbd5f3aa/css/Onas.css');
?>
<div class="container Onas-container">
    <h3><?=__("Добро пожаловать в Узбекистан!")?></h3>
    <div class="Onas-img">
        <img src="<?=\common\modules\settings\models\Settings::value(['about-poster'])[0]->src?>" alt="">
    </div>
    <div class="mi">
        <h2><?=__("Мы")?></h2>
        <p><?=__("Ассоциация гастрономического туризма Узбекистана")?></p>
        <div><a href="#scroll"><img class="bottom-chevron" src="/images/bottom-chevron.svg" alt="to bottom"></a></div>
    </div>
</div>
<div class="Onas-text-container row" id="scroll">
    <div class="Onas-text col-10 col-sm-8">
        <?=__("reg_date")?>
    </div>
</div>
<div class="osnova-container ">
    <div class="osnova-title row justify-content-center">
        <h3 class="col-12 col-sm-8"><?=__("Основными задачами Ассоциации являются:")?></h3>
    </div>
    <div class="row col-12 col-md-8 justify-content-center mx-auto osnova-bg ">
        <div class=" row col-11">
            <div class="col-4 p-0 d-flex">
                <div class="osnova-panel p1">
                    <div class="osnova-panel-text">
                        <?=__("Содействие ускоренному развитию, популяризации и активному продвижению гастрономического туризма в Узбекистане;")?>
                    </div>

                </div>
            </div>
            <div class="col-4 d-flex p-0">
                <div class="osnova-panel p2">
                    <div class="osnova-panel-text">
                        <?=__("Содействие созданию современной, передовой и конкурентоспособной индустрии гастрономического туризма в Узбекистане;")?>
                    </div>
                </div>
            </div>
            <div class="col-4 d-flex p-0">
                <div class="osnova-panel p3">
                    <div class="osnova-panel-text">
                        <?=__("Консолидация частных лиц в сфере общественного питания и общественных услуг,  повышение эффективности и престижа своей деятельности, подготовка специалистов международной гастрономической службы.")?>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
<div class="dlya-partnyor-container" >
    <div class="dlya-partnyor-title row justify-content-center py-2 py-md-4 py-lg-5"><h3 class="col-12 col-sm-8"><?=__("Для партнеров:")?></h3></div>
    <div class="row col-12 justify-content-center">
        <div class="col-12 col-sm-8 justify-content-space-around row">
            <div class="col-4 p-1 p-md-3 p1 dlya-partnyor-panel"><?=__("У вас есть ресторан, курорт, сад, гостевой дом и туристическая недвижимость?")?></div>
            <div class="col-4 p-1 p-md-3 p2 dlya-partnyor-panel"><?=__("Хотите сделать вашу недвижимость предназначением для туристов?")?></div>
            <div class="col-4 p-1 p-md-3 p3 dlya-partnyor-panel"><?=__("Станьте самым популярным местом на гастрономическом маршруте Узбекистана!")?></div>
        </div>
    </div>

</div>