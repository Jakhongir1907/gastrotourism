<?php


namespace common\modules\pages\models;

use common\behaviors\DateTimeBehavior;
use common\behaviors\SlugBehavior;
use common\modules\filemanager\behaviors\FileModelBehavior;
use common\modules\filemanager\behaviors\GalleryFileModelBehavior;
use common\modules\filemanager\models\Files;
use common\modules\categories\models\Categories;
use Yii;
use \yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use common\modules\langs\models\Langs;
use common\modules\langs\components\ModelBehavior;
use common\models\User;

/**
 * This is the model class for table "pages".
 *
 * @property int $page_id Идентификатор
 * @property string $title Зоголовок
 * @property string $subtitle Под заголовок поста
 * @property string $description Описание
 * @property string $content Контент
 * @property string $slug Слаг
 * @property string $template Шаблон
 * @property int $sort Сортировка
 * @property int $date_update Дата побновление
 * @property int $date_create Дата добавление
 * @property int $date_publish Дата публикации
 * @property int $status Статус
 * @property string $lang_hash Хеш языка
 * @property int $lang Язык
 * @property int $user_id Пользователь
 */
class Pages extends \yii\db\ActiveRecord
{
    const DESCRIPTION = "Страницы";

    const SCENARIO_SEARCH = "search";
    const STATUS_ACTIVE = 1;

    const TOPIC_TYPE = 200;

    private $_imagespostersdata;
    public $files;

    /**
     * @return array
     */
    public function behaviors()
        {
        return ArrayHelper::merge(parent::behaviors(),[
            'lang' => [
                'class' => ModelBehavior::className(),
                'fill' => [
                    'slug' => '',
                    'sort' => '',
                    'status' => '',
                    'date_publish' => function($value,$model){
                        return date("d.m.Y H:i:s",$value);
                    },
                ],
            ],
            'date_filter' => [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date_create', 'date_update'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['date_update'],
                ],
            ],
            'date_publish_date' => [
                'class' => DateTimeBehavior::className(),
                'attribute' => 'date_publish', //атрибут модели, который будем менять
                'format'         => 'dd.MM.yyyy HH:mm',   //формат вывода даты для пользователя
                'disableScenarios' => [self::SCENARIO_SEARCH],
                'default' => 'today'
            ],
            'slug' => [
                'class' => SlugBehavior::className(),
                'attribute' => 'slug',
                'attribute_title'=> 'title',
            ],
            'file_manager_model_images' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'imagespostersdata',
                'relation_name' => 'images',
                'delimitr' => ',',
                'via_table_name' => 'pagesimages',
                'via_table_relation' => 'pagesimages',
                'one_table_column' => 'page_id',
                'two_table_column' => 'file_id'
            ],
        ]); // TODO: Change the autogenerated stub

    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pages';
    }

    /**
     * @return PagesQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return new PagesQuery(get_called_class());
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['description', 'content'], 'string'],
            [['sort', 'date_update', 'date_create', 'date_publish', 'status', 'lang'], 'default', 'value' => null],
            [['title', 'subtitle', 'template'], 'string', 'max' => 500],
            [['slug'], 'string', 'max' => 600],
            [['lang_hash'], 'string', 'max' => 255],
            [['slug'], 'unique', 'targetAttribute' => ['slug', 'lang']],
            [['lang'], 'exist', 'skipOnError' => true, 'targetClass' => Langs::className(), 'targetAttribute' => ['lang' => 'lang_id']],
            [['imagespostersdata'],'safe']
        ];
    }

    /**
     * @return array
     */
    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('app', 'Page ID'),
            'title' => Yii::t('app', 'Title'),
            'subtitle' => Yii::t('app', 'Subtitle'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'slug' => Yii::t('app', 'Slug'),
            'template' => Yii::t('app', 'Template'),
            'sort' => Yii::t('app', 'Sort'),
            'date_update' => Yii::t('app', 'Date Update'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_publish' => Yii::t('app', 'Date Publish'),
            'status' => Yii::t('app', 'Status'),
            'lang_hash' => Yii::t('app', 'Lang Hash'),
            'lang' => Yii::t('app', 'Lang'),
            //categories topics tags
            'categories' => Yii::t('app', 'Categories'),
            'images_posters' => Yii::t('app', 'Images'),
        ];
    }


    /**
     * @return mixed
     */
    public function getCategoriesform(){
        return $this->_categoriesform;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setCategoriesform($value){
        return $this->_categoriesform = $value;
    }


    public function getimagespostersdata(){
        return $this->_imagespostersdata;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setimagespostersdata($value){
        return $this->_imagespostersdata = $value;
    }

    /**
     * @return mixed
     */

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLang()
    {
        return $this->hasOne(Langs::className(), ['lang_id' => 'lang'])->inverseOf('pages');
    }



    public function getIds()
    {
        return $this->hasMany(Categories::className(), ['id' => 'id'])->viaTable('pagescategories', ['page_id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPagesimages()
    {
        return $this->hasMany(Pagesimages::className(), ['page_id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->viaTable('pagesimages', ['page_id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */

    public function getImg(){
        if(count($this->images))
        {
            return $this->images[0]->src;
        }
        return Files::no_photo_src();
    }

    /**
     * @return null|static
     */
    public function getImgFile(){
        if(count($this->images))
        {
            return $this->images[0];
        }
        return Files::no_photo();
    }
    public function counterUp(){
        $this->updateCounters(['views' => 1]);
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function getDateTitle(){
        $timestamp = strtotime($this->date_publish);
        return Yii::$app->formatter->asDatetime($timestamp,"php:d F H:m");
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */

    public function viewsUp(){
        $model = $this;
        Yii::$app->tools->viewsUp($this->lang_hash,$this->tableName(),function()use($model){
            $all = $model->translateVersions;
            foreach ($all as $data){
                $data->counterUp();
            }
        });
    }

    public function afterFind() {
        $images = array();
        foreach($this->getPagesimages()->all() as $index=>$galleryFile) {
            $file = $galleryFile->getFile()->one();
            $images[$index]['title'] = $galleryFile->title;
            $images[$index]['description'] = $galleryFile->description;
//            $images[$index]['description'] = Post::doTranslit($galleryFile->title);
            $images[$index]['thumbnails'] = @$file->thumbnails;
        }
        $this->files = $images;
    }

}
