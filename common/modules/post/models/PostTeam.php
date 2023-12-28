<?php

namespace common\modules\post\models;

use common\modules\team\models\Team;
use Yii;
use yii\db\ActiveRecord;

class PostTeam extends ActiveRecord
{
    public static function tableName()
    {
        return 'post_team';
    }

    public function rules()
    {
        return [
            [['post_id', 'team_id'], 'required'],
            [['post_id', 'team_id'], 'integer'],
            [['team_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['team_id' => 'id']],
            [['post_id'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['post_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'post_id' => Yii::t('app', 'Post ID'),
            'team_id' => Yii::t('app', 'Team ID'),
        ];
    }
    public function getTeam()
    {
        return $this->hasOne(Team::className(), ['id' => 'team_id']);
    }
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id' => 'post_id']);
    }
}
