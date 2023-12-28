<?php

use common\modules\langs\widgets\LangsWidgets;
use yii\helpers\Html;

$this->title = Yii::t('main', 'Create Post');
$this->params['breadcrumbs'][] = ['label' => Yii::t('main', 'Posts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <?php echo LangsWidgets::widget(); ?>

</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
