<?php

namespace common\modules\post\models;

use common\behaviors\DateTimeBehavior;
use common\behaviors\GalleryBehavior;
use common\behaviors\SelectModelBehavior;
use common\behaviors\SlugBehavior;
use common\modules\categories\models\Categories;
use common\modules\filemanager\behaviors\FileModelBehavior;
use common\modules\filemanager\behaviors\InputModelBehavior;
use common\modules\filemanager\models\Files;
use common\modules\langs\components\Lang;
use common\modules\post\query\PostQuery;
use common\modules\langs\components\ModelBehavior;
use common\modules\langs\models\Langs;
use common\modules\categories\behaviors\CategoryModelBehavior;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\db\ActiveRecord;
use common\models\User;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;

/**
 * Class Post
 * @package common\modules\post\models
 * @property $enable_comments boolean
 * @property $category_main_post boolean
 * @property $important boolean
 * @property $suggest boolean
 * @property $reclam boolean
 * @property $pr_message boolean
 */
class Post extends ActiveRecord
{

    const SCENARIO_SEARCH = "search";

    const SCENARIO_BACKEND = "backend";

    /**
     *
     */
    const STATUS_ACTIVE = 1;
    /**
     *
     */
    const STATUS_DEACTIVE = 0;

    const STATUS_PENDING = 2;

    /**
     *
     */
    const TYPE_DEFAULT = 100;
    /**
     *
     */
    const TYPE_FESTIVAL = 2;
	const TYPE_BLOG = 21;
    /**
     *
     */
    const TYPE_VIDEO = 3;

    /**
     * @var
     */
    public $tagArray;

    /**
     * @var
     */
    private $_filesdata;

    private $_categoriesform;

    public $gallery;

    public $enable_comments;

    /**
     * @return string
     */
    public static function tableName()
    {
        return 'post';
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
//                    'slug' => '',
                    'status' => '',
                    'published_at' => function ($value, $model) {
                        return date("d.m.Y H:i:s", $value);
                    },
                    'categoriesform' => '',
                    'tagArray' => '',
                    'filesdata' => '',

                ],
            ],
//            Import purposes end
            'author' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => 'author',
                ],
                'value' => function ($event) {
                    if (\Yii::$app->controller->id != 'calculate') {
                        if (\Yii::$app->user->isGuest) {
                            $this->status = self::STATUS_PENDING;
                        }

                        return Yii::$app->user->identity->getId();
                    } else {
                        return $this->author;
                    }
                },
            ],
//            Import purposes start
            'date_filter' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at', 'published_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
            'file_manager_model' => [
                'class' => FileModelBehavior::className(),
                'attribute' => 'filesdata',
                'relation_name' => 'imagesposters',
                'delimitr' => ',',
                'via_table_name' => 'post_files',
                'via_table_relation' => 'postimagefiles',
                'one_table_column' => 'post_id',
                'two_table_column' => 'file_id'
            ],
            'input_filemanager' => [
                'class' => InputModelBehavior::className(),
            ],
//            'date_publish_date' => [
//                'class' => DateTimeBehavior::className(),
//                'attribute' => 'published_at', //атрибут модели, который будем менять
////                'format' => 'dd.MM.yyyy H:mm:ss',   //формат вывода даты для пользователя
//                'format' => 'd MMMM',   //формат вывода даты для пользователя
//                'disableScenarios' => [self::SCENARIO_SEARCH],
//                'default' => 'today'
//            ],
            'category_model' => [
                'class' => CategoryModelBehavior::className(),
                'attribute' => 'categoriesform',
                'separator' => ',',
                'public_url' => '/posts/post/category',
                'public_field' => 'lang_hash',
            ],
            'gallery' => [
                'class' => GalleryBehavior::className(),
            ],
            'slug' => [
                'class' => SlugBehavior::className()
            ]

        ]);

    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            [
                [
                    'title',
                    'description',
                    'filesdata'
                ],
                'required'
            ],
            [
                [
                    'author',
                    'lang',
                    'type',
                    'created_at',
                    'updated_at',
                    'top',
                    'viewed',
                    'status',
                    'isBlog'
                ],
                'integer'
            ],
            [
                [
                    'enable_comments',
                ],
                'boolean'
            ],
            [
                [
                    'enable_comments',
                ],
                'default',
                'value' => false
            ],
            [
                [
                    'type',
                ],
                'default',
                'value' => static::TYPE_DEFAULT
            ],
            [
                [
                    'viewed',
                ],
                'default',
                'value' => 0
            ],
            [['title', 'slug', 'lang_hash'], 'string', 'max' => 255],
            [['description', 'short_link', 'anons'], 'string'],
            [['lang', 'author'], 'default', 'value' => null],
            [['slug'], 'unique', 'targetAttribute' => ['slug']],
            [
                ['lang'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Langs::className(),
                'targetAttribute' => ['lang' => 'lang_id']
            ],
            [
                ['author'],
                'exist',
                'skipOnError' => true,
                'targetClass' => User::className(),
                'targetAttribute' => ['author' => 'id']
            ],
            [['created_at', 'updated_at', 'author', 'published_at'], 'safe'],
            [
                [
                    'filesdata',
                    'tagArray',
                    'fixtureArray',
                    'venueArray',
                    'teamArray',
                    'seasonArray',
                    'personArray',
                    'leagueArray',
                    'meta_data',
                    'categoriesform'
                ],
                'safe'
            ],
        ];
    }

    public function fields()
    {
        $fields = parent::fields();
        unset($fields['meta_data']);
//        unset($fields['post_main_image']);
//        unset($fields['photo_of_the_day']);
//        unset($fields['show_image']);
        return ArrayHelper::merge($fields, array(
            'tags' => function ($model) {
                return $model->tags;
            },
            'categories',
            'poster',
//            'published_at' => function () {
////      Import purposes start
////                return ($this->published_at);
////      Import purposes end
////                return strtotime($this->published_at);
//            },
        ));
    }

    public function extraFields()
    {
        return array(
            'lang' => function () {
                return $this->language;
            },
            'gallery' => function () {
                return $this->gallery;
            },
            'sportsmens' => 'person',
            'league',
            'comment_count' => function ($model) {
                return $model->commentCount;
            },
            'fixtures',
            'canEdit' => function ($model) {
                $user = User::authorizeByToken();
                if ($user instanceof User) {
                    \Yii::$app->user->login($user);
//                    $allow = \Yii::$app->user->can('updatePost') && !\Yii::$app->user->identity->isBlogger();
                    $allow = false;
                } else {
                    $allow = false;
                }

                return array(
                    'allow' => $allow,
                    'link' => $allow ? (getenv('BACKEND_URL') . "post/post/update/{$this->id}") : null
                );
            }
        );
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'author' => Yii::t('app', 'Author'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'slug' => Yii::t('app', 'Slug'),
            'lang' => Yii::t('app', 'Lang'),
            'lang_hash' => Yii::t('app', 'Lang Hash'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'published_at' => Yii::t('app', 'Published At'),
            'top' => Yii::t('app', 'Top'),
            'viewed' => Yii::t('app', 'Viewed'),
            'status' => Yii::t('app', 'Status'),
            'tagArray' => Yii::t('app', 'Tags'),
            'fixtureArray' => Yii::t('app', 'Fixtures'),
            'venueArray' => Yii::t('app', 'Venue'),
            'personArray' => Yii::t('app', 'Person'),
            'leagueArray' => Yii::t('app', 'League'),
            'seasonArray' => Yii::t('app', 'Season'),
            'teamArray' => Yii::t('app', 'Team'),
//            'important' => Yii::t('app', 'Important'),
            'suggest' => Yii::t('app', 'Suggest'),
            'post_main_image' => Yii::t('app', 'Post main image'),
            'category_main_post' => Yii::t('app', 'Category main post'),
            'pr_message' => Yii::t('app', 'PR message'),
            'reclam' => Yii::t('app', 'Reclam'),
            'report' => Yii::t('app', 'Report'),
            'event' => Yii::t('app', 'Event'),
            'interview' => Yii::t('app', 'Interview'),
            'show_image' => Yii::t('app', 'Show image'),
            'show_author' => Yii::t('app', 'Show author'),
            'blogger' => Yii::t('app', 'Blogger'),
            'isBlog' => Yii::t('app', 'Blog'),
        ];
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
    public function getCategoriesform()
    {
        return $this->_categoriesform;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setCategoriesform($value)
    {
        return $this->_categoriesform = $value;
    }


    public function getPostCategories()
    {
        return $this->hasMany(PostCategories::className(), ['post_id' => 'id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Categories::className(), ['id' => 'category_id'])->via('postCategories');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLanguage()
    {
        return $this->hasOne(Langs::className(), ['lang_id' => 'lang']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor0()
    {
        return $this->hasOne(User::className(), ['id' => 'author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostFiles()
    {
        return $this->hasMany(PostFiles::className(), ['post_id' => 'id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->via('postFiles');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTags::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->via('postTags');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getimagesposters()
    {
        return $this->hasMany(Files::className(), ['file_id' => 'file_id'])->viaTable('post_files',
            ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoster()
    {
        $poster = $this->hasOne(Files::className(), ['file_id' => 'file_id'])->viaTable('post_files',
            ['post_id' => 'id'])->andWhere(['type' => [
            'jpg',
            'jpeg',
            'png',
            'bmp',
            'webp',
            'gif',
            'jpf'
        ]]);

        if ($poster->count() > 0) {
            return $poster;
        }

        return Files::no_photo();
    }

    //fixture

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostFixture()
    {
        return $this->hasMany(PostFixture::className(), ['post_id' => 'id']);
    }

    public function getPostPerson()
    {
        return $this->hasMany(PostPerson::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostVenue()
    {
        return $this->hasMany(PostVenue::className(), ['post_id' => 'id']);
    }

    public function getPostLeague()
    {
        return $this->hasMany(PostLeague::className(), ['post_id' => 'id']);
    }

    public function getPostSeason()
    {
        return $this->hasMany(PostSeason::className(), ['post_id' => 'id']);
    }

    public function getPostTeam()
    {
        return $this->hasMany(PostTeam::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFixtures()
    {
        return $this->hasMany(Fixture::className(), ['id' => 'fixture_id'])->via('postFixture');
    }

    public function getPerson()
    {
        return $this->hasMany(Person::className(), ['id' => 'person_id'])->via('postPerson');
    }

    public function getLeague()
    {
        return $this->hasMany(League::className(), ['id' => 'league_id'])->via('postLeague');
    }

    public function getSeason()
    {
        return $this->hasMany(Season::className(), ['id' => 'season_id'])->via('postSeason');
    }

    public function getTeam()
    {
        return $this->hasMany(Team::className(), ['id' => 'team_id'])->via('postTeam');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVenue()
    {
        return $this->hasMany(Venue::className(), ['id' => 'venue_id'])->via('postVenue');
    }

    //comments

    public function getPostComments()
    {
        return $this->hasMany(PostComments::className(), ['post_id' => 'id']);
    }

    public function getComments()
    {
        $query = $this->hasMany(Comment::className(), ['id' => 'comment_id'])->via('postComments');
        if (!\Yii::$app->user->isGuest) {
            $query->orWhere(['user_id' => \Yii::$app->user->identity->id]);
        }

        return $query;
    }

    public function getCommentCount()
    {
//        return $this->hasMany(PostComments::className(), ['post_id' => 'id'])->count();
        return PostComments::find()->where(['post_id' => $this->id])
            ->leftJoin(Comment::tableName(), 'post_comments.comment_id=comment.id')
            ->andWhere(['comment.status' => Comment::STATUS_ACTIVE])->count();
    }

    /**
     * @return array
     */
    public static function getTypeList()
    {
        return [
            self::TYPE_DEFAULT => \Yii::t('app', 'Новость'),
            self::TYPE_VIDEO => \Yii::t('app', 'Видео'),
            self::TYPE_PHOTO => \Yii::t('app', 'Фото')
        ];
    }


    /**
     * @param $id
     * @return mixed
     */
    public function getTypeName($id)
    {
        return ArrayHelper::getValue(self::getTypeList(), $id);
    }

    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_DEACTIVE => 'Deactive'
        ];
    }


    public function getStatusName($key)
    {
        return ArrayHelper::getValue(static::getStatusList(), $key);
    }

    public static function getSelectDropdown()
    {
        $posts = static::find()->lang()->orderBy(['published_at' => SORT_DESC])->limit(100)->all();
        return ArrayHelper::map($posts, 'id', 'title');
    }

    /**
     * @return PostQuery|\yii\db\ActiveQuery
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

    public static function translateToLatin($plain)
    {
        $textInterpreter = new TextInterpreter();
        $textInterpreter->setTokenizer(new LatinTokenizer());
        $textInterpreter->addBehavior(new LatinBehaviour([
            'бугунги' => 'bugungi',
            'жароҳат' => 'jarohat',
            'туфайли' => 'tufayli',
            'Патрик' => 'Patrik'
        ]));

        $matches = array();
        preg_match('/<a([^"\'>]+)href=["\']?([^"\'>]+)["\']?/', $plain, $matches);

        if (sizeof($matches) > 0) {
            $url = $matches[2];

            str_replace($url, urlencode($url), $plain);

        }
        try {

            $translated = $textInterpreter->process($plain)->getText();
            return $translated;

        } catch (\Exception $e) {
            return $plain;
        }
    }

    public static function doTranslit($plain)
    {
        if (\Yii::$app->language == 'oz' || \Yii::$app->language == 'uz') {
            if (\Yii::$app->language == 'oz') {
                $textInterpreter = new TextInterpreter();
                $textInterpreter->setTokenizer(new LatinTokenizer());
                $textInterpreter->addBehavior(new LatinBehaviour([]));

                $matches = array();
                preg_match('/<a([^"\'>]+)href=["\']?([^"\'>]+)["\']?/', $plain, $matches);

                if (sizeof($matches) > 0) {
                    $url = $matches[2];

                    str_replace($url, urlencode($url), $plain);

                }

                try {

                    $translated = $textInterpreter->process($plain)->getText();
                    return $translated;

                } catch (\Exception $e) {
                    return $plain;
                }
            }
            return $plain;
        }
        return '';
    }

    public function getLink()
    {
        return \Yii::$app->urlManager->createUrl([
            'post/article',
            'slug' => $this->slug
        ]);
    }

    public function afterFind()
    {
        if (\Yii::$app->language == 'oz') {
            $this->title = static::translateToLatin($this->title);
            $this->description = static::translateToLatin($this->description);

        }

        parent::afterFind();
    }

    public function getPrettyDate() {

        $day = date("d", $this->published_at);
        $month = date("F", $this->published_at);

        return $day . " " . __($month);

        return Yii::$app->formatter->asDatetime($this->published_at,'dd MMMM');
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function beforeSave($insert)
    {
        $this->published_at = strtotime($this->published_at);

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}
