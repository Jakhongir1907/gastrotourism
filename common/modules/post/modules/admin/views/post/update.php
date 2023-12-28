<?php

use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'Update Post: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            <?=\common\modules\langs\widgets\LangsWidgets::widget([
                'model_db' => $model,
                'create_url' => '/post/post/create/',
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
