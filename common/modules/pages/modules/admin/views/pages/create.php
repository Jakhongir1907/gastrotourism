<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;
use jakharbek\categories\models\Categories;
use jakharbek\tags\widgets\TagsWidget;
use jakharbek\filemanager\models\Files;
use common\modules\langs\widgets\LangsWidgets;
use dosamigos\ckeditor\CKEditor;
use dosamigos\selectize\SelectizeDropDownList;
use dosamigos\selectize\SelectizeTextInput;
use kartik\widgets\Select2;
use kartik\editable\Editable;
use kartik\daterange\DateRangePicker;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model common\modules\pages\models\Pages */

$this->title = Yii::t('app','Create Pages');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app','Pages'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="card shadow">
        <div class="card-header">
            <?=\common\modules\langs\widgets\LangsWidgets::widget(); ?>
        </div>
    </div>
</div>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
