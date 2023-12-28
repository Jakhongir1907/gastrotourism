<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 * @package gastrotourism.uz
 */

namespace frontend\controllers;


use common\modules\event\models\EventAttender;
use common\modules\event\models\EventRegistration;
use yii\web\Controller;

class EventsController extends Controller {

    public function actionRegistration() {
        $model = new EventRegistration();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            return $this->refresh();
        } else {
            return $this->render('registration', [
                'model' => $model,
            ]);
        }
    }

    public function actionAttend($id) {
        $model = new EventAttender();
        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())) {
            $model->event_id = $id;
            if ($model->save()) {
                \Yii::$app->mailer->compose('event-congrats', ['event' => $model->event, 'attender' => $model])
                    ->setFrom('info@gastrotourism.uz')
                    ->setTo($model->email)
                    ->setSubject("Gastronomic tourism Association of Uzbekistan")
                    ->send();
                return $this->refresh();
            }
        }

        return $this->render('attend', [
            'model' => $model
        ]);
    }

}