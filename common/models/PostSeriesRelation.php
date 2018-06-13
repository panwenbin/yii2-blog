<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\models;


use common\models\gii\PostSeriesRelationGii;

/**
 * 日志系列关系
 * @property Post[] $posts
 * @property Series $series
 * @package common\models
 */
class PostSeriesRelation extends PostSeriesRelationGii
{
    /**
     * 关联Post
     * @return PostQuery
     */
    public function getPosts()
    {
        /* @var \common\models\PostQuery $postQuery */
        $postQuery = $this->hasMany(Post::className(), ['title' => 'post_title']);
        $postQuery->notArchive();
        return $postQuery;
    }

    /**
     * 关联Series
     * @return \yii\db\ActiveQuery
     */
    public function getSeries()
    {
        return $this->hasOne(Series::className(), ['id' => 'series_id']);
    }
}