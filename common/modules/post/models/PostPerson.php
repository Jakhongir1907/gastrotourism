<?php

namespace common\modules\post\models;

use common\modules\person\models\Person;
use Yii;
use yii\db\ActiveRecord;

class PostPerson extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_person';
    }

    public function rules()
    {
        return [
            [['post_id', 'person_id'], 'required'],
            [['post_id', 'person_id'], 'integer'],
            [['person_id'], 'exist', 'skipOnError' => true, 'targetClass' => Person::className(), 'targetAttribute' => ['person_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'person_id' => Yii::t('app', 'Person ID'),
        ];
    }
    public function getPerson()
    {
        return $this->hasOne(person::className(), ['id' => 'person_id']);
    }
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
