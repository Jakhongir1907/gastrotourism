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


$this->registerMetaTag(['property' => 'twitter:domain', 'content' => 'gastrotourism.uz']);
$this->registerMetaTag(['property' => 'twitter:title', 'content' => $post->title]);
$this->registerMetaTag(['property' => 'twitter:url', 'content' => $post->getLink()]);
$this->registerMetaTag(['property' => 'twitter:description', 'content' => mb_substr($post->description, 0, 120, 'UTF8')]);
$this->registerMetaTag(['property' => 'twitter:image', 'content' => $post->poster->thumbnails->normal['src']]);

$this->registerCssFile('/assets/bbd5f3aa/css/novostiPodrobiye.css');
?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-12 row">
            <div class="col-12 col-lg-2">
                <div class="podrobnee-title">
                    <div class="div d-flex">
                    </div>
                    <div class="pod-data">
                        <div><?= $post->getPrettyDate() ?></div>
                        <div class="count d-flex"><img class="mr-2" src="/images/eye.svg" alt="eye"><?=$post->viewed?></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-10 row">
                <div class="podrobnee-theme">
                    <?=$post->title?>
                </div>
                <div class="row">
                    <div class="podrobnee-about col-12 col-lg-9">
                        <?= $post->anons ?>
                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="social-pod">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?=\Yii::$app->urlManager->createAbsoluteUrl(\Yii::$app->request->url)?>&picture=http%3A%2F%2Fwww.applezein.net%2Fwordpress%2Fwp-content%2Fuploads%2F2015%2F03%2Ffacebook-logo.jpg&title=<?=$this->title?>" target="_blank">
                                <img src="/images/facebook -pod.svg" alt="facebook">
                            </a>
                            <a href="https://telegram.me/share/url?url=<?=\Yii::$app->urlManager->createAbsoluteUrl(\Yii::$app->request->url)?>&text=<?=$this->title?>" target="_blank">
                                <img src="/images/telegram-pod.svg" alt="telegram">
                            </a>
                            <a href="#">
                                <img src="/images/instagram-pod.svg" alt="instagram">
                            </a>
                            <a href="#">
                                <img src="/images/twitter-pod.svg" alt="twitter">
                            </a>
                        </div>
                    </div>
                    <div class="col-12 pod-img">
                        <img src="<?=$post->poster->thumbnails->normal['src']?>" alt="Guli xanim">
                    </div>
                    <div class="col-12 pod-card-text">
                        <?= $post->getFormedDescription() ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
