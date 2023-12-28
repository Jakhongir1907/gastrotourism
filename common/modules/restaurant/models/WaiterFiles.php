<?php

namespace common\modules\restaurant\models;

use Yii;

/**
 * This is the model class for table "waiter_files".
 *
 * @property int|null $waiter_id
 * @property int|null $file_id
 * @property int|null $sort
 *
 * @property Files $file
 * @property Waiter $waiter
 */
class WaiterFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'waiter_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['waiter_id', 'file_id', 'sort'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'file_id']],
            [['waiter_id'], 'exist', 'skipOnError' => true, 'targetClass' => Waiter::className(), 'targetAttribute' => ['waiter_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'waiter_id' => 'Waiter ID',
            'file_id' => 'File ID',
            'sort' => 'Sort',
        ];
    }

    /**
     * Gets query for [[File]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\FilesQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['file_id' => 'file_id']);
    }

    /**
     * Gets query for [[Waiter]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\WaiterQuery
     */
    public function getWaiter()
    {
        return $this->hasOne(Waiter::className(), ['id' => 'waiter_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\WaiterFilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\WaiterFilesQuery(get_called_class());
    }
}
