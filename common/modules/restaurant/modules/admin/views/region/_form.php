<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\Region */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8">
            <div>
                <div class="card shadow p-4 mt-4">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

                </div>
            </div>
        </div>
        <div class="col-xl-4">

            <div>

                <div class="card shadow p-4 mt-4">
                    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                    <div class="form-group">
                        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php ActiveForm::end(); ?>
