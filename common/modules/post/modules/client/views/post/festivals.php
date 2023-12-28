<?php

/* @var $this yii\web\View */

$this->title = __("Фестивали");
$this->registerCssFile('/assets/bbd5f3aa/css/novosti.css');
$this->registerCssFile('/assets/bbd5f3aa/css/festival.css');
?>

<div class="container">
    <div class="row justify-content-center">

        <?= \yii\widgets\ListView::widget([
            'options' => ['class' => 'items other col-10 col-md-12 row mt-1 ustify-content-start'],
            'itemOptions' => ['class' => 'col-12 col-md-5 col-lg-4 item'],
            'itemView' => '_festival-item',
            'summary' => false,
            'dataProvider' => $dataProvider,
            'pager' => [
                'class' => \kop\y2sp\ScrollPager::className(),
                'container' => '.list-view',
                'triggerOffset' => 5,
                'negativeMargin' => 150,
                'triggerTemplate' => '<div class="pokazat col-12 d-flex justify-content-center"><a href="#" class="mx-auto ">' . "Показать еще" . '</a></div>'
            ],
        ])?>
    </div>


</div>