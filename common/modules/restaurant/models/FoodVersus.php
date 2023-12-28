<?php

namespace common\modules\restaurant\models;

use common\modules\file\behaviors\FileModelBehavior;
use common\modules\filemanager\behaviors\InputModelBehavior;
use common\modules\langs\components\ModelBehavior;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "food_versus".
 *
 * @property int|null $id
 * @property string|null $first_food_id
 * @property string|null $second_food_id
 * @property int|null $first_likes
 * @property int|null $second_likes
 */
class FoodVersus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_versus';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'lang' => [
                'class' => ModelBehavior::className(),
                'fill' => [
//                    'top' => '',

                ],
            ],
            'input_filemanager' => [
                'class' => InputModelBehavior::className(),
            ],

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_likes', 'second_likes'], 'integer'],
            [['first_food_id', 'second_food_id'], 'string', 'max' => 255],
            [['first_likes', 'second_likes'], 'default', 'value' => 0],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_food_id' => 'First Food ID',
            'second_food_id' => 'Second Food ID',
            'first_likes' => 'First Likes',
            'second_likes' => 'Second Likes',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\FoodVersusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\FoodVersusQuery(get_called_class());
    }

    public function getFirstFood() {
        return $this->hasOne(Food::class, ['id' => 'first_food_id']);
    }

    public function getSecondFood() {
        return $this->hasOne(Food::class, ['id' => 'second_food_id']);
    }
}
