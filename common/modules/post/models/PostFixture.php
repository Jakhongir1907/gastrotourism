<?php

namespace common\modules\post\models;

use common\modules\fixture\models\Fixture;
use Yii;
use yii\db\ActiveRecord;

class PostFixture extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_fixture';
    }

    public function rules()
    {
        return [
            [['post_id', 'fixture_id'], 'required'],
            [['post_id', 'fixture_id'], 'integer'],
            [['fixture_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fixture::className(), 'targetAttribute' => ['fixture_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'fixture_id' => Yii::t('app', 'Fixture ID'),
        ];
    }
    public function getFixture()
    {
        return $this->hasOne(Fixture::className(), ['id' => 'fixture_id']);
    }
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
