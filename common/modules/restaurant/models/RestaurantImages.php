<?php

namespace common\modules\restaurant\models;

use Yii;

/**
 * This is the model class for table "restaurant_images".
 *
 * @property int|null $restaurant_id
 * @property int|null $file_id
 * @property int|null $sort
 *
 * @property Files $file
 * @property Restaurant $restaurant
 */
class RestaurantImages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurant_images';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'file_id', 'sort'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'file_id']],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['restaurant_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'restaurant_id' => 'Restaurant ID',
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
     * Gets query for [[Restaurant]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\RestaurantQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['id' => 'restaurant_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\RestaurantImagesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\RestaurantImagesQuery(get_called_class());
    }
}
