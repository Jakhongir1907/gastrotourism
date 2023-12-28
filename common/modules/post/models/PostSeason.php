<?php

namespace common\modules\post\models;

use common\modules\season\models\Season;
use Yii;
use yii\db\ActiveRecord;

class PostSeason extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_season';
    }

    public function rules()
    {
        return [
            [['post_id', 'season_id'], 'required'],
            [['post_id', 'season_id'], 'integer'],
            [['season_id'], 'exist', 'skipOnError' => true, 'targetClass' => season::className(), 'targetAttribute' => ['season_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'season_id' => Yii::t('app', 'Season ID'),
        ];
    }
    public function getSeason()
    {
        return $this->hasOne(Season::className(), ['id' => 'season_id']);
    }
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
