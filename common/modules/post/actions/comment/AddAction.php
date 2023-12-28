<?php

namespace common\modules\post\actions\comment;


use common\modules\post\actions\CommentAction;
use common\modules\post\models\Post;
use yii\base\Action;
use Yii;
use common\modules\comment\models\Comment;
class AddAction extends CommentAction
{
    public function run()
    {
        if (Yii::$app->request->isAjax) {
            $post = Yii::$app->request->post();
            $comment = new Comment();
            $comment->description = $post['description'];
            if($post['parent_id'] > 0) {
                $comment->parent_id = $post['parent_id'];
            }
            $comment->user_id = Yii::$app->user->getId();
            $comment->status = Comment::STATUS_ACTIVE;
            if ($comment->save()) {
                $model = Post::findOne($post['model_id']);
                if ($model) {
                    $comment->link('posts', $model);
                    return $this->controller->asJson(['success' => true,'id'=>$comment->getId()]);
                }
            }
        }
        return $this->returnError();
    }


}