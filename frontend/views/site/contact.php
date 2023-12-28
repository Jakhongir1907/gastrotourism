<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use common\modules\settings\models\Settings;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/assets/bbd5f3aa/css/kontakt.css');
?>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-11 row mx-auto p-0 ">
            <div class="col-12 p-0">
                <p class=" adress-title p-0"><?=__("Наш адрес:")?></p>
                <p class="adress p-0"><?=Settings::value(['organization-address'])?></p>
            </div>
            <div class="col-12 col-md-10 pt-4 p-0">
                <div class="col-12 col-md-5 p-0">
                    <p class="svyaz-title"><?=__("Номера для связи:")?></p>
                    <p class="svyaz"><?=Settings::value(['organization-phone'])?></p>
                </div>
                <div class="col-12 col-md-7 p-0">
                    <p class="pochta-title p-0"><?=__("Наше электронная почта:")?></p>
                    <p class="pochta"><?=Settings::value(['organization-email'])?></p>
                </div>
            </div>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
        <div class="col-12 row margin mt-5 no-padding">
            <div class="col-12 col-md-11 row margin p-0 mx-auto">
                <div class="kontakt-form col-12 row">
                    <div class="send col-12 col-sm-6 row">

                        <div class="col-12 col-sm-6 kontakt-form-title"><?=__("Отправить сообщение")?></div>
                        <div class="col-12 pt-5">
                            <?= $form->field($model, 'name')
                                ->textInput([
                                    'autofocus' => true,
                                    'placeholder' => __("Ф.И.О"),
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
                        <div class="col-12">
                            <?= $form->field($model, 'phone')
                                ->textInput([
                                    'placeholder' => __("Телефон"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'subject')
                                ->textInput([
                                    'placeholder' => __("Предмет"),
                                    'class' => ''
                                ])->label(false) ?>
                        </div>
                    </div>
                    <div class="write col-12 col-sm-6 row">
                        <div class="write-title col-12"><?=__("Cообщение")?></div>
                        <?= $form->field($model, 'body')->textarea(['placeholder' => __("Напишите текст здесь …"), 'class' => 'col-12'])->label(false) ?>
                        <?= Html::submitButton(__('Отправить сообщение'), ['name' => 'contact-button']) ?>
                    </div>

                    <div class="kontakt-img">
                        <img src="/images/kontakt-img.png" alt="call us">
                    </div>

                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>


</div>