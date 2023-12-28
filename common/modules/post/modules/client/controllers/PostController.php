<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 * @package advanced
 */

namespace common\modules\post\modules\client\controllers;


use common\modules\categories\models\Categories;
use common\modules\langs\components\Lang;
use common\modules\post\models\Post;
use common\modules\post\models\PostSearch;
use common\modules\post\repositories\PostRepository;
use common\modules\tag\models\Tag;
use frontend\models\SearchForm;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PostController extends Controller
{

    public function actionIndex() {
        $postSearch = new PostSearch();
        $dataProvider = $postSearch->search(\Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['published_at' => SORT_DESC])->andWhere(['status' => Post::STATUS_ACTIVE, 'type' => Post::TYPE_DEFAULT]);
        $dataProvider->pagination->pageSize = 100;

        return $this->render('@common/modules/post/modules/client/views/post/index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionFestivals() {
        $postSearch = new PostSearch();
        $dataProvider = $postSearch->search(\Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['published_at' => SORT_DESC])->andWhere(['status' => Post::STATUS_ACTIVE, 'type' => Post::TYPE_FESTIVAL]);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('@common/modules/post/modules/client/views/post/festivals', [
            'dataProvider' => $dataProvider,
        ]);
    }

     public function actionBlogs() {
        $postSearch = new PostSearch();
        $dataProvider = $postSearch->search(\Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['published_at' => SORT_DESC])->andWhere(['status' => Post::STATUS_ACTIVE, 'type' => Post::TYPE_BLOG]);
        $dataProvider->pagination->pageSize = 10;

        return $this->render('@common/modules/post/modules/client/views/post/blogs', [
            'dataProvider' => $dataProvider,
        ]);
    }

  
    public function actionCategory($slug)
    {
        $postSearch = new PostSearch();
        $query = Categories::find()->where(['slug' => $slug]);

        if ($query->count() == 0) {
            throw new NotFoundHttpException('Category not found');
        }

        $category = $query->one();
        $postSearch->category = $category->id;
        $dataProvider = $postSearch->search(\Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['published_at' => SORT_DESC]);

        return $this->render('@common/modules/post/modules/client/views/post/category', [
            'dataProvider' => $dataProvider,
            'category' => $category
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionArticle($slug)
    {

        $model = Post::find()->where(['slug' => $slug])->one();
        if (!$model instanceof Post) {
            throw new NotFoundHttpException('Post not found');
        }

        $post_query = Post::find()->where(['lang_hash' => $model->lang_hash]);

        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
            $post_query->andWhere(['lang' => Lang::getLangId('uz')]);
        } else {
            $post_query->lang();
        }

        $post = $post_query->one();

        if (!$post instanceof Post) {
            throw new NotFoundHttpException('Post not found');
        }

        $postSearch = new PostSearch(['scenario' => Post::SCENARIO_SEARCH]);
        $postSearch->detachBehaviors();

        $categories = ArrayHelper::getColumn($post->categories, 'id');
//        $tags = ArrayHelper::getColumn($post->tags, 'id');

        $postSearch->category = $categories;
//        $postSearch->tag = $tags;
        $postSearch->current_post = $post->id;
        $related_posts = PostRepository::getRelatedPosts($post, 4);

//        $important_posts_query = Post::find()
//            ->where(['important' => 1])
//            ->andWhere(['NOT IN', 'post.id', array($post->id)])
//            ->active()
//            ->orderBy(['published_at' => SORT_DESC])
//            ->limit(6)
//        ;
//
//        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
//            $important_posts_query->andWhere(['lang' => Lang::getLangId('uz')]);
//        } else {
//            $important_posts_query->lang();
//        }
//
//        $important_posts = $important_posts_query->all();
//
//        $pr_posts_query = Post::find()
//            ->where(['pr_message' => 1])
//            ->andWhere(['NOT IN', 'post.id', array($post->id)])
//            ->active()
//            ->orderBy(['published_at' => SORT_DESC])
//            ->limit(3)
//            ;
//
//        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
//            $pr_posts_query->andWhere(['lang' => Lang::getLangId('uz')]);
//        } else {
//            $pr_posts_query->lang();
//        }
//
//        $pr_posts = $pr_posts_query->all();

        if (is_null($post->viewed)) {
            $post->updateAttributes(['viewed' => 1]);
        } else {
            $post->updateCounters(['viewed' => 1]);
        }

        return $this->render('@common/modules/post/modules/client/views/post/article', [
            'post' => $post,
            'related_posts' => $related_posts,
//            'important_posts' => $important_posts,
//            'pr_posts' => $pr_posts
        ]);
    }

    public function actionSearch()
    {
        $searchForm = new SearchForm();

        if ($searchForm->load(\Yii::$app->request->get())) {
            $dataProvider = $searchForm->search(\Yii::$app->request->queryParams);
        } else {
            $dataProvider = $searchForm->search();
        }

        $dataProvider->query->orderBy(['published_at' => SORT_DESC]);

        return $this->render('@common/modules/post/modules/client/views/post/search', [
            'dataProvider' => $dataProvider,
            'q' => $searchForm->q,
        ]);
    }

    public function actionMediaPhoto()
    {

        $postSearch = new PostSearch();
        $dataProvider = $postSearch->search(\Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['type' => Post::TYPE_PHOTO])->orderBy(['published_at' => SORT_DESC]);

        return $this->render('media-photo', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionMediaVideo()
    {

        $postSearch = new PostSearch();
        $dataProvider = $postSearch->search(\Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['type' => Post::TYPE_VIDEO])->orderBy(['published_at' => SORT_DESC]);

        return $this->render('@common/modules/post/modules/client/views/post/media-video', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $name
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionTag($name)
    {
        $postSearch = new PostSearch();
        $query = Tag::find()->where(['name' => $name]);

        if ($query->count() == 0) {
            throw new NotFoundHttpException('Tag not found');
        }

        $tag = $query->one();
        $postSearch->tag = $tag->id;
        $dataProvider = $postSearch->search(\Yii::$app->request->queryParams);
        $dataProvider->query->orderBy(['published_at' => SORT_DESC]);

        return $this->render('@common/modules/post/modules/client/views/post/tag', [
            'dataProvider' => $dataProvider,
            'tag' => $tag
        ]);
    }

    public function actionPrint($slug)
    {

        $model = Post::find()->where(['slug' => $slug])->one();
        if (!$model instanceof Post) {
            throw new NotFoundHttpException('Post not found');
        }

        $post_query = Post::find()->where(['lang_hash' => $model->lang_hash]);

        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
            $post_query->andWhere(['lang' => Lang::getLangId('uz')]);
        } else {
            $post_query->lang();
        }

        $post = $post_query->one();

        if (!$post instanceof Post) {
            throw new NotFoundHttpException('Post not found');
        }

        $postSearch = new PostSearch(['scenario' => Post::SCENARIO_SEARCH]);
        $postSearch->detachBehaviors();

        $categories = ArrayHelper::getColumn($post->categories, 'id');
        $tags = ArrayHelper::getColumn($post->tags, 'id');

        $postSearch->category = $categories;
        $postSearch->tag = $tags;
        $postSearch->current_post = $post->id;
        $related_posts = PostRepository::getRelatedPosts($post, 4);

//        $important_posts_query = Post::find()
//            ->where(['important' => 1])
//            ->andWhere(['NOT IN', 'post.id', array($post->id)])
//            ->active()
//            ->orderBy(['published_at' => SORT_DESC])
//            ->limit(6)
//        ;
//
//        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
//            $important_posts_query->andWhere(['lang' => Lang::getLangId('uz')]);
//        } else {
//            $important_posts_query->lang();
//        }
//
//        $important_posts = $important_posts_query->all();
//
//        $pr_posts_query = Post::find()
//            ->where(['pr_message' => 1])
//            ->andWhere(['NOT IN', 'post.id', array($post->id)])
//            ->active()
//            ->orderBy(['published_at' => SORT_DESC])
//            ->limit(3)
//            ;
//
//        if (\Yii::$app->language == 'uz' || \Yii::$app->language == 'oz') {
//            $pr_posts_query->andWhere(['lang' => Lang::getLangId('uz')]);
//        } else {
//            $pr_posts_query->lang();
//        }
//
//        $pr_posts = $pr_posts_query->all();

        if (is_null($post->viewed)) {
            $post->updateAttributes(['viewed' => 1]);
        } else {
            $post->updateCounters(['viewed' => 1]);
        }

        $this->layout = '@common/modules/pages/modules/client/views/layouts/print_layout';

        return $this->render('@common/modules/post/modules/client/views/post/print', [
            'post' => $post,
            'related_posts' => $related_posts,
//            'important_posts' => $important_posts,
//            'pr_posts' => $pr_posts
        ]);
    }


}