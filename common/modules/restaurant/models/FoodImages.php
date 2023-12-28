<?php

namespace common\modules\restaurant\models;

use common\modules\filemanager\models\Files;
use Yii;

/**
 * This is the model class for table "food_images".
 *
 * @property int|null $food_id
 * @property int|null $file_id
 * @property int|null $sort
 *
 * @property Files $file
 * @property Food $food
 */
class FoodImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_id', 'file_id', 'sort'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'file_id']],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'food_id' => 'Food ID',
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
     * Gets query for [[Food]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\FoodQuery
     */
    public function getFood()
    {
        return $this->hasOne(Food::className(), ['id' => 'food_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\FoodImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\FoodImagesQuery(get_called_class());
    }
}
