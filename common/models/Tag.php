<?php
/**
 * @author Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\models;


use common\models\gii\TagGii;

/**
 * Class Tag
 * @package common\models
 * @property PostTagRelation[] $postTagRelations
 * @property Post[] $posts
 * @property Post[] $notArchivedPosts
 */
class Tag extends TagGii
{
    /**
     * 获取Tag的所有关联表信息
     * @return \yii\db\ActiveQuery
     */
    public function getPostTagRelations()
    {
        return $this->hasMany(PostTagRelation::className(), ['tag_id' => 'id']);
    }

    /**
     * 获取标签标记过的Posts
     * @return \yii\db\ActiveQuery|\common\models\PostQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id' => 'post_id'])->via('postTagRelations');
    }

    /**
     * 获取标签标记过的不是存档的Posts
     * @return \yii\db\ActiveQuery|\common\models\PostQuery
     */
    public function getNotArchivedPosts()
    {
        return $this->getPosts()->notArchive();
    }

    /**
     * 获取标签列表，并附带根据使用率计算的字体大小
     * @return array|TagGii[]
     */
    public static function tagsWithFontSize()
    {
        $tags = static::find()
            ->innerJoinWith('postTagRelations', false)
            ->groupBy('tag.name')
            ->select('tag.name, count(tag.name) as count')
            ->asArray()
            ->all();
        if (!$tags) return [];
        $counts = array_column($tags, 'count');
        $maxCount = max($counts); // 3em
        $minCount = min($counts); // 0.5em
        array_walk($tags, function (&$tag) use ($maxCount, $minCount) {
            $tag['fontSize'] = ((($tag['count'] - $minCount) / ($maxCount - $minCount + 5)) * 2.5 + 0.5) . 'em';
        });
        return $tags;
    }
}