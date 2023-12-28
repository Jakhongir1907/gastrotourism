<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\event\models\Event */
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

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <div class="col-md-6">
                        <?= $form->field($model, 'start_at',
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
                            "value" => date("m/d/Y H:i:s", $model->isNewRecord ? time() : $model->start_at)
                        ], false);
                        ?>
                    </div>

                </div>

            </div>
        </div>
        <div class="col-xl-4">

            <div class="card shadow pt-4 mt-4">
                <div class="panel-body">
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
