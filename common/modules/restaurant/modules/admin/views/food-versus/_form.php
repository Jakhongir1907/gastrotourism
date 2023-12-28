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

                    <?=$form->field($model, 'first_food_id')->dropDownList(\common\modules\restaurant\models\Food::getDropdownList())?>
                    <?=$form->field($model, 'second_food_id')->dropDownList(\common\modules\restaurant\models\Food::getDropdownList())?>

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
