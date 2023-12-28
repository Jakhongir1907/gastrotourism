<?php

use common\modules\filemanager\widgets\InputWidget;
use common\modules\filemanager\widgets\InputWidgetGallery;
use common\modules\filemanager\widgets\ModalWidget;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\gallery\models\Gallery */
/* @var $form yii\widgets\ActiveForm */

if ($model->isNewRecord) $model->status = 1;

?>

<style>
    ul.sortable li {
        width: 300px;
        float: left;
        height: 400px;
        position: relative;
    }

    ul.sortable .file-media {
        max-height: 200px;
        overflow: hidden;
    }

    .sortable-placeholder {
        height: 500px;
    }
</style>

<?php $form = ActiveForm::begin(); ?>
<div class="container-fluid">
    <div class="row">

        <div class="col-xl-8">
            <div class="card shadow p-4 mt-4">
                <div class="form-group">
                    <label class="control-label" for="posts-sort"><?= $model->getAttributeLabel('galleryImages') ?></label>
                    <?= \common\modules\file\widgets\FileManagerModalFile::widget([
                        'model_db' => $model,
                        'form' => $form,
                        'attribute' => 'Gallery[galleryfiles]',
                        'relation_name' => 'files',
                        'via_relation_name' => 'galleryFiles',
                        'id' => 'post_filesdata',
                        'multiple'      => true,
                    ]); ?>

                    <?php
//                    echo InputWidgetGallery::widget([
//                        'model_db' => $model,
//                        'form' => $form,
//                        'attribute' => 'Gallery[galleryfiles]',
//                        'id' => 'imagesposters',
//                        'relation_name' => 'files',
//                        'via_relation_name' => 'galleryFiles',
//                        'withDescription' => true,
//                        'delimitr' => ',',
//                    ]);
                    ?>
                </div>

            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow p-4 mt-4">

                <div class="row">

                    <div class="col-lg-12">
                        <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'class' => 'form-control title-generate']) ?>
                    </div>

                    <div class="col-lg-12">
                        <?= $form->field($model, 'slug')->textInput(['maxlength' => true, 'class' => 'form-control slug-generate']) ?>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <?= $form->field($model,
                            'type')->dropDownList(\common\modules\gallery\models\Gallery::getTypeList())->label(__("Galereya turi")) ?>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <?= $form->field($model, 'status',
                            [
                                'options' => [
                                    'class' => 'form-group form-group-default input-group'
                                ],
                                'template' => '<label class="inline" for="PostForm-status">' . Yii::t('app', "Status") . '</label>
                                       <label class="custom-toggle ml-2">{input}<span class="custom-toggle-slider rounded-circle"></span></label>',
                                'labelOptions' => ['class' => 'inline']
                            ])->checkbox([
                            'data-init-plugin' => 'switchery',
                            'data-color' => 'primary'
                        ], false);
                        ?>

                    </div>

                    <div class="col-lg-12">
                        <div class="form-group pull-right">
                            <?= Html::submitButton(__("Save"), ['class' => 'btn btn-primary']) ?>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<?php ActiveForm::end(); ?>
