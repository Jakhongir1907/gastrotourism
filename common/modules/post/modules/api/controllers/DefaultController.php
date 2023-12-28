<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 */

namespace common\modules\post\modules\api\controllers;

use common\components\ApiController;
use common\modules\categories\models\Categories;
use common\modules\post\models\Post;
use common\modules\post\models\PostSearch;
use yii\filters\ContentNegotiator;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class DefaultController extends ApiController {

    /**
     * @return array|bool
     * отключаем index,view екшны что бы заработали наши
     */
    public function actions() {
        return false;
    }

    /**
     * @return \yii\data\ActiveDataProvider
     */
    public function actionIndex() {
        $postSearch = new PostSearch();
        $postSearch->status = 1;
        $dataProvider = $postSearch->search(\Yii::$app->request->queryParams);
        return $dataProvider;
    }

    /**
     * @param $slug
     * @return array|null|\yii\db\ActiveRecord
     * @throws NotFoundHttpException
     */
    public function actionView($slug) {
        $model = Post::find()->slug($slug);
        if($model->count() == 0) {
            throw new NotFoundHttpException('Post not found');
        }

        $post = $model->one();
        $post->updateCounters(['viewed' => 1]);

        return $post;
    }

    /**
     * @param $slug
     * @return \yii\data\ActiveDataProvider
     * @throws NotFoundHttpException
     */
    public function actionCategory($slug) {
        $postSearch = new PostSearch();
        $query = Categories::find()->where(['slug' => $slug]);

        if($query->count() == 0) {
            throw new NotFoundHttpException('Category not found');
        }

        $category = $query->one();
        $postSearch->category = $category->id;
        $dataProvider = $postSearch->search(\Yii::$app->request->queryParams);

        return $dataProvider;

    }

}