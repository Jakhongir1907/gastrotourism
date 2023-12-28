<?php

namespace common\modules\event\models;

use Yii;

/**
 * This is the model class for table "event_attender".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property int|null $event_id
 *
 * @property Event $event
 */
class EventAttender extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_attender';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['event_id'], 'integer'],
            [['name', 'email', 'country'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => Event::className(), 'targetAttribute' => ['event_id' => 'id']],
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
            'email' => 'Email',
            'event_id' => 'Event ID',
        ];
    }

    /**
     * Gets query for [[Event]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\event\models\query\EventQuery
     */
    public function getEvent()
    {
        return $this->hasOne(Event::className(), ['id' => 'event_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\event\models\query\EventAttenderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\event\models\query\EventAttenderQuery(get_called_class());
    }
}
