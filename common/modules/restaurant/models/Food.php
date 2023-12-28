<?php

namespace common\modules\restaurant\models;

use common\behaviors\SlugBehavior;
use common\modules\file\behaviors\FileModelBehavior;
use common\modules\filemanager\behaviors\InputModelBehavior;
use common\modules\filemanager\models\Files;
use common\modules\langs\components\ModelBehavior;
use Yii;
use common\modules\langs\models\Langs;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "food".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $price
 * @property string|null $ingredients
 * @property string|null $cook_steps
 * @property int|null $lang
 * @property int|null $top
 * @property string $lang_hash
 * @property int|null $type
 *
 * @property Langs $lang0
 * @property RestaurantFoods[] $restaurantFoods
 * @property Country $country
 */
class Food extends \yii\db\ActiveRecord
{

    const TYPES = [
        'foods' => 1,
        'salats' => 2,
        'deserts' => 3,
        'drinks' => 4,
        'alcohols' => 5,
    ];

    /**
     * @var
     */
    private $_filesdata;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'food';
    }

    public static function getTypesDropdown()
    {
        return [
            static::TYPES['foods'] => __("Блюды"),
            static::TYPES['salats'] => __("Салаты"),
            static::TYPES['deserts'] => __("Десерты"),
            static::TYPES['drinks'] => __("Напитки"),
            static::TYPES['alcohols'] => __("Алкогольные"),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filesdata'], 'required'],
            [['description', 'ingredients', 'cook_steps'], 'string'],
            [['price', 'lang', 'type', 'top', 'country_id'], 'integer'],
            [['name', 'lang_hash'], 'string', 'max' => 255],
            [['type'], 'default', 'value' => static::TYPES['foods']],
            [['lang'], 'exist', 'skipOnError' => true, 'targetClass' => Langs::className(), 'targetAttribute' => ['lang' => 'lang_id']],
            [['filesdata'], 'safe']
        ];
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'lang' => [
                'class' => ModelBehavior::className(),
                'fill' => [
                    'top' => '',

                ],
            ],
            'file_manager_model' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'filesdata',
                'relation_name' => 'files',
                'delimitr' => ',',
                'via_table_name' => 'food_images',
                'via_table_relation' => 'foodimagefiles',
                'one_table_column' => 'food_id',
                'two_table_column' => 'file_id'
            ],
            'input_filemanager' => [
                'class' => InputModelBehavior::className(),
            ],
//            'slug' => [
//                'class' => SlugBehavior::className(),
//                'attribute_title' => 'name'
//            ]

        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'ingredients' => 'Ingredients',
            'cook_steps' => 'Cook Steps',
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
     * Gets query for [[RestaurantFoods]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\RestaurantFoodsQuery
     */
    public function getFoodRestaurants()
    {
        return $this->hasMany(RestaurantFoods::className(), ['food_id' => 'id']);
    }

    public function getRestaurants() {
        return $this->hasMany(Restaurant::class, ['id' => 'restaurant_id'])->via('foodRestaurants');
    }

    public function getCountry() {
        return $this->hasOne(Country::class, ['id' => 'country_id']);
    }

    public function getFlagUrl() {
        return $this->getCountry()->count() > 0 ? $this->country->flag_path : '1';
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\FoodQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\FoodQuery(get_called_class());
    }

    /**
     * Gets query for [[RestaurantImages]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\RestaurantImagesQuery
     */
    public function getFoodImages()
    {
        return $this->hasMany(FoodImages::className(), ['food_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->via('foodImages');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoster()
    {
        return $this->hasOne(Files::className(), ['file_id' => 'file_id'])->via('foodImages');
    }

    /**
     * @return mixed
     */
    public function getFilesdata()
    {
        return $this->_filesdata;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setFilesdata($value)
    {
        return $this->_filesdata = $value;
    }

    public function getLink() {
        return \Yii::$app->urlManager->createUrl(['food/show', 'slug' => $this->id]);
    }

    public static function getDropdownList() {
        $regions = static::find()->lang()->all();
        return ArrayHelper::map($regions, 'id', 'name');
    }

}
