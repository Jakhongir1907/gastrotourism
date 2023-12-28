<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'controllerMap' => [
        'files' => 'common\modules\filemanager\controllers\FilesController',
        'categories' => 'common\modules\categories\controllers\CategoriesController'
    ],
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-gastrotourism-admin', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'gastrotourism-backend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'assetManager' => [
            
            'appendTimestamp' => true,
        ],
    ],
    'modules' => [
        'menu' => common\modules\menu\modules\admin\Module::class,
        'post' => common\modules\post\modules\admin\Module::class,
        'pages' => common\modules\pages\modules\admin\Module::class,
        'settings' => common\modules\settings\modules\admin\Module::class,
        'translation' => common\modules\translation\modules\admin\Module::class,
        'file' => common\modules\file\modules\admin\Module::class,
        'gallery' => common\modules\gallery\modules\admin\Module::class,
        'partner' => common\modules\partner\modules\admin\Module::class,
        'restaurant' => common\modules\restaurant\modules\admin\Module::class,
        'region' => common\modules\region\modules\admin\Module::class,
        'food' => common\modules\food\modules\admin\Module::class,
        'event' => common\modules\event\modules\admin\Module::class,

    ],
    'on beforeAction' => function () {
        common\modules\langs\components\Lang::onRequestHandler();

        if (\Yii::$app->request->url != '/site/login' && \Yii::$app->user->isGuest) {
            \Yii::$app->response->redirect(['site/login']);
        }
    },
    'params' => $params,
];
