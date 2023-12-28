<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\gallery\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

echo \yii\widgets\ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => 'listItem',
    'layout' => '{items}',
    'viewParams' => ['selected' => $selected],
]);