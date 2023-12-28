<?php

namespace common\modules\gallery\modules\client\controllers;

use Yii;
use common\modules\gallery\models\Gallery;
use common\modules\gallery\models\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller
{

    public function actionIndex($type = "photo") {

        $gallerySearch = new GallerySearch();
        $dataProvider = $gallerySearch->search(\Yii::$app->request->get());

        if ($type == 'photo') $tip = Gallery::TYPE_PHOTO;
        if ($type == 'video') $tip = Gallery::TYPE_VIDEO;

        $dataProvider->query->andWhere(['type' => $tip])->lang();

        return $this->render('@common/modules/gallery/modules/client/views/gallery/index', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionShow($slug) {

        $gallery = Gallery::find()->slug($slug)->one();

        return $this->render('@common/modules/gallery/modules/client/views/gallery/show', [
            'model' => $gallery
        ]);
    }

}
