<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\FoodVs */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Food Vs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="food-vs-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'first_food_name',
            'second_food_name',
            'first_food_description:ntext',
            'second_food_description:ntext',
            'first_food_picture',
            'second_food_picture',
            'first_food_flag',
            'second_food_flag',
            'first_likes',
            'second_likes',
            'lang',
            'lang_hash',
        ],
    ]) ?>

</div>
