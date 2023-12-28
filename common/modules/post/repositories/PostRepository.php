<?php

namespace common\modules\post\repositories;


use common\modules\langs\components\Lang;
use common\modules\post\models\Post;
use DomainException as NotFoundException;
use yii\helpers\ArrayHelper;

/**
 * Class PostRepository
 * @package common\modules\post\repositories
 */
class PostRepository
{

    /**
     * @param $id
     * @return Post|null
     */
    public function get($id)
    {
        if (!$post = Post::findOne($id)) {
            throw new NotFoundException('Post is not found.');
        }
        return $post;
    }


    /**
     * @param Post $post
     */
    public function save(Post $post)
    {
        if (!$post->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }


    /**
     * @param Post $post
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Post $post)
    {
        if (!$post->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }

    public static function getTopPosts($count = 6)
    {
        $query = Post::find()
            ->where(['top' => 1])
            ->active()
            ->orderBy(['published_at' => SORT_DESC])
            ->limit($count);

        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
            $query->andWhere(['lang' => Lang::getLangId('uz')]);
        } else {
            $query->lang();
        }
        return $query->all();


    }

    public static function getImportantPosts($count = 6)
    {
        $query = Post::find()
            ->where(['important' => 1])
            ->active()
            ->orderBy(['published_at' => SORT_DESC])
            ->limit($count);

        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
            $query->andWhere(['lang' => Lang::getLangId('uz')]);
        } else {
            $query->lang();
        }
        return $query->all();
    }

    public static function getLenta($count = 6, $offset = 0)
    {
        $query = Post::find()
            ->active()
            ->orderBy(['published_at' => SORT_DESC])
//            ->orderBy(['id' => SORT_DESC])
            ->offset($offset)
            ->limit($count);

        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
            $query->andWhere(['lang' => Lang::getLangId('uz')]);
        } else {
            $query->lang();
        }
        return $query->all();
    }

    public static function getMoreReadPosts($count = 6)
    {
        $query = Post::find()
            ->active()
            ->orderBy(['published_at' => SORT_DESC, 'viewed' => SORT_DESC])
            ->limit($count);

        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
            $query->andWhere(['lang' => Lang::getLangId('uz')]);
        } else {
            $query->lang();
        }
        return $query->all();
    }

    public static function getSuggestedPosts($count = 6)
    {
        $query = Post::find()
            ->where(['suggest' => 1])
            ->active()
            ->orderBy(['published_at' => SORT_DESC])
            ->limit($count);

        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
            $query->andWhere(['lang' => Lang::getLangId('uz')]);
        } else {
            $query->lang();
        }
        return $query->all();
    }

    /**
     * @param Post $post
     * @param int $count
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getRelatedPosts(Post $post, $count = 6)
    {
        return static::getRelatedPostsQuery($post, $count)->all();
    }

    public static function getRelatedPostsQuery(Post $post, $count = 6)
    {

        $query = Post::find();

        $categories = ArrayHelper::getColumn($post->categories, 'id');
        if (sizeof($categories) > 0) {
            $query->joinWith(['categories']);
            $query->orWhere(['in', 'categories.id', $categories]);
        }

        $query->andWhere(['<>', 'post.id', $post->id]);
        $query->active()
            ->orderBy(['id' => SORT_DESC])
            ->limit($count);

        return $query;

    }

}