<?php

namespace common\modules\pages\models;

use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\behaviors\SluggableBehavior;
//Системные
use jakharbek\core\behaviors\DateTimeBehavior;
use jakharbek\core\behaviors\UserBehavior;
//Файлы
use jakharbek\filemanager\behaviors\FileModelBehavior;
use jakharbek\filemanager\models\Files;
//Языки
use common\modules\langs\models\Langs;
use common\modules\langs\components\ModelBehavior;
//Пользовтели
use jakharbek\users\models\Users;
//Категории
use jakharbek\categories\behaviors\CategoryModelBehavior;
use jakharbek\categories\models\Categories;
//Теги
use jakharbek\tags\behaviors\TagsModelBehavior;
use jakharbek\tags\models\Tags;
//Темы
use jakharbek\topics\behaviors\TopicModelBehavior;
use jakharbek\topics\models\Topics;
//Видео
use common\modules\videos\models\Videos;
/**
 * This is the ActiveQuery class for [[Pages]].
 *
 * @see Pages
 */
class PagesQuery extends \yii\db\ActiveQuery
{
    public function behaviors() {
        return [
            'lang' => [
                'class' => \common\modules\langs\components\QueryBehavior::className(),
//                'alias' => Pages::tableName()
            ],
        ];
    }
    public function active()
    {
        return $this->andWhere('[[status]]=1');
    }

    /**
     * @inheritdoc
     * @return Pages[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Pages|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function statuses($status = null){
        $data = [
            1 => Yii::t('app','Active'),
            0 => Yii::t('app','Deactive'),
        ];
        if($status === null){
            return $data;
        }else{
            return $data[$status];
        }
    }
    public function slug($slug = null){
        if($slug == null){return false;}
        $this->active();
        $this->lang();
        $this->andWhere(['slug' => $slug]);
        return $this;
    }
}
