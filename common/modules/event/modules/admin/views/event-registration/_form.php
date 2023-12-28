<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\event\models\EventRegistration */
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

                    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'birth_date')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'experience')->textInput() ?>

                    <?= $form->field($model, 'work')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

                </div>

            </div>
        </div>
        <div class="col-xl-4">

            <div class="card shadow pt-4 mt-4">
                <div class="panel-body">
                    <div class="col-md-6">
                        <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'telegram_number')->textInput(['maxlength' => true]) ?>
                    </div>
                    <div class="col-md-12">
                        <?= $form->field($model, 'status',
                            [
                                'options' => [
                                    'class' => 'form-group form-group-default input-group'
                                ],
                                'template' => '<label class="inline" for="PostForm-status">' . __("Status") . '</label>
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
