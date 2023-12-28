<?php

use common\modules\langs\widgets\LangsWidgets;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\gallery\models\Gallery */

$this->title = 'Gallery: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            <?php echo LangsWidgets::widget([
                'model_db' => $model,
                'create_url' => '/gallery/gallery/create/',
                'dont_show' => ['oz']
            ]); ?>
        </div>
        <div class="card-body">
            <h1><?= \yii\helpers\Html::encode($this->title) ?></h1>
        </div>
    </div>
</div>

<div class="gallery-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
