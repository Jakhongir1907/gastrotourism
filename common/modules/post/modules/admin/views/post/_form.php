<?php
/**
 * @var $model Post
 */

use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\modules\post\models\Post;
use common\modules\tag\models\Tag;
use yii\helpers\ArrayHelper;

$model->status = $model->isNewRecord ? true : $model->status;
$model->enable_comments = $model->isNewRecord ? true : $model->enable_comments;

$this->registerJs("CKEDITOR.plugins.addExternal('youtube', '/youtube/plugin.js', '');");
$this->registerJs("CKEDITOR.plugins.addExternal('justify', '/justify/plugin.js', '');");
\wbraganca\fancytree\FancytreeAsset::register($this);

?>

<?php $form = ActiveForm::begin([
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'errorCssClass' => '',
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8">

            <div>

                <div class="card shadow p-4 mt-4">
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => true,
                        'placeholder' => __("Мақоланинг мавзусини киритинг"),
                        'class' => 'form-control title-generate',
                        'autocomplete' => 'off',
                    ])->label(false) ?>

                    <?= $form->field($model, 'anons')->textInput([
                        'maxlength' => true,
                        'placeholder' => __("Анонс"),
                        'class' => 'form-control title-generate',
                        'autocomplete' => 'off',
                    ])->label(false) ?>

                    <?= $form->field($model, 'slug')->textInput([
                        'class' => 'form-control slug-generate',
                        'style' => 'display:none;'
                    ])->label(false) ?>

                    <?= common\modules\file\widgets\FileManagerEditorModal::widget() ?>
                    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                        'options' => ['rows' => 12],
                        'clientOptions' => [
                            'extraPlugins' => 'filemanager-qwerty,youtube,justify',
                            'height' => 400,
                            'toolbarGroups' => [
                                ['name' => 'filemanager-qwerty']
                            ],
                            'allowedContent' => true
                        ],
                        'preset' => 'full',
                    ])->label(__("Тўлиқ матнни киритнг")) ?>

                </div>

            </div>
        </div>
        <div class="col-xl-4">

            <div class="card shadow pt-4 mt-4">
                <div class="panel-body">
                    <div>
                        <label style='<?= $model->getErrors('filesdata') ? "color: red;" : "" ?>'
                               class="poster-label control-label"
                               for="post-filesdata"><?= __("Мақоланинг фотосини юкланг") ?></label>
                        <?= \common\modules\file\widgets\FileManagerModal::widget([
                            'model_db' => $model,
                            'form' => $form,
                            'attribute' => 'Post[filesdata]',
                            'id' => 'post_filesdata',
                            'relation_name' => 'files',
                            'via_relation_name' => 'postFiles',
                            'multiple'      => true,
                            'mime_type'     => 'image',
                            'upload_url' => '/files/uploads/'
                        ]); ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'published_at',
                            [
                                'options' => [
                                    'class' => 'form-group form-group-default input-group',
                                ],
                                'template' => '
                    <div class="input-group input-group-alternative">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                        </div>
                        {input}{error}
                    </div>',
                            ])->textInput([
                            'class' => 'form-control datepicker',
                            "placeholder" => "Select date",
                            "value" => date("m/d/Y", $model->isNewRecord ? time() : $model->published_at)
                        ], false);
                        ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'status',
                            [
                                'options' => [
                                    'class' => 'form-group form-group-default input-group'
                                ],
                                'template' => '<label class="inline" for="PostForm-status">' . __("Published") . '</label>
                                       <label class="custom-toggle ml-2">{input}<span class="custom-toggle-slider rounded-circle"></span></label>',
                                'labelOptions' => ['class' => 'inline']
                            ])->checkbox([
                            'data-init-plugin' => 'switchery',
                            'data-color' => 'primary'
                        ], false);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <div class="col-md-6">
                            <?= $form->field($model, 'type')
                                ->dropDownList([
                                    Post::TYPE_DEFAULT => __("Макола"),
                                    Post::TYPE_FESTIVAL => __("Фестивал"),
                                    Post::TYPE_BLOG => __("Блог"),
                                ]) ?>
                        </div>

                    </div>
                    <div style="clear: both; margin-top: 20px;">
                        <div class="col-md-6 v-align-middle" style="text-align: left;">
                            <?= Html::submitButton(__('Save'), ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

<?php

$picker = <<<JS
  // $('#datepicker-post').datetimepicker({
  //  format: 'dd.mm.yyyy h:i:s',
  //  use24hours: true
  // });

$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });
  
  $('form').on('submit', function(e) {
      var posters = $('#file-post_filesdata').val();
      
      if (posters.length == 0) {
          $('.poster-label').css({'color': 'red'});
          return false;
      }
  });
});

JS;

$this->registerJs($picker);

?>
