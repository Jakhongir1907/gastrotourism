<?php

/* @var $this yii\web\View */

$this->title = __("Tribuna main page");
?>
<div class="Bcontainer all_items media-page">

    <div class="media-tab-nav">
        <a href="<?=\Yii::$app->urlManager->createUrl(['media/photo'])?>"><?=__("Фото-новости")?></a>
        <a href="<?=\Yii::$app->urlManager->createUrl(['media/video'])?>" class="active"><?=__("Видео-новости")?></a>
    </div>

    <?= \yii\widgets\ListView::widget([
        'itemOptions' => [
            'class' => false
        ],
        'itemView' => '_item_media_video',
        'options' => [
            'class' => 'photo-news-items-container list-view'
        ],
        'summary' => false,
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => \kop\y2sp\ScrollPager::className(),
            'container' => '.list-view',
            'triggerOffset' => 5,
            'negativeMargin' => 120
        ],
    ])?>

</div>
