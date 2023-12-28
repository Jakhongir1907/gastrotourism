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
 * This is the model class for table "fruit".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $price
 * @property int|null $lang
 * @property string $lang_hash
 *
 * @property Langs $lang0
 */
class Fruit extends \yii\db\ActiveRecord
{

    /**
     * @var
     */
    private $_filesdata;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fruit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['filesdata'], 'required'],
            [['description'], 'string'],
            [['price', 'lang'], 'integer'],
            [['name', 'lang_hash'], 'string', 'max' => 255],
            [['lang'], 'exist', 'skipOnError' => true, 'targetClass' => Langs::className(), 'targetAttribute' => ['lang' => 'lang_id']],
            [['filesdata'], 'safe']
        ];
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
//            Import purposes start
            'lang' => [
                'class' => ModelBehavior::className(),
                'fill' => [
//                    'top' => '',

                ],
            ],
            'file_manager_model' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'filesdata',
                'relation_name' => 'files',
                'delimitr' => ',',
                'via_table_name' => 'fruit_images',
                'via_table_relation' => 'fruitimagefiles',
                'one_table_column' => 'fruit_id',
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
     * {@inheritdoc}
     * @return \common\modules\restaurant\models\query\FruitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\FruitQuery(get_called_class());
    }

    /**
     * Gets query for [[RestaurantImages]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\RestaurantImagesQuery
     */
    public function getFruitImages()
    {
        return $this->hasMany(FruitImages::className(), ['fruit_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->via('fruitImages');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoster()
    {
        return $this->hasOne(Files::className(), ['file_id' => 'file_id'])->via('fruitImages');
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
        return \Yii::$app->urlManager->createUrl(['fruit/show', 'slug' => $this->id]);
    }

}
