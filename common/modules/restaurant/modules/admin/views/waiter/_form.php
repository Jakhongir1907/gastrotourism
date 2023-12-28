<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\Waiter */
/* @var $form yii\widgets\ActiveForm */
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
                        'placeholder' => __("Имя"),
                        'class' => 'form-control title-generate',
                        'autocomplete' => 'off',
                    ])->label(false) ?>

                    <?= $form->field($model, 'position')->textInput([
                        'maxlength' => true,
                        'placeholder' => __("Должность"),
                        'class' => 'form-control',
                        'autocomplete' => 'off',
                    ])->label(false) ?>

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
                            'attribute' => 'Waiter[filesdata]',
                            'id' => 'waiter_filesdata',
                            'relation_name' => 'files',
                            'via_relation_name' => 'waiterFiles',
                            'multiple'      => true,
                            'mime_type'     => 'image',
                            'upload_url' => '/files/uploads/'
                        ]); ?>
                    </div>

                    <div class="col-md-12">
                        <?= $form->field(
                                $model, 'restaurant_id')
                            ->dropDownList(\yii\helpers\ArrayHelper::map(\common\modules\restaurant\models\Restaurant::find()->all(), 'id', 'name')) ?>
                    </div>

                    <div class="col-md-6 v-align-middle" style="text-align: left;">
                        <?= Html::submitButton(__('Save'), ['class' => 'btn btn-primary']) ?>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>
