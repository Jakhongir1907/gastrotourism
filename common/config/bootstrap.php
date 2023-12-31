<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@static', dirname(dirname(__DIR__)) . '/static');
Yii::setAlias('@staticUrl', getenv("STATIC_URL"));

function __($message, $params = array())
{
    return Yii::t('main', $message, $params, Yii::$app->language);
}