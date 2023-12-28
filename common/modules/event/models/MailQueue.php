<?php

namespace common\modules\event\models;

use Yii;

/**
 * This is the model class for table "mail_queue".
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $subject
 * @property string|null $body
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $send_at
 */
class MailQueue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mail_queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['status', 'created_at', 'send_at'], 'integer'],
            [['email', 'subject'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'subject' => 'Subject',
            'body' => 'Body',
            'status' => 'Status',
            'created_at' => 'Created At',
            'send_at' => 'Send At',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\event\models\query\MailQueueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\event\models\query\MailQueueQuery(get_called_class());
    }
}
