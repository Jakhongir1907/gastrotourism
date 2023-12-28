<?php

namespace common\modules\event\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "event".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $start_at
 *
 * @property EventAttender[] $eventAttenders
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'date_filter' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['start_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['start_at'],
                ],
            ],

        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'start_at' => 'Start At',
        ];
    }

    /**
     * Gets query for [[EventAttenders]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\event\models\query\EventAttenderQuery
     */
    public function getEventAttenders()
    {
        return $this->hasMany(EventAttender::className(), ['event_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\event\models\query\EventQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\event\models\query\EventQuery(get_called_class());
    }
}
