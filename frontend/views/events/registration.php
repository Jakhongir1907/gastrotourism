<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\modules\settings\models\Settings;

$this->title = __('Event Registration');
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/assets/bbd5f3aa/css/kontakt.css');
?>
<div class="container">
    <div class="row">
        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
        <div class="col-12 row margin mt-5 no-padding">
            <div class="col-12 col-md-11 row margin p-0 mx-auto">
                <div class="kontakt-form col-12 row">
                    <div class="send col-12 col-sm-6 row">

                        <div class="col-12 col-sm-6 kontakt-form-title"><?=__("Registration to event")?></div>
                        <div class="col-12 pt-5">
                            <?= $form->field($model, 'fullname')
                                ->textInput([
                                    'autofocus' => true,
                                    'placeholder' => __("Ф.И.О"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'birth_date')
                                ->textInput([
                                    'autofocus' => true,
                                    'placeholder' => __("Birth date"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'phone_number')
                                ->textInput([
                                    'placeholder' => __("Телефон"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'telegram_number')
                                ->textInput([
                                    'placeholder' => __("Telegram contact number"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                    </div>
                    <div class="write col-12 col-sm-6 row">
                        <div class="col-12">
                            <?= $form->field($model, 'address')
                                ->textInput([
                                    'placeholder' => __("Address"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'experience')
                                ->textInput([
                                    'placeholder' => __("Experience"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'work')
                                ->textInput([
                                    'placeholder' => __("Work"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'position')
                                ->textInput([
                                    'placeholder' => __("Position"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>

                        <?= Html::submitButton(__('Отправить сообщение'), ['name' => 'contact-button', 'style' => 'height: 70px']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>


</div>