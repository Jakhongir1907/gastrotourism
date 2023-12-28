<?php
/**
 * Created by PhpStorm.
 * User: utkir
 * Date: 28.08.2018
 * Time: 14:23
 */

namespace common\modules\post\modules\admin\controllers;


use common\modules\fixture\models\Fixture;
use common\modules\fixture\models\FixtureSearch;
use common\modules\post\modules\admin\controllers\PostController;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;
class CommentController extends PostController
{
    public function actions()
    {
        return [
            'add-action' => 'common\modules\post\actions\comment\AddAction',
            'like-action' => 'common\modules\comment\actions\LikeAction',
            'delete-action' => 'common\modules\post\actions\comment\DeleteAction',
            'status-action' => 'common\modules\comment\actions\StatusAction',
        ];
    }

}
