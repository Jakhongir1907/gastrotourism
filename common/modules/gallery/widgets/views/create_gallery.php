<?php

use common\modules\filemanager\widgets\InputWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\gallery\models\Gallery */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'action' => ['gallery/gallery/create']
]); ?>
<div class="col-md-7">

    <div class="posts-form">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true,'class' => 'form-control title-generate']) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>

</div>


<div class="col-lg-5">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <?= $form->field($model, 'status',
                ['options' => [
                    'class' => 'form-group form-group-default input-group'],
                    'template' => '<label class="inline" for="PostForm-status">' . Yii::t('app', "Status") . '</label>
                                       <span class="input-group-addon bg-transparent">{input}</span>',
                    'labelOptions' => ['class' => 'inline']
                ])->checkbox([
                'data-init-plugin' => 'switchery',
                'data-color' => 'primary'
            ], false);
            ?>
        </div>

        <?= $form->field($model, 'slug')->textInput(['maxlength' => true,'class' => 'form-control slug-generate']) ?>

        <div class="form-group">
            <label class="control-label" for="posts-sort"><?=$model->getAttributeLabel('galleryImages')?></label>
            <?php
            echo InputWidget::widget([
                'model_db' => $model,
                'form' => $form,
                'attribute' => 'Gallery[galleryfiles]',
                'id' => 'imagesposters',
                'relation_name' => 'files',
                'via_relation_name' => 'galleryFiles',
                'delimitr' => ',',
            ]);
            ?>
        </div>

    </div>
</div>
<?php ActiveForm::end(); ?>
