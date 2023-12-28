<?php

namespace common\modules\restaurant\models;

use common\behaviors\SlugBehavior;
use common\modules\langs\components\ModelBehavior;
use Yii;
use common\modules\langs\models\Langs;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "region".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $slug
 * @property int|null $lang
 * @property string $lang_hash
 *
 * @property Langs $lang0
 * @property Restaurant[] $restaurants
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'region';
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
                    'slug' => '',
                ],
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
            [['description'], 'string'],
            [['lang'], 'integer'],
            [['name', 'slug', 'lang_hash'], 'string', 'max' => 255],
            [['lang'], 'exist', 'skipOnError' => true, 'targetClass' => Langs::className(), 'targetAttribute' => ['lang' => 'lang_id']],
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
     * Gets query for [[Restaurants]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\RestaurantQuery
     */
    public function getRestaurants()
    {
        return $this->hasMany(Restaurant::className(), ['region_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\RegionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\RegionQuery(get_called_class());
    }

    public static function getDropdownList() {
        $regions = static::find()->lang()->all();
        return ArrayHelper::map($regions, 'id', 'name');
    }
}
