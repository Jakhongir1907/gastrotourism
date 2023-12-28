<?php

namespace common\modules\gallery\models;

use common\behaviors\DateTimeBehavior;
use common\behaviors\SlugBehavior;
use common\modules\filemanager\behaviors\FileModelBehavior;
use common\modules\filemanager\behaviors\GalleryFileModelBehavior;
use common\modules\filemanager\models\Files;
use common\modules\langs\components\ModelBehavior;
use common\modules\post\models\Post;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "gallery".
 *
 * @property int $id
 * @property int $user_id
 * @property int $created_date
 * @property int $status
 * @property string $title
 * @property string $slug
 * @property int $lang
 * @property string $lang_hash
 * @property int $type
 *
 * @property GalleryFiles[] $galleryFiles
 */
class Gallery extends \yii\db\ActiveRecord
{

    const TYPE_PHOTO = 1;
    const TYPE_VIDEO = 2;
    const TYPE_AUDIO = 3;

    const STATUS_ACTIVE = 1;
    const STATUS_DEACTIVE = 0;

    public $galleryfiles;

    public $images;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['user_id', 'created_date', 'status'], 'default', 'value' => null],
            [['user_id', 'status', 'lang', 'type'], 'integer'],
            [['title', 'slug', 'lang_hash'], 'string', 'max' => 255],
            [['mover_url'], 'string'],
            [['galleryfiles', 'created_date', ], 'safe']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'created_date' => 'Created Date',
            'status' => 'Status',
            'title' => 'Title',
            'slug' => 'Slug',
        ];
    }

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'file_manager_model' => [
                'class' => GalleryFileModelBehavior::className(),
                'attribute' => 'galleryfiles',
                'relation_name' => 'files',
                'delimitr' => ',',
                'via_table_name' => 'gallery_files',
                'via_table_relation' => 'galleryFiles',
                'one_table_column' => 'gallery_id',
                'two_table_column' => 'file_id'
            ],

            'lang' => [
                'class' => ModelBehavior::className(),
                'fill' => [
                    'slug' => '',
                    'status' => '',
                    'created_date' => function ($value, $model) {
                        return date("d.m.Y H:i:s", $value);
                    },

                ],
            ],

            'slug' => [
                'class' => SlugBehavior::className()
            ]

        ]);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGalleryFiles()
    {
        return $this->hasMany(GalleryFiles::className(), ['gallery_id' => 'id'])->orderBy(['sort' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->via('galleryFiles');
    }

//    public function afterFind() {
//        $images = array();
//        foreach($this->files as $index=>$file) {
//            $title = $this->getGalleryFiles()->where(['file_id' => $file->file_id])->one()->title;
//            $images[$index]['title'] = $title;
////            $images[$index]['description'] = $this->galleryFiles[$index]->description;
//            $images[$index]['description'] = Post::doTranslit($title);
//            $images[$index]['thumbnails'] = $file->thumbnails;
//        }
//        $this->images = $images;
//    }

    public function afterFind() {
        $images = array();
        foreach($this->getGalleryFiles()->all() as $index=>$galleryFile) {
            $file = $galleryFile->getFile()->one();
            $images[$index]['title'] = $galleryFile->title;
//            $images[$index]['description'] = $this->galleryFiles[$index]->description;
            $images[$index]['description'] = Post::doTranslit($galleryFile->title);
            $images[$index]['thumbnails'] = @$file->thumbnails;
        }
        $this->images = $images;
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\gallery\query\GalleryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\gallery\query\GalleryQuery(get_called_class());
    }

    public static function getTypeList()
    {
        return [
            self::TYPE_PHOTO => \Yii::t('app', 'Фото'),
            self::TYPE_VIDEO => \Yii::t('app', 'Видео'),
//            self::TYPE_DEFAULT => \Yii::t('app', 'Новость')
        ];
    }

    public function getLink()
    {
        return \Yii::$app->urlManager->createUrl([
            'gallery/show',
            'slug' => $this->slug
        ]);
    }


}
