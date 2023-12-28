<?php

namespace common\modules\post\modules\api;

/**
 * post module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\post\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init() {
        parent::init();

        \Yii::configure(\Yii::$app, [
            'components' => [
                'response' => [
                    'class'     => \yii\web\Response::className(),
                    'format'    => \yii\web\Response::FORMAT_JSON,
                    'charset' => 'UTF-8',
                ],
            ]
        ]);
    }
}
