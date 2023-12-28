<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<style>
    .card-body div a {
        margin-right: 0;
    }
</style>

<div class="container-fluid mt-3">
    <div class="row">

        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1"><?=__('Yangiliklar')?></h6>
                            <h2 class="mb-0"><?=\common\modules\post\models\Post::find()->count()?></h2>
                        </div>
                    </div>
                </div>
                <div class="card-body main-buttons">
                    <div class="main-action-buttons">
                        <a class="btn btn-success" href="<?=\Yii::$app->urlManager->createUrl(['post/post/create'])?>"><i class="fa fa-plus"></i> <?=__('Yangilik yaratish')?></a>
                        <a class="btn btn-primary" href="<?=\Yii::$app->urlManager->createUrl(['post/post/index'])?>"><i class="fa fa-eye"></i> <?=__('Barcha yangiliklar')?></a>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1"><?=__('Restaurants')?></h6>
                            <h2 class="mb-0"><?=\common\modules\restaurant\models\Restaurant::find()->lang()->count()?></h2>
                        </div>
                    </div>
                </div>
                <div class="card-body main-buttons">
                    <div class="main-action-buttons">
                        <a class="btn btn-success" href="<?=\Yii::$app->urlManager->createUrl(['restaurant/restaurant/create'])?>"><i class="fa fa-plus"></i> <?=__('Create restaurant')?></a>
                        <a class="btn btn-primary" href="<?=\Yii::$app->urlManager->createUrl(['restaurant/restaurant/index'])?>"><i class="fa fa-eye"></i> <?=__('All Restaurants')?></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-muted ls-1 mb-1"><?=__('Foods')?></h6>
                            <h2 class="mb-0"><?=\common\modules\restaurant\models\Food::find()->lang()->count()?></h2>
                        </div>
                    </div>
                </div>
                <div class="card-body main-buttons">
                    <div class="main-action-buttons">
                        <a class="btn btn-success" href="<?=\Yii::$app->urlManager->createUrl(['restaurant/food/create'])?>"><i class="fa fa-plus"></i> <?=__('Create Food')?></a>
                        <a class="btn btn-primary" href="<?=\Yii::$app->urlManager->createUrl(['restaurant/food/index'])?>"><i class="fa fa-eye"></i> <?=__('All Foods')?></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-5">
        <div class="col-xl-8 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0"><?=__("Mahsulot sotib olish uchun murojaatlar")?></h3>
                        </div>
                        <div class="col text-right">
                            <a href="<?=\Yii::$app->urlManager->createUrl(['request/request/index'])?>" class="btn btn-sm btn-primary"><?=__('Barchasi')?></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col"><?=__('FIO')?></th>
                            <th scope="col"><?=__('E-mail')?></th>
                            <th scope="col"><?=__('Phone')?></th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($requests as $request): ?>
                            <tr>
                                <td scope="col"><?=$request->name?></td>
                                <td scope="col"><?=$request->email?></td>
                                <td scope="col"><?=$request->phone?></td>
                                <td scope="col">
                                    <a class="btn btn-success" href="<?=\Yii::$app->urlManager->createUrl(['requests/view', 'id' => $request->id])?>">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Footer -->
    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
        </div>
    </footer>

</div>
