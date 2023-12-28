<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 * @package uzbekkonsert
 */

$this->title = __('Медиатека- «Ўзбекконцерт» давлат муассасаси')

?>

<div class="container df pt-30 pb-30">

    <?= \yii\widgets\ListView::widget([
        'options' => ['class' => 'df-content-870'],
        'itemOptions' => ['class' => 'item'],
        'itemView' => '_gallery-item',
        'summary' => false,
        'dataProvider' => $dataProvider,
//        'pager' => [
//            'class' => \kop\y2sp\ScrollPager::className(),
//            'container' => '.list-view',
//            'triggerOffset' => 5,
//            'negativeMargin' => 150
//        ],
    ])?>

    <div class="df-content-270">
        <div class="print-version-button">
            <img src="/img/icons/print-version.svg" />
            <div class="label"><?= __('Версия для печати') ?></div>
        </div>

        <?= \common\modules\post\widgets\PostsWidget::widget(['title' => __('Новости'), 'size' => 4])?>

    </div>

</div>