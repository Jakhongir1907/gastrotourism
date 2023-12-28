<?php

namespace common\modules\post\models;

use Yii;
use yii\db\ActiveRecord;
use common\modules\tag\models\Tag;

class PostTags extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_tags';
    }

    public function rules()
    {
        return [
            [['post_id', 'tag_id'], 'required'],
            [['post_id', 'tag_id'], 'integer'],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'tag_id' => Yii::t('app', 'Tag ID'),
        ];
    }
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
}
