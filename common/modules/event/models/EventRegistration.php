<?php

namespace common\modules\event\models;

use Yii;

/**
 * This is the model class for table "event_registration".
 *
 * @property int $id
 * @property string|null $fullname
 * @property string|null $birth_date
 * @property string|null $address
 * @property int|null $experience
 * @property string|null $work
 * @property string|null $position
 * @property string|null $phone_number
 * @property string|null $telegram_number
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $status
 */
class EventRegistration extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'event_registration';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['experience', 'created_at', 'updated_at', 'status'], 'integer'],
            [['fullname', 'birth_date', 'address', 'work', 'position', 'phone_number', 'telegram_number'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'birth_date' => 'Birth Date',
            'address' => 'Address',
            'experience' => 'Experience',
            'work' => 'Work',
            'position' => 'Position',
            'phone_number' => 'Phone Number',
            'telegram_number' => 'Telegram Number',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\event\models\query\EventRegistrationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\event\models\query\EventRegistrationQuery(get_called_class());
    }
}
