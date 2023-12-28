<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\Food */

$this->title = 'Update Food: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Foods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            <?=\common\modules\langs\widgets\LangsWidgets::widget([
                'model_db' => $model,
                'create_url' => '/restaurant/food/create/',
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
