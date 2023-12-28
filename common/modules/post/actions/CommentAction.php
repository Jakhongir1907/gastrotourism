<?php
/**
 * Created by PhpStorm.
 * User: utkir
 * Date: 30.08.2018
 * Time: 13:27
 */

namespace common\modules\post\actions;


use yii\base\Action;

class CommentAction extends Action
{
    public function returnSuccess()
    {
        return $this->controller->asJson(['success' => true]);
    }

    public function returnError()
    {
        return $this->controller->asJson(['success' => false]);
    }

}