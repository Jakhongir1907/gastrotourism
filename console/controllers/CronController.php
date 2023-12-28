<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 * @package gastrotourism.uz
 */

namespace console\controllers;


use common\modules\event\models\EventAttender;
use yii\console\Controller;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class CronController extends Controller {

    public function actionSendLink() {
        $attenders = EventAttender::find()
            ->where(['event_id' => 2])
            ->andWhere(["<>", "email", ""])
            ->all();

        $emails = ArrayHelper::map($attenders, 'id', 'email');

        \Yii::$app->mailer->compose('event-link')
            ->setFrom('info@gastrotourism.uz')
            ->setTo($emails)
            ->setSubject("Gastronomic tourism Association of Uzbekistan")
            ->send();

    }

}