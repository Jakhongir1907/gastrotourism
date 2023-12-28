<?php

use common\modules\langs\widgets\LangsWidgets;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\modules\gallery\models\Gallery */

$this->title = 'Create Gallery';
$this->params['breadcrumbs'][] = ['label' => 'Galleries', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            <?php echo LangsWidgets::widget(); ?>
        </div>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>

