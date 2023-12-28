<?php

namespace common\modules\restaurant\models;

use common\modules\file\behaviors\FileModelBehavior;
use common\modules\filemanager\behaviors\InputModelBehavior;
use common\modules\filemanager\models\Files;
use common\modules\langs\components\ModelBehavior;
use common\modules\langs\models\Langs;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "food_vs".
 *
 * @property int $id
 * @property string|null $first_food_name
 * @property string|null $second_food_name
 * @property string|null $first_food_description
 * @property string|null $second_food_description
 * @property string|null $first_food_picture
 * @property string|null $second_food_picture
 * @property string|null $first_food_flag
 * @property string|null $second_food_flag
 * @property int|null $first_likes
 * @property int|null $second_likes
 * @property int|null $lang
 * @property string $lang_hash
 *
 * @property Langs $lang0
 * @property FoodVsFirstFoodFlag[] $foodVsFirstFoodFlags
 * @property FoodVsFirstFoodImage[] $foodVsFirstFoodImages
 * @property FoodVsSecondFoodFlag[] $foodVsSecondFoodFlags
 * @property FoodVsSecondFoodImage[] $foodVsSecondFoodImages
 */
class FoodVs extends \yii\db\ActiveRecord
{

    public $_firstimagedata;
    public $_secondimagedata;
    public $_firstflagdata;
    public $_secondflagdata;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food_vs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_food_description', 'second_food_description'], 'string'],
            [['first_likes', 'second_likes', 'lang'], 'integer'],
            [['title', 'first_food_name', 'second_food_name', 'lang_hash'], 'string', 'max' => 255],
            [['lang'], 'exist', 'skipOnError' => true, 'targetClass' => Langs::className(), 'targetAttribute' => ['lang' => 'lang_id']],
            [['first_likes', 'second_likes'], 'default', 'value' => 0],
            [['firstimagedata', 'firstflagdata','secondimagedata', 'secondflagdata',], 'safe']
        ];
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'lang' => [
                'class' => ModelBehavior::className(),
                'fill' => [
//                    'top' => '',
                ],
            ],
            'first_food_image' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'firstimagedata',
                'relation_name' => 'foodVsFirstFoodImageFiles',
                'delimitr' => ',',
                'via_table_name' => 'food_vs_first_food_image',
                'via_table_relation' => 'foodVsFirstFoodImageFiles',
                'one_table_column' => 'food_vs_id',
                'two_table_column' => 'file_id'
            ],

            'first_food_flag' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'firstflagdata',
                'relation_name' => 'foodVsFirstFoodFlagFiles',
                'delimitr' => ',',
                'via_table_name' => 'food_vs_first_food_flag',
                'via_table_relation' => 'foodVsFirstFoodFlagFiles',
                'one_table_column' => 'food_vs_id',
                'two_table_column' => 'file_id'
            ],

            'second_food_image' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'secondimagedata',
                'relation_name' => 'foodVsSecondFoodImageFiles',
                'delimitr' => ',',
                'via_table_name' => 'food_vs_second_food_image',
                'via_table_relation' => 'foodVsSecondFoodImageFiles',
                'one_table_column' => 'food_vs_id',
                'two_table_column' => 'file_id'
            ],

            'second_food_flag' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'secondflagdata',
                'relation_name' => 'foodVsSecondFoodFlagFiles',
                'delimitr' => ',',
                'via_table_name' => 'food_vs_second_food_flag',
                'via_table_relation' => 'foodVsSecondFoodFlagFiles',
                'one_table_column' => 'food_vs_id',
                'two_table_column' => 'file_id'
            ],

        ]);

    }

    public function setFirstimagedata($value) {
        $this->_firstimagedata = $value;
    }

    public function getFirstimagedata() {
        return $this->_firstimagedata;
    }

    public function setFirstflagdata($value) {
        $this->_firstflagdata = $value;
    }

    public function getFirstflagdata() {
        return $this->_firstflagdata;
    }

    public function setSecondimagedata($value) {
        $this->_secondimagedata = $value;
    }

    public function getSecondimagedata() {
        return $this->_secondimagedata;
    }

    public function setSecondflagdata($value) {
        $this->_secondflagdata = $value;
    }

    public function getSecondflagdata() {
        return $this->_secondflagdata;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_food_name' => 'First Food Name',
            'second_food_name' => 'Second Food Name',
            'first_food_description' => 'First Food Description',
            'second_food_description' => 'Second Food Description',
            'first_food_picture' => 'First Food Picture',
            'second_food_picture' => 'Second Food Picture',
            'first_food_flag' => 'First Food Flag',
            'second_food_flag' => 'Second Food Flag',
            'first_likes' => 'First Likes',
            'second_likes' => 'Second Likes',
            'lang' => 'Lang',
            'lang_hash' => 'Lang Hash',
        ];
    }

    /**
     * Gets query for [[Lang0]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\LangsQuery
     */
    public function getLang0()
    {
        return $this->hasOne(Langs::className(), ['lang_id' => 'lang']);
    }

    /**
     * Gets query for [[FoodVsFirstFoodFlags]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\FoodVsFirstFoodFlagQuery
     */
    public function getFoodVsFirstFoodFlag()
    {
        return $this->hasMany(FoodVsFirstFoodFlag::className(), ['food_vs_id' => 'id']);
    }

    /**
     * Gets query for [[FoodVsFirstFoodFlags]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\FoodVsFirstFoodFlagQuery
     */
    public function getFoodVsFirstFoodFlagFiles()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->via('foodVsFirstFoodFlag');
    }

    /**
     * Gets query for [[FoodVsFirstFoodImages]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\FoodVsFirstFoodImageQuery
     */
    public function getFoodVsFirstFoodImage()
    {
        return $this->hasMany(FoodVsFirstFoodImage::className(), ['food_vs_id' => 'id']);
    }

    public function getFoodVsFirstFoodImageFiles()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->via('foodVsFirstFoodImage');
    }

    /**
     * Gets query for [[FoodVsSecondFoodFlags]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\FoodVsSecondFoodFlagQuery
     */
    public function getFoodVsSecondFoodFlag()
    {
        return $this->hasMany(FoodVsSecondFoodFlag::className(), ['food_vs_id' => 'id']);
    }

    public function getFoodVsSecondFoodFlagFiles()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->via('foodVsSecondFoodFlag');
    }

    /**
     * Gets query for [[FoodVsSecondFoodImages]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\FoodVsSecondFoodImageQuery
     */
    public function getFoodVsSecondFoodImage()
    {
        return $this->hasMany(FoodVsSecondFoodImage::className(), ['food_vs_id' => 'id']);
    }

    public function getFoodVsSecondFoodImageFiles()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->via('foodVsSecondFoodImage');
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\FoodVsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\FoodVsQuery(get_called_class());
    }
}
