<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\Restaurant */
/* @var $form yii\widgets\ActiveForm */

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
                    <?= $form->field($model, 'name')->textInput([
                        'maxlength' => true,
                        'placeholder' => __("Наименование ресторана"),
                        'class' => 'form-control title-generate',
                        'autocomplete' => 'off',
                    ])->label(false) ?>

                    <?= $form->field($model, 'address')->textInput([
                        'maxlength' => true,
                        'placeholder' => __("Адрес"),
                        'class' => 'form-control',
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
                    ])->label(__("О ресторане")) ?>

                </div>

            </div>
        </div>
        <div class="col-xl-4">

            <div class="card shadow pt-4 mt-4">
                <div class="panel-body">
                    <div>
                        <label style='<?= $model->getErrors('filesdata') ? "color: red;" : "" ?>'
                               class="poster-label control-label"
                               for="post-filesdata"><?= __("Фото ресторана") ?></label>
                        <?= \common\modules\file\widgets\FileManagerModal::widget([
                            'model_db' => $model,
                            'form' => $form,
                            'attribute' => 'Restaurant[filesdata]',
                            'id' => 'restaurant_filesdata',
                            'relation_name' => 'files',
                            'via_relation_name' => 'restaurantImages',
                            'multiple'      => true,
                            'mime_type'     => 'image',
                            'upload_url' => '/files/uploads/'
                        ]); ?>
                    </div>

                    <div class="col-md-6">
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

                    <div class="col-md-6">
                        <?= $form->field($model, 'delivery',
                            [
                                'options' => [
                                    'class' => 'form-group form-group-default input-group'
                                ],
                                'template' => '<label class="inline" for="PostForm-status">' . __("Доставка") . '</label>
                                       <label class="custom-toggle ml-2">{input}<span class="custom-toggle-slider rounded-circle"></span></label>',
                                'labelOptions' => ['class' => 'inline']
                            ])->checkbox([
                            'data-init-plugin' => 'switchery',
                            'data-color' => 'primary'
                        ], false);
                        ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'work_time_start')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'work_time_end')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'region_id')->dropDownList(\common\modules\restaurant\models\Region::getDropdownList()) ?>

                    </div>

                </div>
            </div>

            <div class="card shadow pt-4 mt-4">
                <div class="panel-body">
                    <div>
                        <label style='<?= $model->getErrors('foodsdata') ? "color: red;" : "" ?>'
                               class="poster-label control-label"
                               for="post-foodsdata"><?= __("Меню ресторана") ?></label>
                        <?= \common\modules\restaurant\widgets\RestaurantFoods::widget([
                            'model_db' => $model,
                            'form' => $form,
                            'attribute' => 'Restaurant[foodsdata]',
                            'id' => 'restaurant_foodsdata',
                            'relation_name' => 'restaurantFoods',
                            'via_relation_name' => 'restaurantFoods',
                            'multiple'      => true,
                        ]); ?>
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
