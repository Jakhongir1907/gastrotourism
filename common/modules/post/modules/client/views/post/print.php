<?php

/* @var $this yii\web\View */

use common\modules\post\models\Post;

/**
 * @var $post Post
 * @var $related_posts []Post
 */

$this->title = $post->title;

$this->registerMetaTag(['property' => 'og:title', 'content' => $post->title]);
$this->registerMetaTag(['property' => 'og:url', 'content' => $post->getLink()]);
$this->registerMetaTag(['property' => 'og:description', 'content' => mb_substr($post->description, 0, 120, 'UTF8')]);
$this->registerMetaTag(['property' => 'og:image', 'content' => $post->poster->thumbnails->normal['src']]);


$this->registerMetaTag(['property' => 'twitter:domain', 'content' => '/']);
$this->registerMetaTag(['property' => 'twitter:title', 'content' => $post->title]);
$this->registerMetaTag(['property' => 'twitter:url', 'content' => $post->getLink()]);
$this->registerMetaTag(['property' => 'twitter:description', 'content' => mb_substr($post->description, 0, 120, 'UTF8')]);
$this->registerMetaTag(['property' => 'twitter:image', 'content' => $post->poster->thumbnails->normal['src']]);

?>

<div class="container df pt-30 pb-30">

    <div class="df-content-870">
        <article>
            <img src="<?= $post->poster->thumbnails->normal['src'] ?>" alt="" class="post-image" />
            <h1 class="title">
                <?= $post->title ?>
            </h1>
            <div class="meta-wrapper">
                <div class='news-date'><span><img src='/img/icons/calendar.svg' /></span> <?= $post->published_at ?></div>
            </div>
            <p>
                <?= $post->getFormedDescription() ?>
            </p>
        </article>
    </div>
</div>
