<?php

namespace common\modules\gallery\query;

use common\modules\gallery\models\Gallery;
use common\modules\langs\components\QueryBehavior;

/**
 * This is the ActiveQuery class for [[\common\modules\gallery\models\Gallery]].
 *
 * @see \common\modules\gallery\models\Gallery
 */
class GalleryQuery extends \yii\db\ActiveQuery
{
    public function behaviors()
    {
        return [
            'lang' => [
                'class' => QueryBehavior::className(),
                'alias' => Gallery::tableName()
            ],
        ];
    }

    public function active()
    {
        return $this->andWhere(['status' => Gallery::STATUS_ACTIVE])
            ->andWhere(['<', 'published_at', time()]);
    }

    public function slug($slug = null)
    {
        if ($slug == null) {
            return false;
        }
        $this->lang();
        $this->andWhere(['slug' => $slug]);
        return $this;
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\gallery\models\Gallery[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\gallery\models\Gallery|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
