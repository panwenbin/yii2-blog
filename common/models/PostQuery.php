<?php
/**
 * @author: Pan Wenbin <panwenbin@gmail.com>
 */

namespace common\models;


use Yii;
use yii\base\Event;
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

    public function own()
    {
        /* @var $user \common\models\User */
        $user = Yii::$app->getUser()->getIdentity();
        if ($user && $user->isAdmin() == false) {
            $this->andWhere(['user_id' => $user->id]);
        }
        return $this;
    }

    public static function limitToOwnPosts()
    {
        Event::on(static::className(), PostQuery::EVENT_INIT, function ($event) {
            /* @var $postQuery PostQuery */
            $postQuery = $event->sender;
            $postQuery->own();
        });
    }

    public function orderRecent()
    {
        return $this->orderBy('created_at DESC');
    }
}