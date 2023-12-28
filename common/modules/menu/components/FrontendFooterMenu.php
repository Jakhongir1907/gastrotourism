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

class FrontendFooterMenu extends MenuRender
{

    public $iterator = 1;

    public function init()
    {
        parent::init();
    }

    public function beforeRenderMenu()
    {
        echo '<div class="col-12 col-sm-9 row justify-content-around">';
    }

    public function afterRenderMenu()
    {
        echo '</div>';
    }

    public function beginRenderItem()
    {

        if ($this->iterator == 1 || ceil(sizeof($this->items) / 3) == $this->iterator) echo "<div class='col-4 col-sm-3 col-md-2 '><ul>";

        echo ' <li><a href="' . $this->item->url . '">' . $this->item->title . '</a></li>';

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

        $this->iterator++;
        if (ceil(sizeof($this->items) / 3) == $this->iterator) echo "</ul></div>";

    }

    public function beginRenderItemChild()
    {
        if ($this->iterator == 1 || sizeof($this->items) / 3 == $this->iterator) echo "<div class='col-4 col-sm-3 col-md-2 '><ul>";

        echo ' <li><a href="' . $this->item->url . '">' . $this->item->title . '</a></li>';
    }

    public function endRenderItemChild()
    {
        if (ceil(sizeof($this->items) / 3) == $this->iterator) echo "</ul></div>";

        $this->iterator++;
    }

    public function beforeRenderItemChilds()
    {
//        echo '<ul>';
    }

    public function afterRenderItemChilds()
    {
//        echo '</ul>';
    }
}