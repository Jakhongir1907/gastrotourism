<?php

namespace common\modules\post\modules\admin\controllers;

use common\modules\gallery\models\Gallery;
use common\modules\tag\models\Tag;
use Yii;
use common\modules\post\models\Post;
use common\modules\post\models\PostSearch;
use yii\rest\OptionsAction;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * Class PostController
 * @package common\modules\post\modules\admin\controllers
 */
class PostController extends \yii\web\Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @return string
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionIndex()
    {

        if(Yii::$app->request->post())
		{
            $items = Yii::$app->request->post()['rm-input'];
            $items = explode(',', $items);

            for($i = 0; $i < count($items) - 1;$i++)
			{
                if($items[$i] != null)
                    Post::findOne($items[$i])->delete();
            }
        }

        $searchModel = new PostSearch();
        $searchModel->setScenario(Post::SCENARIO_BACKEND);
        $searchModel->detachBehavior('date_publish_date');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        if (\Yii::$app->user->identity->isBlogger()) {
//            $dataProvider->query->where(['or', ['author' => \Yii::$app->user->identity->getId()], ['blogger' => \Yii::$app->user->identity->getId()]]);
//        }
//
        $dataProvider->query->orderBy(['id' => SORT_DESC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save())
		{
//		    $gallery = new Gallery();
//		    $gallery->load(Yii::$app->request->post());
//		    $gallery->save();

            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);

        }
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

//        if (\Yii::$app->user->identity->isBlogger() && $model->status == Post::STATUS_ACTIVE) {
//            return $this->redirect(['index']);
//        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
//        if (\Yii::$app->user->identity->isBlogger() && $model->status == Post::STATUS_ACTIVE) {
//            return $this->redirect(['index']);
//        }

        $model->delete();

//        $model->updateAttributes(['status' => Post::STATUS_DEACTIVE]);

        return $this->redirect(\Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return Post|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null)
		{
            return $model;

        } else {

            throw new NotFoundHttpException('The requested page does not exist.');

        }
    }
    public function actions(){
        return [
            'getdata' => [
                'class' => 'jakharbek\datamanager\actions\Action'
            ],
        ];
    }

    public function actionModeration() {
        if(Yii::$app->request->post())
        {
            $items = Yii::$app->request->post()['rm-input'];
            $items = explode(',', $items);

            for($i = 0; $i < count($items) - 1;$i++)
            {
                if($items[$i] != null)
                    Post::findOne($items[$i])->delete();
            }
        }

        $searchModel = new PostSearch(['scenario' => Post::SCENARIO_BACKEND]);
        $searchModel->detachBehavior('date_publish_date');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->where(['status' => Post::STATUS_PENDING]);
        $dataProvider->query->orderBy(['id' => SORT_DESC]);

        return $this->render('moderation', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAccept($id) {
        $this->findModel($id)->updateAttributes(['status'=> Post::STATUS_ACTIVE]);
        return $this->redirect(\Yii::$app->request->referrer);
    }


}
