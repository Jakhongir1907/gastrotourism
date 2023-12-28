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
        <div class="col-12 row margin mt-5 no-padding" style="padding: 0;">
            <div class="col-12 col-md-11 row margin p-0 mx-auto">
                <div class="kontakt-form col-12 row">
                    <div class="send col-12 col-sm-6 row write">

                        <div class="col-12 col-sm-6 kontakt-form-title"><?=__("Registration to event")?></div>
                        <div class="col-12 pt-5">
                            <?= $form->field($model, 'name')
                                ->textInput([
                                    'autofocus' => true,
                                    'placeholder' => __("Ф.И.О"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'country')
                                ->textInput([
                                    'autofocus' => true,
                                    'placeholder' => __("Страна"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'email')
                                ->textInput([
                                    'placeholder' => __("Email"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                        <?= Html::submitButton(__('Отправить сообщение'), ['name' => 'contact-button', 'style' => 'height: 70px']) ?>
                    </div>
                    <div class="col-12 col-sm-6 write" style="padding-top: 6em;">
                        <img src="<?=Settings::value(['logo'])[0]->src?>" style="max-width: 100%" />
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>


</div>