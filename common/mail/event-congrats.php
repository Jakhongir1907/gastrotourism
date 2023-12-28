<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $attender \common\modules\event\models\EventAttender */

?>
<div class="">
    <p>Dear <?= Html::encode($attender->name) ?>!</p>
    <p>
        Thank you for interesting in online cooking classes. Pass the link and download the list of ingredients.  Once you prepare everthing needed to cooking, you may join us staying in your kitchen and cook together with our chef.
        We'll send you link of zoom conference!
    </p>
    <p>
        Best,
        Gastronomy Tourism Association of Uzbekistan.
    </p>

    <p>Follow the link below to download ingredients:</p>

    <p><a href="https://cdn.gastrotourism.uz/uploads/<?=$event->id?>.pdf">Download ingredients</a></p>
</div>
