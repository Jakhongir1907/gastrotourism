<?php

/**
 * @var  $dataProvider ActiveDataProvider
 * @var  $searchModel PostSearch
 */

use yii\helpers\Html;
use yii\grid\GridView;
use common\modules\post\models\Post;
use common\modules\langs\widgets\LangsWidgets;
use yii\data\ActiveDataProvider;
use common\modules\post\models\PostSearch;
$this->title = Yii::t('app', Yii::t('app', 'Posts'));
$this->params['breadcrumbs'][] = $this->title;

?>

<style>
    .nav.nav-tabs {
        border-bottom: 0px !important;
    }
</style>
<div class="row">
    <div class="col-md-9">
        <?php  echo LangsWidgets::widget(); ?>
    </div>
</div>
<div>

    <div>

        <div>

            <div>

                <div>

                    <div class="table-responsive">

						<?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'layout' => '{items}',
                            'tableOptions' => [
                                'class' => 'table table-hover table-striped table-bordered gridview-table'
                            ],
                            'columns' => [
                                [
                                    'headerOptions' => ['style' => 'min-width:55px;max-width:55px;width:55px'],
                                    'contentOptions' => ['class' => 'v-align-middle'],
                                    'content' => function( $model ) {
                                        return '<div class="checkbox check-success"><input class="post-check" type="checkbox" name="' . $model->id . '" id="checkbox' . $model->id . '"><label for="checkbox' . $model->id . '"></label></div>';
                                    }
                                ],
                                [
                                    'class' => 'yii\grid\SerialColumn',
                                    'contentOptions' => ['class' => 'v-align-middle'],
                                ],
                                [
                                     'attribute' => 'title',
                                     'contentOptions' => ['class' => 'v-align-middle'],
                                ],
                                [
                                    'attribute' => 'comment_count', // comment soni
                                    'contentOptions' => ['class' => 'v-align-middle'],
                                    'value' => function($model){
                                        return $model->commentCount;
                                    }
                                ],
                                [    'filter' => Html::activeTextInput($searchModel,'published_at',['id'=>'index-published-at','class'=>'form control v-align-middle']),
                                     'attribute' => 'published_at',
                                     'contentOptions' => ['class' => 'v-align-middle'],
                                     'format' => 'raw'
                                ],
                               [
                                    'class' => 'yii\grid\ActionColumn',
                                    'header' => Yii::t('app', 'Actions'),
                                    'headerOptions' => ['style' => 'text-align:center'],
                                    'template' => '{buttons}',
                                    'contentOptions' => ['style' => 'min-width:150px;max-width:150px;width:150px', 'class' => 'v-align-middle'],
                                    'buttons' => [
                                        'buttons' => function ($url, $model) {
                                            $controller = Yii::$app->controller->id;
                                            $code = <<<BUTTONS
                                                <div class="btn-group flex-center">
                                                    <a href="/post/{$controller}/update/{$model->id}" class="btn btn-complete"><i class="fa fa-pencil"></i>
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

                        <?=  \yii\widgets\LinkPager::widget(['pagination' => $dataProvider->pagination])?>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<?php

$picker =<<<JS
  $('#index-published-at').datepicker({
   format: 'dd.mm.yyyy'
  });
JS;

$this->registerJs($picker);

?>
