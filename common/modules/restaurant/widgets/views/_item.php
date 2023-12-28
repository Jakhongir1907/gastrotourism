<?php

use yii\helpers\Html;

?>
<div style="position: relative;" class="filemanager-item filemanager-item-image" data-id="<?= $model->id ?>" data-image="<?= $model->poster->thumbnails->small['src'] ?>" data-isImage="true" data-title="<?= Html::encode(strip_tags($model->name)) ?>">

    <img src="<?= $model->poster->thumbnails->small['src'] ?>" alt="<?= $model->name?>" title="<?= $model->name?>">

	<div class="filemanager-item-name" style="position: absolute; background: white; display: block;"><?= Html::encode($model->name) ?></div>

	<button type="button" class="filemanager-item-check">
		<i class="glyphicon glyphicon-ok"></i>
	</button>

</div>