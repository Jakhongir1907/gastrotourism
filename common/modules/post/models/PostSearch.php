<?php

namespace common\modules\post\models;

use common\modules\langs\components\Lang;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\post\models\Post;
use yii\helpers\ArrayHelper;

class PostSearch extends Post
{

    public $category;

    public $tag;

    public $current_post;

    public $isBlogger;

    public function rules()
    {
        return [
            [
                ['id', 'author', 'lang', 'type', 'created_at', 'updated_at', 'top', 'viewed', 'status'],
                'integer',
                'on' => [self::SCENARIO_BACKEND]
            ],
            [
                ['id', 'author', 'lang', 'type', 'created_at', 'updated_at', 'published_at', 'top', 'viewed', 'status'],
                'integer',
                'on' => [self::SCENARIO_SEARCH]
            ],
            [['title', 'description', 'slug', 'lang_hash', 'short_link'], 'safe'],
        ];
    }

    public function init()
    {
        parent::init();
        $this->setScenario(self::SCENARIO_SEARCH);
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return ArrayHelper::merge(Model::scenarios(), [
            self::SCENARIO_SEARCH => [
                'id',
                'author',
                'lang',
                'type',
                'created_at',
                'updated_at',
                'top',
                'viewed',
                'status',
                'title',
                'description',
                'slug',
                'lang_hash',
                'published_at',
                'short_link',
            ],
            self::SCENARIO_BACKEND => [
                'id',
                'author',
                'lang',
                'type',
                'created_at',
                'updated_at',
                'top',
                'viewed',
                'status',
                'title',
                'description',
                'slug',
                'lang_hash',
                'published_at'
            ],
        ]);
    }

    public function search($params)
    {
        $query = Post::find();

        if ($this->category) {
            $query->joinWith(['categories']);
        }

        if ($this->tag) {
            $query->joinWith(['tags']);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'post.id' => $this->id,
            'post.author' => $this->author,
            'post.type' => $this->type,
            'post.created_at' => $this->created_at,
            'post.updated_at' => $this->updated_at,
            'post.top' => $this->top,
            'post.viewed' => $this->viewed,
            'post.status' => $this->status,
//            'post.short_link' => $this->short_link
        ]);

        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
            $query->andFilterWhere(['post.lang' => Lang::getLangId('uz')]);
        } else {
            $query->andFilterWhere(['post.lang' => Lang::getLangId()]);
        }


        if ($this->published_at) {
            $query->andWhere(['post.published_at' => strtotime($this->published_at)]);
        }

        if ($this->category) {
            if (!is_array($this->category)) {
                $query->andFilterWhere([
                    'categories.id' => $this->category
                ]);
            } else {
                $query->orFilterWhere(['in', 'categories.id', $this->category]);
            }
        }

        if ($this->tag) {
            if (!is_array($this->tag)) {
                $query->andFilterWhere([
                    'tag.id' => $this->tag
                ]);
            } else {
                $query->andFilterWhere(['in', 'tag.id', $this->tag]);
            }
        }

//        if ($this->getScenario() == self::SCENARIO_SEARCH) {
//            $query->andWhere(['<', 'published_at', time()]);
//        }

        if ($this->current_post) {
            $query->andWhere(['!=', 'post.id', $this->current_post]);
        }

        $query->andFilterWhere(['like', 'post.title', trim($this->title)])
            ->andFilterWhere(['like', 'post.description', $this->description])
            ->andFilterWhere(['like', 'post.lang_hash', $this->lang_hash]);

        return $dataProvider;
    }
}
