<?php

namespace common\modules\restaurant\models;

use common\modules\restaurant\behaviors\RestaurantFoodsBehavior;
use Yii;
use common\modules\langs\models\Langs;
use yii\helpers\ArrayHelper;
use common\modules\langs\components\ModelBehavior;
use common\modules\filemanager\behaviors\FileModelBehavior;
use common\modules\filemanager\behaviors\InputModelBehavior;
use common\behaviors\SlugBehavior;
use common\modules\filemanager\models\Files;

/**
 * This is the model class for table "restaurant".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $address
 * @property string|null $phone
 * @property int|null $delivery
 * @property string|null $work_time_start
 * @property string|null $work_time_end
 * @property int|null $region_id
 * @property float|null $lat
 * @property float|null $lng
 * @property int|null $top
 * @property string|null $slug
 * @property int|null $lang
 * @property string $lang_hash
 *
 * @property Langs $lang0
 * @property Region $region
 * @property RestaurantFoods[] $restaurantFoods
 * @property RestaurantImages[] $restaurantImages
 */
class Restaurant extends \yii\db\ActiveRecord
{

    public $foodsArray;

    /**
     * @var
     */
    private $_filesdata;

    /**
     * @var
     */
    private $_foodsdata;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'restaurant';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
//            Import purposes start
            'lang' => [
                'class' => ModelBehavior::className(),
                'fill' => [
                    'region_id' => '',
                    'delivery' => '',
                    'top' => '',
                    'foodsArray' => ''

                ],
            ],
            'file_manager_model' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'filesdata',
                'relation_name' => 'files',
                'delimitr' => ',',
                'via_table_name' => 'post_files',
                'via_table_relation' => 'postimagefiles',
                'one_table_column' => 'post_id',
                'two_table_column' => 'file_id'
            ],
            'foods' => [
                'class' => RestaurantFoodsBehavior::className(),
                'attribute' => 'foodsdata',
                'relation_name' => 'foods',
                'delimitr' => ',',
                'via_table_name' => 'restaurant_foods',
                'via_table_relation' => 'restaurantfoods',
                'one_table_column' => 'restaurant_id',
                'two_table_column' => 'food_id'
            ],
            'input_filemanager' => [
                'class' => InputModelBehavior::className(),
            ],
            'slug' => [
                'class' => SlugBehavior::className(),
                'attribute_title' => 'name'
            ]

        ]);

    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filesdata'], 'required'],
            [['description'], 'string'],
            [['delivery', 'region_id', 'top', 'lang', 'service_likes', 'setting_likes', 'interior_likes'], 'integer'],
            [['lat', 'lng'], 'number'],
            [['service_likes', 'setting_likes', 'interior_likes'], 'default', 'value' => 0],
            [['name', 'address', 'phone', 'work_time_start', 'work_time_end', 'slug', 'lang_hash'], 'string', 'max' => 255],
            [['lang'], 'exist', 'skipOnError' => true, 'targetClass' => Langs::className(), 'targetAttribute' => ['lang' => 'lang_id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['foodsArray', 'filesdata', 'foodsdata'], 'safe']
        ];
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
            'address' => 'Address',
            'phone' => 'Phone',
            'delivery' => 'Delivery',
            'work_time_start' => 'Work Time Start',
            'work_time_end' => 'Work Time End',
            'region_id' => 'Region ID',
            'lat' => 'Lat',
            'lng' => 'Lng',
            'top' => 'Top',
            'slug' => 'Slug',
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
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\RegionQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * Gets query for [[RestaurantFoods]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\RestaurantFoodsQuery
     */
    public function getRestaurantFoods()
    {
        return $this->hasMany(RestaurantFoods::className(), ['restaurant_id' => 'id'])->orderBy(['restaurant_foods.sort' => SORT_ASC]);
    }

    public function getFoods() {
        return $this->hasMany(Food::class, ['id' => 'food_id'])->via('restaurantFoods');
    }

    /**
     * Gets query for [[RestaurantImages]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\RestaurantImagesQuery
     */
    public function getRestaurantImages()
    {
        return $this->hasMany(RestaurantImages::className(), ['restaurant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->via('restaurantImages');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoster()
    {
        return $this->hasOne(Files::className(), ['file_id' => 'file_id'])->via('restaurantImages');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWaiters()
    {
        return $this->hasMany(Waiter::className(), ['restaurant_id' => 'id']);
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

    /**
     * @return mixed
     */
    public function getFoodsdata()
    {
        return $this->_foodsdata;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setFoodsdata($value)
    {
        return $this->_foodsdata = $value;
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\RestaurantQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\RestaurantQuery(get_called_class());
    }

    public function getLink() {
        return \Yii::$app->urlManager->createUrl([
            'restaurant/show',
            'slug' => $this->slug
        ]);
    }
}
