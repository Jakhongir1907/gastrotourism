<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel common\modules\restaurant\models\search\RestaurantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = __('Top 10 fruits - Gastronomic tourism Association of Uzbekistan');
$this->registerCssFile('/assets/bbd5f3aa/css/novosti.css');
$this->registerCssFile('/assets/bbd5f3aa/css/top10.css');

$this->registerMetaTag(['property' => 'keywords', 'content' => "Uzbek food,Uzbek cuisine,Uzbek culinary,Uzbek pilaf,plov,Uzbek national dishes,What to try in Uzbekistan,List of Uzbek national food,Uzbek street food,Uzbek national food"]);

$this->registerMetaTag(['property' => 'description', 'content' => __("Top 10 taste dishes of Uzbekistan, Visit and try taste foods of Uzbek culinary")]);

$this->registerMetaTag(['property' => 'og:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'og:url', 'content' => \Yii::$app->urlManager->createAbsoluteUrl(['site/index'])]);
$this->registerMetaTag(['property' => 'og:description', 'content' => __("Top 10 taste dishes of Uzbekistan, Visit and try taste foods of Uzbek culinary")]);

$this->registerMetaTag(['property' => 'twitter:domain', 'content' => \Yii::$app->urlManager->createAbsoluteUrl(['site/index'])]);
$this->registerMetaTag(['property' => 'twitter:title', 'content' => $this->title]);
$this->registerMetaTag(['property' => 'twitter:url', 'content' => \Yii::$app->urlManager->createAbsoluteUrl(['site/index'])]);
$this->registerMetaTag(['property' => 'twitter:description', 'content' => __("Top 10 taste dishes of Uzbekistan, Visit and try taste foods of Uzbek culinary")]);

?>

<div class="container">
    <div class="row justify-content-center">

        <div class="restoran col-12  row mt-5 ">
            <?= \yii\widgets\ListView::widget([
                'options' => ['class' => 'other col-12 col-md-11 row mt-5 justify-content-start pl-2 pl-md-0 m-0'],
                'itemOptions' => ['class' => 'col-12 col-md-5  mb-5'],
                'itemView' => '_fruit-item',
                'summary' => false,
                'dataProvider' => $dataProvider,
                    'pager' => [
                        'class' => \kop\y2sp\ScrollPager::className(),
                        'container' => '.list-view',
                        'triggerOffset' => 5,
                        'negativeMargin' => 150,
                        'triggerTemplate' => '<div class="pokazat col-12 d-flex justify-content-center"><a href="#" class="mx-auto ">' . __("Показать еще") . '</a></div>'
                    ],
            ])?>
        </div>
    </div>

</div>