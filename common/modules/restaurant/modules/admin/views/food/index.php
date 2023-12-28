<?php

use common\modules\langs\widgets\LangsWidgets;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\restaurant\models\search\FoodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = __("Foods");
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
                        <?= Html::a(Yii::t('app', 'Create Food'), ['create'],
                            ['class' => 'btn btn-primary pull-right col-md-offset-1']) ?>
                    </div>
                </div>
            </div>

            <div class="table-responsive card-body">

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'layout' => '{items}',
                    'tableOptions' => [
                        'class' => 'table table-hover table-striped table-bordered gridview-table',
                    ],
                    'columns' => [
                        [
                            'attribute' => 'id',
                            'contentOptions' => ['class' => 'v-align-middle'],
                        ],
                        [
                            'attribute' => 'name',
                            'contentOptions' => ['class' => 'v-align-middle'],
                            'format' => 'raw',
                            'value' => function($model) {
                                return "<div style='width: 80%; white-space: pre-wrap;'>{$model->name}</div>";
                            }
                        ],
                        [
                            'attribute' => 'top',
                            'filter' => Html::activeDropDownList($searchModel, 'top',
                                ['1' => 'Top', '0' => 'No top'],
                                ['class' => 'v-align-middle form-control', 'prompt' => 'Select top']),
                            'contentOptions' => ['class' => 'v-align-middle'],
                            'value' => function ($model) {
                                return $model->top ? 'Top' : 'No top';
                            }
                        ],
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
                                                    <a href="/restaurant/{$controller}/update/?id={$model->id}" class="btn btn-primary"><i class="fa fa-edit"></i>
                                                    </a>
                                                    <a href="/restaurant/{$controller}/delete?id={$model->id}" data-method="post" data-postID="{$model->id}" data-postType="{$controller}" class="btn btn-danger postRemove" data-confirm = '{$deleteText}' data-method = 'post'>
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

        <div class="row index-footer">

            <div class="col-md-6">

                <?= \yii\widgets\LinkPager::widget(['pagination' => $dataProvider->pagination]) ?>

            </div>

        </div>

    </div>
</div>
