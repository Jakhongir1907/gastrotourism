<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\modules\fixture\models\Fixture */

$this->title = 'Update Post: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Fixtures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>


<div class="fixture-update">

    <div id="comments-container">
    </div>

</div>
<?=\common\modules\comment\widgets\vima\VimaWidget::widget([
        'commentTagId' => 'comments-container',
        'model' => $model,
        'model_id' => $model->id,
        'saveActionUrl' =>'/post/comment/add-action',
        'saveLikeActionUrl' => '/post/comment/like-action',
        'deleteActionUrl' => '/post/comment/delete-action'
])?>