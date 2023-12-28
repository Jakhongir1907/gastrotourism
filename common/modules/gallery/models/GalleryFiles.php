<?php

namespace common\modules\gallery\models;

use common\modules\filemanager\models\Files;
use Yii;

/**
 * This is the model class for table "gallery_files".
 *
 * @property int $gallery_id
 * @property int $file_id
 * @property int $sort
 *
 * @property Files $file
 * @property Gallery $gallery
 */
class GalleryFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['gallery_id', 'file_id', 'sort'], 'default', 'value' => null],
            [['gallery_id', 'file_id', 'sort'], 'integer'],
            [['title', 'description'], 'string'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'file_id']],
            [['gallery_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gallery::className(), 'targetAttribute' => ['gallery_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'gallery_id' => 'Gallery ID',
            'file_id' => 'File ID',
            'sort' => 'Sort',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(Files::className(), ['file_id' => 'file_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGallery()
    {
        return $this->hasOne(Gallery::className(), ['id' => 'gallery_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\gallery\query\GalleryFilesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\gallery\query\GalleryFilesQuery(get_called_class());
    }
}
