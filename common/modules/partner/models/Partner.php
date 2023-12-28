<?php

namespace common\modules\partner\models;

use Yii;
use common\modules\langs\models\Langs;

/**
 * This is the model class for table "partner".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $logo_id
 * @property string|null $site_url
 * @property int|null $lang
 * @property string $lang_hash
 *
 * @property Langs $lang0
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lang'], 'integer'],
            [['name', 'logo_id', 'site_url', 'lang_hash'], 'string', 'max' => 255],
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
            'logo_id' => 'Logo ID',
            'site_url' => 'Site Url',
            'lang' => 'Lang',
            'lang_hash' => 'Lang Hash',
        ];
    }

    /**
     * Gets query for [[Lang0]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\partner\models\query\LangsQuery
     */
    public function getLang0()
    {
        return $this->hasOne(Langs::className(), ['lang_id' => 'lang']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\partner\models\query\PartnerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\partner\models\query\PartnerQuery(get_called_class());
    }
}
