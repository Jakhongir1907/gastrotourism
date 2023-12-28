<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'controllerMap' => [
        'post' => \common\modules\post\modules\client\controllers\PostController::class,
        'restaurant' => \common\modules\restaurant\modules\client\controllers\RestaurantController::class,
        'food' => \common\modules\restaurant\modules\client\controllers\FoodController::class,
        'fruit' => \common\modules\restaurant\modules\client\controllers\FruitController::class,
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'class' => \codemix\localeurls\UrlManager::class,
            'languages' => ['uz', 'ru', 'en'],
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'GET post/category/<slug:[0-9A-Za-z\_\-]+>' => 'post/category',
                'GET festival/index' => 'post/festivals',
                'GET blog/index' => 'post/blogs',
                'GET post/tag/<name:\S+>' => 'post/tag',
                'GET post/article/<slug:[0-9A-Za-z\_\-]+>' => 'post/article',
                'GET gallery/<type:(photo|video)>' => 'gallery/index',
                'GET gallery/show/<slug:[0-9A-Za-z\_\-]+>' => 'gallery/show',

                'GET post/article/print/<slug:[0-9A-Za-z\_\-]+>' => 'post/print',

                'GET menu/print/<slug:[0-9A-Za-z\_\-]+>' => 'menu/default/print',
                'GET menu/<slug:[0-9A-Za-z\_\-]+>' => 'menu/default/view',

                'GET restaurant/top' => 'restaurant/top',
                'GET restaurant/region/<slug:[0-9A-Za-z\_\-]+>' => 'restaurant/region',
                'GET restaurant/show/<slug:[0-9A-Za-z\_\-]+>/<food_type_slug:[0-9A-Za-z\_\-]+>' => 'restaurant/foods',
                'GET restaurant/show/<slug:[0-9A-Za-z\_\-]+>' => 'restaurant/show',

                'GET food/show/<id:\d+>' => 'food/show',
                'GET food/show/<slug:[0-9A-Za-z\_\-]+>' => 'food/show',

                'GET fruit/show/<id:\d+>' => 'fruit/show',
                'GET fruit/show/<slug:[0-9A-Za-z\_\-]+>' => 'fruit/show',

                'events/attend/<id:\d+>' => 'events/attend',
            ],

            'ignoreLanguageUrlPatterns' => [
                '#restaurant/vote#' => '#restaurant/vote#',
                '#site/vote#' => '#site/vote#',
                '#^api/#' => '#^api/#',
            ],
        ],
    ],
    'modules' => [
        'post' => common\modules\post\modules\client\Module::class,
        'restaurant' => common\modules\restaurant\modules\client\Module::class,
        'menu' => \common\modules\pages\modules\client\Module::class,
    ],
    'params' => $params,
];
