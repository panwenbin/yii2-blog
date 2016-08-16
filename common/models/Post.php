<?php
/**
 * @author: Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\models;


use common\models\gii\PostGii;
use yii\behaviors\TimestampBehavior;

/**
 * Class Post
 * @package common\models
 * @property User $user
 * @property Post $nextPost
 * @property Post $prevPost
 */
class Post extends PostGii
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * 获取发布本日志的用户
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return PostQuery
     */
    public function getNextPost()
    {
        return self::find()->andWhere(['>', 'created_at', $this->created_at])->orderBy('created_at ASC')->limit(1);
    }

    /**
     * @return PostQuery
     */
    public function getPrevPost()
    {
        return self::find()->andWhere(['<', 'created_at', $this->created_at])->orderBy('created_at DESC')->limit(1);
    }

    /**
     * @inheritdoc
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }
}