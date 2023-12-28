<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "requests".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $subject
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $body
 */
class Requests extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['name', 'subject', 'email', 'phone'], 'string', 'max' => 255],
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
            'subject' => 'Subject',
            'email' => 'Email',
            'phone' => 'Phone',
            'body' => 'Body',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\RequestsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\RequestsQuery(get_called_class());
    }
}
