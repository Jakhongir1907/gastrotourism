<?php

use common\modules\langs\widgets\LangsWidgets;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\gallery\models\GallerySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Galleries';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
    <div class="row">
        <div class="card shadow" style="width: 100%">
            <div class="card-header border-0">
                <div class="row align-items-center">

                    <div class="col">
                        <?php echo LangsWidgets::widget(['dont_show' => ['oz']]); ?>
                    </div>
                    <div class="col text-right">
                        <?= Html::a(Yii::t('app', 'Create Gallery'), ['create'],
                            ['class' => 'btn btn-primary pull-right col-md-offset-1']) ?>
                    </div>
                </div>
            </div>

            <div class="table-responsive card-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
//                        'created_date',
//                        'status',
                        'title',
                        //'slug',

                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => Yii::t('app', 'Actions'),
                            'headerOptions' => ['style' => 'text-align:center'],
                            'template' => '{buttons}',
                            'contentOptions' => [
                                'style' => 'min-width:150px;max-width:150px;width:150px',
                                'class' => 'v-align-middle'
                            ],
                            'buttons' => [
                                'buttons' => function ($url, $model) {
                                    $controller = Yii::$app->controller->id;
                                    $deleteText = __("Are you sure you want to delete this item?");
                                    $code = <<<BUTTONS
                                                <div class="btn-group flex-center">
                                                    <a href="/{$controller}/{$controller}/update/?{$model->primaryKey()[0]}={$model->{$model->primaryKey()[0]}}" class="btn btn-primary"><i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="/{$controller}/{$controller}/delete?{$model->primaryKey()[0]}={$model->{$model->primaryKey()[0]}}" data-method="post" data-postID="{$model->{$model->primaryKey()[0]}}" data-postType="{$controller}" class="btn btn-danger postRemove" data-confirm = '{$deleteText}' data-method = 'post'>
                                                       <i class="fa fa-trash"></i>
                                                    </a>
                                                </div>
BUTTONS;
                                    return $code;
                                }

                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
