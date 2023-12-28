<?php

use common\modules\user\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
use kartik\sortinput\SortableInput;
use common\modules\file\widgets\FileUpload;

$js = <<<JS
	document.filemanager_{$widget->id}.checkItems();	
JS;

$accept = '';

if($mime_type && in_array($mime_type, $allowed_types)){
	$accept = $mime_type . '/*';
} else {
	$accept = implode('/*,', $allowed_types);
}

?>

<div id="filemanager-<?= $widget->id ?>" class="filemanager-container">

	<button type="button" class="filemanager-insert-media-btn" data-toggle="modal" data-target="#filemanager-modal-<?= $widget->id ?>"><?= __( 'Добавить медиафайл') ?></button>

	<?= SortableInput::widget([
		'name'  => $widget->attribute,
		'value' => $selected,
		'items' => $selected_items_sortable,
		'hideInput' => true,
		'options' => ['class'=>'form-control filemanager-file-input', 'readonly' => true]
	]); ?>

	<div class="filemanager-modal modal" id="filemanager-modal-<?= $widget->id ?>">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" data-dismiss="modal"><span>&times;</span></button>
					<label class="filemanager-upload-btn">
						<span><?= __( 'Добавить новый') ?></span>
						<?= Html::hiddenInput('filemanager-input-' . $widget->id) . Html::fileInput('filemanager-input-' . $widget->id, '', ['multiple' => true, 'accept' => $accept, 'id' => "filemanager-input-{$widget->id}"]); ?>
					</label>
<!--					<button type="button" class="delete-selected-all">--><?//= Yii::t('main', 'Delete Selected') ?><!--</button>-->
					<h1><?= __( 'Библиотека файлов') ?></h1>
				</div>
				<div class="modal-body">
					<div class="modal-files">
						<div class="modal-files-inner">
							<?php Pjax::begin([
								'timeout' => false,
								'id' => 'files-pjax-modal-' . $widget->id,
								'enablePushState' => false
							]) ?>
								<?php $this->registerJs($js); ?>
								<?= FileUpload::widget([
									'model' => $model,
									'url' => [$widget->upload_url],
									'formId' => $form->id,
									'clientOptions' => [
										'fileInput' => "#filemanager-input-{$widget->id}",
										'autoUpload' => true,
										'prependFiles' => true,
										'filesContainer' => "#filemanager-modal-{$widget->id} .filemanager-files"
									],
									'clientEvents' => [
										'stop' => "function (e) {
											$.pjax.reload({container: '#files-pjax-modal-{$widget->id}', timeout: false});
										}",
										'fail' => "function (e) {
											alert('error')
										}"
									]
								]);?>
								<div class="cropping-block hidden">
									<img id="cropping-image-<?= $widget->id ?>" src="" alt="" class="cropping-image">
									<button type="submit" class="cropping-button"><?= __( 'Save') ?></button>
								</div>
							<?php Pjax::end()?>
						</div>
					</div>
					<div class="modal-sidebar ">
						<div class="filemanager-item-detail-block" data-id="">
							<h2><?= Yii::t('main', 'Параметры файла') ?></h2>
							<span class="filemanager-item-saved"><?= __( 'Сохранено') ?></span>

							<div class="filemanager-item-info">
								<div class="thumbnail">
									<img src="">
								</div>
								<div class="details">
									<div class="file-mime_type">
										Тип файла: <span></span>
									</div>
									<div class="file-date_create">
										Загружен: <span></span>
									</div>
									<div class="file-size">
										Размер файла: <span></span>
									</div>
									<div class="file-resolution">
										Размеры: <span></span>
									</div>
								</div>
							</div>
							<div class="filemanager-item-settings">
								<label class="file-url">
									<span><?= __( 'URL') ?></span>
									<input type="text" value="" readonly>
								</label>
								<label class="file-title">
									<span><?= __( 'Заголовок') ?></span>
									<input type="text" value="">
								</label>
								<label class="file-caption">
									<span><?= __( 'Подпись') ?></span>
									<textarea rows="3"></textarea>
								</label>
								<label class="file-description">
									<span><?= __( 'Описание') ?></span>
									<textarea rows="3"></textarea>
								</label>
								<div class="text-right">
									<button class="file-link"><?= __( 'Скачать') ?></button>
									<button class="file-delete"><?= __( 'Удалить') ?></button>
									<button class="file-update"><?= __( 'Сохранить') ?></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="filemanager-add-btn"><?= __( 'Вставить в запись') ?></button>
				</div>
			</div>
		</div>
	</div>
</div>