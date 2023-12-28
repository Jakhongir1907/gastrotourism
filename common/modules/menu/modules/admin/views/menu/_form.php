<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;
use jakharbek\categories\models\Categories;
use common\modules\langs\widgets\LangsWidgets;
use dosamigos\ckeditor\CKEditor;
use dosamigos\selectize\SelectizeDropDownList;
use dosamigos\selectize\SelectizeTextInput;
use kartik\widgets\Select2;
use kartik\editable\Editable;
use kartik\daterange\DateRangePicker;
use kartik\switchinput\SwitchInput;
use yii\widgets\Pjax;
use common\modules\menu\models\Menu;
use common\modules\menu\models\MenuItems;
use yii\jui\Sortable;

/* @var $this yii\web\View */
/* @var $model common\modules\menu\models\Menu */
/* @var $form yii\widgets\ActiveForm */
$addon = <<< HTML
<span class="input-group-addon">
    <i class="glyphicon glyphicon-calendar"></i>
</span>
HTML;
?>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-xl-4">
            <div class="card shadow p-4">
                <?php if(!$model->isNewRecord):?>
                    <div class="card-header"><h3><?=Yii::t('app','Item')?></h3></div>
                    <div class="panel-body">
                        <div class="menu-items-form">

                            <?php $form = ActiveForm::begin(['id' => 'menu-form-item','options' => ['data-pjax' => true]]); ?>

                            <?= $form->field($menuItem, 'title')->textInput(['maxlength' => true]) ?>

                            <?= $form->field($menuItem, 'url')->textInput(['maxlength' => true]) ?>

                            <?php  echo $form->field($menuItem, 'icon')->textInput(['maxlength' => true]); ?>

                            <div class="form-group">
                                <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
                            </div>

                            <?php ActiveForm::end(); ?>

                        </div>

                    </div>
                <?php endif;?>
            </div>
            <div class="card shadow mt-4 p-4">
                <div class="card-header"><h3><?=Yii::t('app','Menu')?></h3></div>
                <div class="panel-body">
                    <div class="menu-form">
                        <?php $form = ActiveForm::begin(['id' => 'menu-form','options' => ['data-pjax' => true]]); ?>
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'alias')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'type')->dropDownList($model::find()->types()) ?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card shadow p-4">
                <div class="panel-heading"><?=Yii::t('app','All items')?></div>
                <div class="panel-body">
                    <?php
                    if(!$model->isNewRecord):
                        $menu = new \common\modules\menu\components\MenuAdmin(['alias' => $model->alias]);
                    endif;
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>

