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
}