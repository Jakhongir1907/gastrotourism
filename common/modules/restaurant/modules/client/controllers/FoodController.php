<?php

namespace common\modules\restaurant\modules\client\controllers;

use common\modules\restaurant\models\Food;
use common\modules\restaurant\models\Region;
use common\modules\restaurant\models\search\FoodSearch;
use Yii;
use common\modules\restaurant\models\Restaurant;
use common\modules\restaurant\models\search\RestaurantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class FoodController extends Controller
{
    /**
     * Lists all Food models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FoodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['top' => 1])->limit(10)->lang();

        return $this->render('@common/modules/restaurant/modules/client/views/food/index', [
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
        $model = Food::find()->where(['id' => $id])->one();

        if (!$model instanceof Food) {
            throw new NotFoundHttpException('Food not found');
        }

        $food_query = Food::find()->where(['lang_hash' => $model->lang_hash]);
        $food_query->lang();

        $food = $food_query->one();
        $restaurants = $food->restaurants;

        return $this->render('@common/modules/restaurant/modules/client/views/food/view', [
            'model' => $food,
            'restaurants' => $restaurants,
        ]);
    }

    /**
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Food the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Food::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
