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

class FrontendIndexMenu extends MenuRender
{

    public function init()
    {
        parent::init();
    }

    public function beforeRenderMenu()
    {
        echo '<div class="nav-items"><div class="links">';
    }

    public function afterRenderMenu()
    {
        echo '</div>
                <div class="img">
                    <a href="#">
                        <img src="/images/facebook-logo.svg" alt="" />
                    </a>
                    <a href="#">
                        <img src="/images/instagram.svg" alt=""/>
                    </a>
                    <a href="#">
                        <img src="/images/telegram.svg" alt=""/>
                    </a>
                </div>
            </div>';
    }

    public function beginRenderItem()
    {
        echo '<a class="nav-link" href="' . $this->item->url . '">'. $this->item->title . '</a>';

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
        endif;
    }

    public function beginRenderItemChild()
    {
        echo ' <li class="nav-item"><a class="nav-link" href="' . $this->item->url . '">' . $this->item->title . '</a>';
    }

    public function endRenderItemChild()
    {
        echo "</li>";
    }

    public function beforeRenderItemChilds()
    {
        echo '<ul class="submenu">';
    }

    public function afterRenderItemChilds()
    {
        echo '</ul>';
    }
}