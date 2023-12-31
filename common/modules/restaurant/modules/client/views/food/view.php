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
                        <div class="col-12 row">
                            <div class="col-6">
                                <a href="#"  data-toggle="modal" data-target="#modal1" > <img src="/images/brand-food-prosses.png" alt="brend-food"> </a>
                            </div>
                            <div  class="col-5 brend-img-title" >
                                <a href="#" data-toggle="modal" data-target="#modal1">  <?=__("Ингидиенты")?> </a>
                            </div>
                            <div class="modal fade border-0" id="modal1" tabindex="-1" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><img src='/images/close.svg'></span>
                                            </button>
                                        </div>
                                        <div class="modal-body bg-light">
                                            <div class="about-salat"><?=$model->ingredients?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-12 row mt-3">
                            <div class="col-6">
                                <a href="#"  data-toggle="modal" data-target="#modal2" > <img src="/images/tayorlash.png" alt="brend-food"> </a>
                            </div>
                            <div  class="col-5 brend-img-title" >
                                <a href="#" data-toggle="modal" data-target="#modal2"> <?=__("Этапы приготовления")?></a>
                            </div>
                            <div class="modal fade border-0" id="modal2" tabindex="-1" >
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true"><img src='/images/close.svg'></span>
                                            </button>
                                        </div>
                                        <div class="modal-body bg-light">
                                            <div class="about-salat"><?=$model->cook_steps?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-12 p-0 pt-3 row justify-content-center">
                    <div class="col-12 row rest-text">
                        <?=$model->description?>
                    </div>
                </div>

            </div>
            <div class="rest-like col-12 col-md-11 row justify-content-center ">
                <div class="rest-like-title col-12 col-md-11">
                    <?=__("Рестораны которые приготовить эту блюду")?>
                </div>
            </div>
        </div>

        <div class="restoran col-12  row mt-5 ">
            <div class="col-12 rest-wrap col-sm-11 row justify-content-between">
                <?php foreach($restaurants as $restaurant): ?>
                <div class="col-12 col-md-5 mb-5">
                    <div class="img-wrap">
                        <img src="<?=$restaurant->poster->thumbnails->normal['src']?>" alt="Rest Mo`jiza">
                        <a href='<?=$restaurant->getLink()?>' class="img-title">
                            <p class="name"><?=$restaurant->name?></p>
                            <p class="adres"><?=$restaurant->address?></p>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
