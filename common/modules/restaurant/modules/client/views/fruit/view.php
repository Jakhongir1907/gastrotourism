<?php

/* @var $this yii\web\View */
/* @var $model common\modules\restaurant\models\Restaurant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Restaurants', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile('/assets/bbd5f3aa/css/topRest.css');
$this->registerCssFile('/assets/bbd5f3aa/css/rest1.css');
$this->registerCssFile('/assets/bbd5f3aa/css/food.css');

?>

<div class="container">
    <div class="row justify-content-center m-0">
        <div class="brand-food-name col-12">
            <?=$model->name?>
        </div>
        <div class="col-12 p-0 row brand-food justify-content-center">
            <div class="brend-food col-12 row p-0">
                <div class="brend-food-img col-12 col-md-7 p-0 pt-4">
                    <img src="<?=$model->poster->thumbnails->normal['src']?>" alt="brand food">
                </div>
                <div class="col-11 col-md-5 small-img">
                    <div class="brend-img-part2 row d-flex justify-content-center py-auto my-auto">
                    </div>
                </div>
                <div class="col-12 p-0 pt-3 row justify-content-center">
                    <div class="col-12 row rest-text">
                        <?=$model->description?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
