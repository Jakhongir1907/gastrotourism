<?php

use common\modules\langs\widgets\LangsWidgets;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\Restaurant */

$this->title = 'Create Restaurant';
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <?php echo LangsWidgets::widget(); ?>

</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
