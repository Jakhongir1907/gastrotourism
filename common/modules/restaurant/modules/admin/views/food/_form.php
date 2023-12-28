<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\Food */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs("CKEDITOR.plugins.addExternal('youtube', '/youtube/plugin.js', '');");
$this->registerJs("CKEDITOR.plugins.addExternal('justify', '/justify/plugin.js', '');");
\wbraganca\fancytree\FancytreeAsset::register($this);
\common\modules\file\assets\FilemanagerAsset::register(\Yii::$app->view);
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
                    <?= $form->field($model, 'name')->textInput([
                        'maxlength' => true,
                        'placeholder' => __("Наименование"),
                        'class' => 'form-control title-generate',
                        'autocomplete' => 'off',
                    ])->label(false) ?>

                    <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                        'options' => ['rows' => 6],
                        'clientOptions' => [
                            'extraPlugins' => 'filemanager-qwerty,youtube,justify',
                            'height' => 400,
                            'toolbarGroups' => [
                                ['name' => 'filemanager-qwerty']
                            ],
                            'allowedContent' => true
                        ],
                        'preset' => 'full',
                    ])->label(__("Описание")) ?>

                    <?= $form->field($model, 'ingredients')->widget(CKEditor::className(), [
                        'options' => ['rows' => 4],
                        'clientOptions' => [
                            'extraPlugins' => 'filemanager-qwerty,youtube,justify',
                            'height' => 400,
                            'toolbarGroups' => [
                                ['name' => 'filemanager-qwerty']
                            ],
                            'allowedContent' => true
                        ],
                        'preset' => 'full',
                    ])->label(__("Ingredients")) ?>

                    <?= $form->field($model, 'cook_steps')->widget(CKEditor::className(), [
                        'options' => ['rows' => 4],
                        'clientOptions' => [
                            'extraPlugins' => 'filemanager-qwerty,youtube,justify',
                            'height' => 400,
                            'toolbarGroups' => [
                                ['name' => 'filemanager-qwerty']
                            ],
                            'allowedContent' => true
                        ],
                        'preset' => 'full',
                    ])->label(__("Cooking Steps")) ?>

                </div>

            </div>
        </div>
        <div class="col-xl-4">

            <div class="card shadow pt-4 mt-4">
                <div class="panel-body">
                    <div>
                        <label style='<?= $model->getErrors('filesdata') ? "color: red;" : "" ?>'
                               class="poster-label control-label"
                               for="post-filesdata"><?= __("Фото") ?></label>
                        <?= \common\modules\file\widgets\FileManagerModal::widget([
                            'model_db' => $model,
                            'form' => $form,
                            'attribute' => 'Food[filesdata]',
                            'id' => 'food_filesdata',
                            'relation_name' => 'files',
                            'via_relation_name' => 'foodImages',
                            'multiple'      => true,
                            'mime_type'     => 'image',
                            'upload_url' => '/files/uploads/'
                        ]); ?>
                    </div>

                    <div class="col-md-6">
                        <?= $form->field($model, 'price')->textInput() ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'type')->dropDownList(\common\modules\restaurant\models\Food::getTypesDropdown()) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'country_id')->dropDownList(\common\modules\restaurant\models\Country::getDropdownList())->label(__("Country")) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'top',
                            [
                                'options' => [
                                    'class' => 'form-group form-group-default input-group'
                                ],
                                'template' => '<label class="inline" for="PostForm-status">' . __("Топ 10") . '</label>
                                       <label class="custom-toggle ml-2">{input}<span class="custom-toggle-slider rounded-circle"></span></label>',
                                'labelOptions' => ['class' => 'inline']
                            ])->checkbox([
                            'data-init-plugin' => 'switchery',
                            'data-color' => 'primary'
                        ], false);
                        ?>
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
