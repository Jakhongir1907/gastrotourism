<?php

namespace common\modules\restaurant\models;

use common\modules\filemanager\models\Files;
use Yii;

/**
 * This is the model class for table "fruit_images".
 *
 * @property int|null $fruit_id
 * @property int|null $file_id
 * @property int|null $sort
 *
 * @property Files $file
 * @property Fruit $fruit
 */
class FruitImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fruit_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fruit_id', 'file_id', 'sort'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'file_id']],
            [['fruit_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fruit::className(), 'targetAttribute' => ['fruit_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fruit_id' => 'Fruit ID',
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
     * Gets query for [[Fruit]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\FruitQuery
     */
    public function getFruit()
    {
        return $this->hasOne(Fruit::className(), ['id' => 'fruit_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\FruitImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\FruitImagesQuery(get_called_class());
    }
}
