<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', Yii::t('app', 'Posts')), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
    'class' => 'btn btn-danger',
    'data' => [
        'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
        'method' => 'post',
    ],
]) ?>

<?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

<style>
    .post-card-preview {
        background-color: white;
        box-shadow: 0 7px 9px 0 rgba(0,34,70,.08);
        padding: 20px;
    }

    .post-card-preview .post-content .post-title {
        font-size: 24px;
        color: black;
    }
</style>

<div>
    <div class="post-card-preview row">
        <div class="post-image col-md-3">
            <?=Html::img($model->poster->src, ['width' => 235])?>
        </div>
        <div class="post-content col-md-9">
            <div class="post-title">
                <?=$model->title?>
            </div>
            <div class="post-anons">
                <a href="<?=getenv( 'REACT_URL' ) . $model->short_link?>"><?=getenv( 'REACT_URL' ) . $model->short_link?></a>
            </div>
            <div class="post-anons">
                <?=$model->anons?>
            </div>
            <br />
            <div class="post-description">
                <?=$model->description?>
            </div>
        </div>

    </div>
</div>

<div>

    <div>

        <div>

            <div>

                <div>

<!--                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            'author',
                            'title',
                            'description',
                            'slug',
                            'lang',
                            'lang_hash',
                            'type',
                            'created_at',
                            'updated_at',
                            'published_at',
                            'top',
                            'viewed',
                            'status',
                        ],
                    ]) ?> -->

                </div>

            </div>

        </div>

    </div>

</div>
