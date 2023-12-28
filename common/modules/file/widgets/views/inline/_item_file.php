<?php

use yii\helpers\Html;
use yii\helpers\Url;

?>
<a href="<?= Url::to(['/files/update', 'id' => $model->id]) ?>" data-pjax="0" class="filemanager-item <?= $model->isImage ? 'filemanager-item-image' : '' ?>" data-id="<?= $model->id ?>" data-image="<?= $model->getSrc('small') ?>" data-isImage="<?= $model->getIsImage() ?>" data-title="<?= Html::encode(strip_tags($model->title)) ?>">

	<?php if($model->isImage): ?>

		<img src="<?= $model->getSrc('small') ?>" alt="<?= $model->title ?>" title="<?= $model->title ?>">

	<?php endif; ?>

	<i class="filemanager-item-icon glyphicon glyphicon-file"></i>
	<input name="FileTitle[<?=$model->file_id?>]" class="filemanager-item-name" />

	<button type="button" class="filemanager-item-check">
		<i class="glyphicon glyphicon-ok"></i>
	</button>

</a>