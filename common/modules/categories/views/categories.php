<?php
/**
 * Created by PhpStorm.
 * User: Javharbek
 * Date: 22.02.2018
 * Time: 14:55
 */
use kartik\tree\TreeView;
use common\modules\categories\models\Categories;
use common\modules\langs\components\Lang;
?>

<?php
echo \common\modules\langs\widgets\LangsWidgets::widget();
echo TreeView::widget([
    // single query fetch to render the tree
    // use the Product model you have in the previous step
    'query' => Categories::find()->lang()->addOrderBy('root, lft'),
    'headingOptions' => ['label' => Yii::t('app','Categories')],
    'fontAwesome' => true,
    'isAdmin' => false,
    'displayValue' => 1,
    'softDelete' => true,
    'cacheSettings' => [
        'enableCache' => true
    ],
    'nodeAddlViews' => [
        \kartik\tree\Module::VIEW_PART_2 => '@common/modules/categories/views/_treeManagerBottomPlace',
    ]
]);