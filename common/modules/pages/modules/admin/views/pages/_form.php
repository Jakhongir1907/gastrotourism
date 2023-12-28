<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

\wbraganca\fancytree\FancytreeAsset::register($this);

?>

<?php
$addon = <<< HTML
<span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
HTML;

$this->registerJs("CKEDITOR.plugins.addExternal('youtube', '/youtube/plugin.js', '');");
$this->registerJs("CKEDITOR.plugins.addExternal('justify', '/justify/plugin.js', '');");

if ($model->isNewRecord) $model->status = true;

?>
<?php $form = ActiveForm::begin(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8">

            <div class="card shadow p-4 mt-4 posts-form">

                <?= $form->field($model, 'title')->textInput(['maxlength' => true,'class' => 'form-control title-generate']) ?>

                <?php  echo \common\modules\filemanager\widgets\ModalWidget::widget(); ?>
                <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                    'options' => ['rows' => 6],
                    'clientOptions'=>[
                        'extraPlugins' => 'filemanager-jakhar,youtube,justify',
                        'height'=>200,
                        'toolbarGroups' => [
                            ['name' => 'filemanager-jakhar']
                        ],
                    ],
                    'preset' => 'full'
                ]) ?>
            </div>

        </div>
        <div class="col-xl-4">

            <div class="card shadow p-4 mt-4">
                <div class="form-group">
                    <label class="control-label" for="posts-sort"><?=$model->getAttributeLabel('Files')?></label>
                    <?= \common\modules\file\widgets\FileManagerModalFile::widget([
                        'model_db' => $model,
                        'form' => $form,
                        'attribute' => 'Pages[imagespostersdata]',
                        'id' => 'post_filesdata',
                        'relation_name' => 'images',
                        'via_relation_name' => 'pagesimages',
                        'multiple'      => true,
                    ]); ?>
                </div>

            </div>

            <div class="card shadow p-4 mt-4">

                <?= $form->field($model, 'slug')->textInput(['maxlength' => true,'class' => 'form-control slug-generate']) ?>

                <div class="form-group">

                    <?= $form->field($model, 'status',
                        ['options' => [
                            'class' => 'form-group form-group-default input-group'],
                            'template' => '<label class="inline" for="PostForm-status">' . Yii::t('app',
                                    "Status") . '</label>
                                       <label class="custom-toggle ml-2">{input}<span class="custom-toggle-slider rounded-circle"></span></label>',
                            'labelOptions' => ['class' => 'inline']
                        ])->checkbox([
                        'data-init-plugin' => 'switchery',
                        'data-color' => 'primary'
                    ], false);
                    ?>

                </div>

                <div style="margin-top: 20px;">
                    <?= Html::submitButton(__('Save'), ['class' => 'btn btn-primary']) ?>
                </div>


            </div>

        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>
