<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\Country */
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
                        'placeholder' => __("Наименование"),
                        'class' => 'form-control title-generate',
                        'autocomplete' => 'off',
                    ])->label(false) ?>

                </div>

            </div>
        </div>
        <div class="col-xl-4">

            <div class="card shadow pt-4 mt-4">
                <div class="panel-body">

                    <div class="col-md-6">
                        <?= $form->field($model, 'flag_path')->textInput() ?>
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
