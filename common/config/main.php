<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ru',
    'components' => [
        'view' => [
            'class' => \common\components\View::class,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => getenv( 'DB_DSN' ),
            'username' => getenv( 'DB_USERNAME' ),
            'password' => getenv( 'DB_PASSWORD' ),
            'charset' => getenv( 'DB_CHARSET' ),
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'mail.gastrotourism.uz',
                'username' => 'info@gastrotourism.uz',
                'password' => 'xjaloladdin',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],
        'i18n' => [
            'translations' => [
                'main' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'forceTranslation' => true,
                    'enableCaching' => true,
                    'cachingDuration' => 3600,
                    'sourceLanguage' => 'en-US',
                    'sourceMessageTable' => 'source_message',
                    'messageTable' => 'message',
                    'on missingTranslation' => [
                        'common\modules\translation\components\EventHandlers',
                        'handleMissingTranslation',
                    ],
                ],
            ],
        ],
    ],
    'modules' => [
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
        ],

        'menu' => [
            'class' => \common\modules\menu\modules\admin\Module::class
        ],
    ]
];
