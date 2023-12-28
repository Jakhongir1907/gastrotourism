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
                    <?= $form->field($model, 'title')->textInput([
                        'maxlength' => true,
                        'placeholder' => __("Зоголовок"),
                        'class' => 'form-control title-generate',
                        'autocomplete' => 'off',
                    ])->label(false) ?>

                    <?= $form->field($model, 'first_food_description')->widget(CKEditor::className(), [
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
                </div>
            </div>
        </div>

        <div class="col-xl-4">

            <div class="card shadow pt-4 mt-4">
                <div class="panel-body">

                    <?= $form->field($model, 'first_food_name')->textInput([
                        'maxlength' => true,
                        'placeholder' => __("first_food_name"),
                        'class' => 'form-control title-generate',
                        'autocomplete' => 'off',
                    ])->label(false) ?>


                    <div>

                        <label style='<?= $model->getErrors('filesdata') ? "color: red;" : "" ?>'
                               class="poster-label control-label"
                               for="foodvs_first_picture"><?= __("first_food_picture") ?></label>
                        <?= \common\modules\file\widgets\FileManagerModal::widget([
                            'model_db' => $model,
                            'form' => $form,
                            'attribute' => 'FoodVs[firstimagedata]',
                            'id' => 'foodvs_first_image',
                            'relation_name' => 'foodVsFirstFoodImageFiles',
                            'via_relation_name' => 'foodVsFirstFoodImage',
                            'multiple'      => false,
                            'mime_type'     => 'image',
                            'upload_url' => '/files/uploads/',
                        ]); ?>
                    </div>
                    <div>
                        <label style='<?= $model->getErrors('filesdata') ? "color: red;" : "" ?>'
                               class="poster-label control-label"
                               for="foodvs_first_flag"><?= __("first_food_flag") ?></label>
                        <?= \common\modules\file\widgets\FileManagerModal::widget([
                            'model_db' => $model,
                            'form' => $form,
                            'attribute' => 'FoodVs[firstflagdata]',
                            'id' => 'foodvs_first_flag',
                            'relation_name' => 'foodVsFirstFoodFlagFiles',
                            'via_relation_name' => 'foodVsFirstFoodFlag',
                            'multiple'      => false,
                            'mime_type'     => 'image',
                            'upload_url' => '/files/uploads/',
                        ]); ?>
                    </div>
                </div>
            </div>

            <div class="card shadow pt-4 mt-4">
                <div class="panel-body">
                    <?= $form->field($model, 'second_food_name')->textInput([
                        'maxlength' => true,
                        'placeholder' => __("second_food_name"),
                        'class' => 'form-control title-generate',
                        'autocomplete' => 'off',
                    ])->label(false) ?>

                    <div>

                        <label style='<?= $model->getErrors('secondimagedata') ? "color: red;" : "" ?>'
                               class="poster-label control-label"
                               for="foodvs_first_picture"><?= __("second_food_picture") ?></label>
                        <?= \common\modules\file\widgets\FileManagerModal::widget([
                            'model_db' => $model,
                            'form' => $form,
                            'attribute' => 'FoodVs[secondimagedata]',
                            'id' => 'foodvs_second_image',
                            'relation_name' => 'foodVsSecondFoodImageFiles',
                            'via_relation_name' => 'foodVsSecondFoodImage',
                            'multiple'      => false,
                            'mime_type'     => 'image',
                            'upload_url' => '/files/uploads/',
                        ]); ?>
                    </div>
                    <div>
                        <label style='<?= $model->getErrors('secondflagsdata') ? "color: red;" : "" ?>'
                               class="poster-label control-label"
                               for="foodvs_first_flag"><?= __("second_food_flag") ?></label>
                        <?= \common\modules\file\widgets\FileManagerModal::widget([
                            'model_db' => $model,
                            'form' => $form,
                            'attribute' => 'FoodVs[secondflagdata]',
                            'id' => 'foodvs_second_flag',
                            'relation_name' => 'foodVsSecondFoodFlagFiles',
                            'via_relation_name' => 'foodVsSecondFoodFlag',
                            'multiple'      => false,
                            'mime_type'     => 'image',
                            'upload_url' => '/files/uploads/',
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
