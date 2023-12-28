<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\search\FoodVsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-vs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'first_food_name') ?>

    <?= $form->field($model, 'second_food_name') ?>

    <?= $form->field($model, 'first_food_description') ?>

    <?= $form->field($model, 'second_food_description') ?>

    <?php // echo $form->field($model, 'first_food_picture') ?>

    <?php // echo $form->field($model, 'second_food_picture') ?>

    <?php // echo $form->field($model, 'first_food_flag') ?>

    <?php // echo $form->field($model, 'second_food_flag') ?>

    <?php // echo $form->field($model, 'first_likes') ?>

    <?php // echo $form->field($model, 'second_likes') ?>

    <?php // echo $form->field($model, 'lang') ?>

    <?php // echo $form->field($model, 'lang_hash') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
