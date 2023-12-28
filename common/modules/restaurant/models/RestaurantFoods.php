<?php

namespace common\modules\restaurant\models;

use Yii;

/**
 * This is the model class for table "restaurant_foods".
 *
 * @property int|null $restaurant_id
 * @property int|null $food_id
 * @property int $top
 *
 * @property Food $food
 * @property Restaurant $restaurant
 */
class RestaurantFoods extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurant_foods';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'food_id', 'top'], 'integer'],
            [['food_id'], 'exist', 'skipOnError' => true, 'targetClass' => Food::className(), 'targetAttribute' => ['food_id' => 'id']],
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
            'food_id' => 'Food ID',
            'top' => 'Top',
        ];
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
     * @return \common\modules\restaurant\models\query\RestaurantFoodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\RestaurantFoodsQuery(get_called_class());
    }
}
