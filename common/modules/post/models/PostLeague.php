<?php

namespace common\modules\post\models;

use common\modules\league\models\League;
use Yii;
use yii\db\ActiveRecord;

class PostLeague extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_league';
    }

    public function rules()
    {
        return [
            [['post_id', 'league_id'], 'required'],
            [['post_id', 'league_id'], 'integer'],
            [['league_id'], 'exist', 'skipOnError' => true, 'targetClass' => League::className(), 'targetAttribute' => ['league_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'league_id' => Yii::t('app', 'League ID'),
        ];
    }
    public function getLeague()
    {
        return $this->hasOne(League::className(), ['id' => 'league_id']);
    }
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
