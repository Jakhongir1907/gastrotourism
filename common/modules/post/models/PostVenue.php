<?php

namespace common\modules\post\models;

use common\modules\venue\models\Venue;
use Yii;
use yii\db\ActiveRecord;

class PostVenue extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_venue';
    }

    public function rules()
    {
        return [
            [['post_id', 'venue_id'], 'required'],
            [['post_id', 'venue_id'], 'integer'],
            [['venue_id'], 'exist', 'skipOnError' => true, 'targetClass' => Venue::className(), 'targetAttribute' => ['venue_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'venue_id' => Yii::t('app', 'venue ID'),
        ];
    }
    public function getVenue()
    {
        return $this->hasOne(Venue::className(), ['id' => 'venue_id']);
    }
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
