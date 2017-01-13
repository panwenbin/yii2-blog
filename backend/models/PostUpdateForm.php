<?php
/**
 * @author: Pan Wenbin <panwenbin@gmail.com>
 */

namespace backend\models;


use Yii;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

class PostUpdateForm extends Post
{
    private $oldPost;

    public function __construct(Post $oldPost, array $config = [])
    {
        $this->oldPost = $oldPost;
        $this->attributes = $oldPost->attributes;
        parent::__construct($config);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->makeOldAsArchive) {
            return $this->archiveUpdate($runValidation = true, $attributeNames = null);
        } else {
            return $this->normalUpdate($runValidation = true, $attributeNames = null);
        }
    }

    /**
     * 保存新的Post，并更新存档指向
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function archiveUpdate($runValidation = true, $attributeNames = null)
    {
        $result = parent::save($runValidation, $attributeNames);
        Post::updateAll(['archive_of_id' => $this->id], ['id' => array_merge([$this->oldPost->id], ArrayHelper::getColumn($this->oldPost->archives, 'id'))]);
        return $result;
    }

    /**
     * 普通更新
     * @param bool $runValidation
     * @param null $attributeNames
     * @return bool
     */
    public function normalUpdate($runValidation = true, $attributeNames = null)
    {
        $this->id = $this->oldPost->id;
        $this->oldPost->load(Yii::$app->getRequest()->post());
        return $this->oldPost->save($runValidation, $attributeNames);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('无法找到此篇日志');
        }
    }
}