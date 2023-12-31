<?php

namespace common\modules\post\query;

/**
 * This is the ActiveQuery class for [[\common\modules\postfiles\models\PostFiles]].
 *
 * @see \common\modules\post\models\PostFiles
 */
class PostFilesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\post\models\PostFiles[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\post\models\PostFiles|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
