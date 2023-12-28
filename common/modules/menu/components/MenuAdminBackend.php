<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 14.03.2018
 * Time: 17:05
 */

namespace common\modules\menu\components;


use Yii;
use yii\base\Action;
use yii\base\Module;

class MenuAdminBackend extends MenuRender
{

    public $checkAccess = true;

    public function beforeRenderMenu()
    {
        echo '<ul class="navbar-nav">';
    }

    public function afterRenderMenu()
    {
        echo '</ul>';
    }

    public function beginRenderItem()
    {

        echo ' <li class="nav-item has-children"><a class="nav-link" href="' . $this->item->url . '">';
        echo '<i class="ni ' . $this->item->icon . ' text-default"></i> ' . $this->item->title;
        if ($this->has_child):
            echo '<span class=" arrow"></span>';
        endif;
        echo ' </a>';
    }

    public function endRenderItem()
    {
        echo "</li>";
    }

    public function beginRenderItemChild()
    {
        if ($this->is_active()):
            echo '<li class="current">';
        else:
            echo '<li>';
        endif;

        echo '<a href="' . $this->item->url . '" class="detailed"> <span class="title">' . $this->item->title . '</span></a>';
        echo '<span class="success icon-thumbnail">' . $this->item->icon . '</span>';
        echo '</li>';

    }

    public function endRenderItemChild()
    {
        echo '</li>';
    }

    public function beforeRenderItemChilds()
    {
        echo ' <ul class="sub-menu">';
    }

    public function afterRenderItemChilds()
    {
        echo '</ul>';
    }

}