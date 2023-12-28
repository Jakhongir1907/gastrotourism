<?php
/**
 * @author Izzat <i.rakhmatov@list.ru>
 * @package uzbekkonsert
 */

namespace common\modules\post\widgets;


use common\modules\post\repositories\PostRepository;
use yii\bootstrap\Widget;

class PostsWidget extends Widget {

    public $title = '';
    public $size = 4;

    public function run()
    {
        echo "<div class='news-block'>";
        echo "    <div class='news-block-header'>{$this->title}</div>";
        echo "    <div class='news-block-content'>";

        $posts = PostRepository::getLenta(4);

        foreach ($posts as $post):
            echo "<a href='{$post->getLink()}' >
                    <div class='news-item'>
                        <div class='news-title'>{$post->title}</div>
                        <div class='news-date'><span><img src='/img/icons/calendar.svg' /></span> {$post->getPrettyDate()}</div>
                    </div>
                </a>";

        endforeach;

        echo "    </div>";
        echo "</div>";
        
    }
}