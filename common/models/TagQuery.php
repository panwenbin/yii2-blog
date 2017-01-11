<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[\common\models\gii\TagGii]].
 *
 * @see \common\models\gii\TagGii
 */
class TagQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\gii\TagGii[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\gii\TagGii|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
