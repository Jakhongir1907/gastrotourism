<?php

use common\modules\langs\widgets\LangsWidgets;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\partner\models\Partner */

$this->title = 'Create Partner';
$this->params['breadcrumbs'][] = ['label' => 'Partners', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <?php echo LangsWidgets::widget(); ?>

</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
