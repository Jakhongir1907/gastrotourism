<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel common\modules\restaurant\models\search\RestaurantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = __('Restaurants - Gastronomic tourism Association of Uzbekistan');
$this->registerCssFile('/assets/bbd5f3aa/css/topRest.css');

?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12  row">
            <h1 class="col-12 rest-title"><?__("Самые лучшие рестораны в Узбекистане")?></h1>
            <div class="col-12 ">
                <div class="grid">
                    <a class="rest-activ" href="<?=\Yii::$app->urlManager->createUrl(['restaurant/index'])?>"><?=__("Все")?></a>
                    <?php foreach($regions as $region): ?>
                        <a href="<?=\Yii::$app->urlManager->createUrl(['restaurant/region', 'slug' => $region->slug])?>"><?=$region->name?></a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="restoran col-12  row mt-5 ">
                <?= \yii\widgets\ListView::widget([
                    'options' => ['class' => 'col-12 rest-wrap col-sm-11 row justify-content-between'],
                    'itemOptions' => ['class' => 'col-12 col-md-5  mb-5'],
                    'itemView' => '_restaurant-item',
                    'summary' => false,
                    'dataProvider' => $dataProvider,
//                        'pager' => [
//                            'class' => \kop\y2sp\ScrollPager::className(),
//                            'container' => '.list-view',
//                            'triggerOffset' => 5,
//                            'negativeMargin' => 150,
//                            'triggerTemplate' => '<div class="pokazat col-12 d-flex justify-content-center"><a href="#" class="mx-auto ">' . "Показать еще" . '</a></div>'
//                        ],
                ])?>
            </div>
        </div>
    </div>

</div>