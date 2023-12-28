<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\FoodVs */

$this->title = 'Update Food Vs: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Food Vs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            <?=\common\modules\langs\widgets\LangsWidgets::widget([
                'model_db' => $model,
                'create_url' => '/restaurant/food-vs/create/',
                'dont_show' => ['oz']
            ]); ?>
        </div>
        <div class="card-body">
            <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>
        </div>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
