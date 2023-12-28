<?php

/* @var $this yii\web\View */

$this->title = __("Tribuna main page");
?>
<style>
    .list-view {
        width: 100%;
    }
</style>
<div class="Bcontainer all_items media-page">

    <div class="media-tab-nav">
        <a href="<?=\Yii::$app->urlManager->createUrl(['media/photo'])?>" class="active"><?=__("Фото-новости")?></a>
        <a href="<?=\Yii::$app->urlManager->createUrl(['media/video'])?>"><?=__("Видео-новости")?></a>
    </div>

    <?= \yii\widgets\ListView::widget([
        'itemOptions' => [
            'tag' => false
        ],
        'itemView' => '_item_media_photo',
        'options' => [
            'class' => 'photo-news-items-container list-view'
        ],
        'summary' => false,
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => \kop\y2sp\ScrollPager::className(),
            'container' => '.list-view',
            'triggerOffset' => 5,
            'negativeMargin' => 150,
            'triggerTemplate' => '<div class="ias-trigger" style="text-align: center; cursor: pointer; width: 100%;"><a>{text}</a></div>'
        ],
    ])?>

</div>