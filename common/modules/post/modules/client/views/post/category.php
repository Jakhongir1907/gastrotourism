<?php

/* @var $this yii\web\View */

$this->title = __("Tribuna main page");
?>
<div class="Bcontainer all_items">

    <div class="page_title">
        <span><?=__("Категория")?></span>
        <h3><?=$category->name?></h3>
    </div>

    <?= \yii\widgets\ListView::widget([
        'itemOptions' => ['class' => 'item'],
        'itemView' => '@frontend/views/site/_item_with_big_img_title',
        'summary' => false,
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => \kop\y2sp\ScrollPager::className(),
            'container' => '.list-view',
            'triggerOffset' => 5,
            'negativeMargin' => 150
        ],
    ])?>
</div>