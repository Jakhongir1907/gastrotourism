<?php

namespace common\modules\restaurant\models;

use common\modules\filemanager\models\Files;
use Yii;

/**
 * This is the model class for table "food_vs_second_food_flag".
 *
 * @property int|null $food_vs_id
 * @property int|null $file_id
 * @property int|null $sort
 *
 * @property Files $file
 * @property FoodVs $foodVs
 */
class FoodVsSecondFoodFlag extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_vs_second_food_flag';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['food_vs_id', 'file_id', 'sort'], 'integer'],
            [['file_id'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['file_id' => 'file_id']],
            [['food_vs_id'], 'exist', 'skipOnError' => true, 'targetClass' => FoodVs::className(), 'targetAttribute' => ['food_vs_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'food_vs_id' => 'Food Vs ID',
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
     * Gets query for [[FoodVs]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\FoodVsQuery
     */
    public function getFoodVs()
    {
        return $this->hasOne(FoodVs::className(), ['id' => 'food_vs_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\FoodVsSecondFoodFlagQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\FoodVsSecondFoodFlagQuery(get_called_class());
    }
}
