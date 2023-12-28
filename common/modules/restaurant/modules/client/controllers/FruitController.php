<?php

namespace common\modules\restaurant\modules\client\controllers;

use common\modules\restaurant\models\Food;
use common\modules\restaurant\models\Fruit;
use common\modules\restaurant\models\Region;
use common\modules\restaurant\models\search\FoodSearch;
use common\modules\restaurant\models\search\FruitSearch;
use Yii;
use common\modules\restaurant\models\Restaurant;
use common\modules\restaurant\models\search\RestaurantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class FruitController extends Controller
{
    /**
     * Lists all Food models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FruitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->lang();
        $dataProvider->pagination->pageSize = 100;

        return $this->render('@common/modules/restaurant/modules/client/views/fruit/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Restaurant model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionShow($id)
    {
        $model = Fruit::find()->where(['id' => $id])->one();

        if (!$model instanceof Fruit) {
            throw new NotFoundHttpException('Fruit not found');
        }

        $fruit_query = Fruit::find()->where(['lang_hash' => $model->lang_hash]);
        $fruit_query->lang();

        $fruit = $fruit_query->one();

        return $this->render('@common/modules/restaurant/modules/client/views/fruit/view', [
            'model' => $fruit,
        ]);
    }

    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Fruit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Fruit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
