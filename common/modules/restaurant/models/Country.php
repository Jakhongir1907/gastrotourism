<?php

namespace common\modules\restaurant\models;

use common\modules\langs\components\ModelBehavior;
use common\modules\langs\models\Langs;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property int|null $name
 * @property int|null $flag_path
 * @property int|null $lang
 * @property string $lang_hash
 *
 * @property Langs $lang0
 * @property Food[] $foods
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
//            Import purposes start
            'lang' => [
                'class' => ModelBehavior::className(),
                'fill' => [
                    'flag_path' => '',

                ],
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
    public function rules()
    {
        return [
            [['lang'], 'integer'],
            [['name'], 'required'],
            [['lang_hash', 'name', 'flag_path'], 'string', 'max' => 255],
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
            'flag_path' => 'Flag Path',
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
     * Gets query for [[Foods]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\FoodQuery
     */
    public function getFoods()
    {
        return $this->hasMany(Food::className(), ['country_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\CountryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\CountryQuery(get_called_class());
    }

    public static function getDropdownList() {
        $regions = static::find()->lang()->all();
        return ArrayHelper::map($regions, 'id', 'name');
    }

}
