<?php
namespace backend\controllers;

use common\models\Requests;
use common\models\UserUpdateForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $requests = Requests::find()->orderBy(['id' => SORT_DESC])->limit(20)->all();

        return $this->render('index', ['requests' => $requests]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {

        $this->layout = 'empty';

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionProfile() {

        $model = new UserUpdateForm();

        if (\Yii::$app->request->isPost && $model->load(\Yii::$app->request->post())) {
            if($model->save()) \Yii::$app->session->setFlash('success', ['Password successfully updated']);
        }

        return $this->render('profile', ['model' => $model, 'journal' => []]);
    }
}
