<?php

namespace common\modules\post\models;

use common\modules\comment\models\Comment;
use Yii;

class PostComments extends \common\components\Model
{
    public static function tableName()
    {
        return 'post_comments';
    }

    public function rules()
    {
        return [
            [['post_id', 'comment_id'], 'required'],
            [['post_id', 'comment_id'], 'integer'],
            [['comment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['comment_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'comment_id' => Yii::t('app', 'Comment ID'),
        ];
    }
    public function getComment()
    {
        return $this->hasOne(Comment::className(), ['id' => 'comment_id']);
    }
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
