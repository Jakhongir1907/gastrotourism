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
 * This is the model class for table "waiter".
 *
 * @property int $id
 * @property int $restaurant_id
 * @property string|null $name
 * @property string|null $position
 * @property int|null $lang
 * @property string $lang_hash
 *
 * @property Langs $lang0
 * @property Restaurant $restaurant
 */
class Waiter extends \yii\db\ActiveRecord
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
        return 'waiter';
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
                    'restaurant_id' => '',
                ],
            ],
            'file_manager_model' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'filesdata',
                'relation_name' => 'files',
                'delimitr' => ',',
                'via_table_name' => 'waiter_files',
                'via_table_relation' => 'waiterimagefiles',
                'one_table_column' => 'waiter_id',
                'two_table_column' => 'file_id'
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
            [['restaurant_id', 'filesdata'], 'required'],
            [['restaurant_id', 'lang'], 'integer'],
            [['name', 'position', 'lang_hash'], 'string', 'max' => 255],
            [['lang'], 'exist', 'skipOnError' => true, 'targetClass' => Langs::className(), 'targetAttribute' => ['lang' => 'lang_id']],
            [['restaurant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::className(), 'targetAttribute' => ['restaurant_id' => 'id']],
            [['filesdata'], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'restaurant_id' => 'Restaurant ID',
            'name' => 'Name',
            'position' => 'Position',
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
     * @return \common\modules\restaurant\models\query\WaiterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\restaurant\models\query\WaiterQuery(get_called_class());
    }

    /**
     * Gets query for [[RestaurantImages]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\restaurant\models\query\RestaurantImagesQuery
     */
    public function getWaiterFiles()
    {
        return $this->hasMany(WaiterFiles::className(), ['waiter_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->via('waiterFiles');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoster()
    {
        return $this->hasOne(Files::className(), ['file_id' => 'file_id'])->via('waiterFiles');
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


}
