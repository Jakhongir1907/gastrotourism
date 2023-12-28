<?php

namespace common\modules\menu\components;

use common\modules\menu\assets\MenuAdminAsset;
use Yii;
use common\modules\menu\components\MenuRender;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\modules\menu\models\Menu;
use common\modules\menu\models\MenuItems;
use yii\widgets\Pjax;
use common\modules\menu\models\MenuItemsPosts;

class FrontendMenu extends MenuRender
{

    public function init()
    {
        parent::init();
    }

    public function beforeRenderMenu()
    {
        echo '<ul class="navbar-nav collapse navbar-collapse text-right" id="navbar">';
    }

    public function languagesRender() {

        $renderedMenu = "";

        foreach (\common\modules\langs\models\Langs::find()->where(['<>', 'code', \Yii::$app->language])->active()->all() as $language):
            $renderedMenu
                .= '<li><a href="'
                . \yii\helpers\Url::current(['language' => $language->code]) . '" class="lang-item-link">'
                . strtoupper($language->code)
                . '</a></li>';

        endforeach;

        return $renderedMenu;
    }

    public function afterRenderMenu()
    {
        echo '<ul class="nav-right">
            <li>
                <div>
                    <div class="lang">
                        <div class="lang-toggler select">
                            <img src="/images/globe.png" alt="globus">
                            <span>' . \Yii::$app->language . '</span>
                            <img class="chervon" src="/images/right-chevron.png" alt="right-chervon">
                        </div>
                        <div class="other-lang">
                            <ul>' . $this->languagesRender() . '</ul>
                        </div>
                    </div>
                </div>
            </li>
            <li >
                <div class="search select">
                    <img class="search-icon" src="/images/search (2).png" alt="search">
                    <div class="search-form">
                        <form class="d-flex" action="' . \Yii::$app->urlManager->createUrl(["site/search"]) . '" method="GET">
                            <input type="text" placeholder="search" name="q">
                        </form>
                    </div>
                </div>
            </li>
        </ul>
    </ul>';
    }

    public function beginRenderItem()
    {

        if ($this->has_child) {
            echo '<li class="nav-item relative">
                    <a href="#" class="top10 nav-link"> ' . $this->item->title . '
                        <img class="top-chevron" src="/images/right-chevron.png" alt="">';
        } else {
            echo '<li class="nav-item"><a href="' . $this->item->url . '" class="nav-link ' . ($this->is_active() ? "activ" : "") . '">' . $this->item->title
                . '</a>';
        }

    }

    private function menuItemSetting()
    {
        $model = MenuItems::findOne($this->item->menu_item_id);

        echo '<div  class="menu-item-settings" menuitem-id="' . $this->item->menu_item_id . '"> ';
        $form = ActiveForm::begin([
            'id' => 'menu-item-form',
            'options' => ['data-pjax' => true, ['enctype' => 'multipart/form-data']]
        ]);
        echo $form->field($model, 'title');
        echo $form->field($model, 'url');
        echo $form->field($model, 'icon');
//        echo \jakharbek\filemanager\widgets\ModalWidget::widget();
//        echo \jakharbek\filemanager\widgets\InputModalWidget::widget(['form' => $form,
//            'attribute' => 'MenuItems[icon]',
//            'id' => 'menu_icon'.$this->item->menu_item_id,
//            'values' => $model->icon,
//            'value_encode' => true
//        ]);
        //echo $form->field($model,'imageFile')->fileInput();
        echo $form->field($model, 'menu_item_id')->hiddenInput()->label(false);
        echo Html::submitButton(Yii::t('app', 'Menu Update'), ['class' => 'btn btn-primary']);
        echo Html::a(Yii::t('app', 'Menu Remove'), '#menuitem', [
            'class' => 'btn btn-danger pull-right',
            'title' => 'delete',
            'data-query' => 'delete',
            'data-query-delete-selector' => 'li[menuitem-id=' . $this->item->menu_item_id . ']',
            'data-query-method' => 'POST',
            'data-query-url' => yii\helpers\Url::to(["/menu/menu/delete-item"]),
            'data-query-confirm' => Yii::t('app', 'Are you sure?'),
            'data-query-params' => 'id=' . $this->item->menu_item_id . '&menuItemDelete=delete'
        ]);
        ActiveForm::end();
        echo "</div>";
    }

    public function endRenderItem()
    {
        if ($this->has_child):
            echo '</ul></li>';
        else:
            echo '</li>';
        endif;
    }

    public function beginRenderItemChild()
    {
        echo ' <a class="top-food" href="' . $this->item->url . '">' . $this->item->title . '</a>';
    }

    public function endRenderItemChild()
    {
//        echo "</li>";
    }

    public function beforeRenderItemChilds()
    {
        echo '<div class="top10-item">';
    }

    public function afterRenderItemChilds()
    {
        echo '</div>';
    }
}