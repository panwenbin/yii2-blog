<?php
/**
 * @author: Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\models;


use yii\db\ActiveQuery;

class PostQuery extends ActiveQuery
{
    public function lastPublished()
    {
        return $this->limit(1)->orderBy('created_at DESC');
    }

    public function notArchive()
    {
        return $this->andWhere(['archive_of_id' => null]);
    }
}