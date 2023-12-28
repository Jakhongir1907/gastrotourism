<?php
/**
 * Created by PhpStorm.
 * User: utkir
 * Date: 30.08.2018
 * Time: 12:21
 */

namespace common\modules\post\actions\comment;

use common\modules\post\actions\CommentAction;
use common\modules\post\models\Post;
use yii\base\Action;
use Yii;
use common\modules\comment\models\Comment;
class DeleteAction extends CommentAction
{
    public function run()
    {
        if(Yii::$app->request->isAjax){
            $post = Yii::$app->request->post();
            $comment = Comment::findOne($post['id']);
            if($comment){
                $model = Post::findOne((integer)$post['model_id']);
                if($model) {
                    $model->unlink('comments', $comment,true);
                    $comment->delete();
                   return  $this->returnSuccess();
                }
            }
        }
       return $this->returnError();
    }
}