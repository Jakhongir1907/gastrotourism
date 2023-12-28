<?php

/* @var $this \yii\web\View */

/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;

\backend\assets\admin\AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html style="font-size: medium !important;" lang="<?= Yii::$app->language ?>">
    <head>

        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>

    </head>
    <body>
    <?php $this->beginBody() ?>

    <nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
                    aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="pt-0" href="/">
                <img src="<?= $this->getAssetUrl(\backend\assets\admin\AdminAsset::class,
                    "img/logo.png") ?>" width="100" />
            </a>
            <!-- User -->
            <ul class="nav align-items-center d-md-none">
                <li class="nav-item dropdown">
                    <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <i class="ni ni-bell-55"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right"
                         aria-labelledby="navbar-default_dropdown_1">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        <div class="media align-items-center">
              <span class="avatar avatar-sm rounded-circle">
                <img alt="Image placeholder" src="./assets/img/theme/team-1-800x800.jpg
">
              </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome!</h6>
                        </div>
                        <a href="./examples/profile.html" class="dropdown-item">
                            <i class="ni ni-single-02"></i>
                            <span>My profile</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#!" class="dropdown-item">
                            <i class="ni ni-user-run"></i>
                            <span>Logout</span>
                        </a>
                    </div>
                </li>
            </ul>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="./index.html">
                                <img src="./assets/img/brand/blue.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse"
                                    data-target="#sidenav-collapse-main" aria-controls="sidenav-main"
                                    aria-expanded="false" aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-4 mb-3 d-md-none">
                    <div class="input-group input-group-rounded input-group-merge">
                        <input type="search" class="form-control form-control-rounded form-control-prepended"
                               placeholder="Search" aria-label="Search">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                    </div>
                </form>

                <!-- Navigation -->
                <?php new \common\modules\menu\components\MenuAdminBackend([
                    'alias' => 'backend',
                    'without_cache' => true
                ]);
                ?>
            </div>
        </div>
    </nav>


    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-expand-md navbar-light" id="navbar-main">
            <div class="container-fluid" style="justify-content: right;">
                <!-- Brand -->
                <ul class="navbar-nav align-items-center d-none d-md-flex">
                    <?php if (!\Yii::$app->user->isGuest): ?>
                    <li class="nav-item">
                        <a class="nav-link pr-0" href="<?=\Yii::$app->urlManager->createUrl(['site/profile'])?>" role="button">
                            <div class="media align-items-center">
                                <div class="ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm font-weight-bold"><i class="fa fa-user"></i> <?=__('Profile')?></span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link pr-0" href="/site/logout" role="button">
                            <div class="media align-items-center">
                                <div class="ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm  font-weight-bold"><?=__("Chiqish")?></span>
                                </div>
                            </div>
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <!-- End Navbar -->

        <!-- Header -->
        <div class="header pt-md-6">
            <div class="container-fluid">
                <div class="header-body">
                    <!--                    <div class="row">
                                            <div class="col-xl-3 col-lg-6">
                                                <div class="card card-stats mb-4 mb-xl-0">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5 class="card-title text-uppercase text-muted mb-0">Traffic</h5>
                                                                <span class="h2 font-weight-bold mb-0">350,897</span>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                                    <i class="fas fa-chart-bar"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="mt-3 mb-0 text-muted text-sm">
                                                            <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                                            <span class="text-nowrap">Since last month</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6">
                                                <div class="card card-stats mb-4 mb-xl-0">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                                                                <span class="h2 font-weight-bold mb-0">2,356</span>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                                    <i class="fas fa-chart-pie"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="mt-3 mb-0 text-muted text-sm">
                                                            <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                                            <span class="text-nowrap">Since last week</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6">
                                                <div class="card card-stats mb-4 mb-xl-0">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                                                                <span class="h2 font-weight-bold mb-0">924</span>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                                                    <i class="fas fa-users"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="mt-3 mb-0 text-muted text-sm">
                                                            <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                                            <span class="text-nowrap">Since yesterday</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-lg-6">
                                                <div class="card card-stats mb-4 mb-xl-0">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                                                                <span class="h2 font-weight-bold mb-0">49,65%</span>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                                    <i class="fas fa-percent"></i>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p class="mt-3 mb-0 text-muted text-sm">
                                                            <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                                            <span class="text-nowrap">Since last month</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                </div>
            </div>
        </div>

        <div class="container-fluid pt-3">

        </div>


        <div class="container-fluid">
            <div class="row">
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    'options' => [
                        'class' => 'breadcrumb col'
                    ]
                ]) ?>
                <?= Alert::widget() ?>
            </div>
        </div>
        <?= $content ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>